
<?php
require_once("../../modelo/dao/maquila.php");
$objMaquila= new maquila('0');
$arrMaquina=$objMaquila->arregloMaquila;
echo '<div class="tablaFormInsertCabec">&nbsp;Ingresar despacho   <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div  class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='2px' cellpadding='2px' align='center'>         
     <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'> 
        <tr>
            <td>       <strong>Nombre:</strong></td>       
            <td><input placeholder='23' type='text' id='des_nombre' /></td>
        </tr>
        <tr><td>
        <select id='example-dropRight' multiple='multiple'>";

                for ($i = 0; $i < count($arrMaquina); $i++) {
                    echo  "<option value='1'> A</option>";                   
                } 
                
                echo       "</select>
         </td></tr>    ";
        echo "</table></td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposDespacho();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_des' value='0' style='display:none'/>  
        
    </div>";
?>