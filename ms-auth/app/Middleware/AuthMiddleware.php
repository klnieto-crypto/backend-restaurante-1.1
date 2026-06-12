<?php

namespace App\Middleware;

use App\Models\Usuario;
use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;

class AuthMiddleware
{
    public function __invoke(
        Request $request,
        Handler $handler
    ): Response {

        $header = $request->getHeaderLine('Authorization');

        if (!$header) {

            $response = new Response();

            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Token requerido'
            ]));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }

        $token = str_replace(
            'Bearer ',
            '',
            $header
        );

        $usuario = Usuario::where('token', $token)
            ->where('sesion_activa', 1)
            ->first();

        if (!$usuario) {

            $response = new Response();

            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Token inválido'
            ]));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }

        return $handler->handle($request);
    }
}