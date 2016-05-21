<?php

$cal_id=isset($_REQUEST['cal_id'])?$_REQUEST['cal_id']:null;
$cal_nombre=isset($_REQUEST['cal_nombre'])?$_REQUEST['cal_nombre']:null; 
$opcion_cal=isset($_REQUEST['cal_id'])?1:0;
$title= isset($_REQUEST['cal_id'])?'Editar calidad':'Ingresar calidad';

echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.' <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='cal_id' value='$cal_id'/></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='cal_nombre' value='$cal_nombre'/></td></tr>
            
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposCalidad();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_cal' value='$opcion_cal' style='display:none'/> 
    </div>";
?>