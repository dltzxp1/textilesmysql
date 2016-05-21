<?php

$us_id=isset($_REQUEST['us_id'])?$_REQUEST['us_id']:null;
$ro_id=isset($_REQUEST['ro_id'])?$_REQUEST['ro_id']:null;
$re_id=isset($_REQUEST['re_id'])?$_REQUEST['re_id']:null;
$re_nombre=isset($_REQUEST['re_nombre'])?$_REQUEST['re_nombre']:null; 
$re_descripcion=isset($_REQUEST['re_descripcion'])?$_REQUEST['re_descripcion']:null;

$opcion_resp=isset($_REQUEST['re_id'])?1:0;
$title= isset($_REQUEST['re_id'])?'Editar responsabilidad':'Ingresar responsabilidad';
echo '<div class="tablaFormInsertCabec">&nbsp;'.$title.' <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='0px' cellpadding='0px' align='center'>
        <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
            <tr style='display:none;'><td>modulo:</td><td>        <input type='text' id='re_us_id' value='$us_id' onkeyup='return limiteCadena(this,8)' /></td></tr>
            <tr style='display:none;'><td>rol:</td><td>           <input type='text' id='re_ro_id' value='$ro_id' onkeyup='return limiteCadena(this,8)' /></td></tr>
            <tr style='display:none;'><td>modulo:</td><td>        <input type='text' id='re_re_id' value='$re_id' onkeyup='return limiteCadena(this,8)' /></td></tr>

            <tr><td><strong>Nombre:</strong></td><td>         <input type='text' id='re_nombre' value='$re_nombre' /></td></tr>
            <tr><td><strong>Descripcion:</strong></td><td>    <textarea style='width:200px;height:140px;' rows='4' cols='26' id='re_descripcion'>" .$re_descripcion. "</textarea> </td></tr>
                
    </table></td></tr> 
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"validarCamposResponsabilidad();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_resp' value='$opcion_resp' style='display:none'/>
    </div>";
?>