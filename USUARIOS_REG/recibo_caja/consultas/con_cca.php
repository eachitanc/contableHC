<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
$cuenta = $_REQUEST['cod'];
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar    	
$sql = "select * from cca_ing where cod_pptal='$cuenta'";
$res = $cx->query($sql);
$pgcp1 = $rubro = $pgcp6 = $rubro2 = 0;
//$numf=mysql_num_rows($res);
while ($row = $res->fetch_assoc()) {
	$pgcp1 = isset($row["pgcp1"]) ? $row["pgcp1"] : '';
	$pgcp6 = isset($row["pgcp6"]) ? $row["pgcp6"] : '';

	$sq2 = "select * from pgcp where cod_pptal='$pgcp1'";
	$res2 = $cx->query($sq2);
	$rubro = '';
	while ($row2 = ($res2->fetch_assoc())) {
		$rubro = $row2["nom_rubro"];
	}

	$sq3 = "select * from pgcp where cod_pptal='$pgcp6'";
	$res3 = $cx->query($sq3);
	$rubro2 = '';
	while ($row3 = $res3->fetch_assoc()) {
		$rubro2 = $row3["nom_rubro"];
	}
}
echo $pgcp1 . ',' . $rubro . ',', $pgcp6 . ',' . $rubro2;
