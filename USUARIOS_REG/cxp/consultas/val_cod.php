<?php
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	$cod =$_POST['cod'];
	// conexion con la base de datos
	include('../../config.php');		
	$cx = mysql_connect($server,$dbuser,$dbpass)or die ("Conexion no Exitosa");
	// Ejecutar consulta
	$sql = mysql_db_query($database,"select cod_pptal,tip_dato from cxp where cod_pptal ='$cod'", $cx);
	$res = mysql_fetch_array($sql);
	$tipo =$res["tip_dato"];
	$row = mysql_num_rows($sql);
	if ($row > 0 )
	{
		echo "SI".",".$tipo;
	}else{
		echo "NO";
	}
	$cx = null;
?>
