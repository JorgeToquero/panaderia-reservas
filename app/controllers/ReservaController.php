<?php
// ReservaController.php
// Controlador encargado de gestionar las reservas del cliente: crear y cancelar.

session_start();
include_once '../config/configBD.php'; // Se incluye la configuración de la base de datos para establecer la conexión
include_once '../models/Producto.php'; // Se incluye el modelo de Producto para poder acceder a sus métodos
include_once '../models/Reserva.php'; // para poder crear la reserva
include_once '../models/LineaReserva.php'; // para crear la linea de reserva


// Se crea la conexión a la base de datos usando la función definida en configBD.php
$conex = crearConexion();

//se comprueba que el formulario se envio por POST y la accion 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])){


// verifica que la accion sea crear
if ($_POST['action'] == 'crear'){

    $id_usuario = $_SESSION['user_id'];
    $id_producto = $_POST['id_producto'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $cantidad = $_POST['cantidad'];
    
$objProducto = new Producto($conex);                               //instanciamos el objeto
$precio_unidad= $objProducto->getPrecioByID($id_producto);         // obtenemos el precio de un producto por su id
$precio_total = (float)$precio_unidad * (int)$cantidad;            // Convertimos a float y entero ya que $_POST devuelve strings  //calculamos precio unidad * cantidad para obtener precio total

$estado = 'pendiente';                                             //estado por defecto

//obtenemos el stock disponible del producto
$stockDiario = (int) $objProducto->getStockDisponiblePorFecha($id_producto, $fecha); // convertimos a entero para comparar correctamente, ya que mysqli devuelve strings
$cantidad = (int) $cantidad;                                         // convertimos a entero ya que $_POST siempre devuelve strings


        if ($stockDiario < $cantidad){                                  // comprobamos que hay stock suficiente es decir que no reservemos más que la cantidad disponible
        header('Location: ../controllers/ClienteController.php?mensaje=sinStock');
        exit;
        }

    else{

         $objReserva = new Reserva($conex);
            // Crea la reserva en la BD con los datos del cliente y el precio total calculado
         $objReserva->crearReservas($id_usuario,$fecha,$hora,$precio_total,$estado);

        // Obtiene el id de la reserva recién creada para asociarla a la línea de reserva
        $id_reserva = $objReserva->getUltimoId();
        $objLinea = new LineaReserva($conex);
        // Crea la línea de reserva con el producto, cantidad y precio unitario asociados a la reserva
        $objLinea->crearLineaReserva($id_reserva, $id_producto, $cantidad, $precio_unidad);

        //Ir al catálogo 
        header('Location: ../controllers/ClienteController.php?mensaje=reservada');
        exit;

    }

}
//verifica que la acción sea cancelar
if ($_POST['action'] == 'cancelar'){
   
    $id_reserva = $_POST['id']; 
    // instanciamos el objeto y llamamos a cancelar reservas
    $objReserva = new Reserva($conex);           //instanciamos
    $objReserva->cancelarReservas($id_reserva);  //llamamos al metodo
    //redirige a mis reservas
   header('Location: ../controllers/ReservaController.php?action=misReservas&mensaje=cancelada'); 
    exit;
}

}

if (isset($_GET['action']) && $_GET['action'] == 'misReservas') {
    $objReserva = new Reserva($conex);
    $reservas = $objReserva->getReservasUsuarioById($_SESSION['user_id']); //llamamos al metodo

    if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'cancelada') {
        echo '<div class="alert alert-success">Reserva cancelada con éxito</div>'; //mensaje o aler de reserva cancelada
    }
    include '../views/reservas/misReservas.php';
    exit;
}

?>