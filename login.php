<?php

    if (isset($_POST['nombre']) && isset($_POST['pass'])) {
        $usuario = stripslashes(trim($_POST['nombre']));
        $pass = stripslashes(trim($_POST['pass']));

        //ciframos la contraseña
        $coste = ['coste'=>18];
        $passhash = password_hash($pass, PASSWORD_DEFAULT,$coste);
        if (strlen($pass)>= 8) {
                //He seguido la siguiente documentación: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
                //Definimos los parámetros de mysqli, primero estableciendo los parámetros de conexión:
                $nombreserver = "localhost";
                $usuario = "root";
                $contra = "";
                $bd = "mantis";
                $conexion = mysqli_connect($nombreserver, $usuario, $contra, $bd);
            //comprobamos que podemos establecer conexión
           if ($conexion -> connect_error){
            die("No se pudo conectar ".$conexion->connect_error);
           }
           else {
               //Preparamos la consulta
               $consultaprep = $conexion -> prepare("SELECT contrasena FROM jugadores WHERE (nombre = ?) AND (contrasena = ?))");
               //Ligamos los parámetros
               $consultaprep -> bind_param("ss", $usuario, $passhash);
               //Ejecutamos la consulta
               $consultaprep ->execute();
               echo "$consultaprep";
               $consultaprep -> close();
               $conexion -> close();
           }
        }
        else {
            die("Mira, te comento, debes introducir los datos, ¿VALE?");
        }
    }
?>
