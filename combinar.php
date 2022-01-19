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

include('obtener_cadena.php');

$file_name = "es_ES";
$file_name_opt = $file_name."_opt";
$extension = ".po";
$file_name_traducido = $file_name."_traduccion.txt";
$archivo_po = file($file_name_opt.$extension);
$archivo_txt = file($file_name_traducido);
$archivo_po_combinado = fopen($file_name."_combinado.po", "a+");
$lineas_po = count($archivo_po);

$cont1 = 0;

for($i=2; $i < $lineas_po; $i++){
	
	$linea_po = $archivo_po[$i];
	$msgid =  obtenerCadena($linea_po,"msgid \"","\"");

	if(strlen($msgid) > 0){
		
        $linea_s = $archivo_po[$i+1];
        $cond1 = substr($linea_s, 0, 6); //msgstr
        $cond2 = substr($linea_s, 0, 12); //msgid_plural
        
        if($cond1 === "msgstr"){

            $linea_po = htmlspecialchars_decode($linea_po);//+
            fwrite($archivo_po_combinado, $linea_po);//msgid

            $tipo_msgstr =  obtenerCadena($linea_s,"msgstr \"","\""); // >0
            $long = strlen($tipo_msgstr);
            if($long > 0){
                //ya hay traduccion                
                $linea_s = htmlspecialchars_decode($linea_s);
                fwrite($archivo_po_combinado, $linea_s);
                $cont1++;
                $i++;

            } else {
                //si no hay traduccion -> traer traduccion
                $msgstr = preg_replace("/[\r\n|\n|\r]+/", "", $archivo_txt[$cont1]);
                $msgstr = htmlspecialchars_decode($msgstr);//+
                fwrite($archivo_po_combinado, 'msgstr "'.$msgstr.'"'. PHP_EOL);
                $cont1++;
                $i++;
            }

        } else if ($cond2 === "msgid_plural"){

            $linea_po = htmlspecialchars_decode($linea_po);//+
            fwrite($archivo_po_combinado, $linea_po);

            $linea_s = htmlspecialchars_decode($linea_s);//+
            fwrite($archivo_po_combinado, $linea_s);

            $msgstr = preg_replace("/[\r\n|\n|\r]+/", "", $archivo_txt[$cont1]);
            $msgstr = htmlspecialchars_decode($msgstr);//+
            fwrite($archivo_po_combinado, 'msgstr[0] "'.$msgstr.'"'. PHP_EOL);
            $cont1++;
            $msgstr = preg_replace("/[\r\n|\n|\r]+/", "", $archivo_txt[$cont1]);
            $msgstr = htmlspecialchars_decode($msgstr);//+
            fwrite($archivo_po_combinado, 'msgstr[1] "'.$msgstr.'"'. PHP_EOL);
            $cont1++;
            $i = $i+3;
        }
	} else {
            echo $linea_po."<br>";
            $linea_po = htmlspecialchars_decode($linea_po);//+
            fwrite($archivo_po_combinado, $linea_po);
	}
}
	fclose($archivo_po_combinado);
?>