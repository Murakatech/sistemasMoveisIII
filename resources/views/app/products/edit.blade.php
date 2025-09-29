@extends('app.layouts.template')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-light btn-sm me-3 rounded-pill">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <div>
                                <h2 class="mb-1 fw-bold">
                                    <i class="fas fa-edit me-2"></i>Editar Produto
                                </h2>
                                <p class="mb-0 opacity-75">{{ $product->name }}</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm rounded-pill shadow-sm">
                                <i class="fas fa-eye me-1"></i>Visualizar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="row">
                <!-- Current Product Preview -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-dark border-0">
                            <h6 class="mb-0 fw-semibold text-light">
                                <i class="fas fa-image me-2 text-primary"></i>Produto Atual
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            @if($product->image)
                                <div class="current-image-container">
                                    <img src="{{ asset($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-fluid rounded current-product-image">
                                </div>
                                <div class="mt-3 text-center">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Imagem atual do produto
                                    </small>
                                </div>
                            @else
                                <div class="no-image-placeholder">
                                    <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                    <p class="text-muted mb-0">Sem imagem</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Edit Form -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" id="editProductForm">
                                @csrf
                                @method('PUT')
                                
                                <!-- Product Name -->
                                <div class="mb-4">
                                    <label for="name" class="form-label fw-semibold text-light">
                                        <i class="fas fa-tag me-2 text-primary"></i>Nome do Produto
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $product->name) }}" 
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
                                        <i class="fas fa-camera me-2 text-primary"></i>Nova Imagem do Produto
                                        <small class="text-muted fw-normal">(opcional)</small>
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
                                                <h6 class="text-light mb-2">Clique para selecionar nova imagem</h6>
                                                <p class="text-muted mb-0 small">Ou arraste e solte aqui</p>
                                                <small class="text-muted">Deixe em branco para manter a imagem atual</small>
                                            </div>
                                            <div class="image-preview" style="display: none;">
                                                <img id="preview-img" src="" alt="Preview" class="img-fluid rounded">
                                                <div class="image-overlay">
                                                    <button type="button" class="btn btn-light btn-sm" onclick="removeNewImage()">
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
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Cancelar
                                    </a>
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-info btn-lg">
                                        <i class="fas fa-list me-2"></i>Lista
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                        <i class="fas fa-save me-2"></i>Atualizar Produto
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.current-image-container {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    background: #f8f9fa;
}

.current-product-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 12px;
}

.no-image-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 250px;
    background: #f8f9fa;
    border-radius: 12px;
    border: 2px dashed #dee2e6;
}

.image-upload-container {
    position: relative;
}

.image-upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 15px;
    padding: 2rem 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f8f9fa;
    position: relative;
    min-height: 180px;
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
    max-width: 250px;
    margin: 0 auto;
}

.image-preview img {
    max-height: 150px;
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

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

@media (max-width: 768px) {
    .d-flex.gap-3 {
        flex-direction: column;
    }
    
    .btn-lg {
        width: 100%;
    }
    
    .current-product-image {
        height: 200px;
    }
    
    .no-image-placeholder {
        height: 200px;
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
    document.getElementById('editProductForm').addEventListener('submit', function(e) {
        const nameInput = document.getElementById('name');
        if (!nameInput.value.trim()) {
            e.preventDefault();
            nameInput.focus();
            return false;
        }
    });
});

function removeNewImage() {
    const imageInput = document.getElementById('image');
    const uploadContent = document.querySelector('.upload-content');
    const imagePreview = document.querySelector('.image-preview');
    
    imageInput.value = '';
    uploadContent.style.display = 'block';
    imagePreview.style.display = 'none';
}
</script>
@endsection