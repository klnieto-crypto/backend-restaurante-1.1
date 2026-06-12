<?php

namespace App\Controllers;

use App\Models\Producto;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProductoController
{
    public function listar(Request $request, Response $response)
    {
        $productos = Producto::all();

        $response->getBody()->write(
            json_encode($productos)
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

    $producto = Producto::create([
        'nombre' => $data['nombre'],
        'descripcion' => $data['descripcion'],
        'precio' => $data['precio'],
        'categoria_id' => $data['categoria_id'],
        'disponible' => true
    ]);

    $response->getBody()->write(
        json_encode($producto)
    );

    return $response
        ->withHeader(
            'Content-Type',
            'application/json'
        );
}

    public function actualizar(Request $request, Response $response, $args)
    {
        $producto = Producto::find($args['id']);

        if (!$producto) {

            $response->getBody()->write(
                json_encode([
                    'success' => false,
                    'message' => 'Producto no encontrado'
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }

        $data = $request->getParsedBody();

        $producto->update($data);

        $response->getBody()->write(
            json_encode($producto)
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }

    public function eliminar(Request $request, Response $response, $args)
    {
        $producto = Producto::find($args['id']);

        if (!$producto) {

            $response->getBody()->write(
                json_encode([
                    'success' => false,
                    'message' => 'Producto no encontrado'
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }

        $producto->delete();

        $response->getBody()->write(
            json_encode([
                'success' => true,
                'message' => 'Producto eliminado'
            ])
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }
}