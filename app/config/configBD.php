<?php
// Configuración de la base de datos

$server = "localhost";
$user = "root";
$pass = "";
$DataBase = "panaderia_db";

//ya que se va usar la función en múltiples controladores, 
// se crea una función para crear la conexión a la base de datos y se llama desde los controladores cuando se necesite
function crearConexion(){
    global $server, $user, $pass, $DataBase;
    $conex = mysqli_connect($server, $user, $pass, $DataBase) or die("Error conexión BD");     
    return $conex;
}

?>