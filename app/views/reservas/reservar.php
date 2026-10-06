<?php
// Vista que muestra el formulario para realizar una reserva de un producto.
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mis Reservas</title>
</head>
<!-- Flex column para que el footer quede siempre al fondo de la página -->
<body class="d-flex flex-column min-vh-100">

<?php include '../layouts/header.php'; // Incluimos el header con la navbar de Bootstrap ?>

    <h1>Gestión de reservas</h1>

<div class="container mt-4 flex-grow-1">
  <div class="row justify-content-center">
    <div class="col-md-4">
            <h3>Realizar reserva</h3>
     <form method="POST" action="../../controllers/ReservaController.php" id="formReserva">
            <input type="hidden" name="action" value="crear">
            <input type="hidden" name="id_producto" value="<?php echo $_GET['id_producto']; ?>">
         <div class="mb-3">
             <label>Fecha</label>
             <input type="date" name="fecha" class="form-control" id="fecha">
         </div>
         <div class="mb-3">
             <label>Hora</label>
             <input type="time" name="hora" class="form-control" id="hora">
         </div>
         <div class="mb-3">
             <label>Cantidad</label>
             <input type="number" name="cantidad" class="form-control" id="cantidad">
         </div>
        <button type="submit" class="btn btn-primary w-100">Reservar</button>
     </form>
        </div>
    </div>
</div>
         <script src="/panaderia-reservas/app/assets/js/validacion.js"></script>
         <?php include '../../views/layouts/footer.php'; //aplicar estilos Bootstrap ccs del footer  ?> 
</body>
</html>


