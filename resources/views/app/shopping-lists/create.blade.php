@extends('app.layouts.template')

@section('title', 'Nova Lista de Compras')

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
                                <i class="fas fa-plus me-2"></i>Nova Lista de Compras
                            </h2>
                            <p class="mb-0 opacity-75">Crie uma nova lista para organizar suas compras</p>
                        </div>
                        <a href="{{ route('shopping-lists.index') }}" class="btn btn-secondary btn-lg shadow-sm">
                            <i class="fas fa-arrow-left me-2"></i>Voltar
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

    <!-- Form Section -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('shopping-lists.store') }}" method="POST" id="createListForm">
                        @csrf
                        
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
                                       value="{{ old('title') }}" 
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
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($categories->count() == 0)
                                    <div class="form-text text-warning">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        <a href="{{ route('categories.create') }}" class="text-warning">Crie uma categoria primeiro</a>
                                    </div>
                                @endif
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
                                           value="{{ old('color', '#f59e0b') }}"
                                           style="width: 60px; height: 48px;">
                                    <span class="ms-3 text-muted" id="colorPreview">{{ old('color', '#f59e0b') }}</span>
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
                                          placeholder="Descreva o propósito desta lista ou adicione observações importantes...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text d-flex justify-content-between">
                                    <span>
                                        <i class="fas fa-info-circle me-1"></i>
                                        Adicione detalhes sobre esta lista de compras
                                    </span>
                                    <span class="text-muted" id="charCount">0 caracteres</span>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('shopping-lists.index') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-warning btn-lg shadow-sm" id="submitBtn">
                                        <i class="fas fa-save me-2"></i>Criar Lista
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

<style>
.bg-gradient-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
}

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
    const form = document.getElementById('createListForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function(e) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Criando...';
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