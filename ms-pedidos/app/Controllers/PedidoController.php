<?php

namespace App\Controllers;

use App\Models\Pedido;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PedidoController
{
    public function listar(Request $request, Response $response)
    {
        $pedidos = Pedido::all();

        $response->getBody()->write(
            json_encode($pedidos)
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

        $pedido = Pedido::create([
            'mesa_id' => $data['mesa_id'],
            'fecha' => $data['fecha'],
            'hora' => $data['hora'],
            'subtotal' => $data['subtotal'],
            'total' => $data['total'],
            'estado' => $data['estado']
        ]);

        $response->getBody()->write(
            json_encode($pedido)
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }

    public function actualizar(Request $request, Response $response, $args)
    {
        $pedido = Pedido::find($args['id']);

        if (!$pedido) {

            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Pedido no encontrado'
            ]));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }

        $pedido->update(
            $request->getParsedBody()
        );

        $response->getBody()->write(
            json_encode($pedido)
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }

    public function eliminar(Request $request, Response $response, $args)
    {
        $pedido = Pedido::find($args['id']);

        if (!$pedido) {

            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => 'Pedido no encontrado'
            ]));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }

        $pedido->delete();

        $response->getBody()->write(json_encode([
            'success' => true,
            'message' => 'Pedido eliminado'
        ]));

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }
}