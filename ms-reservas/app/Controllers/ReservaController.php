<?php

namespace App\Controllers;

use App\Models\Reserva;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ReservaController
{
    public function listar(Request $request, Response $response)
    {
        $reservas = Reserva::all();

        $response->getBody()->write(
            json_encode($reservas)
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

            $reserva = Reserva::create([
            'nombre_cliente' => $data['nombre_cliente'],
            'telefono_cliente' => $data['telefono_cliente'],
            'cantidad_personas' => $data['cantidad_personas'],
            'fecha' => $data['fecha'],
            'hora' => $data['hora'],
            'observaciones' => $data['observaciones'],
            'mesa_id' => $data['mesa_id'],
            'estado' => 'pendiente'
            ]);
        $response->getBody()->write(
            json_encode($reserva)
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }

    public function actualizar(Request $request, Response $response, $args)
    {
        $reserva = Reserva::find($args['id']);

        if (!$reserva) {

            $response->getBody()->write(
                json_encode([
                    'success' => false,
                    'message' => 'Reserva no encontrada'
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }

        $data = $request->getParsedBody();

        $reserva->update($data);

        $response->getBody()->write(
            json_encode($reserva)
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }

    public function eliminar(Request $request, Response $response, $args)
    {
        $reserva = Reserva::find($args['id']);

        if (!$reserva) {

            $response->getBody()->write(
                json_encode([
                    'success' => false,
                    'message' => 'Reserva no encontrada'
                ])
            );

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }

        $reserva->delete();

        $response->getBody()->write(
            json_encode([
                'success' => true,
                'message' => 'Reserva eliminada'
            ])
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }
}