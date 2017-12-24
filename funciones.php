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