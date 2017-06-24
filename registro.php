<?php
    
    $usuario = stripslashes(trim($_POST['nombre']));
    $pass = stripslashes(trim($_POST['pass']));
    $pass2 = stripslashes(trim($_POST['pass2']));
    
    if (isset($usuario) && isset($pass) && isset($pass2) &&  $pass == $pass2 ) {
        if (strlen($pass)>= 8 && strlen($pass2)>= 8) {
            //ciframos la contraseña, con las funciones de php7 destinadas para ello
            // más información en https://diego.com.es/encriptacion-y-contrasenas-en-php
            $passhash = password_hash($pass, PASSWORD_DEFAULT);
            echo "La contraseña cifrada es $passhash </br>";
            //conectamos a la bd (las contraseñas son de prueba, hay que sustituirlas por otras más seguras)
            $conexion = mysqli_connect("localhost","root","") or
                        die("conexión errónea");
            mysqli_select_db ($conexion, "mantis")
                        or die ("no se puede seleccionar la BD" );
                          //realizamos la consulta para registrar al usuario
            $consulta = "INSERT INTO `jugadores` (`nombre`, `contrasena`) VALUES ('$usuario', '$passhash');";
            $insert = mysqli_query($conexion,$consulta) or die("No se ha realizado el registro, prueba con otro nombre de usuario");
            echo "<h3>Enhorabuena, te has registrado </h3>";
            mysqli_close($conexion);
                    }
        else {
            die("Comprueba que la contraseña tiene 8 caracteres o más y que la has introducido correctamente");
            }
    }
    else {
        die("Debes introducir todos los campos");
    }
?>
