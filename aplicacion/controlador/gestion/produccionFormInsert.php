<?php

$prodc_id=isset($_REQUEST['prodc_id'])?$_REQUEST['prodc_id']:null;
$prodc_nombre=isset($_REQUEST['prodc_nombre'])?$_REQUEST['prodc_nombre']:null; 
$opcion_prodc=isset($_REQUEST['prodc_id'])?1:0;
$title= isset($_REQUEST['prodc_id'])?'Editar producción':'Ingresar producción';

echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.'  <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='prodc_id' value='$prodc_id'/></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='prodc_nombre' value='$prodc_nombre'/></td></tr>
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposProduccion();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_prodc' value='$opcion_prodc' style='display:none'/> 
    </div>";
?>