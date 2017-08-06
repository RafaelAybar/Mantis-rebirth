<?php
session_start();
//Comprobamos que es una cadena
if (isset($_SESSION['nick']) && isset($_SESSION['instante'])) {
    echo "Bienvenido ".$_SESSION['nick']." , has iniciado sesión en la fecha ".$_SESSION['instante']."</br>";
    $fechanueva = date("Y-m-d H:i:s");
    echo "</br>";
    //Pasamos la cadena a valores de feccha
    $fecha1 = date_create($_SESSION['instante']);
    $fecha2 = date_create($fechanueva);
    //Calculamos la diferencia
    $diferencia = date_diff($fecha1,$fecha2);
    //Especificamos que si la difencia es mayor de 4 horas la sesión caduque
}
else {
    die("Debes hacer el login");
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Torneo</title>
        <meta charset="UTF-8">
        <link href="bulma.css" rel="stylesheet">
    </head>
    <body>
        <h1>Bienvenido a la web de creación de torneos de Open-Mantis</h1>
        </br>
        <h5>Para crear el torneo introduce los siguientes elentos:</h5>
        <form id="espectorneo" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table>
                <tr>
                    <td>Número de rondas (mínimo 3, máximo 10)</td><td><input type="number" name="cantrondas" min="3" max="8" required></td>
                </tr>
                <tr>
                    <td>Selección de Jugadores (mínimo 4)</td><td><?php
                    //Haremos una consulta para mostrar todos los jugores registrados
                    $nombreserver = "localhost";
                    $usuario = "root";
                    $contra = "";
                    $bd = "mantis";
                    $conexion = mysqli_connect($nombreserver, $usuario, $contra, $bd) or die("No se pudo conectar");
                    
                    //Preparamos la consulta
                    $consulta="SELECT nombre FROM jugadores";
                    $resultado = $conexion -> query($consulta);
                    //Mostramos todos los nombres
                   while ($columna = $resultado -> fetch_assoc()) {
                      $nombre = $columna['nombre'];
                      echo"Jugador ".$nombre."<input type='checkbox' name='nombre[]' value='$nombre'>"."</br>";
                   }
                    ?></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Enviar"></td><td><input type="reset" value="Reestablecer"></td>
                </tr>
            </table>
        </form>
        <!-- Muy importante asigarle un ID a cada formulario, para evittar problemas -->
        <form id="formboton" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php
            //Nos aseguramos de que la cantidad de rondas sea un número entero
            if (isset($_POST['cantrondas']) && isset($_POST['nombre']) && is_numeric($_POST['cantrondas'])) {
                $cantrondas = (int) $_POST['cantrondas'];
                $nombres = $_POST['nombre'];
                
                //Nos aseguramos de que se cumpla el mínimo de participantes y el numero max y min de rondas
                $numparticipantes = count($nombres);
                if ($numparticipantes < 4) {
                        echo "Debes seleccionar cuatro o más participantes";
                        }
                    else {
                        echo "Se van a jugar $cantrondas rondas, con $numparticipantes participantes </br>";
                        //Procedemos a emparejar a los usuarios, si son pares o no
                        if ($numparticipantes % 2 == 0) {
                            echo "EMPAREJAMIENTOS RONDA 1:</br>";
                            //Añadimos el emparejamiento de la primera ronda
                            shuffle($nombres); //Mezclamos los nombres
                            for ($i=0; $i < count($nombres) ; $i+=2) { //El operador += establece el valor de $i como si se hubiera dicho $i = $i+2;
                                echo $nombres[$i]." vs ".$nombres[$i+1]."<br>";
                        }                  
                        }
                        else {
                            echo "EMPAREJAMIENTOS RONDA 1: Selecciona al ganador, o los jugadores que empatan</br>";
                            $bye = "BYE";
                            //Añadimos el bye, al array para indicar que el que se quede solo tenga la victoria automática
                            array_push($nombres, $bye);
                            shuffle($nombres);
                            for ($i=0; $i < count($nombres) ; $i+=2) {
                                $nombreizda = $nombres[$i];
                                $nombredcha = $nombres[$i+1];
                                 echo $nombres[$i]." <input type='checkbox' name='gana[]' value='$nombreizda'>"." vs ".$nombres[$i+1]." <input type='checkbox' name='gana[]' value='$nombredcha'>"." Empate <input type='checkbox' name='empate[]' value='Empate'>"."<br>";
                            }
                    }
                }
            }
            else {
                echo"Debes introducir todos los datos";
            }
        ?>
        <input type="submit" value="Enviar"> &nbsp; <input type="reset" value="Reestablecer">
        </form>
        <?php
            if (isset($_POST['gana'])) {
                $ganadores = $_POST['gana'];
                echo"<br>";
                echo"Ganan la primera ronda: ".implode(", ", $ganadores);
            }
            else {
                die("Cuando envíes la lista de participantes, selecciona quién gana o empata");
            }
        ?>
    </body>
</html>