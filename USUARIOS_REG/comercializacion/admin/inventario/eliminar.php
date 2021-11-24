<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
// recibo variables del formulario
$tabla ='inventario';
$documento = $_GET['doc'];
$bodega = $_GET['bodega'];
$art = $_GET['art'];
$id = $_GET['id'];
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

if (!$cx) {
    die('No pudo conectarse: ' . mysql_error());
}
// Consulta de validacion de referencia con otras tablas
$sql ="select * from farm_kardex where cod_int ='$documento'";
$res=mysql_query($sql,$cx);
$fi =mysql_num_rows($res);
// ejecuto la sentencia para eliminar los registros
if ($fi > 0)
{
	$sql = "Delete from farm_kardex where cod_int ='$documento' and id ='$id'";
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
					cargaArchivo('admin/inventario/reporte.php?bodega=$bodega&articulo=$art','reporte2');
			     </script>"; 
?>
