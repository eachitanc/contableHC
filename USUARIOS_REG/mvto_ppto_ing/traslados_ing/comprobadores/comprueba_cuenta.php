<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cuenta = $_REQUEST['cod']; 
include('../../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select tip_dato from car_ppto_ing where cod_pptal = '$cuenta'";
	$res = $cx->query($sql);
	while ($row = $res->fetch_assoc())
	{
	$tipo =$row['tip_dato'];
	echo $tipo;
	}
$cx = null;
?>
