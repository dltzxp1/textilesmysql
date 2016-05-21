<?php

$maq_id=isset($_REQUEST['maq_id'])?$_REQUEST['maq_id']:null;
$maq_nombre=isset($_REQUEST['maq_nombre'])?$_REQUEST['maq_nombre']:null; 
$opcion_maq=isset($_REQUEST['maq_id'])?1:0;
$title= isset($_REQUEST['maq_id'])?'Editar maquila':'Ingresar maquila';

echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.' <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='maq_id' value='$maq_id'   /></td></tr>
            <tr><td><strong>Valor:</strong></td>         <td><input type='text' id='maq_nombre' value='$maq_nombre'  /></td></tr>
            
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposMaquila();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_maq' value='$opcion_maq' style='display:none'/> 
    </div>";
?>