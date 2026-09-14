@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green no-print">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('reports') }}" class="text-decoration-none text-muted no print">Reports</a></li>
@endsection

@section('content')
<head>
    <style>
        body { background-color: #f5f6f8; font-family: Arial, Helvetica, sans-serif; }
        @media print {
            .no-print { display: none !important; }
            .card { border: none !important; box-shadow: none !important; }
            .summary-cards {
                display: flex !important;
                flex-direction: row !important;
                justify-content: space-between !important;
                margin-bottom: 24px !important;
                border: 1px solid black;
            }

            .table-records {
                border: 1px solid black;
            }
        }
    </style>
</head>
<div class="container-fluid">
    <!-- Filter Form -->
    <div class="card shadow-sm border-0 mb-4 no-print">
        <form action="{{ route('reports.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-bold">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Payment Method</label>
                <select name="payment_method" class="form-select">
                    <option value="">All Methods</option>
                    <option value="0" {{ $paymentMethod === '0' ? 'selected' : '' }}>Cash (Tunai)</option>
                    <option value="1" {{ $paymentMethod === '1' ? 'selected' : '' }}>Midtrans (Online)</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-filter"></i> Filter</button>
                <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    <!-- Ringkasan Metrik -->
    <div class="row g-3 mb-4 summary-cards">
        <div class="col-3">
            <div class="card shadow-sm border-0 border-start border-primary border-4 p-3">
                <small class="text-muted fw-bold">TOTAL TRANSACTION</small>
                <h4 class="fw-bold mb-0 text-primary fs-5">{{ number_format($totalOrders) }} {{ $totalOrders === 1 ? 'Order' : 'Orders' }}</h4>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow-sm border-0 border-start border-success border-4 p-3">
                <small class="text-muted fw-bold">TOTAL INCOME</small>
                <h4 class="fw-bold mb-0 text-success fs-5">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow-sm border-0 border-start border-warning border-4 p-3">
                <small class="text-muted fw-bold">CASH REVENUE</small>
                <h4 class="fw-bold mb-0 text-warning fs-5">Rp {{ number_format($totalCash, 0, ',', '.') }}</h4>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow-sm border-0 border-start border-info border-4 p-3">
                <small class="text-muted fw-bold">MIDTRANS REVENUE</small>
                <h4 class="fw-bold mb-0 text-info fs-5">Rp {{ number_format($totalMidtrans, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <!-- Tabel Data Penjualan -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0 table-records">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Order Number</th>
                            <th>Date & Time</th>
                            <th>Cashier</th>
                            <th>Item Sold</th>
                            <th>Payment Method</th>
                            <th class="text-end pe-3">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="ps-3 fw-bold">{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $order->user->name ?? 'Kasir' }}</td>
                                <td>
                                    <ul class="list-unstyled mb-0 small">
                                        @foreach ($order->items as $detail)
                                            <li>{{ $detail->product->name ?? 'Produk' }} <span class="text-muted">x{{ $detail->qty }}</span></li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @if ($order->payment_method == 0)
                                        <span class="badge bg-success">Cash</span>
                                    @else
                                        <span class="badge bg-primary">Midtrans</span>
                                    @endif
                                </td>
                                <td class="text-end pe-3 fw-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Tidak ada data transaksi pada rentang waktu yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
