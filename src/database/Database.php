<?php

namespace Database;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Database {
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // Acceder a las variables de entorno definidas en el archivo .env
            $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8";
            $this->conn = new \PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
