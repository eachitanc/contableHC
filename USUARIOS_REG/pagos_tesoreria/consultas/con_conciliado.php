<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$ceva = $_REQUEST['cod']; 

include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from aux_conciliaciones2  where dcto ='$ceva' and estado ='SI'";
	$res = $cx->query($sql);
	$fil=$res->num_rows;
	echo $fil;
$cx = null;
?>
