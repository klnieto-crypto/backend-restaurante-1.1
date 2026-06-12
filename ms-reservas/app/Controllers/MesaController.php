<?php

namespace App\Controllers;

use App\Models\Mesa;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MesaController
{
    public function listar(Request $request, Response $response)
    {
        $mesas = Mesa::all();

        $response->getBody()->write(
            json_encode($mesas)
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }

    public function crear(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $mesa = Mesa::create([
            'numero' => $data['numero'],
            'capacidad' => $data['capacidad'],
            'estado' => $data['estado']
        ]);

        $response->getBody()->write(
            json_encode($mesa)
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }

    public function actualizar(Request $request, Response $response, $args)
    {
        $mesa = Mesa::find($args['id']);

        if (!$mesa) {

            $response->getBody()->write(
                json_encode([
                    'success' => false,
                    'message' => 'Mesa no encontrada'
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }

        $data = $request->getParsedBody();

        $mesa->update($data);

        $response->getBody()->write(
            json_encode($mesa)
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }

    public function eliminar(Request $request, Response $response, $args)
    {
        $mesa = Mesa::find($args['id']);

        if (!$mesa) {

            $response->getBody()->write(
                json_encode([
                    'success' => false,
                    'message' => 'Mesa no encontrada'
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }

        $mesa->delete();

        $response->getBody()->write(
            json_encode([
                'success' => true,
                'message' => 'Mesa eliminada'
            ])
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }
}