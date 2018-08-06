<?php
        
    if (isset($_POST['nombre']) && isset($_POST['pass']) && isset($_POST['pass2'])) {
            $usuario = stripslashes(trim($_POST['nombre']));
            $pass = stripslashes(trim($_POST['pass']));
            $pass2 = stripslashes(trim($_POST['pass2']));
            if ($usuario == "NULL" || $usuario == "null" || strlen($usuario == 0)) {
                die("El nombre debe de ser coherente");
            }
        if (strlen($pass)>= 8 && strlen($pass2)>= 8 && $pass === $pass2) {
            //ciframos la contraseña, con las funciones de php7 destinadas para ello
            // más información en https://diego.com.es/encriptacion-y-contrasenas-en-php
            //Cambiamos el coste del algoritmo para que sea más complejo
            $coste = ['coste'=> 18];
            $passhash = password_hash($pass, PASSWORD_DEFAULT,$coste);
            //conectamos a la bd (las contraseñas son de prueba, hay que sustituirlas por otras más seguras)
            $conexion = mysqli_connect("localhost","rafa","Rafa-1995", "mantis") or
                        die("conexión errónea");
            //Preparamos la consulta
            $consultaprep = $conexion -> prepare("INSERT INTO `jugadores` (`nombre`, `contrasena`) VALUES (?, ?);");
            //Ligamos los parámetros
            $consultaprep -> bind_param("ss",$usuario,$passhash);
            //Ejecutamos la consulta
            $consultaprep -> execute();
            //$insert = mysqli_query($conexion,$consulta) or die("No se ha realizado el registro, prueba con otro nombre de usuario");
            echo "<h3>Enhorabuena, te has registrado </h3>";
            $consultaprep -> close();
            $conexion -> close();
                    }
        else {
            die("Comprueba que la contraseña tiene 8 caracteres o más y que la has introducido correctamente");
            }
    }
    else {
        die("Debes introducir todos los campos");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Registro</title>
        <meta charset="UTF-8">
        <link href="bulma.css" rel="stylesheet">
        <br>
        <a href="login.html">Loguearme</a>
    </head>
    <body>
    </body>
</html>