<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

// recibo variables del formulario
		$id = $_GET["id"];
		// verifico si el documento ya existe
		$sq = "select * from recepcion where fecha = '$fecha' and jornada ='$jornada' and ccnit ='$ccnit' and cliente ='$cliente'";
		$rs = mysql_query($sq);
		$fi = mysql_num_rows($rs);
		if ($fi == 0)
		{
			$sql3 ="insert into recepcion (fecha,jornada,ccnit,cant,cliente) values('$fecha','$jornada','$ccnit','$cant','$cliente')";
			$re2 = mysql_query($sql3);
			if (!$re2) {
				die('Invalid query: ' . mysql_error());
				echo "<script>alert('El registro no fue guardado..');</script>";
			}
		}else{
			$sq3 = "update recepcion set fecha='$fecha',jornada='$jornada',ccnit='$ccnit',cant='$cant',cliente='$cliente' where fecha = '$fecha' and jornada ='$jornada' and ccnit ='$ccnit' and cliente ='$cliente'";
			$re3 = mysql_query($sq3);
			if (!$re3) {
				die('Invalid query: ' . mysql_error());
				echo "<script>alert('El registro no fue guardado..');</script>";
				}
		}
// Archivo a mostar desùes de guardar
			 echo "<script>	cargaArchivo('admin/recepcion/reporte.php?fecha=$fecha&cliente=$cliente','reporte');</script>";	
$cx = null;
?>