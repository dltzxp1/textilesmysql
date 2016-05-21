<?php

require_once("../../modelo/dao/usuario.php");

$opcion = $_REQUEST['opcion'];

$us_id=isset($_REQUEST['us_id'])?$_REQUEST['us_id']:null;
$us_nombre=isset($_REQUEST['us_nombre'])?$_REQUEST['us_nombre']:null;
$us_mail=isset($_REQUEST['us_mail'])?$_REQUEST['us_mail']:null;
$us_clave=isset($_REQUEST['us_clave'])?$_REQUEST['us_clave']:null; 
$us_estado=isset($_REQUEST['us_estado'])?$_REQUEST['us_estado']:null;
$objUsuario = new usuario('0');

if ($opcion == 0) {
    if ($objUsuario->insertar($us_nombre, $us_mail, $us_clave, $us_estado)) {
        echo utf8_encode("Usuario insertado ! ");
        exit;
    } else {
        echo utf8_encode("Por favor, ingrese de nuevo !");
        exit;
    }
} else if ($opcion == 1) { 
    if ($objUsuario->actualizar($us_id, $us_nombre, $us_mail, $us_clave, $us_estado)) {
        echo utf8_encode("Usuario editado ! ");
    } else {
        echo utf8_encode("Por favor, ingrese de nuevo !");
    }
}
if ($opcion == 3) {
    $objUsuario->eliminar($us_id);
}
?>