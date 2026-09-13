@extends('app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('order.create') }}" class="btn btn-success">Move to Point of Sales<i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</div>
@endsection
