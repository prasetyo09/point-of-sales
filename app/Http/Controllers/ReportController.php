<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request){
        $title = "Sales Reports";
        $btnClick = "window.print()";
        // Default filter: 30 hari terakhir jika tidak ada input tanggal
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->toDateString());
        $endDate   = $request->input('end_date', Carbon::now()->toDateString());
        $paymentMethod = $request->input('payment_method'); // null, '0', atau '1'
        $subtitle = Carbon::parse($startDate)->format('d M Y') . " " . "-" . " " . Carbon::parse($endDate)->format('d M Y');

        $query = Order::with(['user', 'items.product'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('payment_status', 1); // Hanya transaksi yang sudah dibayar/lunas

        if ($paymentMethod !== null && $paymentMethod !== '') {
            $query->where('payment_method', $paymentMethod);
        }

        $orders = $query->latest()->get();

        // Ringkasan metrik
        $totalRevenue     = $orders->sum('total_price');
        $totalOrders      = $orders->count();
        $totalCash        = $orders->where('payment_method', 0)->sum('total_price');
        $totalMidtrans    = $orders->where('payment_method', 1)->sum('total_price');

        return view('reports.index', compact(
            'orders',
            'startDate',
            'endDate',
            'paymentMethod',
            'totalRevenue',
            'totalOrders',
            'totalCash',
            'totalMidtrans',
            'title',
            'subtitle',
            'btnClick'
        ));
    }
}
