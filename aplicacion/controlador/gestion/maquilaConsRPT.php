<?php

// consulta con rango de fecha.

require_once("../../modelo/dao/pedido.php");
require_once("../../modelo/dao/prenda.php");
//require_once("../../modelo/dao/modelo.php"); 
require_once("../../modelo/dao/calidad.php"); 
require_once("../../modelo/dao/produccion.php"); 

$fecha_ini=isset($_REQUEST['fecha_ini'])?$_REQUEST['fecha_ini']:null;
$fecha_fin=isset($_REQUEST['fecha_fin'])?$_REQUEST['fecha_fin']:null;
$fecha_estado=isset($_REQUEST['fecha_estado'])?$_REQUEST['fecha_estado']:null;
$maq_estado=isset($_REQUEST['maq_estado'])?$_REQUEST['maq_estado']:null;

$ped_id = '0';
$objPedido = new pedido('0');
$objPrenda = new prenda('0');
//$objModelo = new modelo('0');
$objCalidad = new calidad('0');
$objProduccion = new produccion('0');

$arrPrenda = $objPrenda->arregloPrenda;
//$arrModelo = $objModelo->arregloModelo;
$arrCalidad = $objCalidad->arregloCalidad;    
$arrProduccion = $objProduccion->arregloProduccion;   
 

$objPedidoPagina = new pedido($ped_id);

$RegistrosAMostrar = 6;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

if($fecha_estado=='1'){
    if($maq_estado=='ENTREGADO'){
        $script = "SELECT * FROM pedido WHERE ped_fecha>='$fecha_ini' AND ped_fecha<='$fecha_fin' AND ped_maq_fecha!='' LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;    
    }else if($maq_estado=='PENDIENTE'){
        $script = "SELECT * FROM pedido WHERE ped_fecha>='$fecha_ini' AND ped_fecha<='$fecha_fin' AND ped_maq_fecha is null LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;    
    }
}else{
    $script = "SELECT * FROM pedido LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;    
}

$objPedido->obtenerPagin($script);
$tam=null;
if ($ped_id == '0') {
    $arrPedido = $objPedido->arregloPedido;    
    if (count($arrPedido) > 0) {
        $tam=count($arrPedido);
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>ID</th><th>Orden de producción</th> <th>Fechas</th> <th>Estado</th><th>Prenda</th> <th>Fecha Creación Maquila</th><th>Fecha Entrega Maquila</th> ";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrPedido); $r++) {
            echo "<tr>";
            
            echo "<td>";
                echo $arrPedido[$r]->ped_id;
            echo "</td>";
            
            echo "<td>";
            if (strlen(utf8_encode($arrPedido[$r]->ped_nombre)) >= 20) {
                echo substr(utf8_encode($arrPedido[$r]->ped_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrPedido[$r]->ped_nombre);
            }
            echo "</td>";
            
          
            echo "<td>";
                echo "Creacion: ".substr(utf8_encode($arrPedido[$r]->ped_fecha), 0, 10)."<BR/>"; 
                echo "Entrega: ".substr(utf8_encode($arrPedido[$r]->ped_fecha_entrega), 0, 10); 
            echo "</td>";
               echo "<td>";
                echo utf8_encode($arrPedido[$r]->ped_estado);
            echo "</td>";
            
            /*echo "<td id='fEnt" . $r . "'>";
                echo substr(utf8_encode($arrPedido[$r]->ped_fecha_entrega), 0, 10); 
            echo "</td>";
            */
            
            echo "<td id='fEnt" . $r . "' style='display:none;'>";
                echo "Entrega: ".substr($arrPedido[$r]->ped_fecha_entrega, 0, 10); 
            echo "</td>";
                                  
            echo "<td>";
            if(count($arrPrenda)>0){                
                for($j=0;$j<count($arrPrenda);$j++){                    
                    if($arrPrenda[$j]->pre_id==$arrPedido[$r]->ped_pre_id){
                         echo $arrPrenda[$j]->pre_nombre.'<BR/>';
                    }
                }
                echo substr($arrPedido[$r]->ped_pre_fecha, 0, 10).'<BR/>';
                echo '<div class="alert alert-info">';
                echo $arrPedido[$r]->ped_pre_comentario;
                echo '</div>';                
            }
            echo "</td>";
            
            echo "<td>";
                echo "".substr($arrPedido[$r]->ped_des_fecha, 0, 10); 
            echo "</td>";
            
            echo "<td>";
                echo "".substr($arrPedido[$r]->ped_maq_fecha, 0, 10); 
            echo "</td>";
            
            echo "</tr>";
        }
        echo "</tbody> </table>";
        
        echo "<input type='text' id='tamPedido' value='$tam' style='display:none;'/>";

        $NroRegistros = count($objPedidoPagina->arregloPedido);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"buscarMaquilaTodosPagin('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"buscarMaquilaTodosPagin('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"buscarMaquilaTodosPagin('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"buscarMaquilaTodosPagin('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
