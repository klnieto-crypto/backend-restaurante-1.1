<?php

namespace App\Controllers;

use App\Models\Usuario;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController
{
    public function login(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $usuario = Usuario::where('usuario', $data['usuario'])
            ->orWhere('correo', $data['usuario'])
            ->first();

        if (!$usuario) {

            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ]));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }

        if ($usuario->contrasena != $data['contrasena']) {

            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Contraseña incorrecta'
            ]));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }

        $token = bin2hex(random_bytes(32));

        $usuario->token = $token;
        $usuario->sesion_activa = true;
        $usuario->save();

        $response->getBody()->write(json_encode([
            'success' => true,
            'token' => $token,
            'usuario' => [
                'id' => $usuario->id,
                'nombre' => $usuario->nombre,
                'correo' => $usuario->correo,
                'rol' => $usuario->rol
            ]
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function logout(Request $request, Response $response)
    {
        $token = str_replace(
            'Bearer ',
            '',
            $request->getHeaderLine('Authorization')
        );

        $usuario = Usuario::where('token', $token)->first();

        if ($usuario) {
            $usuario->token = null;
            $usuario->sesion_activa = false;
            $usuario->save();
        }

        $response->getBody()->write(json_encode([
            'success' => true,
            'message' => 'Sesión cerrada'
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function validar(Request $request, Response $response)
    {
        $response->getBody()->write(json_encode([
            'success' => true,
            'message' => 'Token válido'
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}