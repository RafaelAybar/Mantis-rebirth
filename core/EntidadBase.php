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
     * @param $db_cfg
     */
    public function __construct($db_cfg)
    {
        // Instanciamos la conexión de la BD
        $this->conectar = new Conectar($db_cfg);
        //Abrimos la conexión
        $this->db = $this->conectar->conexion();
    }

    /**
     * compruebaUsuarioExiste
     *
     * @param mixed $pdo
     * @param mixed $nombre
     * @return mixed $usuario
     */
    public function compruebaUsuarioExiste($pdo, $nombre)
    {
        $seleccion = $pdo->prepare('select nombre where nombre = ?');
        $seleccion->execute([$nombre]);
        return $seleccion->fetch();
    }

    /**
     * @param $pdo
     * @return array
     */
    public function obtieneListaJugadores($pdo)
    {
        $listadoJugadores = $pdo->query('select nombre from jugadores ORDER BY nombre ASC');
        while ($columna = $listadoJugadores->fetch_object()) {
            $resultado[] = $columna;
        }
        return $resultado;
    }

    /**
     * borrarUsuario
     *
     * @param mixed $pdo
     * @param mixed $nombre
     * @return void
     * @throws exception
     */
    public function borrarUsuario($pdo, $nombre)
    {
        $borrado = $pdo->prepare('delete from user where nombre = ?');

        if (empty(compruebaUsuarioExiste($pdo, $nombre))) {
            throw new Exception("Ese usuario no existe", 1);
        }
        $borrado->execute([$nombre]);
    }

    /**
     * @param $pdo
     * @param $nombre
     * @param $contrasena
     * @throws Exception
     */
    public function insertarJugador($pdo, $nombre, $contrasena)
    {
        if (!compruebaUsuarioExiste($pdo, $nombre)) {
            throw new Exception("El jugador a introducir ya existe");
        }
        $insercion = $pdo->prepare('insert into jugadores(nombre, contrasena) values (:nombre, :contrasena)');
        $insercion->execute([$nombre, $contrasena]);
    }
}