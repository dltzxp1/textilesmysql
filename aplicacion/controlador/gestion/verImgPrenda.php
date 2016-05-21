<?php

require_once("../../modelo/dao/prenda.php");
//$pre_id = $_GET['pre_id'];
$pre_id = 93;

$ObjPrenda = new prenda('0');
$query = "SELECT * FROM prenda where pre_id=$pre_id";
$ObjPrenda->obtenerPagin($query);
//echo "OK:".$ObjPrenda->pre_img_type;
//echo "<td><img style='width:200px;height:200px;' src='images/../../../../../../../a.jpg' /></td>";
 
 
//$url='images/../../../../../../../';

$url2="'"."images/../../../../../../../".$ObjPrenda->pre_nombre.$ObjPrenda->pre_img_name."'";
 
//exit;
header("Content-Type: $ObjPrenda->pre_img_size"); 
readfile($url2);

//echo $ObjPrenda->pre_imagen;
/*
echo "<a title = 'Eliminar Prenda " . $arrPrenda[$r]->pre_nombre . "' href = 'javascript:delPrenda(3,\"" . $arrPrenda[$r]->pre_id . "\");'> <img style='width:16px;height:16px;border:0;' src='../../img/eliminar.png' /></a>";
/* $ca_id = $_GET['ca_id'];
  $pr_id = $_GET['pr_id'];
  $fo_id = $_GET['fo_id'];

$ruta='D:\AppServ\TemPoral\\'.$image; 
//le informamos al navegador el tipo de documento
header("Content-Type: image/jpeg"); 
// leemos el archivo
readfile($ruta);
}
  $link = mysql_connect("localhost", "root", "");
  mysql_select_db("mayainka", $link);
  //$result = mysql_query("SELECT * FROM foto WHERE ca_id=$ca_id AND pr_id=$pr_id AND fo_id=$fo_id", $link);
  $result = mysql_query("SELECT * FROM foto WHERE ca_id=1 AND pr_id=3 AND fo_id=8", $link);
  $row = mysql_fetch_array($result);
  //$row= mysql_fetch_assoc($result);
  ob_clean();

  header('Content-type:' . $row['fo_tipo']);
  //header ("Content-type: image/jpeg; image/gif; image/png");
  print $var =$row["fo_imagen"];
 */
?>

