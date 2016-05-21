<?php

require_once("../../modelo/dao/trazos.php");

$opcion = $_REQUEST['opcion'];
$tra_id=isset($_REQUEST['tra_id'])?$_REQUEST['tra_id']:null;
$tra_nombre=isset($_REQUEST['tra_nombre'])?$_REQUEST['tra_nombre']:null; 
$objTrazos = new trazos('');

if ($opcion == 0) {
    if ($objTrazos->insertar(utf8_decode($tra_nombre)))
        echo 'trazos Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar la trazos. Trate de nuevo';
}else if ($opcion == 1) {
    $tra_id = $_REQUEST['tra_id'];
    $inserto = $objTrazos->actualiza($tra_id, utf8_decode($tra_nombre));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita ral trazos. Trate de nuevo';
    else
        echo 'trazos Editada';
}
if ($opcion == 3) {
    $objTrazos->eliminar($tra_id);
}
?>
 
