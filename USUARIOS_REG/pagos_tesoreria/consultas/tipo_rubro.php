<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cod = $_REQUEST['cod']; 
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select tip_dato from cxp where cod_pptal = '$cod'";
	$res = mysql_db_query($database, $sql, $cx);
	while ($row = mysql_fetch_array($res))
	{
	$tipo =$row['tip_dato']; echo $tipo;
	}
$cx = null;
?>
