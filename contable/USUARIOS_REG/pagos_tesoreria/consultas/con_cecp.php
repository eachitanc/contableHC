<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cuenta = $_REQUEST['cod']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	
    	
		$sql = "select * from cca_cxp where cod_pptal='$cuenta'";
		$res = mysql_db_query($database, $sql, $cx);
		//$numf=mysql_num_rows($res);
		while ($row = mysql_fetch_array($res))
		{
			$ncuenta=$row['pgcp1'];
			$nombre=$row['nom_rubro'];
		}

		
	//$valort=$valoret*$valor;
	echo $ncuenta.','.$nombre;
	//echo $numf;
	//echo $reten;
mysql_close($cx);
?>
