<?php

require_once("../../modelo/dao/tela.php");
$tel_id = '0';

$objTela = new tela($tel_id);
$objTelaPagina = new tela($tel_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM tela  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objTela->obtenerPagin($script);

if ($tel_id == '0') {
    $arrTela = $objTela->arregloTelas;
    if (count($arrTela) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>"; 
        echo "<th>Nombre</th> </th><th>Color</th> <th>Medida</th>  <th>  Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrTela); $r++) {
            echo "<tr>";
            //echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrTela[$r]->tel_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='tel_nombre" . $r . "'>";
            if (strlen(utf8_encode($arrTela[$r]->tel_nombre)) >= 20) {
                echo substr(utf8_encode($arrTela[$r]->tel_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrTela[$r]->tel_nombre);
            }
            echo "</td>";
            
            echo "<td id='tel_color" . $r . "'>";
            if (strlen(utf8_encode($arrTela[$r]->tel_color)) >= 20) {
                echo substr(utf8_encode($arrTela[$r]->tel_color), 0, 20) . '.';
            } else {
                echo utf8_encode($arrTela[$r]->tel_color);
            }            
            echo "</td>";
            
            echo "<td id='tel_medida" . $r . "'>";
            if (strlen(utf8_encode($arrTela[$r]->tel_medida)) >= 20) {
                echo substr(utf8_encode($arrTela[$r]->tel_medida), 0, 20) . '.';
            } else {
                echo utf8_encode($arrTela[$r]->tel_medida);
            }            
            echo "</td>";
            
            echo "<td align='center'>";
            echo "<a title='Eliminar Tela " . $arrTela[$r]->tel_nombre . "' href='javascript:delTela(3,\"" . $arrTela[$r]->tel_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Tela " . $arrTela[$r]->tel_nombre . "' href='javascript:editTela(\"" . $arrTela[$r]->tel_id . "\",\"" . utf8_encode($arrTela[$r]->tel_nombre) . "\",\"" . utf8_encode($arrTela[$r]->tel_color) . "\",\"" . utf8_encode($arrTela[$r]->tel_medida) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objTelaPagina->arregloTelas);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginTela('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginTela('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginTela('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginTelas('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
