<?php
require('../fpdf/fpdf.php');

require_once("../../../../modelo/dao/pedido.php");
require_once("../../../../modelo/dao/prenda.php"); 
//require_once("../../../../modelo/dao/modelo.php");
require_once("../../../../modelo/dao/calidad.php");
require_once("../../../../modelo/dao/produccion.php");
         
$fa=isset($_REQUEST['fa'])?$_REQUEST['fa']:null;
$fb=isset($_REQUEST['fb'])?$_REQUEST['fb']:null;
$maq_estado=isset($_REQUEST['maq_estado'])?$_REQUEST['maq_estado']:null;
$script=null;

if(isset($_REQUEST['fa']) && isset($_REQUEST['fb'])){
    if($maq_estado=='ENTREGADO'){
        $script="SELECT * FROM pedido WHERE ped_fecha>='$fa' AND ped_fecha<='$fb' AND ped_maq_fecha!=''";
    }else if($maq_estado=='PENDIENTE'){
        $script="SELECT * FROM pedido WHERE ped_fecha>='$fa' AND ped_fecha<='$fb' AND ped_maq_fecha is null ";
    }
    
}
if($fa==null && $fb==null){
    $script="SELECT * FROM pedido";
}
 
$objPedido = new pedido('0');
$objPedido->obtenerPagin($script);
$objPrenda = new prenda('0');
 
//$objModelo = new modelo('0');  
$objCalidad = new calidad('0');
 
$objProduccion = new produccion('0');

$arrPrenda = $objPrenda->arregloPrenda;
 
//$arrModelo = $objModelo->arregloModelo;   
$arrCalidad = $objCalidad->arregloCalidad;    
$arrProduccion = $objProduccion->arregloProduccion;
$arrPedido = $objPedido->arregloPedido;  
 
//$pdf = new FPDF(
$pdf=new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('../recursos/gdfgdfb.jpg' , 10 ,8, 10 , 13,'JPG');
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(150, 10, 'TEXTILES S.A"', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 10, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(200, 8, 'LISTADO DE PEDIDOS:'.$_REQUEST['fa'].'--'.$_REQUEST['fb'], 0);

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 8);
//$pdf->Cell(5, 8, 'Id', 0);
$pdf->Cell(20, 8, 'Nombre', 0);
$pdf->Cell(20, 8, utf8_decode('Creación'), 0);
$pdf->Cell(20, 8, 'Entrega', 0); 
$pdf->Cell(20, 8, 'Estado', 0);
$pdf->Cell(20, 8, 'Prenda', 0);
$pdf->Cell(20, 8, utf8_decode('Fecha cración maquila'), 0);
$pdf->Cell(20, 8, 'entrega maquila', 0);
 

$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);

//$this->SetY(10,10);
$width=0.21;

for($i=0;$i<count($arrPedido);$i++){   
    
    $pdf->SetLineWidth($width); 
    $pdf->Cell(20, 8, substr($arrPedido[$i]->ped_nombre, 0, 10),0);
    $pdf->Cell(20, 8, substr($arrPedido[$i]->ped_fecha, 0, 10),0);
    $pdf->Cell(20, 8, substr($arrPedido[$i]->ped_fecha_entrega, 0, 10),0);
    $pdf->Cell(20, 8, substr($arrPedido[$i]->ped_estado, 0, 10),0);        
    if(count($arrPrenda)>0){                
        for($j=0;$j<count($arrPrenda);$j++){                    
            if($arrPrenda[$j]->pre_id==$arrPedido[$i]->ped_pre_id){
                $pdf->Cell(20, 8, substr($arrPrenda[$j]->pre_nombre, 0, 10),0);
            }
        }
    }
     
    $pdf->Cell(20, 8, $arrPedido[$i]->ped_des_fecha,0); 
    $pdf->Cell(20, 8, $arrPedido[$i]->ped_maq_fecha,0);
    $pdf->Ln(8);
    //$altoDelta+=5;
}

$pdf->SetFont('Arial', 'B', 8);

$pdf->Output();
?>
 

 