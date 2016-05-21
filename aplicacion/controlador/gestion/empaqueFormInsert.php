<?php

$emp_id=isset($_REQUEST['emp_id'])?$_REQUEST['emp_id']:null;
$emp_nombre=isset($_REQUEST['emp_nombre'])?$_REQUEST['emp_nombre']:null; 
$opcion_emp=isset($_REQUEST['emp_id'])?1:0;
$title= isset($_REQUEST['emp_id'])?'Editar empaque':'Ingresar empaque';

echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.'  <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='emp_id' value='$emp_id'/></td></tr>
            <tr><td><strong>Nombre:</strong></td>         <td><input type='text' id='emp_nombre' value='$emp_nombre'/></td></tr>
            
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposEmpaque();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_emp' value='$opcion_emp' style='display:none'/>
    </div>";
?>