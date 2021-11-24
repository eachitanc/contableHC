<?php 
include('config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
mysql_select_db($database);
$tabla = $_POST['tabla'];
$campo = $_POST['campo'];
$texto = $_POST['texto'];
$remp = $_POST['remp'];

	$sq6 = "UPDATE $tabla SET
$campo = REPLACE($campo, '$texto', '$remp');"; 
	echo "<br> $sq6";
	mysql_query($sq6, $connectionxx) or die(mysql_error());
 
?>
