<?php

use Slim\App;
use App\Controllers\PedidoController;
use App\Controllers\DetallePedidoController;
use App\Middleware\AuthMiddleware;

return function (App $app) {

    $app->get(
        '/api/pedidos',
        [PedidoController::class, 'listar']
    );

    $app->post(
        '/api/pedidos',
        [PedidoController::class, 'crear']
    )->add(new AuthMiddleware());

    $app->put(
        '/api/pedidos/{id}',
        [PedidoController::class, 'actualizar']
    )->add(new AuthMiddleware());

    $app->delete(
        '/api/pedidos/{id}',
        [PedidoController::class, 'eliminar']
    )->add(new AuthMiddleware());

        $app->get(
        '/api/detalles',
        [DetallePedidoController::class, 'listar']
    );

    $app->post(
        '/api/detalles',
        [DetallePedidoController::class, 'crear']
    )->add(new AuthMiddleware());
};