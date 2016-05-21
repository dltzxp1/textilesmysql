<?php

require_once("../../modelo/dao/produccion.php");

$opcion = $_REQUEST['opcion'];
$prodc_id=isset($_REQUEST['prodc_id'])?$_REQUEST['prodc_id']:null;
$prodc_nombre=isset($_REQUEST['prodc_nombre'])?$_REQUEST['prodc_nombre']:null; 
$objProduccion = new produccion('');

if ($opcion == 0) {
    if ($objProduccion->insertar(utf8_decode($prodc_nombre)))
        echo 'produccion Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar produccion. Trate de nuevo';
}else if ($opcion == 1) {
    $inserto = $objProduccion->actualiza($prodc_id, utf8_decode($prodc_nombre));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Editar produccion. Trate de nuevo';
    else
        echo 'produccion Editada';
}
if ($opcion == 3) {
    $objProduccion->eliminar($prodc_id);
}
?>
 
