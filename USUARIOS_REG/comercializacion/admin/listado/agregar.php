<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

// recibo variables del formulario
		$id = $_GET["id"];
		// verifico si el documento ya existe
		$sq = "select * from farm_med where id = '$id'";
		$rs = mysql_query($sq);
		while ($rw = mysql_fetch_array($rs))
		{ 
		// verifico documento en listado
		$sq2 = "select cum from farm_listado where cum = '$rw[cum]'";
		$rs2 = mysql_query($sq2);
		$fi2 = mysql_num_rows($rs2);
		if ($fi2 <1)
		{
		$sql3 ="insert into farm_listado (tipo,nombre,presenta,fabrica,codatc,principio,via_admin,pos,cum,fecha,log) values('MED','$rw[nombre]','$rw[presenta]','$rw[fabrica]','$rw[codatc]','$rw[principio]','$rw[via_admin]','$rw[pos]','$rw[cum]','fecha','log')";
		$re2 = mysql_query($sql3);
		}
		}
			if (!$re2) {
				die('Invalid query: ' . mysql_error());
				echo "<script>alert('El registro no fue guardado..');</script>";
		}
// Archivo a mostar desùes de guardar
			 echo "<script>	cargaArchivo2('admin/recepcion/reporte.php?fecha=$fecha&cliente=$cliente','columna1');</script>";	
$cx = null;
?>