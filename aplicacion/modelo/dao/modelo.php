<?php

require_once("clsConexion.php");

class modelo extends conexion {

    var $mod_id;
    var $mod_nombre;
    var $arregloModelo;

    function modelo($mod_id) {
        if ($mod_id != '') {
            if ($mod_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM modelo WHERE mod_id=$mod_id";
            } else {
                $this->arregloModelo = array();
                $queryBusqueda = "SELECT * FROM modelo";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setPersona($result);
                if ($indice != -1)
                    $this->arregloModelo[$indice] = $this->setArregloModelo($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setPersona($result) {
        $this->mod_id = $this->getField($result, 0);
        $this->mod_nombre = $this->getField($result, 1);
    }

    function obtenerPagin($script) {
        $this->arregloModelo = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setPersona($result);
            if ($indice != -1)
                $this->arregloModelo[$indice] = $this->setArregloModelo($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloModelo = array();
        $queryBusqueda = "SELECT * FROM modelo;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setPersona($result);
            if ($indice != -1)
                $this->arregloModelo[$indice] = $this->setArregloModelo($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setArregloModelo($result) {
        $modelo = new modelo(0);
        $modelo->mod_id = $this->getField($result, 0);
        $modelo->mod_nombre = $this->getField($result, 1);
        return $modelo;
    }

    function insertar($mod_nombre) {
        $queryBusqueda = "INSERT INTO modelo (mod_nombre) VALUES('$mod_nombre')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($mod_id) {
        $queryBusqueda = "DELETE FROM modelo WHERE mod_id=$mod_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($mod_id,$mod_nombre) {
        $queryBusqueda = "UPDATE modelo SET mod_nombre='$mod_nombre' WHERE mod_id=$mod_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>
