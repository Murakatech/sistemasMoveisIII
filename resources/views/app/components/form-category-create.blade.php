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
                                    <i class="fas fa-plus-circle me-2"></i>Nova Categoria
                                </h2>
                                <p class="mb-0 opacity-75">Crie uma nova categoria para organizar seus produtos</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-light btn-sm rounded-pill">
                                <i class="fas fa-list me-1"></i>Ver Categorias
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

    <!-- Form Section -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-4">
                    <div class="text-center">
                        <div class="category-form-icon mb-3">
                            <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-tag text-white fa-lg"></i>
                            </div>
                        </div>
                        <h4 class="text-light fw-bold mb-2">Criar Nova Categoria</h4>
                        <p class="text-muted mb-0">Preencha os campos abaixo para criar uma nova categoria</p>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('categories.store') }}" method="POST" id="categoryForm">
                        @csrf
                        
                        <!-- Title Field -->
                        <div class="form-group mb-4">
                            <label for="title" class="form-label fw-semibold text-light mb-2">
                                <i class="fas fa-heading me-1"></i>Título da Categoria
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-tag text-muted"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-start-0 @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       placeholder="Digite o título da categoria"
                                       value="{{ old('title') }}"
                                       required>
                            </div>
                            @error('title')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div class="form-group mb-4">
                            <label for="description" class="form-label fw-semibold text-light mb-2">
                                <i class="fas fa-align-left me-1"></i>Descrição
                                <small class="text-muted">(opcional)</small>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 align-items-start pt-3">
                                    <i class="fas fa-file-alt text-muted"></i>
                                </span>
                                <textarea class="form-control border-start-0 @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="4"
                                          placeholder="Digite uma descrição para a categoria (opcional)">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Uma boa descrição ajuda a identificar o propósito da categoria
                            </small>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-actions pt-3 border-top">
                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-primary flex-fill rounded-pill shadow-sm">
                                    <i class="fas fa-save me-2"></i>Criar Categoria
                                </button>
                                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary flex-fill rounded-pill">
                                    <i class="fas fa-times me-2"></i>Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.category-form-icon {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.input-group-text {
    border-radius: 12px 0 0 12px;
    border-color: #e9ecef;
}

.form-control {
    border-radius: 0 12px 12px 0;
    border-color: #e9ecef;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
    transform: translateY(-2px);
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.form-control.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.form-label {
    color: #495057;
    margin-bottom: 0.5rem;
}

.form-actions .btn {
    padding: 0.75rem 2rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.form-actions .btn:hover {
    transform: translateY(-2px);
}

.form-actions .btn-primary {
    background: linear-gradient(135deg, var(--bs-primary), #0056b3);
    border: none;
}

.form-actions .btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, var(--bs-primary));
    box-shadow: 0 8px 25px rgba(var(--bs-primary-rgb), 0.3);
}

.card {
    border-radius: 20px;
    overflow: hidden;
}

.card-header {
    border-radius: 20px 20px 0 0;
}

.alert {
    border-radius: 15px;
    border: none;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
}

@media (max-width: 768px) {
    .form-actions .d-flex {
        flex-direction: column;
    }
    
    .form-actions .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
    
    .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

/* Form validation animations */
.form-control.is-invalid {
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* Loading state for form submission */
.btn[type="submit"]:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn[type="submit"]:disabled::after {
    content: "";
    display: inline-block;
    width: 1rem;
    height: 1rem;
    margin-left: 0.5rem;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('categoryForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Form submission handling
    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Criando...';
    });
    
    // Real-time validation feedback
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    
    titleInput.addEventListener('input', function() {
        if (this.value.length > 0) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } else {
            this.classList.remove('is-valid');
        }
    });
    
    // Character counter for description
    const maxLength = 255;
    const charCounter = document.createElement('small');
    charCounter.className = 'form-text text-muted mt-1';
    charCounter.innerHTML = `<i class="fas fa-keyboard me-1"></i>0/${maxLength} caracteres`;
    descriptionInput.parentNode.parentNode.appendChild(charCounter);
    
    descriptionInput.addEventListener('input', function() {
        const length = this.value.length;
        charCounter.innerHTML = `<i class="fas fa-keyboard me-1"></i>${length}/${maxLength} caracteres`;
        
        if (length > maxLength * 0.9) {
            charCounter.classList.add('text-warning');
            charCounter.classList.remove('text-muted');
        } else {
            charCounter.classList.add('text-muted');
            charCounter.classList.remove('text-warning');
        }
    });
});
</script>
