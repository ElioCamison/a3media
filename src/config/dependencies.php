<?php

use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Repositories\ProgramacionRepository;
use Controllers\HomeController;

/**
 * Configuración del contenedor de dependencias.
 *
 * Registra las dependencias necesarias para la aplicación, incluyendo la
 * conexión a la base de datos, el repositorio de programación y el controlador Home.
 *
 * @param ContainerInterface $container El contenedor de dependencias de la aplicación.
 * @return void
 */
return function (ContainerInterface $container) {
    
    /**
     * Configura el servicio de conexión a la base de datos.
     *
     * Registra un servicio 'db' que devuelve una instancia de conexión PDO.
     */
    $container->set('db', function () {
        $database = new \Database\Database();
        return $database->getConnection();
    });

    /**
     * Configura el servicio de logging.
     *
     * Registra un servicio 'logger' que devuelve una instancia de Logger.
     */
    $container->set('logger', function() {
        $logDirectory = __DIR__ . '/../logs';
        $isLogDirectoryMissing = !is_dir($logDirectory);
    
        if ($isLogDirectoryMissing) {
            mkdir($logDirectory, 0755, true);
        }

        $logger = new Logger('a3media');

        $logLevels = [
            'dev' => Logger::DEBUG,
            'sta' => Logger::INFO,
            'PRO' => Logger::WARNING,
        ];
        
        $logLevel = $logLevels[$_ENV['APP_ENV']] ?? Logger::WARNING;

        $file_handler = new StreamHandler($logDirectory . '/app.log', $logLevel);
        $logger->pushHandler($file_handler);
        return $logger;
    });

    /**
     * Configura el servicio de repositorio de programación.
     *
     * Registra el repositorio de programación para gestionar operaciones CRUD
     * en la base de datos, utilizando el servicio 'db' para la conexión.
     *
     * @param ContainerInterface $container El contenedor de dependencias.
     * @return ProgramacionRepository La instancia del repositorio de programación.
     */
    $container->set(ProgramacionRepository::class, function ($container) {
        $db = $container->get('db');
        return new ProgramacionRepository($db);
    });

    /**
     * Configura el servicio del controlador Home.
     *
     * Registra el controlador Home, utilizando el repositorio de programación y el logger como dependencias.
     *
     * @param ContainerInterface $container El contenedor de dependencias.
     * @return HomeController La instancia del controlador Home.
     */
    $container->set(HomeController::class, function ($container) {
        $repository = $container->get(ProgramacionRepository::class);
        $logger = $container->get('logger');
        return new HomeController($repository, $logger);
    });
};
