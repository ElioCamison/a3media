<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Repositories\ProgramacionRepository;
use Utils\ResponseBuilder;

class HomeController {
    protected $programacionRepository;

    public function __construct(ProgramacionRepository $repository) {
        $this->programacionRepository = $repository;
    }

    public function getAll(Request $request, Response $response): Response {
        $data = $this->programacionRepository->getAll();
        return ResponseBuilder::json($response, $data);
    }

    public function getProgramacionById(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];
        $data = $this->programacionRepository->findById($id);

        if ($data) {
            return ResponseBuilder::json($response, $data);
        } else {
            return ResponseBuilder::error($response, 'Registro no encontrado', 404);
        }
    }

    public function updateProgramacion(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];
        $params = (array)$request->getParsedBody();

        if ($this->programacionRepository->update($id, $params)) {
            return ResponseBuilder::success($response, 'Registro actualizado correctamente');
        } else {
            return ResponseBuilder::error($response, 'Error al actualizar el registro', 500);
        }
    }

    public function addProgramacion(Request $request, Response $response): Response {
        $params = (array)$request->getParsedBody();

        if ($this->programacionRepository->create($params)) {
            return ResponseBuilder::success($response, 'Nueva programación agregada correctamente');
        } else {
            return ResponseBuilder::error($response, 'Error al agregar la nueva programación', 500);
        }
    }

    public function deleteProgramacion(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];

        if ($this->programacionRepository->delete($id)) {
            return $response->withStatus(204);
        } else {
            return ResponseBuilder::error($response, 'Error al eliminar la programación', 500);
        }
    }
}
