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
                    <td>Selección de Jugadores (mínimo 4)</td><td><?php
                    //Haremos una consulta para mostrar todos los jugores registrados
                    $nombreserver = "localhost";
                    $usuario = "rafa";
                    $contra = "Rafa-1995";
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
            if (isset($_POST['nombre'])) {
               include 'funciones.php';
                $nombres = $_POST['nombre'];
                
                //Nos aseguramos de que se cumpla el mínimo de participantes y el numero de rondas
                $numparticipantes = count($nombres);
                if ($numparticipantes < 4 || $numparticipantes > 128) {
                    die("Número de participantes incorrecto");
                }
                elseif ($numparticipantes <= 8 && $numparticipantes > 4) {
                    $numrondas = 3;
                }
                elseif ($numparticipantes <= 16 && $numparticipantes < 8) {
                    $numrondas = 4;
                }
                elseif ($numparticipantes <= 32 && $numparticipantes > 16) {
                    $numrondas = 5;
                }
                elseif ($numparticipantes <= 64 && $numparticipantes > 32 ) {
                    $numrondas = 6;
                }
                elseif ($numparticipantes <= 128 && $numparticipantes > 64){
                    $numrondas = 7;
                }
                        echo "Se van a jugar $numrondas rondas, con $numparticipantes participantes </br>";
                        //Llamamos a la función que realiza el emparejamiento
                            echo "EMPAREJAMIENTOS RONDA 1: Selecciona al ganador, o los jugadores que empatan</br>";
                            echo emparejaronda($nombres, $numparticipantes, $numronda);
                    
               }                            
            else {
                echo"Debes introducir todos los datos";
            }
        ?>
        <input type="submit" value="Enviar"> &nbsp; <input type="reset" value="Reestablecer">
        </form>
        <?php
            if (isset($_POST['gana'])) {
                $ganadores1 = $_POST['gana'];
                include 'funciones.php';
                if (empty($_POST['jempate'])) {
                    echo "No ha empatado nadie";
            }
            else {
                die("Introduce los ganadores");
            }
        }
            else {
                die("Cuando envíes la lista de participantes, selecciona quién gana o empata");
            }
        ?>
    </body>
</html>