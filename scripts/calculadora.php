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
    //Comprobamos que no se puedan marcar las dos opciones a la vez
    if (isset($_POST['cantidad']) && isset($_POST['top2']) && isset($_POST['top3'])) {
    die("Debes seleccionar entre top 2 o top 3 <a href='calculadora.html'> Volver a calcular</a>");
    }
    //Comprobamos que la cantidad no está vacía
    elseif (empty($_POST['cantidad'])) {
        die("No has introducido la cantidad <a href='calculadora.html'> Volver a calcular</a>");
    }
    else{
        //Comprobamos que el dato introducido es un número
            if (is_numeric($_POST['cantidad'])) {
              $cantidad = $_POST['cantidad'];
                if (isset($_POST['top2'])) {
                $top2= $_POST['top2'];
                $primero = $cantidad * 0.6;
                $segundo = $cantidad * 0.4;
                echo "Al primero le corresponden $primero €, y al segundo $segundo €";
                }
                elseif (isset($_POST['top3'])) {
                $top3 = $_POST['top3'];
                $prim = $cantidad *0.5;
                $sec = $cantidad *0.3;
                $terce = $cantidad * 0.2;
                echo "Al primero le corresponden $prim €, al segundo $sec €, al tercero $terce €";
                }
                else {
                die("Debes de seleccionar alguna de las opciones <a href='calculadora.html'> Volver a calcular</a>");
            }
            }
          else {
            die("La cantidad debe ser un valor numérico coherente. <a href='calculadora.html'> Volver a calcular</a>");
          }
        }
?>
  </body>
</html>
