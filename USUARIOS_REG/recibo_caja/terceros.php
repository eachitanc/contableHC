<?php
include('../config.php');
header('Content-Type: text/html; charset=latin1'); 
$q = $_GET["q"];
if (!$q) return;
$conn = new mysqli($server, $dbuser, $dbpass, $database);

$sql = "select num_id as num_id, nombre  as nombre from z_terceros where num_id LIKE '$q%' or nombre like '$q%' ";
$rsd = $conn->query($sql) or die(mysqli_error($conn));
$fil = $rsd->fetch_assoc();
if (empty($fil)){
	$cid = '';
	$cname = 'Sin resultados...';
	echo "$cname|$cid\n";
}else{
	while($rs = $rsd->fetch_assoc()) {
		$cid = $rs['num_id'];
		$cname = $rs['num_id'] ." - ". $rs['nombre'];
		echo "$cname|$cid\n";
	}
}
