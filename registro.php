<?php
    $usuario = $_POST['nombre'];
    $pass = $_POST['pass'];
    if (isset($usuario) && isset($pass)) {
        if (strlen($pass)>= 8) {
            //conectamos a la base de datos mysql
        }
        else {
            die("La contraseña ha de ser de 8 caracteres o más");
        }
    }
    else {
        die("Debes introducir todos los campos");
    }
?>