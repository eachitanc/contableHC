<?php
include ('../../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$documento = $_POST['doc'];
$tipo = $_POST['tipo'];
$sql3 = "SELECT * FROM usuarios WHERE usuario = '$documento'";
$rs3 = mysql_query($sql3);
$fil3 = mysql_num_rows($rs3);
echo $fil3;
?>
