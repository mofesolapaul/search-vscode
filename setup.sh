#!/bin/bash

cp docker-compose-dist.yml docker-compose.yml
docker network create svsc-bridge
docker-compose up -d --build
docker exec -it svsc_nginx bash -c 'cd /app && npm install && npm run build && cp -r /app/build /var/www/html'