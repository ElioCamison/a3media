<?php

namespace Repositories;

use PDO;

class FormRepository {
    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function fetchNames($term) {
        $query = "SELECT DISTINCT nombre FROM nueva_programacion WHERE nombre LIKE :term";
        $stmt = $this->db->prepare($query);
        $searchTerm = "%{$term}%";
        $stmt->bindParam(':term', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchType() {
        $query = "SELECT DISTINCT tipo FROM nueva_programacion";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
