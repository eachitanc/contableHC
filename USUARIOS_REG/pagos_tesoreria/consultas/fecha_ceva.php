<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id = $_REQUEST['cod']; 
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from ceva where id_auto_ceva='$id'";
	$res = mysql_db_query($database, $sql, $cx);
	while ($row = mysql_fetch_array($res))
	{	
		$fecha=$row[fecha_ceva];	
	}
	
	echo $fecha;
$cx = null;
?>
