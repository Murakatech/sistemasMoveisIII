<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
                --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            * {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            }

            body {
                background: var(--dark-bg);
                color: var(--text-primary);
                line-height: 1.6;
                min-height: 100vh;
            }

            .bg-gradient-primary {
                background: var(--gradient-primary);
            }

            .bg-gradient-secondary {
                background: var(--gradient-secondary);
            }

            .card {
                background: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: 12px;
                box-shadow: var(--shadow-lg);
                transition: all 0.3s ease;
            }

            .card:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-xl);
            }

            .card-header {
                background: transparent;
                border-bottom: 1px solid var(--border-color);
                font-weight: 600;
                color: var(--text-primary);
            }

            .card-body {
                color: var(--text-primary);
            }

            /* Correções de visibilidade para textos */
            .text-dark, .text-black {
                color: var(--text-primary) !important;
            }

            .text-muted {
                color: var(--text-secondary) !important;
            }

            /* Títulos e textos principais sempre visíveis */
            h1, h2, h3, h4, h5, h6 {
                color: var(--text-primary) !important;
            }

            /* Labels de formulário */
            .form-label {
                color: var(--text-primary) !important;
                font-weight: 600;
            }

            /* Textos em cards */
            .card-title {
                color: var(--text-primary) !important;
            }

            .card-text {
                color: var(--text-secondary) !important;
            }

            .btn {
                border-radius: 8px;
                font-weight: 500;
                padding: 0.5rem 1.25rem;
                transition: all 0.3s ease;
                border: none;
                position: relative;
                overflow: hidden;
            }

            .btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: left 0.5s;
            }

            .btn:hover::before {
                left: 100%;
            }

            .btn-primary {
                background: var(--gradient-primary);
                color: white;
                box-shadow: var(--shadow-md);
            }

            .btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: var(--shadow-lg);
                background: var(--gradient-primary);
                color: white;
            }

            .btn-success {
                background: var(--gradient-secondary);
                color: white;
                box-shadow: var(--shadow-md);
            }

            .btn-success:hover {
                transform: translateY(-1px);
                box-shadow: var(--shadow-lg);
                background: var(--gradient-secondary);
                color: white;
            }

            .btn-warning {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                color: white;
                box-shadow: var(--shadow-md);
            }

            .btn-warning:hover {
                transform: translateY(-1px);
                box-shadow: var(--shadow-lg);
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                color: white;
            }

            .btn-danger {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: white;
                box-shadow: var(--shadow-md);
            }

            .btn-danger:hover {
                transform: translateY(-1px);
                box-shadow: var(--shadow-lg);
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: white;
            }

            .btn-secondary {
                background: #475569;
                color: white;
                box-shadow: var(--shadow-md);
            }

            .btn-secondary:hover {
                transform: translateY(-1px);
                box-shadow: var(--shadow-lg);
                background: #334155;
                color: white;
            }

            .btn-info {
                background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
                color: white;
                box-shadow: var(--shadow-md);
            }

            .btn-info:hover {
                transform: translateY(-1px);
                box-shadow: var(--shadow-lg);
                background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
                color: white;
            }

            .form-control, .form-select {
                background: var(--card-bg);
                border: 1px solid var(--border-color);
                color: var(--text-primary);
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .form-control:focus, .form-select:focus {
                background: var(--card-bg);
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
                color: var(--text-primary);
            }

            /* Placeholder styles for better visibility */
            .form-control::placeholder {
                color: #94a3b8 !important;
                opacity: 1;
                font-weight: 400;
            }

            .form-control::-webkit-input-placeholder {
                color: #94a3b8 !important;
                opacity: 1;
                font-weight: 400;
            }

            .form-control::-moz-placeholder {
                color: #94a3b8 !important;
                opacity: 1;
                font-weight: 400;
            }

            .form-control:-ms-input-placeholder {
                color: #94a3b8 !important;
                opacity: 1;
                font-weight: 400;
            }

            .form-control:-moz-placeholder {
                color: #94a3b8 !important;
                opacity: 1;
                font-weight: 400;
            }

            /* Textarea placeholder styles */
            textarea.form-control::placeholder {
                color: #94a3b8 !important;
                opacity: 1;
                font-weight: 400;
            }

            textarea.form-control::-webkit-input-placeholder {
                color: #94a3b8 !important;
                opacity: 1;
                font-weight: 400;
            }

            textarea.form-control::-moz-placeholder {
                color: #94a3b8 !important;
                opacity: 1;
                font-weight: 400;
            }

            /* Form floating label adjustments */
            .form-floating > .form-control::placeholder {
                color: transparent;
            }

            .form-floating > .form-control:focus::placeholder {
                color: #94a3b8 !important;
                opacity: 0.6;
            }

            .form-floating > label {
                color: #94a3b8;
                font-weight: 500;
            }

            .form-floating > .form-control:focus ~ label,
            .form-floating > .form-control:not(:placeholder-shown) ~ label {
                color: var(--primary-color);
                font-weight: 600;
            }

            .table {
                background: var(--card-bg);
                border-radius: 12px;
                overflow: hidden;
                box-shadow: var(--shadow-lg);
            }

            .table th {
                background: var(--primary-color);
                color: white;
                border: none;
                font-weight: 600;
                padding: 1rem;
            }

            .table td {
                border-color: var(--border-color);
                padding: 1rem;
                vertical-align: middle;
            }

            .table tbody tr:hover {
                background: rgba(99, 102, 241, 0.1);
            }

            .alert {
                border-radius: 12px;
                border: none;
                box-shadow: var(--shadow-md);
            }

            .alert-success {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
                color: #10b981;
                border-left: 4px solid #10b981;
            }

            .alert-danger {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
                color: #ef4444;
                border-left: 4px solid #ef4444;
            }

            .navbar {
                background: var(--card-bg) !important;
                border-bottom: 1px solid var(--border-color);
                box-shadow: var(--shadow-md);
            }

            .navbar-brand {
                font-weight: 700;
                font-size: 1.5rem;
                background: var(--gradient-primary);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .nav-link {
                color: var(--text-secondary) !important;
                font-weight: 500;
                transition: all 0.3s ease;
                border-radius: 6px;
                margin: 0 0.25rem;
            }

            .nav-link:hover, .nav-link.active {
                color: var(--primary-color) !important;
                background: rgba(99, 102, 241, 0.1);
            }

            .page-header {
                background: var(--gradient-primary);
                color: white;
                padding: 2rem 0;
                margin-bottom: 2rem;
                border-radius: 0 0 24px 24px;
                box-shadow: var(--shadow-lg);
            }

            .stats-card {
                background: var(--card-bg);
                border-radius: 16px;
                padding: 1.5rem;
                border: 1px solid var(--border-color);
                box-shadow: var(--shadow-lg);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .stats-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: var(--gradient-primary);
            }

            .stats-card:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow-xl);
            }

            .img-thumbnail {
                border: 2px solid var(--border-color);
                border-radius: 12px;
                background: var(--card-bg);
            }

            .badge {
                border-radius: 6px;
                font-weight: 500;
            }

            .dropdown-menu {
                background: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: 12px;
                box-shadow: var(--shadow-xl);
            }

            .dropdown-item {
                color: var(--text-primary);
                transition: all 0.3s ease;
            }

            .dropdown-item:hover {
                background: rgba(99, 102, 241, 0.1);
                color: var(--primary-color);
            }

            .container-fluid {
                padding: 0 2rem;
            }

            @media (max-width: 768px) {
                .container-fluid {
                    padding: 0 1rem;
                }
                
                .btn {
                    padding: 0.375rem 1rem;
                    font-size: 0.875rem;
                }
            }
        </style>
        
        @yield('css')
        <title>@yield('title') | Shopping List Pro</title>
    </head>
    <body>

        @auth
            @includeIf('app.components.navbar');
        @endauth

        <div class="container-fluid">
            @yield('content')
        </div>

        @auth
            @includeIf('app.components.footer')
        @endauth

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        @yield('scripts')
    </body>
</html>
