<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cod = $_REQUEST['cod']; 
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo la cuenta y el nombre del rubro    	
		$sql = "select * from compensa_ica where cod='$cod'";
		$res = mysql_db_query($database, $sql, $cx);
		$row = mysql_fetch_array($res);
		$fil = mysql_num_rows($res);
		if ($fil >0)
		{
		$impuesto =	$row['impuesto']- $row['descuent'];
	echo $row['cc_nit'].','.$impuesto.','.$row['avisos'].','.$row['bomberos'].','.$row['procultura'].','.$row['certifi'].','.$row['extempo'].','.	$row['sancion'].','.$row['interes'].','.'0'.','.'0';
		}
$cx = null;
?>
