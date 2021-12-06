<?php
set_time_limit(1200);
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=RETENCION_FUENTE.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>CONTAFACIL</title>
		<style>
			.text {
				mso-number-format: "\@"
			}

			.date {
				mso-number-format: "yyyy\/mm\/dd"
			}

			.numero {
				mso-number-format: "0"
			}
		</style>
	</head>

	<body>
		<?php
		include('../config.php');
		$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$fecha_ini = $_POST['fecha_ini'];
		$fecha_fin = $_POST['fecha_fin'];


		$sqlxx = "select * from fecha";
		$resultadoxx = $connectionxx->query($sqlxx);

		while ($rowxx = $resultadoxx->fetch_assoc()) {
			$idxx = $rowxx["id_emp"];
			$id_emp = $rowxx["id_emp"];
			$ano = $rowxx["ano"];
		}
		$sqldatos = "select * from empresa";
		$resdatos = $connectionxx->query($sqldatos);
		while ($rw1 = $resdatos->fetch_assoc()) {
			$entidad = $rw1["raz_soc"];
			$nit = $rw1["nit"];
			$rep = $rw1["nom_rep_leg"];
			$conta = $rw1["nom_cont"];
		}
		?>
		<table width='1380' border='0' align='center'>
			<tr>
				<td><b>ENTIDAD:</b></td>
				<td align="left"><?php echo $entidad; ?></td>
			</tr>
			<tr>
				<td><b>NIT:</b></td>
				<td align="left"><?php echo $nit; ?></td>
			</tr>
			<tr>
				<td><b>REPORTE:</b></td>
				<td>CONSOLIDADO RETENCION EN LA FUENTE</td>
			</tr>
			<tr>
				<td><b>FECHA INICIAL:</b></td>
				<td align="left"><?php echo $fecha_ini; ?></td>
			</tr>
			<tr>
				<td><b>FECHA FINAL:</b></td>
				<td align="left"><?php echo $fecha_fin; ?></td>
			</tr>

		</table>
		<br />
		<?php

		$sqlxx3 = "select * from fecha_ini_op";
		$resultadoxx3 = $connectionxx->query($sqlxx3);

		while ($rowxx3 = $resultadoxx3->fetch_assoc()) {
			$desde = $rowxx3["fecha_ini_op"];
		}
		?>
		<form name="a" method="post" action="retefuente.php">
		</form>
		<?php
		//-------
		$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$cx->query($database, "TRUNCATE TABLE retefte_det");
		$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta like '2436%' and cuenta not like '243627%' ";
		$re = $cx->query($sq);
		while ($rw3 = $re->fetch_assoc()) {
			// Sumatoria del valo total pagado
			$sq15 = "select sum(credito) as total_pagado from lib_aux where id_auto ='$rw3[id_auto]' and  cuenta like '1110%' ";
			$re15 = $cx->query($sq15);
			$rw15 = $re15->fetch_assoc();
			$sq2 = "select cuenta,credito from lib_aux where (cuenta like '1110%' or cuenta like '190101%') and id_auto ='$rw3[id_auto]'";
			$re2 = $cx->query($sq2);
			while ($rw2 =  $re2->fetch_assoc()) {
				//*** INFO base deacuerdo a documento ***//
				//*** porcentaje retefuente 
				$base = 0;
				$tipo_dcto = substr($rw3['dcto'], 0, 4);
				if ($tipo_dcto == 'CEVA') {
					$sq4 = "select * from ceva where id_auto_ceva ='$rw3[id_auto]'";
					$re4 = $cx->query($sq4);
					$rw4 =  $re4->fetch_assoc();
					$bruto = $rw4["total_pagado"] + $rw4["salud"] + $rw4["pension"] + $rw4["libranza"] + $rw4["f_solidaridad"] + $rw4["f_empleados"] + $rw4["sindicato"] + $rw4["embargo"] + $rw4["cruce"] + $rw4["otros"] + $rw4["vr_retefuente"] + $rw4["vr_reteiva"] + $rw4["vr_reteica"] + $rw4["vr_estampilla1"] + $rw4["vr_estampilla2"] + $rw4["vr_estampilla3"] + $rw4["vr_estampilla4"] + $rw4["vr_estampilla5"];
					$base = $bruto - $rw['vr_reteiva'];
					$porcentaje = $rw2['credito'] / $rw15['total_pagado'];
					$valor = $porcentaje * $rw3['credito'];
				}
				if ($tipo_dcto == 'CECP') {
					$sq4 = "select * from cecp where id_auto_cecp ='$rw3[id_auto]'";
					$re4 = $cx->query($sq4);
					$rw4 =  $re4->fetch_assoc();
					$bruto = $rw4["total_pagado"] + $rw4["salud"] + $rw4["pension"] + $rw4["libranza"] + $rw4["f_solidaridad"] + $rw4["f_empleados"] + $rw4["sindicato"] + $rw4["embargo"] + $rw4["cruce"] + $rw4["otros"] + $rw4["vr_retefuente"] + $rw4["vr_reteiva"] + $rw4["vr_reteica"] + $rw4["vr_estampilla1"] + $rw4["vr_estampilla2"] + $rw4["vr_estampilla3"] + $rw4["vr_estampilla4"] + $rw4["vr_estampilla5"];
					$base = $bruto - $rw['vr_reteiva'];
					$porcentaje = $rw2['credito'] / $rw15['total_pagado'];
					$valor = $porcentaje * $rw3['credito'];
				}
				//base del iva
				$cuentas = substr($rw3['cuenta'], 0, 6);
				if ($cuentas == '243625') $base = 0;
				// insert

				$sq5 = "INSERT INTO retefte_det (id_auto,dcto,cuenta,detalle,base,debito,credito,cta_bco) values ('$rw3[id_auto]','$rw3[dcto]','$rw3[cuenta]','$rw3[detalle]','$base','$rw3[debito]','$valor','$rw2[cuenta]')";
				$res = $cx->query($sq5);
			}
			$valor = 0;
			$porcentaje = 0;
		}
		// Inicio del reporte
		printf("
<center>
<table width='2400' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>Cuenta</td>
<td align='center' width='220'>Nombre</td>
");
		// buscar el numero de cuentas que hay en la tabla
		$sq7 = "select distinct cta_bco as cta_b from retefte_det where credito >0 order by cta_bco asc";
		$re7 = $cx->query($sq7);
		$fi7 = $re7->num_rows;
		$j = 0;
		while ($rw7 =  $re7->fetch_assoc()) {
			$cuenta_bco[$j] = $rw7['cta_b'];
			$j++;
		}
		for ($i = 0; $i < $fi7; $i++) {
			printf("
	<td align='center' width='80'>$cuenta_bco[$i]</td>");
		}

		printf("
<td align='center' width='100'>Total Rte</td>
<td align='center' width='100'>Total Pago</td>
<td align='center' width='100'>Total Base</td>
</tr>
");

		// consultar por cada cuenta y 
		$sq8 = "select distinct cuenta from retefte_det where credito >0";
		$re8 = $cx->query($sq8);
		$k = 0;
		while ($rw8 =  $re8->fetch_assoc()) {
			$sq11 = "select nom_rubro from pgcp where cod_pptal = '$rw8[cuenta]'";
			$re11 = $cx->query($sq11);
			$rw11 =  $re11->fetch_assoc();
			printf("<tr bgcolor='#ffffff'>
	<td align='center'>$rw8[cuenta]</td>
	<td align='left'>$rw11[nom_rubro]</td>	
	");
			// consulto la tabla para llenar los valores de cada cuenta
			for ($i = 0; $i < $fi7; $i++) {
				$sq12 = "select sum(credito) as val from retefte_det where cuenta ='$rw8[cuenta]' and cta_bco ='$cuenta_bco[$i]'";
				$re12 = $cx->query($sq12);
				$rw12 =  $re12->fetch_assoc();
				$credito = 	$rw12['val'];
				if ($credito == '') $credito = 0.00;
				printf("
		<td align='right'>$credito</td>
		");
				$k++;
			}
			// consultar el total de la retencion por cada cuenta o tipo de retencion
			$sq13 = "select sum(credito) as valt, sum(base) as base from retefte_det where cuenta ='$rw8[cuenta]'";
			$re13 = $cx->query($sq13);
			$rw13 = $re13->fetch_assoc();
			$pago = round(($rw13['valt'] / 1000), 0) * 1000;
			$base = round(($rw13['base'] / 1000), 0) * 1000;
			printf("
		<td align='right' bgcolor='#CCCCCC'>$rw13[valt]</td>
		<td align='right' bgcolor='#FFCC00'>$pago</td>
		<td align='right' bgcolor='#FFCC00'>$base </td>
		</tr>
		");
			$pago = 0;
			$base = 0;
		}
		printf("<tr bgcolor='#ffffff'>
			<td align='left' colspan='2' bgcolor='#CCCCCC'>Total Rte</td>
			");
		$i = 0;
		$sum = 0;
		$baset = 0;
		for ($i = 0; $i < $fi7; $i++) {
			$sq14 = "select sum(credito) as valt, sum(base) as base from retefte_det where cta_bco ='$cuenta_bco[$i]'";
			$re14 = $cx->query($sq14);
			$rw14 = $re14->fetch_assoc();
			printf("
			<td align='right' bgcolor='#CCCCCC'>$rw14[valt]</td>
			");
			$sum = $sum + $rw14['valt'];
			$base2 = $base2 + $rw14['base'];
		}
		printf("<td align='right' bgcolor='#CCCCCC'>$sum</td>
			");
		$sumt = round(($sum / 1000), 0) * 1000;
		printf("<td align='right' bgcolor='#FFCC00'>$sumt</td>
			");
		$baset = round(($base2 / 1000), 0) * 1000;
		printf("<td align='right' bgcolor='#FFCC00'>$baset</td>
			");
		// para final redondeado
		printf("<tr bgcolor='#FFFFFF'>
			<td align='left' colspan='2' bgcolor='#FFCC00'>Total Pago</td>
			");
		$i = 0;
		$suma = 0;
		for ($i = 0; $i < $fi7; $i++) {
			$sq14 = "select sum(credito) as valt from retefte_det where cta_bco ='$cuenta_bco[$i]'";
			$re14 = $cx->query($sq14);
			$rw14 = $re14->fetch_assoc();
			$suma = round(($rw14['valt'] / 1000), 0) * 1000;
			printf("
			<td align='right' bgcolor='#FFCC00'>$suma</td>
			");
			$sum = $sum + $rw14['valt'];
			$base2 = $base2 + $rw14['base'];
		}
		printf("<td align='left' colspan='3'>&nbsp;</td>
			");
		printf("</tr></table></center>");
		//--------	
		?>
	</body>

	</html>
<?php
}
?>