<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
// recibo variables del formulario
$tabla ='inventario';
$documento = $_GET['doc'];
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

if (!$cx) {
    die('No pudo conectarse: ' . mysql_error());
}
	$sql = "Delete from farm_pedido where cod_int ='$documento' and estado =''";
	$res = mysql_query($sql);
// Regreso al reporte de usuarios cargados en el sistema
			
			echo "<script>
					cargaArchivo('admin/pedidos/reporte.php?bodega=$bodega&articulo=$art','mjs');
			     </script>"; 
?>
