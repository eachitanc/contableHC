<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$ceva = $_REQUEST['cod']; 

include('../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from vf";
	$res = mysql_db_query($database, $sql, $cx);
	$row = mysql_fetch_array($res);
	
	
	echo $row["fecha_ini"];
mysql_close($cx);
?>
