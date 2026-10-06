<?php

// Controlador principal del panel de administración.
// Gestiona las acciones del administrador: reservas, usuarios y productos.

session_start(); // Iniciamos la sesión para verificar el rol del usuario

include_once '../config/configBD.php';// Se incluye la configuración de la base de datos para establecer la conexión
include_once '../models/Reserva.php';// Se incluye el modelo de reserva para acceder a sus métodos
include_once '../models/Usuario.php';


if (!isset($_SESSION['user_id']) || $_SESSION['rol'] != 'admin') {
    header('Location: ../../index.php');
    exit;
}

    $conex = crearConexion(); // Conectamos a la base de datos
//cambia el estado de las reservas a través del formulario en la vista reservas.php

// Cambiar estado de las reservas
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])){
    if ($_POST['action'] == 'cambiarEstado'){
        // verifica que la acción sea cambiar estado sólo para el Admin

     //recoge id y estado del formulario
    $id_reserva = $_POST['id'];
    $estado = $_POST['estado'];
    //Instaciamos el objeto y llamamos a cambiarEstado
    $objReserva = new Reserva($conex);
    $objReserva->cambiarEstado($id_reserva, $estado);

    header('Location: ../controllers/AdminController.php?action=reservas&mensaje=modificada');
    exit;
    
    } 
}

 // Carga todos los productos y muestra la vista de gestión de productos del admin.
if (isset($_GET['action']) && $_GET['action'] == 'productos') {
    
//Mensaje para mostrar cuando se cree, edite o borre un producto
// Array con los mensajes para las acciones de productos
    $mensajes = [
        'creado' => 'Producto creado con éxito',
        'editado' => 'Producto editado con éxito',
        'borrado' => 'Producto borrado con éxito'
    ];
 
// Si hay un mensaje en la URL se asigna a $mensaje para mostrarlo en la vista
    if (isset($_GET['mensaje']) && isset($mensajes[$_GET['mensaje']])) {
        $mensaje = $mensajes[$_GET['mensaje']];
    }

    include_once '../models/Producto.php'; // Se incluye el modelo de Producto para poder instanciarlo y usar sus métodos
    $objProducto = new Producto($conex);
    $productos = $objProducto->getAllProducto();
    include '../views/admin/productos.php';
    exit;
}
    
    

// Listar reservas
if (isset($_GET['action']) && $_GET['action'] == 'reservas') { // Verifica que la acción sea listar reservas
   
    // Mensaje tras modificar una reserva
    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'modificada') {
        $mensaje = 'Reserva modificada con éxito';
    }
    

    $objReserva = new Reserva($conex); // Instanciamos el objeto reserva de la BD
    $reservas = $objReserva->getAllReserva(); // LLamamos al método obtener todas las reservas
   
    include '../views/admin/reservas.php'; // Incluimos la vista de reservas para mostrar las reservas al admin
    exit;
}

// Acción listar usuarios y mostrar mensajes
if (isset($_GET['action']) && $_GET['action'] == 'listarUsuarios') {

        $mensajes = [
            'eliminado'=>'Usuario eliminado con éxito',
            'Cambiado'=> 'Rol cambiado con éxito',
            'tiene_reservas'=> 'No se puede eliminar este usuario porque tiene reservas asociadas'
    ];

    if (isset($_GET['mensaje']) && isset($mensajes[$_GET['mensaje']])){  // mensaje según la acción que se realice
     
         $mensaje = $mensajes[$_GET['mensaje']];
    
    }
    $objUsuario = new Usuario($conex);
    $usuarios = $objUsuario->listaUsuarios();// Llamamos al método para obtener la lista de usuarios
    include '../views/admin/usuarios.php'; // Incluimos la vista de usuarios para mostrar la lista al admin
    exit;
}

//Eliminar usuarios por id
if (isset($_POST['action'])&& $_POST['action'] == 'eliminarUsuarios'){

    $id = $_POST['id']; // se lo pasomos por post lo que se añada en el formulario
    
    $objUsuario = new Usuario($conex);

    // Comprobamos si tiene reservas antes de borrar
    if ($objUsuario->tieneReservas($id)) {
        header('Location: ../controllers/AdminController.php?action=listarUsuarios&mensaje=tiene_reservas');
        exit;
    }
    //sino tiene reservas borramos
    $objUsuario->eliminarUsuarios($id);
    header('Location: ../controllers/AdminController.php?action=listarUsuarios&mensaje=eliminado');
    exit;
}
   


//Cambiar rol de usuarios
if (isset($_POST['action'])&& $_POST['action'] == 'cambiarRol'){

    $id = $_POST['id']; // se lo pasomos por post lo que se añada en el formulario
    $rol = $_POST['rol']; // para el rol
    $objUsuario = new Usuario($conex);
    $usuarios = $objUsuario->cambiarRol($id, $rol);//llamamos al método para cambiar rol uduarios
    header('Location: ../controllers/AdminController.php?action=listarUsuarios&mensaje=Cambiado');//redirigimos al controlador del admin
    exit;
}
    // Para mostrar el resumen diario , primero comprobamos que se envie por get y que la acción sea reservaPorFecha
 if (isset($_GET['action']) && $_GET['action'] == 'reservaPorFecha'){

        $fecha = $_GET['fecha'] ?? date('Y-m-d');  //si no viene fecha del get usa le fecha de hoy por defecto
        $objReserva = new Reserva($conex);                       
        $reservaPorFecha = $objReserva->getReservaPorFecha($fecha);  //llamamos al método para obtener el resumen de las reservas
        include_once '../views/admin/resumenDiario.php';  // incluye las vistas del admin del resumen diario
        exit;

 }
    
?>