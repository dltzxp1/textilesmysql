<?php

require_once("../../modelo/dao/calidad.php");
$objCalidad = new calidad('');
$opcion = $_REQUEST['opcion'];
$cal_id=isset($_REQUEST['cal_id'])?$_REQUEST['cal_id']:null;
$cal_nombre=isset($_REQUEST['cal_nombre'])?$_REQUEST['cal_nombre']:null;
if ($opcion == 0) {
    if ($objCalidad->insertar(utf8_decode($cal_nombre)))
        echo 'calidad Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar la calidad. Trate de nuevo';
}else if ($opcion == 1) {
    $inserto = $objCalidad->actualiza($cal_id, utf8_decode($cal_nombre));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita calidad. Trate de nuevo';
    else
        echo 'calidad Editada';
}
if ($opcion == 3) {
    $objCalidad->eliminar($cal_id);
}
?>
 
