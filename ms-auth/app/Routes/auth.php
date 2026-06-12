<?php

use Slim\App;
use App\Controllers\AuthController;
use App\Middleware\AuthMiddleware;

return function (App $app) {

    $app->get('/api/test', function ($request, $response) {
        $response->getBody()->write('API funcionando');
        return $response;
    });

    $app->post(
        '/api/login',
        [AuthController::class, 'login']
    );

    $app->post(
        '/api/logout',
        [AuthController::class, 'logout']
    );

    $app->get(
        '/api/validar',
        [AuthController::class, 'validar']
    )->add(new AuthMiddleware());
};