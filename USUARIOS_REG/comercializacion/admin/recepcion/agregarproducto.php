<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

// recibo variables del formulario
		$tipo_art2 = $_GET["tipo_art2"]; 
		$fecha_alta = $_GET["fecha_alta"]; 
		$nombre2 = $_GET["nombre2"]; 
		$unidad = $_GET["unidad"]; 
		$laboratorio = $_GET["laboratorio"]; 
		$cum = $_GET["cum"]; 
		$consecutivo = $_GET["consecutivo"]; 
		// verifico si el documento ya existe
		$fi2=0;
		if ($fi2 <1)
		{
			// Inserta articulo en listado
		$sql4 ="insert into farm_med (tipo,nombre,fecha_alta,unidad,laboratorio,cum,consecutivo,user) values ('$tipo_art2','$nombre2','$fecha_alta','$unidad','$laboratorio','$cum','$consecutivo','$_SESSION[user]')";
		$re14 = mysql_query($sql4);	
		}
// Archivo a mostar desùes de guardar
		echo "<script>	document.getElementById('columna2').style.display='none';</script>	";	
		echo "<script>	document.getElementById('columna1').style.display='block';</script>	";	
?>
