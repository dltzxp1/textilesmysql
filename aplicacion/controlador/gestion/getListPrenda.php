<?php

require_once("../../modelo/dao/prendatela.php");

$pre_id = $_REQUEST['pre_id']; 
$objPrendaTela = new prendatela('0');
$arrPrendaTela = $objPrendaTela->arregloPrendaTela;
//echo count($arrPrendaTela);
$arreglo = array();

for ($i = 0; $i < count($arrPrendaTela); $i++) {
    if($arrPrendaTela[$i]->pt_pre_id==$pre_id){
        $arreglo[$i]= $arrPrendaTela[$i]->pt_tel_id;
        //$arreglo[$i][1] = $arrPrendaTela[$i]->pt_tel_id;
    }    
}
echo json_encode($arreglo);
?>
