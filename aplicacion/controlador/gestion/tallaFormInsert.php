<?php
$tal_id=isset($_REQUEST['tal_id'])?$_REQUEST['tal_id']:null;
$tal_valor=isset($_REQUEST['tal_valor'])?$_REQUEST['tal_valor']:null;
$opcion_tal=isset($_REQUEST['tal_id'])?1:0;
$title= isset($_REQUEST['tal_id'])?'Editar talla':'Ingresar talla';

echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.'<img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
        <tr><td align='center'><table>
            <tr style='display:none;'><td>Codigo:</td>    <td><input type='text' id='tal_id' value='$tal_id'   /></td></tr>
            <tr><td><strong>Valor:</strong></td>         <td><input type='text' id='tal_valor' value='$tal_valor'  /></td></tr>
            
        </table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposTalla();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_tal' value='$opcion_tal' style='display:none'/> 
    </div>";
?>