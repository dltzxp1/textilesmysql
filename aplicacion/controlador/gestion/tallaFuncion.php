<?php

require_once("../../modelo/dao/talla.php");
$objTalla= new talla('0');
$opcion = $_REQUEST['opcion'];
$tal_id=isset($_REQUEST['tal_id'])?$_REQUEST['tal_id']:null;
$tal_valor=isset($_REQUEST['tal_valor'])?$_REQUEST['tal_valor']:null;

if ($opcion == 0) {
    if ($objTalla->insertar(utf8_decode($tal_valor)))
        echo 'Talla Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar la Talla. Trate de nuevo';
}else if ($opcion == 1) {
    
    $inserto = $objTalla->actualiza($tal_id, utf8_decode($tal_valor) );
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita ral Talla. Trate de nuevo';
    else
        echo 'Talla Editada';
}
if ($opcion == 3) {    
    $objTalla->eliminar($tal_id);
}
?>
 
