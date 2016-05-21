<?php

$cli_id=isset($_REQUEST['cli_id'])?$_REQUEST['cli_id']:null;
$cli_nombre=isset($_REQUEST['cli_nombre'])?$_REQUEST['cli_nombre']:null;
$cli_apellido=isset($_REQUEST['cli_apellido'])?$_REQUEST['cli_apellido']:null;
$cli_ciudad=isset($_REQUEST['cli_ciudad'])?$_REQUEST['cli_ciudad']:null;
$opcion_cli=isset($_REQUEST['cli_id'])?1:0;
$title= isset($_REQUEST['cli_id'])?'Editar cliente':'Ingresar cliente';
echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.' <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>         
            <tr tr style='display:none;'><td><strong>Id:</strong></td>         <td><input type='text' id='cli_id' value='$cli_id' /></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='cli_nombre' value='$cli_nombre'  /></td></tr>
            <tr><td><strong>Apellido:</strong></td>         <td><input type='text' id='cli_apellido' value='$cli_apellido'  /></td></tr>
            <tr><td><strong>Ciudad:</strong></td>         <td><input type='text' id='cli_ciudad' value='$cli_ciudad'  /></td></tr>            
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposCliente();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_cli' value='$opcion_cli' style='display:none'/> 
    </div>";
?>