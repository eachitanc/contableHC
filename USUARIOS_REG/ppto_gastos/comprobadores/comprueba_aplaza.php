<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
	$codigo_pptal =$_REQUEST['cod'];
	$fecha_corte =$_REQUEST['fecha'];
	include('../../config.php');		
	$cx = $cx->query($sq)or die ("Conexion no Exitosa");
	 

	$val2 = mysql_query("select sum(valor_aplazado) as aplazodo from aplazamientos where cod_pptal ='$codigo_pptal' and fecha_adi <='$fecha_corte'", $cx);
	while ($row2 = mysql_fetch_array($val2))
	{ 
	$ppto_aplaza = $row2["aplazodo"];
	}

echo "$ppto_aplaza";
?>
