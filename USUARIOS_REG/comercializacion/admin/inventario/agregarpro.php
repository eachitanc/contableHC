<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

// recibo variables del formulario
		$bodega = $_GET["bodega"];
		$tipo_art = $_GET["tipo_art"];
		$fecha = $_GET["fecha"]; 
		$factura = $_GET["factura"]; 
		$codigo = $_GET["codigo"];
		$barras = $_GET["barras"];
		$lote = $_GET["lote"];
		$fecha_ven = $_GET["fecha_ven"];
		$cant = $_GET["cant"];
		$valor = $_GET["valor"];
		$producto = $_GET["producto"];
		$precio1 = $_GET["precio1"];
		$precio2 = $_GET["precio2"];
		$invima = $_GET["invima"];
		// verifico si el documento ya existe
		$sq2 ="select * from farm_listado where cod_int ='$codigo' and tipo ='$tipo_art'";
		$re2 =mysql_query($sq2,$cx);
		$fi2 =mysql_num_rows($re2);
		$sq3="select max(id) as id from farm_kardex where cod_int ='$codigo' and tipo_art ='$tipo_art'";
		$re3 =mysql_query($sq3,$cx);
		$rw3 =mysql_fetch_array($re3);
		$sq5="select saldo,unitario,total from farm_kardex where id = '$rw3[id]'";
		$re5 =mysql_query($sq5,$cx);
		$rw5 =mysql_fetch_array($re5);
		$saldo = $rw5['saldo']+ $cant;
		$ingresa = ($cant * $valor) + $rw5['total'];
		$unitario = $ingresa / $saldo;
		$total = $unitario * $saldo;
		if ($fi2 <1)
		{
			// Inserta articulo en listado de articulos
		$sql4 ="insert into farm_listado (tipo,fecha_alta,cod_int,nombre,cum,unidad,promedio,precio1,precio2,precio3,activo,user) values('$tipo_art','$fecha','$codigo','$producto','','',0,'$precio1','$precio2',0,'SI','$_SESSION[user]')";
		$re14 = mysql_query($sql4);	
		}
		$sql4 ="insert into farm_kardex (tipo_mov,fecha,tipo_art,bodega,doc_ref,doc_num,cod_barras,cod_int,entrada,salida,fecha_ven,lote,invima,valor,user,ter,pedido,saldo,unitario,total) values('INI','$fecha','$tipo_art','$bodega','1','$factura','$barras','$codigo','$cant',0,'$fecha_ven','$lote','$invima','$valor','$_SESSION[user]','','','$saldo','$unitario','$total')";
		$re14 = mysql_query($sql4);	
		
			// Edita articulo
		$sq3 = "update farm_pedido set where id = '$datos[1]'";
		//$re3 = mysql_query($sq3);
			/*if (!$re3) {
					die('Invalid query: ' . mysql_error());
					echo "<script>alert('El registro no fue guardado..');</script>";
			}*/
// Archivo a mostar desùes de guardar
		echo "<script>	cargaArchivo('admin/inventario/reporte.php?factura=$factura&bodega=$bodega&articulo=$tipo_art','reporte');</script>	";	
?>
