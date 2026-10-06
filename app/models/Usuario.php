<?php

class usuario {
    private $id;
    private $nombre;
    private $email;
    private $telefono;
    private $pass;
    private $conex;
    private $fecha_registro;
    private $rol;

            // Los atributos se inicializan a null por defecto para permitir instanciar
            // la clase sin datos cuando solo se necesita usar sus métodos (ej: getAll())
            public function __construct($conex,$id=null, $nombre=null, $email=null, $telefono=null, $pass=null, $fecha_registro=null, $rol=null) {
                $this->id = $id;
                $this->nombre = $nombre;
                $this->email = $email;
                $this->telefono = $telefono;
                $this->pass = $pass;
                $this->rol = $rol;
                $this->fecha_registro = $fecha_registro;
                $this->conex = $conex;
            }

            // Getters y setters

            // devuelve el nombre del usuario
            public function getNombre() {
                return $this->nombre;
            }
            // devuelve el email del usuario
            public function getEmail(){
                return $this->email;
            }
            // devuelve el teléfono del usuario
            public function getTelefono(){
                return $this->telefono;
            }
            //devulve el rol del usuario
            public function getRol(){
                return $this->rol;
            }
            // devuelve la fecha de registro del usuario
            public function getFechaRegistro(){
                return $this->fecha_registro;
            }

            //permite modificar el nombre del usuario
            public function setNombre($nombre) {
                $this->nombre = $nombre;
            }

            //permite modifucar el rol del usuario
            public function setRol($rol) {
                $this->rol = $rol;
            }

            // permite modificar la contraseña del usuario
            public function setPass($pass) {
            $this->pass = password_hash($pass, PASSWORD_DEFAULT);
            }

            // Devuelve información completa del usuario.
    public function mostrarInfo() {
        return "usuario: $this->nombre, Email: $this->email, Teléfono: $this->telefono, Rol: $this->rol, Fecha registro: $this->fecha_registro";
    }
    /*
    "El método getAll se encarga de obtener todos los usuarios de la base de datos.
     Primero ejecuta una consulta SQL, luego recorre los resultados fila a fila con un bucle while, 
     y por cada fila crea un objeto usuario con sus datos. 
     Al final devuelve un array con todos los usuarios listos para usar."

    */
    public function getAllUsuario(){
        $consulta = "SELECT * FROM usuarios";      // Consulta SQL para obtener todos los usuarios
        $resultado = mysqli_query($this->conex, $consulta);// Ejecutar la consulta
             $usuarios = [];                                    // Array para almacenar los usuarios
         while ($row = mysqli_fetch_assoc($resultado)) {     // Recorrer los resultados y crear objetos Usuario
        $usuarios[] = new Usuario($this->conex,$row['id'], $row['nombre'], $row['email'], $row['telefono'],$row['pass'],$row['fecha_registro'],$row['rol']);
    }
    return $usuarios; // Devolver el array de usuarios
    }

    // función pra obtener todos los usuarios
    public function listaUsuarios(){

    $sql= "SELECT * FROM  usuarios";  // consultar todos los Usuarios de la tabla usuarios
    $resultado = mysqli_query($this->conex, $sql); // guardar la consulta en resultados
    $usuarios = [];                                // creamos el array usuarios
   while ($row = mysqli_fetch_array($resultado)){  // recorremos todos los usuarios con un bucle

             $usuarios[]= $row;                   //  y los guardamos en el array usuarios
   }
   
    return $usuarios; //devolvemos todos los usuarios
    }

    // Función para eliminar usuarios
    public function eliminarUsuarios($id){
        
        $sql= "DELETE FROM usuarios WHERE id = $id";
        mysqli_query($this->conex, $sql);
    }
    
    //función para comprobar si un usuario tiene reservas
    public function tieneReservas($id) {
    $sql = "SELECT COUNT(*) as total FROM reservas WHERE id_usuario = $id";
    $resultado = mysqli_query($this->conex, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    return $fila['total'] > 0;
    }

    //función para Cambiar el rol a los usuarios
    public function cambiarRol($id, $rol){

        $sql = "UPDATE usuarios SET  rol = '$rol' WHERE id = $id";
        mysqli_query($this->conex, $sql);
        
    }

}

?>