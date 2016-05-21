<?php
 

//require_once("../../modelo/dao/");
require_once("../../modelo/dao/pedido.php");
require_once("../../modelo/dao/prenda.php");
//require_once("../../modelo/dao/modelo.php");
require_once("../../modelo/dao/calidad.php");
require_once("../../modelo/dao/produccion.php"); 
require_once("../../modelo/dao/maquila.php"); 
require_once("../../modelo/dao/rol.php");
require_once("../../modelo/dao/usuario.php");
session_start();
$usId = $_SESSION['usId'];

$objRol=new rol($usId,'');

$ped_pre_id=isset($_REQUEST['ped_pre_id'])?$_REQUEST['ped_pre_id']:null;
$ped_des_id=isset($_REQUEST['ped_des_id'])?$_REQUEST['ped_des_id']:null;
$ped_mod_id=isset($_REQUEST['ped_mod_id'])?$_REQUEST['ped_mod_id']:null;
$ped_cor_id=isset($_REQUEST['ped_cor_id'])?$_REQUEST['ped_cor_id']:null;
$ped_tra_id=isset($_REQUEST['ped_tra_id'])?$_REQUEST['ped_tra_id']:null;
$ped_cal_id=isset($_REQUEST['ped_cal_id'])?$_REQUEST['ped_cal_id']:null;
$ped_emp_id=isset($_REQUEST['ped_emp_id'])?$_REQUEST['ped_emp_id']:null;
$ped_dise_id=isset($_REQUEST['ped_dise_id'])?$_REQUEST['ped_dise_id']:null;
$ped_prodc_id=isset($_REQUEST['ped_prodc_id'])?$_REQUEST['ped_prodc_id']:null;
        
$ped_pre_comentario=isset($_REQUEST['ped_pre_comentario'])?$_REQUEST['ped_pre_comentario']:null;
$ped_des_comentario=isset($_REQUEST['ped_des_comentario'])?$_REQUEST['ped_des_comentario']:null;
$ped_mod_comentario=isset($_REQUEST['ped_mod_comentario'])?$_REQUEST['ped_mod_comentario']:null;
$ped_cor_comentario=isset($_REQUEST['ped_cor_comentario'])?$_REQUEST['ped_cor_comentario']:null;
$ped_tra_comentario=isset($_REQUEST['ped_tra_comentario'])?$_REQUEST['ped_tra_comentario']:null;
$ped_cal_comentario=isset($_REQUEST['ped_cal_comentario'])?$_REQUEST['ped_cal_comentario']:null;
$ped_emp_comentario=isset($_REQUEST['ped_emp_comentario'])?$_REQUEST['ped_emp_comentario']:null;
$ped_dise_comentario=isset($_REQUEST['ped_dise_comentario'])?$_REQUEST['ped_dise_comentario']:null;
$ped_prodc_comentario=isset($_REQUEST['ped_prodc_comentario'])?$_REQUEST['ped_prodc_comentario']:null;
$ped_estado=isset($_REQUEST['ped_estado'])?$_REQUEST['ped_estado']:null;
$ped_fecha_entrega=isset($_REQUEST['ped_fecha_entrega'])?$_REQUEST['ped_fecha_entrega']:null;

$title= isset($_REQUEST['ped_id'])?'Editar pedido':'Ingresar pedido';



$ped_maq_id=isset($_REQUEST['ped_maq_id'])?$_REQUEST['ped_maq_id']:null;
$ped_maq_fecha=isset($_REQUEST['ped_maq_fecha'])?$_REQUEST['ped_maq_fecha']:null;
$ped_des_fecha=isset($_REQUEST['ped_des_fecha'])?$_REQUEST['ped_des_fecha']:null;


if($objRol->ro_nombre=="ROLPRENDA"){
    $objPrenda= new prenda('0');    
    $arrPrenda=$objPrenda->arregloPrenda;
}
 
/*if($objRol->ro_nombre=="ROLMODELO"){
    $objModelo= new modelo('0');
    $arrModelo=$objModelo->arregloModelo;
}*/
 
if($objRol->ro_nombre=="ROLCALIDAD"){
    $objCalidad= new calidad('0');
    $arrCalidad=$objCalidad->arregloCalidad;
}
  
if($objRol->ro_nombre=="ROLPRODUCCION"){
    $objProduccion= new produccion('0');
    $arrProduccion=$objProduccion->arregloProduccion;
}

if($objRol->ro_nombre=="ROLDESPACHO"){
    $objMaquila= new maquila('0');
    $arrMaquila=$objMaquila->arregloMaquila;
}

echo "<input style='display:none;' type='text' value='$objRol->ro_nombre' name='ped_nombre_ROL' id='ped_nombre_ROL' />";

$pre_nombre=null;
$des_nombre=null;
$mod_nombre=null;
$cor_nombre=null;
$tra_nombre=null;
$cal_nombre=null;
$emp_nombre=null;
$dise_nombre=null;
$prodc_nombre=null;
$maq_nombre=null;

$objPrendaEdi= new prenda('0');     
$objMaquilaEdi= new maquila('0'); 
$objCalidadEdi= new calidad('0');
 
$objProduccionEdi= new produccion('0');
$arrPrendaEdi=$objPrendaEdi->arregloPrenda; 
$arrMaquilaEdi=$objMaquilaEdi->arregloMaquila;
$arrCalidadEdi=$objCalidadEdi->arregloCalidad;
$arrProduccionEdi=$objProduccionEdi->arregloProduccion;
//$arrMaquilaEdi=$objM

if (isset($_REQUEST['ped_pre_id'])) {
    for ($j = 0; $j < count($arrPrendaEdi); $j++) {
        if ($arrPrendaEdi[$j]->pre_id == $ped_pre_id) {
            $pre_nombre=$arrPrendaEdi[$j]->pre_nombre;
        } 
    }
}

if (isset($_REQUEST['ped_maq_id'])) {    
    for ($j = 0; $j < count($arrMaquilaEdi); $j++) {
        if ($arrMaquilaEdi[$j]->maq_id == $ped_maq_id) {
            $maq_nombre=$arrMaquilaEdi[$j]->maq_nombre;
        } 
    }
}


if (isset($_REQUEST['ped_cal_id'])) {    
    for ($j = 0; $j < count($arrCalidadEdi); $j++) {
        if ($arrCalidadEdi[$j]->cal_id == $ped_cal_id) {
            $cal_nombre=$arrCalidadEdi[$j]->cal_nombre;
        } 
    }
}
 
if (isset($_REQUEST['ped_prodc_id'])) {    
    for ($j = 0; $j < count($arrProduccionEdi); $j++) {
        if ($arrProduccionEdi[$j]->prodc_id == $ped_prodc_id) {
            $prodc_nombre=$arrProduccionEdi[$j]->prodc_nombre;
        } 
    }
}

  
if($pre_nombre==null){
   $pre_nombre="Seleccione Prenda" ;
}
if($des_nombre==null){
    $des_nombre="Seleccione Nombre";
}

/*
if($mod_nombre==null){
    $mod_nombre="Seleccione Modelo";
}*/

if($cor_nombre==null){
    $cor_nombre="Seleccione Cortador";
}
if($tra_nombre==null){
    $tra_nombre="Seleccione Trazo";
}
if($cal_nombre==null){
    $cal_nombre="Seleccione Calidad";
}
if($emp_nombre==null){
    $emp_nombre="Seleccione Empaque";
}
if($dise_nombre==null){
    $dise_nombre="Seleccione Diseño";
}
if($prodc_nombre==null){
    $prodc_nombre="Seleccione Producción";
}

$ped_id=isset($_REQUEST['ped_id'])?$_REQUEST['ped_id']:null;
$ped_nombre=isset($_REQUEST['ped_nombre'])?$_REQUEST['ped_nombre']:null;
$opcion_ped=isset($_REQUEST['ped_id'])?1:0;

if(isset($_REQUEST['ped_id'])){
    $fechaResta=isset($_REQUEST['fechaResta'])?$_REQUEST['fechaResta']:null;
}
    
$arrayEstado = array("ACTIVO","INACTIVO");

echo '<div class="tablaFormInsertCabec">&nbsp; '.$title.' <img style="position:absolute;left:95.5%;margin-top:1px;" id="btnSalir" src="../vista/img/fileclose.png" onclick="ocultarDiv(\'divFormulario\');" /> </div>';
echo "<div class='tablaFormInsertBody' align='center'>
    <table class='tablaFormInsert' border='0' cellspacing='5px' cellpadding='5px' align='center'>
    
        <tr><td align='center'>
            <table> 
               <tr style='display:none;'>
                <td><strong>Id:</strong></td>         <td><input type='text' id='ped_id' value='$ped_id' />
                   </td></tr>";
            
            //if($objRol->ro_nombre=="ROLADMIN"){
          echo "<tr>
                      <td><strong>Orden de producción:</strong></td><td><input  type='text' id='ped_nombre' name='ped_nombre' value='$ped_nombre' />
                      </td>";
                      if(isset($_REQUEST['ped_id'])){
                        echo "<td><strong>Días restantes para entrega : $fechaResta </strong></td>";
                      } 
          echo "</tr>";
            //}
          
          if($objRol->ro_nombre=="ROLADMIN"){
          echo "<tr>
                      <td><strong>Fecha Entrega</strong></td>
                      <td>";
                      
            echo "
                <div id='datetimepicker1' class='input-append'>
                    <input data-format='yyyy/MM/dd' type='text' id='ped_fecha_entrega' value='$ped_fecha_entrega'></input>
                    <span class='add-on'>
                      <i data-time-icon='icon-time' data-date-icon='icon-calendar'>
                      </i>
                    </span>
                </div>";
            
         echo "<script type='text/javascript'>
           $(function() {
             $('#datetimepicker1').datetimepicker({
               language: 'en',
               pick12HourFormat: true
             });
           });
         </script>";
                      echo "</td>";
          echo "</tr>";
          }
            echo "<tr>
                <td><strong>Prenda</strong></td>
                <td>
                    <div class='btn-group' style='width: 200px;position: relative;'>";            
                        if(isset($_REQUEST['ped_pre_id'])) {                             
                            echo "<button class='btn' id='pre_nombre' style='width:196px;'>$pre_nombre</button>";
                        }else{
                            echo "<button class='btn' id='pre_nombre' style='width: 196px;'>Seleccione Prenda</button>"; 
                        }                        
                        echo "<button class='btn dropdown-toggle' data-toggle='dropdown'>
                            <span class='caret'></span>
                        </button>"; 
                        if(isset($arrPrenda) && $ped_estado=='ACTIVO'){
                            echo "<ul class='dropdown-menu'  style='left: 10%;'>";
                                for ($r = 0; $r < count($arrPrenda); $r++) {
                                    echo "<li> <a href=\"javascript:admPedidoAsignarPrenda('" . $arrPrenda[$r]->pre_id . "','" . utf8_encode($arrPrenda[$r]->pre_nombre) . "');\">" . utf8_encode($arrPrenda[$r]->pre_nombre) . "</a></li>";
                                }
                            echo "</ul>";
                         }
                        echo "</div>       
                    <input type='text' id='ped_pre_id' style='display:none;' value='$ped_pre_id' />
                </td>
                <td><input type='text' placeholder='Prenda des..'  id='ped_pre_comentario' value='$ped_pre_comentario' style='margin-top:7px;width:300px;'/></td>
            </tr>
            
            <tr>
                <td><strong>Modelo</strong></td>
                <td>";
                    if($objRol->ro_nombre=='ROLMODELO'){
                        if($ped_mod_id!==''){
                            echo "<input type='checkbox' id='ped_mod_id' checked > $objRol->ro_nombre ";
                        }else{
                            echo "<input type='checkbox' id='ped_mod_id' value='$objRol->ro_nombre'> $objRol->ro_nombre ";
                        }
                    }else{                        
                        if($ped_mod_id){
                            echo "<input type='checkbox' id='ped_mod_id' value='$ped_mod_id' checked disabled > $ped_mod_id ";
                        }else{
                            echo "<input type='checkbox' id='ped_mod_id' value='$ped_mod_id' disabled>";
                        }
                    }
                echo "</td>
                <td><input type='text' placeholder='Trazo des..'  id='ped_mod_comentario' value='$ped_mod_comentario' style='margin-top:7px;width:300px;'/></td>
                    
            </tr>
            <tr>
                <td><strong>Trazo</strong></td>
                <td>";
                    if($objRol->ro_nombre=='ROLTRAZO'){
                        if($ped_tra_id!==''){
                            echo "<input type='checkbox' id='ped_tra_id' checked > $objRol->ro_nombre ";
                        }else{
                            echo "<input type='checkbox' id='ped_tra_id' value='$objRol->ro_nombre'> $objRol->ro_nombre ";
                        }
                    }else{                        
                        if($ped_tra_id){
                            echo "<input type='checkbox' id='ped_tra_id' value='$ped_tra_id' checked disabled > $ped_tra_id ";
                        }else{
                            echo "<input type='checkbox' id='ped_tra_id' value='$ped_tra_id' disabled>";
                        }
                    }
                echo "</td>
                <td><input type='text' placeholder='Trazo des..'  id='ped_tra_comentario' value='$ped_tra_comentario' style='margin-top:7px;width:300px;'/></td>
            </tr>
            
            <tr>
                <td><strong>Corte</strong></td>                 
                <td>";
                    if($objRol->ro_nombre=='ROLCORTADOR'){
                        if($ped_cor_id!==''){
                            echo "<input type='checkbox' id='ped_cor_id' checked > $objRol->ro_nombre ";
                        }else{
                            echo "<input type='checkbox' id='ped_cor_id' value='$objRol->ro_nombre'> $objRol->ro_nombre ";
                        }
                    }else{                        
                        if($ped_cor_id){
                            echo "<input type='checkbox' id='ped_cor_id' value='$ped_cor_id' checked disabled > $ped_cor_id ";
                        }else{
                            echo "<input type='checkbox' id='ped_cor_id' value='$ped_cor_id' disabled>";
                        }
                    }
                echo "</td> 
                <td><input type='text' placeholder='Cortador des..'  id='ped_cor_comentario' value='$ped_cor_comentario' style='margin-top:7px;width:300px;'/></td>
            </tr>
            <tr>
                <td><strong>Diseño Grafico</strong></td>
                <td>";
                    if($objRol->ro_nombre=='ROLDISENIO'){
                        if($ped_dise_id!==''){
                            echo "<input type='checkbox' id='ped_dise_id' checked > $objRol->ro_nombre ";
                        }else{
                            echo "<input type='checkbox' id='ped_dise_id' value='$objRol->ro_nombre'> $objRol->ro_nombre ";
                        }
                    }else{                        
                        if($ped_dise_id){
                            echo "<input type='checkbox' id='ped_dise_id' value='$ped_dise_id' checked disabled > $ped_dise_id ";
                        }else{
                            echo "<input type='checkbox' id='ped_dise_id' value='$ped_dise_id' disabled>";
                        }
                    }
                echo "</td>
                <td><input type='text' placeholder='Diseño Grafico des..'  id='ped_dise_comentario' value='$ped_dise_comentario' style='margin-top:7px;width:300px;'/></td>
            </tr>

            <tr> 
                <td><strong>Despacho</strong></td>";
                if($objRol->ro_nombre=='ROLDESPACHO'){
                    echo "<td>";
                    //echo "ccc:".$ped_des_fecha;
                    if($ped_des_id!==''){
                        //echo "<input type='checkbox' id='ped_des_id' checked onclick=\"mostrarMaquila();\" > $objRol->ro_nombre ";
                        echo "<input type='checkbox' id='ped_des_id' checked > $objRol->ro_nombre ";
                    }else{
                        echo "<input type='checkbox' id='ped_des_id' value='$objRol->ro_nombre' onclick=\"mostrarMaquila();\"> $objRol->ro_nombre ";
                    }
                    
                    echo "</td>";                        
                    echo "<td id='mostrar1' style='display:none;'>
                        <table>
                            <tr>
                                 <td>Fecha</td>
                                    <td>
                                         <div id='datetimepicker1' class='input-append'>";
                                            
                                              if($ped_des_fecha!==''){
                                                  echo "<input data-format='yyyy/MM/dd' type='text' id='ped_maq_fecha' value='$ped_des_fecha' style='width:75px;'> </input>";
                                              }else{
                                                  echo "<input data-format='yyyy/MM/dd' type='text' id='ped_maq_fecha' value='' style='width:75px;'> </input>";
                                              }

                                              echo "<span class='add-on'>
                                                <i data-time-icon='icon-time' data-date-icon='icon-calendar'>
                                                </i>
                                              </span>
                                        </div>
                                        <script type='text/javascript'>
                                         $(function() {
                                           $('#datetimepicker1').datetimepicker({
                                            language: 'en',
                                            pick12HourFormat: true
                                           });
                                         });
                                        </script>
                                 </td> 
                            </tr>
                            <tr>
                                <td>Maquila</td>
                                <td>
                                    <div class='btn-group' style='width: 200px;position: relative;'>";
                                      if(isset($_REQUEST['ped_maq_id'])) {                             
                                           echo "<button class='btn' id='maq_nombre' style='width:130px;'> $maq_nombre </button>";
                                      }else{
                                           echo "<button class='btn' id='maq_nombre' style='width: 130px;'>Sel.. Maquila</button>"; 
                                      }                        
                                      echo "<button class='btn dropdown-toggle' data-toggle='dropdown'>
                                                 <span class='caret'></span>
                                      </button>";               
                                            echo "<ul class='dropdown-menu'  style='left: 10%;'>";
                                                for ($r = 0; $r < count($arrMaquila); $r++) {
                                                      echo "<li> <a href=\"javascript:admPedidoAsignarMaquila('" . $arrMaquila[$r]->maq_id . "','" . utf8_encode($arrMaquila[$r]->maq_nombre) . "');\">" . utf8_encode($arrMaquila[$r]->maq_nombre) . "</a></li>";
                                                }
                                            echo "</ul>";
                                      echo "</div>
                                      <input type='text' id='ped_maq_id' style='display:none;' value='$ped_maq_id' />
                                </td>
                            </tr>
                            <tr>
                                <td>Maquila</td>
                                <td><input type='text' placeholder='Despacho des..'  id='ped_des_comentario' value='$ped_des_comentario' style='width: 200px;position: relative;'/></td> 
                            </tr>
                            
                 </table>
            </td> ";  
                                      
               }
                   else{                        
                        if($ped_des_id){
                            echo "<td> <input type='checkbox' id='ped_des_id' value='$ped_des_id' checked disabled > $ped_des_id </td>";
                        }else{
                            echo "<td><input type='checkbox' id='ped_des_id' value='$ped_des_id' disabled> </td>";
                        }
                    }
                               
            echo "</tr>
            <tr>
                <td><strong>Producción</strong></td>
                <td>
                    <div class='btn-group' style='width: 200px;position: relative;'>"; 
                        if(isset($_REQUEST['ped_prodc_id'])) {                             
                            echo "<button class='btn' id='prodc_nombre' style='width: 196px;'>$prodc_nombre</button>";
                        }else{
                            echo "<button class='btn' id='prodc_nombre' style='width: 196px;'>Seleccione Producción</button>";     
                        }        
                                
                        echo "<button class='btn dropdown-toggle' data-toggle='dropdown'>
                            <span class='caret'></span>
                        </button>"; 
                        if(isset($arrProduccion) && $ped_estado=='ACTIVO'){
                            echo "<ul class='dropdown-menu'  style='left: 10%;'>";
                                for ($r = 0; $r < count($arrProduccion); $r++) {
                                    echo "<li> <a href=\"javascript:admPedidoAsignarProduccion('" . $arrProduccion[$r]->prodc_id. "','" . utf8_encode($arrProduccion[$r]->prodc_nombre) . "');\">" . utf8_encode($arrProduccion[$r]->prodc_nombre) . "</a></li>";
                                }
                            echo "</ul>";
                         }
                        echo "</div>       
                    <input type='text' id='ped_prodc_id' style='display:none;' value='$ped_prodc_id'/>
                </td>
                <td><input type='text' placeholder='Producción des..'  id='ped_prodc_comentario' value='$ped_prodc_comentario' style='margin-top:7px;width:300px;'/></td>
            </tr>
            

            <tr>
                <td><strong>Calidad</strong></td>
                <td>
                    <div class='btn-group' style='width: 200px;position: relative;'>";
                        if(isset($_REQUEST['ped_cal_id'])) {                             
                            echo "<button class='btn' id='cal_nombre' style='width: 196px;'>$cal_nombre</button>";
                        }else{
                            echo "<button class='btn' id='cal_nombre' style='width: 196px;'>Seleccione Calidad</button>";     
                        }
                        echo "<button class='btn dropdown-toggle' data-toggle='dropdown'>
                            <span class='caret'></span>
                        </button>"; 
                        if(isset($arrCalidad) && $ped_estado=='ACTIVO'){
                            echo "<ul class='dropdown-menu'  style='left: 10%;'>";
                                for ($r = 0; $r < count($arrCalidad); $r++) {
                                    echo "<li> <a href=\"javascript:admPedidoAsignarCalidad('" . $arrCalidad[$r]->cal_id . "','" . utf8_encode($arrCalidad[$r]->cal_nombre) . "');\">" . utf8_encode($arrCalidad[$r]->cal_nombre) . "</a></li>";
                                }
                            echo "</ul>";
                         }
                        echo "</div>       
                    <input type='text' id='ped_cal_id' style='display:none;' value='$ped_cal_id'/>
                </td>
                <td><input type='text' placeholder='Calidad des..'  id='ped_cal_comentario' value='$ped_cal_comentario' style='margin-top:7px;width:300px;'/></td>
            </tr>
             <tr>
                <td><strong>Empaque</strong></td>
                 <td>";
                    if($objRol->ro_nombre=='ROLEMPAQUE'){
                        if($ped_emp_id!==''){
                            echo "<input type='checkbox' id='ped_emp_id' checked > $objRol->ro_nombre ";
                        }else{
                            echo "<input type='checkbox' id='ped_emp_id' value='$objRol->ro_nombre'> $objRol->ro_nombre ";
                        }
                    }else{                        
                        if($ped_emp_id){
                            echo "<input type='checkbox' id='ped_emp_id' value='$ped_emp_id' checked disabled > $ped_emp_id";
                        }else{
                            echo "<input type='checkbox' id='ped_emp_id' value='$ped_emp_id' disabled>";
                        }
                    }
                echo "</td> 
                <td><input type='text' placeholder='Empaque des..'  id='ped_emp_comentario' value='$ped_emp_comentario' style='margin-top:7px;width:300px;'/></td>
            </tr>
            <tr>
                <td><strong>Estado</strong></td>
                <td>
                    <div class='btn-group' style='width: 200px;position: relative;'>";
                        if(isset($_REQUEST['ped_estado'])) {
                            echo "<button class='btn' id='ped_estado_nombre' style='width: 196px;'>$ped_estado</button>"; 
                        }else{
                            echo "<button class='btn' id='ped_estado_nombre' style='width: 196px;'>Seleccione Estado</button>";
                        }
                        echo "<button class='btn dropdown-toggle' data-toggle='dropdown'>
                            <span class='caret'></span>
                        </button>";
                        if($objRol->ro_nombre=="ROLADMIN"){
                            echo "<ul class='dropdown-menu' style='left: 10%;'>";
                                for ($r = 0; $r < count($arrayEstado); $r++) {
                                    echo "<li> <a href=\"javascript:admPedidoEstado('" . utf8_encode($arrayEstado[$r]) . "');\">" . utf8_encode($arrayEstado[$r]) . "</a></li>";
                                }
                            echo "</ul>";
                        }
                        echo "</div>
                    <input type='text' id='ped_estado_val' style='display:none;' value='$ped_estado'/>
                </td>
            </tr>";
                
        echo "</table>
        </td></tr>
    </table>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"AgregarPedido();\">Guardar</button>
        <button style='margin-top:10px;margin-bottom:10px;' class='btn btn-success' onclick=\"ocultarDiv('divFormulario');\">Cerrar</button>
        <input type='text' id='opcion_ped' value='$opcion_ped' style='display:none;'/>
    </div>";
?>