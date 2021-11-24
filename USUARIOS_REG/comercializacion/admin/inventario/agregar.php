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
		$sq2 ="select * from farm_listado where cod_int ='$cod'";
		$re2 =mysql_query($sq2,$cx);
		$fi2 =mysql_num_rows($re2);
		if ($fi2 <1)
		{
			// Inserta articulo en listado
		$sql3 ="insert into farm_listado (fecha_alta,tipo,cod_int,nombre,unidad,activo,user) values('$fecha','$tip_art','$cod','$nombre','$unidad ','SI','$_SESSION[user]')";
		$re2 = mysql_query($sql3);
			
		$sql4 ="insert into farm_kardex (tipo_mov,fecha,tipo_art,bodega,doc_ref,doc_num,cod_barras,cod_int,entrada,fecha_ven,lote,invima,valor,user) values('INI','$fecha','$tip_art','$bodega','1','20160001','$barras','$cod','$cant','$fechaven','$lote','$invima','$valor','$_SESSION[user]')";
		$re14 = mysql_query($sql4);	
		}else{
			// Edita articulo
		$sq3 = "update $tabla set $ediar where id = '$datos[1]'";
		//$re3 = mysql_query($sq3);
			/*if (!$re3) {
					die('Invalid query: ' . mysql_error());
					echo "<script>alert('El registro no fue guardado..');</script>";
			}*/
		}
// Archivo a mostar desùes de guardar
		echo "<script>	cargaArchivo('admin/inventario/reporte.php?bodega=$bodega&articulo=$tip_art','reporte2');</script>	";	
?>
