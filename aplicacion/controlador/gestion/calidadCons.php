<?php

require_once("../../modelo/dao/calidad.php");
$cal_id = '0';
$objCalidad = new calidad($cal_id);
$objCalidadPagina = new calidad($cal_id);

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM calidad  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objCalidad->obtenerPagin($script);

if ($cal_id == '0') {
    $arrCalidad = $objCalidad->arregloCalidad;
    if (count($arrCalidad) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrCalidad); $r++) {
            echo "<tr>";
           // echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrCalidad[$r]->cal_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='cal_nombre" . $r . "'>";
            //$arrCalidad[$r]->cal_nombre .  
            if (strlen(utf8_encode($arrCalidad[$r]->cal_nombre)) >= 20) {
                echo substr(utf8_encode($arrCalidad[$r]->cal_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrCalidad[$r]->cal_nombre);
            }
            echo "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Calidad " . $arrCalidad[$r]->cal_nombre . "' href='javascript:delCalidad(3,\"" . $arrCalidad[$r]->cal_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Calidad " . $arrCalidad[$r]->cal_nombre . "' href='javascript:editCalidad(\"" . $arrCalidad[$r]->cal_id . "\",\"" . utf8_encode($arrCalidad[$r]->cal_nombre) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objCalidadPagina->arregloCalidad);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginCalidad('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginCalidad('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginCalidad('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginCalidad('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
