<?php
require_once "Config/conexion.php";
require_once "models/cosultas.php"; 
require_once "Controllers/Usuariocontroller.php";

$controlador = new Usuariocontroller();
$lista = $controlador->mostrarUsuarios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tarea PDO Estudiante</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Lista de Usuarios Registrados</h1>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($lista) && is_array($lista)): ?>
                <?php foreach($lista as $u): ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo $u['nombre']; ?></td>
                    <td><?php echo $u['email']; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay datos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>