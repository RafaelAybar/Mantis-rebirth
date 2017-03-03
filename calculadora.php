<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculadora de premios</title>
    <link rel="stylesheet" href="bulma.css">
  </head>
  <body>
<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $cantidad = $_POST['cantidad'];
    $top2= $_POST['top2'];
    $top3 = $_POST['top3'];
    if (isset($cantidad)) {
        if (isset($top2)) {
            $primero = $cantidad * 0.6;
            $segundo = $cantidad * 0.4;
            echo "Al primero le corresponden $primero €, y al segundo $segundo €";
        }
        elseif (isset($top3)) {
            $prim = $cantidad *0.5;
            $sec = $cantidad *0.3;
            $terce = $cantidad * 0.2;
            echo "Al primero le corresponden $prim €, al segundo $sec €, al tercero $terce €";
        }
        else {
            die("Debes de seleccionar alguna de las opciones");
        }
    }
    else {
        die("No has introducido una cantidad");
    }
    
?>
  </body>
</html>