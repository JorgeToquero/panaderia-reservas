<?php

// Controlador encargado de gestionar la autenticación de usuarios.
// Procesa el inicio de sesión y redirige según el rol del usuario (admin o cliente).

session_start();
include_once '../config/configBD.php'; //incluye el archivo de configuración de la base de datos
include_once '../includes/funciones.php'; //incluye el archivo de funciones 

$conex = crearConexion(); // Crear conexión a la base de datos usando la función definida en configBD.php


if ($_POST['action'] == 'login') {  // Si la acción es login, se procesa el inicio de sesión
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Buscamos el usuario solo por email (no por password, porque está hasheada)
    $row = buscarUsuarioPorEmail($conex, $email); //función que devuelve el usuario con ese email o null si no existe

    // password_verify compara la contraseña introducida con el hash guardado en la BD
    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['nombre']  = $row['nombre'];
        $_SESSION['rol']     = $row['rol'];

        // Redirigimos según el rol del usuario
        if ($row['rol'] == 'admin') {
            header('Location: ../views/admin/PanelAdmin.php');
        } else {
           
           header('Location: ../controllers/ClienteController.php');
        }
        exit;
    } else {
        // Redirigimos al index con mensaje de error si las credenciales son incorrectas
             header('Location: ../../index.php?error=credenciales');
             exit;
    }
}
?>