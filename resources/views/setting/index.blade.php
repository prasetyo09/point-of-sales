@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('setting') }}" class="text-decoration-none text-muted">Setting</a></li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('setting.update', $settings->id == 1) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Application Name</label>
                    <input type="text" name="app_name" id="app_name" class="form-control" value="{{ $settings->app_name ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Business Name</label>
                    <input type="text" name="business_name" id="business_name" class="form-control" value="{{ $settings->business_name ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Institution</label>
                    <input type="text" name="institution" id="institution" class="form-control" value="{{ $settings->institution ?? '' }}">
                </div>
                <button type="submit" name="save" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-outline-success">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection