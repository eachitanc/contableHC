<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$valor = $_REQUEST['cod'];
$rubro = $_REQUEST['rubro'];
include('../../config.php');
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
	// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	if ($rubro !='')
	{
		$sql = "select * from cxp where cod_pptal ='$rubro'";
		$res = mysql_db_query($database, $sql, $cx);
		$row = mysql_fetch_array($res);
		$aprobado = $row["ppto_aprob"];
		// Consulto la tabla de pagos por sumar el valor total pagado del cada rubro
		$sql2 = "select sum(valor) as pagado from cecp_cuenta where cuenta ='$rubro'";
		$res2 = mysql_db_query($database, $sql2, $cx);
		$row2 = mysql_fetch_array($res2); 
		$pagado =$row2["pagado"];
		$saldo = $aprobado - $pagado;
		if ($valor > $saldo)
		{
			echo "$saldo";
		}else{
			echo ""; 
		}
	}
mysql_close($cx);
?>
