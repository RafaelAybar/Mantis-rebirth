<?php

class Conectar
{
    private $driver;
    private $host, $user, $pass, $database, $charset;

    /**
     * Conectar constructor.
     */
    public function __construct()
    {
        $db_cfg = require 'config/bd.php';
        $this->driver = $db_cfg['driver'];
        $this->host = $db_cfg['host'];
        $this->user = $db_cfg['user'];
        $this->pass = $db_cfg["pass"];
        $this->database = $db_cfg["database"];
        $this->charset = $db_cfg["charset"];
    }

    /**
     * @return PDO
     */
    public function conexion()
    {
        $dsn = "$this->driver:host=$this->host;dbname=$this->database;charset=$this->charset";
        $opcionesPDO = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        try {
            $pdo = new PDO($dsn, $this->user, $this->pass, $opcionesPDO);
            return $pdo;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}