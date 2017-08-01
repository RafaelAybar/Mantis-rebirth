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
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
        <?php
            //Nos aseguramos de que la cantidad de rondas sea un número entero
            if (isset($_POST['cantrondas']) && isset($_POST['nombre']) && is_numeric($_POST['cantrondas'])) {
                $cantrondas = (int) $_POST['cantrondas'];
                $nombres = $_POST['nombre'];
                
                //Nos aseguramos de que se cumpla el mínimo de participantes
                $numparticipantes = count($nombres);
                    if ($numparticipantes < 4) {
                        echo "Debes seleccionar cuatro o más participantes";
                        }
                    else {
                        echo "Se van a jugar $cantrondas rondas, con $numparticipantes participantes";
                    }   
                }
       
            else {
                echo"Debes introducir todos los datos";
            }
        ?>
    </body>
</html>