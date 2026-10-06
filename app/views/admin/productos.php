
<!-- Vista del panel de administración para gestionar los productos.
     Permite ver, crear, editar y eliminar productos. -->
<?php

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Productos</title>
</head>

    <!-- Flex column para que el footer quede siempre al fondo de la página -->
<body class="d-flex flex-column min-vh-100">



 <?php include __DIR__ . '/../layouts/headerAdmin.php'; // Incluimos el header con la navbar de Bootstrap ?> 


<div class="container mt-5 flex-grow-1">
    <h1 class="mb-4">Gestión de Productos</h1>

<!-- Mensaje tras crear, editar o borrar un producto -->
    <?php if (isset($mensaje)): ?>
    <div class="alert alert-success"><?= $mensaje ?></div>
        <?php endif; ?>

    <!-- Formulario para añadir un nuevo producto -->
    <h3 class="mb-3">Añadir Producto</h3>
    <form method="POST" action="../controllers/ProductoController.php" enctype="multipart/form-data" class="row g-3 mb-5">
        <input type="hidden" name="action" value="crear">
        <div class="col-md-4">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Categoría</label>
            <input type="text" name="categoria" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">Stock Diario</label>
            <input type="number" name="stockDiario" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control">
        </div>
        <div class="col-md-2">
            <label class="form-label">Imagen</label>
            <input type="text" name="imagen" class="form-control">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <div class="form-check mb-2">
                <input type="checkbox" name="activo" class="form-check-input" id="activoCrear">
                <label class="form-check-label" for="activoCrear">Activo</label>
            </div>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-warning w-100">Añadir Producto</button>
        </div>
    </form>

     <!-- Lista de productos con opciones de editar y borrar -->
    <h3 class="mb-3">Productos</h3>
    <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-warning">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Descripción</th>
                <th>Activo</th>
                <th>Fecha creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

<?php foreach ($productos as $prod): ?>
            <tr>
                <td><?= $prod->getId() ?></td>
                <td><?= $prod->getNombre() ?></td>
                <td><?= $prod->getPrecio() ?></td>
                <td><?= $prod->getCategoria() ?></td>
                <td><?= $prod->getStockDiario() ?></td>
                <td><?= $prod->getDescripcion() ?></td>
                <td><?= $prod->getActivo() ? 'Sí' : 'No' ?></td>
                <td><?= $prod->getFechaCreacion() ?></td>
                <td>
  <!-- Botón borrar producto -->
    <form method="POST" action="../controllers/ProductoController.php" class="d-inline">
             <input type="hidden" name="action" value="borrar">
             <input type="hidden" name="id" value="<?= $prod->getId() ?>">
             <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
    </form>
  <!-- Botón para mostrar formulario de edición -->
     <button class="btn btn-secondary btn-sm" data-bs-toggle="collapse" data-bs-target="#editar<?= $prod->getId() ?>">Editar</button>
            </td>
            </tr>
<!-- Fila oculta con formulario de edición -->
<tr class="collapse" id="editar<?= $prod->getId() ?>">
    <td colspan="9">
    <form method="POST" action="../controllers/ProductoController.php" class="row g-2 p-2">
        <input type="hidden" name="action" value="editar">
        <input type="hidden" name="id" value="<?= $prod->getId() ?>">
          <div class="col-md-3">
        <input type="text" name="nombre" value="<?= $prod->getNombre() ?>" class="form-control" required>
        </div>
     <div class="col-md-2">
        <input type="number" name="precio" value="<?= $prod->getPrecio() ?>" step="0.01" class="form-control" required>
          </div>
          <div class="col-md-2">
         <input type="text" name="categoria" value="<?= $prod->getCategoria() ?>" class="form-control" required>
          </div>
          <div class="col-md-2">
        <input type="number" name="stockDiario" value="<?= $prod->getStockDiario() ?>" class="form-control" required>
          </div>
          <div class="col-md-3">
        <input type="text" name="descripcion" value="<?= $prod->getDescripcion() ?>" class="form-control">
          </div>
          <div class="col-md-2">
        <input type="text" name="imagen" value="<?= $prod->getImagen() ?>" class="form-control">
          </div>
          <div class="col-md-2 d-flex align-items-center">
          <div class="form-check">
        <input type="checkbox" name="activo" class="form-check-input" <?= $prod->getActivo() ? 'checked' : '' ?>>
        <label class="form-check-label">Activo</label>
    </div>
   </div>
  <div class="col-md-2">
     <button type="submit" class="btn btn-warning w-100">Guardar cambios</button>
   </div>
</form>
</td> </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
 </div>

    <a href="../views/admin/PanelAdmin.php" class="btn btn-secondary mt-3">Volver al panel</a>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; // Pie de Bootstrap ?>          

</body>
</html>


