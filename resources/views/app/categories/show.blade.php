@extends('app.layouts.template')

@section('title', 'Visualizar Categoria')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm me-3 rounded-pill">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <div>
                                <h2 class="mb-1 fw-bold">
                                    <i class="fas fa-tag me-2"></i>{{ $category->title }}
                                </h2>
                                <p class="mb-0 opacity-75">Detalhes da categoria</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm rounded-pill shadow-sm">
                                <i class="fas fa-edit me-1"></i>Editar
                            </a>
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-light btn-sm rounded-pill">
                                <i class="fas fa-list me-1"></i>Ver Todas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Details -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-info-circle me-2 text-primary"></i>Informações da Categoria
                    </h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted">Título</label>
                            <p class="fs-5 fw-bold text-dark">{{ $category->title }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted">Data de Criação</label>
                            <p class="fs-6 text-dark">{{ $category->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Descrição</label>
                        <p class="text-dark">{{ $category->description ?: 'Nenhuma descrição fornecida.' }}</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted">Última Atualização</label>
                            <p class="fs-6 text-dark">{{ $category->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted">Tempo Decorrido</label>
                            <p class="fs-6 text-dark">{{ $category->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-cogs me-2 text-success"></i>Ações
                    </h5>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Editar Categoria
                        </a>
                        
                        <form action="{{ route('categories.destroy', $category->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>Excluir Categoria
                            </button>
                        </form>
                        
                        <hr>
                        
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>Ver Todas as Categorias
                        </a>
                        
                        <a href="{{ route('categories.create') }}" class="btn btn-outline-success">
                            <i class="fas fa-plus me-2"></i>Nova Categoria
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Statistics Card -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-chart-bar me-2 text-info"></i>Estatísticas
                    </h5>
                    
                    <div class="text-center">
                        <div class="mb-3">
                            <h3 class="text-primary fw-bold">{{ $category->shopping_lists->count() }}</h3>
                            <p class="text-muted mb-0">Listas de Compras</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection