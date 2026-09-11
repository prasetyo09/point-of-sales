@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('category') }}" class="text-decoration-none text-muted">Category</a></li>
    <li class="breadcrumb-item active text-main" aria-current="page">Add New Category</li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="d-flex justify-content-end">
                <a href="{{ url('role') }}" class="btn btn-success mb-3"><i class="bi bi-arrow-left"></i>Back</a>
            </div> --}}
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Nama</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <button type="submit" name="save" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-outline-success">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection
