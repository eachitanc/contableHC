<?php
include('../config.php');
$q = $_GET["q"];
if (!$q) return;
$conn = new mysqli($server, $dbuser, $dbpass, $database);

$sql = "select cod_pptal as cod_pptal, nom_rubro  as nom_rubro from car_ppto_ing where cod_pptal LIKE '$q%'";
$rsd = $conn->query($sql) or die(mysqli_error($conn));
$fil = $rsd->fetch_assoc();
if (empty($fil)) {
	$cid = '';
	$cname = 'Sin resultados...';
	echo "$cname|$cid\n";
} else {
	while ($rs = $rsd->fetch_assoc()) {
		$cid = $rs['cod_pptal'];
		$cname = $rs['cod_pptal'] . " - " . $rs['nom_rubro'];
		echo "$cname|$cid\n";
	}
}
