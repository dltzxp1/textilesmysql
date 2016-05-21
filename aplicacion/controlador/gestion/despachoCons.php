<?php

require_once("../../modelo/dao/despacho.php");
require_once("../../modelo/dao/maquila.php");
require_once("../../modelo/dao/despachomaquila.php");

$des_id = '0';

$objDespachoMaquila = new despachomaquila('0');
$arrDespachoMaquila=$objDespachoMaquila->arregloDespachoMaquila;

$objMaquila = new maquila('0');
$arrMaquila=$objMaquila->arregloMaquila;

$objDespacho = new despacho($des_id);
$objDespachoPagina = new despacho($des_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM despacho  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objDespacho->obtenerPagin($script);

if ($des_id == '0') {
    $arrDespacho = $objDespacho->arregloDespacho;
    if (count($arrDespacho) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th>Fecha</th> <th>Maquila</th> </th> <th>  Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrDespacho); $r++) {
            echo "<tr>";
            			            
            echo "<td id='des_nombre" . $r . "'>";
            if (strlen(utf8_encode($arrDespacho[$r]->des_nombre)) >= 20) {
                echo substr(utf8_encode($arrDespacho[$r]->des_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrDespacho[$r]->des_nombre);
            }
            echo "</td>";
            
            echo "<td>";
                echo substr(utf8_encode($arrDespacho[$r]->des_fecha), 0, 10);  
            echo "</td>";
            
            
            echo "<td><div style='width: 500px; height: 60px; overflow-x: scroll;'>";
                for($j=0;$j<count($arrDespachoMaquila);$j++){                    
                    if($arrDespacho[$r]->des_id==$arrDespachoMaquila[$j]->dm_des_id){
                        for($k=0;$k<count($arrMaquila);$k++){
                            if($arrMaquila[$k]->maq_id==$arrDespachoMaquila[$j]->dm_maq_id){
                                echo "<span style=' font: normal 12px arial!important;margin-left:2px;' class='label label-primary'>";
                                    echo ''.$arrMaquila[$k]->maq_nombre.''; 
                                echo "</span>";
                            }
                        }
                    }
                }  
            echo "</div></td>";     
            echo "<td align='center'>";
            echo "<a title='Eliminar Despacho " . $arrDespacho[$r]->des_nombre . "' href='javascript:delDespacho(3,\"" . $arrDespacho[$r]->des_id . "\");'><img style='width:16px;height:16px;border:0;' src='../../img/eliminar.png' /></a>";
            echo "<a title='Editar Despacho " . $arrDespacho[$r]->des_nombre . "' href='javascript:editDespacho(\"" . $arrDespacho[$r]->des_id . "\",\"" . utf8_encode($arrDespacho[$r]->des_nombre) . "\");'><img style='width:16px;height:16px;border:0;' src='../../img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objDespachoPagina->arregloDespacho);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginDespacho('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginDespacho('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginDespacho('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginDespacho('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
