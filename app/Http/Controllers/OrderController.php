<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subtitle = "Point of Sales";
        $title = "Order Transaction";
        return view('order.index', compact('title', 'subtitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
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

        $orderDetails = OrderDetail::with(['product']) ;
        $orders = $query->latest()->get();

        // Ringkasan metrik
        $totalRevenue     = $orders->sum('total_price');
        $totalOrders      = $orders->count();
        $totalProducts    = $orderDetails->sum('qty');
        $totalCash        = $orders->where('payment_method', 0)->sum('total_price');
        $totalMidtrans    = $orders->where('payment_method', 1)->sum('total_price');

        $categories = Category::get();
        $products = Product::with('category')->orderBy('id')->get();
        $title = "Create New Order";

        return view('order.create', compact(
            'orders',
            'startDate',
            'endDate',
            'paymentMethod',
            'totalRevenue',
            'totalOrders',
            'totalProducts',
            'totalCash',
            'totalMidtrans',
            'title',
            'categories',
            'products'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'payment_method' => 'nullable|string'
        ]);

        try {
            return DB::transaction(function () use ($request) {
                $subTotal = 0;
                $itemsData = [];

                foreach ($request->items as $item) {
                    $product = Product::findOrFail($item['id']);

                    if ($product->stock < $item['qty']) {
                        throw new Exception("Stok produk '{$product->name}' tidak mencukupi.");
                    }

                    $itemSubTotal = $product->price * $item['qty'];
                    $subTotal += $itemSubTotal;

                    $itemsData[] = [
                        'product' => $product,
                        'qty' => $item['qty'],
                        'price' => $product->price,
                        'subtotal' => $itemSubTotal
                    ];
                }

                $tax = $subTotal * 0.1;
                $total = $subTotal + $tax;
                $order_code = 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);
                // $paymentMethod = $request->payment_method ?? 0 ;

                $rawPaymentMethod = $request->payment_method ?? 'cash';
                $paymentMethod = ($rawPaymentMethod === '1') ? 1 : 0;

                // 2. Status: Cash = 1 (paid), Midtrans = 0 (pending)
                $paymentStatus = ($paymentMethod === 0) ? 1 : 0;

                $order = Order::create([
                    'user_id'           => Auth::id(),
                    'order_number'      => $order_code,
                    'total_price'       => (int) round($total),
                    'change'            => ($paymentMethod === 1) ? 0 : max(0, (int) ($request->change ?? 0)),
                    'payment_status'    => $paymentStatus,
                    'payment_method'    => $paymentMethod
                ]);

                foreach ($itemsData as $data) {
                    OrderDetail::create([
                        'order_id'      => $order->id,
                        'product_id'    => $data['product']->id,
                        'qty'           => $data['qty'],
                        'unit_price'    => $data['price'],
                        'subtotal'      => $data['subtotal']
                    ]);

                $data['product']->decrement('stock', $data['qty']);
                }

                if ($paymentMethod === 1) {
                    Config::$serverKey    = config('services.midtrans.server_key');
                    Config::$isProduction = config('services.midtrans.is_production');
                    Config::$isSanitized  = true;
                    Config::$is3ds        = true;

                    // foreach ($itemsData as $data) {
                    //     TransactionDetail::create([
                    //         'order_id' => $order->id,
                    //         'product_id' => $data['product']->id,
                    //         'order_qty'   => $data['qty'],
                    //         'order_price' => $data['price'],
                    //         'order_subtotal' => $data['subtotal']
                    //     ]);

                    //     $data['product']->decrement('qty', $data['qty']);
                    // }

                    $params = [
                        "transaction_details" => [
                            "order_id" => $order->order_number  ,
                            "gross_amount" => (int) round($total)
                        ],
                        "customer_details" => [
                            "first_name" => $request->customer_name ?? 'No-Name',
                            "phone" => $request->customer_phone ?? 'No-Number',
                            "email" => $request->customer_email ?? 'No-Email',

                            "shipping_address" => [
                                "first_name" => $request->customer_name ?? 'No-Name',
                                "phone" => $request->customer_phone ?? 'No-Number',
                                "address" => $request->customer_address ?? 'No-Address'
                            ],

                            "billing_address" => [
                                "first_name" => $request->customer_name ?? 'No-Name',
                                "phone" => $request->customer_phone ?? 'No-Number',
                                "address" => $request->customer_address ?? 'No-Address'
                            ]

                        ],
                        // 'enabled_payments' => ['gopay', 'qris']
                    ];


                    $snapToken = Snap::getSnapToken($params);

                    return response()->json([
                        'success' => true,
                        'payment_method' => 'midtrans',
                        'snap_token' => $snapToken,
                        'order_id' => $order->id
                    ]);

                }
                return response()->json([
                    'success' => true,
                    'payment_method' => 'cash',
                    'order_id' => $order->id
                ]);
            });
        } catch (Exception $th) {
            return response()->json([
                'message' => 'GAGAL MENYIMPAN TRANSAKSI!!! ' . $th->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'payment_status' => 1 // Update jadi paid
        ]);

        return response()->json(['success' => true]);
    }

    public function data(){

        //Order
        $todayTransaction = Order::whereDate('created_at', today())
            ->count();

        //Income
        $todayIncome = Order::whereDate('created_at', today())
            ->sum('total_price');

        //Product
        $todayProduct = OrderDetail::whereHas('order', function ($query) {
            $query->whereDate('created_at', today());
        })->sum('qty');

        return response()->json([
            'today_transaction' => $todayTransaction,
            'today_income' => $todayIncome,
            'today_product' => $todayProduct,
        ]);
    }

}
