<?php
function obtenerCadena($contenido,$inicio,$fin){
    $r = explode($inicio, $contenido);
    if (isset($r[1])){
        $r = explode($fin, $r[1]);
        return $r[0];
    }
    return '';
}
?>