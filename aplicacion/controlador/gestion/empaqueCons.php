<?php

require_once("../../modelo/dao/empaque.php");
$emp_id = '0';
$objEmpaque = new empaque($emp_id);
$objEmpaquePagina = new empaque($emp_id);

$RegistrosAMostrar = 5;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM empaque  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objEmpaque->obtenerPagin($script);

if ($emp_id == '0') {
    $arrEmpaque = $objEmpaque->arregloEmpaque;
    if (count($arrEmpaque) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        echo "<th>Nombre</th><th> Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrEmpaque); $r++) {
            echo "<tr>";
           // echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrEmpaque[$r]->emp_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='emp_nombre" . $r . "'>";
            //$arrEmpaque[$r]->emp_nombre .  
            if (strlen(utf8_encode($arrEmpaque[$r]->emp_nombre)) >= 20) {
                echo substr(utf8_encode($arrEmpaque[$r]->emp_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrEmpaque[$r]->emp_nombre);
            }
            echo "</td>";
            echo "<td align='center'>";
            echo "<a title='Eliminar Empaque " . $arrEmpaque[$r]->emp_nombre . "' href='javascript:delEmpaque(3,\"" . $arrEmpaque[$r]->emp_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Empaque " . $arrEmpaque[$r]->emp_nombre . "' href='javascript:editEmpaque(\"" . $arrEmpaque[$r]->emp_id . "\",\"" . utf8_encode($arrEmpaque[$r]->emp_nombre) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objEmpaquePagina->arregloEmpaque);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginEmpaque('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginEmpaque('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginEmpaque('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginEmpaque('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
