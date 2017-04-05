#!/bin/bash
# use sh bash/init.sh dev 
php bin/console doctrine:database:drop  --force -e=$1
php bin/console doctrine:database:create -e=$1
php  bin/console doctrine:schema:update  --force -e=$1
php  bin/console ticket:fixtures:load -e=$1
php  bin/console cache:clear  -e=$1
php  bin/console assets:install  -e=$1

chmod -R 777 var/cache/* var/logs/*
    


