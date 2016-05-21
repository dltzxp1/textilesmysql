<?php
 
echo '<div class="tablaFormInsertCabec">&nbsp;Editar Despacho   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='des_id' value='" . $_REQUEST['des_id'] . "'   /></td></tr>
            <tr><td><strong>Valor:</strong></td>         <td><input type='text' id='des_nombre' value='" . $_REQUEST['des_nombre'] . "'  /></td></tr>
            
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposDespacho();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_des' value='1' style='display:none'/> 
    </div>";
?>