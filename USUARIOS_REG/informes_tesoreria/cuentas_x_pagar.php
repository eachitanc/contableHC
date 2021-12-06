<?php
set_time_limit(600);
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=FORMATO_201101_F11_10_CDN.xls");
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
				mso-number-format: "#,##0.00"
			}
		</style>
	</head>

	<body>
		<div align="center" class="Estilo4">
			<div style='padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;'>
			<?php
			include('../config.php');
			$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
			// llegan las variables
			$fecha_fin = $_POST['fecha_fin'];
			$fecha = explode("/", $fecha_fin);
			$fecha_ini = $fecha[0] . "/01/01";
			printf("
<center>
<table BORDER='1' class='bordepunteado1' width='2480'>
<tr>
<td bgcolor='#DCE9E5' align='center' width='140'><span class='Estilo41'>C�digo Rubro Presupuestal</span></td>
<td bgcolor='#DCE9E5' align='center' width='350'><span class='Estilo41'>Descripci�n Del Rubro</span></td>
<td bgcolor='#DCE9E5' align='center' width='140'><span class='Estilo41'>Cuenta Por Pagar Constituida</span></td>
<td bgcolor='#DCE9E5' align='center' width='100'><span class='Estilo41'>Fecha De Pago</span></td>
<td bgcolor='#DCE9E5' align='center' width='100'><span class='Estilo41'>Periodo reportado</span></td>
<td bgcolor='#DCE9E5' align='center' width='100'><span class='Estilo41'>No. De Comprobante</span></td>
<td bgcolor='#DCE9E5' align='center' width='250'><span class='Estilo41'>Beneficiario</span></td>
<td bgcolor='#DCE9E5' align='center' width='100'><span class='Estilo41'>C�dula O Nit</span></td>
<td bgcolor='#DCE9E5' align='center' width='350'><span class='Estilo41'>Detalle De Pago</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Valor Comprobante De Pago</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Descuentos Seg. Social</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Descuentos Retenciones</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Otros Descuentos</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Neto Pagado</span></td>
<td bgcolor='#DCE9E5' align='center' width='100'><span class='Estilo41'>Banco</span></td>
<td bgcolor='#DCE9E5' align='center' width='100'><span class='Estilo41'>No. De Cuenta</span></td>
<td bgcolor='#DCE9E5' align='center' width='100'><span class='Estilo41'>No. De Cheque O Nd</span></td>
</tr>
");
			$sq = "SELECT * from cecp where fecha_cecp BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re = $cx->query($sq);
			$per = '';
			while ($rw = $re->fetch_assoc()) {

				$seg_soc = $rw["salud"] + $rw["pension"];
				$reten = $rw["vr_retefuente"] + $rw["vr_reteiva"] + $rw["vr_reteica"];
				$otros_desc = $rw["libranza"] + $rw["f_solidaridad"] + $rw["f_empleados"] + $rw["sindicato"] + $rw["f_solidaridad"] + $rw["embargo"] + $rw["cruce"] + $rw["f_solidaridad"] + $rw["f_empleados"] + $rw["sindicato"] + $rw["otros"] + $rw["vr_estampilla1"] + $rw["vr_estampilla2"] + $rw["vr_estampilla3"] + $rw["vr_estampilla4"] + $rw["vr_estampilla5"];
				$i = 0;
				for ($i = 1; $i <= 15; $i++) {
					$pgcp = $rw["pgcp$i"];
					$pgcp_grupo = substr($pgcp, 0, 4);
					if ($pgcp_grupo == '1110' or $pgcp_grupo == '1120') {
						$cuenta = $pgcp;
					}
					$cheque = isset($rw["num_cheque" . $i]) ? $rw["num_cheque" . $i] : '';
					if ($cheque != '') {
						$chequen = $cheque;
					}
				}
				$banco = $cx->query("select cod_sia from pgcp where cod_pptal ='$cuenta'");
				while ($row = $banco->fetch_assoc()) {
					$cod_banco = $row["cod_sia"];
				}
				// Lleno la tabla con valores parciales segun el numero de imputaciones
				$id_auto_cecp = $rw["id_auto_cecp"];
				$sq2 = "select * from cecp_cuenta where id_auto_cecp ='$id_auto_cecp'";
				$rs2 =  $cx->query($sq2);
				while ($rw2 = $rs2->fetch_assoc()) {
					$codigo = $rw2["cuenta"];
					$res = $cx->query("select nom_rubro,cod_sia from cxp where cod_pptal ='$codigo'");
					$rwc = $res->fetch_assoc();
					// Calculo pagos parciales de acurdo al valor pagado del rubro
					$total = $rw["vr_obli_para_pago_mas_iva"] == 0 ? 1 : $rw["vr_obli_para_pago_mas_iva"];
					$parcial =  $rw2["valor"] / $total;
					$val_comprobante = $rw["vr_obli_para_pago_mas_iva"] * $parcial;
					$seg_soc = $seg_soc * $parcial;
					$reten = $reten * $parcial;
					$otros_desc = $otros_desc * $parcial;
					$pagado = $rw["total_pagado"] * $parcial;
					printf("
				<span class='Estilo4'>
				<tr>
				<td align='left' class='text'>%s</td>
				<td align='left'>%s</td>
				<td align='right'>%s</td>
				<td align='center' class='date'>%s</td>
				<td align='center'>%s</td>
				<td align='center'>%s</td>
				<td align='left'>%s</td>
				<td align='left'>%s</td>
				<td align='left'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td>
				<td align='right'>%s</td> 
				<td align='right'>%s</td>
				<td align='rights' class='text'>%s</td>
				</tr>", $rwc["cod_sia"] . $rw2["cuenta"], ucfirst(preg_replace("[,;]", "", $rwc["nom_rubro"])), $rw2["valor"], $rw["fecha_cecp"], $per, $rw["id_manu_cecp"], $rw["nt"], $rw["cn"], preg_replace("[,;]", "", $rw["concepto_pago"]), $val_comprobante, $seg_soc, $reten, $otros_desc, $pagado, $cod_banco, $cuenta, $chequen);
				}
			}
			printf("</table></center>");
		}
		$cx = null;
			?>