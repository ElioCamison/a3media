<?php
require __DIR__ . '/../vendor/autoload.php';

use DI\Container;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

(require __DIR__ . '/../src/config/dependencies.php')($container);

$app->addErrorMiddleware(true, true, true);

require __DIR__ . '/../src/routes.php';

$app->run();
