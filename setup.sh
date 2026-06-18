#!/bin/bash

VM_USER="univates"
VM_IP="177.44.248.101"

echo "🚀 Subindo estrutura completa na VM..."

ssh $VM_USER@$VM_IP << 'EOF'

echo "📦 Instalando Docker (se necessário)..."
sudo apt update -y
sudo apt install -y docker.io git curl

echo "🔌 Ativando Docker..."
sudo systemctl enable docker
sudo systemctl start docker

echo "📁 Clonando projeto..."
rm -rf gcs2026
git clone https://github.com/GabrieLlussi/gcs2026.git

cd gcs2026

echo "🐳 Subindo HOMOLOG (8081)..."
cd docker
sudo docker compose -f docker-compose.homolog.yml up -d --build

echo "🐳 Subindo PROD (8082)..."
sudo docker compose -f docker-compose.prod.yml up -d --build

cd ..

echo "🧠 Subindo Jenkins..."
sudo docker run -d \
  --name jenkins \
  -p 8080:8080 -p 50000:50000 \
  -v jenkins_home:/var/jenkins_home \
  -v /var/run/docker.sock:/var/run/docker.sock \
  -v /usr/bin/docker:/usr/bin/docker \
  jenkins/jenkins:lts

echo "✅ Ambiente pronto!"

EOF