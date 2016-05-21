<?php

$tra_id=isset($_REQUEST['tra_id'])?$_REQUEST['tra_id']:null;
$tra_nombre=isset($_REQUEST['tra_nombre'])?$_REQUEST['tra_nombre']:null; 
$opcion_tra=isset($_REQUEST['tra_id'])?1:0;
$title= isset($_REQUEST['tra_id'])?'Editar trazo':'Ingresar trazo';
echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.' <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='tra_id' value='$tra_id'   /></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='tra_nombre' value='$tra_nombre'  /></td></tr>
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposTrazos();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_tra' value='$opcion_tra' style='display:none'/>
    </div>";
?>