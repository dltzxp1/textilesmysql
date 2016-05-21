<?php

require_once("../../modelo/dao/pedido.php");
require_once("../../modelo/dao/prenda.php");
require_once("../../modelo/dao/cliente.php");
require_once("../../modelo/dao/prendatela.php");
require_once("../../modelo/dao/tela.php");
require_once("../../modelo/dao/prendainsumo.php");
require_once("../../modelo/dao/insumo.php");
require_once("../../modelo/dao/produccion.php");
require_once("../../modelo/dao/calidad.php");
require_once("../../modelo/dao/prendatalla.php");
require_once("../../modelo/dao/talla.php");

require_once("../../modelo/dao/rol.php");
session_start();
$usId = $_SESSION['usId'];
$objRol=new rol($usId,'');
$ped_nombre=isset($_REQUEST['ped_nombre'])?$_REQUEST['ped_nombre']:null;

$objPrenda = new prenda('0');
$objCliente = new cliente('0');

$objPrendaTela = new prendatela('0');
$objTela = new tela('0');
$objPrendaInsumo = new prendainsumo('0');
$objInsumo = new insumo('0');
$objProduccion = new produccion('0');
$objCalidad = new calidad('0');
$objPrendaTalla = new prendatalla('0');
$objTalla = new talla('0');

$arrPrenda = $objPrenda->arregloPrenda;
$arrCliente = $objCliente->arregloCliente;
//$arrArea= $objArea->arregloArea;
$arrPrendaTela= $objPrendaTela->arregloPrendaTela;
$arrTela= $objTela->arregloTelas;
$arrPrendaInsumo= $objPrendaInsumo->arregloPrendaInsumo;
$arrInsumo = $objInsumo->arregloInsumo;
$arrProduccion = $objProduccion->arregloProduccion;
$arrCalidad = $objCalidad->arregloCalidad;
$arrPrendaTalla= $objPrendaTalla->arregloPrendaTalla;
$arrTalla= $objTalla->arregloTalla;

$objPedido= new pedido('0');
$arrPedido=$objPedido->arregloPedido;

$pediID=null;
$preID=null;
$traID=null;
$corID=null;
$pre_cli_ID=null;
$pre_are_ID=null;
 
$preNOMBRE=null;
$cliNOMBRE=null;
 
$areaNOMBRE=null;
$fotoNOMBRE=null;
$trazoNOMBRE=null;
$corteNOMBRE=null;
$varimg="imagenprendas/"; 


for($i=0;$i<count($arrPedido);$i++){
    if($arrPedido[$i]->ped_nombre==$ped_nombre){
       $pediID= $arrPedido[$i]->ped_id;
       $preID=$arrPedido[$i]->ped_pre_id;
       $traID=$arrPedido[$i]->ped_tra_id;
       $corID=$arrPedido[$i]->ped_cor_id;
    }
}

for($i=0;$i<count($arrPrenda);$i++){
    if($arrPrenda[$i]->pre_id==$preID){
       $preNOMBRE= $arrPrenda[$i]->pre_nombre;
       $pre_cli_ID=$arrPrenda[$i]->pre_cli_id;
       $pre_are_ID=$arrPrenda[$i]->pre_are_id;
       //$pre_des_ID=$arrPrenda[$i]->pre_des_id;
       $fotoNOMBRE=$varimg.$arrPrenda[$i]->pre_nombre.$arrPrenda[$i]->pre_img_name;
    }
}

for($i=0;$i<count($arrCliente);$i++){
    if($arrCliente[$i]->cli_id==$pre_cli_ID){
       $cliNOMBRE= $arrCliente[$i]->cli_nombre;
    }
}
/*
for($i=0;$i<count($arrArea);$i++){
    if($arrArea[$i]->are_id==$pre_are_ID){
       $areaNOMBRE= $arrArea[$i]->are_nombre;
    }
}*/

for($i=0;$i<count($arrPrendaTela);$i++){
    if($arrPrendaTela[$i]->pt_pre_id==$preID){
        //echo $arrPrendaTela[$i]->pt_tel_id;
       //$prendaTelaCadena[$i]=$arrPrendaTela[$i]->pt_tel_id;
    }
}

 

if(isset($pediID)){    
        $objPedidoBusc= new pedido($pediID);  
        
        echo "<table class='table table-hover'>";   
        
                echo "<tr>";
                    echo "<td>";
                            echo "<table>";
                                echo "<tr>";
                                    echo "<td><b>ID:</b> $objPedidoBusc->ped_id</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td><b>Orden de produccion:</b> $objPedidoBusc->ped_nombre</td>";                
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td><b>Prenda:</b> $preNOMBRE</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td><b>Cliente:</b> $cliNOMBRE</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td><b>Area:</b>";
                                    echo utf8_encode($areaNOMBRE);
                                    echo  "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td><b>Fecha creación:</b> $objPedidoBusc->ped_fecha</td>";                
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td><b>Fecha entrega:</b> $objPedidoBusc->ped_fecha_entrega</td>";                
                                echo "</tr>";
                                
                            echo "</table>";
            
                    echo "</td>";    
                    echo "<td>";      
                    
                    echo "<table>";
                                echo "<tr>";
                                    ECHO "<td> <img style='width:400px;height:250px;' src='".$fotoNOMBRE."' /><td>";
                                    ECHO "<td style='width:300px;height:250px;'>";
                                        echo '<div class="alert alert-info">';
                                        echo "Días restantes para la entrega: <h2><div id='FEC'></div></h2>";
                                        echo '</div>';                    
                                    ECHO "</td>";
                                echo "</tr>";                      
                            echo "</table>";  
                    echo "</td>";  
                echo "</tr>"; 
       
       echo "<tr>";
            echo "<td colspan='2'>"; 
                echo "<table>";
                    echo "<tr><td style='width:100%;'> <center><b>TELAS</b></center></td></tr>";
                    echo "<tr>";
                    echo "<td>";
                    for($i=0;$i<count($arrPrendaTela);$i++){
                        if($arrPrendaTela[$i]->pt_pre_id==$preID){
                                for($j=0;$j<count($arrTela);$j++){
                                        if($arrPrendaTela[$i]->pt_tel_id==$arrTela[$j]->tel_id){
                                            echo $arrTela[$j]->tel_nombre.', ';
                                    }
                                }
                        }
                    }
                    echo "</td>";
                    echo "</tr>";
                 echo "</table>";
            echo "</td>";
       echo "</tr>";
            
       echo "<tr>";
            echo "<td colspan='2'>"; 
                echo "<table>";
                    echo "<tr><td style='width:100%;'> <center><b>TRAZO</b></center></td></tr>";
                    echo "<tr>";
                    echo "<td>";
                        echo $trazoNOMBRE;
                    echo "</td>";
                    echo "</tr>";
                 echo "</table>";
            echo "</td>";
       echo "</tr>";
       
        echo "<tr>";
            echo "<td colspan='2'>"; 
                echo "<table>";
                    echo "<tr><td style='width:100%;'> <center><b>CORTE</b></center></td></tr>";
                    echo "<tr>";
                    echo "<td>";
                        echo $corteNOMBRE;
                    echo "</td>";
                    echo "</tr>";
                 echo "</table>";
            echo "</td>";
       echo "</tr>";
       
       
       echo "<tr>";
            echo "<td colspan='2'>"; 
                echo "<table>";
                    echo "<tr><td style='width:100%;'> <center><b>INSUMOS</b></center></td></tr>";
                    echo "<tr>";
                    echo "<td>";
                    for($i=0;$i<count($arrPrendaInsumo);$i++){
                        if($arrPrendaInsumo[$i]->pin_pre_id==$preID){
                                for($j=0;$j<count($arrInsumo);$j++){
                                        if($arrPrendaInsumo[$i]->pin_ins_id==$arrInsumo[$j]->ins_id){
                                        echo $arrInsumo[$j]->ins_nombre.', ';
                                    }
                                }
                        }
                    }
                    echo "</td>";
                    echo "</tr>";
                 echo "</table>";
            echo "</td>";
       echo "</tr>";
              
       echo "<tr>";
            echo "<td colspan='2'>"; 
                echo "<table>";
                    echo "<tr><td style='width:100%;'> <center><b>DESPACHO:</b> ";
                    echo $objPedidoBusc->ped_des_id;
                    echo "</center></td></tr>"; 
                    echo "<tr>";
                    echo "<td>";
                        echo $objPedidoBusc->ped_des_id.', ';
                    echo "</td>";
                    echo "</tr>";
                 echo "</table>";
            echo "</td>";
       echo "</tr>";
       
       
         echo "<tr>";
            echo "<td colspan='2'>"; 
                echo "<table>";
                    echo "<tr><td style='width:100%;'> <center><b>PRODUCCIÓN</b>";
                    echo "</center></td></tr>";
                    echo "<tr>";
                    echo "<td>";
                        for($i=0;$i<count($arrProduccion);$i++){
                            if($arrProduccion[$i]->prodc_id==$objPedidoBusc->ped_prodc_id){
                                echo $arrProduccion[$i]->prodc_nombre;
                            }    
                        }
                    echo "</td>";
                    echo "</tr>";
                 echo "</table>";
            echo "</td>";
       echo "</tr>";
       
        echo "<tr>";
            echo "<td colspan='2'>"; 
                echo "<table>";
                    echo "<tr><td style='width:100%;'> <center><b>CALIDAD</b>";
                    echo "</center></td></tr>";
                    echo "<tr>";
                    echo "<td>";
                        for($i=0;$i<count($arrCalidad);$i++){
                            if($arrCalidad[$i]->cal_id==$objPedidoBusc->ped_cal_id){
                                echo $arrCalidad[$i]->cal_nombre;
                            }    
                        }
                    echo "</td>";
                    echo "</tr>";
                 echo "</table>";
            echo "</td>";
       echo "</tr>";
       
       
       echo "<tr>";
            echo "<td colspan='2'>"; 
                echo "<table>";
                    echo "<tr><td style='width:100%;'> <center><b>EMPAQUE</b>";
                    echo "</center></td></tr>";
                    echo "<tr>";
                    echo "<td>";                        
                    echo $objPedidoBusc->ped_emp_id;
                    echo "</td>";
                    echo "</tr>";
                 echo "</table>";
            echo "</td>";
       echo "</tr>";
       
          echo "<tr>";
            echo "<td colspan='2'>"; 
                echo "<table>";
                    echo "<tr><td style='width:100%;'> <center><b>TALLA</b></center></td></tr>";
                    echo "<tr>";
                    echo "<td>";
                    for($i=0;$i<count($arrPrendaTalla);$i++){
                        if($arrPrendaTalla[$i]->ptal_pre_id==$preID){
                                for($j=0;$j<count($arrTalla);$j++){
                                        if($arrPrendaTalla[$i]->ptal_tal_id==$arrTalla[$j]->tal_id){
                                        echo $arrTalla[$j]->tal_valor.', ';
                                    }
                                }
                        }
                    }
                    echo "</td>";
                    echo "</tr>";
                 echo "</table>";
            echo "</td>";
       echo "</tr>";
      echo "</table>";
      echo "<input type='text' id='ped_fecha_entrega' value='$objPedidoBusc->ped_fecha_entrega' style='display:none'/>";        
}
     
?>
