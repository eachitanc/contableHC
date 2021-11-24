<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
// recibo variables del formulario
$tabla ='liquidacion';
$documento = $_GET['doc'];
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

if (!$cx) {
    die('No pudo conectarse: ' . mysql_error());
}
// Consulta de validacion de referencia con otras tablas
$fi =0;
// ejecuto la sentencia para eliminar los registros
if ($fi == 0)
{
	$sql = "Delete from $tabla where id ='$documento'";
	$res = mysql_query($sql);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
	$sq4 = "update despacho set  liquidado ='' where liquidado = '$documento'";
	$re4 = mysql_query($sq4);
}else{
			echo "<script>
					alert('El usuario que intenta eliminar ya tiene registros asociados...';
			     </script>";	

}
// Regreso al reporte de usuarios cargados en el sistema
			echo "<script>
					cargaArchivo('admin/$tabla/reporte.php','reporte');
			     </script>";
?>
