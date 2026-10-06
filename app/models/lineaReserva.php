<?php

class lineaReserva{

        private $id;
        private $id_reserva;
        private $id_producto;
        private $cantidad;
        private $precio_unidad;
        private $conex;

        public function __construct($conex,$id_reserva=null, $id_producto=null, $cantidad=null, $precio_unidad=null, $id=null) {
            $this->id = $id;
            $this->id_reserva = $id_reserva;
            $this->id_producto = $id_producto;
            $this->cantidad = $cantidad;
            $this->precio_unidad = $precio_unidad;
            $this->conex = $conex;
        }

        // Getters y setters

        // Devuelve el id 
        public function getid(){
            return $this->id;
        }
        // Devuelve el id de la reserva a la que pertenece esta línea
        public function getIdReserva() {
            return $this->id_reserva;
        }
        // Devuelve el id del producto reservado
        public function getIdProducto() {
            return $this->id_producto;
        }
        // Devuelve la cantidad de productos reservados
        public function getCantidad() {
            return $this->cantidad;
        }
        // Devuelve el precio unitario del producto reservado
        public function getPrecioUnidad() {
            return $this->precio_unidad;
        }

            // Permite modificar la cantidad de productos reservados    
        public function setCantidad($cantidad) {
            $this->cantidad = $cantidad;
        }
            // Permite modificar el precio unitario del producto reservado      
        public function setPrecioUnidad($precio_unidad) {
            $this->precio_unidad = $precio_unidad;  
        }

        // Devuelve información básica de la línea de reserva
        public function mostrarinfo(){
            return "linea reserva: $this->id_reserva, producto: $this->id_producto, cantidad: $this->cantidad, precio unidad: $this->precio_unidad";    
        }
        /* El método getAllLineaReserva obtiene todas las líneas de una reserva concreta.
         Recibe el id de la reserva, hace una consulta SQL para obtener todas la línesa de esa reserva y recorre los resultados con while obtiene los datos de cada línea. 
         Crea un objeto lineaReserva con esos datos. 
         Al final devuelve un array con todas las líneas de reserva encontradas.*/
        public function getAllLineReserva($id_reserva) {
            $lineas = [];
            $sql = "SELECT * FROM lineas_reserva WHERE id_reserva = $id_reserva";
            $result = mysqli_query($this->conex, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $linea = new lineaReserva($this->conex, $row['id_reserva'], $row['id_producto'], $row['cantidad'], $row['precio_unidad'], $row['id']);
                $lineas[] = $linea;
            }
            return $lineas;
        }

        //// Inserta una línea de reserva con el producto y cantidad asociados a una reserva concreta
     public function crearLineaReserva($id_reserva, $id_producto, $cantidad, $precio_unidad) {
     $sql = "INSERT INTO lineas_reserva (id_reserva, id_producto, cantidad, precio_unitario) 
            VALUES ('$id_reserva', '$id_producto', '$cantidad', '$precio_unidad')";
            mysqli_query($this->conex, $sql);
}
}

?>