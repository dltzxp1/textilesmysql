<?php
require ("fpdf17/fpdf.php");

$pdf=new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','',10);

$pdf->Cell(0,10,'hola',1,1);


$pdf->Output();

?>
