<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
// recibo variables del formulario
$cuenta = $_POST['cuenta'];
$fecha_fin = $_POST['fecha_fin'];
$fecha = $_POST['fecha'];
$dcto = $_POST['dcto'];
$detalle = $_POST['detalle'];
$cheque = $_POST['cheque'];
$debito = $_POST['debito'];
$credito = $_POST['credito'];
// Realizo la conexion con la base de datos
$suma = $debito+$credito;
include ('../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

if (!$cx) {
    die('No pudo conectarse: ' . mysql_error());
}
if ($suma > 0)
{
// insertar nuevo registro
	$sq2 = "insert aux_conciliaciones_vig_ant (fecha,dcto,cuenta,nombre,cheque,tercero,debito,credito,estado)
								 values ('$fecha','$dcto','$cuenta','ND','$cheque','$detalle','$debito','$credito','NO')";
	$re2 = mysql_query($sq2);
	if (!$re2) {
		die('Invalid query: ' . mysql_error());
		echo "<script>alert('El registro no fue guardado..');</script>";
	}
}
// Archivo a mostar desùes de guardar
			echo "<script>
					cargaArchivo('conciliaciones3.php?fecha_fin=$fecha_fin&cuenta=$cuenta','conten','0');
			     </script>";	

//$cx = null;
?>