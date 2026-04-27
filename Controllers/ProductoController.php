<?php

// jeremy santiago osuna martinez

require_once dirname(__DIR__) . '/Config/Database.php';
require_once dirname(__DIR__) . '/Models/Producto.php';

class ProductoController {
    private $connection;

    public function __construct() {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function crear(Producto $producto) {
        $sql = "INSERT INTO productos (nombre, descripcion, existencia, precio) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            $producto->getNombre(),
            $producto->getDescripcion(),
            $producto->getExistencia(),
            $producto->getPrecio()
        ]);
    }

    public function listar() {
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        return $this->connection->query($sql)->fetchAll();
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function actualizar(Producto $producto) {
        $sql = "UPDATE productos SET nombre=?, descripcion=?, existencia=?, precio=? WHERE id=?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            $producto->getNombre(),
            $producto->getDescripcion(),
            $producto->getExistencia(),
            $producto->getPrecio(),
            $producto->getId()
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
