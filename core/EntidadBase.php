<?php
include_once 'Conectar.php';
include_once '../config/bd.php';
class EntidadBase
{
    private $table;
    private $db;
    private $conectar;

    public function __construct($conectar, $db_cfg)
    {
        $this ->table = (string) $table;
        // Instanciamos la conexión de la BD
        $this ->conectar = new Conectar($db_cfg);
        //Abrimos la conexión
        $this->db= $this->conectar->conexion();
    }

    public function db(){
        return $this->db();
    }

    public function obtieneListaJugadores($pdo)
    {
        $listadoJugadores = $pdo->query('select nombre from jugadores ORDER BY id DESC"');
        while ($columna = $listadoJugadores-> fetch_object()) {
            $resultado[] = $columna;
        }
        return $resultado;
    }
}