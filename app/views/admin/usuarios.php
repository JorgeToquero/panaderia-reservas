<?php
// Vista del panel de administración para gestionar los usuarios.
// Permite listar, cambiar el rol y eliminar usuarios.

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Gestión de Usuarios</title>
</head>
<!-- Flex column para que el footer quede siempre al fondo de la página -->
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../layouts/headerAdmin.php'; // Incluimos el header con la navbar de Bootstrap ?>

<div class="container mt-5 flex-grow-1">
    <h1 class="mb-4">Gestión de Usuarios</h1>

    <!-- Mensaje de feedback tras eliminar usuario o cambiar rol -->
    <?php if (isset($mensaje)): ?>
        <div class="alert alert-warning"><?= $mensaje ?></div>
    <?php endif; ?>

    <!-- Tabla con la lista de usuarios -->
    <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-warning">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Fecha Registro</th>
                <th>Eliminar</th>
                <th>Cambiar Rol</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id'] ?></td>
                <td><?= $usuario['nombre'] ?></td>
                <td><?= $usuario['email'] ?></td>
                <td><?= $usuario['rol'] ?></td>
                <td><?= $usuario['fecha_registro'] ?></td>
                <td>
 <!-- Formulario para eliminar usuario -->
     <form method="POST" action="/panaderia-reservas/app/controllers/AdminController.php" class="d-inline">
         <input type="hidden" name="action" value="eliminarUsuarios">
         <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
           <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
     </form>
                </td>
                <td>
  <!-- Formulario para cambiar el rol del usuario -->
     <form method="POST" action="/panaderia-reservas/app/controllers/AdminController.php" class="d-flex gap-2">
         <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
         <input type="hidden" name="action" value="cambiarRol">
            <select name="rol" class="form-select form-select-sm">
              <option value="cliente" <?= $usuario['rol'] == 'cliente' ? 'selected' : '' ?>>Cliente</option>
              <option value="admin" <?= $usuario['rol'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
         <button type="submit" class="btn btn-warning btn-sm">Cambiar</button>
     </form>
                </td>
               </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <a href="/panaderia-reservas/app/views/admin/PanelAdmin.php" class="btn btn-secondary mt-3 mb-4">Volver al panel</a>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; // Pie de Bootstrap ?>
</body>
</html>

