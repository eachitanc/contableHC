<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database);
// recibo variables del formulario
		$laboratorio = $_GET["laboratorio"]; 
		$cod_art = $_GET["cod_art"]; 
		$id = $_GET["id"]; 
		// verifico si el documento ya existe
		if ($id == '')
		{
		// Inserta articulo en listado
		$sql4 ="insert into farm_lab (lab,cod_art) values ('$laboratorio','$cod_art')";
		$re14 = mysql_query($sql4);	
		}else{
		$sq5 ="UPDATE `farm_lab` SET `lab` = '$laboratorio', `cod_art` = '$cod_art' WHERE `id` ='$id';";
		$re5 = mysql_query($sq5);	
		}
// Archivo a mostar desùes de guardar
		echo "<script>	document.getElementById('columna3').style.display='none';</script>	";	
		echo "<script>	document.getElementById('columna2').style.display='block';</script>	";	
?>
