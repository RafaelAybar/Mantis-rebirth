<?php

    if (isset($_POST['nombre']) && isset($_POST['pass'])) {
        $nickjugador = stripslashes(trim($_POST['nombre']));
        $pass = stripslashes(trim($_POST['pass']));
        //Definimos el coste hash
       $coste = ['coste'=>18];
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
               //Definimos el un objeto, que se llama usuario y sus propiedades
               $jugador = (object)[
                   'nombre'=> $nickjugador,
                   'pass'=> password_hash($pass, PASSWORD_DEFAULT,$coste)
               ];
               //Comprobamos la contraseña hasheada
               echo "Los datos del usuario son </br>";
               var_dump($jugador);
               echo "Los datos de la consulta son: </br>";
               //Preparamos la consulta
               $consultaprep = $conexion -> prepare("SELECT contrasena FROM jugadores WHERE (nombre = ?)");
               //Ligamos los parámetros
               $consultaprep -> bind_param("s", $jugador->nombre);
               //Ejecutamos la consulta
               $consultaprep ->execute();
               $consulta = $consultaprep -> fetch();
               var_dump($consulta);
                if (password_verify($pass,$consulta)) {
                   echo "Esto funciona";
                }
                else {
                    die("El nombre o la contraseña no funciona");
                }
           }
        }
        else {
            die("La contraseña no cumple los requisitos");
        }
    }
    else {
            die("Mira, te comento, debes introducir los datos, ¿VALE?");
        }
?>
