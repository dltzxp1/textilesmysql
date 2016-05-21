<?php

$mod_id=isset($_REQUEST['mod_id'])?$_REQUEST['mod_id']:null;
$mod_nombre=isset($_REQUEST['mod_nombre'])?$_REQUEST['mod_nombre']:null; 
$opcion_mod=isset($_REQUEST['mod_id'])?1:0;
$title= isset($_REQUEST['mod_id'])?'Editar modelo':'Ingresar modelo';
echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.'  <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='mod_id' value='$mod_id'   /></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='mod_nombre' value='$mod_nombre'  /></td></tr>
            
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposModelo();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_mod' value='$opcion_mod' style='display:none'/> 
    </div>";
?>