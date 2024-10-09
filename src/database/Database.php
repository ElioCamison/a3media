<?php

namespace Database;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Clase Database
 *
 * Gestiona la conexión a la base de datos mediante PDO, utilizando las credenciales
 * y configuraciones definidas en variables de entorno.
 */
class Database {
    /**
     * @var \PDO|null La instancia de la conexión PDO o null si no está conectada.
     */
    private $conn;

    /**
     * Establece una conexión con la base de datos.
     *
     * Crea una instancia de PDO utilizando los parámetros definidos en variables de entorno
     * para configurar la conexión. Si ocurre un error durante la conexión, se captura y
     * muestra un mensaje de error.
     *
     * @return \PDO|null La instancia de la conexión PDO, o null si falló la conexión.
     */
    public function getConnection() {
        $this->conn = null;
        try {            
            $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8";
            $this->conn = new \PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
