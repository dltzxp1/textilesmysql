<?php

require_once("clsConexion.php");

class calidad extends conexion {

    var $cal_id;
    var $cal_nombre;
    var $arregloCalidad;

    function calidad($cal_id) {
        if ($cal_id != '') {
            if ($cal_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM calidad WHERE cal_id=$cal_id";
            } else {
                $this->arregloCalidad = array();
                $queryBusqueda = "SELECT * FROM calidad";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setCalidad($result);
                if ($indice != -1)
                    $this->arregloCalidad[$indice] = $this->setArregloCalidad($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setCalidad($result) {
        $this->cal_id = $this->getField($result, 0);
        $this->cal_nombre = $this->getField($result, 1);
    }

    function obtenerPagin($script) {
        $this->arregloCalidad = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setCalidad($result);
            if ($indice != -1)
                $this->arregloCalidad[$indice] = $this->setArregloCalidad($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloCalidad = array();
        $queryBusqueda = "SELECT * FROM calidad;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setCalidad($result);
            if ($indice != -1)
                $this->arregloCalidad[$indice] = $this->setArregloCalidad($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setArregloCalidad($result) {
        $calidad = new calidad(0);
        $calidad->cal_id = $this->getField($result, 0);
        $calidad->cal_nombre = $this->getField($result, 1);
        return $calidad;
    }

    function insertar($cal_nombre) {
        $queryBusqueda = "INSERT INTO calidad (cal_nombre) VALUES('$cal_nombre')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($cal_id) {
        $queryBusqueda = "DELETE FROM calidad WHERE cal_id=$cal_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($cal_id,$cal_nombre) {
        $queryBusqueda = "UPDATE calidad SET cal_nombre='$cal_nombre' WHERE cal_id=$cal_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>
