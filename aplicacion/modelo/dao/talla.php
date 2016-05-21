<?php

require_once("clsConexion.php");

class talla extends conexion {

    var $tal_id;
    var $tal_valor;
    var $arregloTalla;

    function talla($tal_id) {
        if ($tal_id != '') {
            if ($tal_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM talla WHERE tal_id=$tal_id";
            } else {
                $this->arregloTalla= array();
                $queryBusqueda = "SELECT * FROM talla";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setTalla($result);
                if ($indice != -1)
                    $this->arregloTalla[$indice] = $this->setArregloTalla($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setTalla($result) {
        $this->tal_id = $this->getField($result, 0);
        $this->tal_valor = $this->getField($result, 1);
    }

    
    function obtenerPagin($script) {
        $this->arregloTalla= array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setTalla($result);
            if ($indice != -1)
                $this->arregloTalla[$indice] = $this->setArregloTalla($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloTalla= array();
        $queryBusqueda = "SELECT * FROM talla;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setTalla($result);
            if ($indice != -1)
                $this->arregloTalla[$indice] = $this->setArregloTalla($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setArregloTalla($result) {
        $talla = new talla(0);
        $talla->tal_id = $this->getField($result, 0);
        $talla->tal_valor = $this->getField($result, 1);        
        return $talla;
    }

    function insertar($tal_valor) {
        $queryBusqueda = "INSERT INTO talla (tal_valor) VALUES('$tal_valor')";
        //$queryBusqueda = "INSERT INTO cliente (cli_nombre,cli_apellido,cli_ciudad) VALUES('$cli_nombre','$cli_apellido','$cli_ciudad')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($tal_id) {
        $queryBusqueda = "DELETE FROM talla WHERE tal_id=$tal_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($tal_id,$tal_valor) {
        $queryBusqueda = "UPDATE talla SET tal_valor='$tal_valor' WHERE tal_id=$tal_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>
