<?php

require_once("clsConexion.php");

class tela extends conexion {

    var $tel_id;
    var $tel_nombre;
    var $tel_color;
    var $tel_medida;
	
    var $arregloTelas;

    function tela($tel_id) {
        if ($tel_id != '') {
            if ($tel_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM tela WHERE tel_id=$tel_id";
            } else {
                $this->arregloTelas = array();
                $queryBusqueda = "SELECT * FROM tela";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setTelas($result);
                if ($indice != -1)
                    $this->arregloTelas[$indice] = $this->setarregloTelas($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setTelas($result) {
        $this->tel_id = $this->getField($result, 0);
        $this->tel_nombre = $this->getField($result, 1);
        $this->tel_color = $this->getField($result, 2);
        $this->tel_medida= $this->getField($result, 3);
    }

    function obtenerPagin($script) {
        $this->arregloTelas = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setTelas($result);
            if ($indice != -1)
                $this->arregloTelas[$indice] = $this->setarregloTelas($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloTelas = array();
        $queryBusqueda = "SELECT * FROM tela;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setTelas($result);
            if ($indice != -1)
                $this->arregloTelas[$indice] = $this->setarregloTelas($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setarregloTelas($result) {
        $telas = new tela(0);
        $telas->tel_id = $this->getField($result, 0);
        $telas->tel_nombre = $this->getField($result, 1);
        $telas->tel_color = $this->getField($result, 2);
        $telas->tel_medida = $this->getField($result, 3);
        return $telas;
    }

    function insertar($tel_nombre, $tel_color,$tel_medida) {
        $queryBusqueda = "INSERT INTO tela (tel_nombre,tel_color,tel_medida) VALUES('$tel_nombre','$tel_color','$tel_medida')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($tel_id) {
        $queryBusqueda = "DELETE FROM tela WHERE tel_id=$tel_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($tel_id,$tel_nombre, $tel_color,$tel_medida) {
        $queryBusqueda = "UPDATE tela SET tel_nombre='$tel_nombre',tel_color='$tel_color',tel_medida='$tel_medida' WHERE tel_id=$tel_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>
