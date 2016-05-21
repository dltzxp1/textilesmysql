<?php

require_once("../../modelo/dao/areac.php");

$opcion = $_REQUEST['opcion'];

$are_id=isset($_REQUEST['are_id'])?$_REQUEST['are_id']:null;
$are_nombre=isset($_REQUEST['are_nombre'])?$_REQUEST['are_nombre']:null; 
$objArea = new areac('');

if ($opcion == 0) {
    if ($objArea->insertar(utf8_decode($are_nombre)))
        echo 'area Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar la areac. Trate de nuevo';
}else if ($opcion == 1) {
    $inserto = $objArea->actualiza($are_id, utf8_decode($are_nombre));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita areac. Trate de nuevo';
    else
        echo 'area Editada';
}
if ($opcion == 3) {
    $objArea->eliminar($are_id);
}
?>
 
