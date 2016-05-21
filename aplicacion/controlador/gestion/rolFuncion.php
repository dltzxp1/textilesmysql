<?php

require_once("../../modelo/dao/rol.php");

$opcion = $_REQUEST['opcion'];

$em_id=isset($_REQUEST['em_id'])?$_REQUEST['em_id']:null;
$us_id=isset($_REQUEST['us_id'])?$_REQUEST['us_id']:null;
$ro_id=isset($_REQUEST['ro_id'])?$_REQUEST['ro_id']:null;
$ro_nombre=isset($_REQUEST['ro_nombre'])?$_REQUEST['ro_nombre']:null; 
$ro_descripcion=isset($_REQUEST['ro_descripcion'])?$_REQUEST['ro_descripcion']:null;


$objRol = new rol('0', '0');

if ($opcion == 0) {
    $inserto = $objRol->insertar($us_id, $ro_nombre, $ro_descripcion);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo ingresar el Rol. Trate de nuevo';
    else
        echo 'Rol Ingresada!';
} else if ($opcion == 1) { 
    $inserto = $objRol->actualiza($us_id, $ro_id, $ro_nombre, $ro_descripcion);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Editar el Rol. Trate de nuevo';
    else
        echo 'Rol Editado';
}
if ($opcion == 3) { 
    $objRol->eliminar($us_id, $ro_id);
}
?>
 
