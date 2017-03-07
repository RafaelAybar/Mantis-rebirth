<?php
    $usuario = $_POST['nombre'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    if (isset($usuario) && isset($pass) && ($pass2==$pass)) {
        if (strlen($pass)>= 8 ) {
            //ciframos la contraseña
            $passcif = password_hash($pass,PASSWORD_BCRYPT) ;
            //conectamos a la bd (las contraseñas son de prueba, hay que sustituirlas por otras más seguras)
            $conexion = mysqli_connect("localhost","root","") or
                        die("conexión errónea");
            mysqli_select_db ($conexion, "mantis")
                        or die ("no se puede seleccionar la BD" );
                          //realizamos la consulta para registrar al usuario
            $consulta = "INSERT INTO `jugadores` (`nombre`, `contrasena`) VALUES ('$usuario', '$passcif');";
            $insert = mysqli_query($conexion,$consulta) or die("La inserción no se pudo realizar");
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
