<?php
/* * **************************** */

$ped_fecha_i=isset($_REQUEST['ped_fecha_i'])?$_REQUEST['ped_fecha_i']:null;
$ped_fecha_f=isset($_REQUEST['ped_fecha_f'])?$_REQUEST['ped_fecha_f']:null;

session_start();
require_once("../../modelo/dao/pantalla.php");
$existe=null;
if (!isset($_SESSION['usUsuario'])) {
    header("Location: ../../../index.php");
} else {
    $pantalla = "admpedidoRpt.php";
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
/* * **************************** */
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../vista/js/estiloadm.css" />
    </head>
    <style>
       .solobordeIng{
                display: block;
                position: absolute;
                background: white; 
                width: 100%;
                height: 4%;
                top: 10%;
            }

            #cabBotones{
                display: block;
                top: 15%; 
                padding-top: 1%;
                position: absolute;
                width: 100%; 
                z-index: 100;
                height: 10%;
            }

            #divTabla{
                display: block;
                top: 27%;
                position: absolute;
                width: 100%;
                z-index: 40;
                height:65%;
                background: white;
                overflow-y: hidden;
                overflow-x: hidden;
            }
    </style>
    <script>
        window.onload=consPedidoRPT('0');        
    </script>
    <body>
        
        <div class="solobordeIng" align="center">
            Reporte de Pedidos
        </div> 

        <div id="cabBotones">
            <ul class="nav nav-tabs" style="height: auto;"> 
                <strong>feha Inicial:</strong>       
                
                <div id="datetimepicker1" class="input-append">
                    <input data-format="yyyy/MM/dd" type="text" id="fecha_ini"></input>
                    <span class="add-on">
                      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                      </i>
                    </span>
                </div>            
                <script type="text/javascript">
                   $(function() {
                     $('#datetimepicker1').datetimepicker({
                       language: 'en',
                       pick12HourFormat: true
                     });
                     
                   });
                 </script>
            
                <strong>feha Inicial:</strong>        
                <div id="datetimepicker2" class="input-append">
                    <input data-format="yyyy/MM/dd" type="text" id="fecha_fin"></input>
                    <span class="add-on">
                      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                      </i>
                    </span>
                </div> 
                 
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="estado_nombre" aria-haspopup="true" aria-expanded="false">
                        <b style="color:back;"> Estado  </b> 
                    </button>
                    <ul class="dropdown-menu">
                        <li><a onclick="cambiarEstadoACINA('ACTIVO');">ACTIVO</a></li>
                        <li><a onclick="cambiarEstadoACINA('INACTIVO');">INACTIVO</a></li>
                        <li><a onclick="cambiarEstadoACINA('TODOS');">TODOS</a></li>
                    </ul>
                  </div>
                <input type='text' id='ped_estado' style='display:none;'/>
                       

                <script type="text/javascript">
                  $(function() {
                    $('#datetimepicker2').datetimepicker({
                      language: 'en',
                      pick12HourFormat: true
                    });
                  });
                </script>
                
                <script>
                    function pdf(){
                        var fecha_ini = document.getElementById('fecha_ini').value;
                        var fecha_fin = document.getElementById('fecha_fin').value;
                        var ped_estado = document.getElementById('ped_estado').value;
                        
                        window.location.href = 'http://localhost/demo/aplicacion/vista/pantalla/registros/vistas/pedido.php?fa='+fecha_ini+'&fb='+fecha_fin+'&pe='+ped_estado;
                    }
                </script>
                
                <button class='btn btn-success' onclick='buscarPedidoTodos();'>Buscar</button>
                <a target="_blank" class="btn btn-danger" onclick="pdf();">Exportar a PDF</a>
                
            </ul>
        </div>
        <div id="divTabla" ></div>
        <div id="divFormulario" class="soloborde" style="display: none;"> 
        </div>
    </body> 
</html>