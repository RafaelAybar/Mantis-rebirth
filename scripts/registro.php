<?php
include 'funciones.php';
try {
    $nombre = validaNombre();
    $passcifrada = validaYCifraPass();
    var_dump($passcifrada); //Indica que tiene un valor nulo
} catch (Exception $e){
    echo $e->getMessage();
    die("<a href='../registro.html'> Vuelve al registro</a>");
}
