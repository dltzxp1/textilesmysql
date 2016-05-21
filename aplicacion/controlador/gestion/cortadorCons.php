<?php

require_once("../../modelo/dao/cortador.php");
$cor_id = '0';
$objCortador = new cortador($cor_id);
$objCortadorPagina = new cortador($cor_id);

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM cortador  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objCortador->obtenerPagin($script);

if ($cor_id == '0') {
    $arrCortador = $objCortador->arregloCortador;
    if (count($arrCortador) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrCortador); $r++) {
            echo "<tr>";
           // echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrCortador[$r]->cor_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='cor_nombre" . $r . "'>";
            //$arrCortador[$r]->cor_nombre .  
            if (strlen(utf8_encode($arrCortador[$r]->cor_nombre)) >= 20) {
                echo substr(utf8_encode($arrCortador[$r]->cor_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrCortador[$r]->cor_nombre);
            }
            echo "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Cortador " . $arrCortador[$r]->cor_nombre . "' href='javascript:delCortador(3,\"" . $arrCortador[$r]->cor_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Cortador " . $arrCortador[$r]->cor_nombre . "' href='javascript:editCortador(\"" . $arrCortador[$r]->cor_id . "\",\"" . utf8_encode($arrCortador[$r]->cor_nombre) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objCortadorPagina->arregloCortador);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginCortador('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginCortador('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginCortador('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginCortador('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
