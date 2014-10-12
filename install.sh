#!/bin/bash
composer install
chmod -R 777 app/cache app/logs
app/console doctrine:database:create
app/console doctrine:schema:create
app/console doctrine:fixtures:load