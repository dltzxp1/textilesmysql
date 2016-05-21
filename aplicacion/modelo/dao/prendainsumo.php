<?php

require_once("clsConexion.php");

class prendainsumo extends conexion {
    
    var $pin_id;
    var $pin_pre_id;
    var $pin_ins_id;
    var $arregloPrendaInsumo;
    
        
    function prendainsumo($pin_id) {         
        if ($pin_id != '') {
            if ($pin_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM prenda_insumo WHERE pin_id=$pin_id";
            } else {
                $this->arregloPrendaInsumo = array();
                $queryBusqueda = "SELECT * FROM prenda_insumo";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setPrendaInsumo($result);
                if ($indice != -1)
                    $this->arregloPrendaInsumo[$indice] = $this->setarregloPrendaInsumo($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }
    
    function setPrendaInsumo($result) {
        $this->pin_id = $this->getField($result, 0);
        $this->pin_pre_id = $this->getField($result, 1);
        $this->pin_ins_id= $this->getField($result, 2);
    }
    
    function setarregloPrendaInsumo($result) {
        $prendainsumo = new prendainsumo(0);
        $prendainsumo->pin_id = $this->getField($result, 0);
        $prendainsumo->pin_pre_id = $this->getField($result, 0);
        $prendainsumo->pin_ins_id = $this->getField($result, 1);
        return $prendainsumo;
    } 
    

}

?>
