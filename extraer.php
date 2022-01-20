<?php 

/*
Usando como base teorica el trabajo realizado por Julio Sanchez en HelpTranslator
https://jsbsan.blogspot.com/2015/02/helptranslator-herramienta-para-ayudar.html


Lo migre a PHP

Ronald Caetano
Centaurus Technology®
github.com/centaurustech
Asunción, Paraguay

Fase de combinación (texto original con texto traducido), ejecución posterior a extract.php

*/

include('unificar_msgid.php');
include('unificar_msgstr.php');
include('unificar_msgid_plural.php');
include('obtener_cadena.php');

$file_name = "es_ES";
$extension =".po";

$archivo_po = file($file_name.$extension);
$archivo_po_opt = fopen($file_name."_opt.po", "a");
$archivo_txt = fopen($file_name."_detached.txt", "a+");
$lineas = count($archivo_po); 

for($i=0; $i < $lineas; $i++){

    $linea = $archivo_po[$i]; //

    if($i <=1){

        fwrite($archivo_po_opt, $linea);
        
    } else {

        $sub = substr($linea, 0, 5); //msgid
        $sub2 = substr($linea, 0, 12); // msgid_plural
        $sub3 = substr($linea, 0, 6); // msgstr


        if($sub === "msgid"){
                
            $multilineas = unificar_msgid($i, $archivo_po);
            
            $filtro_1 = htmlspecialchars($multilineas[1]);
            $filtro_2 = str_replace('\\', '\\\\', $filtro_1);
            $msgid = $filtro_2;
            
            fwrite($archivo_po_opt, 'msgid "'.$msgid.'"'.PHP_EOL);
            fwrite($archivo_txt, htmlspecialchars($msgid).PHP_EOL);

            $i = $multilineas[0];

            if($multilineas[2] == false){

                $multilineas_msgstr = unificar_msgstr($i, $archivo_po);

                $filtro_3 = htmlspecialchars($multilineas_msgstr[1]);
                $filtro_4 = str_replace('\\', '\\\\', $filtro_3);

                $msgstr = $filtro_4;
                
                fwrite($archivo_po_opt, 'msgstr "'.$msgstr.'"'.PHP_EOL);
                $i = $multilineas_msgstr[0]-1;

            } else {
                $multilineas_plural = unificar_msgid_plural($i, $archivo_po);
                
                $filtro_5 = htmlspecialchars($multilineas_plural[1]);
                $filtro_6 = str_replace('\\', '\\\\', $filtro_5);
                $msgid_plural = $filtro_6;
                
                fwrite($archivo_po_opt, 'msgid_plural "'.$msgid_plural.'"'.PHP_EOL);
                fwrite($archivo_txt, $msgid_plural.PHP_EOL);
                fwrite($archivo_po_opt, 'msgstr[0] ""'.PHP_EOL);
                fwrite($archivo_po_opt, 'msgstr[1] ""'.PHP_EOL);
                $i = $multilineas_plural[0]+1;
            }
        } else {
            fwrite($archivo_po_opt, $linea);
        }
    }
} 

echo "<br>Optimizar y extraer frases, terminado<br>";

?>