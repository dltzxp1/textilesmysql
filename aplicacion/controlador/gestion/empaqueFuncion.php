<?php

require_once("../../modelo/dao/empaque.php");
$objEmpaque = new empaque('');
$opcion = $_REQUEST['opcion'];
$emp_id=isset($_REQUEST['emp_id'])?$_REQUEST['emp_id']:null;
$emp_nombre=isset($_REQUEST['emp_nombre'])?$_REQUEST['emp_nombre']:null;

if ($opcion == 0) {
    if ($objEmpaque->insertar(utf8_decode($emp_nombre)))
        echo 'empaque Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar el empaque. Trate de nuevo';
}else if ($opcion == 1) {
    $inserto = $objEmpaque->actualiza($emp_id, utf8_decode($emp_nombre));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Editar el empaque. Trate de nuevo';
    else
        echo 'empaque Editada';
}
if ($opcion == 3) {
    $objEmpaque->eliminar($emp_id);
}
?>
 
