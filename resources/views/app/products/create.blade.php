@extends('app.layouts.template')

@section('title', 'Cadastrar Produto')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('products.index') }}" class="btn btn-light btn-sm me-3 rounded-pill">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <h2 class="mb-1 fw-bold">
                                <i class="fas fa-plus-circle me-2"></i>Novo Produto
                            </h2>
                            <p class="mb-0 opacity-75">Cadastre um novo produto em seu catálogo</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                        @csrf
                        
                        <!-- Product Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-light">
                                <i class="fas fa-tag me-2 text-primary"></i>Nome do Produto
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Digite o nome do produto..."
                                   required>
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Product Image -->
                        <div class="mb-4">
                            <label for="image" class="form-label fw-semibold text-light">
                                <i class="fas fa-image me-2 text-primary"></i>Imagem do Produto
                            </label>
                            <div class="image-upload-container">
                                <input type="file" 
                                       class="form-control @error('image') is-invalid @enderror" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*"
                                       style="display: none;">
                                
                                <div class="image-upload-area" onclick="document.getElementById('image').click()">
                                    <div class="upload-content">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                        <h5 class="text-light mb-2">Clique para selecionar uma imagem</h5>
                                        <p class="text-muted mb-0">Ou arraste e solte aqui</p>
                                        <small class="text-muted">Formatos aceitos: JPG, PNG, GIF (máx. 2MB)</small>
                                    </div>
                                    <div class="image-preview" style="display: none;">
                                        <img id="preview-img" src="" alt="Preview" class="img-fluid rounded">
                                        <div class="image-overlay">
                                            <button type="button" class="btn btn-light btn-sm" onclick="removeImage()">
                                                <i class="fas fa-times"></i> Remover
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                @error('image')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 justify-content-end pt-3 border-top">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fas fa-save me-2"></i>Salvar Produto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.image-upload-container {
    position: relative;
}

.image-upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 15px;
    padding: 3rem 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f8f9fa;
    position: relative;
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-upload-area:hover {
    border-color: var(--bs-primary);
    background: rgba(var(--bs-primary-rgb), 0.05);
}

.image-upload-area.dragover {
    border-color: var(--bs-primary);
    background: rgba(var(--bs-primary-rgb), 0.1);
    transform: scale(1.02);
}

.upload-content {
    transition: opacity 0.3s ease;
}

.image-preview {
    position: relative;
    max-width: 300px;
    margin: 0 auto;
}

.image-preview img {
    max-height: 200px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.image-overlay {
    position: absolute;
    top: 10px;
    right: 10px;
}

.form-control:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
}

.btn {
    border-radius: 10px;
    font-weight: 500;
}

.btn-lg {
    padding: 0.75rem 2rem;
}

@media (max-width: 768px) {
    .d-flex.gap-3 {
        flex-direction: column;
    }
    
    .btn-lg {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const uploadArea = document.querySelector('.image-upload-area');
    const uploadContent = document.querySelector('.upload-content');
    const imagePreview = document.querySelector('.image-preview');
    const previewImg = document.getElementById('preview-img');

    // Handle file input change
    imageInput.addEventListener('change', function(e) {
        handleFileSelect(e.target.files[0]);
    });

    // Handle drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith('image/')) {
                imageInput.files = files;
                handleFileSelect(file);
            }
        }
    });

    function handleFileSelect(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                uploadContent.style.display = 'none';
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    // Form validation
    document.getElementById('productForm').addEventListener('submit', function(e) {
        const nameInput = document.getElementById('name');
        if (!nameInput.value.trim()) {
            e.preventDefault();
            nameInput.focus();
            return false;
        }
    });
});

function removeImage() {
    const imageInput = document.getElementById('image');
    const uploadContent = document.querySelector('.upload-content');
    const imagePreview = document.querySelector('.image-preview');
    
    imageInput.value = '';
    uploadContent.style.display = 'block';
    imagePreview.style.display = 'none';
}
</script>
@endsection