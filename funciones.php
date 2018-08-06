<?php
    //
    function emparejaronda ($nombres, $numparticipantes, $rondaactual){
        if ($numparticipantes % 2 != 0) {
            //Añadimos el bye, al array para indicar que el que se quede solo tenga la victoria automática
            $bye = "BYE";
            array_push($nombres, $bye);
        }
        // Desordenamos el array y hacemos los emparejamientos
        shuffle($nombres);
        // Emparejamiento inicial
            for ($i=0; $i < count($nombres) ; $i+=2) {
                $nombreizda = $nombres[$i];
                $nombredcha = $nombres[$i+1];
                $jempate= "$nombreizda empata con $nombredcha";
                // Almacenamos la lista de jugadores emparejados
                $listamparejados = array($rondaactual => "$nombredcha vs $nombreizda");
                echo $nombres[$i]." <input type='checkbox' name='gana[]' value='$nombreizda'>"." vs ".$nombres[$i+1]." <input type='checkbox' name='gana[]' value='$nombredcha'>"." Empate <input type='checkbox' name='empate[]' value='$jempate'>"."<br>";
            }
    }

    function contronda($numparticipantes)
    {
        if ($numparticipantes < 4 || $numparticipantes > 128) {
            die("Número de participantes incorrecto");
        }
        elseif ($numparticipantes <= 8 && $numparticipantes > 4) {
            $numrondas = 3;
        }
        elseif ($numparticipantes <= 16 && $numparticipantes < 8) {
            $numrondas = 4;
        }
        elseif ($numparticipantes <= 32 && $numparticipantes > 16) {
            $numrondas = 5;
        }
        elseif ($numparticipantes <= 64 && $numparticipantes > 32 ) {
            $numrondas = 6;
        }
        elseif ($numparticipantes <= 128 && $numparticipantes > 64){
            $numrondas = 7;
        }
    }
    function sumarganadores($ganadores){
         // Sumamos los puntos a los ganadores
         foreach ($ganadores as $indice => $valor) {
            $ganadores[$indice] = $valor. " +3 ";
        }
        return $ganadores;
    }
    
    function sumarempates($empate){
        foreach ($empate as $indice => $valor) {
                    $empate[$indice] = $valor. " +1 ";
                }
        return $empate;
        }
        // Sumamos los puntos a los ganadores
       
    

?>