<?php

namespace Repositories;

use PDO;

/**
 * Repositorio para gestionar operaciones CRUD en la tabla 'nueva_programacion'.
 *
 * Proporciona métodos para acceder y manipular los registros de la tabla
 * 'nueva_programacion' en la base de datos.
 */
class ProgramacionRepository {
    /**
     * Conexión PDO a la base de datos.
     *
     * @var PDO
     */
    protected $db;

    /**
     * Inicializa el repositorio con la conexión a la base de datos.
     *
     * @param PDO $db Instancia de PDO utilizada para las consultas a la base de datos.
     */
    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    /**
     * Recupera todos los registros de 'nueva_programacion'.
     *
     * @return array Lista de registros, cada uno representado como un array asociativo.
     */
    public function getAll(): array {
        $query = $this->db->query("SELECT * FROM nueva_programacion");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Busca un registro en 'nueva_programacion' por ID.
     *
     * @param int $id Identificador único del registro.
     * @return array|null Array asociativo con los datos del registro o null si no existe.
     */
    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM nueva_programacion WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $data ?: null;
    }

    /**
     * Crea un nuevo registro en 'nueva_programacion'.
     *
     * @param array $params Datos del registro en un array asociativo.
     * @return bool True si el registro fue creado exitosamente, false en caso contrario.
     */
    public function create(array $params): bool {
        $stmt = $this->db->prepare("INSERT INTO nueva_programacion 
            (nombre, tipo, regla, cuando, programacion, dia, hora, sh, activo) 
            VALUES 
            (:nombre, :tipo, :regla, :cuando, :programacion, :dia, :hora, :sh, :activo)");
        
        $this->bindParams($stmt, $params);

        return $stmt->execute();
    }

    /**
     * Actualiza un registro existente en 'nueva_programacion' por ID.
     *
     * @param int $id ID del registro a actualizar.
     * @param array $params Nuevos datos para actualizar el registro.
     * @return bool True si el registro fue actualizado exitosamente, false en caso contrario.
     */
    public function update(int $id, array $params): bool {
        $stmt = $this->db->prepare("UPDATE nueva_programacion 
            SET nombre = :nombre, tipo = :tipo, regla = :regla, cuando = :cuando, 
            programacion = :programacion, dia = :dia, hora = :hora, sh = :sh, activo = :activo 
            WHERE id = :id");

        $this->bindParams($stmt, $params);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Elimina un registro de 'nueva_programacion' por ID.
     *
     * @param int $id ID del registro a eliminar.
     * @return bool True si el registro fue eliminado exitosamente, false en caso contrario.
     */
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM nueva_programacion WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    /**
     * Asigna parámetros de un array asociativo a la declaración preparada.
     *
     * @param \PDOStatement $stmt La declaración preparada.
     * @param array $params Datos para asignar a la declaración.
     */
    private function bindParams(&$stmt, $params) {
        $stmt->bindParam(':nombre', $params['nombre']);
        $stmt->bindParam(':tipo', $params['tipo']);
        $stmt->bindParam(':regla', $params['regla']);
        $stmt->bindParam(':cuando', $params['cuando']);
        $stmt->bindParam(':programacion', $params['programacion']);
        $stmt->bindParam(':dia', $params['dia']);
        $stmt->bindParam(':hora', $params['hora']);
        $stmt->bindParam(':sh', $params['sh']);
        $stmt->bindParam(':activo', $params['activo']);
    }
}
