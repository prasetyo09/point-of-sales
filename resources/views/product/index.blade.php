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
<div class="table table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="table-success">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Category Name</th>
                <th class="text-center">Name</th>
                <th class="text-center">Price</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $products as $index => $v )
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $v->category->name }}</td>
                <td class="text-center">
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ Storage::url($v->photo) }}" alt="Gambar" width="80" height="80" style="object-fit: cover">
                        <div class="fw-semibold">
                            {{ $v->name }}
                        </div>
                    </div>
                </td>
                <td class="text-center fw-semibold">Rp.{{ number_format($v->price) }}</td>
                <td class="text-center fw-semibold {{ $v->stock == 0 ? 'text-danger' : '' }}">{{ $v->stock }}</td>
                <td class="text-center">
                    <a href="{{ route('product.edit', $v->id) }}" class="btn btn-outline-success">Edit</a>
                    <a href="{{ route('product.show', $v->id) }}" class="btn btn-outline-primary">Detail</a>
                    <form action="{{ route('product.destroy', $v->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this data?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
