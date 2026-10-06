<?php

// Busca un usuario en la BD por su email para verificar el login
// Se usa prepare para evitar inyección SQL
function buscarUsuarioPorEmail($conex, $email) {
    $stmt = mysqli_prepare($conex, "SELECT * FROM usuarios WHERE email=?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($res);
}

?>