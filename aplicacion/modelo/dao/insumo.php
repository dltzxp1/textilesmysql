<?php

require_once("clsConexion.php");

class insumo extends conexion {

    var $ins_id;
    var $ins_nombre;
    var $arregloInsumo;

    function insumo($ins_id) {
        if ($ins_id != '') {
            if ($ins_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM insumo WHERE ins_id=$ins_id";
            } else {
                $this->arregloInsumo = array();
                $queryBusqueda = "SELECT * FROM insumo";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setInsumo($result);
                if ($indice != -1)
                    $this->arregloInsumo[$indice] = $this->setArregloInsumo($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setInsumo($result) {
        $this->ins_id = $this->getField($result, 0);
        $this->ins_nombre = $this->getField($result, 1);
    }

    function obtenerPagin($script) {
        $this->arregloInsumo = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setInsumo($result);
            if ($indice != -1)
                $this->arregloInsumo[$indice] = $this->setArregloInsumo($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloInsumo = array();
        $queryBusqueda = "SELECT * FROM insumo;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setInsumo($result);
            if ($indice != -1)
                $this->arregloInsumo[$indice] = $this->setArregloInsumo($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setArregloInsumo($result) {
        $insumo = new insumo(0);
        $insumo->ins_id = $this->getField($result, 0);
        $insumo->ins_nombre = $this->getField($result, 1);
        return $insumo;
    }

    function insertar($ins_nombre) {
        $queryBusqueda = "INSERT INTO insumo (ins_nombre) VALUES('$ins_nombre')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($ins_id) {
        $queryBusqueda = "DELETE FROM insumo WHERE ins_id=$ins_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($ins_id,$ins_nombre) {
        $queryBusqueda = "UPDATE insumo SET ins_nombre='$ins_nombre' WHERE ins_id=$ins_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>
