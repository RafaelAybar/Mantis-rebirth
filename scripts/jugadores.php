<?php
    class Jugadores{

        public $nombre;
        protected $pass;
        public $mazo;
    }

    class Torneo{
        public $idtorneo;
        public $jugadorGanador;
        // Sólo se guarda la info del mazo que hace top 1
        public $mazoGanador;
        public $fecha;
        public $totalRondas;
    }