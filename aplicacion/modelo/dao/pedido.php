<?php

require_once("clsConexion.php");

class pedido extends conexion {
     
    var $ped_id;
    var $ped_nombre;
    var $ped_fecha ;
    var $ped_pre_id;
    var $ped_des_id ;
    var $ped_mod_id;
    var $ped_cor_id ;
    var $ped_tra_id ;
    var $ped_cal_id;
    var $ped_emp_id ;
    var $ped_dise_id ;
    var $ped_prodc_id;
    var $ped_maq_id;
    var $ped_pre_fecha ;
    var $ped_des_fecha ;
    var $ped_mod_fecha ;
    var $ped_cor_fecha ;
    var $ped_tra_fecha ;
    var $ped_cal_fecha ;
    var $ped_emp_fecha ;
    var $ped_dise_fecha ;
    var $ped_prodc_fecha ;
    var $ped_maq_fecha ;
    var $ped_pre_comentario ;
    var $ped_des_comentario ;
    var $ped_mod_comentario ;
    var $ped_cor_comentario ;
    var $ped_tra_comentario ;
    var $ped_cal_comentario ;
    var $ped_emp_comentario ;
    var $ped_dise_comentario ;
    var $ped_prodc_comentario ;
    var $ped_estado;
    var $ped_fecha_entrega;  
    //var $ped_maq_fecha_debajo;
    var $arregloPedido;

    function pedido($ped_id) {
        if ($ped_id != '') {
            if ($ped_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM pedido WHERE ped_id=$ped_id";
            } else {
                $this->arregloPedido = array();
                $queryBusqueda = "SELECT * FROM pedido";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setPedido($result);
                if ($indice != -1)
                    $this->arregloPedido[$indice] = $this->setArregloPedido($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setPedido($result) {
        $this->ped_id = $this->getField($result, 0);
        $this->ped_nombre = $this->getField($result, 1);
        $this->ped_fecha = $this->getField($result, 2);
        $this->ped_pre_id = $this->getField($result, 3);
        $this->ped_des_id = $this->getField($result, 4);        
        $this->ped_mod_id = $this->getField($result, 5);
        $this->ped_cor_id = $this->getField($result, 6);
        $this->ped_tra_id = $this->getField($result, 7);
        $this->ped_cal_id = $this->getField($result, 8);
        $this->ped_emp_id = $this->getField($result, 9);
        $this->ped_dise_id = $this->getField($result, 10);
        $this->ped_prodc_id = $this->getField($result, 11);    
        $this->ped_maq_id = $this->getField($result, 12);    
        $this->ped_pre_fecha = $this->getField($result, 13);
        $this->ped_des_fecha = $this->getField($result, 14);
        $this->ped_mod_fecha = $this->getField($result, 15);
        $this->ped_cor_fecha = $this->getField($result, 16);
        $this->ped_tra_fecha = $this->getField($result, 17);        
        $this->ped_cal_fecha = $this->getField($result, 18);
        $this->ped_emp_fecha = $this->getField($result, 19);
        $this->ped_dise_fecha = $this->getField($result, 20);
        $this->ped_prodc_fecha = $this->getField($result, 21);        
        $this->ped_maq_fecha= $this->getField($result, 22);
        $this->ped_pre_comentario = $this->getField($result, 23);
        $this->ped_des_comentario = $this->getField($result, 24);
        $this->ped_mod_comentario = $this->getField($result, 25);
        $this->ped_cor_comentario = $this->getField($result, 26);
        $this->ped_tra_comentario = $this->getField($result, 27);        
        $this->ped_cal_comentario = $this->getField($result, 28);
        $this->ped_emp_comentario = $this->getField($result, 29);
        $this->ped_dise_comentario = $this->getField($result, 30);
        $this->ped_prodc_comentario = $this->getField($result, 31);        
        $this->ped_estado = $this->getField($result, 32);
        $this->ped_fecha_entrega = $this->getField($result, 33);
        //$this->ped_maq_fecha_debajo = $this->getField($result, 34);
    }

    function obtenerPagin($script) {
        $this->arregloPedido = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setPedido($result);
            if ($indice != -1)
                $this->arregloPedido[$indice] = $this->setArregloPedido($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloPedido = array();
        $queryBusqueda = "SELECT * FROM pedido;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setPedido($result);
            if ($indice != -1)
                $this->arregloPedido[$indice] = $this->setArregloPedido($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setArregloPedido($result) {
        $pedido = new pedido(0);
        $pedido->ped_id = $this->getField($result, 0);
        $pedido->ped_nombre = $this->getField($result, 1);
        $pedido->ped_fecha = $this->getField($result, 2);
        $pedido->ped_pre_id = $this->getField($result, 3);
        $pedido->ped_des_id = $this->getField($result, 4);        
        $pedido->ped_mod_id = $this->getField($result, 5);
        $pedido->ped_cor_id = $this->getField($result, 6);
        $pedido->ped_tra_id = $this->getField($result, 7);
        $pedido->ped_cal_id = $this->getField($result, 8);
        $pedido->ped_emp_id = $this->getField($result, 9);
        $pedido->ped_dise_id = $this->getField($result, 10);
        $pedido->ped_prodc_id = $this->getField($result, 11);        
        $pedido->ped_maq_id = $this->getField($result, 12);
        $pedido->ped_pre_fecha = $this->getField($result, 13);
        $pedido->ped_des_fecha = $this->getField($result, 14);        
        $pedido->ped_mod_fecha = $this->getField($result, 15);
        $pedido->ped_cor_fecha = $this->getField($result, 16);
        $pedido->ped_tra_fecha = $this->getField($result, 17);
        $pedido->ped_cal_fecha = $this->getField($result, 18);
        $pedido->ped_emp_fecha = $this->getField($result, 19);
        $pedido->ped_dise_fecha = $this->getField($result, 20);
        $pedido->ped_prodc_fecha = $this->getField($result, 21);
        $pedido->ped_maq_fecha = $this->getField($result, 22);
        $pedido->ped_pre_comentario= $this->getField($result, 23);
        $pedido->ped_des_comentario = $this->getField($result, 24);        
        $pedido->ped_mod_comentario = $this->getField($result, 25);
        $pedido->ped_cor_comentario = $this->getField($result, 26);
        $pedido->ped_tra_comentario = $this->getField($result, 27);
        $pedido->ped_cal_comentario = $this->getField($result, 28);
        $pedido->ped_emp_comentario = $this->getField($result, 29);
        $pedido->ped_dise_comentario = $this->getField($result, 30);
        $pedido->ped_prodc_comentario = $this->getField($result, 31);
        $pedido->ped_estado = $this->getField($result, 32);
        $pedido->ped_fecha_entrega = $this->getField($result, 33);
        //$pedido->ped_maq_fecha_debajo = $this->getField($result, 34); 
        return $pedido;
    }

    function insertPedidoROLADMIN($ped_nombre,$fecha,$ped_estado,$ped_fecha_entrega){
        $queryBusqueda = "INSERT INTO pedido (ped_nombre,ped_fecha,ped_estado,ped_fecha_entrega) VALUES('$ped_nombre','$fecha','$ped_estado','$ped_fecha_entrega')";
        $result = $this->select($queryBusqueda);
        return $result;
    }
    // el administrador no puedo actualizar nada nombre unique.
    //$inserto = $objPedido->actualizaPedidoROLADMIN($ped_id,$fecha,$ped_estado);
    function actualizaPedidoROLADMIN($ped_id,$ped_estado,$ped_fecha_entrega){
        $queryBusqueda = "UPDATE pedido SET ped_estado='$ped_estado',ped_fecha_entrega='$ped_fecha_entrega' WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }
    
    function actualizaPedidoROLPRENDA($ped_id,$ped_pre_id,$fecha,$ped_pre_comentario){
        $queryBusqueda = "UPDATE pedido SET ped_pre_id=$ped_pre_id,ped_pre_fecha='$fecha',ped_pre_comentario='$ped_pre_comentario' WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }
    function actualizaPedidoROLDESPACHO($ped_id,$ped_des_id,$fecha,$ped_des_comentario,$ped_maq_id,$ped_maq_fecha){
        $queryBusqueda = "UPDATE pedido SET ped_des_id='$ped_des_id',ped_des_fecha='$fecha',ped_des_comentario='$ped_des_comentario',ped_maq_id='$ped_maq_id',ped_maq_fecha='$ped_maq_fecha' WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    } 
    
    function actualizaPedidoROLMODELO($ped_id,$ped_mod_id,$fecha,$ped_mod_comentario){
        $queryBusqueda = "UPDATE pedido SET ped_mod_id='$ped_mod_id',ped_mod_fecha='$fecha',ped_mod_comentario='$ped_mod_comentario' WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }
    
    function actualizaPedidoROLTRAZO($ped_id,$ped_tra_id,$fecha,$ped_tra_comentario){
        $queryBusqueda = "UPDATE pedido SET ped_tra_id='$ped_tra_id',ped_tra_fecha='$fecha',ped_tra_comentario='$ped_tra_comentario' WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }
    
    function actualizaPedidoROLCORTADOR($ped_id,$ped_cor_id,$fecha,$ped_cor_comentario){
        $queryBusqueda = "UPDATE pedido SET ped_cor_id='$ped_cor_id',ped_cor_fecha='$fecha',ped_cor_comentario='$ped_cor_comentario' WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }
    
    function actualizaPedidoROLCALIDAD($ped_id,$ped_cal_id,$fecha,$ped_cal_comentario){
        $queryBusqueda = "UPDATE pedido SET ped_cal_id=$ped_cal_id,ped_cal_fecha='$fecha',ped_cal_comentario='$ped_cal_comentario' WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }
    function actualizaPedidoROLEMPAQUE($ped_id,$ped_emp_id,$fecha,$ped_emp_comentario){
        $queryBusqueda = "UPDATE pedido SET ped_emp_id='$ped_emp_id',ped_emp_fecha='$fecha',ped_emp_comentario='$ped_emp_comentario',ped_estado='INACTIVO' WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }
    function actualizaPedidoROLDISENIO($ped_id,$ped_dise_id,$fecha,$ped_dise_comentario){
        $queryBusqueda = "UPDATE pedido SET ped_dise_id='$ped_dise_id',ped_dise_fecha='$fecha',ped_dise_comentario='$ped_dise_comentario' WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }
    function actualizaPedidoROLPRODUCCION($ped_id,$ped_prodc_id,$fecha,$ped_prodc_comentario){
        $queryBusqueda = "UPDATE pedido SET ped_prodc_id=$ped_prodc_id,ped_prodc_fecha='$fecha',ped_prodc_comentario='$ped_prodc_comentario' WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }
    
    function insertar($ped_nombre,$ped_pre_id,$ped_des_id,$ped_mod_id,$ped_cor_id,$ped_tra_id,$ped_cal_id,$ped_emp_id,$ped_dise_id,$ped_prodc_id) {
        $queryBusqueda = "INSERT INTO pedido (ped_nombre,ped_pre_id,ped_des_id,ped_mod_id,ped_cor_id,ped_tra_id,ped_cal_id,ped_emp_id,ped_dise_id,ped_prodc_id) 
            VALUES('$ped_nombre',$ped_pre_id,$ped_des_id,$ped_mod_id,$ped_cor_id,$ped_tra_id,$ped_cal_id,$ped_emp_id,$ped_dise_id,$ped_prodc_id)";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($ped_id) {
        $queryBusqueda = "DELETE FROM pedido WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($ped_id,$ped_nombre, $ped_fecha,$ped_des_id) {
        $queryBusqueda = "UPDATE pedido SET ped_nombre='$ped_nombre',ped_fecha='$ped_fecha',ped_des_id='$ped_des_id' WHERE ped_id=$ped_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>
