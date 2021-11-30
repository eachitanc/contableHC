<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
	$codigo_pptal =$_REQUEST['cod'];
	$fecha_corte =$_REQUEST['fecha'];
	include('../../../config.php');		
	$cx = $cx->query($sq)or die ("Conexion no Exitosa");
	 
	$val = mysql_query("select sum(valor) as comp from reip_ing where cuenta ='$codigo_pptal'", $cx);
	while ($row = mysql_fetch_array($val))
	{ 
	$ppto_comp = $row["comp"];
	}
	$val2 = mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE cuenta ='$codigo_pptal'", $cx);
	while ($row2 = mysql_fetch_array($val2))
	{ 
	$ppto_comp2 = $row2["TOTAL"];
	}
	$val3 = mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE cuenta ='$codigo_pptal'", $cx);
	while ($row3 = mysql_fetch_array($val3))
	{ 
	$ppto_comp3 = $row3["TOTAL"];
	}
	$val4 = mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE cuenta ='$codigo_pptal'", $cx);
	while ($row4 = mysql_fetch_array($val4))
	{ 
	$ppto_comp4 = $row4["TOTAL"];
	}
		
	
$comporometido = $ppto_comp + $ppto_comp2+$ppto_comp3+$ppto_comp4;
echo "$comporometido";
?>
