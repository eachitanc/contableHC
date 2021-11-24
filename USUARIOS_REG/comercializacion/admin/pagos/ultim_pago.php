<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cliente = $_REQUEST['doc']; 
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo la cuenta y el nombre del rubro    	
		$sql = "select max(fecha_fin) as fecha from lib_aux4 where cliente ='$cliente'";
		$res = mysql_db_query($database, $sql, $cx);
		//$numf=mysql_num_rows($res);
		while ($row = mysql_fetch_array($res))
		{			
		     $cuenta =$row["fecha"];
		}		
	echo $cuenta;
	//echo $sql;
$cx = null;
?>
