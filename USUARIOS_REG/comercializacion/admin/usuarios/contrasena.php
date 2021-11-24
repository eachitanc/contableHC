<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
// recibo variables del formulario
$documento = $_GET['doc'];
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

if (!$cx) {
    die('No pudo conectarse: ' . mysql_error());
}
// Realizao la actualizacion de la contraseña pasandola al documeto de identidad
	$pass = md5($documento);
	$sq3 = "update usuarios set password = '$pass' where usuario ='$documento'";
	$res = mysql_query($sq3);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
	echo "<script>
			alert('Cambio de contraseña realizado con exito...');
	      </script>";	

// Regreso al reporte de usuarios cargados en el sistema
			echo "<script>
					cargaArchivo('admin/usuarios/reporte.php','contenido');
			     </script>";	
?>
