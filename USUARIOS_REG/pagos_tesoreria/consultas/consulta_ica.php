<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$reten = $_REQUEST['cod']; 
$valor= $_REQUEST['valorsiniva']; 
$iva= $_REQUEST['valoriva']; 

include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from rango where concepto='$reten'";
	$res = $cx->query($sql);
	while ($row = $res->fetch_assoc())
	{	
		
		if($valor>=$row[base]&&($valor<=$row[tope]||$row[tope]==''))
		{			
			$valoret=$row[tarifa];
			
		}
	}
	$tarifa=$valoret/10;
	$valort=$tarifa*$valor;
	$tarifa2 = $tarifa*1000;
	echo $valort.'/'.$tarifa2;
	
$cx = null;
?>
