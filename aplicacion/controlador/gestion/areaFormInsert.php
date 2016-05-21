<?php
$are_id=isset($_REQUEST['are_id'])?$_REQUEST['are_id']:null;
$are_nombre=isset($_REQUEST['are_nombre'])?$_REQUEST['are_nombre']:null; 
$opcion_are=isset($_REQUEST['are_id'])?1:0;
$title= isset($_REQUEST['are_id'])?'Editar area':'Ingresar area';
echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.'   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='are_id' value='$are_id'/></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='are_nombre' value='$are_nombre'/></td></tr>
            
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposArea();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_are' value='$opcion_are' style='display:none'/> 
    </div>";
?>