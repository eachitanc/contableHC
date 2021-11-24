<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

// recibo variables del formulario
		$concec = $_GET["doc"];
		
			// Edita articulo
		$sq3 = "update farm_pedido set estado ='D' where pedido = '$concec'";
		$re3 = mysql_query($sq3);
			/*if (!$re3) {
					die('Invalid query: ' . mysql_error());
					echo "<script>alert('El registro no fue guardado..');</script>";
			}*/
		
// Archivo a mostar desùes de guardar
		echo "<a href='admin/pedidos/reporte_ped.php?doc=$concec' target='_blank'><img src='admin/imprimirblanco.png' width='35' /></a>
		";
		
?>
