<?php
namespace App\Config;

use PDO;
use PDOException;

class Conexion {
    private $host = "localhost";
    private $bd = "examen_db";
    private $user = "root";
    private $pass = ""; 
    public $con;

    public function conectar() {
        $this->con = null;
        try {
            // Conexión usando PDO
            $this->con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->bd, $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
        return $this->con;
    }
}