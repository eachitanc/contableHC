<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<html>

<head>
</head>
<title>GCP - CONTRATACION</title>
<link rel="stylesheet" type="text/css" href="../../css/estilos.css"><!-- Estas lineas incluyen el archivo estilosh.css -->

<body>
	<?php
	$ter_nat = $_REQUEST['ter_nat'];
	$ter_jur = $_REQUEST['ter_jur'];
	echo "
<table border='2' width='100%'>
<tr bgcolor='#CCCCCC'>
<td width='10%' align='center'><b>Fecha</b></td>
<td width='10%' align='center'><b>Documento</b></td>
<td width='55%' align='center'><b>Concepto</b></td>
<td width='15%' align='center'><b>Valor</b></td>
</tr>
";
	include('../../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	if ($ter_nat != 'nat') {
		$sqlx = "SELECT * from terceros_naturales where id= '$ter_nat'";
		$resx = $cx->query($sqlx);
		while ($row3x = $resx->fetch_assoc()) {
			$num_id = $row3x['num_id'];
		}
		$sql = "select * from cecp  where cn = '$num_id'";
		$res = $cx->query($sql);
		while ($row3 = $res->fetch_assoc()) {
			$valor = number_format($row3["vr_obli_para_pago_mas_iva"], 2, ',', '.');
			print("
			<tr>
			<td  align='center'>  $row3[fecha_cecp] </td>
			<td  align='center'> $row3[id_manu_cecp] </td>
			<td  align='left'> $row3[concepto_pago] </td>
			<td  align='right'> $valor </td>
			</tr>");
		}
		$sql2 = "select sum(vr_obli_para_pago_mas_iva) as total from cecp  where cn = '$num_id'";
		$res2 = $cx->query($sql2);
		$row2 = $res2->fetch_assoc();
		$total = number_format($row2["total"], 2, ',', '.');
		print("
			<tr bgcolor='#CCCCCC'>
			<td  align='right' colspan='3'><b> Total : </b></td>
			<td  align='right'><b> $total  </b></td>
			</tr>");
		echo "</table>";
	}
	if ($ter_jur != 'jur') {
		$sqlx = "select * from terceros_juridicos where id= '$ter_jur'";
		$resx = $cx->query($sqlx);
		while ($row3x = $resx->fetch_assoc()) {
			$num_id = $row3x['num_id2'];
		}
		$sql = "select * from cecp  where cn = '$num_id'";
		$res = $cx->query($sql);
		while ($row3 = $res->fetch_assoc()) {
			$valor = number_format($row3["vr_obli_para_pago_mas_iva"], 2, ',', '.');
			print("
			<tr>
			<td  align='center'>  $row3[fecha_cecp] </td>
			<td  align='center'> $row3[id_manu_cecp] </td>
			<td  align='left'> $row3[concepto_pago] </td>
			<td  align='right'> $valor </td>
			</tr>");
		}
		$sql2 = "select sum(vr_obli_para_pago_mas_iva) as total from cecp  where cn = '$num_id'";
		$res2 = $cx->query($sql2);
		$row2 = $res2->fetch_assoc();
		$total = number_format($row2["total"], 2, ',', '.');
		print("
			<tr bgcolor='#CCCCCC'>
			<td  align='right' colspan='3'><b> Total : </b></td>
			<td  align='right'><b> $total  </b></td>
			</tr>");
		echo "</table>";
	}

	$cx = null;
	?>