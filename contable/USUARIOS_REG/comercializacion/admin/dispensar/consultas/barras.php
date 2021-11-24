<?php
include ('../../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$documento = $_POST['doc'];
$tipo = $_POST['tipo'];
$sql3 = "SELECT * FROM farm_kardex WHERE cod_barras ='$documento'";
$rs3 = mysql_query($sql3);
$rw = mysql_fetch_array($rs3);
$sq2 ="select * from farm_med where id ='$rw[cod_int]'";
$rs2 = mysql_query($sq2);
$rw2 = mysql_fetch_array($rs2);
echo $rw2['nombre'];
//echo $sq2;
?>
