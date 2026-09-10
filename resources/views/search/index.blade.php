@extends('app')

@section('title', 'Search results - ' . $keyword)

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <div>
            <h4 class="fw-bold mb-1">Search results</h4>
            <p class="text-muted mb-0">
                Showing results for keyword: <strong class="text-dark">"{{ $keyword }}"</strong>
            </p>
        </div>
        <div>
            @php
                $totalResults = $results['products']->count() 
                              + $results['categories']->count() 
                              + $results['users']->count() 
                              + $results['roles']->count();
            @endphp
            <span class="badge bg-success fs-6 px-3 py-2 rounded-pill">
                {{ $totalResults }} Found
            </span>
        </div>
    </div>

    @if ($totalResults === 0)
        <div class="card border-0 shadow-sm rounded-4 p-5 text-center my-4">
            <div class="my-3">
                <i class="bi bi-search text-muted" style="font-size: 3.5rem;"></i>
            </div>
            <h5 class="fw-bold">No Matching Results Found!</h5>
            <p class="text-muted mb-0">Try searching with different keywords or double-check the spelling of your keywords!</p>
        </div>
    @else
        <div class="row g-4">
            <!-- 1. Kategori: Produk -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                        <h6 class="fw-bold mb-0 text-primary">
                            <i class="bi bi-box-seam me-2"></i> Products
                        </h6>
                        <span class="badge bg-light text-dark">{{ $results['products']->count() }}</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse ($results['products'] as $product)
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-3 py-3"> 
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $product->name }}</div>
                                        @if(isset($product->price))
                                            <small class="text-muted">Rp {{ number_format($product->price, 0, ',', '.') }}</small>
                                        @endif
                                    </div>
                                    @if(Route::has('products.edit'))
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            @empty
                                <div class="p-3 text-center text-muted small">No Products Found!</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Kategori: Categories -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                        <h6 class="fw-bold mb-0 text-success">
                            <i class="bi bi-tags me-2"></i> Product Categories
                        </h6>
                        <span class="badge bg-light text-dark">{{ $results['categories']->count() }}</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse ($results['categories'] as $category)
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-3 py-3">
                                    <div class="fw-semibold text-dark">{{ $category->name }}</div>
                                    @if(Route::has('categories.edit'))
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            @empty
                                <div class="p-3 text-center text-muted small">No Categories Found!</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Kategori: Users -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                        <h6 class="fw-bold mb-0 text-info">
                            <i class="bi bi-people me-2"></i> Users
                        </h6>
                        <span class="badge bg-light text-dark">{{ $results['users']->count() }}</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse ($results['users'] as $user)
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-3 py-3">
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                    @if(Route::has('users.edit'))
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            @empty
                                <div class="p-3 text-center text-muted small">No Users Found!</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Kategori: Roles -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                        <h6 class="fw-bold mb-0 text-warning">
                            <i class="bi bi-shield-lock me-2"></i> Roles
                        </h6>
                        <span class="badge bg-light text-dark">{{ $results['roles']->count() }}</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse ($results['roles'] as $role)
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-3 py-3">
                                    <div class="fw-semibold text-dark">{{ $role->name }}</div>
                                    @if(Route::has('roles.edit'))
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            @empty
                                <div class="p-3 text-center text-muted small">No Roles Found!</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection