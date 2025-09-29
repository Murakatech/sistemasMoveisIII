@extends('app.layouts.template')

@section('title', 'Visualizar Produto')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('products.index') }}" class="btn btn-light btn-sm me-3 rounded-pill">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <div>
                                <h2 class="mb-1 fw-bold">
                                    <i class="fas fa-eye me-2"></i>{{ $product->name }}
                                </h2>
                                <p class="mb-0 opacity-75">Detalhes do produto</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm rounded-pill shadow-sm">
                                <i class="fas fa-edit me-1"></i>Editar
                            </a>
                            <button type="button" class="btn btn-danger btn-sm rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fas fa-trash me-1"></i>Excluir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Product Image -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-0">
                    @if($product->image)
                        <div class="product-image-container">
                            <img src="{{ asset($product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="img-fluid w-100 product-main-image"
                                 id="mainImage">
                        </div>
                    @else
                        <div class="product-placeholder-large">
                            <i class="fas fa-image fa-5x text-muted mb-3"></i>
                            <h5 class="text-muted">Sem imagem</h5>
                            <p class="text-muted">Este produto não possui imagem</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="product-details">
                        <h3 class="fw-bold text-light mb-4">{{ $product->name }}</h3>
                        
                        <!-- Product Info Cards -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-icon">
                                        <i class="fas fa-calendar-plus text-success"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="text-muted mb-1">Data de Criação</h6>
                                        <p class="fw-semibold mb-0">{{ $product->created_at->format('d/m/Y') }}</p>
                                        <small class="text-muted">{{ $product->created_at->format('H:i') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-icon">
                                        <i class="fas fa-clock text-warning"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="text-muted mb-1">Última Atualização</h6>
                                        <p class="fw-semibold mb-0">{{ $product->updated_at->format('d/m/Y') }}</p>
                                        <small class="text-muted">{{ $product->updated_at->format('H:i') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div class="additional-info">
                            <div class="info-item">
                                <i class="fas fa-user text-primary me-2"></i>
                                <span class="text-muted">Criado por:</span>
                                <span class="fw-semibold">{{ auth()->user()->name }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-hashtag text-primary me-2"></i>
                                <span class="text-muted">ID do Produto:</span>
                                <span class="fw-semibold">#{{ $product->id }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons mt-4 pt-4 border-top">
                            <div class="d-flex gap-3 flex-wrap">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-lg flex-fill">
                                    <i class="fas fa-edit me-2"></i>Editar Produto
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fas fa-trash me-2"></i>Excluir
                                </button>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg w-100">
                                    <i class="fas fa-arrow-left me-2"></i>Voltar para Lista
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <p class="text-muted mb-3">
                    Tem certeza que deseja excluir o produto <strong>"{{ $product->name }}"</strong>?
                </p>
                <div class="alert alert-warning border-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Esta ação não pode ser desfeita.
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Sim, Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.product-image-container {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    background: #f8f9fa;
}

.product-main-image {
    border-radius: 15px;
    max-height: 500px;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.product-main-image:hover {
    transform: scale(1.02);
}

.product-placeholder-large {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 400px;
    background: #f8f9fa;
    border-radius: 15px;
    margin: 1rem;
}

.info-card {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 12px;
    border-left: 4px solid var(--bs-primary);
    transition: all 0.3s ease;
}

.info-card:hover {
    background: #e9ecef;
    transform: translateY(-2px);
}

.info-icon {
    margin-right: 1rem;
    font-size: 1.5rem;
}

.info-content h6 {
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.info-content p {
    font-size: 1.1rem;
    margin-bottom: 0;
}

.additional-info {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
}

.info-item:last-child {
    margin-bottom: 0;
}

.action-buttons .btn {
    border-radius: 10px;
    font-weight: 500;
}

.modal-content {
    border-radius: 15px;
}

.modal-header .modal-title {
    color: var(--bs-danger);
}

@media (max-width: 768px) {
    .action-buttons .d-flex {
        flex-direction: column;
    }
    
    .action-buttons .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
    
    .info-card {
        text-align: center;
        flex-direction: column;
    }
    
    .info-icon {
        margin-right: 0;
        margin-bottom: 0.5rem;
    }
}

/* Image zoom effect */
.product-main-image {
    cursor: zoom-in;
}

.product-main-image.zoomed {
    cursor: zoom-out;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(1.5);
    z-index: 9999;
    max-width: 90vw;
    max-height: 90vh;
    border-radius: 15px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}

.zoom-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.8);
    z-index: 9998;
    display: none;
}

.zoom-overlay.active {
    display: block;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('mainImage');
    
    if (mainImage) {
        mainImage.addEventListener('click', function() {
            // Create overlay
            const overlay = document.createElement('div');
            overlay.className = 'zoom-overlay active';
            document.body.appendChild(overlay);
            
            // Add zoom class
            mainImage.classList.add('zoomed');
            document.body.style.overflow = 'hidden';
            
            // Close on overlay click
            overlay.addEventListener('click', function() {
                mainImage.classList.remove('zoomed');
                document.body.removeChild(overlay);
                document.body.style.overflow = 'auto';
            });
            
            // Close on image click
            mainImage.addEventListener('click', function closeZoom() {
                mainImage.classList.remove('zoomed');
                document.body.removeChild(overlay);
                document.body.style.overflow = 'auto';
                mainImage.removeEventListener('click', closeZoom);
            });
        });
    }
});
</script>
@endsection