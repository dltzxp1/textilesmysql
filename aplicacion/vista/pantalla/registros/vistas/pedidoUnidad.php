<?php
require('../fpdf/fpdf.php');

require_once("../../../../modelo/dao/pedido.php");
require_once("../../../../modelo/dao/prenda.php");
require_once("../../../../modelo/dao/cliente.php");
require_once("../../../../modelo/dao/prendatela.php");
require_once("../../../../modelo/dao/tela.php");

require_once("../../../../modelo/dao/prendainsumo.php");
require_once("../../../../modelo/dao/insumo.php");

require_once("../../../../modelo/dao/produccion.php");
require_once("../../../../modelo/dao/calidad.php");
require_once("../../../../modelo/dao/prendatalla.php");
require_once("../../../../modelo/dao/talla.php");

         
$ped_nombre=isset($_REQUEST['nombre'])?$_REQUEST['nombre']:null; 

if(isset($_REQUEST['nombre'])){
    $script="SELECT * FROM pedido WHERE ped_nombre='$ped_nombre'";
}
if($ped_nombre==null){
    $script="SELECT * FROM pedido";
}
 
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
$arrPrendaTela= $objPrendaTela->arregloPrendaTela;
$arrTela= $objTela->arregloTelas;
$arrPrendaInsumo= $objPrendaInsumo->arregloPrendaInsumo;
$arrInsumo = $objInsumo->arregloInsumo;
$arrProduccion = $objProduccion->arregloProduccion;
$arrCalidad = $objCalidad->arregloCalidad;
$arrPrendaTalla= $objPrendaTalla->arregloPrendaTalla;
$arrTalla= $objTalla->arregloTalla;

$objPedido= new pedido('0');
$objPedido->obtenerPagin($script);
$arrPedido=$objPedido->arregloPedido;
 
//$pdf = new FPDF(
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('../recursos/Camisasf.gif' , 10 ,8, 10 , 13,'GIF');
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(150, 10, 'TEXTILES S.A', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 10, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(200, 8, 'PEDIDO', 0);

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 8); 
 

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
$varimg="../../img/imagenprendas/"; 
$type=null;

//for($i=0;$i<count($arrPedido);$i++){
    //if($arrPedido[$i]->ped_nombre==$ped_nombre){
       $pediID= $objPedido->ped_id;
       $preID=$objPedido->ped_pre_id;
       $traID=$objPedido->ped_tra_id;
       $corID=$objPedido->ped_cor_id;
    //}
//}

for($i=0;$i<count($arrPrenda);$i++){ 
    if($arrPrenda[$i]->pre_id==$objPedido->ped_pre_id){
        
       $preNOMBRE= $arrPrenda[$i]->pre_nombre;
       $pre_cli_ID=$arrPrenda[$i]->pre_cli_id;
       $pre_are_ID=$arrPrenda[$i]->pre_are_id;
       //$pre_des_ID=$arrPrenda[$i]->pre_des_id;
       $fotoNOMBRE=$varimg.$arrPrenda[$i]->pre_nombre.$arrPrenda[$i]->pre_img_name;
       $type=$arrPrenda[$i]->pre_img_type;
    }
} 

for($i=0;$i<count($arrCliente);$i++){
    if($arrCliente[$i]->cli_id==$pre_cli_ID){
       $cliNOMBRE= $arrCliente[$i]->cli_nombre;
    }
}

 

for($i=0;$i<count($arrPrendaTela);$i++){
    if($arrPrendaTela[$i]->pt_pre_id==$preID){
        //echo $arrPrendaTela[$i]->pt_tel_id;
       //$prendaTelaCadena[$i]=$arrPrendaTela[$i]->pt_tel_id;
    }
} 
 

$pdf->Cell(20, 8, 'ID: '.$objPedido->ped_id, 0);
$pdf->Ln(1);
$pdf->Cell(20, 15, 'Orden de Produccion: '.$objPedido->ped_nombre, 0);
$pdf->Ln(4);
$pdf->Cell(20, 15, 'Prenda: '.$preNOMBRE, 0);
$pdf->Ln(4);
$pdf->Cell(20, 15, 'Cliente: '.$cliNOMBRE, 0);
$pdf->Ln(4);
$pdf->Cell(20, 15, 'Produccion: '.$objPedido->ped_prodc_id, 0);


$pdf->Ln(4);
$pdf->Cell(20, 15, 'Fecha creacion: '.$objPedido->ped_fecha, 0);
$pdf->Ln(4);
$pdf->Cell(20, 15, 'Fecha entrega: '.$objPedido->ped_fecha_entrega, 0);

$telas="";
$insumos="";
$tallas="";
for($i=0;$i<count($arrPrendaTela);$i++){
    if($arrPrendaTela[$i]->pt_pre_id==$preID){
        for($j=0;$j<count($arrTela);$j++){
            if($arrPrendaTela[$i]->pt_tel_id==$arrTela[$j]->tel_id){
                $telas=$telas.$arrTela[$j]->tel_nombre.'  ';
            }
        }
    }
}

$pdf->Ln(27);
$pdf->Cell(20, 15, 'TELAS', 0);
$pdf->Ln(4);
$pdf->Cell(20, 15, $telas, 0);
$pdf->Ln(4);
$pdf->Cell(20, 15, 'TRAZO: '.$objPedido->ped_tra_id, 0);
$pdf->Ln(4);
$pdf->Cell(20, 15, 'CORTE: '.$objPedido->ped_cor_id, 0);
$pdf->Ln(4);

for($i=0;$i<count($arrPrendaInsumo);$i++){
    if($arrPrendaInsumo[$i]->pin_pre_id==$preID){
        for($j=0;$j<count($arrInsumo);$j++){
            if($arrPrendaInsumo[$i]->pin_ins_id==$arrInsumo[$j]->ins_id){
                //echo $arrInsumo[$j]->ins_nombre.', ';
                $insumos=$insumos.$arrInsumo[$j]->ins_nombre.'  ';
            }
        }
    }
}
$pdf->Cell(20, 15, 'INSUMOS', 0);
$pdf->Ln(4);
$pdf->Cell(400, 15,$insumos, 0);                    
$pdf->Ln(4);

 

$pdf->Ln(4);     

$pdf->Ln(4);
for($i=0;$i<count($arrProduccion);$i++){
    if($arrProduccion[$i]->prodc_id==$objPedido->ped_prodc_id){
       // echo $arrProduccion[$i]->prodc_nombre;
        $pdf->Cell(20, 15, 'PRODUCCION: '.$arrProduccion[$i]->prodc_nombre, 0);
    }    
}
$pdf->Ln(4);

for($i=0;$i<count($arrCalidad);$i++){
    if($arrCalidad[$i]->cal_id==$objPedido->ped_cal_id){
        //echo $arrCalidad[$i]->cal_nombre;
        $pdf->Cell(20, 15, 'CALIDAD: '.$arrCalidad[$i]->cal_nombre, 0);
    }    
} 

 
$pdf->Ln(4);
$pdf->Cell(20, 15, 'TALLAS: ', 0);
for($i=0;$i<count($arrPrendaTalla);$i++){
    if($arrPrendaTalla[$i]->ptal_pre_id==$preID){
        for($j=0;$j<count($arrTalla);$j++){
            if($arrPrendaTalla[$i]->ptal_tal_id==$arrTalla[$j]->tal_id){
                //echo $arrTalla[$j]->tal_valor.', ';
                $tallas=$tallas.$arrTalla[$j]->tal_valor.'  ';
            }
        }
    }
}

$pdf->Cell(20, 15, $tallas, 0);
                        
if($type=='image/gif'){
    $pdf->Image($fotoNOMBRE , 100 ,30, 60 , 50,'GIF');    
}
if($type=='image/image/jpeg'){
    $pdf->Image($fotoNOMBRE , 100 ,10, 10 , 13,'JPEG');    
}

$pdf->SetFont('Arial', 'B', 8);

$pdf->Output();
?>
 

 