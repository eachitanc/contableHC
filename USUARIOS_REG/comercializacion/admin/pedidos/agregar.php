<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

// recibo variables del formulario
		$id = $_POST["id"];
		$fecha = $_POST["fecha"]; 
		$bodega = $_POST["bodega"]; 
		$tip_art = $_POST["tip_art"]; 
		$cod = $_POST["cod"]; 
		$barras = $_POST["barras"];
		$nombre = $_POST["nombre"];
		$unidad = $_POST["unidad"];
		$cant = $_POST["cant"];
		$fechaven = $_POST["fechaven"];
		$invima = $_POST["invima"];
		$lote = $_POST["lote"];
		$promedio = $_POST["promedio"];
		$valor = $_POST["valor"];
		// verifico si el documento ya existe
			
		$sql4 ="insert into farm_kardex (tipo_mov,fecha,tipo_art,bodega,doc_ref,doc_num,cod_barras,cod_int,entrada,fecha_ven,lote,invima,valor,user) values('REC','$fecha','$tip_art','$bodega','3','20160001','$barras','$cod','$cant','$fechaven','$lote','$invima','$valor','$_SESSION[user]')";
		$re14 = mysql_query($sql4);	
// Archivo a mostar desùes de guardar
		echo "<script>	cargaArchivo('admin/recepcion2/reporte.php?bodega=$bodega&articulo=$tip_art','reporte');</script>	";	
?>
