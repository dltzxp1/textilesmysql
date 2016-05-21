<?php

require_once("../../modelo/dao/maquila.php");

$opcion = $_REQUEST['opcion'];
$maq_id=isset($_REQUEST['maq_id'])?$_REQUEST['maq_id']:null;
$maq_nombre=isset($_REQUEST['maq_nombre'])?$_REQUEST['maq_nombre']:null; 
 
$objMaquila= new maquila('');

if ($opcion == 0) {
    if ($objMaquila->insertar(utf8_decode($maq_nombre)))
        echo 'Maquila Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar la Maquila. Trate de nuevo';
}else if ($opcion == 1) {
    $inserto = $objMaquila->actualiza($maq_id, utf8_decode($maq_nombre) );
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita ral Maquila. Trate de nuevo';
    else
        echo 'Maquila Editada';
}
if ($opcion == 3) { 
    $objMaquila->eliminar($maq_id);
}
?>
 
