<?php
header('Content-Type: text/html; charset=latin1'); 
include('../../config.php');
$q = $_GET["q"];
if (!$q) return;
$conn = mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($database);
$sql = "select raz_soc as raz_soc from empresa where raz_soc LIKE '$q%'  ";
$rsd = mysql_query($sql);
$fil = mysql_num_rows($rsd);
while($rs = mysql_fetch_array($rsd)) {
	$cid = $rs['raz_soc'];
	$cname = $rs['raz_soc'];
	echo "$cname|$cid\n";
}
if ($fil==0){
	$cid = '';
	$cname = 'Sin resultados...';
	echo "$cname|$cid\n";
}
?>
