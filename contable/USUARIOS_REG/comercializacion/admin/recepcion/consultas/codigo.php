<?php
include ('../../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$documento = $_POST['doc'];
$tipo = $_POST['tipo'];
$sql3 = "SELECT cod_int FROM farm_kardex WHERE cod_barras ='$documento'";
$rs3 = mysql_query($sql3);
$rw = mysql_fetch_array($rs3);
//echo $sq2;
echo $rw['cod_int'];
?>
