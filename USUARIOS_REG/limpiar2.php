<?php 
include('config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$tabla = $_POST['tabla'];
$campo = $_POST['campo'];
$texto = $_POST['texto'];
$remp = $_POST['remp'];

	$sq6 = "UPDATE $tabla SET
$campo = REPLACE($campo, '$texto', '$remp');"; 
	echo "<br> $sq6";
	mysql_query($sq6, $connectionxx) or die(mysql_error());
 
?>
