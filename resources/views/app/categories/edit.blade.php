@extends('app.layouts.template')

@section('title', 'Editar Categoria')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-warning text-white">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('categories.index') }}" class="btn btn-light btn-sm me-3 rounded-pill">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <div>
                                <h2 class="mb-1 fw-bold">
                                    <i class="fas fa-edit me-2"></i>Editar Categoria
                                </h2>
                                <p class="mb-0 opacity-75">Atualize as informações da categoria "{{ $category->title }}"</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-light btn-sm rounded-pill">
                                <i class="fas fa-eye me-1"></i>Visualizar
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

    <!-- Success Message -->
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

    <!-- Edit Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-edit me-2 text-warning"></i>Formulário de Edição
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Título -->
                            <div class="col-12 mb-4">
                                <label for="title" class="form-label fw-semibold">
                                    <i class="fas fa-tag me-2 text-primary"></i>Título da Categoria
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $category->title) }}" 
                                       placeholder="Digite o título da categoria"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    O título deve ser único e descritivo
                                </div>
                            </div>

                            <!-- Descrição -->
                            <div class="col-12 mb-4">
                                <label for="description" class="form-label fw-semibold">
                                    <i class="fas fa-align-left me-2 text-info"></i>Descrição
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="4" 
                                          placeholder="Descreva o propósito desta categoria (opcional)">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    Uma boa descrição ajuda a organizar melhor seus produtos
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                        <i class="fas fa-times me-2"></i>Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-warning btn-lg px-4 shadow-sm">
                                        <i class="fas fa-save me-2"></i>Atualizar Categoria
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Info Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-info-circle me-2 text-info"></i>Informações
                    </h5>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Criado em:</small>
                        <strong>{{ $category->created_at->format('d/m/Y H:i') }}</strong>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Última atualização:</small>
                        <strong>{{ $category->updated_at->format('d/m/Y H:i') }}</strong>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block">Listas associadas:</small>
                        <strong>{{ $category->shopping_lists->count() }} lista(s)</strong>
                    </div>
                    
                    <hr>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>Visualizar
                        </a>
                        
                        <form action="{{ route('categories.destroy', $category->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                <i class="fas fa-trash me-1"></i>Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}
</style>
@endsection