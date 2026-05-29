#!/bin/bash

VM_USER="univates"
VM_IP="177.44.248.101"

echo "🚀 Atualizando PRODUÇÃO..."

ssh $VM_USER@$VM_IP << 'EOF'

cd ~/gcs2026/docker

docker rm -f postgres_prod || true

docker compose -f docker-compose.prod.yml down
docker compose -f docker-compose.prod.yml up -d --build

echo "✅ Produção atualizada!"

EOF