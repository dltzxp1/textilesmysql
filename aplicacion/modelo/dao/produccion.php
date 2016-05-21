<?php

require_once("clsConexion.php");

class produccion extends conexion {

    var $prodc_id;
    var $prodc_nombre;
    var $arregloProduccion;

    function produccion($prodc_id) {
        if ($prodc_id != '') {
            if ($prodc_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM produccion WHERE prodc_id=$prodc_id";
            } else {
                $this->arregloProduccion = array();
                $queryBusqueda = "SELECT * FROM produccion";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setProduccion($result);
                if ($indice != -1)
                    $this->arregloProduccion[$indice] = $this->setArregloProduccion($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setProduccion($result) {
        $this->prodc_id = $this->getField($result, 0);
        $this->prodc_nombre = $this->getField($result, 1);
    }

    function obtenerPagin($script) {
        $this->arregloProduccion = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setProduccion($result);
            if ($indice != -1)
                $this->arregloProduccion[$indice] = $this->setArregloProduccion($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloProduccion = array();
        $queryBusqueda = "SELECT * FROM produccion;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setProduccion($result);
            if ($indice != -1)
                $this->arregloProduccion[$indice] = $this->setArregloProduccion($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setArregloProduccion($result) {
        $produccion = new produccion(0);
        $produccion->prodc_id = $this->getField($result, 0);
        $produccion->prodc_nombre = $this->getField($result, 1);
        return $produccion;
    }

    function insertar($prodc_nombre) {
        $queryBusqueda = "INSERT INTO produccion (prodc_nombre) VALUES('$prodc_nombre')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($prodc_id) {
        $queryBusqueda = "DELETE FROM produccion WHERE prodc_id=$prodc_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($prodc_id,$prodc_nombre) {
        $queryBusqueda = "UPDATE produccion SET prodc_nombre='$prodc_nombre' WHERE prodc_id=$prodc_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>
