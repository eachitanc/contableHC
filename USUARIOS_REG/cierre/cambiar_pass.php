<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$pass = $_REQUEST['cod']; 

include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
//$sql14 = "update recaudo_tnat set cuenta ='$cuenta', nombre ='$nombre'
	$sql = "update vf set password = '$pass'";
	$res = mysql_db_query($database, $sql, $cx);
	
	$sql2 = "select * from vf";
	$res2 = mysql_db_query($database, $sql2, $cx);
	$row2 = mysql_fetch_array($res2);
	
	
	echo $row2["password"];
$cx = null;
?>
