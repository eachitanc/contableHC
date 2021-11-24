<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$rubro = $_REQUEST['cod'];
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	if ($rubro !='')
	{
		$sql = "select * from car_ppto_ing where cod_pptal ='$rubro'";
		$res = mysql_db_query($database, $sql, $cx);
		$row = mysql_fetch_array($res);
		$tipo = $row["tip_dato"];
		$inicial = $row["ppto_aprob"];
		$aprobado = $row["ppto_aprob"];
		// Calculo del presupuesto defiitivo
		$sq2 = mysql_db_query($database,"select sum(valor_adi) as adicion from adi_ppto_ing where cod_pptal ='$rubro'",$cx);
		$rw2 = mysql_fetch_array($sq2);
		$sq3 = mysql_db_query($database,"select sum(valor_adi) as reduccion from red_ppto_ing where cod_pptal ='$rubro'",$cx);
		$rw3 = mysql_fetch_array($sq3);
		$def = $inicial + $rw2["adicion"] - $rw3["reduccion"];		
		echo $tipo.",".$inicial.",".$def;
	}
$cx = null;
?>

