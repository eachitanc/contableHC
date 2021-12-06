<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cheque = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$cont = 0;
    for ($i=1; $i < 16;$i++)
	{	
		$campo = 'num_cheque'.$i;
		if ($i == 1) $campo ='num_cheque' ;
		$sql = "select * from ceva where $campo ='$cheque'";
		$res = $cx->query($sql);
		$filas = $res->num_rows;
		if ($filas > 0) $cont++;
	}
	//$valort=$valoret*$valor;
	echo $cont;
	//echo $numf;
	//echo $reten;
$cx = null;
?>
