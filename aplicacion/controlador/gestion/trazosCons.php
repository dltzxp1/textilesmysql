<?php

require_once("../../modelo/dao/trazos.php");
$tra_id = '0';

$objTrazos = new trazos($tra_id);
$objTrazosPagina = new trazos($tra_id);

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM trazos  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objTrazos->obtenerPagin($script);

if ($tra_id == '0') {
    $arrTrazos= $objTrazos->arregloTrazos;
    if (count($arrTrazos) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrTrazos); $r++) {
            echo "<tr>";
           // echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrTrazos[$r]->tra_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='tra_nombre" . $r . "'>";
            //$arrTrazos[$r]->tra_nombre .  
            if (strlen(utf8_encode($arrTrazos[$r]->tra_nombre)) >= 20) {
                echo substr(utf8_encode($arrTrazos[$r]->tra_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrTrazos[$r]->tra_nombre);
            }
            echo "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Trazos" . $arrTrazos[$r]->tra_nombre . "' href='javascript:delTrazos(3,\"" . $arrTrazos[$r]->tra_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Trazos" . $arrTrazos[$r]->tra_nombre . "' href='javascript:editTrazos(\"" . $arrTrazos[$r]->tra_id . "\",\"" . utf8_encode($arrTrazos[$r]->tra_nombre) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objTrazosPagina->arregloTrazos);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginPaginTrazos('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginTrazos('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginTrazos('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginTrazos('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
