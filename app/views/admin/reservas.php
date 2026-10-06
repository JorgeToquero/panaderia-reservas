<?php
// Vista del panel de administración para gestionar las reservas.
// Permite listar las reservas y cambiar su estado.

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}
?>
 <!DOCTYPE html>
<html lang="es">
<head>
    <title>Gestión de Reservas</title>
</head>
<!-- Flex column para que el footer quede siempre al fondo de la página -->
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../layouts/headerAdmin.php'; // Incluimos el header con la navbar de Bootstrap ?>
<div class="container mt-5 flex-grow-1">
    <h1 class="mb-4">Gestión de Reservas</h1>

    <!-- Mensaje de feedback tras modificar una reserva -->
    <?php if (isset($mensaje)): ?>
        <div class="alert alert-success"><?= $mensaje ?></div>
    <?php endif; ?>

    <!-- Tabla con todas las reservas -->
    <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-warning">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Fecha creación</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($reservas as $reserva): ?>
            <tr>
                <td><?= $reserva->getId() ?></td>
                <td><?= $reserva->getIdUsuario() ?></td>
                <td><?= $reserva->getFechaReserva() ?></td>
                <td><?= $reserva->getHoraReserva() ?></td>
                <td><?= $reserva->getFecha_creacion() ?></td>
                <td><?= $reserva->getEstado() ?></td>
                <td><?= $reserva->getPrecioTotal() ?></td>
                <td>
  <!-- Formulario para cambiar el estado de la reserva -->
     <form method="POST" action="/panaderia-reservas/app/controllers/AdminController.php" class="d-flex gap-2">
             <input type="hidden" name="id" value="<?= $reserva->getId() ?>">
             <input type="hidden" name="action" value="cambiarEstado">
                 <select name="estado" class="form-select form-select-sm">
                     <option value="pendiente" <?= $reserva->getEstado() == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                     <option value="confirmada" <?= $reserva->getEstado() == 'confirmada' ? 'selected' : '' ?>>Confirmada</option>
                     <option value="cancelada" <?= $reserva->getEstado() == 'cancelada' ? 'selected' : '' ?>>Cancelada</option>
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

