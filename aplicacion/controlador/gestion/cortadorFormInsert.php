<?php

$cor_id=isset($_REQUEST['cor_id'])?$_REQUEST['cor_id']:null;
$cor_nombre=isset($_REQUEST['cor_nombre'])?$_REQUEST['cor_nombre']:null;
$opcion_cor=isset($_REQUEST['cor_id'])?1:0;
$title= isset($_REQUEST['cor_id'])?'Editar cortador':'Ingresar cortador';
echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.' <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='cor_id' value='$cor_id'/></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='cor_nombre' value='$cor_nombre'/></td></tr>
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposCortador();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_cor' value='$opcion_cor' style='display:none'/> 
    </div>";
?>