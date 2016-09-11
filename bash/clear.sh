#!/bin/bash

php ../bin/console doctrine:schema:update  --force -e=$1
php ../bin/console cache:clear  -e=$1
php ../bin/console assets:install  -e=$1

chmod -R 777 ../var/cache/* ../var/logs/*
