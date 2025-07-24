#!/bin/bash

echo "Configurando o projeto Roger Backend Challenge com Docker..."

if ! command -v docker &> /dev/null; then
    echo "[ERRO] Docker não está instalado. Por favor, instale o Docker primeiro."
    exit 1
fi

if ! command -v docker-compose &> /dev/null; then
    echo "[ERRO] Docker Compose não está instalado. Por favor, instale o Docker Compose primeiro."
    exit 1
fi

echo "[OK] Docker e Docker Compose encontrados!"

echo "Copiando arquivo de ambiente..."
cp .env.docker .env

echo "Construindo e iniciando containers..."
docker-compose up -d --build

echo "Aguardando containers iniciarem..."
sleep 10

echo "Instalando dependências do PHP..."
docker-compose exec app composer install

echo "Gerando chave da aplicação..."
docker-compose exec app php artisan key:generate

echo "Executando migrações do banco de dados..."
docker-compose exec app php artisan migrate

echo "Importando dados iniciais..."
docker-compose exec app php artisan spotify:import-tracks

echo "Configurando permissões..."
docker-compose exec app chown -R www:www /var/www
docker-compose exec app chmod -R 755 /var/www/storage
docker-compose exec app chmod -R 755 /var/www/bootstrap/cache

echo ""
echo "[OK] Setup concluído com sucesso!"
echo ""
echo " A aplicação está disponível em: http://localhost:8000"
echo ""
echo " Para rodar os testes, execute:"
echo "   docker-compose exec app php artisan test"
echo ""
echo " Para mais informações, consulte o arquivo DOCKER_SETUP.md"
