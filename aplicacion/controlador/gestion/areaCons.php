<?php

require_once("../../modelo/dao/areac.php");
$are_id = '0';
$objArea = new areac($are_id);
$objAreaPagina = new areac($are_id);

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM areac  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objArea->obtenerPagin($script);

if ($are_id == '0') {
    $arrArea = $objArea->arregloArea;
    if (count($arrArea) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrArea); $r++) {
            echo "<tr>";
            echo "<td id='are_nombre" . $r . "'>";
            if (strlen(utf8_encode($arrArea[$r]->are_nombre)) >= 20) {
                echo substr(utf8_encode($arrArea[$r]->are_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrArea[$r]->are_nombre);
            }
            echo "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Area " . $arrArea[$r]->are_nombre . "' href='javascript:delArea(3,\"" . $arrArea[$r]->are_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Area " . $arrArea[$r]->are_nombre . "' href='javascript:editArea(\"" . $arrArea[$r]->are_id . "\",\"" . utf8_encode($arrArea[$r]->are_nombre) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objAreaPagina->arregloArea);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginArea('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginArea('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginArea('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginArea('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
