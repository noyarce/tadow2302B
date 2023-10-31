

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

