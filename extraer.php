<?php 

include('unificar_msgid.php');
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

        $sub = substr($linea, 0, 5);
        $sub2 = substr($linea, 0, 12);

        if($sub === "msgid"){
                
            $multilineas = unificar_msgid($i, $archivo_po);
            
            $filtro_1 = htmlspecialchars($multilineas[1]);
            $filtro_2 = str_replace('\\', '\\\\', $filtro_1);
            $msgid = $filtro_2;
            
            fwrite($archivo_po_opt, 'msgid "'.$msgid.'"'.PHP_EOL);
            fwrite($archivo_txt, htmlspecialchars($msgid).PHP_EOL);

            $i = $multilineas[0];

            if($multilineas[2] == false){
                fwrite($archivo_po_opt, 'msgstr ""'.PHP_EOL);
            } else {
                $multilineas = unificar_msgid_plural($i, $archivo_po);
                
                $filtro_3 = htmlspecialchars($multilineas[1]);
                $filtro_4 = str_replace('\\', '\\\\', $filtro_3);
                $msgid_plural = $filtro_4;
                
                fwrite($archivo_po_opt, 'msgid_plural "'.$msgid_plural.'"'.PHP_EOL);
                fwrite($archivo_txt, $msgid_plural.PHP_EOL);
                fwrite($archivo_po_opt, 'msgstr[0] ""'.PHP_EOL);
                fwrite($archivo_po_opt, 'msgstr[1] ""'.PHP_EOL);
                $i = $multilineas[0]+1;
            }
        } else {
            fwrite($archivo_po_opt, $linea);
        }
    }
} 

echo "<br>Optimizar y extraer frases, terminado<br>";

?>