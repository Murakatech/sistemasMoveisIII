<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark shadow-lg">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            <i class="fas fa-shopping-cart me-2"></i>Shopping List
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="navbarDropdownCategories" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-tags me-1"></i>Categoria
                    </a>
                    <ul class="dropdown-menu dropdown-menu-modern" aria-labelledby="navbarDropdownCategories">
                        <li><a class="dropdown-item" href="{{ route('categories.create') }}">
                            <i class="fas fa-plus me-2"></i>Cadastrar
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('categories.index') }}">
                            <i class="fas fa-list me-2"></i>Visualizar
                        </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="navbarDropdownProducts" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-box me-1"></i>Produto
                    </a>
                    <ul class="dropdown-menu dropdown-menu-modern" aria-labelledby="navbarDropdownProducts">
                        <li><a class="dropdown-item" href="{{ route('products.create') }}">
                            <i class="fas fa-plus me-2"></i>Cadastrar
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('products.index') }}">
                            <i class="fas fa-search me-2"></i>Visualizar
                        </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="navbarDropdownLists" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-clipboard-list me-1"></i>Lista
                    </a>
                    <ul class="dropdown-menu dropdown-menu-modern" aria-labelledby="navbarDropdownLists">
                        <li><a class="dropdown-item" href="{{ route('shopping-lists.create') }}">
                            <i class="fas fa-plus me-2"></i>Cadastrar
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('shopping-lists.index') }}">
                            <i class="fas fa-eye me-2"></i>Visualizar
                        </a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-modern dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                        <li><a class="dropdown-item" href="{{ route('user.edit') }}">
                            <i class="fas fa-user-edit me-2"></i>Perfil
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt me-2"></i>Sair
                        </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
.navbar-brand {
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.navbar-brand:hover {
    transform: scale(1.05);
}

.nav-link {
    font-weight: 500;
    transition: all 0.3s ease;
    border-radius: 8px;
    margin: 0 2px;
    color: #ffffff !important;
}

.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-1px);
    color: #ffffff !important;
}

.nav-link:focus,
.nav-link:active {
    color: #ffffff !important;
    background-color: rgba(255, 255, 255, 0.15);
}

.dropdown-menu-modern {
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    border-radius: 12px;
    padding: 0.5rem 0;
    margin-top: 0.5rem;
    background: #fff;
    backdrop-filter: blur(10px);
}

.dropdown-item {
    padding: 0.75rem 1.25rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border-radius: 8px;
    margin: 0 0.5rem;
    color: #212529 !important;
}

.dropdown-item:hover {
    background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
    color: white !important;
    transform: translateX(5px);
}

.dropdown-item:focus,
.dropdown-item:active {
    background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
    color: white !important;
}

.dropdown-item.text-danger:hover {
    background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
    color: white;
}

.dropdown-divider {
    margin: 0.5rem 1rem;
    border-color: #e9ecef;
}

.navbar-toggler {
    padding: 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.navbar-toggler:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.navbar-toggler:focus {
    box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
}

@media (max-width: 991.98px) {
    .navbar-nav {
        padding: 1rem 0;
    }
    
    .nav-link {
        padding: 0.75rem 1rem;
        margin: 0.25rem 0;
    }
    
    .dropdown-menu-modern {
        position: static !important;
        transform: none !important;
        box-shadow: none;
        border: 1px solid #dee2e6;
        margin-top: 0.5rem;
        margin-left: 1rem;
    }
}
</style>
