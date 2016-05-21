<?php
$ins_id=isset($_REQUEST['ins_id'])?$_REQUEST['ins_id']:null;
$ins_nombre=isset($_REQUEST['ins_nombre'])?$_REQUEST['ins_nombre']:null; 
$opcion_ins=isset($_REQUEST['ins_id'])?1:0;
$title= isset($_REQUEST['ins_id'])?'Editar insumo':'Ingresar insumo';
echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.'   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='ins_id' value='$ins_id'/></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='ins_nombre' value='$ins_nombre'/></td></tr>
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposInsumo();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_cal' value='$opcion_ins' style='display:none'/> 
    </div>";
?>