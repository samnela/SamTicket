#!/bin/bash
# e.g:   bash bash/clear.sh dev
php  bin/console doctrine:schema:update  --force -e=$1
php  bin/console cache:clear  -e=$1
php  bin/console assets:install  -e=$1

chmod -R 777 var/cache/* var/logs/*
