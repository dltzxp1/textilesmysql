<?php

require_once("../../modelo/dao/talla.php");
$tal_id = '0';

$objTalla = new talla($tal_id);
$objTallaPagina = new talla($tal_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM talla  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objTalla->obtenerPagin($script);

if ($tal_id == '0') {
    $arrTalla = $objTalla->arregloTalla;
    if (count($arrTalla) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        //echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Valor</th> </th> <th>  Acciones</th>";
        echo "<th>Valor</th> <th>  Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrTalla); $r++) {
            echo "<tr>";
            //echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrTalla[$r]->tal_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
			
            echo "<td id='tal_valor" . $r . "'>";
            if (strlen(utf8_encode($arrTalla[$r]->tal_valor)) >= 20) {
                echo substr(utf8_encode($arrTalla[$r]->tal_valor), 0, 20) . '.';
            } else {
                echo utf8_encode($arrTalla[$r]->tal_valor);
            }
            echo "</td>";
			
            echo "<td align='center'>";
            echo "<a title='Eliminar Talla " . $arrTalla[$r]->tal_valor . "' href='javascript:delTalla(3,\"" . $arrTalla[$r]->tal_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Talla " . $arrTalla[$r]->tal_valor . "' href='javascript:editTalla(\"" . $arrTalla[$r]->tal_id . "\",\"" . utf8_encode($arrTalla[$r]->tal_valor) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objTallaPagina->arregloTalla);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginTalla('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginTalla('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginTalla('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginTalla('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
