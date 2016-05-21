<?php

require_once("../../modelo/dao/insumo.php");
$ins_id = '0';
$objInsumo = new insumo($ins_id);
$objInsumoPagina = new insumo($ins_id);

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM insumo  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objInsumo->obtenerPagin($script);

if ($ins_id == '0') {
    $arrInsumo = $objInsumo->arregloInsumo;
    if (count($arrInsumo) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrInsumo); $r++) {
            echo "<tr>";
           // echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrInsumo[$r]->ins_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='ins_nombre" . $r . "'>";
            //$arrInsumo[$r]->ins_nombre .  
            if (strlen(utf8_encode($arrInsumo[$r]->ins_nombre)) >= 20) {
                echo substr(utf8_encode($arrInsumo[$r]->ins_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrInsumo[$r]->ins_nombre);
            }
            echo "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Insumo " . $arrInsumo[$r]->ins_nombre . "' href='javascript:delInsumo(3,\"" . $arrInsumo[$r]->ins_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Insumo " . $arrInsumo[$r]->ins_nombre . "' href='javascript:editInsumo(\"" . $arrInsumo[$r]->ins_id . "\",\"" . utf8_encode($arrInsumo[$r]->ins_nombre) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objInsumoPagina->arregloInsumo);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginInsumo('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginInsumo('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginInsumo('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginInsumo('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
