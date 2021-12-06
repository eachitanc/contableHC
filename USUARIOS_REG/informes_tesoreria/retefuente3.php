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
		$cx->query("TRUNCATE TABLE retefte_det");
		$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta like '2365%' and cuenta not like '243627%'  ";
		$re = $cx->query($sq) or die(mysqli_error($cx));
		while ($rw3 = $re->fetch_assoc()) {
			// Sumatoria del valo total pagado
			$sq15 = "select sum(credito) as total_pagado from lib_aux where id_auto ='$rw3[id_auto]' and  cuenta like '2365%' ";
			$re15 = $cx->query($sq15);
			$rw15 = $re15->fetch_assoc();
			$sq2 = "select cuenta,credito from lib_aux where (cuenta like '1110%' or cuenta like '2365%' ) and id_auto ='$rw3[id_auto]'";
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
				if ($tipo_dcto == 'OBCG') {
					$sq4 = "select sum(debito) as base from lib_aux where id_auto ='$rw3[id_auto]'";
					$re4 = $cx->query($sq4);
					$rw4 =  $re4->fetch_assoc();
					$base = $rw4["base"];
					$valor = $rw3['credito'];
				}
				//base del iva
				$cuentas = substr($rw3['cuenta'], 0, 6);
				if ($cuentas == '243625') $base = 0;
				// insert
				$sq5 = "INSERT INTO retefte_det (id_auto,dcto,cuenta,detalle,base,debito,credito,cta_bco) values ('$rw3[id_auto]','$rw3[dcto]','$rw3[cuenta]','$rw3[detalle]','$base','$rw3[debito]','$valor','')";
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
<td align='center' width='220'>Base</td>
<td align='center' width='220'>Retencion</td>
</tr>
");
		// buscar el numero de cuentas que hay en la tabla
		$sq7 = "select distinct cuenta as cuenta from retefte_det where credito >0 order by cuenta asc";
		$re7 = $cx->query($sq7);
		$fi7 = $re7->num_rows;
		$j = 0;
		while ($rw7 =  $re7->fetch_assoc()) {
			$cuenta = $rw7['cuenta'];
			$sq16 = "select sum(base) as base, sum(credito) as credito from  retefte_det where cuenta = $rw7[cuenta] group by cuenta";
			$re16 = $cx->query($sq16);
			$rw16 =  $re16->fetch_assoc();
			// consulta el nombre de la cuenta
			$sq17 = "select nom_rubro from pgcp where cod_pptal ='$rw7[cuenta]'";
			$re17 = $cx->query($sq17);
			$rw17 = $re17->fetch_assoc();
			echo "<tr>";
			echo ("<td align='left' width='80'>$cuenta</td>");
			echo ("<td align='left' width='80'>$rw17[nom_rubro]</td>");
			echo ("<td align='right' width='80'>$rw16[base]</td>");
			printf("<td align='rigth' width='80'>$rw16[credito]</td>");
			echo "</tr>";
		}


		printf("</table></center>");
		//--------	
		?>
	</body>

	</html>
<?php
}
?>