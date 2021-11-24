<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cuenta = $_REQUEST['cod'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		// Consulto la tabla de pagos por sumar el valor total pagado del cada rubro
		$sql2 = "select * from pgcp where cod_pptal ='$cuenta'";
		$res = mysql_db_query($database,$sql2,$cx);
		$row = mysql_fetch_array($res);
		$dato = $row["tip_dato"];
		echo $dato;
$cx = null;
?>
