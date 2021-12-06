<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$reten = $_REQUEST['cod']; 
$valor=$_REQUEST['valorsiniva'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from rango where concepto='$reten'";
	$res = $cx->query($sql);
	while ($row = $res->fetch_assoc())
	{	
		if($valor>=$row['base'])
		{
			$vr_reten=$row['tarifa']*$valor;
			$tarifa=$row['tarifa']*100;			
		}
		
	}
	$valort=$vr_reten.'/'.$tarifa;
	echo $valort;
$cx = null;
?>
