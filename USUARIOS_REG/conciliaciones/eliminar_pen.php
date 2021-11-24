<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
// recibo variables del formulario
$cuenta = $_GET['cuenta'];
$dcto = $_GET['dcto'];
$fecha = $_GET['fecha'];
$fecha_fin = $_GET['fecha_fin'];
// Realizo la conexion con la base de datos
include ('../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

if (!$cx) {
    die('No pudo conectarse: ' . mysql_error());
}
	$sql = "Delete from aux_conciliaciones_vig_ant where fecha ='$fecha' and cuenta ='$cuenta' and dcto = '$dcto'";
	$res = mysql_query($sql);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
// Regreso al reporte de usuarios cargados en el sistema
			echo "<script>
					cargaArchivo('conciliaciones3.php?fecha_fin=$fecha_fin&cuenta=$cuenta','conten','0');
			     </script>";	
?>
