<?php

require_once("../../modelo/dao/pedido.php");
$objPedido= new pedido('');

$opcion=isset($_REQUEST['opcion'])?$_REQUEST['opcion']:null;
$ped_id=isset($_REQUEST['ped_id'])?$_REQUEST['ped_id']:null;
$ped_nombre=isset($_REQUEST['ped_nombre'])?$_REQUEST['ped_nombre']:null;
$fecha=isset($_REQUEST['fecha'])?$_REQUEST['fecha']:null;
$ped_nombre_ROL=isset($_REQUEST['ped_nombre_ROL'])?$_REQUEST['ped_nombre_ROL']:null;
$ped_pre_id=isset($_REQUEST['ped_pre_id'])?$_REQUEST['ped_pre_id']:null;
$ped_des_id=isset($_REQUEST['ped_des_id'])?$_REQUEST['ped_des_id']:null;
$ped_mod_id=isset($_REQUEST['ped_mod_id'])?$_REQUEST['ped_mod_id']:null;
$ped_cor_id=isset($_REQUEST['ped_cor_id'])?$_REQUEST['ped_cor_id']:null;
$ped_tra_id=isset($_REQUEST['ped_tra_id'])?$_REQUEST['ped_tra_id']:null;
$ped_cal_id=isset($_REQUEST['ped_cal_id'])?$_REQUEST['ped_cal_id']:null;
$ped_emp_id=isset($_REQUEST['ped_emp_id'])?$_REQUEST['ped_emp_id']:null;
$ped_dise_id=isset($_REQUEST['ped_dise_id'])?$_REQUEST['ped_dise_id']:null;
$ped_prodc_id=isset($_REQUEST['ped_prodc_id'])?$_REQUEST['ped_prodc_id']:null;

$ped_pre_comentario=isset($_REQUEST['ped_pre_comentario'])?$_REQUEST['ped_pre_comentario']:null;
$ped_des_comentario=isset($_REQUEST['ped_des_comentario'])?$_REQUEST['ped_des_comentario']:null;
$ped_mod_comentario=isset($_REQUEST['ped_mod_comentario'])?$_REQUEST['ped_mod_comentario']:null;
$ped_cor_comentario=isset($_REQUEST['ped_cor_comentario'])?$_REQUEST['ped_cor_comentario']:null;
$ped_tra_comentario=isset($_REQUEST['ped_tra_comentario'])?$_REQUEST['ped_tra_comentario']:null;
$ped_cal_comentario=isset($_REQUEST['ped_cal_comentario'])?$_REQUEST['ped_cal_comentario']:null;
$ped_emp_comentario=isset($_REQUEST['ped_emp_comentario'])?$_REQUEST['ped_emp_comentario']:null;
$ped_dise_comentario=isset($_REQUEST['ped_dise_comentario'])?$_REQUEST['ped_dise_comentario']:null;
$ped_prodc_comentario=isset($_REQUEST['ped_prodc_comentario'])?$_REQUEST['ped_prodc_comentario']:null;
$ped_estado=isset($_REQUEST['ped_estado'])?$_REQUEST['ped_estado']:null;
$ped_fecha_entrega=isset($_REQUEST['ped_fecha_entrega'])?$_REQUEST['ped_fecha_entrega']:null;

 
    
//"ped_maq_id" : ped_maq_id,
// "ped_maq_fecha" : ped_maq_fecha,
         
$ped_maq_id=isset($_REQUEST['ped_maq_id'])?$_REQUEST['ped_maq_id']:null;
$ped_maq_fecha=isset($_REQUEST['ped_maq_fecha'])?$_REQUEST['ped_maq_fecha']:null;
//$ped_des_fecha=isset($_REQUEST['ped_des_fecha'])?$_REQUEST['ped_des_fecha']:null;

//console.log(opcion+','+ped_id+','+ped_nombre_ROL+','+ped_nombre+','+fecha+','+fechaResta+','+ped_estado+','+ped_fecha_entrega);
//echo $ped_fecha_entrega;

if ($opcion == 0) {
    if($ped_nombre_ROL=="ROLADMIN"){
        if ($objPedido->insertPedidoROLADMIN(utf8_decode($ped_nombre),$fecha,$ped_estado,$ped_fecha_entrega)){
            echo 'pedido Ingresado';
        }
    }
    //if ($objPedido->insertar(utf8_decode($ped_nombre),$ped_pre_id,$ped_des_id,$ped_mod_id,$ped_cor_id,$ped_tra_id,$ped_cal_id,$ped_emp_id,$ped_dise_id,$ped_are_id))
        //echo 'pedido Ingresado';
    
    //else
        //echo 'Lo sentimos, no se pudo ingresar la Clientr. Trate de nuevo';
}else if ($opcion == 1) {    
    if($ped_nombre_ROL=="ROLADMIN"){
        $inserto = $objPedido->actualizaPedidoROLADMIN($ped_id,$ped_estado,$ped_fecha_entrega);
        if (!$inserto)
            echo 'Lo sentimos, no se pudo Edita pedido. Trate de nuevo';
        else
            echo 'pedido Editado';
    } 
    if($ped_nombre_ROL=="ROLPRENDA"){
        $inserto = $objPedido->actualizaPedidoROLPRENDA($ped_id,$ped_pre_id,$fecha,$ped_pre_comentario);
        if (!$inserto)
            echo 'Lo sentimos, no se pudo Edita  pedido. Trate de nuevo';
        else
            echo 'pedido Editado';
    }

    if($ped_nombre_ROL=="ROLDESPACHO"){
        //$ped_maq_id=isset($_REQUEST['ped_maq_id'])?$_REQUEST['ped_maq_id']:null;
        //$ped_maq_fecha=isset($_REQUEST['ped_maq_fecha'])?$_REQUEST['ped_maq_fecha']:null;
        $inserto = $objPedido->actualizaPedidoROLDESPACHO($ped_id,$ped_des_id,$fecha,$ped_des_comentario,$ped_maq_id,$ped_maq_fecha);
        if (!$inserto)
            echo 'Lo sentimos, no se pudo Edita  pedido. Trate de nuevo';
        else
            echo 'pedido Editado';
    }
   
    if($ped_nombre_ROL=="ROLMODELO"){
        $inserto = $objPedido->actualizaPedidoROLMODELO($ped_id,$ped_mod_id,$fecha,$ped_mod_comentario);
        if (!$inserto)
            echo 'Lo sentimos, no se pudo Edita  pedido. Trate de nuevo';
        else
            echo 'pedido Editado';
    }
    
    if($ped_nombre_ROL=="ROLTRAZO"){
        $inserto = $objPedido->actualizaPedidoROLTRAZO($ped_id,$ped_tra_id,$fecha,$ped_tra_comentario);
        if (!$inserto)
            echo 'Lo sentimos, no se pudo Edita  pedido. Trate de nuevo';
        else
            echo 'pedido Editado';
    }
    
    if($ped_nombre_ROL=="ROLCORTADOR"){
        $inserto = $objPedido->actualizaPedidoROLCORTADOR($ped_id,$ped_cor_id,$fecha,$ped_cor_comentario);
        if (!$inserto)
            echo 'Lo sentimos, no se pudo Edita  pedido. Trate de nuevo';
        else
            echo 'pedido Editado';
    }
    
    if($ped_nombre_ROL=="ROLCALIDAD"){
        $inserto = $objPedido->actualizaPedidoROLCALIDAD($ped_id,$ped_cal_id,$fecha,$ped_cal_comentario);
        if (!$inserto)
            echo 'Lo sentimos, no se pudo Edita  pedido. Trate de nuevo';
        else
            echo 'pedido Editado';
    }
    if($ped_nombre_ROL=="ROLEMPAQUE"){
        $inserto = $objPedido->actualizaPedidoROLEMPAQUE($ped_id,$ped_emp_id,$fecha,$ped_emp_comentario);
        if (!$inserto)
            echo 'Lo sentimos, no se pudo Edita  pedido. Trate de nuevo';
        else
            echo 'pedido Editado';
    }
    if($ped_nombre_ROL=="ROLDISENIO"){
        $inserto = $objPedido->actualizaPedidoROLDISENIO($ped_id,$ped_dise_id,$fecha,$ped_dise_comentario);
        if (!$inserto)
            echo 'Lo sentimos, no se pudo Edita  pedido. Trate de nuevo';
        else
            echo 'pedido Editado';
    }
    
    if($ped_nombre_ROL=="ROLPRODUCCION"){
        $inserto = $objPedido->actualizaPedidoROLPRODUCCION($ped_id,$ped_prodc_id,$fecha,$ped_prodc_comentario);
        if (!$inserto)
            echo 'Lo sentimos, no se pudo Edita  pedido. Trate de nuevo';
        else
            echo 'pedido Editado';
    }
    
    
}
if ($opcion == 3) {    
    $objPedido->eliminar($ped_id);
}
?>
 
