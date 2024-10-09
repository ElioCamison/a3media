<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Repositories\DashboardRepository;
use Utils\ResponseBuilder;

class DashboardController {
    protected $dashboardRepository;

    /**
     * Inicializa el controlador con el repositorio del dashboard.
     *
     * @param DashboardRepository $dashboardRepository Repositorio para acceder a los datos del dashboard.
     */
    public function __construct(DashboardRepository $dashboardRepository) {
        $this->dashboardRepository = $dashboardRepository;
    }

    /**
     * Obtiene el total de tareas y devuelve una respuesta JSON.
     *
     * @param Request $request La solicitud entrante.
     * @param Response $response La respuesta saliente.
     * @return Response La respuesta JSON con el total de tareas.
     */
    public function getTotalTasks(Request $request, Response $response): Response {
        $totalTasks = $this->dashboardRepository->fetchTotalTasks();
        return ResponseBuilder::json($response, ['totalTasks' => $totalTasks]);
    }
}
