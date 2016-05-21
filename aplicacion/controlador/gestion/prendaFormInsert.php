<?php
include_once '../../modelo/dao/cliente.php';
include_once '../../modelo/dao/tela.php';
include_once '../../modelo/dao/talla.php';


//$CA_id = $_REQUEST['CA_id'];

$objCliente = new cliente('0');
$arrCliente = $objCliente->arregloCliente;


$objTela = new tela('0');
$arrTela= $objTela->arregloTelas;

$objTalla = new talla('0');
$arrTalla = $objTalla->arregloTalla;
 

echo '<div class="tablaFormInsertCabec">&nbsp;Ingresar Articulo   <img  style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';

echo "<div class='tablaFormInsertBody' align='center'>
     <table class='tablaFormInsert' border='0' cellspacing='0px' cellpadding='0px' align='center'>
        <tr><td align='center'><table border='0' cellspacing='0px' cellpadding='0px'>
        
         
       <tr>
            <td><strong>Cliente</strong></td>
            <td>
                <div class='btn-group' style='width: 200px;position: relative;'>
                    <button class='btn' id='cli_nombre' style='width: 196px;'>Seleccione Cliente</button>
                    <button class='btn dropdown-toggle' data-toggle='dropdown'>
                        <span class='caret'></span>
                    </button>
                    <ul class='dropdown-menu'  style='left: 10%;'>";
                        for ($r = 0; $r < count($arrCliente); $r++) {
                            echo "<li> <a href=\"javascript:asignarCliente('" . $arrCliente[$r]->cli_id . "','" . utf8_encode($arrCliente[$r]->cli_nombre) . "');\">" . utf8_encode($arrCliente[$r]->cli_nombre) . "</a></li>";
                            }
                       echo "</ul>
                </div>       
                <input type='text' id='cli_id' style='display:none;'/>
            </td>
       </tr>
       

        <tr>
            <td><strong>Tela</strong></td>
            <td>
                <div class='btn-group' style='width: 200px;position: relative;'>
                    <button class='btn' id='cat_tel_nombre' style='width: 196px;'>Seleccione Tela</button>
                    <button class='btn dropdown-toggle' data-toggle='dropdown'>
                        <span class='caret'></span>
                    </button>
                    <ul class='dropdown-menu'  style='left: 10%;'>";
                        for ($r = 0; $r < count($arrTela); $r++) {
                            echo "<li> <a href=\"javascript:asignarTela('" . $arrTela[$r]->cat_tel_id . "','" . utf8_encode($arrTela[$r]->cat_tel_nombre) . "');\">" . utf8_encode($arrTela[$r]->cat_tel_nombre) . "</a></li>";
                            }
                       echo "</ul>
                </div>       
                <input type='text' id='cat_tel_id' style='display:none;'/>
            </td>
       </tr>       



        <tr>
            <td><strong>Talla</strong></td>
            <td>
                <div class='btn-group' style='width: 200px;position: relative;'>
                    <button class='btn' id='cat_tal_valor' style='width: 196px;'>Seleccione Talla</button>
                    <button class='btn dropdown-toggle' data-toggle='dropdown'>
                        <span class='caret'></span>
                    </button>
                    <ul class='dropdown-menu'  style='left: 10%;'>";
                        for ($r = 0; $r < count($arrTalla); $r++) {
                            echo "<li> <a href=\"javascript:asignarTalla('" . $arrTalla[$r]->cat_tal_id . "','" . utf8_encode($arrTalla[$r]->cat_tal_valor) . "');\">" . utf8_encode($arrTalla[$r]->cat_tal_valor) . "</a></li>";
                            }
                       echo "</ul>
                </div>       
                <input type='text' id='cat_tal_id' style='display:none;'/>
            </td>
       </tr>
       


        <tr><td><strong>Nombre:</strong></td>           <td> <input  placeholder='Nombre Articulo'  type='text' id='pre_nombre' /></td></tr>
        
                        
   </table></td></tr>    
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' id='botonn' onclick=\"validarCamposPrenda();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_pre' value='0' style='display:none'/>
    </div>";
?>