<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

// recibo variables del formulario
		$laboratorio = $_GET["laboratorio"]; 
		$cod_art = $_GET["cod_art"]; 
		// verifico si el documento ya existe
		$fi2=0;
		if ($fi2 <1)
		{
			// Inserta articulo en listado
		$sql4 ="insert into farm_lab (lab,cod_art) values ('$laboratorio','$cod_art')";
		$re14 = mysql_query($sql4);	
		echo $sql4;
		}
// Archivo a mostar desùes de guardar
		echo "<script>	document.getElementById('columna3').style.display='none';</script>	";	
		echo "<script>	document.getElementById('columna2').style.display='block';</script>	";	
?>
