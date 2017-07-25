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
                    <td>Número de rondas (mínimo 2, máximo 10)</td><td><input type="number" name="cantrondas" min="3" max="8"></td>
                </tr>
                <tr>
                    <td>Lista de Jugadores</td><td><?php
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
                       echo"Jugador ".$columna['nombre']."</br>";
                   }
                    ?></td>
                </tr>l
            </table>
        </form>
    </body>
</html>