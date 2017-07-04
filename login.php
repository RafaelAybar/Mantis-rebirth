<?php

    if (isset($_POST['nombre']) && isset($_POST['pass'])) {
        $usuario = stripslashes(trim($_POST['nombre']));
        $pass = stripslashes(trim($_POST['pass']));
        if (strlen($pass)>= 8) {
                //He seguido la siguiente documentación: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
                //Definimos los parámetros de mysqli, primero estableciendo los parámetros de conexión:
                $nombreserver = "localhost";
                $usuario = "root";
                $contra = "";
                $bd = "mantis";
                $conexion = mysqli_connect($nombreserver, $usuario, $contra, $db);
            //comprobamos que podemos establecer conexión
           if ($conexion -> connect_error){
            die("No se pudo conectar ".$conexion->connect_error);
           }
           else {
               //Preparamos la consulta
               $consultaprep = $conexion -> mysqli_prepare("SELECT EXISTS (SELECT contrasena FROM jugadores WHERE (nombre = ?))");
               //Ligamos los parámetros
               $consultaprep = $conexion -> mysqli_bind_param("s", $usuario);
               //Ejecutamos la consulta
               $consultaprep ->execute();

           }
        }
        else {
            die("Mira, te comento, debes introducir los datos, ¿VALE?");
        }
    }
?>
