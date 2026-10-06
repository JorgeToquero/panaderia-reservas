
<?php
//para poder cerrar las sesiones
session_start();
session_destroy();
header('Location: ../../index.php');
exit;
?>