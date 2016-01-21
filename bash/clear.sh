#!/bin/bash

php ../app/console doctrine:schema:update  --force -e=$1
php ../app/console cache:clear  -e=$1
php ../app/console assets:install  -e=$1

chmod -R 777 ../app/cache/* ../app/logs/*
