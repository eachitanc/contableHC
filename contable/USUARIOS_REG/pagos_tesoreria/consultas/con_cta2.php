<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id =$_REQUEST['id'];  
$cta = $_REQUEST['cta'];
include('../../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from cecp_cuenta  where id_auto_cecp='$id' and cuenta='$cta'";
	$res = mysql_db_query($database, $sql, $cx);
	while ($row = mysql_fetch_array($res))
	{	
			$valor=$row['valor'];
			
					
	}
	echo $valor;
	//echo $dato.'/'.$dato.'/'.$dato.'/'.$cont.'/'.$cont;
	//echo $id2;
mysql_close($cx);
?>