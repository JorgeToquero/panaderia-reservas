<?php

// El modelo de Producto representa  un producto con sus atributos y métodos para acceder a su información y manipularla.
class Producto {
    private $id;
    private $nombre;
    private $precio;
    private $categoria;
    private $stock_diario;
    private $fecha_creacion;
    private $descripcion;
    private $activo;
    private $conex; 
    private $imagen;
     
    
    // El constructor permite crear un producto con todos sus datos o sin datos para usar solo sus métodos
    public function __construct($conex,$id=null, $nombre=null, $precio=null, $categoria=null, $stock_diario=null, $fecha_creacion=null,$descripcion=null,$activo=null,$imagen=null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->categoria = $categoria;
        $this->stock_diario = $stock_diario;
        $this->imagen = $imagen;
        $this->fecha_creacion = $fecha_creacion;
        $this->descripcion = $descripcion;
        $this->activo = $activo;
        $this->conex = $conex;
        
    }

    // Getters y setters

    //devuelve id del producto
    public function getId() {
        return $this->id;
    }
    //devuelve nombre del producto
    public function getNombre() {
        return $this->nombre;
    }
    //devuelve precio del producto
    public function getPrecio() {
        return $this->precio;
    }
    //devuelve categoria del producto
    public function getCategoria() {
        return $this->categoria;
    }
    //devuelve stock diario del producto
    public function getStockDiario() {
        return $this->stock_diario;
    }
    //devuelve fecha de creación del producto
    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }
    //devuelve descripción del producto
    public function getDescripcion() {
        return $this->descripcion;
    }
    //devuelve si el producto está activo o no
    public function getActivo() {
        return $this->activo;
    }
    // Devuelve la imagen del producto

    public function getImagen() {
    return $this->imagen;
}
    // Permite modificar el nombre del producto
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    // Permite modificar el precio del producto
    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    // Permite modificar la categoría del producto
    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    // Permite modificar el stock diario del producto
    public function setStockDiario($stock_diario) {
        $this->stock_diario = $stock_diario;
    }
    // Permite modificar la descripción del producto
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    // Permite modificar si el producto está activo o no
    public function setActivo($activo) {
        $this->activo = $activo;
    }   
    // Permite modificar la imagen del producto
    public function setImagen($imagen) {
    $this->imagen = $imagen;
}

    //Metodos o funciones 

    // Devuelve información completa del producto
    public function mostrarInfo() {
        return "Producto: $this->nombre, Precio: $this->precio, Categoría: $this->categoria, Stock diario: $this->stock_diario, Fecha creación: $this->fecha_creacion, Descripción: $this->descripcion, Activo: " . ($this->activo ? "Sí" : "No");
    }
    /*
    "El método getAll se encarga de obtener todos los productos de la base de datos.
     Primero ejecuta una consulta SQL, luego recorre los resultados fila a fila con un bucle while, 
     y por cada fila crea un objeto Producto con sus datos. 
     Al final devuelve un array con todos los productos listos para usar."

    */
    public function getAllProducto(){
        $consulta = "SELECT * FROM productos";      // Consulta SQL para obtener todos los productos
    $resultado = mysqli_query($this->conex, $consulta);// Ejecutar la consulta
    $productos = [];                                    // Array para almacenar los productos
    while ($row = mysqli_fetch_assoc($resultado)) {     // Recorrer los resultados y crear objetos Producto
        $productos[] = new Producto($this->conex,$row['id'], $row['nombre'], $row['precio'], $row['categoria'], $row['stock_diario'], $row['fecha_creacion'],$row['descripcion'],$row['activo'],$row['imagen']);
    }
    return $productos; // Devolver el array de productos
    }
        
           //Funciones para la clase Producto: crearProducto, borrarProducto y editarProducto.
        

    // la función crearProducto recibe los datos de un nuevo producto, realiza una consulta SQL para insertar esos datos en la tabla productos de la base de datos y ejecuta esa consulta con mysqli_query.
    public function crearProducto($nombre,$precio,$categoria,$stock_diario,$descripcion,$activo,$imagen){
        $sql= "insert into productos (nombre, precio, categoria, stock_diario, descripcion, activo, imagen)
        values ('$nombre', '$precio', '$categoria', $stock_diario, '$descripcion', $activo, '$imagen')";
        mysqli_query($this->conex, $sql);
    }
    // la función borrarProducto recibe el id de un producto, realiza una consulta SQL para eliminar ese producto de la tabla productos de la base de datos y ejecuta esa consulta con mysqli_query.
    public function borrarProducto($id){
        $sql = "DELETE FROM productos WHERE id = $id";
        mysqli_query($this->conex, $sql);
    }
        // la función editarProducto recibe el id de un producto y sus nuevos datos, realiza una consulta SQL para actualizar esos datos en la tabla productos de la base de datos y ejecuta esa consulta con mysqli_query.
    public function editarProducto($id, $nombre, $precio, $categoria, $stock_diario, $descripcion, $activo, $imagen){
        $sql = "UPDATE productos SET nombre= '$nombre', precio='$precio', categoria='$categoria', stock_diario=$stock_diario, descripcion='$descripcion', activo=$activo, imagen='$imagen' WHERE id=$id";
        mysqli_query($this->conex, $sql);
    }

     // función que recibe el id del producto para obtener el precio de ese producto de la BD
        public function getPrecioByID($id){
            $sql = "SELECT precio from productos where id= $id";
            $resultado=Mysqli_query($this->conex, $sql);
            $row = mysqli_fetch_assoc($resultado);
            return $row['precio'];
        }
       // Obtiene el stock disponible de un producto para una fecha concreta
      // Resta las unidades ya reservadas ese día al stock diario del producto
    public function getStockDisponiblePorFecha($id_producto, $fecha){
    
    // Obtenemos el stock diario del producto y le restamos las reservas ya hechas para esa fecha
    // COALESCE devuelve 0 si no hay reservas ese día para evitar que devuelva NULL
    $sql = "SELECT stock_diario - COALESCE(
                (SELECT SUM(lr.cantidad) 
                 FROM lineas_reserva lr
                 JOIN reservas r ON lr.id_reserva = r.id
                 WHERE lr.id_producto = $id_producto 
                 AND r.fecha_reserva = '$fecha'
                 AND r.estado != 'cancelada'), 0
            ) as disponible
            FROM productos WHERE id = $id_producto";
    
    $resultado = mysqli_query($this->conex, $sql);
    $row = mysqli_fetch_assoc($resultado);
    return $row['disponible']; // devolvemos el stock disponible real para ese día
}
      
}
?>