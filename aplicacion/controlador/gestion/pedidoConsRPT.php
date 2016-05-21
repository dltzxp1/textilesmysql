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
$ped_estado=isset($_REQUEST['ped_estado'])?$_REQUEST['ped_estado']:null;

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
    if($ped_estado=='TODOS'){
        $script = "SELECT * FROM pedido WHERE ped_fecha>='$fecha_ini' AND ped_fecha<='$fecha_fin' LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;    
    }else{
        $script = "SELECT * FROM pedido WHERE ped_fecha>='$fecha_ini' AND ped_fecha<='$fecha_fin' AND ped_estado='$ped_estado' LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;    
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
        echo "<th>Orden de producción</th> <th>Fechas</th> <th>Estado</th><th>Prenda</th> <th>Modelo</th><th>Trazos</th> <th>Cortador</th><th>Diseño gráfico</th><th>Despacho</th><th>Producción</th> <th>Calidad</th> <th>Empaque</th><th>Días restantes para entrega</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrPedido); $r++) {
            echo "<tr>";
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
                if(isset($arrPedido[$r]->ped_mod_id)){
                    echo $arrPedido[$r]->ped_mod_id.'<BR/>';                
                    echo substr($arrPedido[$r]->ped_mod_fecha, 0, 10); 
                    echo '<div class="alert alert-info">';
                    echo $arrPedido[$r]->ped_mod_comentario;
                    echo '</div>';
                }             
            echo "</td>";
            
            
            echo "<td>";
            if(isset($arrPedido[$r]->ped_tra_id)){
                echo $arrPedido[$r]->ped_tra_id.'<BR/>';
                echo substr($arrPedido[$r]->ped_tra_fecha, 0, 10); 
                echo '<div class="alert alert-info">';
                echo $arrPedido[$r]->ped_tra_comentario;
                echo '</div>';
            }            
            echo "</td>";
            
            echo "<td>";
                if(isset($arrPedido[$r]->ped_cor_id)){
                    echo $arrPedido[$r]->ped_cor_id.'<BR/>';                
                    echo substr($arrPedido[$r]->ped_cor_fecha, 0, 10); 
                    echo '<div class="alert alert-info">';
                    echo $arrPedido[$r]->ped_cor_comentario;
                    echo '</div>';
                }  
            echo "</td>";  
            echo "<td>";
            if(isset($arrPedido[$r]->ped_dise_id)){
                echo $arrPedido[$r]->ped_dise_id.'<BR/>';
                echo substr($arrPedido[$r]->ped_dise_fecha, 0, 10); 
                echo '<div class="alert alert-info">';
                echo $arrPedido[$r]->ped_dise_comentario;
                echo '</div>';
            }
            echo "</td>";
            
            echo "<td>";
            if(isset($arrPedido[$r]->ped_des_id)){
                echo $arrPedido[$r]->ped_des_id.'<BR/>'; 
                echo substr($arrPedido[$r]->ped_des_fecha, 0, 10); 
                echo '<div class="alert alert-info">';
                echo $arrPedido[$r]->ped_des_comentario;
                echo '</div>';
            }
            echo "</td>";            
            
            echo "<td>";
            if(isset($arrPedido[$r]->ped_prodc_id)){ 
                
                //echo $arrPedido[$r]->ped_prodc_id.'<BR/>'; 
                for($j=0;$j<count($arrProduccion);$j++){
                    if($arrProduccion[$j]->prodc_id==$arrPedido[$r]->ped_prodc_id){
                         echo $arrProduccion[$j]->prodc_nombre.'<BR/>';
                    }
                }
                
                echo substr($arrPedido[$r]->ped_prodc_fecha, 0, 10); 
                echo '<div class="alert alert-info">';
                echo $arrPedido[$r]->ped_prodc_comentario;
                echo '</div>';
            }
            echo "</td>";
            
               echo "<td>";
            if(count($arrCalidad)>0){
                for($j=0;$j<count($arrCalidad);$j++){
                    if($arrCalidad[$j]->cal_id==$arrPedido[$r]->ped_cal_id){
                         echo $arrCalidad[$j]->cal_nombre.'<BR/>';
                    }
                }
                echo substr($arrPedido[$r]->ped_cal_fecha, 0, 10); 
                echo '<div class="alert alert-info">';
                echo $arrPedido[$r]->ped_cal_comentario;
                echo '</div>';
            }
            echo "</td>";  
            
            
            echo "<td>";
            if(isset($arrPedido[$r]->ped_emp_id)){ 
                echo $arrPedido[$r]->ped_emp_id.'<BR/>';
                echo substr($arrPedido[$r]->ped_emp_fecha, 0, 10); 
                echo '<div class="alert alert-info">';
                echo $arrPedido[$r]->ped_emp_comentario;
                echo '</div>';
            }
            
            echo "</td>"; 
            
         
            
            echo "<td id='diasRest" . $r . "'>";
                echo  "";
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
        echo "<li><a onclick=\"buscarPedidoTodosPagin('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"buscarPedidoTodosPagin('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"buscarPedidoTodosPagin('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"buscarPedidoTodosPagin('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
