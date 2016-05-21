<?php

require_once("clsConexion.php");

class cliente extends conexion {

    var $cli_id;
    var $cli_nombre;
    var $cli_apellido;
    var $cli_ciudad;
    var $arregloCliente;

    function cliente($cli_id) {
        if ($cli_id != '') {
            if ($cli_id > 0) {
                $indice = -1;
                $queryBusqueda = "SELECT * FROM cliente WHERE cli_id=$cli_id";
            } else {
                $this->arregloCliente = array();
                $queryBusqueda = "SELECT * FROM cliente";
                $indice = 0;
            }
            $result = $this->select($queryBusqueda);
            while (!$this->siguiente($result)) {
                $this->setCliente($result);
                if ($indice != -1)
                    $this->arregloCliente[$indice] = $this->setArregloCliente($result);
                $result->MoveNext();
                $indice++;
            }
        }
    }

    function setCliente($result) {
        $this->cli_id = $this->getField($result, 0);
        $this->cli_nombre = $this->getField($result, 1);
        $this->cli_apellido = $this->getField($result, 2);
        $this->cli_ciudad= $this->getField($result, 3);
    }

    function obtenerPagin($script) {
        $this->arregloCliente = array();
        $indice = 0;
        $result = $this->select($script);
        while (!$this->siguiente($result)) {
            $this->setCliente($result);
            if ($indice != -1)
                $this->arregloCliente[$indice] = $this->setArregloCliente($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function obtenerTodo() {
        $this->arregloCliente = array();
        $queryBusqueda = "SELECT * FROM cliente;";
        $indice = 0;
        $result = $this->select($queryBusqueda);
        while (!$this->siguiente($result)) {
            $this->setCliente($result);
            if ($indice != -1)
                $this->arregloCliente[$indice] = $this->setArregloCliente($result);
            $result->MoveNext();
            $indice++;
        }
    }

    function setArregloCliente($result) {
        $cliente = new cliente(0);
        $cliente->cli_id = $this->getField($result, 0);
        $cliente->cli_nombre = $this->getField($result, 1);
        $cliente->cli_apellido = $this->getField($result, 2);
        $cliente->cli_ciudad = $this->getField($result, 3);
        return $cliente;
    }

    function insertar($cli_nombre, $cli_apellido,$cli_ciudad) {
        $queryBusqueda = "INSERT INTO cliente (cli_nombre,cli_apellido,cli_ciudad) VALUES('$cli_nombre','$cli_apellido','$cli_ciudad')";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function eliminar($cli_id) {
        $queryBusqueda = "DELETE FROM cliente WHERE cli_id=$cli_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

    function actualiza($cli_id,$cli_nombre, $cli_apellido,$cli_ciudad) {
        $queryBusqueda = "UPDATE cliente SET cli_nombre='$cli_nombre',cli_apellido='$cli_apellido',cli_ciudad='$cli_ciudad' WHERE cli_id=$cli_id";
        $result = $this->select($queryBusqueda);
        return $result;
    }

}

?>
