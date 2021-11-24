<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$fecha = $_REQUEST['cod']+1; 
if($fecha==1||$fecha==3||$fecha==5||$fecha==7||$fecha==8) $fecha2="2011/0".$fecha."/01";
if($fecha==2) $fecha2="2011/0".$fecha."/01";
if($fecha==4||$fecha==6||$fecha==9) $fecha2="2011/0".$fecha."/01";
if($fecha==10||$fecha==12) $fecha2="2011/".$fecha."/01";
if($fecha==11) $fecha2="2011/".$fecha."/01";
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
//$sql14 = "update recaudo_tnat set cuenta ='$cuenta', nombre ='$nombre'
	$sql = "update vf set fecha_ini = '$fecha2'";
	$res = mysql_db_query($database, $sql, $cx);
	
	$sql2 = "select * from vf";
	$res2 = mysql_db_query($database, $sql2, $cx);
	$row2 = mysql_fetch_array($res2);
	
	
	echo $row2["fecha_ini"];
$cx = null;
?>
