@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('product') }}" class="text-decoration-none text-muted">Product</a></li>
    <li class="breadcrumb-item active text-main" aria-current="page">Edit Product</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('product.update', $products->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Category</label>
                        <select name="category_id" id="" class="form-control">
                            @foreach ($categories as $v)
                                <option {{ $products->category_id == $v->id ? 'selected' : '' }} value="{{ $v->id }}">
                                    {{ $v->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $products->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Photo (1:1)</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Price</label>
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ $products->price }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control"
                            value="{{ $products->stock }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description"
                            class="form-control">{{ $products->description }}</textarea>
                    </div>

                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-outline-primary">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
