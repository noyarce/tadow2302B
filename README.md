

    php artisan queue:table 

    php artisan migrate 

    env--> QUEUE_CONNECTION=database 

    php artisan optimize:clear

    configuracion de queues. 


    _____________________________________________



instalacion de redis: 
windows : https://redis.io/docs/install/install-redis/install-redis-on-windows/
ubuntu: https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-redis-on-ubuntu-20-04-es

solo instalar redis, no configurar el servicio seguro, eso para futuro si estiman conveniente de aprender.
_______

composer require laravel/horizon

php artisan horizon:install

en el archivo ->> config/database.php
cambiar 

'client' => env('REDIS_CLIENT', 'phpredis')

a: 

'client' => env('REDIS_CLIENT', 'predis')

luego instalar predis. (libreria de redis para conectar con laravel) 

composer require predis/predis


_______________________


composer require laravel/passport

php artisan migrate
php artisan passport:install

-->
config auth

 'guards' => [
       ...

        'api' => [
            'driver' => 'passport', // <---
            'provider' => 'users',
        ]
        ... 


php artisan make: authController. loginRequest, signuprequest


cuando prueben en su local con postman, en los headers, cambiar el accept--->

"Accept"=>"application/json"


_______________________________________________________

Login con Passport 

https://programacionymas.com/blog/api-rest-laravel-passport


Controller:
https://laravel.com/docs/9.x/validation#quick-defining-the-routes

migraciones: 
https://laravel.com/docs/9.x/migrations#main-content



Request: 
https://laravel.com/docs/9.x/validation#form-request-validation
https://laravel.com/docs/9.x/validation#customizing-the-error-messages
https://laravel.com/docs/9.x/validation#customizing-the-validation-attributes

reglas de validacion disponibles
https://laravel.com/docs/9.x/validation#available-validation-rules


http client:
https://laravel.com/docs/9.x/requests

Comandos:
https://laravel.com/docs/9.x/artisan#writing-commands

jobs: 
https://laravel.com/docs/9.x/queues#creating-jobs
