<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$reten = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select fecha_fin from vf ";
	$res = mysql_db_query($database, $sql, $cx);
	while ($row = mysql_fetch_array($res))
	{	
		$valor=$row[fecha_fin];
			
		
	}
	
	echo $valor;
$cx = null;
?>
