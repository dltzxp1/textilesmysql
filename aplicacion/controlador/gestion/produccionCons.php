<?php

require_once("../../modelo/dao/produccion.php");
$prodc_id = '0';
$objProduccion = new produccion($prodc_id);
$objProduccionPagina = new produccion($prodc_id);

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM produccion  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objProduccion->obtenerPagin($script);

if ($prodc_id == '0') {
    $arrProduccion = $objProduccion->arregloProduccion;
    if (count($arrProduccion) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrProduccion); $r++) {
            echo "<tr>";
           // echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrProduccion[$r]->prodc_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='prodc_nombre" . $r . "'>";
            //$arrProduccion[$r]->prodc_nombre .  
            if (strlen(utf8_encode($arrProduccion[$r]->prodc_nombre)) >= 20) {
                echo substr(utf8_encode($arrProduccion[$r]->prodc_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrProduccion[$r]->prodc_nombre);
            }
            echo "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Produccion " . $arrProduccion[$r]->prodc_nombre . "' href='javascript:delProduccion(3,\"" . $arrProduccion[$r]->prodc_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Produccion " . $arrProduccion[$r]->prodc_nombre . "' href='javascript:editProduccion(\"" . $arrProduccion[$r]->prodc_id . "\",\"" . utf8_encode($arrProduccion[$r]->prodc_nombre) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objProduccionPagina->arregloProduccion);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginProduccion('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginProduccion('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginProduccion('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginProduccion('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
