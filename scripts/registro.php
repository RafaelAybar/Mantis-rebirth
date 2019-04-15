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