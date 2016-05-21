<?php

require_once("clsConexion.php");

class prendatela extends conexion {
    
    var $pt_id;
    var $pt_pre_id;
    var $pt_tel_id;
    var $arregloPrendaTela;
    
        
    function prendatela($pt_id) {         
        if ($pt_id != '') {
            if ($pt_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM prenda_tela WHERE pt_id=$pt_id";
            } else {
                $this->arregloPrendaTela = array();
                $queryBusqueda = "SELECT * FROM prenda_tela";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setPrendaTela($result);
                if ($indice != -1)
                    $this->arregloPrendaTela[$indice] = $this->setarregloPrendaTela($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }
    
    function setPrendaTela($result) {
        $this->pt_id = $this->getField($result, 0);
        $this->pt_pre_id = $this->getField($result, 1);
        $this->pt_tel_id= $this->getField($result, 2);
    }
    
    function setarregloPrendaTela($result) {
        $prendatela = new prendatela(0);
        $prendatela->pt_id = $this->getField($result, 0);
        $prendatela->pt_pre_id = $this->getField($result, 0);
        $prendatela->pt_tel_id = $this->getField($result, 1);
        return $prendatela;
    } 
    

}

?>
