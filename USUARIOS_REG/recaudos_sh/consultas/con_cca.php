<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
$cuenta = $_REQUEST['cod'];
//$valor=$_REQUEST['valor'];
include('../../config.php');
$pgcp1 = $pgcp6 = $rubro = $rubro2 = '';
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar    	
$sql = "select * from cca_ing where cod_pptal='$cuenta'";
$res = $cx->query($sql);
//$numf=mysql_num_rows($res);
while ($row = $res->fetch_assoc()) {
	$pgcp1 = $row["pgcp1"];
	$pgcp6 = $row["pgcp6"];

	$sq2 = "select * from pgcp where cod_pptal='$pgcp1'";
	$res2 = $cx->query($sq2);
	while ($row2 = $res2->fetch_assoc()) {
		$rubro = $row2["nom_rubro"];
	}

	$sq3 = "select * from pgcp where cod_pptal='$pgcp6'";
	$res3 = $cx->query($sq3);
	while ($row3 = $res3->fetch_assoc()) {
		$rubro2 = $row3["nom_rubro"];
	}
}
//$valort=$valoret*$valor;
echo $pgcp1 . ',' . $pgcp6 . ',' . $rubro . ',' . $rubro2;
//echo $numf;
//echo $reten;
$cx = null;
