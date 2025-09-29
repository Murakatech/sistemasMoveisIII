@echo off
echo ========================================
echo   INSTALACAO AUTOMATICA - LISTA DE COMPRAS
echo ========================================
echo.

echo [1/6] Verificando se o Docker esta rodando...
docker --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ERRO: Docker nao encontrado! Instale o Docker Desktop primeiro.
    echo Download: https://www.docker.com/products/docker-desktop
    pause
    exit /b 1
)
echo ✓ Docker encontrado!

echo.
echo [2/6] Copiando arquivo de configuracao...
if not exist .env (
    copy .env.example .env
    echo ✓ Arquivo .env criado!
) else (
    echo ✓ Arquivo .env ja existe!
)

echo.
echo [3/6] Iniciando containers Docker...
docker-compose down >nul 2>&1
docker-compose up -d --build
if %errorlevel% neq 0 (
    echo ERRO: Falha ao iniciar containers!
    pause
    exit /b 1
)
echo ✓ Containers iniciados!

echo.
echo [4/6] Aguardando containers ficarem prontos...
timeout /t 10 /nobreak >nul
echo ✓ Containers prontos!

echo.
echo [5/6] Configurando aplicacao Laravel...
docker-compose exec app composer install
docker-compose exec app php artisan key:generate --force
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan db:seed --force
docker-compose exec app php artisan storage:link
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
echo ✓ Laravel configurado!

echo.
echo [6/6] Verificando instalacao...
docker-compose ps
echo.

echo ========================================
echo   INSTALACAO CONCLUIDA COM SUCESSO!
echo ========================================
echo.
echo Acesse a aplicacao em: http://localhost:8000
echo.
echo Usuario de teste:
echo - Email: joao@email.com / Senha: 123456
echo.
echo Para parar a aplicacao: docker-compose down
echo Para reiniciar: docker-compose up -d
echo.
pause