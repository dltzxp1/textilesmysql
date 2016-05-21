<?php

require_once("../../modelo/dao/disenio.php");
$dise_id = '0';
$objDisenio = new disenio($dise_id);
$objDisenioPagina = new disenio($dise_id);

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM disenio  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objDisenio->obtenerPagin($script);

if ($dise_id == '0') {
    $arrDisenio = $objDisenio->arregloDisenio;
    if (count($arrDisenio) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrDisenio); $r++) {
            echo "<tr>";
           // echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrDisenio[$r]->dise_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='dise_nombre" . $r . "'>";
            //$arrDisenio[$r]->dise_nombre .  
            if (strlen(utf8_encode($arrDisenio[$r]->dise_nombre)) >= 20) {
                echo substr(utf8_encode($arrDisenio[$r]->dise_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrDisenio[$r]->dise_nombre);
            }
            echo "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Disenio " . $arrDisenio[$r]->dise_nombre . "' href='javascript:delDisenio(3,\"" . $arrDisenio[$r]->dise_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Disenio " . $arrDisenio[$r]->dise_nombre . "' href='javascript:editDisenio(\"" . $arrDisenio[$r]->dise_id . "\",\"" . utf8_encode($arrDisenio[$r]->dise_nombre) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objDisenioPagina->arregloDisenio);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginDisenio('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginDisenio('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginDisenio('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginDisenio('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
