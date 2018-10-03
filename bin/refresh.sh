#!/bin
php console doctrine:database:drop --force
php console doctrine:database:create
php console doctrine:schema:update --dump-sql
php console doctrine:schema:update --force
php console doctrine:fixtures:load
php console assetic:dump
php console assets:install
php console cache:clear --env=prod
php console cache:clear --env=dev