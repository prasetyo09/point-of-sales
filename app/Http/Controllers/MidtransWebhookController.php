<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();

        $orderId = $payload['order_id'] ?? null;
        $statusCode = $payload['status_code'] ?? null;
        $grossAmount = $payload['gross_amount'] ?? null;
        $signatureKey = $payload['signature_key'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        // Ambil Server Key dari config / .env
        $serverKey = config('services.midtrans.server_key');

        // Buat signature hash di sisi server
        $localSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        // 1. Verifikasi Keaslian Pengirim (Signature Match)
        if ($localSignature !== $signatureKey) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        // Cari data transaksi di database
        $order = Order::where('order_number', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // 2. Verifikasi Nominal Transaksi
        // Pastikan jumlah yang dibayar di Midtrans persis dengan tagihan asli di database
        if ((float) $order->total_amount !== (float) $grossAmount) {
            return response()->json(['message' => 'Gross amount mismatch'], 400);
        }

        // 3. Update Status Order Berdasarkan Status Midtrans
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $order->update(['status' => 'paid']);
            }
        } elseif ($transactionStatus == 'settlement') {
            $order->update(['status' => 'paid']);
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $order->update(['status' => 'cancelled']);
        } elseif ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        }

        return response()->json(['message' => 'Notification processed successfully'], 200);
    }
}
