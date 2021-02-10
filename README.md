## Installation

#### Clone Repo https://github.com/jgalfonso/lms.git
#### Create .env file by renaming .env.example to .env
#### Update credentials inside .env file
#### Generate application key
```bash
php artisan key:generate
```

if vendor folder exists just dump the autoload

```bash
composer dump-autoload
```

else

```bash
composer install
```

#### Npm Dependencies
	
```bas
npm install
npm install laravel-echo
npm install socket.io-client
```

Install PHP Redis (check and skip this step if predis exists on vendor folder just do the composer dump-autoload)

```bas
composer require predis/predis
```

Install laravel echo server with npm (skip this step if you have already installed echo server as global, just run init and follow below)

```bas
npm install -g laravel-echo-server
laravel-echo-server init

Do you want to run this server in development mode? Yes
Which port would you like to serve from? 6001
Which database would you like to use to store presence channel members? redis
Enter the host of your Laravel authentication server. http://localhost
Will you be serving on http or https? http
Do you want to generate a client ID/Key for HTTP API? Yes
Do you want to setup cross domain access to the API? Yes
Specify the URI that may access the API: http://localhost:80
Enter the HTTP methods that are allowed for CORS: GET, POST
Enter the HTTP headers that are allowed for CORS: Origin, Content-Type, X-Auth-Token, X-Requested-With, Accept, Authorization, X-CSRF-TOKEN, X-Socket-Id
What do you want this config to be saved as? laravel-echo-server.json
```

- Next open the .env file and change BROADCAST_DRIVER to redis
- Uncomment App\Providers\BroadcastServiceProvider::class, on config/app.php
- Set passport middleware to be use on app > providers > BroadcastServiceProvider.php

```bas
Broadcast::routes(["prefix" => "api", "middleware" => "auth:api"]);
```
- Set authEndPoint to "/api/broadcasting/auth" on laravel-echo-server.json

Run Laravel, Echo Server and webpack
```bas
php artisan serve / sudo php artisan serve --port=80 / sudo php artisan serve --host={ip_address} --port={port_no}
laravel-echo-server start
npm run watch
```
