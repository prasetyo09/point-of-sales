@extends('app')
@section('content')
 <!-- Alert Notifikasi -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<table class="table table-bordered table-responsive">
    <thead class="table-success">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Category Name</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $index => $v )
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td class="text-center">{{ $v->name }}</td>
            <td class="text-center">
                <a href="{{ route('category.edit', $v->id) }}" class="btn btn-outline-success">Edit</a>
                <form action="{{ route('category.destroy', $v->id) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this data?')">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
