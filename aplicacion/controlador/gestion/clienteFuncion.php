<?php

require_once("../../modelo/dao/cliente.php");
$objCliente= new cliente('');
$opcion = $_REQUEST['opcion'];
$cli_id=isset($_REQUEST['cli_id'])?$_REQUEST['cli_id']:null;
$cli_nombre=isset($_REQUEST['cli_nombre'])?$_REQUEST['cli_nombre']:null;
$cli_apellido=isset($_REQUEST['cli_apellido'])?$_REQUEST['cli_apellido']:null;
$cli_ciudad=isset($_REQUEST['cli_ciudad'])?$_REQUEST['cli_ciudad']:null;

if ($opcion == 0) {
    if ($objCliente->insertar(utf8_decode($cli_nombre), utf8_decode($cli_apellido),utf8_decode($cli_ciudad)))
        echo 'cliente Ingresado';
    else
        echo 'Lo sentimos, no se pudo ingresar la Clientr. Trate de nuevo';
}else if ($opcion == 1) {    
    $inserto = $objCliente->actualiza($cli_id, utf8_decode($cli_nombre), utf8_decode($cli_apellido),utf8_decode($cli_ciudad));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita ral cliente. Trate de nuevo';
    else
        echo 'cliente Editada';
}
if ($opcion == 3) {    
    $objCliente->eliminar($cli_id);
}
?>
 
