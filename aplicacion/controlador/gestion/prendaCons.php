<?php

require_once("../../modelo/dao/prenda.php");

require_once("../../modelo/dao/cliente.php");
require_once("../../modelo/dao/areac.php");
require_once("../../modelo/dao/talla.php");
require_once("../../modelo/dao/tela.php");
require_once("../../modelo/dao/insumo.php");
require_once("../../modelo/dao/prendatela.php");
require_once("../../modelo/dao/prendatalla.php");
require_once("../../modelo/dao/prendainsumo.php");
$pre_id = '0';

$objPrendaTela = new prendatela('0');
$arrPrendaTela=$objPrendaTela->arregloPrendaTela;

$objPrendaTalla = new prendatalla('0');
$arrPrendaTalla=$objPrendaTalla->arregloPrendaTalla;

$objPrendaInsumo = new prendainsumo('0');
$arrPrendaInsumo=$objPrendaInsumo->arregloPrendaInsumo;


$objPrenda = new prenda($pre_id);
$objPrendaPagina = new prenda($pre_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM prenda LIMIT " . $RegistrosAEmpezar . "," . $RegistrosAMostrar;
$objPrenda->obtenerPagin($script);

$objCliente = new cliente('0');
$arrCliente = $objCliente->arregloCliente;
            
$objTalla = new talla('0');
$arrTalla = $objTalla->arregloTalla;

$objTela = new tela('0');
$arrTela = $objTela->arregloTelas;

$objInsumo = new insumo('0');
$arrInsumo= $objInsumo->arregloInsumo;

$objArea = new areac('0');
$arrArea= $objArea->arregloArea;

$varimg="imagenprendas/";
if ($pre_id == '0') {
    $arrPrenda = $objPrenda->arregloPrenda;
    if (count($arrPrenda) > 0) {
        echo "<table class = 'table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th>Fecha</th> <th>Cliente</th><th>Area</th> <th>Tallas</th> <th>Telas</th> <th>Insumos</th> <th> Foto</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrPrenda); $r++) {
            echo "<tr>";
            
            echo "<td>";
            if (strlen(utf8_encode($arrPrenda[$r]->pre_nombre)) >= 30) {
                echo substr(utf8_encode($arrPrenda[$r]->pre_nombre), 0, 30) . '.';
            } else {
                echo utf8_encode($arrPrenda[$r]->pre_nombre);
            }
            echo "</td>";            
            
            
            echo "<td>"; 
            echo substr(utf8_encode($arrPrenda[$r]->pre_fecha), 0, 10);  
            echo "</td>";
           
            echo "<td id='cli_id" . $r . "'>";            
                for ($i = 0; $i < count($arrCliente); $i++) {
                    if($arrCliente[$i]->cli_id==$arrPrenda[$r]->pre_cli_id){
                        echo $arrCliente[$i]->cli_nombre;
                    }
                } 
            echo "</td>";
            
            echo "<td id='are_id" . $r . "'>";            
                for ($i = 0; $i < count($arrArea); $i++) {
                    if($arrArea[$i]->are_id==$arrPrenda[$r]->pre_are_id){
                        echo utf8_encode($arrArea[$i]->are_nombre);
                    }
                } 
            echo "</td>";
            
           
            echo "<td><div style='width: 200px; height: 60px; overflow-x: scroll;'>";
                for($j=0;$j<count($arrPrendaTalla);$j++){                    
                    if($arrPrenda[$r]->pre_id==$arrPrendaTalla[$j]->ptal_pre_id){
                        for($k=0;$k<count($arrTalla);$k++){
                            if($arrTalla[$k]->tal_id==$arrPrendaTalla[$j]->ptal_tal_id){
                                echo "<span style=' font: normal 12px arial!important;margin-left:2px;' class='label label-primary'>";
                                    echo ''.$arrTalla[$k]->tal_valor.''; 
                                echo "</span>";
                            }
                        }
                    }
                }  
            echo "</td>";
            
            echo "<td><div style='width: 200px; height: 60px; overflow-x: scroll;'>";
                for($j=0;$j<count($arrPrendaTela);$j++){                    
                    if($arrPrenda[$r]->pre_id==$arrPrendaTela[$j]->pt_pre_id){
                        for($k=0;$k<count($arrTela);$k++){
                            if($arrTela[$k]->tel_id==$arrPrendaTela[$j]->pt_tel_id){
                                echo "<span style=' font: normal 12px arial!important;margin-left:2px;' class='label label-primary'>";
                                    echo ''.$arrTela[$k]->tel_nombre.''; 
                                echo "</span>";
                            }
                        }
                    }
                }  
            echo "</div></td>";          
            
            echo "<td><div style='width: 200px; height: 60px; overflow-x: scroll;'>";
                for($j=0;$j<count($arrPrendaInsumo);$j++){                    
                    if($arrPrenda[$r]->pre_id==$arrPrendaInsumo[$j]->pin_pre_id){
                        for($k=0;$k<count($arrInsumo);$k++){
                            if($arrInsumo[$k]->ins_id==$arrPrendaInsumo[$j]->pin_ins_id){
                                echo "<span style=' font: normal 12px arial!important;margin-left:2px;' class='label label-primary'>";
                                    echo ''.$arrInsumo[$k]->ins_nombre.''; 
                                echo "</span>";
                            }
                        }
                    }
                }  
            echo "</div></td>";    
            
            echo "<td>";    
            echo $arrPrenda[$r]->pre_nombre.$arrPrenda[$r]->pre_img_name;
            echo "</td>";    
            
            echo "<td><img style='width:150px;height:150px;' src='".$varimg.$arrPrenda[$r]->pre_nombre.$arrPrenda[$r]->pre_img_name."' /></td>";
            echo "<td align = 'center'>";
            echo "<a title = 'Eliminar Prenda " . $arrPrenda[$r]->pre_nombre . "' href = 'javascript:delPrenda(3,\"" . $arrPrenda[$r]->pre_id . "\");'> <img style='width:16px;height:16px;border:0;' src='../../img/eliminar.png' /></a>";
            //echo "<a title = 'Editar Prenda " . $arrPrenda[$r]->pre_nombre . "' href = 'javascript:editPrenda(\"" . $arrPrenda[$r]->pre_cli_id . "\",\"" . $arrPrenda[$r]->pre_id . "\",\"" . $arrPrenda[$r]->pre_nombre . "\",\"" . utf8_encode($arrPrenda[$r]->pre_fecha) . "\",\"" . utf8_encode($arrPrenda[$r]->pre_img_name) . "\");' > <img style='width:16px;height:16px;border:0;' src='../../img/editarx.png' /></a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";
        /* Paginacion */
        $NroRegistros = count($objPrendaPagina->arregloPrenda);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginPrenda('1')\">Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginPrenda('$PagAnt')\"  > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a  onclick=\"PaginPrenda('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginPrenda('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
