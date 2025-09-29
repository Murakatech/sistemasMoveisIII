@extends('app.layouts.template')

@section('title', $shoppingList->title)

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(135deg, {{ $shoppingList->color ?? '#f59e0b' }} 0%, {{ $shoppingList->color ?? '#d97706' }} 100%);">
                <div class="card-body py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1 fw-bold">
                                <i class="fas fa-shopping-cart me-2"></i>{{ $shoppingList->title }}
                            </h2>
                            <p class="mb-0 opacity-75">
                                <i class="fas fa-tag me-1"></i>{{ $shoppingList->category->title ?? 'Sem categoria' }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-calendar me-1"></i>Criada em {{ $shoppingList->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('shopping-lists.edit', $shoppingList) }}" class="btn btn-light btn-lg shadow-sm">
                                <i class="fas fa-edit me-2"></i>Editar
                            </a>
                            <a href="{{ route('shopping-lists.index') }}" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Voltar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2 fa-lg"></i>
                        <div>
                            <strong>Sucesso!</strong> {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2 fa-lg"></i>
                        <div>
                            <strong>Erro!</strong> {{ session('error') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="row g-4">
        <!-- Lista Info -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-info-circle me-2 text-primary"></i>Informações da Lista
                    </h5>
                    
                    @if($shoppingList->description)
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Descrição</h6>
                            <p class="text-dark">{{ $shoppingList->description }}</p>
                        </div>
                    @endif
                    
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded">
                                <h4 class="mb-1 text-primary">{{ $shoppingList->products->count() }}</h4>
                                <small class="text-muted">Produtos</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-light rounded">
                                <h4 class="mb-1 {{ $shoppingList->active ? 'text-success' : 'text-secondary' }}">
                                    {{ $shoppingList->active ? 'Ativa' : 'Inativa' }}
                                </h4>
                                <small class="text-muted">Status</small>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-between text-muted small mb-2">
                        <span><i class="fas fa-calendar-plus me-1"></i>Criada:</span>
                        <span>{{ $shoppingList->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted small">
                        <span><i class="fas fa-calendar-edit me-1"></i>Atualizada:</span>
                        <span>{{ $shoppingList->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Produtos da Lista -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-box me-2 text-primary"></i>Produtos da Lista
                        </h5>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="fas fa-plus me-1"></i>Adicionar Produto
                        </button>
                    </div>
                    
                    @if($shoppingList->products->count() > 0)
                        <div class="row g-3">
                            @foreach($shoppingList->products as $product)
                                <div class="col-md-6">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center">
                                                @if($product->image)
                                                    <img src="{{ asset($product->image) }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="rounded me-3"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-box text-white"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1">{{ $product->name }}</h6>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar me-1"></i>{{ $product->created_at->format('d/m/Y') }}
                                                    </small>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('products.show', $product) }}">
                                                                <i class="fas fa-eye me-2 text-primary"></i>Ver Produto
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('shopping-lists.remove-product', [$shoppingList, $product]) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Tem certeza que deseja remover este produto da lista?')">
                                                                    <i class="fas fa-times me-2"></i>Remover da Lista
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-box-open fa-3x text-muted opacity-50"></i>
                            </div>
                            <h5 class="text-muted mb-3">Nenhum produto adicionado</h5>
                            <p class="text-muted mb-4">Comece adicionando produtos à sua lista de compras.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                <i class="fas fa-plus me-2"></i>Adicionar Primeiro Produto
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="fas fa-cogs me-2 text-secondary"></i>Ações da Lista
                        </h6>
                        <div class="d-flex gap-2">
                            <a href="{{ route('shopping-lists.edit', $shoppingList) }}" class="btn btn-outline-warning">
                                <i class="fas fa-edit me-1"></i>Editar Lista
                            </a>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fas fa-trash me-1"></i>Excluir Lista
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Adicionar Produto -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus me-2"></i>Adicionar Produto à Lista
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if($availableProducts->count() > 0)
                    <form action="{{ route('shopping-lists.add-product', $shoppingList) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="product_id" class="form-label fw-semibold">
                                <i class="fas fa-box me-2 text-primary"></i>Selecione um produto
                            </label>
                            <select class="form-select" id="product_id" name="product_id" required>
                                <option value="">Escolha um produto...</option>
                                @foreach($availableProducts as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-box me-1"></i>Ver Todos
                                </a>
                                <a href="{{ route('products.create') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i>Novo Produto
                                </a>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Adicionar à Lista
                            </button>
                        </div>
                    </form>
                @else
                    <div class="text-center py-3">
                        <div class="mb-3">
                            <i class="fas fa-box-open fa-3x text-muted opacity-50"></i>
                        </div>
                        <h6 class="text-muted mb-3">Nenhum produto disponível</h6>
                        <p class="text-muted mb-4">Todos os seus produtos já estão nesta lista ou você ainda não criou nenhum produto.</p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-box me-1"></i>Ver Produtos
                            </a>
                            <a href="{{ route('products.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Criar Produto
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Excluir -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir a lista <strong>"{{ $shoppingList->title }}"</strong>?</p>
                <p class="text-muted small">Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('shopping-lists.destroy', $shoppingList) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Excluir Lista
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.hover-lift {
    transition: transform 0.2s ease-in-out;
}

.hover-lift:hover {
    transform: translateY(-2px);
}
</style>
@endsection