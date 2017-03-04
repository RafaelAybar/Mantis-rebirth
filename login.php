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
            $consulta = "SELECT nombre FROM jugadores WHERE EXISTS (nombre='$usuario') AND(contrasena='$passcif');";
            $insert = mysqli_query($conexion,$consulta) or die("Autentificación fallida");
            mysqli_close($conexion);
                    }
    }
?>