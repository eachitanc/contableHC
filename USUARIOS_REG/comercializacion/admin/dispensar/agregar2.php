<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

// recibo variables del formulario
		$id = $_GET["id"];
		$tipo = $_GET["tipo"];
		$cant = $_GET["cant"];
		$fecha = $_GET["fecha"];
		$factura = $_GET["factura"];
		$cod_int = $_GET["cod_int"];
		// verifico si el documento ya existe
		$sq = "select * from farm_kardex where lote = '$id' and cod_int ='$cod_int'";
		$rs = mysql_query($sq);
		$fi = mysql_num_rows($rs);
		$rw = mysql_fetch_array($rs);
		$sql3 ="insert into farm_kardex (tipo_mov,fecha,tipo_art,bodega,doc_ref,doc_num,cod_barras,cod_int,entrada,salida,fecha_ven,lote,invima,valor,user) values('DIS','$fecha','$rw[tipo_art]','$rw[bodega]','2','$factura','$rw[cod_barras]','$rw[cod_int]',0,$cant,'$rw[fecha_ven]','$rw[lote]','$rw[invima]','valor','user')";
			$re2 = mysql_query($sql3);
			if (!$re2) {
				die('Error al guardar el registro: $sql3' . mysql_error());
				echo "<script>alert('El registro no fue guardado..');</script>";
			}
// Archivo a mostar desùes de guardar
			 echo "<script>	cargaArchivo('admin/vacio.php','reporte');</script>";
			 echo "<script>	cargaArchivo('admin/dispensar/reporte_fac.php?fecha=$fecha&factura=$factura','facturas');</script>";	
$cx = null;
?>