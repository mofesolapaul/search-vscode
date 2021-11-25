#!/bin/bash

cp docker-compose-dist.yml docker-compose.yml
docker network create svsc-bridge
docker-compose up -d --build

printf '\nBUILDING FRONTEND APP\n'
cat <<frontend | docker exec --interactive svsc_nginx bash
  cd /app
  npm install
  npm run build
  cp -r /app/build /var/www/html
frontend

printf '\nBUILDING BACKEND APP\n'
cat <<backend | docker exec --interactive svsc_php bash
  composer dump-env prod
  composer install --prefer-dist --no-dev --optimize-autoloader
  APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear
  ./bin/console --no-interaction doctrine:migrations:migrate
  screen -S messenger -d -m ./bin/console messenger:consume async -vv
backend
