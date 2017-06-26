<?php

    $usuario = stripslashes(trim($_POST['nombre']));;
    $pass = stripslashes(trim($_POST['pass']));;
    
    if (isset($usuario) && isset($pass)) {
        if (strlen($pass)>= 8) {
                $conexion = mysqli_connect("localhost","root","") or
                        die("conexión errónea");
            mysqli_select_db ($conexion, "mantis")
                        or die ("no se puede seleccionar la BD" );
            //obtenemos el usuario y su contraseña del usuario registrado
            $consulta = "SELECT contrasena FROM jugadores WHERE (nombre='$usuario');";
            $comprobacion = mysqli_query($conexion,$consulta) or die("Autentificación fallida");
            $columnas = $comprobacion->fetch_array(MYSQLI_ASSOC);
          if (password_verify($pass, $columnas['contrasena'])) {
              echo "Enhorabuena, te has logueado correctamente <br>";
          }
                
            
            mysqli_close($conexion);
                    }
    }
    else {
        die("Mira, te comento, debes introducir los datos, ¿VALE?");
    }
?>