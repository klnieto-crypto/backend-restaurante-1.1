<?php

use Slim\App;
use App\Controllers\ProductoController;
use App\Middleware\AuthMiddleware;

return function (App $app) {

    $app->get(
        '/api/productos',
        [ProductoController::class, 'listar']
    );

   $app->post(
        '/api/productos',
        [ProductoController::class, 'crear']
    )->add(new AuthMiddleware());

   $app->put(
        '/api/productos/{id}',
        [ProductoController::class, 'actualizar']
    )->add(new AuthMiddleware());

    $app->delete(
        '/api/productos/{id}',
        [ProductoController::class, 'eliminar']
    )->add(new AuthMiddleware());
};