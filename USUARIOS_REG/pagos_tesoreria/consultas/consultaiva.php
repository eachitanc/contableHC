<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$reten = $_REQUEST['cod']; 
$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from reteiva where concepto='$reten' order by a_partir asc";
	$res = $cx->query($sql);
	while ($row = $res->fetch_assoc())
	{	
		if($valor>=$row[a_partir])
			
		$valoret=$row[tarifa];
	}
	$valort=$valoret*$valor;
	echo $valort;
$cx = null;
?>
