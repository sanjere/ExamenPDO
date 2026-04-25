<?php
// Estudiante: [Jeremy santiago osuna martinez]

spl_autoload_register(function ($clase) {
    $ruta = str_replace(['App\\', '\\'], ['', '/'], $clase) . '.php';
    if (file_exists($ruta)) {
        require_once $ruta;
    }
});

use App\Controllers\UsuarioController;

try {
    $controlador = new UsuarioController();
    $lista = $controlador->mostrarUsuarios();
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Examen PDO</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 70%; }
        th, td { border: 1px solid #333; padding: 10px; text-align: left; }
        th { background-color: #eee; }
        .error-msg { color: red; }
    </style>
</head>
<body>

    <h1>Lista de Usuarios Registrados</h1>

    <?php if (isset($error)): ?>
        <p class="error-msg">Error: <?php echo $error; ?></p>
    <?php endif; ?>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lista)): ?>
                <?php foreach($lista as $u): ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo $u['nombre']; ?></td>
                    <td><?php echo $u['email']; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No se encontraron datos en la tabla.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>