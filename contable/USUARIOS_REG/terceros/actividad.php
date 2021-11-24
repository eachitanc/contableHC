<?php
include ('../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$codigo = $_POST['doc'];
$sql3 = "SELECT codigo FROM cree WHERE codigo = '$codigo'";
$rs3 = mysql_query($sql3);
$fil3 = mysql_num_rows($rs3);
echo $fil3;
?>
