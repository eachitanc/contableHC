<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$ceva = $_REQUEST['cod']; 

include('../../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from aux_conciliaciones2  where dcto ='$ceva' and estado ='SI'";
	$res = mysql_db_query($database, $sql, $cx);
	$fil=mysql_num_rows($res);
	echo $fil;
mysql_close($cx);
?>