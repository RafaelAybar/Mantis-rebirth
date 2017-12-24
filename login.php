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
                $usuario = "rafa";
                $contra = "Rafa-1995";
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
                ];

               //Preparamos la consulta
               $consultaprep = $conexion -> prepare("SELECT contrasena FROM jugadores WHERE (nombre = ?)");
               //Ligamos los parámetros
               $consultaprep -> bind_param("s", $jugador->nombre);
               //Ejecutamos la consulta
               $consultaprep ->execute();
               //Ligamos el resultado a una variable, un string
               $consultaprep -> bind_result($resultado);
               $consultaprep -> fetch();
               
               //Comprobamos que coinciden las contraseñas
               if (password_verify($pass,$resultado)) {
                    session_start();
                    $_SESSION['nick'] = $nickjugador;
                    $_SESSION['instante'] = date("Y-m-d H:i:s");
                    echo "Enhorabuena ".$_SESSION['nick'].", te has logueado, puedes acceder a <a href='cpanel.php'>Panel de control</a>";
                }
                else {
                    die("El nombre o la contraseña no coinciden");
                }
                $consultaprep -> close();
                $conexion ->close();
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
<html lang="es">
    <head>
        <title>Registro</title>
        <meta charset="UTF-8">
        <link href="bulma.css" rel="stylesheet">
        <br>
    </head>
    <body>
    </body>
</html>