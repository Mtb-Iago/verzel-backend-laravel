API


RUN CONTAINER BASH
docker exec -it test-varzel-laravel_app_1 /bin/bash

composer install
php artisan migrate --seed
php artisan storage:link




Usuario Padrão:
Email: admin@gmail.com
PASS:  123
