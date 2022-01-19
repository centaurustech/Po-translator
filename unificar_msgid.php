<?php

function unificar_msgid($i, $arc){ //(5, hola2.po)

$linea ="";
$contador = $i;
$acople = "";
$ultima_linea_analizada = "";
$con_plural = false;

$linea = $arc[$contador];// aaa
$cond1 = substr($linea, 0, 6); 
$cond2 = substr($linea, 0, 12); 

    while (($cond1 <> 'msgstr') && ($cond2 <> 'msgid_plural')){

        if (preg_match("/^(msgid)/", $linea)){ 
        
            $acople = obtenerCadena($linea,'msgid "',"\"\r\n");
        
        } else if (preg_match("/^(\")/", $linea)){ 
        
            $linea = preg_replace( "/^(\")/", "~", $linea );
            $acople = obtenerCadena($linea,"~","\"\r\n");
        }

        // $acople = obtenerCadena($linea,'"','"\r\n');
        // $acople = preg_replace("/[\r\n|\n|\r]+/", "", $acople);

        $contador++; //7
        
        $linea = $arc[$contador]; // msgid_plural "Muchas "
        $cond1 = substr($linea, 0, 6);// msgstr
        $cond2 = substr($linea, 0, 12);// msgid_plural

        if($cond2 ==="msgid_plural"){
            $con_plural = true;
        }

        $retornar = $contador - 1; 
        $ultima_linea_analizada = $linea;
    }

    return array ($contador, $acople, $con_plural, $ultima_linea_analizada); 
    
}
?>