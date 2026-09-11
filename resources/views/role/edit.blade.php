@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('role') }}" class="text-decoration-none text-muted">Role</a></li>
    <li class="breadcrumb-item active text-main" aria-current="page">Edit Role</li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="d-flex justify-content-end">
                <a href="{{ url('role') }}" class="btn btn-success mb-3"><i class="bi bi-arrow-left"></i>Back</a>
            </div> --}}
            <form action="{{ route('role.update', $roles->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$roles->name }}">
                </div>
                <button type="submit" name="save" class="btn btn-success">Save Changes</button>
                <button type="reset" class="btn btn-outline-success">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection
