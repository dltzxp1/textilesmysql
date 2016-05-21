<?php

require_once("../../modelo/dao/maquila.php");
$maq_id = '0';

$objMaquila = new maquila($maq_id);
$objMaquilaPagina = new maquila($maq_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM maquila  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objMaquila->obtenerPagin($script);

if ($maq_id == '0') {
    $arrMaquila = $objMaquila->arregloMaquila;
    if (count($arrMaquila) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th> </th> <th>  Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrMaquila); $r++) {
            echo "<tr>";
            //echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrMaquila[$r]->maq_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
			
            echo "<td id='maq_nombre" . $r . "'>";
            if (strlen(utf8_encode($arrMaquila[$r]->maq_nombre)) >= 20) {
                echo substr(utf8_encode($arrMaquila[$r]->maq_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrMaquila[$r]->maq_nombre);
            }
            echo "</td>";
			
            echo "<td align='center'>";
            echo "<a title='Eliminar Maquila " . $arrMaquila[$r]->maq_nombre . "' href='javascript:delMaquila(3,\"" . $arrMaquila[$r]->maq_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Maquila " . $arrMaquila[$r]->maq_nombre . "' href='javascript:editMaquila(\"" . $arrMaquila[$r]->maq_id . "\",\"" . utf8_encode($arrMaquila[$r]->maq_nombre) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objMaquilaPagina->arregloMaquila);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginMaquila('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginMaquila('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginMaquila('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginMaquila('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
