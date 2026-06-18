#!/bin/bash

# Containers
docker stop $(docker ps -aq) 2>/dev/null || true
docker rm $(docker ps -aq) 2>/dev/null || true

# Imagens
docker rmi $(docker images -q) 2>/dev/null || true

# Redes e cache (SEM VOLUMES)
docker system prune -f

echo "✅ Ambiente limpo (volumes preservados)"