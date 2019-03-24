<?php
include 'funciones.php';
try {
    $nombre = validaNombre();
    $passcifrada = validaYCifraPass();
} catch (Exception $e){
    echo $e->getMessage();
    die("<a href='../registro.html'>Vuelve al registro</a>");
}
echo "$nombre <br>";
echo "$passcifrada <br>";
echo 2;
