
@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('product') }}" class="text-decoration-none text-muted">Product</a></li>
    <li class="breadcrumb-item active text-main" aria-current="page">Detail Product</li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <form action="" method="get" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="" class="form-label fw-bold">Category</label>
                        <input type="text" name="category_id" id="" class="form-control" value="{{ $products->category->name }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="" class="form-label fw-bold">Name</label>
                        <input type="text" name="name" id="" class="form-control" value="{{ $products->name }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="" class="form-label fw-bold">Price</label>
                        <input type="text" name="price" id="" class="form-control" value="Rp.{{ number_format($products->price) }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="" class="form-label fw-bold">Stock</label>
                        <input type="text" name="stock" id="" class="form-control" value="{{ $products->stock }}" readonly>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <label for="" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description" class="form-control" readonly>{{ $products->description }}</textarea>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-column align-items-center">
                        <h3 class="fw-bold form-label">Product Photo</h3>
                        <img src="{{ Storage::url($products->photo) }}" alt="Product Picture" class="shadow rounded-5 border border-dark" width="450" height="450">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
