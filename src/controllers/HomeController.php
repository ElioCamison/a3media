<?php

namespace Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
        if ($db === null) {
            echo "Error: La conexión a la base de datos no se ha establecido.";
        }
    }

    public function getAll(Request $request, Response $response, $args) {
        $response->getBody()->write('List of items');
        return $response;
    }

    public function getProgramacionData(Request $request, Response $response, $args) {
        $query = $this->db->query("SELECT * FROM nueva_programacion");
        $data = $query->fetchAll(\PDO::FETCH_ASSOC);
        
        $response->getBody()->write(json_encode($data));

        return $response->withHeader('Content-Type', 'application/json')
                        ->withStatus(200);
    }

    public function getProgramacionById(Request $request, Response $response, $id) {
        $stmt = $this->db->prepare("SELECT * FROM nueva_programacion WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
    
        if ($data) {
            $response->getBody()->write(json_encode($data));
            return $response->withHeader('Content-Type', 'application/json');
        } else {
            return $response->withStatus(404)->write('Registro no encontrado');
        }
    }
    
    public function updateProgramacion(Request $request, Response $response, $id) {
        $params = (array)$request->getParsedBody();
    
        $stmt = $this->db->prepare("
            UPDATE nueva_programacion
            SET nombre = :nombre, tipo = :tipo, regla = :regla, cuando = :cuando,
                programacion = :programacion, dia = :dia, hora = :hora, sh = :sh, activo = :activo
            WHERE id = :id
        ");
    
        // Mapear los parámetros para la consulta
        $stmt->bindParam(':nombre', $params['nombre']);
        $stmt->bindParam(':tipo', $params['tipo']);
        $stmt->bindParam(':regla', $params['regla']);
        $stmt->bindParam(':cuando', $params['cuando']);
        $stmt->bindParam(':programacion', $params['programacion']);
        $stmt->bindParam(':dia', $params['dia']);
        $stmt->bindParam(':hora', $params['hora']);
        $stmt->bindParam(':sh', $params['sh']);
        $stmt->bindParam(':activo', $params['activo']);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            $response->getBody()->write('Registro actualizado correctamente');
            return $response->withStatus(200);
        } else {
            $response->getBody()->write('Error al actualizar el registro');
            return $response->withStatus(500);
        }
    }

    public function addProgramacion(Request $request, Response $response) {
        $params = (array)$request->getParsedBody();
        
        $stmt = $this->db->prepare("INSERT INTO nueva_programacion (nombre, tipo, regla, cuando, programacion, dia, hora, sh, activo) VALUES (:nombre, :tipo, :regla, :cuando, :programacion, :dia, :hora, :sh, :activo)");
        
        $stmt->bindParam(':nombre', $params['nombre']);
        $stmt->bindParam(':tipo', $params['tipo']);
        $stmt->bindParam(':regla', $params['regla']);
        $stmt->bindParam(':cuando', $params['cuando']);
        $stmt->bindParam(':programacion', $params['programacion']);
        $stmt->bindParam(':dia', $params['dia']);
        $stmt->bindParam(':hora', $params['hora']);
        $stmt->bindParam(':sh', $params['sh']);
        $stmt->bindParam(':activo', $params['activo']);
        
        if ($stmt->execute()) {
            $response->getBody()->write('Nueva programación agregada correctamente.');
            return $response->withStatus(200);
        } else {
            var_dump($stmt->errorInfo());
            $response->getBody()->write('Error al agregar la nueva programación.');
            return $response->withStatus(500);
        }
    }
    
    public function deleteProgramacion(Request $request, Response $response, $id) {
        $stmt = $this->db->prepare("DELETE FROM nueva_programacion WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return $response->withStatus(204);
        } else {
            return $response->withStatus(500)->write('Error al eliminar la programación.');
        }
    }
    
    
}
