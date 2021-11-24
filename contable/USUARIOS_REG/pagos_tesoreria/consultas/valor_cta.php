<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cod = $_REQUEST['cod']; 
include('../../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select sum(vr_digitado) from cobp where id_auto_cobp = '$cod'";
	$res = mysql_db_query($database, $sql, $cx);
	while ($row = mysql_fetch_array($res))
	{
	$valor =$row['sum(vr_digitado)']; echo $valor;
	}
mysql_close($cx);
?>
