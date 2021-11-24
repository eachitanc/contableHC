<?php
include('../config.php');
$q = $_GET["q"];
if (!$q) return;
$conn = new mysqli($server, $dbuser, $dbpass, $database);

$sql = "select num_id as num_id, nombre  as nombre from z_terceros where num_id LIKE '$q%' or nombre like '$q%' ";
$rsd = mysql_query($sql);
$fil = mysql_num_rows($rsd);
while($rs = mysql_fetch_array($rsd)) {
	$cid = $rs['num_id'];
	$cname = $rs['num_id'] ." - ". $rs['nombre'];
	echo "$cname|$cid\n";
}
if ($fil==0){
	$cid = '';
	$cname = 'Sin resultados...';
	echo "$cname|$cid\n";
}
?>
