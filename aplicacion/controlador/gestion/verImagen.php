<?php

require_once("../../modelo/dao/prenda.php");
$pre_id = $_GET['pre_id'];

$ObjPrenda = new prenda('0');
$query = "SELECT * FROM prenda where pre_id=$pre_id";
$ObjPrenda->obtenerPagin($query);
//header("Content-type: image/pjpeg");
header("Content-type:. $ObjPrenda->fo_tipo");
echo $ObjPrenda->fo_imagen;


/* $ca_id = $_GET['ca_id'];
  $pr_id = $_GET['pr_id'];
  $fo_id = $_GET['fo_id'];


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

