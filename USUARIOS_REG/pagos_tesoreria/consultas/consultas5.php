<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id_ter = $_REQUEST['cod']; 

include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "SELECT
				terceros_juridicos.id
				, cree.tarifa as tarifa
			FROM
			   terceros_juridicos
				INNER JOIN cree 
					ON (terceros_juridicos.act_eco = cree.codigo)
			WHERE (terceros_juridicos.id =$id_ter);";
	$res = $cx->query($sql);
	$row = $res->fetch_assoc();
	$tarifa = $row['tarifa'];
	$sq2="select * from retecree";
	$rs2=$cx->query($sq2);
	while ($rw2 = mysql_fetch_array($rs2))
	{
		$sq3="select * from rango where tarifa = '$tarifa' and concepto = '$rw2[concepto]'";
		$rs3=mysql_db_query($database, $sq3, $cx);
		$fl3=mysql_num_rows($rs3);
		if ($fl3 >0)
		{
			$reten=$rw2['id'];
		}
	}
	echo $reten;
$cx = null;
?>
