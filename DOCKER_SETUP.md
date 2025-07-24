# Docker Setup for Roger Back-end Challenge

Este projeto foi configurado para rodar com Docker, incluindo PHP 8.4, MySQL, Redis e Nginx.

## Pré-requisitos

- Docker
- Docker Compose

## Como rodar o projeto

### 1. Clone o repositório e navegue até o diretório

```bash
git clone https://github.com/rogerarruda/roger-backend-challenge
cd roger-backend-challenge
```

### 2. Configure o ambiente

Copie o arquivo de ambiente para Docker:

```bash
cp .env.docker .env
```

### 3. Construa e inicie os containers

```bash
docker-compose up -d --build
```

### 4. Instale as dependências do PHP

```bash
docker-compose exec app composer install
```

### 5. Gere a chave da aplicação

```bash
docker-compose exec app php artisan key:generate
```

### 6. Execute as migrações do banco de dados

```bash
docker-compose exec app php artisan migrate
```

### 7. Execute a importação de dados

```bash
docker-compose exec app php artisan spotify:import-tracks
```

## Acessar a aplicação

A aplicação estará disponível em: http://localhost:8000

## Serviços disponíveis

- **Aplicação Laravel**: http://localhost:8000
- **MySQL**: localhost:3306
  - Database: `roger_backend_challenge`
  - Username: `roger_backend_challenge`
  - Password: `root`
- **Redis**: localhost:6379

## Como rodar os testes

### Executar todos os testes

```bash
docker-compose exec app php artisan test
```

### Executar testes com Pest

```bash
docker-compose exec app ./vendor/bin/pest
```

### Executar testes específicos

```bash
# Testes de Feature
docker-compose exec app php artisan test --testsuite=Feature

# Testes de Unit
docker-compose exec app php artisan test --testsuite=Unit

# Teste específico
docker-compose exec app php artisan test tests/Feature/TracksApiTest.php
```

## Comandos úteis

### Acessar o container da aplicação

```bash
docker-compose exec app bash
```

### Ver logs da aplicação

```bash
docker-compose logs app
```

### Ver logs de todos os serviços

```bash
docker-compose logs
```

### Parar os containers

```bash
docker-compose down
```

### Parar e remover volumes (cuidado: remove dados do banco)

```bash
docker-compose down -v
```

### Reconstruir os containers

```bash
docker-compose up -d --build --force-recreate
```

## Estrutura dos arquivos Docker

```
docker/
├── nginx/
│   └── conf.d/
│       └── app.conf          # Configuração do Nginx
├── php/
│   └── local.ini             # Configurações do PHP
└── mysql/
    └── my.cnf                # Configurações do MySQL
```

## Troubleshooting

### Problema de permissões

Se houver problemas de permissões, execute:

```bash
docker-compose exec app chown -R www:www /var/www
docker-compose exec app chmod -R 755 /var/www/storage
docker-compose exec app chmod -R 755 /var/www/bootstrap/cache
```

### Limpar cache da aplicação

```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

### Reinstalar dependências

```bash
docker-compose exec app rm -rf vendor
docker-compose exec app composer install
```
