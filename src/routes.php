<?php

use Controllers\HomeController;
use Controllers\DashboardController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/', function ($request, $response, $args) {
    $template = __DIR__ . '/../src/templates/base.php';
    
    ob_start();
    include $template;
    $output = ob_get_clean();
    
    $response->getBody()->write($output);
    return $response;
});

$app->get('/programacion-data', HomeController::class . ':getAll');
$app->get('/programacion/{id}', HomeController::class . ':getProgramacionById');
$app->post('/programacion/{id}', HomeController::class . ':updateProgramacion');
$app->post('/programacion/', HomeController::class . ':addProgramacion');
$app->delete('/delete/{id}', HomeController::class . ':deleteProgramacion');

$app->get('/api/total-tasks', DashboardController::class . ':getTotalTasks');
