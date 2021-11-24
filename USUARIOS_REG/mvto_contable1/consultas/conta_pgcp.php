<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cuenta = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo la cuenta y el nombre del rubro    	
		$sql = "select cod_pptal from pgcp where cod_pptal = '$cuenta' and tip_dato='D' and bloqueo != 'SI'";
		$res = mysql_db_query($database, $sql, $cx);
		$numf=mysql_num_rows($res);
		if ($numf >0)
			echo 1;
		else
			echo '';
$cx = null;
?>
