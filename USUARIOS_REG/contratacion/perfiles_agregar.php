<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
// recibo variables del formulario
$cargo = $_POST['cargo']; 
$fecha = $_POST['fecha_ini'];
$des = $_POST['des'];
// Realizo la conexion con la base de datos
include ('../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

if (!$cx) {
    die('No pudo conectarse: ' . mysql_error());
}
// insertar nuevo registro
	$sq2 = "insert into perfiles (fecha,cargo,funciones) values ('$fecha','$cargo','$des')";
	$re2 = mysql_query($sq2);
	if (!$re2) {
		die('Invalid query: ' . mysql_error());
		echo "<script>alert('El registro no fue guardado exitosamente...');</script>";
	}
include ('perfiles_reporte.php');
?>