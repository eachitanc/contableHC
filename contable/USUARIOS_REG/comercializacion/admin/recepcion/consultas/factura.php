<?php
include ('../../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$documento = $_POST['doc'];
$tipo = $_POST['tipo'];
$sql3 = "SELECT max(doc_num) as factura FROM farm_kardex WHERE tipo_mov ='REC'";
$rs3 = mysql_query($sql3);
$rw = mysql_fetch_array($rs3);
//echo $sq2;
echo $rw['factura']+1;
?>
