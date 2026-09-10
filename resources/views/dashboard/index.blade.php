@extends('app')
@section('content')
<div class="d-flex align-items-center gap-3 mb-3">
    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
        <i class="bi bi-person-circle fs-2"></i>
    </div>
    <div>
        <h3 class="fw-bold mb-0 text-dark">
            Selamat Datang, {{ Auth::user()->name ?? 'Pengguna' }}!
        </h3>
        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 mt-1">
            {{ Auth::user()->role->name ?? 'Admin / Kasir' }}
        </span>
    </div>
</div>

<hr class="my-3 text-muted">

<p class="text-secondary mb-0">
    Anda berhasil masuk ke sistem Point of Sale (POS). Silakan gunakan menu navigasi untuk mengelola transaksi kasir, produk, dan laporan.
</p>
@endsection