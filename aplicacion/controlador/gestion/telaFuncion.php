<?php

require_once("../../modelo/dao/tela.php");
$objTela= new tela('0');
$opcion = $_REQUEST['opcion'];
$tel_id=isset($_REQUEST['tel_id'])?$_REQUEST['tel_id']:null;
$tel_nombre=isset($_REQUEST['tel_nombre'])?$_REQUEST['tel_nombre']:null;
$tel_color=isset($_REQUEST['tel_color'])?$_REQUEST['tel_color']:null;
$tel_medida=isset($_REQUEST['tel_medida'])?$_REQUEST['tel_medida']:null;
if ($opcion == 0) { 
    if ($objTela->insertar(utf8_decode($tel_nombre), utf8_decode($tel_color),utf8_decode($tel_medida)))
        echo 'tela Ingresado';
    else
        echo '------Lo sentimos, no se pudo ingresar la Tela. Trate de nuevo';
}else if ($opcion == 1) { 
    $inserto = $objTela->actualiza($tel_id, utf8_decode($tel_nombre), utf8_decode($tel_color),utf8_decode($tel_medida));
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita Tela. Trate de nuevo';
    else
        echo 'tela Editada';
}
if ($opcion == 3) {
    
    $objTela->eliminar($tel_id);
}
?>
 