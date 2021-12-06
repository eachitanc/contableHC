<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id =$_REQUEST['id'];  
$cta = $_REQUEST['cta'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from cecp_cuenta  where id_auto_cecp='$id' and cuenta='$cta'";
	$res = $cx->query($sql);
	while ($row = $res->fetch_assoc())
	{	
			$valor=$row['valor'];
			
					
	}
	echo $valor;
	//echo $dato.'/'.$dato.'/'.$dato.'/'.$cont.'/'.$cont;
	//echo $id2;
$cx = null;
?>
