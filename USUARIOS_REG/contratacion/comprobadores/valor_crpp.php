<?php
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	$codigo_crpp =$_GET['cod'];
	
	include('USUARIOS_REG/config.php');		
	$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
	 
	
	$valor_crpp = mysql_query("select sum(vr_digitado) as valor  from crpp where id_manu_crpp ='CRPP1001'", $cx);
	while ($row = mysql_fetch_array($valor_crpp))
	{ 
	$valor_crpp = $row["valor"];
	print ("Este es el valor : $valor _crpp");
	}
?>