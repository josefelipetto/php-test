# Execute this just after setup the database

composer install && vendor/bin/phpunit && php artisan db:seed


