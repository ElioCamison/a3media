<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Repositories\ProgramacionRepository;
use Utils\ResponseBuilder;

class HomeController {
    protected $programacionRepository;

    public function __construct(ProgramacionRepository $repository, LoggerInterface $logger) {
        $this->programacionRepository = $repository;
        $this->logger = $logger;
    }

    public function getAll(Request $request, Response $response): Response {
        $data = $this->programacionRepository->getAll();
        $this->logger->info('Se ha solicitado la lista completa de programaciones');
        return ResponseBuilder::json($response, $data);
    }

    public function getProgramacionById(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];
        $data = $this->programacionRepository->findById($id);

        if ($data) {
            $this->logger->info("Se ha encontrado la programación con ID $id");
            return ResponseBuilder::json($response, $data);
        } else {
            $this->logger->warning("No se encontró la programación con ID $id");
            return ResponseBuilder::error($response, 'Registro no encontrado', 404);
        }
    }

    public function updateProgramacion(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];
        $params = (array)$request->getParsedBody();

        if ($this->programacionRepository->update($id, $params)) {
            $this->logger->info("Programación con ID $id actualizada exitosamente");
            return ResponseBuilder::success($response, 'Registro actualizado correctamente');
        } else {
            $this->logger->error("Error al actualizar la programación con ID $id");
            return ResponseBuilder::error($response, 'Error al actualizar el registro', 500);
        }
    }

    public function addProgramacion(Request $request, Response $response): Response {
        $params = (array)$request->getParsedBody();

        if ($this->programacionRepository->create($params)) {
            $this->logger->info('Nueva programación agregada correctamente');
            return ResponseBuilder::success($response, 'Nueva programación agregada correctamente');
        } else {
            $this->logger->error('Error al agregar una nueva programación');
            return ResponseBuilder::error($response, 'Error al agregar la nueva programación', 500);
        }
    }

    public function deleteProgramacion(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];

        if ($this->programacionRepository->delete($id)) {
            $this->logger->info("Programación con ID $id eliminada correctamente");
            return $response->withStatus(204);
        } else {
            $this->logger->error("Error al eliminar la programación con ID $id");
            return ResponseBuilder::error($response, 'Error al eliminar la programación', 500);
        }
    }
}
