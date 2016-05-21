<?php

require_once("clsConexion.php");

class prenda extends conexion {
    
    var $pre_cli_id;
    var $pre_are_id;
    var $pre_id;	
    var $pre_nombre;
    var $pre_fecha;
    var $pre_img_type;
    var $pre_img_name;
    var $pre_img_size;
    var $arregloPrenda;

    function prenda($pre_id) {
        if ($pre_id != '') {
            if ($pre_id > '0') {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM prenda WHERE  pre_id=$pre_id";
            } else {
                $this->arregloPrenda = array();
                $queryBusqueda = "SELECT * FROM prenda";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setPrenda($result);
                if ($indice != -1)
                    $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setPrenda($result) {
        $this->pre_cli_id = $this->getField($result, 0);
        $this->pre_are_id = $this->getField($result, 1);
        $this->pre_id = $this->getField($result, 2);
        $this->pre_nombre = $this->getField($result, 3);
        $this->pre_fecha= $this->getField($result, 4);
        $this->pre_img_type= $this->getField($result, 5);
        $this->pre_img_name= $this->getField($result, 6);
        $this->pre_img_size= $this->getField($result, 7);    
    }

    function setArregloPrenda($result) {
        $prenda = new prenda(0);
        $prenda->pre_cli_id = $this->getField($result, 0);
        $prenda->pre_are_id = $this->getField($result, 1);
        $prenda->pre_id = $this->getField($result, 2);
        $prenda->pre_nombre = $this->getField($result, 3);
        $prenda->pre_fecha = $this->getField($result, 4);
        $prenda->pre_img_type = $this->getField($result, 5);
        $prenda->pre_img_name = $this->getField($result, 6);
        $prenda->pre_img_size = $this->getField($result, 7);
        return $prenda; 
    }
     
    function obtenerPagin($script) {
        $this->arregloPrenda = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setPrenda($result);
            if ($indice != -1)
                $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
            $result->MoveNext();
            $indice++;
        }
    }
    
    function obtenerPrendaID($pre_nombre) {
        $this->arregloPrenda = array();
        $queryBusqueda = "SELECT * FROM prenda WHERE pre_nombre='$pre_nombre'";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setPrenda($result);
            if ($indice != -1)
                $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
            $result->MoveNext();
            $indice++;
        }
    }
    
    function obtenerPrendaNombre($pre_id) {
        $this->arregloPrenda = array();
        $queryBusqueda = "SELECT * FROM prenda WHERE pre_id=$pre_id";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setPrenda($result);
            if ($indice != -1)
                $this->arregloPrenda[$indice] = $this->setArregloPrenda($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function insertar($pre_cli_id,$pre_are_id,$pre_nombre,$pre_img_type,$pre_img_name,$pre_img_size) {
        $queryBusqueda = "INSERT INTO prenda (pre_cli_id,pre_are_id,pre_nombre,pre_img_type,pre_img_name,pre_img_size) VALUES('$pre_cli_id','$pre_are_id','$pre_nombre','$pre_img_type','$pre_img_name','$pre_img_size')";
        $result = $this->select($queryBusqueda);
        return $result;
    }    
   
    function insertarDetalleTela($pt_pre_id,$pt_tel_id) {            
        $queryBusqueda = "INSERT INTO prenda_tela (pt_pre_id,pt_tel_id) VALUES('$pt_pre_id','$pt_tel_id')";
        $result = $this->select($queryBusqueda);        
        return $result;
    }

    function insertarDetalleTalla($ptal_pre_id,$ptal_tal_id) {            
        $queryBusqueda = "INSERT INTO prenda_talla (ptal_pre_id,ptal_tal_id) VALUES('$ptal_pre_id','$ptal_tal_id')";
        $result = $this->select($queryBusqueda);        
        return $result;
    }
    
    function insertarDetalleInsumo($pin_pre_id,$pin_ins_id) {            
        $queryBusqueda = "INSERT INTO prenda_insumo (pin_pre_id,pin_ins_id) VALUES('$pin_pre_id','$pin_ins_id')";
        $result = $this->select($queryBusqueda);        
        return $result;
    }
        
    function actualiza($cli_id,$pre_cli_id,$pre_tal_id,$pre_id,$pre_nombre) {
        $queryBusqueda = "UPDATE prenda SET pre_nombre='$pre_nombre' WHERE cli_id=$cli_id AND  pre_cli_id=$pre_cli_id AND pre_tal_id=$pre_tal_id AND pre_id=$pre_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminarDetallePrendaTela($pre_id) {
        $queryBusqueda = "DELETE FROM prenda_tela WHERE pt_pre_id=$pre_id";  
        $result = $this->select($queryBusqueda);  
        return $result;
    } 
    
    function eliminarDetallePrendaTalla($pre_id) {
        $queryBusqueda = "DELETE FROM prenda_talla WHERE ptal_pre_id=$pre_id";  
        $result = $this->select($queryBusqueda);  
        return $result;
    }
      
    function eliminarDetallePrendaInsumo($pre_id) {
        $queryBusqueda = "DELETE FROM prenda_insumo WHERE pin_pre_id=$pre_id";
        $result = $this->select($queryBusqueda);  
        return $result;
    }
    
    function eliminar($pre_id){
        $queryBusqueda = "DELETE FROM prenda WHERE pre_id=$pre_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>