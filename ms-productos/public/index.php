<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(
    __DIR__ . '/../'
);

$dotenv->load();

require __DIR__ . '/../app/Config/database.php';

$app = AppFactory::create();

$app->options('/{routes:.+}', function ($request, $response) {
    return $response;
});

$app->add(function ($request, $handler) {

    $response = $handler->handle($request);

    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader(
            'Access-Control-Allow-Headers',
            'X-Requested-With, Content-Type, Accept, Origin, Authorization'
        )
        ->withHeader(
            'Access-Control-Allow-Methods',
            'GET, POST, PUT, DELETE, OPTIONS'
        );
});

$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

(require __DIR__ . '/../app/Routes/productos.php')($app);

$app->run();