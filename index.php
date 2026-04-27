<?php
require_once 'Controllers/ProductoController.php';
$controller = new ProductoController();

$productoEditar = null;

if (isset($_GET['eliminar'])) {
    $controller->eliminar($_GET['eliminar']);
    header("Location: index.php");
    exit();
}

if (isset($_GET['editar'])) {
    $productoEditar = $controller->obtenerPorId($_GET['editar']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p = new Producto();
    $p->setNombre(trim($_POST['nombre']));
    $p->setDescripcion(trim($_POST['descripcion']));
    $p->setExistencia((int)$_POST['existencia']);
    $p->setPrecio((float)$_POST['precio']);

    if (!empty($_POST['id'])) {
        $p->setId($_POST['id']);
        $controller->actualizar($p);
    } else {
        $controller->crear($p);
    }
    header("Location: index.php");
    exit();
}

$productos = $controller->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">CRUD de Productos con PHP, PDO y POO</h2>

    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <?php echo $productoEditar ? 'Editar Producto' : 'Nuevo Producto'; ?>
        </div>
        <form method="POST" class="card-body row g-3">
            <input type="hidden" name="id" value="<?php echo $productoEditar['id'] ?? ''; ?>">
            <div class="col-md-6">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo $productoEditar['nombre'] ?? ''; ?>" required>
            </div>
            <div class="col-md-6">
                <label>Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control" value="<?php echo $productoEditar['precio'] ?? ''; ?>" required>
            </div>
            <div class="col-md-9">
                <label>Descripción</label>
                <input type="text" name="descripcion" class="form-control" value="<?php echo $productoEditar['descripcion'] ?? ''; ?>" required>
            </div>
            <div class="col-md-3">
                <label>Existencia</label>
                <input type="number" name="existencia" class="form-control" value="<?php echo $productoEditar['existencia'] ?? ''; ?>" required>
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-success">
                    <?php echo $productoEditar ? 'Actualizar' : 'Guardar'; ?>
                </button>
            </div>
        </form>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Nombre</th><th>Descripción</th><th>Existencia</th><th>Precio</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['nombre']; ?></td>
                <td><?php echo $item['descripcion']; ?></td>
                <td><?php echo $item['existencia']; ?></td>
                <td>$<?php echo number_format($item['precio'], 2); ?></td>
                <td>
                    <a href="index.php?editar=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="index.php?eliminar=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>