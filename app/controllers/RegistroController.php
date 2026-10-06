<?php
// Controlador encargado de gestionar el registro de nuevos clientes.
// Valida los datos del formulario, hashea la contraseña y guarda el usuario en la BD.

session_start();  // Iniciar sesión para manejar datos de usuario
include_once '../config/configBD.php'; //incluye la configuración de la BD

$conex = crearConexion(); // Crear conexión a la base de datos usando la función definida en configBD.php

         // Verificar que se ha enviado una acción válida sino redirigir al inicio
         if (!isset($_POST['action'])) {
    header('Location: ../../index.php');
    exit;
}

// si la acción es registro, procesar el registro del usuario
 if ($_POST['action'] == 'registro') {
 $nombre  = $_POST['nombre'];
$email    = $_POST['email'];
$password = $_POST['pass'];
$telefono = $_POST['telefono'] ?? '';  // Opcional

    // Validaciones PHP

    // Validar campos obligatorios
if (empty($nombre) || empty($email) || empty($password)) {
    echo " Todos los campos son obligatorios. <a href='../../index.php'>Volver</a>";
    exit;
}

// Validar formato de email y no tenga carecteres raros
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo " Email no válido. <a href='../../index.php'>Volver</a>";
    exit;
}

//comprueba que la contraseña tenga al menos 6 caracteres
if (strlen($password) < 6) {
    echo " La contraseña debe tener mínimo 6 caracteres. <a href='../../index.php'>Volver</a>";
    exit;
}
    // Encriptar contraseña en un  hash cifrado antes de ser guardada en la bd
    $hash = password_hash($password, PASSWORD_DEFAULT); 

    // Comprobar si el email ya existe
    $compruebaSql = "SELECT id FROM usuarios WHERE email = '$email'";
    $compruebaSql = mysqli_query($conex, $compruebaSql);

    if (mysqli_num_rows($compruebaSql) > 0) {
        header('Location: ../../index.php?mensaje=email_duplicado');
        exit;
}

    //insertamos los datos del nuevo usuario en la base de datos con rol cliente por defecto
    $sql = "INSERT INTO usuarios (nombre, email, password, telefono, rol) 
        VALUES ('$nombre', '$email', '$hash', '$telefono', 'cliente')";

    // Ejecutar la consulta y verificar si se ha registrado correctamente
    if (mysqli_query($conex, $sql)) {
       header('Location: ../../index.php?mensaje=registro_ok');
        exit;

    } else {
        echo " Error: " . mysqli_error($conex);
    }
}

?>