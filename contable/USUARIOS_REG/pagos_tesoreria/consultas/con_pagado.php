<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$codigo = $_REQUEST['cod']; 
$valor=$_REQUEST['valor'];
$id_auto_cobp=$_REQUEST['nn'];
include('../../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
		$sql = "select * from cobp where id_auto_cobp ='$id_auto_cobp' and cuenta='$codigo'";
		$res = mysql_db_query($database, $sql, $cx);
		//$numf=mysql_num_rows($res);
		while ($row = mysql_fetch_array($res))
		{
			$pagado=$row['vr_pagado'];
			$obligado=$row['vr_digitado'];
		}
		$saldo= $obligado - $pagado;
	echo $saldo;
mysql_close($cx);
?>
