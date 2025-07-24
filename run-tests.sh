#!/bin/bash

echo "Testando o setup Docker do projeto Roger Backend Challenge..."

echo "Verificando status dos containers..."
docker-compose ps

echo "Testando conexão com o banco de dados..."
docker-compose exec app php artisan migrate:status

echo "Executando testes..."
docker-compose exec app php artisan test

echo "Testando se a aplicação está respondendo..."
curl -f http://localhost:8000 > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "[OK] Aplicação está respondendo em http://localhost:8000"
else
    echo "[ERRO] Aplicação não está respondendo"
fi

echo ""
echo "[SUCESSO] Teste concluído!"
