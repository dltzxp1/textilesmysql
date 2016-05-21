<?php

require_once("../../modelo/dao/modelo.php");
$mod_id = '0';

$objModelo = new modelo($mod_id);
$objModeloPagina = new modelo($mod_id);

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM modelo  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objModelo->obtenerPagin($script);

if ($mod_id == '0') {
    $arrModelo = $objModelo->arregloModelo;
    if (count($arrModelo) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrModelo); $r++) {
            echo "<tr>";
            //echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrModelo[$r]->mod_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='mod_nombre" . $r . "'>";
            //$arrModelo[$r]->mod_nombre .  
            if (strlen(utf8_encode($arrModelo[$r]->mod_nombre)) >= 20) {
                echo substr(utf8_encode($arrModelo[$r]->mod_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrModelo[$r]->mod_nombre);
            }
            echo "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Modelo " . $arrModelo[$r]->mod_nombre . "' href='javascript:delModelo(3,\"" . $arrModelo[$r]->mod_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Modelo " . $arrModelo[$r]->mod_nombre . "' href='javascript:editModelo(\"" . $arrModelo[$r]->mod_id . "\",\"" . utf8_encode($arrModelo[$r]->mod_nombre) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objModeloPagina->arregloModelo);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginModelo('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginModelo('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginModelo('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginModelo('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
