<?php
    $usuario = $_POST['nombre'];
    $pass = $_POST['pass'];
    if (isset($usuario) && isset($pass)) {
        if (strlen($pass)>= 8) {
            //ciframos la contraseña
            $secreto = "Hecho por Rafael Aybar Segura";
            $passcif = hash_hmac('sha1',$pass,$secreto);
            //conectamos a la bd (las contraseñas son de prueba, hay que sustituirlas por otras más seguras)
            $conexion = mysqli_connect("localhost","root","") or
                        die("conexión errónea");
            mysqli_select_db ($conexion, "mantis")
                        or die ("no se puede seleccionar la BD" );
                          //realizamos la consulta para registrar al usuario
            $consulta = "INSERT INTO `jugadores` (`nombre`, `deck`, `contrasena`) VALUES ('$usuario', 'NULL', '$passcif');";
            $insert = mysqli_query($conexion,$consulta) or die("La inserción no se pudo realizar");
            echo "<h3>Enhorabuena, te has registrado </h3>";
            mysqli_close($conexion);
                    }
      else {
            die("La contraseña ha de ser de 8 caracteres o más");
        }
    }
    else {
        die("Debes introducir todos los campos");
    }
?>