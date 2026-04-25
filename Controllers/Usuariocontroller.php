<?php
namespace App\Controllers;

use App\Config\Conexion;
use App\Models\Consultas;

class UsuarioController {
    
    public function mostrarUsuarios() {
        // 1. Conecta
        $dbClase = new Conexion();
        $db = $dbClase->conectar();

        // 2. Pide datos al modelo
        $modelo = new Consultas($db);
        $datos = $modelo->obtenerUsuarios();

        // 3. Los regresa para que el index los use
        return $datos;
    }
}