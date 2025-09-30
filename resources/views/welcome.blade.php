<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Compras - Bem-vindo</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #f1f5f9;
            --accent-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --border-color: #334155;
            --gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --gradient-secondary: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: var(--dark-bg);
            min-height: 100vh;
            color: var(--text-primary);
        }
        
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .welcome-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-color);
        }
        
        .logo-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            box-shadow: var(--shadow-lg);
        }
        
        .btn-primary-custom {
            background: var(--gradient-primary);
            border: none;
            border-radius: 50px;
            padding: 12px 40px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-lg);
            color: white;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
            background: var(--gradient-primary);
            color: white;
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
        }
        
        .feature-card {
            text-align: center;
            padding: 2rem 1rem;
            border-radius: 15px;
            background: rgba(99, 102, 241, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.2);
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .shape {
            position: absolute;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .text-gradient {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .text-muted {
            color: var(--text-secondary) !important;
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="welcome-card p-5">
                        <!-- Logo -->
                        <div class="logo-icon">
                            <i class="bi bi-cart-check text-white" style="font-size: 2.5rem;"></i>
                        </div>
                        
                        <!-- Título Principal -->
                        <h1 class="text-center mb-4 text-gradient fw-bold" style="font-size: 2.5rem;">
                            Lista de Compras
                        </h1>
                        
                        <!-- Subtítulo -->
                        <p class="text-center text-muted mb-5 fs-5">
                            Organize suas compras de forma inteligente e nunca mais esqueça um item importante!
                        </p>
                        
                        <!-- Botão Principal -->
                        <div class="text-center mb-5">
                            <a href="{{ route('login') }}" class="btn btn-primary-custom btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Entrar no Sistema
                            </a>
                        </div>
                        
                        <!-- Recursos -->
                        <div class="row g-4 mt-4">
                            <div class="col-md-6">
                                <div class="feature-card">
                                    <div class="feature-icon">
                                        <i class="bi bi-list-check"></i>
                                    </div>
                                    <h5 class="fw-bold text-gradient">Listas Organizadas</h5>
                                    <p class="text-muted small">Crie e gerencie suas listas de compras de forma prática e eficiente</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-card">
                                    <div class="feature-icon">
                                        <i class="bi bi-tags"></i>
                                    </div>
                                    <h5 class="fw-bold text-gradient">Categorias</h5>
                                    <p class="text-muted small">Organize produtos por categorias para facilitar suas compras</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Link para Cadastro -->
                        <div class="text-center mt-4">
                            <p class="text-muted">
                                Ainda não tem uma conta? 
                                <a href="{{ route('user.create') }}" class="text-decoration-none fw-bold text-gradient">
                                    Cadastre-se aqui
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Auto-redirect script (opcional) -->
    <script>
        // Redireciona automaticamente após 10 segundos (opcional)
        // setTimeout(function() {
        //     window.location.href = "{{ route('login') }}";
        // }, 10000);
    </script>
</body>
</html>
