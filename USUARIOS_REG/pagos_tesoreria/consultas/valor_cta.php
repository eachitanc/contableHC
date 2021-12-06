<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cod = $_REQUEST['cod']; 
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select sum(vr_digitado) from cobp where id_auto_cobp = '$cod'";
	$res = $cx->query($sql);
	while ($row = $res->fetch_assoc())
	{
	$valor =$row['sum(vr_digitado)']; echo $valor;
	}
$cx = null;
?>
