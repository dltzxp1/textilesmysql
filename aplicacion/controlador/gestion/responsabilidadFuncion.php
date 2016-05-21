<?php

require_once("../../modelo/dao/responsabilidad.php");
$opcion = $_REQUEST['opcion'];
 
$us_id=isset($_REQUEST['us_id'])?$_REQUEST['us_id']:null;
$ro_id=isset($_REQUEST['ro_id'])?$_REQUEST['ro_id']:null;
$re_id=isset($_REQUEST['re_id'])?$_REQUEST['re_id']:null;
$re_nombre=isset($_REQUEST['re_nombre'])?$_REQUEST['re_nombre']:null; 
$re_descripcion=isset($_REQUEST['re_descripcion'])?$_REQUEST['re_descripcion']:null;

$objResponsabilidad = new responsabilidad('0', '0', '0');

if ($opcion == 0) {
    $inserto = $objResponsabilidad->insertar($us_id, $ro_id, $re_nombre, $re_descripcion);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo ingresar el Responsabilidad. Trate de nuevo';
    else
        echo 'Responsabilidad Ingresado';
} else if ($opcion == 1) { 
    $inserto = $objResponsabilidad->actualiza($us_id, $ro_id, $re_id, $re_nombre, $re_descripcion);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Editar la Responsabilidad. Trate de nuevo';
    else
        echo 'Responsabilidad Editado';
}
if ($opcion == 3) { 
    $objResponsabilidad->eliminar($us_id, $ro_id, $re_id);
}
?>
 
