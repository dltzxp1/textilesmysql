<?php

require_once("../../modelo/dao/cliente.php");

$cli_id = '0';

$objCliente = new cliente($cli_id);
$objClientePagina = new cliente($cli_id);

$RegistrosAMostrar = 9;
if (isset($_REQUEST['pag'])) {
    $RegistrosAEmpezar = ($_REQUEST['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_REQUEST['pag'];
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$script = "SELECT * FROM cliente  LIMIT " . $RegistrosAEmpezar . ',' . $RegistrosAMostrar;
$objCliente->obtenerPagin($script);

if ($cli_id == '0') {
    $arrCliente = $objCliente->arregloCliente;
    if (count($arrCliente) > 0) {
        echo "<table class='table table-hover'>";
        echo "<thead>";
        //echo "<th align='center'><input type='checkbox' id='chkPadreRol' onclick='selecAllChkBox(\"chkPadreRol\",\"chkHijoRol\")' /></th><th>Nombre</th> </th><th>Apellido</th> <th>Ciudad</th>  <th>  Acciones</th>";
        echo "<th>Nombre</th> <th>Apellido</th> <th>Ciudad</th>  <th>  Acciones</th>";
        echo "</thead>";
        echo "<tbody>";
        for ($r = 0; $r < count($arrCliente); $r++) {
            echo "<tr>";
          //  echo "<td><input name='chkHijoRol' type='checkbox' id='" . $arrCliente[$r]->cli_id . "' onclick='deselecChkPadre(\"chkPadreRol\");' /></td>";
            echo "<td id='cli_nombre" . $r . "'>";
            if (strlen(utf8_encode($arrCliente[$r]->cli_nombre)) >= 20) {
                echo substr(utf8_encode($arrCliente[$r]->cli_nombre), 0, 20) . '.';
            } else {
                echo utf8_encode($arrCliente[$r]->cli_nombre);
            }
            echo "</td>";
            
            echo "<td id='cli_apellido" . $r . "'>";
            if (strlen(utf8_encode($arrCliente[$r]->cli_apellido)) >= 20) {
                echo substr(utf8_encode($arrCliente[$r]->cli_apellido), 0, 20) . '.';
            } else {
                echo utf8_encode($arrCliente[$r]->cli_apellido);
            }            
            echo "</td>";
            
            echo "<td id='cli_ciudad" . $r . "'>";
            if (strlen(utf8_encode($arrCliente[$r]->cli_ciudad)) >= 20) {
                echo substr(utf8_encode($arrCliente[$r]->cli_ciudad), 0, 20) . '.';
            } else {
                echo utf8_encode($arrCliente[$r]->cli_ciudad);
            }            
            echo "</td>";
            
                     
            echo "<td align='center'>";
            echo "<a title='Eliminar Cliente " . $arrCliente[$r]->cli_nombre . "' href='javascript:delCliente(3,\"" . $arrCliente[$r]->cli_id . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/eliminar.png' /></a>";
            echo "<a title='Editar Cliente " . $arrCliente[$r]->cli_nombre . "' href='javascript:editCliente(\"" . $arrCliente[$r]->cli_id . "\",\"" . utf8_encode($arrCliente[$r]->cli_nombre) . "\",\"" . utf8_encode($arrCliente[$r]->cli_apellido) . "\",\"" . utf8_encode($arrCliente[$r]->cli_ciudad) . "\");'><img style='width:16px;height:16px;border:0;' src='../vista/img/editarx.png' /></a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody> </table>";

        $NroRegistros = count($objClientePagina->arregloCliente);
        $PagAnt = $PagAct - 1;
        $PagSig = $PagAct + 1;
        $PagUlt = $NroRegistros / $RegistrosAMostrar;
        $Res = $NroRegistros % $RegistrosAMostrar;
        if ($Res > 0)
            $PagUlt = floor($PagUlt) + 1;
        echo '<div class="pagination" id="paginar"  style="cursor:pointer; cursor: hand">';
        echo "<ul>";
        echo "<li><a onclick=\"PaginCliente('1')\" >Primero</a> </li>";
        if ($PagAct > 1)
            echo "<li><a onclick=\"PaginCliente('$PagAnt')\" > < </a> </li>";
        echo "<li> <a <strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong> </a></li>";
        if ($PagAct < $PagUlt)
            echo " <li><a onclick=\"PaginCliente('$PagSig')\"> > </a></li> ";
        echo "<li><a onclick=\"PaginCliente('$PagUlt')\">Ultimo</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>
