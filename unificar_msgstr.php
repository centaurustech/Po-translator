<?php

function unificar_msgstr($i, $archivo){ //(5, es_ES.po)

    $linea ="";
    $contador = $i;
    $acople = "";
    $linea = $archivo[$contador];
    $linea_br = nl2br($linea);
    $linea_sin_rn = preg_replace("/[\r\n|\n|\r]+/", "", $linea_br);
    
    while(($linea_sin_rn <> "<br />")){
                
                //$linea_filtrada = preg_replace("/[\r\n|\n|\r]+/", "", $linea);
        
        // $acople .= obtenerCadena($linea,'"','"\r\n');

        if (preg_match("/^(msgstr)/", $linea)){ 
        
            $acople = obtenerCadena($linea,'msgstr "',"\"\r\n");
        
        } else if (preg_match("/^(\")/", $linea)){ 
        
            $linea = preg_replace( "/^(\")/", "~", $linea );
            $acople = obtenerCadena($linea,"~","\"\r\n");
        }

        $contador++; //7

        $linea = $archivo[$contador];
        $linea_br = nl2br($linea);
        $linea_sin_rn = preg_replace("/[\r\n|\n|\r]+/", "", $linea_br);

    }

    return array ($contador, $acople);

}
?>