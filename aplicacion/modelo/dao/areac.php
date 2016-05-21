<?php

require_once("clsConexion.php");

class areac extends conexion {

    var $are_id;
    var $are_nombre;
    var $arregloArea;

    function areac($are_id) {
        if ($are_id != '') {
            if ($are_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM areac WHERE are_id=$are_id";
            } else {
                $this->arregloArea = array();
                $queryBusqueda = "SELECT * FROM areac";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setArea($result);
                if ($indice != -1)
                    $this->arregloArea[$indice] = $this->setArregloArea($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setArea($result) {
        $this->are_id = $this->getField($result, 0);
        $this->are_nombre = $this->getField($result, 1);
    }

    function obtenerPagin($script) {
        $this->arregloArea = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setArea($result);
            if ($indice != -1)
                $this->arregloArea[$indice] = $this->setArregloArea($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloArea = array();
        $queryBusqueda = "SELECT * FROM areac;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setArea($result);
            if ($indice != -1)
                $this->arregloArea[$indice] = $this->setArregloArea($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setArregloArea($result) {
        $areac = new areac(0);
        $areac->are_id = $this->getField($result, 0);
        $areac->are_nombre = $this->getField($result, 1);
        return $areac;
    }

    function insertar($are_nombre) {
        $queryBusqueda = "INSERT INTO areac (are_nombre) VALUES('$are_nombre')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($are_id) {
        $queryBusqueda = "DELETE FROM areac WHERE are_id=$are_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($are_id,$are_nombre) {
        $queryBusqueda = "UPDATE areac SET are_nombre='$are_nombre' WHERE are_id=$are_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>
