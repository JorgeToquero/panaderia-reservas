<?php
// vista de la página de registro para clientes
echo '<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">';  //CSS de Bootstrap para aplicar estilos 

echo '<h1 style="color: orange; font-size: 58px;" class="text-center mb-4">Dulce y Salado</h1>';
//Imagen para mostrar el logo de la tienda
echo '<img src="../../assets/images/logo.png" class="d-block mx-auto mb-4" style="width: 200px; border-radius: 50%;">';
//vista del formulario de registro para clientes aplicando Bootstrap
echo '<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            
          <h3>Registro Cliente</h3>
            <form method="POST" action="../../../app/controllers/RegistroController.php" id="formRegistro">
              <input type="hidden" name="action" value="registro">
              Nombre: <input type="text" name="nombre" class="form-control" id="nombre"><br>
              Email: <input type="text" name="email"  class="form-control" id="email"><br>
              Teléfono: <input type="text" name="telefono" class="form-control"><br>
              Password: <input type="password" name="pass"  class="form-control" id="pass"><br>
              <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
            <a href="../../../index.php">Volver al inicio</a>
        </div>
    </div>
</div>';


echo '<script src="../../assets/js/validacion.js"></script>';

include '../../views/layouts/footer.php'; //aplicar estilos Bootstrap ccs del footer 
   
?>