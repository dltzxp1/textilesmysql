<?php

require_once("../../modelo/dao/insumo.php");
$objInsumo = new insumo('');
$opcion = $_REQUEST['opcion'];
$ins_id=isset($_REQUEST['ins_id'])?$_REQUEST['ins_id']:null;
$ins_nombre=isset($_REQUEST['ins_nombre'])?$_REQUEST['ins_nombre']:null;

if ($opcion == 0) {
    if ($objInsumo->insertar(utf8_decode($ins_nombre)))
        echo 'insumo Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar la insumo. Trate de nuevo';
}else if ($opcion == 1) {
    $inserto = $objInsumo->actualiza($ins_id, utf8_decode($ins_nombre));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita insumo. Trate de nuevo';
    else
        echo 'insumo Editada';
}
if ($opcion == 3) {
    $objInsumo->eliminar($ins_id);
}
?>
 
