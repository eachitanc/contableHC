<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$pgcp = $_REQUEST['cod']; 
include('../../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select tip_dato from pgcp where cod_pptal = '$pgcp'";
	$res = mysql_db_query($database, $sql, $cx);
	while ($row = mysql_fetch_array($res))
	{
	$tipo =$row['tip_dato']; echo $tipo;
	}
mysql_close($cx);
?>
