<!-- Header com gradiente -->
<div class="page-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2 fw-bold">
                    <i class="fas fa-tachometer-alt me-3"></i>Dashboard
                </h1>
                <p class="mb-0 opacity-75">
                    Seja bem-vindo, <strong>{{ auth()->user()->name }}</strong>! 
                    Aqui está um resumo das suas atividades.
                </p>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex align-items-center justify-content-end">
                    <div class="me-3">
                        <small class="opacity-75">Último acesso</small><br>
                        <strong>{{ now()->format('d/m/Y H:i') }}</strong>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-circle p-3">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cards de Estatísticas -->
<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="stats-card text-center">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h3 class="mb-0 fw-bold text-primary">{{ auth()->user()->products()->count() }}</h3>
                    <p class="mb-0 text-light">Produtos</p>
                </div>
                <div class="bg-gradient-primary rounded-circle p-3">
                    <i class="fas fa-box text-white fa-2x"></i>
                </div>
            </div>
            <div class="progress" style="height: 4px;">
                <div class="progress-bar bg-gradient-primary" style="width: 75%"></div>
            </div>
            <small class="text-muted mt-2 d-block">
                <i class="fas fa-arrow-up text-success me-1"></i>
                +12% este mês
            </small>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stats-card text-center">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h3 class="mb-0 fw-bold text-success">{{ auth()->user()->categories()->count() }}</h3>
                    <p class="mb-0 text-light">Categorias</p>
                </div>
                <div class="bg-gradient-secondary rounded-circle p-3">
                    <i class="fas fa-tags text-white fa-2x"></i>
                </div>
            </div>
            <div class="progress" style="height: 4px;">
                <div class="progress-bar bg-gradient-secondary" style="width: 60%"></div>
            </div>
            <small class="text-muted mt-2 d-block">
                <i class="fas fa-arrow-up text-success me-1"></i>
                +8% este mês
            </small>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stats-card text-center">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h3 class="mb-0 fw-bold text-warning">{{ auth()->user()->shoppingLists()->count() }}</h3>
                    <p class="mb-0 text-light">Listas</p>
                </div>
                <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);" class="rounded-circle p-3">
                    <i class="fas fa-list text-white fa-2x"></i>
                </div>
            </div>
            <div class="progress" style="height: 4px;">
                <div class="progress-bar" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); width: 45%"></div>
            </div>
            <small class="text-muted mt-2 d-block">
                <i class="fas fa-arrow-down text-danger me-1"></i>
                -3% este mês
            </small>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stats-card text-center">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h3 class="mb-0 fw-bold text-info">{{ now()->diffInDays(auth()->user()->created_at) }}</h3>
                    <p class="mb-0 text-light">Dias Ativo</p>
                </div>
                <div class="rounded-circle p-3" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                    <i class="fas fa-calendar text-white fa-2x"></i>
                </div>
            </div>
            <div class="progress" style="height: 4px;">
                <div class="progress-bar" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); width: 90%"></div>
            </div>
            <small class="text-muted mt-2 d-block">
                <i class="fas fa-check text-success me-1"></i>
                Usuário ativo
            </small>
        </div>
    </div>
</div>

<!-- Ações Rápidas -->
<div class="row g-4 mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2 text-warning"></i>
                        Ações Rápidas
                    </h5>
                    <span class="badge bg-gradient-primary">Novidades</span>
                </div>
                
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('products.create') }}" class="text-decoration-none">
                            <div class="d-flex align-items-center p-3 bg-gradient-primary bg-opacity-10 rounded-3 h-100 hover-lift">
                                <div class="bg-gradient-primary rounded-circle p-3 me-3">
                                    <i class="fas fa-plus text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-primary">Novo Produto</h6>
                                    <small class="text-light">Adicionar produto</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('categories.create') }}" class="text-decoration-none">
                            <div class="d-flex align-items-center p-3 bg-gradient-secondary bg-opacity-10 rounded-3 h-100 hover-lift">
                                <div class="bg-gradient-secondary rounded-circle p-3 me-3">
                                    <i class="fas fa-tag text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-success">Nova Categoria</h6>
                                    <small class="text-light">Organizar produtos</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('shopping-lists.create') }}" class="text-decoration-none">
                            <div class="d-flex align-items-center p-3 bg-warning bg-opacity-10 rounded-3 h-100 hover-lift">
                                <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                                    <i class="fas fa-shopping-cart text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-warning">Nova Lista</h6>
                                    <small class="text-light">Criar lista de compras</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('products.index') }}" class="text-decoration-none">
                            <div class="d-flex align-items-center p-3 bg-info bg-opacity-10 rounded-3 h-100 hover-lift">
                                <div class="rounded-circle p-3 me-3" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                                    <i class="fas fa-search text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-info">Ver Produtos</h6>
                                    <small class="text-light">Visualizar todos</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Produtos Recentes -->
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock me-2 text-primary"></i>
                        Produtos Recentes
                    </h5>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                        Ver Todos <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                
                @php
                    $recentProducts = auth()->user()->products()->latest()->take(5)->get();
                @endphp
                
                @if($recentProducts->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentProducts as $product)
                            <div class="list-group-item border-0 px-0 d-flex align-items-center">
                                <div class="me-3">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="rounded" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-gradient-primary rounded d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-box text-white"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $product->name }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $product->created_at->format('d/m/Y H:i') }}
                                    </small>
                                </div>
                                <div>
                                    <a href="{{ route('products.show', $product) }}" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-box fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">Nenhum produto encontrado</h6>
                        <p class="text-muted mb-3">Comece criando seu primeiro produto!</p>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Criar Produto
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-chart-pie me-2 text-success"></i>
                    Resumo da Conta
                </h5>
                
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted">Perfil Completo</span>
                        <span class="fw-bold text-success">85%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-gradient-secondary" style="width: 85%"></div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h6 class="mb-3">Informações da Conta</h6>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-user text-primary me-2"></i>
                        <small class="text-muted">Nome:</small>
                        <span class="ms-auto">{{ auth()->user()->name }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <small class="text-muted">Email:</small>
                        <span class="ms-auto">{{ Str::limit(auth()->user()->email, 20) }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-calendar text-primary me-2"></i>
                        <small class="text-muted">Membro desde:</small>
                        <span class="ms-auto">{{ auth()->user()->created_at->format('M/Y') }}</span>
                    </div>
                </div>
                
                <div class="d-grid">
                    <a href="#" class="btn btn-outline-primary">
                        <i class="fas fa-cog me-2"></i>Configurações
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}
</style>
