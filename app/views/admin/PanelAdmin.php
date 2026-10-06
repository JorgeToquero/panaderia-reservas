<?php
/* El panel de administración donde se puede acceder a la gestión de productos, reservas y usuarios.
 Solo accesible para usuarios con rol admin.*/

 // Aquí están la vistas del panel de administración

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

include __DIR__ . '/../layouts/headerAdmin.php';// Incluimos el header con la navbar de Bootstrap 

?>
<!DOCTYPE html>
<html>
<head><title>Panel Admin</title></head>
<body>
    <!-- Flex column para que el footer quede siempre al fondo de la página -->
    <body class="d-flex flex-column min-vh-100">

  <div class="container mt-5 flex-grow-1">  <!-- flex-grow-1 para que el contenido ocupe el espacio disponible empujando el footer hacia abajo -->
    <h1 class = "mb-3">Panel de Administración</h1>
    <p>Bienvenido, <strong><?= $_SESSION['nombre'] ?></strong></p>
    <p>Rol: <strong><?= $_SESSION['rol'] ?></strong></p>

   <div class="row mt-4">
     <div class="col-md-3">
            <a href="../../controllers/AdminController.php?action=productos" class="btn btn-warning w-100 mb-3">Gestionar Productos</a>
        </div>
        <div class="col-md-3">
            <a href="../../controllers/AdminController.php?action=reservas" class="btn btn-warning w-100 mb-3">Gestionar Reservas</a>
        </div>
        <div class="col-md-3">
            <a href="../../controllers/AdminController.php?action=listarUsuarios" class="btn btn-warning w-100 mb-3">Gestionar Usuarios</a>
        </div>
        <div class="col-md-3">
            <a href="../../controllers/AdminController.php?action=reservaPorFecha" class="btn btn-warning w-100 mb-3">Resumen Diario</a>
    </div>
</div>
</div>


    <?php include __DIR__ . '/../layouts/footer.php'; //pie de Bootstrap ?> 

</body>
</html>

 <
