<?php
include_once 'Conectar.php';

// https://phpdelusions.net/pdo#dml

class EntidadBase
{
    private $db;
    private $conectar;

    /**
     * EntidadBase constructor.
     */
    public function __construct()
    {
        // Instanciamos la conexión de la BD
        $this->conectar = new Conectar();
        //Abrimos la conexión
        $this->db = $this->conectar->conexion();
    }

    /**
     * compruebaUsuarioExiste
     *
     * @param mixed $nombre
     * @param $db
     * @return mixed $usuario
     */
    public function compruebaUsuarioExiste($nombre, $db)
    {
        $seleccion = $db->prepare('select nombre where nombre = ?');
        $seleccion->execute([$nombre]);
        return $seleccion->fetch();
    }

    /**
     * @param $db
     * @return array
     */
    public function obtieneListaJugadores($db)
    {
        $listadoJugadores = $db > query('select nombre from jugadores ORDER BY nombre ASC');
        while ($columna = $listadoJugadores->fetch_object()) {
            $resultado[] = $columna;
        }
        return $resultado;
    }

    /**
     * borrarUsuario
     * @param $db
     * @param mixed $nombre
     * @return void
     * @throws Exception
     */
    public function borrarUsuario($db, $nombre)
    {
        $borrado = $db->prepare('delete from user where nombre = ?');

        if (empty(compruebaUsuarioExiste($pdo, $nombre))) {
            throw new Exception("Ese usuario no existe", 1);
        }
        $borrado->execute([$nombre]);
    }

    /**
     * @param $db
     * @param $nombre
     * @param $contrasena
     * @throws Exception
     */
    public function insertarJugador($db, $nombre, $contrasena)
    {
        if (!compruebaUsuarioExiste($db, $nombre)) {
            throw new Exception("El jugador a introducir ya existe");
        }
        $insercion = $db->prepare('insert into jugadores(nombre, contrasena) values (:nombre, :contrasena)');
        $insercion->execute([$nombre, $contrasena]);
    }
}