<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
// recibo variables del formulario
$tabla ='modulos';
$anno = $_GET["anno"];
$documento = $_GET['doc'];
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

if (!$cx) {
    die('No pudo conectarse: ' . mysql_error());
}
// Consulta de validacion de referencia con otras tablas
$sq = "select * from actividades where id  = '$documento'";
$rs = mysql_query($sq);
$rw = mysql_fetch_array($rs);
$fi = mysql_num_rows($rs);
$fi =0;
// ejecuto la sentencia para eliminar los registros
if ($fi == 0)
{
	$sql = "Delete from $tabla where id ='$documento'";
	$res = mysql_query($sql);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
}else{
			echo "<script>
					alert('El usuario que intenta eliminar ya tiene registros asociados...';
			     </script>";	

}
// Regreso al reporte de usuarios cargados en el sistema
			echo "<script>
					cargaArchivo('admin/$tabla/reporte_mod.php?anno=$anno','columna1');
			     </script>";
?>
