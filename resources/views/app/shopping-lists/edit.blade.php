@extends('app.layouts.template')

@section('title', 'Editar Lista de Compras')

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
                                <i class="fas fa-edit me-2"></i>Editar Lista de Compras
                            </h2>
                            <p class="mb-0 opacity-75">Atualize as informações da sua lista</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('shopping-lists.show', $shoppingList) }}" class="btn btn-light btn-lg shadow-sm">
                                <i class="fas fa-eye me-2"></i>Visualizar
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

    <div class="row g-4">
        <!-- Preview da Lista Atual -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-eye me-2 text-primary"></i>Preview Atual
                    </h5>
                    
                    <div class="card border-0 mb-3" style="background: linear-gradient(135deg, {{ $shoppingList->color }} 0%, {{ $shoppingList->color }} 100%);">
                        <div class="card-body text-white">
                            <h6 class="mb-1">{{ $shoppingList->title }}</h6>
                            <small class="opacity-75">
                                <i class="fas fa-tag me-1"></i>{{ $shoppingList->category->title ?? 'Sem categoria' }}
                            </small>
                        </div>
                    </div>
                    
                    @if($shoppingList->description)
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Descrição Atual</h6>
                            <p class="text-light small">{{ $shoppingList->description }}</p>
                        </div>
                    @endif
                    
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <small class="text-muted d-block">Produtos</small>
                                <strong class="text-primary">{{ $shoppingList->products->count() }}</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <small class="text-muted d-block">Status</small>
                                <strong class="{{ $shoppingList->active ? 'text-success' : 'text-secondary' }}">
                                    {{ $shoppingList->active ? 'Ativa' : 'Inativa' }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form de Edição -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('shopping-lists.update', $shoppingList) }}" method="POST" id="editListForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4">
                            <!-- Título -->
                            <div class="col-12">
                                <label for="title" class="form-label fw-semibold">
                                    <i class="fas fa-heading me-2 text-warning"></i>Título da Lista
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $shoppingList->title) }}" 
                                       placeholder="Ex: Compras do Supermercado"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Escolha um nome descritivo para sua lista
                                </div>
                            </div>

                            <!-- Categoria -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label fw-semibold">
                                    <i class="fas fa-tag me-2 text-warning"></i>Categoria
                                </label>
                                <select class="form-select form-select-lg @error('category_id') is-invalid @enderror" 
                                        id="category_id" 
                                        name="category_id" 
                                        required>
                                    <option value="">Selecione uma categoria</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ old('category_id', $shoppingList->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Cor -->
                            <div class="col-md-6">
                                <label for="color" class="form-label fw-semibold">
                                    <i class="fas fa-palette me-2 text-warning"></i>Cor da Lista
                                </label>
                                <div class="d-flex align-items-center">
                                    <input type="color" 
                                           class="form-control form-control-color form-control-lg @error('color') is-invalid @enderror" 
                                           id="color" 
                                           name="color" 
                                           value="{{ old('color', $shoppingList->color ?? '#f59e0b') }}"
                                           style="width: 60px; height: 48px;">
                                    <span class="ms-3 text-muted" id="colorPreview">{{ old('color', $shoppingList->color ?? '#f59e0b') }}</span>
                                </div>
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Escolha uma cor para identificar facilmente sua lista
                                </div>
                            </div>

                            <!-- Descrição -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">
                                    <i class="fas fa-align-left me-2 text-warning"></i>Descrição (Opcional)
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="4" 
                                          placeholder="Descreva o propósito desta lista ou adicione observações importantes...">{{ old('description', $shoppingList->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text d-flex justify-content-between">
                                    <span>
                                        <i class="fas fa-info-circle me-1"></i>
                                        Adicione detalhes sobre esta lista de compras
                                    </span>
                                    <span class="text-muted" id="charCount">{{ strlen($shoppingList->description ?? '') }} caracteres</span>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('shopping-lists.show', $shoppingList) }}" class="btn btn-outline-secondary btn-lg">
                                            <i class="fas fa-times me-2"></i>Cancelar
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="fas fa-trash me-2"></i>Excluir
                                        </button>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-lg shadow-sm" id="submitBtn">
                                        <i class="fas fa-save me-2"></i>Salvar Alterações
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
                <p class="text-muted small">Esta ação não pode ser desfeita e todos os produtos associados serão removidos da lista.</p>
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
.form-control:focus,
.form-select:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
}

.btn-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border: none;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
    transform: translateY(-1px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for description
    const description = document.getElementById('description');
    const charCount = document.getElementById('charCount');
    
    description.addEventListener('input', function() {
        charCount.textContent = this.value.length + ' caracteres';
    });
    
    // Color preview
    const colorInput = document.getElementById('color');
    const colorPreview = document.getElementById('colorPreview');
    
    colorInput.addEventListener('input', function() {
        colorPreview.textContent = this.value;
        colorPreview.style.color = this.value;
    });
    
    // Form validation
    const form = document.getElementById('editListForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function(e) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Salvando...';
        submitBtn.disabled = true;
    });
    
    // Real-time validation feedback
    const inputs = form.querySelectorAll('input[required], select[required]');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
    });
});
</script>
@endsection