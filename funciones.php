<?php
    //
    function emparejaronda ($nombres, $numparticipantes, $numronda){
        if ($numparticipantes % 2 != 0) {
            //Añadimos el bye, al array para indicar que el que se quede solo tenga la victoria automática
            $bye = "BYE";
            array_push($nombres, $bye);
        }
        // Desordenamos el array y hacemos los emparejamientos
        shuffle($nombres);
        // Emparejamiento inicial
        switch ($numronda) {
            case 1:
            for ($i=0; $i < count($nombres) ; $i+=2) {
                $nombreizda = $nombres[$i];
                $nombredcha = $nombres[$i+1];
                $jempate= "$nombreizda empata con $nombredcha";
                // Almacenamos la lista de jugadores 
                $GLOBALS['emparejadosxronda'] = array($numronda => " $nombreizda - $nombredcha");
                echo $nombres[$i]." <input type='checkbox' name='gana[]' value='$nombreizda'>"." vs ".$nombres[$i+1]." <input type='checkbox' name='gana[]' value='$nombredcha'>"." Empate <input type='checkbox' name='empate[]' value='$jempate'>"."<br>";
            }
                break;
            
            default:
                # code...
                break;
        }
        
    }
?>