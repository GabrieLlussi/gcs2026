#!/bin/bash

cd ~/gcs2026/docker

docker rm -f postgres_prod || true
docker rm -f app_prod || true

docker compose -f docker-compose.prod.yml up -d --build