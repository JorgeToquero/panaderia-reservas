<?php

// Controlador encargado de gestionar las vistas del cliente.
// Muestra el catálogo de productos disponibles para realizar reservas.

session_start();  //iniciar sesión

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php'); //si la sesión es diferente al id del usuario vover al index
    exit;
}
include_once '../config/configBD.php'; // Se incluye la configuración de la base de datos para establecer la conexión
include_once '../models/Producto.php'; // se incluye el modelo de Producto para poder instanciarlo y usar sus métodos
$conex = crearConexion(); //crear conexión a la BD
$objetoProducto = new Producto($conex); //instanciamos 

//mensaje de reserva realizada cuando haga la comprobación
if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'reservada') {
    echo '<div class="alert alert-success">Reserva realizada con éxito</div>';  
}

//mensaje de sin stock realizada cuando haga la comprobación
if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'sinStock') {
   echo '<div class="alert alert-danger">No hay stock suficiente para realizar la reserva</div>'; 
    
}

$productos = $objetoProducto->getAllProducto();// llamamos al método para mostrar los productos
include '../views/public/catalogo.php'; //incluimos la vista al catalogo de productos

?>
