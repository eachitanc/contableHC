<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$reten = $_REQUEST['cod']; 
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from dctos_deduc_cecp where concepto='$reten'";
	$res = $cx->query($sql);
	while ($row = $res->fetch_assoc())
	{	
			$valoret=$row[contab];	
		
	}
	echo $valoret;
$cx = null;
?>
