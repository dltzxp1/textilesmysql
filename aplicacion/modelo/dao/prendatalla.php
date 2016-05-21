<?php

require_once("clsConexion.php");

class prendatalla extends conexion {
    
    var $ptal_id;
    var $ptal_pre_id;
    var $ptal_tal_id;
    var $arregloPrendaTalla;
    
        
    function prendatalla($ptal_id) {         
        if ($ptal_id != '') {
            if ($ptal_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM prenda_talla WHERE ptal_id=$ptal_id";
            } else {
                $this->arregloPrendaTalla = array();
                $queryBusqueda = "SELECT * FROM prenda_talla";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setPrendaTalla($result);
                if ($indice != -1)
                    $this->arregloPrendaTalla[$indice] = $this->setarregloPrendaTalla($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }
    
    function setPrendaTalla($result) {
        $this->ptal_id = $this->getField($result, 0);
        $this->ptal_pre_id = $this->getField($result, 1);
        $this->ptal_tal_id= $this->getField($result, 2);
    }
    
    function setarregloPrendaTalla($result) {
        $prendatalla = new prendatalla(0);
        $prendatalla->ptal_id = $this->getField($result, 0);
        $prendatalla->ptal_pre_id = $this->getField($result, 0);
        $prendatalla->ptal_tal_id = $this->getField($result, 1);
        return $prendatalla;
    } 
    

}

?>
