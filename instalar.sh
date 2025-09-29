#!/bin/bash

echo "========================================"
echo "  INSTALACAO AUTOMATICA - LISTA DE COMPRAS"
echo "========================================"
echo

echo "[1/6] Verificando se o Docker esta rodando..."
if ! command -v docker &> /dev/null; then
    echo "ERRO: Docker nao encontrado! Instale o Docker primeiro."
    echo "Ubuntu/Debian: sudo apt install docker.io docker-compose"
    echo "Mac: brew install docker docker-compose"
    exit 1
fi
echo "✓ Docker encontrado!"

echo
echo "[2/6] Copiando arquivo de configuracao..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✓ Arquivo .env criado!"
else
    echo "✓ Arquivo .env ja existe!"
fi

echo
echo "[3/6] Iniciando containers Docker..."
docker-compose down > /dev/null 2>&1
docker-compose up -d --build
if [ $? -ne 0 ]; then
    echo "ERRO: Falha ao iniciar containers!"
    exit 1
fi
echo "✓ Containers iniciados!"

echo
echo "[4/6] Aguardando containers ficarem prontos..."
sleep 10
echo "✓ Containers prontos!"

echo
echo "[5/6] Configurando aplicacao Laravel..."
docker-compose exec app composer install
docker-compose exec app php artisan key:generate --force
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan db:seed --force
docker-compose exec app php artisan storage:link
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
echo "✓ Laravel configurado!"

echo
echo "[6/6] Verificando instalacao..."
docker-compose ps
echo

echo "========================================"
echo "  INSTALACAO CONCLUIDA COM SUCESSO!"
echo "========================================"
echo
echo "Acesse a aplicacao em: http://localhost:8000"
echo
echo "Usuario de teste:"
echo "- Email: joao@email.com / Senha: 123456"
echo
echo "Para parar a aplicacao: docker-compose down"
echo "Para reiniciar: docker-compose up -d"
echo