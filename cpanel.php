<?php
session_start();
echo "Bienvenido ".$_SESSION['nick']." , has iniciado sesión en la fecha ".$_SESSION['instante']."</br>";
$fechanueva = date("Y-m-d H:i:s");
echo "</br>";
//Comprobamos que es una cadena
if (is_string($fechanueva) && is_string($_SESSION['instante'])) {
    //Pasamos la cadena a valores de feccha
    $fecha1 = date_create($_SESSION['instante']);
    $fecha2 = date_create($fechanueva);
    //Calculamos la diferencia 
    $diferencia = date_diff($fecha1,$fecha2);
    //Especificamos que si la difencia es mayor de 4 horas la sesión caduque
    if ($diferencia['h'] < 4) {
        echo "Se ha agotado el tiempo de sesión";
        session_unset();
        session_destroy();
    }

}
else {
    die("No se pudo realizar");
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Panel de control</title>
        <meta charset="UTF-8">
        <link href="bulma.css" rel="stylesheet">
    </head>
    <body>
        <h1>Panel de control de Open-Mantis</h1>
        <form action="torneo.php" method="POST">
            <table>
                <tr>
                    <td><a href="creatorneo.php">Crear torneo</a></td>
                    <td><a href="statsplayer.php">Estadísticas de jugadores</a></td>
                    <td><a href="statsmazo.php">Estadísticas de mazo</a>
                </tr>
                <tr>
                    <td>Logout (en progreso)</td>
                </tr>
            </table>
        </form>
    </body>
</html>