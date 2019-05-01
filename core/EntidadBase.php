<?php
include_once 'Conectar.php';
include_once '../config/bd.php';
// https://phpdelusions.net/pdo#dml

class EntidadBase
{
    private $db;
    private $conectar;

    /**
     * EntidadBase constructor.
     * @param $conectar
     * @param $db_cfg
     */
    public function __construct($db_cfg)
    {
        // Instanciamos la conexión de la BD
        $this ->conectar = new Conectar($db_cfg);
        //Abrimos la conexión
        $this->db= $this->conectar->conexion();
    }

    public function db(){
        return $this->db();
    }

    /**
     * @param $pdo
     * @return array
     */
    public function obtieneListaJugadores($pdo)
    {
        $listadoJugadores = $pdo->query('select nombre from jugadores ORDER BY nombre DESC"');
        while ($columna = $listadoJugadores-> fetch_object()) {
            $resultado[] = $columna;
        }
        return $resultado;
    }

    /**
     * compruebaUsuarioExiste
     *
     * @param  mixed $pdo
     * @param  mixed $nombre
     * @return $usuario
     */
    public function compruebaUsuarioExiste($pdo, $nombre)
    {
        $seleccion = $pdo->prepare('select nombre where nombre = ?');
        $seleccion -> execute([$nombre]);

        $usuario = $seleccion -> fetch();
        return $usuario;
    }

    /**
     * borrarUsuario
     *
     * @param  mixed $pdo
     * @param  mixed $nombre
     * @throws exception
     * @return void
     */
    public function borrarUsuario($pdo, $nombre)
    {
        $borrado = $pdo->prepare('delete from user where nombre = ?');

        if (empty(compruebaUsuarioExiste($pdo, $nombre))) {
            throw new Exception("Ese usuario no existe", 1);
        }
        $borrado -> execute([$nombre]);
    }

public function insertarJugador($pdo, Type $nombre = string, Type $contrasena = string)
{
    if (empty(compruebaUsuarioExiste($pdo, $nombre))) {
        $insercion = $pdo->prepare('insert into jugadores values (?,?)');
        $insercion -> execute([$nombre, $contrasena]);
    }
}
}