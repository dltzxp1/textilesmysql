<?php

require_once("../../modelo/dao/despacho.php");
$objDespacho= new despacho('');

$opcion = $_REQUEST['opcion'];
$des_id=isset($_REQUEST['des_id'])?$_REQUEST['des_id']:null;
$des_nombre=isset($_REQUEST['des_nombre'])?$_REQUEST['des_nombre']:null;
$arrMaquila= json_decode($_REQUEST['jsonArr']);

if ($opcion == 0) {
 echo "ecntro opcion";
    if ($objDespacho->insertar(utf8_decode($des_nombre))){
        $objDespacho->obtenerDespachoID($des_nombre); 
        $despachoID=$objDespacho->arregloDespacho[0]->des_id; 
        for($i=0;$i<count($arrMaquila);$i++){ 
            $objDespacho->insertarDetalle($despachoID, $arrMaquila[$i]->id);
        }  
        echo 'Despacho Ingresado';
    }
    else{
        echo 'Lo sentimos, no se pudo ingresar la Despacho. Trate de nuevo';
    }
}else if ($opcion == 1) { 
    $inserto = $objDespacho->actualiza($des_id, utf8_decode($des_nombre) );
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Edita ral Despacho. Trate de nuevo';
    else
        echo 'Despacho Editada';
}
if ($opcion == 3) {
    $objDespacho->eliminar($des_id);
    $objDespacho->eliminarcabecera($des_id);
}
?>
 
