@extends('app.layouts.template')

@section('title', 'Listas de Compras')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-warning text-white">
                <div class="card-body py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1 fw-bold">
                                <i class="fas fa-shopping-cart me-2"></i>Minhas Listas de Compras
                            </h2>
                            <p class="mb-0 opacity-75">Organize suas compras de forma inteligente</p>
                        </div>
                        <a href="{{ route('shopping-lists.create') }}" class="btn btn-light btn-lg shadow-sm">
                            <i class="fas fa-plus me-2"></i>Nova Lista
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

    <!-- Shopping Lists Grid -->
    <div class="row g-4">
        @forelse($shoppingLists as $list)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-header border-0 pb-0" style="background: linear-gradient(135deg, {{ $list->color ?? '#f59e0b' }} 0%, {{ $list->color ?? '#d97706' }} 100%);">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="text-white">
                                <h5 class="mb-1 fw-bold">{{ $list->title }}</h5>
                                <small class="opacity-75">
                                    <i class="fas fa-tag me-1"></i>{{ $list->category->title ?? 'Sem categoria' }}
                                </small>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-light border-0" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('shopping-lists.show', $list) }}">
                                            <i class="fas fa-eye me-2 text-primary"></i>Visualizar
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('shopping-lists.edit', $list) }}">
                                            <i class="fas fa-edit me-2 text-warning"></i>Editar
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('shopping-lists.destroy', $list) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Tem certeza que deseja excluir esta lista?')">
                                                <i class="fas fa-trash me-2"></i>Excluir
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($list->description)
                            <p class="text-muted mb-3">{{ Str::limit($list->description, 100) }}</p>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-secondary text-light">
                                <i class="fas fa-box me-1"></i>{{ $list->products->count() }} produtos
                            </span>
                            <span class="badge {{ $list->active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $list->active ? 'Ativa' : 'Inativa' }}
                            </span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center text-muted small">
                            <span>
                                <i class="fas fa-calendar me-1"></i>{{ $list->created_at->format('d/m/Y') }}
                            </span>
                            <span>
                                <i class="fas fa-clock me-1"></i>{{ $list->updated_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('shopping-lists.show', $list) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Ver Lista
                            </a>
                            <a href="{{ route('shopping-lists.edit', $list) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit me-1"></i>Editar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-shopping-cart fa-4x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted mb-3">Nenhuma lista de compras encontrada</h4>
                    <p class="text-muted mb-4">Comece criando sua primeira lista de compras para organizar suas compras.</p>
                    <a href="{{ route('shopping-lists.create') }}" class="btn btn-warning btn-lg">
                        <i class="fas fa-plus me-2"></i>Criar Primeira Lista
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
.hover-lift {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
}
</style>
@endsection