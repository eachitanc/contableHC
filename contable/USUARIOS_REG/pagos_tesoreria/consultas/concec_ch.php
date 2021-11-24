<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cheque = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$cont = 0;
    for ($i=1; $i < 16;$i++)
	{	
		$campo = 'num_cheque'.$i;
		if ($i == 1) $campo ='num_cheque' ;
		$sql = "select * from ceva where $campo ='$cheque'";
		$res = mysql_db_query($database, $sql, $cx);
		$filas = mysql_num_rows($res);
		if ($filas > 0) $cont++;
	}
	//$valort=$valoret*$valor;
	echo $cont;
	//echo $numf;
	//echo $reten;
mysql_close($cx);
?>
