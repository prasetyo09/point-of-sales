@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green">Dashboard</a></li>
@endsection
@section('content')
<div class="d-flex align-items-center gap-3 mb-3">
    <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
        <i class="bi bi-person-circle fs-2"></i>
    </div>
    <div>
        <h3 class="fw-bold mb-0 text-dark">
            Welcome, {{ Auth::user()->name ?? 'Pengguna' }}!
        </h3>
        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 mt-1">
            {{ Auth::user()->role->name ?? 'Admin / Kasir' }}
        </span>
    </div>
</div>

<hr class="my-3 text-muted">

<p class="text-secondary mb-0">
    You have successfully logged into the Point of Sale (POS) system. Please use the navigation menu to manage cashier transactions, products, and reports.
</p>
@endsection
