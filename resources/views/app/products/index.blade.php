@extends('app.layouts.template')

@section('title', 'Produtos')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1 fw-bold">
                                <i class="fas fa-box me-2"></i>Meus Produtos
                            </h2>
                            <p class="mb-0 opacity-75">Gerencie seus produtos de forma eficiente</p>
                        </div>
                        <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg shadow-sm">
                            <i class="fas fa-plus me-2"></i>Novo Produto
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    @if($products->count() > 0)
        <!-- Products Grid -->
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        <div class="position-relative overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" 
                                     class="card-img-top product-image" 
                                     alt="{{ $product->name }}" 
                                     style="height: 220px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center product-placeholder" 
                                     style="height: 220px;">
                                    <i class="fas fa-box fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="product-overlay">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('products.show', $product->id) }}" 
                                       class="btn btn-info btn-sm rounded-pill shadow-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" 
                                       class="btn btn-warning btn-sm rounded-pill shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" 
                                          method="POST" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill shadow-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-light mb-2">{{ $product->name }}</h5>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $product->created_at->format('d/m/Y') }}
                                    </small>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" 
                                                type="button" 
                                                data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('products.show', $product->id) }}">
                                                    <i class="fas fa-eye me-2"></i>Visualizar
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">
                                                    <i class="fas fa-edit me-2"></i>Editar
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('products.destroy', $product->id) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash me-2"></i>Excluir
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination if needed -->
        @if($products->hasPages())
            <div class="row mt-5">
                <div class="col-12">
                    {{ $products->links('pagination.custom') }}
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                            <h3 class="text-muted mb-3">Nenhum produto encontrado</h3>
                            <p class="text-muted mb-4 lead">
                                Você ainda não possui produtos cadastrados.<br>
                                Comece criando seu primeiro produto agora!
                            </p>
                            <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fas fa-plus me-2"></i>Criar Primeiro Produto
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.product-card {
    transition: all 0.3s ease;
    border-radius: 15px !important;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.product-image {
    transition: transform 0.3s ease;
    border-radius: 15px 15px 0 0;
}

.product-placeholder {
    border-radius: 15px 15px 0 0;
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.empty-state i {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.dropdown-menu {
    border: none;
    border-radius: 10px;
}

.dropdown-item {
    border-radius: 8px;
    margin: 2px 8px;
}

.dropdown-item:hover {
    background-color: var(--bs-primary);
    color: white;
}

.dropdown-item.text-danger:hover {
    background-color: var(--bs-danger);
    color: white;
}
</style>
@endsection