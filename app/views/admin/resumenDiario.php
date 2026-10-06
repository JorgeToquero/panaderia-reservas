<?php
        //vista para ver el resumen diario de productos a preparar
        //Vista solo del admin

    if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
      header('Location: ../../index.php');
      exit;
}
   
?>

            <!DOCTYPE html>
<html lang="es">
<head>
    <title>Resumen Diario</title>
</head>
<!-- Flex column para que el footer quede siempre al fondo de la página -->
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../layouts/headerAdmin.php'; // Incluimos el header con la navbar de Bootstrap ?>

<div class="container mt-5 flex-grow-1">
    <h1 class="mb-4">Resumen Diario de Pedidos</h1>

    <!-- Formulario para seleccionar la fecha del resumen -->
    <form method="GET" action="/panaderia-reservas/app/controllers/AdminController.php" class="row g-3 mb-4">
        <input type="hidden" name="action" value="reservaPorFecha">
        <div class="col-md-3">
            <input type="date" name="fecha" class="form-control" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-warning w-100">Generar Resumen</button>
        </div>
    </form>

    <!-- Tabla con el resumen diario si hay datos -->
    <?php if (!empty($reservaPorFecha)): ?>
    <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-warning">
            <tr>
                <th>Producto</th>
                <th>Total unidades</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($reservaPorFecha as $reserva): ?>
            <tr>
                <td><?= $reserva['nombre'] ?></td>
                <td><?= $reserva['total'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php endif; ?>

    <a href="/panaderia-reservas/app/views/admin/PanelAdmin.php" class="btn btn-secondary mt-3 mb-4">Volver al panel</a>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; // Pie de Bootstrap ?>
</body>
</html>

    
            

