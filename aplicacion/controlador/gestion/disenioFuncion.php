<?php

require_once("../../modelo/dao/disenio.php");

$opcion = $_REQUEST['opcion'];
$dise_id=isset($_REQUEST['dise_id'])?$_REQUEST['dise_id']:null;
$dise_nombre=isset($_REQUEST['dise_nombre'])?$_REQUEST['dise_nombre']:null; 
$objDisenio = new disenio('');

if ($opcion == 0) {
    if ($objDisenio->insertar(utf8_decode($dise_nombre)))
        echo 'disenio Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar  disenio. Trate de nuevo';
}else if ($opcion == 1) {
    $inserto = $objDisenio->actualiza($dise_id, utf8_decode($dise_nombre));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Editar disenio. Trate de nuevo';
    else
        echo 'disenio Editada';
}
if ($opcion == 3) {
    $objDisenio->eliminar($dise_id);
}
?>
 
