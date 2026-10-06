<?php
//Controlador solo gestionado por el administrador.
// Controlador encargado de gestionar los productos: crear, editar y borrar.

session_start(); // Iniciamos la sesión para verificar el rol del usuario
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

include_once '../config/configBD.php'; // Se incluye la configuración de la base de datos para establecer la conexión
include_once '../models/Producto.php'; // Se incluye el modelo de Producto para poder instanciarlo y usar sus métodos


$conex = crearConexion(); // Se crea la conexión a la base de datos usando la función definida en configBD.php

$producto = new Producto($conex); // Se instancia el producto sin datos para usar sus métodos
$productos = $producto->getAllProducto(); // Se obtiene el listado de productos para mostrar en el catálogo

         // recoger datos del formulario y insertar en BD
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {

    // Si la acción es borrar, se recoge el id del producto a eliminar y se llama al método borrarProducto del modelo para eliminarlo de la base de datos.
    if ($_POST['action'] == 'borrar'){
        $id = $_POST['id'];
        $producto->borrarProducto($id);
       header('Location: ../controllers/AdminController.php?action=productos&mensaje=borrado'); // Redirigimos a la misma página para mostrar el listado actualizado sin el producto eliminado.
       exit;
       
    }

      // Si la acción es editar, se recogen los datos del formulario y se llama al método editarProducto del modelo para actualizar el producto en la base de datos.
     if ($_POST['action'] == 'editar'){
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];
        $stock_diario = $_POST['stockDiario'];
        $descripcion = $_POST['descripcion'];
        $activo = ($_POST['activo'] == 'on') ? 1 : 0;
        $imagen = $_POST['imagen'];

        $producto->editarProducto($id, $nombre, $precio, $categoria, $stock_diario, $descripcion, $activo, $imagen);
        header('Location: ../controllers/AdminController.php?action=productos&mensaje=editado');
        exit;
       
    }
    // Si la acción es crear, se recogen los datos del formulario y se llama al método crearProducto del modelo para insertar el nuevo producto en la base de datos.
    if ($_POST['action'] == 'crear') {

    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $stock_diario = $_POST['stockDiario'];
    $descripcion = $_POST['descripcion'];
    $activo = ($_POST['activo'] == 'on') ? 1 : 0;
    $imagen = $_POST['imagen'];

    // Llamamos al método crearProducto del modelo para insertar el nuevo producto en la base de datos.
    $producto->crearProducto($nombre, $precio, $categoria, $stock_diario, $descripcion, $activo, $imagen);
       header('Location: ../controllers/AdminController.php?action=productos&mensaje=creado'); // Redirigimos a la misma página para mostrar el nuevo producto en el listado.
       exit;
    
    }

       
    }

