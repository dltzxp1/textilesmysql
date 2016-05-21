<?php
require_once("../../modelo/dao/prenda.php");    
$objPrenda = new prenda('0');
//$dest='../../../../../../imagenes'; ruta en C/imagenes
$dest='../../vista/pantalla/img/imagenprendas';
$arrTelas= json_decode($_REQUEST['jsonArr']);
$arrTalla=  json_decode($_REQUEST['jsonArr2']);
$arrInsumo= json_decode($_REQUEST['jsonArr3']);        
$opcion=isset($_REQUEST['opcion'])?$_REQUEST['opcion']:null; 
$pre_id=isset($_REQUEST['pre_id'])?$_REQUEST['pre_id']:null;
$pre_cli_id=isset($_REQUEST['pre_cli_id'])?$_REQUEST['pre_cli_id']:null;
$pre_are_id=isset($_REQUEST['pre_are_id'])?$_REQUEST['pre_are_id']:null;
$pre_nombre=isset($_REQUEST['pre_nombre'])?$_REQUEST['pre_nombre']:null; 
$pre_img_type= isset($_FILES['img']['type'])?$_FILES['img']['type']:null;
$arch= isset($_FILES['img']['tmp_name'])?$_FILES['img']['tmp_name']:null;
$pre_img_name= isset($_FILES['img']['name'])?$_FILES['img']['name']:null;
$pre_img_size= isset($_FILES['img']['size'])?$_FILES['img']['size']:null;
$prendaNombre=null;

if ($opcion == 0) {
    $inserto = $objPrenda->insertar($pre_cli_id,$pre_are_id,$pre_nombre,$pre_img_type,$pre_img_name,$pre_img_size);
    if ($inserto){
         move_uploaded_file($arch,$dest."/".$pre_nombre."".$pre_img_name);
        $objPrenda->obtenerPrendaID($pre_nombre); 
        $prendaID=$objPrenda->arregloPrenda[0]->pre_id;
        for($i=0;$i<count($arrTelas);$i++){ 
            $objPrenda->insertarDetalleTela($prendaID, $arrTelas[$i]->id);
        } 
        for($i=0;$i<count($arrTalla);$i++){  
            $objPrenda->insertarDetalleTalla($prendaID, $arrTalla[$i]->id);
        } 
        for($i=0;$i<count($arrInsumo);$i++){  
            $objPrenda->insertarDetalleInsumo($prendaID, $arrInsumo[$i]->id);
        }
        echo 'Prenda ingresada';
    }
    else{
        echo 'Prenda no ingresada';    
    }
} else if ($opcion == 1) { 
    /*$inserto = $objPrenda->actualiza($pre_id,$cli_id, $cat_tal_id, $cat_tel_id, $pre_nombre);
    if (!$inserto)
        echo 'Lo sentimos, no se pudo Editar la Prenda. Trate de nuevo';
    else
        echo 'Prenda Editado';
     * */
     
}
if ($opcion == 3) { 
    $objPrenda->obtenerPrendaNombre($pre_id);
    $prendaNombre=$objPrenda->arregloPrenda[0]->pre_nombre."".$objPrenda->arregloPrenda[0]->pre_img_name;
    $objPrenda->eliminarDetallePrendaTela($pre_id);
    $objPrenda->eliminarDetallePrendaTalla($pre_id);
    $objPrenda->eliminarDetallePrendaInsumo($pre_id);
    $objPrenda->eliminar($pre_id);
    $srcImg = $dest."/".$prendaNombre; 
    unlink($srcImg);
    
}
?>
