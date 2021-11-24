<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
// recibo variables del formulario
$tabla ='inventario';
$documento = $_GET['id'];
// Realizo la conexion con la base de datos
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

if (!$cx) {
    die('No pudo conectarse: ' . mysql_error());
}
	//Verificar si la forma esta utilizada en la base de datos
	$sq2 ="select presentacion from farm_med where presentacion ='$documento'";
	$re2 =mysql_query($sq2);
	$fi2 =mysql_num_rows($re2);
	// Borrar el registro
	if($fi2 ==0)
	{	
		$sql = "Delete from farm_forma where id ='$documento'";
		$res = mysql_query($sql);
	}else{
		echo "<script>
					alert('La forma seleccionada ya ha sido utilizada');
			     </script>";
	}
// Regreso al reporte de usuarios cargados en el sistema
			
			echo "<script>
					cargaArchivo('admin/inicial/forma_repor.php?factura=$documento','repor3');
			     </script>"; 
?>
