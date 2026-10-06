<?php
// Vista que muestra las reservas del cliente logueado.
// Permite cancelar reservas pendientes.
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mis Reservas</title>
</head>
<!-- Flex column para que el footer quede siempre al fondo de la página -->
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../layouts/header.php'; // Incluimos el header con la navbar de Bootstrap ?>

<div class="container mt-5 flex-grow-1">
    <h1 class="mb-4">Mis Reservas</h1>

    <!-- Tabla Bootstrap para mostrar las reservas del cliente -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($reservas as $reserva){ ?>
            <tr>
                <td><?= $reserva->getFechaReserva() ?></td>
                <td><?= $reserva->getHoraReserva() ?></td>
                <td><?= $reserva->getEstado() ?></td>
                <td><?= $reserva->getPrecioTotal() ?> €</td>
                <td>
          <!-- Botón para cancelar reservas, solo visible si están pendientes -->
           <?php if ($reserva->getEstado() == 'pendiente'){ ?>
              <form method="POST" action="/panaderia-reservas/app/controllers/ReservaController.php">
                 <input type="hidden" name="action" value="cancelar">
                 <input type="hidden" name="id" value="<?= $reserva->getId() ?>">
                 <button type="submit" class="btn btn-danger btn-sm">Cancelar reserva</button>
               </form>
            <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; // Pie de Bootstrap ?>
</body>
</html>