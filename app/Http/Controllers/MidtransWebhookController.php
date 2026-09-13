<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Config::$serverKey    = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');

        $notif = new Notification();

        $transactionStatus = $notif->transaction_status;
        $orderNumber       = $notif->order_id;
        $fraudStatus       = $notif->fraud_status;

        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // 1 = paid, 0 = pending, 2 = failed, 3 = canceled
        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            if ($fraudStatus == 'challenge') {
                $order->update(['payment_status' => 0]);
            } else {
                $order->update(['payment_status' => 1]); // Status berubah jadi paid
            }
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $order->update(['payment_status' => 2]);
        } elseif ($transactionStatus == 'pending') {
            $order->update(['payment_status' => 0]);
        }

        return response()->json(['status' => 'OK']);
    }
}
