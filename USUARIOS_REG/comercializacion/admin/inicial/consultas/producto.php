<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=latin1'); 
include('../../../config.php');
$q = $_GET["q"];
if (!$q) return;
$conn = new mysqli($server, $dbuser, $dbpass, $database);

//consulto el tipo de producto que esta activo en la tabla tem
$sq = "select producto from farma_temp";
$rs = mysql_query($sq);
$rw = mysql_fetch_array($rs);
$sql = "select id,nombre from farm_med where nombre LIKE '$q%' and tipo ='$rw[producto]'";
$rsd = mysql_query($sql);
$fil = mysql_num_rows($rsd);
while($rs = mysql_fetch_array($rsd)) {
	$cid = $rs['id'];
	$cname = $rs['nombre'];
	echo "$cname|$cid\n";
}
if ($fil==0){
	$cid = '';
	$cname = 'Sin resultados...' ;
	echo "$cname|$cid\n";
}
?>
