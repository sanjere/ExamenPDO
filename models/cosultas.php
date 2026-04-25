<?php
namespace App\Models;

use PDO;

class Consultas {
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

    public function obtenerUsuarios() {
        // La consulta limpia
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}