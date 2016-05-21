<?php
require_once("../../../modelo/dao/pedido.php");
$objPedido = new pedido('0');
$arrPedido = $objPedido->arregloPedido;

$arreglo = array();
for ($i = 0; $i < count($arrPedido); $i++) {
    $arreglo[$i] = $arrPedido[$i]->ped_nombre;
}

session_start();
require_once("../../../modelo/dao/pantalla.php");
 
if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../../index.php");
} else {
    $pantalla = "admpedidounidadRpt.php";
    $usId = $_SESSION['usId'];
    $objPant = new pantalla('', '', '', '', '');
    $objPant->obtenerPantallas($usId);
    $arrPant = $objPant->arregloPantalla;

    for ($q = 0; $q < count($arrPant); $q++) {
        if ($arrPant[$q]->pa_nombre == $pantalla) {
            $existe = 1;
        }
    }
    if ($existe == 0) {
        echo '<div class="alert alert-error">
  <a class="close" data-dismiss="alert"></a>
  <strong>No tiene Pemisos !!</strong>
  </div>
  </div>';
        exit;
    }
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8"> 
        <title>TEXTIL</title>
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <link href="aplicacion/vista/img/favicon.ico" rel="shortcut icon" type="image/x-icon">

        <script language="javascript" type="text/javascript" src="../../../../aplicacion/librerias/select2/js/json2.js"></script>
        <script language="javascript" type="text/javascript" src="../../../../aplicacion/librerias/select2/js/jquery-1.7.1.min.js"></script>
        <script language="javascript" type="text/javascript" src="../../../../aplicacion/librerias/select2/js/jquery-ui-1.8.20.custom.min.js"></script> <!-- for sortable example -->
        <script language="javascript" type="text/javascript" src="../../../../aplicacion/librerias/select2/js/jquery.mousewheel.js"></script>
        <script language="javascript" type="text/javascript" src="../../../../aplicacion/librerias/select2/prettify/prettify.min.js"></script>
        <script language="javascript" type="text/javascript" src="../../../../aplicacion/librerias/select2/select2-master/select24155.js"></script>
        <script language="javascript" type="text/javascript" src="../../../../aplicacion/librerias/typeahead/typeahead.js"></script>
        <script language="javascript" type="text/javascript" src="../../../../aplicacion/librerias/typeahead/typeahead.min.js"></script>

        <link rel="stylesheet" type="text/css" href="../../../../aplicacion/librerias/bootstrap/css/bootstrap.css" ></link>
        <link rel="stylesheet" type="text/css" href="../../../../aplicacion/librerias/bootstrap/css/bootstrap-responsive.css" ></link>

        <link rel="stylesheet" href="../../../../aplicacion/librerias/wrap/bootstrap-combined.no-icons.min.css">
        <link rel="stylesheet" href="../../../../aplicacion/librerias/wrap/custom.css"> 
        <link rel="stylesheet" href="../../../../aplicacion/librerias/theme-style.css">

        <link rel="stylesheet" href="../../../../aplicacion/librerias/select2/select2-master/select24155.css"/>

        
        <script src="../../js/ajax.js"></script>

        <style>
            body{
                background: white;
            }  
        </style>
    </head>
    <body>
 
        
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    Reporte Prendas Unidad
                </div>
            </div> 
        </div>
        
        <script>
            function pdf(){
                var nombre = document.getElementById('ped_nombre').value;
                window.location.href = 'http://localhost/Test/aplicacion/vista/pantalla/registros/vistas/pedidoUnidad.php?nombre='+nombre;
            }
        </script>
                
         <div id="contenedor" style="width: 70%">
            <div id="postform">
                <div id="error" style="display: block;"> </div>
                   <input type="text"  placeholder="Buscar" id="ped_nombre" style="width: 400px;" data-provide="typeahead" data-items="7" data-source='<?php echo json_encode($arreglo) ?>'>                    
                   <button style="margin-top:-8px;" type="button" class='btn btn-primary' id='botonn' onclick="pedidoUnidadConsBusqueda();"><img src="../../img/rptPlano.png"/>Texto</button>
                   <a target="_blank"  style="margin-top:-8px;" class="btn btn-danger" onclick="pdf();">Exportar a PDF</a>
                </div>
            </div>
        
        <div id="contenedorRpt" style="width: 70%;">
            
        </div>
          
        <script src="../../../../aplicacion/librerias/wrap/bootstrap.min.js"></script> 
        <script src="../../../../aplicacion/librerias/bootstrap-carousel.js"></script>
        <script src="../../../../aplicacion/librerias/bootstrap-typeahead.js"></script>
    </body> 
</html>
