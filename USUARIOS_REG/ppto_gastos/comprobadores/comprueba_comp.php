<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
	$codigo_pptal =$_REQUEST['cod'];
	$fecha_corte =$_REQUEST['fecha'];
	include('../../config.php');		
	$cx = $cx->query($sq)or die ("Conexion no Exitosa");
	 
	$val = mysql_query("select sum(valor) as comp from cdpp where cuenta ='$codigo_pptal'", $cx);
	while ($row = mysql_fetch_array($val))
	{ 
	$ppto_comp = $row["comp"];
	}
	$val2 = mysql_query("select sum(valor_aplazado) as aplazodo from aplazamientos where cod_pptal ='$codigo_pptal' and fecha_adi <='$fecha_corte'", $cx);
	while ($row2 = mysql_fetch_array($val2))
	{ 
	$ppto_aplaza = $row2["aplazodo"];
	}
$comporometido = $ppto_comp + $ppto_aplaza;
echo "$comporometido";
?>
