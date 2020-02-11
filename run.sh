#!/bin/bash

echo Copy .env
cp .env.example .env

echo Install npm dependencies
npm install
npm run dev

echo Uploading application container
docker-compose up --build -d

echo Install composer dependencies
docker run --rm --interactive --tty -v $PWD:/app composer install

echo Key generate
docker-compose exec app php artisan key:generate

echo Config clear
docker-compose exec app php artisan config:clear

echo Make migrations
docker-compose exec app php artisan migrate --seed

echo Run tests
docker-compose exec app php ./vendor/bin/phpunit

echo Information of new containers
docker ps
