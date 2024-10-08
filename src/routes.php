<?php

use Controllers\HomeController;
use Slim\Routing\RouteCollectorProxy;
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

$app->get('/programacion-data', function ($request, $response, $args) use ($container) {
    $controller = new \Controllers\HomeController($container->get('db'));
    return $controller->getProgramacionData($request, $response, $args);
});

$app->get('/programacion/{id}', function ($request, $response, $args) use ($container) {
    $id = $args['id'];
    $controller = new \Controllers\HomeController($container->get('db'));
    return $controller->getProgramacionById($request, $response, $id);
});

$app->post('/programacion/{id}', function ($request, $response, $args) use ($container) {
    $id = $args['id'];
    $controller = new \Controllers\HomeController($container->get('db'));
    return $controller->updateProgramacion($request, $response, $id);
});

$app->post('/programacion/', function (Request $request, Response $response, $args) {
    $controller = new \Controllers\HomeController($this->get('db'));
    return $controller->addProgramacion($request, $response);
});

$app->delete('/delete/{id}', function (Request $request, Response $response, $args) {
    $controller = new \Controllers\HomeController($this->get('db'));
    return $controller->deleteProgramacion($request, $response, $args['id']);
});
