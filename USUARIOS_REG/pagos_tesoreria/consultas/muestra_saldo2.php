<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$cuenta = $_REQUEST['cod'];
$id=substr($_REQUEST['id'],1,10); 
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
//Verifico que la variable codigo venga llena
if ($cuenta !='')
  {	
	// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from cxp where cod_pptal ='$cuenta'";
	$res = $cx->query($sql);
	$row = $res->fetch_assoc();
	$aprobado = $row["ppto_aprob"];
	// Consulto la tabla de pagos por sumar el valor total pagado del cada rubro
	$sql2 = "select sum(valor) as pagado from cecp_cuenta where cuenta ='$cuenta'";
	$res2 = $cx->query($sql2);
	$row2 = $res2->fetch_assoc(); 
	$pagado =$row2["pagado"];
	
	$sql3 = "select * from cecp_cuenta where cuenta ='$cuenta' and id_auto_cecp='$id'";
	$res3 = mysql_db_query($database, $sql3, $cx);
	$row3 = mysql_fetch_array($res3);
	
	
	$saldo = ($row["ppto_aprob"] - $row2["pagado"]+$row3["valor"]);
	$saldo2 = round($saldo * 100) / 100;
 }	
print $saldo2;
$cx = null;
?>
