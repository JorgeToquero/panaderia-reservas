<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Dulce y Salado</title>
<link href="app/assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

     <h1 style="color: orange; font-size: 58px"; class="text-center mb-4">Dulce y Salado</h1>

<?php
//Para mostrar mensaje de usuario registrado
if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'registro_ok') {
   echo '<div class="alert alert-success">Usuario registrado correctamente.</div>';
}
//mostar mensaje de email duplicado
if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'email_duplicado') {
   echo '<div class="alert alert-danger">email de usuario duplicado, introduce otro email.</div>';
}
//Mostrar mensaje error contraseña o emil incorrectp
 if (isset($_GET['error']) && $_GET['error'] == 'credenciales'){
   echo' <div class="alert alert-danger">Email o contraseña incorrectos.</div>';

 }

?>
<!-- Imagen para mostrar el logo de la tienda-->
<img src="app/assets/images/logo.png" class="d-block mx-auto mb-4" style="width: 200px; border-radius: 50%;"> 
<!-- Formulario para el inicio de sesión-->
<h3>Iniciar sesión</h3>
<form method="POST" action="app/controllers/UsuarioController.php" id="formLogin">
  <input type="hidden" name="action" value="login">
  <div class="mb-3">
    <label>Email:</label>
    <input type="text" name="email" class="form-control" id="email"><br>
  </div>
  <div class="mb-3">
    <label>Password:</label>
    <input type="password" name="pass" class="form-control" id ="pass"><br>
  </div>
  <button type="submit" class="btn btn-primary w-100">Entrar</button>
</form>
  <br>
      <a href="app/views/login/registro.php">¿No tienes cuenta? Regístrate</a>
      </div>
    </div>
</div>
<script src="app/assets/js/bootstrap.bundle.min.js"></script>
</body>
        <script src="app/assets/js/validacion.js"></script> <!-- enlace de JavaScript para validar el formulario-->
        <?php include 'app/views/layouts/footer.php'; //aplicar estilos Bootstrap ccs del footer ?> 
</html>