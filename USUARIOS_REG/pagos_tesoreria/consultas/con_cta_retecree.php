<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$reten = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select cuenta from retecree where concepto='$reten'";
	$res = mysql_db_query($database, $sql, $cx);
	while ($row = mysql_fetch_array($res))
	{	
		//if($valor>=$row[base]&&($valor<=$row[tope]||$row[tope]==''))
			
		$valoret=$row['cuenta'];
	}
	//$valort=$valoret*$valor;
	echo $valoret;
	
$cx = null;
?>