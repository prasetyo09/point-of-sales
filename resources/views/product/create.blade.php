@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Category</label>
                    <select name="category_id" id="" class="form-control">
                        <option value="" class="text-secondary">-- Choose Category --</option>
                        @foreach ($categories as $v )
                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Photo (1:1)</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Price</label>
                    <input type="number" name="price" id="price" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-bold">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>

                <button type="submit" name="save" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-outline-success">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection
