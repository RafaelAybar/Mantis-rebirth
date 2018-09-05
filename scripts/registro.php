<?php    
    if (isset($_POST['nombre']) && isset($_POST['pass']) && isset($_POST['pass2'])) {
        #preg_match() puede devolver booleanos o enteros
    
            if (preg_match('/^[a-z0-9_\-]+$/i',$_POST['nombre']) === 1){
                $usuario = $_POST['nombre'];
                if ($usuario == "NULL" || $usuario == "null" || strlen($usuario) == 4) {
                    die("El nombre debe de ser coherente");
                }
                $pass = $_POST['pass'];
                $pass2 = $_POST['pass2'];
                
                if ($pass === $pass2 && strlen($pass) > 8) {
            //ciframos la contraseña, con las funciones de php7 destinadas para ello https://diego.com.es/encriptacion-y-contrasenas-en-php
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
                        die("La contraseña no es válida <a href='registro.html'> Volver al registro </a>");
                    }
                }
                else {
                    die("El nombre no es válido. <a href='registro.html'> Volver al registro </a>");
                }
        }
    else {
        die("Debes introducir todos los campos. <a href='registro.html'> Volver al registro </a>");
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