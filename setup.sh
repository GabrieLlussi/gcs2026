#!/bin/bash

VM_USER="univates"
VM_IP="177.44.248.101"

echo "🚀 Subindo estrutura completa na VM..."

ssh $VM_USER@$VM_IP << 'EOF'

echo "📦 Instalando Docker..."

sudo apt update -y
sudo apt install -y docker.io git curl

sudo systemctl start docker
sudo systemctl enable docker

echo "📦 Instalando Docker Compose..."

sudo mkdir -p /usr/libexec/docker/cli-plugins
sudo curl -SL https://github.com/docker/compose/releases/download/v2.27.0/docker-compose-linux-x86_64 \
  -o /usr/libexec/docker/cli-plugins/docker-compose
sudo chmod +x /usr/libexec/docker/cli-plugins/docker-compose

echo "📁 Clonando projeto..."

rm -rf ~/gcs2026
git clone https://github.com/GabrieLlussi/gcs2026.git ~/gcs2026

cd ~/gcs2026/docker

echo "🐳 Subindo HOMOLOG..."

docker compose -f docker-compose.homolog.yml up -d --build

echo "🐳 Subindo PROD..."

docker compose -f docker-compose.prod.yml up -d --build

echo "🐳 Subindo Jenkins..."

docker run -d \
  --name jenkins \
  -p 8080:8080 \
  -p 50000:50000 \
  -v jenkins_home:/var/jenkins_home \
  -v /var/run/docker.sock:/var/run/docker.sock \
  -v /usr/libexec/docker/cli-plugins:/usr/libexec/docker/cli-plugins \
  jenkins/jenkins:lts

EOF