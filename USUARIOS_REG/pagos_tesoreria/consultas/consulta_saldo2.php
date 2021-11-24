<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$valor = $_REQUEST['cod'];
$rubro = $_REQUEST['rubro'];
$valor_actual = $_REQUEST['actual'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	if ($rubro !='')
	{
		$sql = "select * from cxp where cod_pptal ='$rubro'";
		$res = mysql_db_query($database, $sql, $cx);
		$row = mysql_fetch_array($res);
		$aprobado = $row["ppto_aprob"];
		// Consulto la tabla de pagos por sumar el valor total pagado del  rubro
		$sql2 = "select sum(valor) as pagado from cecp_cuenta where cuenta ='$rubro'";
		$res2 = mysql_db_query($database, $sql2, $cx);
		$row2 = mysql_fetch_array($res2); 
		$pagado =$row2["pagado"];
		$saldo = ($aprobado - $pagado) + $valor_actual;
		$saldo_mod = $saldo + $valor_actual;
		if ($valor > $saldo)
		{
			echo "$saldo";
		}else{
			echo ""; 
		}
	}
$cx = null;
?>
