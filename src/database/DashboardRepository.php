<?php

namespace Repositories;

use PDO;

class DashboardRepository {
    protected $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function fetchTotalTasks() {
        $query = "SELECT COUNT(*) as total FROM nueva_programacion";
        $stmt = $this->db->query($query);
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    public function fetchCompletedPercentage() {
        // Lógica pendiente para calcular el porcentaje de tareas completadas
    }

    public function fetchTasksOK() {
        // Lógica pendiente para calcular el número de tareas OK
    }

    public function fetchTasksKO() {
        // Lógica pendiente para calcular el número de tareas KO
    }
}
