<?php
require_once("../../modelo/dao/cortador.php");
$objCortador = new cortador('');
$opcion = $_REQUEST['opcion'];
$cor_id=isset($_REQUEST['cor_id'])?$_REQUEST['cor_id']:null;
$cor_nombre=isset($_REQUEST['cor_nombre'])?$_REQUEST['cor_nombre']:null;

if ($opcion == 0) {
    if ($objCortador->insertar(utf8_decode($cor_nombre)))
        echo 'cortador Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar la cortador. Trate de nuevo';
}else if ($opcion == 1) {
    $inserto = $objCortador->actualiza($cor_id, utf8_decode($cor_nombre));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita cortador. Trate de nuevo';
    else
        echo 'cortador Editada';
}
if ($opcion == 3) {
    $objCortador->eliminar($cor_id);
}
?>
 
