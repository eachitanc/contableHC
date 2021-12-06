<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$valor = $_REQUEST['cod'];
$rubro = $_REQUEST['rubro'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	if ($rubro !='')
	{
		$sql = "select * from cxp where cod_pptal ='$rubro'";
		$res = $cx->query($sql);
		$row = $res->fetch_assoc();
		$aprobado = $row["ppto_aprob"];
		// Consulto la tabla de pagos por sumar el valor total pagado del cada rubro
		$sql2 = "select sum(valor) as pagado from cecp_cuenta where cuenta ='$rubro'";
		$res2 = $cx->query($sql2);
		$row2 = $res2->fetch_assoc(); 
		$pagado =$row2["pagado"];
		$saldo = $aprobado - $pagado;
		if ($valor > $saldo)
		{
			echo "$saldo";
		}else{
			echo ""; 
		}
	}
$cx = null;
?>
