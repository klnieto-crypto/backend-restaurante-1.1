<?php

use Slim\App;
use App\Controllers\MesaController;
use App\Controllers\ReservaController;
use App\Middleware\AuthMiddleware;

return function (App $app) {

    // MESAS

    $app->get(
        '/api/mesas',
        [MesaController::class, 'listar']
    );

    $app->post(
        '/api/mesas',
        [MesaController::class, 'crear']
    )->add(new AuthMiddleware());

    $app->put(
        '/api/mesas/{id}',
        [MesaController::class, 'actualizar']
    )->add(new AuthMiddleware());

    $app->delete(
        '/api/mesas/{id}',
        [MesaController::class, 'eliminar']
    )->add(new AuthMiddleware());

    // RESERVAS

    $app->get(
        '/api/reservas',
        [ReservaController::class, 'listar']
    );

    $app->post(
        '/api/reservas',
        [ReservaController::class, 'crear']
    )->add(new AuthMiddleware());

    $app->put(
        '/api/reservas/{id}',
        [ReservaController::class, 'actualizar']
    )->add(new AuthMiddleware());

    $app->delete(
        '/api/reservas/{id}',
        [ReservaController::class, 'eliminar']
    )->add(new AuthMiddleware());
};