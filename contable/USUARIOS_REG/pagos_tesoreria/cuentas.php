<?php
include('../config.php');
$q = $_GET["q"];
if (!$q) return;
$conn = mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($database);
$sql = "select cod_pptal as cod_pptal, nom_rubro  as nom_rubro from cxp where cod_pptal LIKE '$q%'";
$rsd = mysql_query($sql);
$fil = mysql_num_rows($rsd);
while($rs = mysql_fetch_array($rsd)) {
	$cid = $rs['cod_pptal'];
	$cname = $rs['cod_pptal'] ." - ". $rs['nom_rubro'];
	echo "$cname|$cid\n";
}
if ($fil==0){
	$cid = '';
	$cname = 'Sin resultados...';
	echo "$cname|$cid\n";
}
?>