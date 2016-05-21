<?php

require_once("clsConexion.php");

class maquila extends conexion {

    var $maq_id;
    var $maq_nombre;	
    var $arregloMaquila;

    function maquila($maq_id) {
        if ($maq_id != '') {
            if ($maq_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM maquila WHERE maq_id=$maq_id";
            } else {
                $this->arregloMaquila = array();
                $queryBusqueda = "SELECT * FROM maquila";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setMaquila($result);
                if ($indice != -1)
                    $this->arregloMaquila[$indice] = $this->setarregloMaquila($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setMaquila($result) {
        $this->maq_id = $this->getField($result, 0);
        $this->maq_nombre = $this->getField($result, 1);
    }

    function obtenerPagin($script) {
        $this->arregloMaquila = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setMaquila($result);
            if ($indice != -1)
                $this->arregloMaquila[$indice] = $this->setarregloMaquila($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloMaquila = array();
        $queryBusqueda = "SELECT * FROM maquila;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setMaquila($result);
            if ($indice != -1)
                $this->arregloMaquila[$indice] = $this->setarregloMaquila($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setarregloMaquila($result) {
        $maquila = new maquila(0);
        $maquila->maq_id = $this->getField($result, 0);
        $maquila->maq_nombre = $this->getField($result, 1);
        return $maquila;
    }

    function insertar($maq_nombre) {
        $queryBusqueda = "INSERT INTO maquila (maq_nombre) VALUES('$maq_nombre')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($maq_id) {
        $queryBusqueda = "DELETE FROM maquila WHERE maq_id=$maq_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($maq_id,$maq_nombre) {
        $queryBusqueda = "UPDATE maquila SET maq_nombre='$maq_nombre' WHERE maq_id=$maq_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>
