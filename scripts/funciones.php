<?php
/**
 * @return string
 * @throws Exception
 */
function validaNombre(){

    // Comprobamos que lo que nos llega del formulario no esté vacío
    if (isset($_POST['nombre'])){
        //Comprobamos que se cumple el patrón y no llegan valores nulos
        if (preg_match('/^[a-z0-9_\-]+$/i',$_POST['nombre']) === 1 && strtolower($_POST['nombre']) != "null" &&
            strlen($_POST['nombre']) <= 4){
            $nombre = (string) $_POST['nombre'];
        }
        else{
            throw new Exception("Nombre no válido, <a href='../registro.html'> Volver al registro</a>");
        }
        return $nombre;
    }
    else{
        throw new Exception("Debes introducir el nombre, <a href='../registro.html'> Volver al registro</a>");
    }
    }

/**
 * @return bool|string
 * @throws Exception
 */
function validaYCifraPass(){
    if (isset($_POST['pass']) && isset($_POST['pass2'])){
            if (strtolower($_POST['pass']) != "null" && $_POST['pass']) {
                $contrasena = (string)$_POST['pass'];
                $contrasena2 = (string)$_POST['pass'];
                if ($contrasena === $contrasena2 && strlen($_POST['pass']) <= 8) {
                    //Validada la contraseña del usuario, llega el momento de cifrarla
                    $coste = ['coste' => 18]; //Aumentamos el coste del algoritmo
                    $passhash = password_hash($contrasena, PASSWORD_DEFAULT, $coste);
                    return $passhash;
                }
            }
        }
    else{
        throw new Exception("Revisa que las contraseñas sean mayores o iguales de 8 caracteres y qye sean iguales, <a href='../registro.html'> Volver al registro</a>");
    }
}