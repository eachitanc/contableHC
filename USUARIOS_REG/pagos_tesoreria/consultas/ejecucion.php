<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
?>
<html>
<head>
</head>
<title>GCP - CONTRATACION</title>
<link rel="stylesheet" type="text/css" href="../../css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
<body>
<?php
$cod = $_REQUEST['cod'];
$filas = $_REQUEST['fil']; 
$cod2 = explode(",", $cod);
echo"
<table border='2' width='100%'>
<tr bgcolor='#CCCCCC'>
<td width='15%' align='left'><b>Rubro</b></td>
<td width='40%' align='left'><b>Nombre</b></td>
<td width='15%' align='center'><b>Aprobado</b></td>
<td width='15%' align='center'><b>Pagado</b></td>
<td width='15%' align='center'><b>Saldo</b></td>
</tr>
";
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
for ($i=1;$i<=$filas;$i++)
{
//Verifico que la variable codigo venga llena
if ($cod2[$i] !='')
  {	
	// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from cxp where cod_pptal ='$cod2[$i]'";
	$res = $cx->query($sql);
	$row = $res->fetch_assoc();
	$aprobado = number_format($row["ppto_aprob"],2,',','.');
	// Consulto la tabla de pagos por sumar el valor total pagado del cada rubro
	$sql2 = "select sum(valor) as pagado from cecp_cuenta where cuenta ='$cod2[$i]'";
	$res2 = $cx->query($sql2);
	$row2 = $res2->fetch_assoc(); 
	$pagado =number_format($row2["pagado"],2,',','.');
	$saldo = number_format(($row["ppto_aprob"] - $row2["pagado"]),2,',','.');
	print ("
			<tr>
			<td  align='left'> $row[cod_pptal] </td>
			<td  align='left'>  $row[nom_rubro] </td>
			<td  align='right'> $aprobado </td>
			<td  align='right'> $pagado </td>
			<td  align='right'>$saldo</td>
			</tr>");
 }	
}
echo "</table>";
$cx = null;
?>
