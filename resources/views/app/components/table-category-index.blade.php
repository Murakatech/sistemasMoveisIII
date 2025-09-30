<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm me-3 rounded-pill">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <div>
                                <h2 class="mb-1 fw-bold">
                                    <i class="fas fa-tags me-2"></i>Categorias
                                </h2>
                                <p class="mb-0 opacity-75">Gerencie suas categorias de produtos</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('categories.create') }}" class="btn btn-success btn-sm rounded-pill shadow-sm">
                                <i class="fas fa-plus me-1"></i>Nova Categoria
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($categories->count() > 0)
        <!-- Categories Grid -->
        <div class="row">
            @foreach($categories as $category)
                <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 category-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="category-icon">
                                    <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-tag text-white fa-lg"></i>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" 
                                            type="button" 
                                            data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('categories.show', $category->id) }}">
                                                <i class="fas fa-eye me-2"></i>Visualizar
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}">
                                                <i class="fas fa-edit me-2"></i>Editar
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('categories.destroy', $category->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash me-2"></i>Excluir
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="category-content">
                                <h5 class="card-title fw-bold text-light mb-2">{{ $category->title }}</h5>
                                <p class="card-text text-muted mb-3">
                                    {{ $category->description ? Str::limit($category->description, 80) : 'Sem descrição disponível' }}
                                </p>
                                
                                <div class="category-meta">
                                    <small class="text-muted d-flex align-items-center mb-2">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        Criado em {{ $category->created_at->format('d/m/Y') }}
                                    </small>
                                    <small class="text-muted d-flex align-items-center">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $category->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                            
                            <div class="category-actions mt-3 pt-3 border-top">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('categories.show', $category->id) }}" 
                                       class="btn btn-outline-primary btn-sm flex-fill">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </a>
                                    <a href="{{ route('categories.edit', $category->id) }}" 
                                       class="btn btn-outline-warning btn-sm flex-fill">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination if needed -->
        @if(method_exists($categories, 'links'))
            <div class="row mt-4">
                <div class="col-12">
                    {{ $categories->links('pagination.custom') }}
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body py-5">
                        <div class="empty-state-icon mb-4">
                            <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-tags text-white fa-2x"></i>
                            </div>
                        </div>
                        <h4 class="text-light mb-3">Nenhuma categoria encontrada</h4>
                        <p class="text-muted mb-4">
                            Você ainda não criou nenhuma categoria. Comece criando sua primeira categoria para organizar seus produtos.
                        </p>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                            <i class="fas fa-plus me-2"></i>Criar Primeira Categoria
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.category-card {
    transition: all 0.3s ease;
    border-radius: 15px;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.category-icon {
    transition: transform 0.3s ease;
}

.category-card:hover .category-icon {
    transform: scale(1.1);
}

.category-content {
    min-height: 120px;
}

.category-actions .btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.category-actions .btn:hover {
    transform: translateY(-2px);
}

.dropdown-menu {
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.dropdown-item {
    border-radius: 8px;
    margin: 2px 8px;
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background: rgba(var(--bs-primary-rgb), 0.1);
    transform: translateX(5px);
}

.empty-state-icon {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@media (max-width: 768px) {
    .category-card {
        margin-bottom: 1rem;
    }
    
    .category-actions .btn {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
    }
    
    .d-flex.gap-2 {
        flex-direction: column;
        gap: 0.5rem !important;
    }
    
    .category-actions .d-flex {
        flex-direction: column;
    }
    
    .category-actions .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>