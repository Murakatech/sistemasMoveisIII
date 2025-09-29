# 📋 Sistema de Lista de Compras - Guia de Instalação

Este é um sistema completo de lista de compras desenvolvido em Laravel 10 com MySQL 8, utilizando Docker para facilitar a configuração.

## 🔧 Pré-requisitos

Antes de começar, certifique-se de ter instalado em sua máquina:

- **Docker Desktop** (versão mais recente)
- **Git** (para clonar o repositório)
- **Navegador web** (Chrome, Firefox, Edge, etc.)

### Para Windows:
- Docker Desktop for Windows
- Git for Windows

### Para Mac:
- Docker Desktop for Mac
- Git (via Homebrew: `brew install git`)

### Para Linux (Ubuntu/Debian):
```bash
# Instalar Docker
sudo apt update
sudo apt install docker.io docker-compose
sudo systemctl start docker
sudo systemctl enable docker

# Instalar Git
sudo apt install git
```

## 📁 Estrutura do Projeto

```
reges-webiii-main2/
├── app/                    # Código da aplicação Laravel
├── database/              # Migrations, seeders e factories
├── public/                # Arquivos públicos e imagens
├── resources/             # Views, CSS e JS
├── storage/               # Arquivos de storage
├── docker-compose.yml     # Configuração do Docker
├── .env.example          # Exemplo de configuração
└── INSTALACAO.md         # Este arquivo
```

## 🚀 Instalação Passo a Passo

### 1. Clonar ou Extrair o Projeto

Se você recebeu o projeto compactado:
```bash
# Extrair o arquivo ZIP para uma pasta de sua escolha
# Exemplo: C:\projetos\reges-webiii-main2 (Windows)
# Exemplo: ~/projetos/reges-webiii-main2 (Mac/Linux)
```

Se você tem acesso ao repositório Git:
```bash
git clone [URL_DO_REPOSITORIO]
cd reges-webiii-main2
```

### 2. Configurar o Arquivo de Ambiente

```bash
# Copiar o arquivo de exemplo
cp .env.example .env

# No Windows (PowerShell):
Copy-Item .env.example .env
```

**Editar o arquivo `.env` com as seguintes configurações:**

```env
APP_NAME="Lista de Compras"
APP_ENV=local
APP_KEY=base64:qObul5kdpjH6Hcqmyj/PRXPJbAk4JhVRG+eZSkL/cEo=
APP_DEBUG=true
APP_URL=http://localhost:8000

APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=pt_BR
APP_FAKER_LOCALE=pt_BR

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=trampix
DB_USERNAME=trampix_user
DB_PASSWORD=secret123

CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### 3. Iniciar os Containers Docker

```bash
# Construir e iniciar os containers
docker-compose up -d --build

# Aguardar alguns segundos para os containers iniciarem completamente
```

**Verificar se os containers estão rodando:**
```bash
docker-compose ps
```

Você deve ver algo como:
```
NAME                    STATUS
reges-webiii-main2-app-1    Up
reges-webiii-main2-db-1     Up
```

### 4. Configurar a Aplicação Laravel

```bash
# Entrar no container da aplicação
docker-compose exec app bash

# Instalar dependências do Composer
composer install

# Gerar chave da aplicação (se necessário)
php artisan key:generate

# Executar as migrations
php artisan migrate

# Executar os seeders (dados de exemplo)
php artisan db:seed

# Criar link simbólico para storage
php artisan storage:link

# Limpar cache
php artisan config:clear
php artisan cache:clear

# Sair do container
exit
```

### 5. Acessar a Aplicação

Abra seu navegador e acesse:
```
http://localhost:8000
```

## 👤 Usuários de Teste

O sistema vem com usuários pré-cadastrados para teste:

### Usuário de Teste:
- **Email:** joao@email.com
- **Senha:** 123456
- **Nome:** João Silva

## 📊 Dados de Exemplo

O sistema inclui:
- ✅ 5 categorias pré-cadastradas
- ✅ 42 produtos com imagens
- ✅ Listas de compras de exemplo
- ✅ Relacionamentos entre produtos e categorias

## 🛠️ Comandos Úteis

### Parar a aplicação:
```bash
docker-compose down
```

### Reiniciar a aplicação:
```bash
docker-compose restart
```

### Ver logs da aplicação:
```bash
docker-compose logs app
```

### Ver logs do banco de dados:
```bash
docker-compose logs db
```

### Executar comandos Laravel:
```bash
# Entrar no container
docker-compose exec app bash

# Exemplos de comandos
php artisan migrate:fresh --seed  # Resetar banco com dados
php artisan tinker                # Console interativo
php artisan route:list            # Listar todas as rotas
```

### Backup do banco de dados:
```bash
docker-compose exec db mysqldump -u trampix_user -psecret123 trampix > backup.sql
```

### Restaurar backup:
```bash
docker-compose exec -T db mysql -u trampix_user -psecret123 trampix < backup.sql
```

## 🔧 Solução de Problemas

### Problema: Porta 8000 já está em uso
```bash
# Verificar o que está usando a porta
netstat -ano | findstr :8000  # Windows
lsof -i :8000                 # Mac/Linux

# Alterar a porta no docker-compose.yml (linha ports: "8001:8000")
```

### Problema: Erro de permissão (Linux/Mac)
```bash
sudo chown -R $USER:$USER storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### Problema: Imagens não aparecem
```bash
docker-compose exec app php artisan storage:link
```

### Problema: Erro de conexão com banco
```bash
# Verificar se o container do banco está rodando
docker-compose ps

# Reiniciar os containers
docker-compose down
docker-compose up -d
```

## 📱 Funcionalidades do Sistema

### ✅ Autenticação
- Login e registro de usuários
- Recuperação de senha
- Perfil do usuário

### ✅ Categorias
- Criar, editar e excluir categorias
- Categorias com cores personalizadas

### ✅ Produtos
- Cadastro de produtos com imagens
- Upload de imagens
- Associação com categorias

### ✅ Listas de Compras
- Criar listas personalizadas
- Adicionar produtos às listas
- Marcar itens como comprados
- Cores personalizadas para listas

## 🌐 URLs Importantes

- **Aplicação:** http://localhost:8000
- **Login:** http://localhost:8000/login
- **Registro:** http://localhost:8000/register
- **Dashboard:** http://localhost:8000/dashboard
- **Produtos:** http://localhost:8000/products
- **Categorias:** http://localhost:8000/categories
- **Listas:** http://localhost:8000/shopping-lists

## 📞 Suporte

Se você encontrar algum problema durante a instalação:

1. Verifique se o Docker está rodando
2. Confirme se as portas 8000 e 3307 estão livres
3. Verifique os logs: `docker-compose logs`
4. Tente reiniciar: `docker-compose down && docker-compose up -d`

## 🔄 Atualizações

Para atualizar o projeto:
```bash
# Parar containers
docker-compose down

# Atualizar código (se usando Git)
git pull

# Reconstruir containers
docker-compose up -d --build

# Executar migrations (se houver)
docker-compose exec app php artisan migrate
```

---

**Desenvolvido com ❤️ usando Laravel 10 + Docker**

*Última atualização: 29/09/2025*