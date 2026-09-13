@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green">Dashboard</a></li>
@endsection
@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative mb-4" 
     style="background: linear-gradient(135deg, #ffffff 0%, #f4fbf7 100%);">
    
    <!-- Lingkaran dekorasi latar belakang (subtle background glow) -->
    <div class="position-absolute top-0 end-0 rounded-circle bg-success bg-opacity-10" 
         style="width: 260px; height: 260px; filter: blur(50px); transform: translate(30%, -30%); pointer-events: none;">
    </div>
    <div class="position-absolute bottom-0 start-50 rounded-circle bg-success bg-opacity-10" 
         style="width: 180px; height: 180px; filter: blur(40px); transform: translate(-50%, 50%); pointer-events: none;">
    </div>

    <div class="card-body p-4 p-lg-5 position-relative">
        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-3 gap-sm-4">
            
            <!-- Avatar Icon dengan Efek Glow & Shadow -->
            <div class="rounded-4 bg-white text-success d-flex align-items-center justify-content-center shadow-sm border border-success border-opacity-10 flex-shrink-0" 
                 style="width: 68px; height: 68px;">
                <i class="bi bi-person-bounding-box fs-2"></i>
            </div>
            
            <!-- Header Text & Badge -->
            <div class="flex-grow-1">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                    <h2 class="fw-bold mb-0 text-dark tracking-tight">
                        Welcome back, <span class="text-success">{{ Auth::user()->name ?? 'User' }}</span>! 👋
                    </h2>
                    <span class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1.5 fw-medium d-inline-flex align-items-center gap-1">
                        <span class="rounded-circle bg-success" style="width: 6px; height: 6px;"></span>
                        {{ Auth::user()->role->name ?? 'Admin / Cashier' }}
                    </span>
                </div>
                <small class="text-muted d-block">
                    Point of Sale Management Portal
                </small>
            </div>
        </div>

        <hr class="my-4 border-secondary border-opacity-10">

        <!-- Deskripsi dengan Tampilan Rapi & Status Indikator -->
        <div class="d-flex align-items-center gap-2 text-secondary">
            <i class="bi bi-check-circle-fill text-success fs-5 flex-shrink-0"></i>
            <p class="mb-0 fs-6 lh-base">
                You have successfully logged in. Please use the navigation menu on the left to manage transactions, inventory, and generate reports.
            </p>
        </div>
    </div>
</div>
@endsection
