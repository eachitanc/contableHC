<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$pgcp = $_REQUEST['cod']; 
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select tip_dato from pgcp where cod_pptal = '$pgcp'";
	$res = $cx->query($sql);
	while ($row = $res->fetch_assoc())
	{
	$tipo =$row['tip_dato']; echo $tipo;
	}
$cx = null;
?>
