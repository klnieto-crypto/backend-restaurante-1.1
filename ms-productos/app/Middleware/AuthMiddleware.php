<?php

namespace App\Middleware;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;

class AuthMiddleware
{
    public function __invoke(
        Request $request,
        Handler $handler
    ): Response {

        $header = $request->getHeaderLine(
            'Authorization'
        );

        if (!$header) {

            $response = new Response();

            $response->getBody()->write(
                json_encode([
                    'success' => false,
                    'message' => 'Token requerido'
                ])
            );

            return $response
                ->withHeader(
                    'Content-Type',
                    'application/json'
                )
                ->withStatus(401);
        }

        return $handler->handle($request);
    }
}