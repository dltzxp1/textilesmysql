<?php

$tel_id=isset($_REQUEST['tel_id'])?$_REQUEST['tel_id']:null;
$tel_nombre=isset($_REQUEST['tel_nombre'])?$_REQUEST['tel_nombre']:null;
$tel_color=isset($_REQUEST['tel_color'])?$_REQUEST['tel_color']:null;
$tel_medida=isset($_REQUEST['tel_medida'])?$_REQUEST['tel_medida']:null;
$opcion_tel=isset($_REQUEST['tel_id'])?1:0;
 
$title= isset($_REQUEST['tel_id'])?'Editar tela':'Ingresar tela';
echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.'   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='tel_id' value='$tel_id'   /></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='tel_nombre' value='$tel_nombre'  /></td></tr>
            <tr><td><strong>Color:</strong></td>       <td><input type='text' id='tel_color' value='$tel_color'  /></td></tr>
            <tr><td><strong>Medida:</strong></td>         <td><input type='text' id='tel_medida' value='$tel_medida'  /></td></tr>
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposTela();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_tel' value='$opcion_tel' style='display:none'/> 
    </div>";
?>