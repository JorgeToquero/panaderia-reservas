<?php

class Reserva{
    private $id;
    private $id_usuario;
    private $estado;
    private $fecha_reserva; 
    private $hora_reserva;
    private $precio_total;
    private $fecha_creacion;
    private $conex;

    public function __construct($conex,$id_usuario=null, $estado=null, $fecha_reserva=null, $hora_reserva=null, $fecha_creacion=null, $precio_total=null, $id=null) {
        $this->id = $id;
        $this->id_usuario = $id_usuario;
        $this->estado = $estado;
        $this->fecha_reserva = $fecha_reserva;
        $this->hora_reserva = $hora_reserva;
        $this->fecha_creacion = $fecha_creacion;
        $this->precio_total = $precio_total;
        $this->conex = $conex;
    }

    // Getters y setters  

    // Devuelve el id del usuario que hizo la reserva
    public function getIdUsuario() {
        return $this->id_usuario;
    }
        // Devuelve el id de la reserva    
        public function getid(){
        return $this->id;
        }

    // Devuelve el estado de la reserva (pendiente, confirmada, cancelada)
    public function getEstado() {   
        return $this->estado;
    }   
    // Devuelve la fecha de la reserva   
    public function getFechaReserva() {
        return $this->fecha_reserva;
    }
    // Devuelve la hora de la reserva
    public function getHoraReserva() {
        return $this->hora_reserva;
    }
    // Devuelva la fecha de creación de la reserva
    public function getFecha_creacion() {
        return $this->fecha_creacion;
    }

    // Devuelve el precio total de la reserva
    public function getPrecioTotal() {  
        return $this->precio_total;
    }
    // Permite modificar el estado de la reserva
    public function setEstado($estado) {
        $this->estado = $estado;
    }

     // Devuelve información completa de la reserva
    public function mostrarInfo() {
        return "reserva: $this->id_usuario, Estado: $this->estado, Fecha: $this->fecha_reserva, Hora: $this->hora_reserva, Precio total: $this->precio_total";
    }
    /*
    "El método getAll se encarga de obtener todas las reservas de los usuarios de la base de datos.
     Primero ejecuta una consulta SQL, luego recorre los resultados fila a fila con un bucle while, 
     y por cada fila crea un objeto reserva con sus datos. 
     Al final devuelve un array con todos las reservas listas para usar."

    */
    public function getAllReserva(){
        $consulta = "SELECT * FROM reservas";      // Consulta SQL para obtener todas las reservas
    $resultado = mysqli_query($this->conex, $consulta);// Ejecutar la consulta
    $reservas = [];                                    // Array para almacenar las reservas
    while ($row = mysqli_fetch_assoc($resultado)) {     // Recorrer los resultados y crear objetos Reserva
        $reservas[] = new Reserva($this->conex,$row['id_usuario'],
         $row['estado'], $row['fecha_reserva'],$row['hora_reserva'],$row['fecha_creacion'],
         $row['total'],$row['id']);
    }
    return $reservas; // Devolver el array de reservas
    }

    //función para crear reservas de productos
    public function crearReservas($id_usuario,$fecha_reserva,$hora_reserva,$precio_total,$estado){
        $sql = "insert into reservas(id_usuario,fecha_reserva,hora_reserva,total,estado)
        values('$id_usuario' ,'$fecha_reserva' ,'$hora_reserva' ,'$precio_total' ,'$estado')";
        mysqli_query($this->conex, $sql);
            
    }

    //función para cancelar reservas
    
 public function cancelarReservas($id){
        $sql = "UPDATE reservas SET estado = 'cancelada' WHERE id = $id"; //consulta sql la tabla reservas por id
        mysqli_query($this->conex, $sql);
 }

    //función para obtener el id de la reserva
    public function getUltimoId(){

        return mysqli_insert_id($this->conex);
    }

    //función que obtiene las reservas de un susuario por su id
    public function getReservasUsuarioById($id_usuario){

        $consulta= "SELECT * from reservas WHERE id_usuario= $id_usuario";//consulta SQL en reservas para filtar por id_usuario
        $resultado = mysqli_query($this->conex, $consulta); //ejecutamos la consulta

        $reservas=[];                                       //array para almacenar las reservas

    while($row= mysqli_fetch_assoc($resultado)){            //recorremos los resultados

        //instanciamos el objeto con sus campos de BD y lo guardamos en el array
        $reservas[] = new Reserva($this->conex, $row['id_usuario'],$row['estado'],$row['fecha_reserva'],$row['hora_reserva'],$row['fecha_creacion'],$row['total'],$row['id']);
     
    }
      return $reservas; //devolvemos el array de reservas

    }

    // función para cambiar estado de una reserva solo para el admin

   public function cambiarEstado($id, $estado){
    $sql = "UPDATE reservas SET estado = '$estado' WHERE id = $id"; 
    
    if (!mysqli_query($this->conex, $sql)) {
        echo mysqli_error($this->conex);
    }
   
    }

    // Consulta las líneas de reserva agrupadas por producto filtrando por fecha
    // Devuelve un array con el nombre del producto y el total de unidades reservadas
    public function getReservaPorFecha($fecha){

        $sql = " SELECT p.nombre, sum(lineas_reserva.cantidad) 
        AS total FROM lineas_reserva JOIN reservas ON lineas_reserva.id_reserva = reservas.id 
        JOIN productos p ON lineas_reserva.id_producto = p.id
        WHERE DATE(reservas.fecha_reserva) = ? GROUP BY p.nombre";

       $stmt = mysqli_prepare ($this->conex, $sql);              // Preparar la consulta con el placeholder
       mysqli_stmt_bind_param ($stmt, "s", $fecha);      // Vincular la fecha como parámetro string
       mysqli_stmt_execute ($stmt);                              // Ejecutar la consulta
       $resultado = mysqli_stmt_get_result($stmt);               // Obtener el resultado
       $reservaFecha = [];
       while($row= mysqli_fetch_assoc($resultado)){
               $reservaFecha[] = $row;
       }  
        return $reservaFecha;
    }

}

?>