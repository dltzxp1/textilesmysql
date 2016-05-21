<?php

$dise_id=isset($_REQUEST['dise_id'])?$_REQUEST['dise_id']:null;
$dise_nombre=isset($_REQUEST['dise_nombre'])?$_REQUEST['dise_nombre']:null; 
$opcion_dise=isset($_REQUEST['dise_id'])?1:0;
$title= isset($_REQUEST['dise_id'])?'Editar diseño':'Ingresar diseño';

echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.' <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='dise_id' value='$dise_id'/></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='dise_nombre' value='$dise_nombre'/></td></tr>
            
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposDisenio();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_dise' value='$opcion_dise' style='display:none'/> 
    </div>";
?>