<?php
function obtenerCadena($contenido,$inicio,$fin){
    $r = explode($inicio, $contenido);
    $partes = "";

    if (isset($r[1])){
        for($i=1;$i<=$longitud-1;$i++){
            $partes .= $r[$i];
        }
        $r = explode($fin, $partes);
        return $r[0];
    }
    return '';
}
?>