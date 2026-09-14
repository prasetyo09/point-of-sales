@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('order') }}" class="text-decoration-none text-muted">Order Transaction</a></li>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('order.create') }}" class="btn btn-success">Move to Point of Sales<i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</div>
@endsection
