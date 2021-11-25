<?php
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	$codigo_evento =$_GET['cod'];
	include('../../config.php');		
	$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
	 
	$val = mysql_query("select * from contrataciones2 where num_contrato ='$codigo_evento'", $cx);
	$num = mysql_num_rows($val);
	if ($num<2)
	{
	printf("");
	}
	else
	{
printf("<font color ='#FF0000'>Ya utilizado</font>");
	}
	$cx = null;
?>
