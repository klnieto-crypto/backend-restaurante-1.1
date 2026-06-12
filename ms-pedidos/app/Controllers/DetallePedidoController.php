<?php

namespace App\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DetallePedidoController
{
    public function listar(Request $request, Response $response)
    {
        $detalles = DetallePedido::all();

        $response->getBody()->write(
            json_encode($detalles)
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

        $subtotalDetalle =
            $data['cantidad']
            * $data['precio_unitario'];

        $detalle = DetallePedido::create([
            'pedido_id' => $data['pedido_id'],
            'producto_id' => $data['producto_id'],
            'nombre_producto' => $data['nombre_producto'],
            'cantidad' => $data['cantidad'],
            'precio_unitario' => $data['precio_unitario'],
            'subtotal' => $subtotalDetalle
        ]);

        $pedido = Pedido::find(
            $data['pedido_id']
        );

        $nuevoTotal = DetallePedido::where(
            'pedido_id',
            $data['pedido_id']
        )->sum('subtotal');

        $pedido->subtotal = $nuevoTotal;
        $pedido->total = $nuevoTotal;

        $pedido->save();

        $response->getBody()->write(
            json_encode($detalle)
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }
}