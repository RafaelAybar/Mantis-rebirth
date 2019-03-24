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
            strlen($_POST['nombre']) >= 4){
            $nombre = (string) $_POST['nombre'];
        }
        else{
            throw new Exception("Nombre no válido");
        }
        return $nombre;
    }
    else{
        throw new Exception("Debes introducir el nombre");
    }
    }


/**
 * @return bool|string
 * @throws Exception
 */
function validaYCifraPass(){
    if (isset($_POST['pass']) && isset($_POST['pass2'])){
            if (preg_match('/^[a-z0-9_\-]+$/i',$_POST['pass']) === 1) {
                $contrasena = (string) $_POST['pass'];
                $contrasena2 = (string) $_POST['pass2'];
                if ($contrasena === $contrasena2 && strlen($contrasena) >= 8) {
                    //Validada la contraseña del usuario, llega el momento de cifrarla
                    $coste = ['coste' => 18]; //Aumentamos el coste del algoritmo
                    $passhash = password_hash($contrasena, PASSWORD_DEFAULT, $coste);
                    return $passhash;
                }
                else{
                    throw new Exception("Las contraseñas no coinciden, y deben ser de 8 o más caracteres");
                }
            }
            else {
                throw new Exception("La contraseña no es válida");
                
            }
        }
    else {
        throw new Exception("Debes introducir la contraseña");
    }
    
}

function conectaEInsertaEnBD(){
    //https://phpdelusions.net/pdo
    $host = '127.0.0.1';
    $bd = 'mantis';
    $user = 'ras';
    $pass = '';
    $codificacion = 'https://phpdelusions.net/pdo';
    $dsn = "mysql_host:";
}