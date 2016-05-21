<?php

require_once("../../modelo/dao/modelo.php");
$objPersona = new modelo('');
$opcion = $_REQUEST['opcion'];
$mod_id=isset($_REQUEST['mod_id'])?$_REQUEST['mod_id']:null;
$mod_nombre=isset($_REQUEST['mod_nombre'])?$_REQUEST['mod_nombre']:null;

if ($opcion == 0) {
    if ($objPersona->insertar(utf8_decode($mod_nombre)))
        echo 'modelo Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar la Modelo. Trate de nuevo';
}else if ($opcion == 1) {
    $inserto = $objPersona->actualiza($mod_id, utf8_decode($mod_nombre));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita Mmodelo. Trate de nuevo';
    else
        echo 'modelo Editada';
}
if ($opcion == 3) {
    $objPersona->eliminar($mod_id);
}
?>
 
