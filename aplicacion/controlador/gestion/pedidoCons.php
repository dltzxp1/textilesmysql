<?php

/*PEDIDO REPORTE.*/
require_once("../../modelo/dao/pedido.php");
require_once("../../modelo/dao/prenda.php"); 
//require_once("../../modelo/dao/modelo.php");
require_once("../../modelo/dao/calidad.php");
require_once("../../modelo/dao/rol.php");
require_once("../../modelo/dao/cliente.php");

session_start();
$usId = $_SESSION['usId'];
$objRol=new rol($usId,'');

$ped_id = '0';
$objPedido = new pedido('0');
$objPrenda = new prenda('0');
$objCliente = new cliente('0');
//$objModelo = new modelo('0');
$arrPrenda=$objPrenda->arregloPrenda;
$arrCliente=$objCliente->arregloCliente;
//$arrModelo=$objModelo->arregloModelo;

$objPedidoPagina = new pedido($ped_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM pedido  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objPedido->obtenerPagin($script);
$tam=null;


if ($ped_id == '0') {
    $arrPedido = $objPedido->arregloPedido;    
    if (count($arrPedido) > 0) {
        $tam=count($arrPedido);
        
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Orden de producción</th> <th>Prenda</th>  <th>Cliente</th> <th>Creación</th><th>Entrega</th> <th>Estado</th><th>Días restantes para entrega</th>   <th>  Acciones</th>";
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
            for($j=0;$j<count($arrPrenda);$j++){
                if($arrPrenda[$j]->pre_id==$arrPedido[$r]->ped_pre_id){
                     echo $arrPrenda[$j]->pre_nombre;
                }
            }
            echo "</td>";
            
            echo "<td>";
            for($j=0;$j<count($arrPrenda);$j++){
                if($arrPrenda[$j]->pre_id==$arrPedido[$r]->ped_pre_id){
                    for($k=0;$k<count($arrCliente);$k++){
                        if($arrCliente[$k]->cli_id==$arrPrenda[$j]->pre_cli_id ){
                            echo $arrCliente[$k]->cli_nombre;
                        }
                    }
                }
            }
            echo "</td>";
               
            echo "<td id='fCre" . $r . "'>";
                echo substr($arrPedido[$r]->ped_fecha, 0, 10); 
            echo "</td>"; 
            
            echo "<td id='fEnt" . $r . "'>";
                echo substr($arrPedido[$r]->ped_fecha_entrega, 0, 10);
            echo "</td>";
            
            echo "<td>";
                echo $arrPedido[$r]->ped_estado; 
            echo "</td>"; 
            
            echo "<td id='diasRest" . $r . "'>";
                echo  "";
            echo "</td>";
            
         
            
            echo "<td align='center'>";
            if($objRol->ro_nombre=="ROLADMIN"){
                echo "<a title='Eliminar Pedido " . $arrPedido[$r]->ped_nombre . "' href='javascript:delPedido(3,\"" . $arrPedido[$r]->ped_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            }
            echo "<a title='Editar Pedido " . $arrPedido[$r]->ped_nombre . "' href='javascript:editPedido(\"" . $arrPedido[$r]->ped_fecha . "\",\"" . $arrPedido[$r]->ped_id . "\",\"" . $arrPedido[$r]->ped_nombre . "\",\"" . $arrPedido[$r]->ped_pre_id . "\",\"" . $arrPedido[$r]->ped_des_id . "\",\"" . $arrPedido[$r]->ped_mod_id . "\",\"" . $arrPedido[$r]->ped_cor_id . "\",\"" . $arrPedido[$r]->ped_tra_id . "\",\"" . $arrPedido[$r]->ped_cal_id . "\",\"" . $arrPedido[$r]->ped_emp_id . "\",\"" . $arrPedido[$r]->ped_dise_id . "\",\"" . $arrPedido[$r]->ped_prodc_id . "\",\"" . $arrPedido[$r]->ped_pre_comentario . "\",\"" . $arrPedido[$r]->ped_des_comentario . "\",\"" . $arrPedido[$r]->ped_mod_comentario . "\",\"" . $arrPedido[$r]->ped_cor_comentario . "\",\"" . $arrPedido[$r]->ped_tra_comentario . "\",\"" . $arrPedido[$r]->ped_cal_comentario . "\",\"" . $arrPedido[$r]->ped_emp_comentario . "\",\"" . $arrPedido[$r]->ped_dise_comentario . "\",\"" . $arrPedido[$r]->ped_prodc_comentario . "\",\"" . $arrPedido[$r]->ped_estado . "\",\"" . $arrPedido[$r]->ped_fecha_entrega. "\",\"" . $arrPedido[$r]->ped_maq_id. "\",\"" . $arrPedido[$r]->ped_des_fecha. "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
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
        echo "<li><a onclick=\"PaginPedido('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginPedido('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginPedido('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginPedido('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
