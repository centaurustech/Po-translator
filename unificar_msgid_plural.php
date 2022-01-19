<?php

function unificar_msgid_plural($i, $arc){ //(5, hola2.po)

    $linea ="";
    $contador = $i;
    $acople = "";

    $linea = $arc[$contador];
    $cond1 = substr($linea, 0, 6);
    $cond2 = substr($linea, 0, 12);

    while (($cond1 <> 'msgstr')){
                
        // $linea_filtrada = preg_replace("/[\r\n|\n|\r]+/", "", $linea);
        // $acople .= obtenerCadena($linea_filtrada,'"','"\r');
        
        if (preg_match("/^(msgid_plural)/", $linea)){ 
            
            $acople .= obtenerCadena($linea,'msgid_plural "',"\"\r\n");
        
        } else if (preg_match("/^(\")/", $linea)){ 
        
            $linea = preg_replace( "/^(\")/", "~", $linea );
            $acople .= obtenerCadena($linea,"~","\"\r\n");
        }
        
        $contador++; //7
        
        $linea = $arc[$contador]; // msgid_plural "Muchas "
        $cond1 = substr($linea, 0, 6);// msgstr
        $cond2 = substr($linea, 0, 12);// msgid_plural
    }

    return array ($contador, $acople); 
    
}
?>