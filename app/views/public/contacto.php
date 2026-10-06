
<?php
echo '<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">';

echo '<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">';
?>

<h5>Contáctanos</h5>
<form method="POST" action="#">
    <div class="mb-3">
        <input type="text" name="nombre" class="form-control" placeholder="Nombre">
    </div>
    <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email">
    </div>
    <div class="mb-3">
        <textarea name="mensaje" class="form-control" placeholder="Mensaje"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php echo '</div></div></div>'; ?>