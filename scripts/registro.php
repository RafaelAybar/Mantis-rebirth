<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../bulma.css">
    <title>Formulario de registro</title>
</head>
<body>
</body>
</html>
<?php
include 'funciones.php';
try {
    $nombre = validaNombre();
    $passcifrada = validaYCifraPass();
    echo "</br>";
    conectaBD($nombre, $passcifrada);
} catch (Exception $e) {
    echo $e->getMessage();
    die("<a href='../registro.html'> Vuelve al registro</a>");
}
echo "Enhorabuena, $nombre, te has registrado con éxito";