<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=INFORME_POR_DOCUMENTO.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	include('../config.php');
	$a = $_POST['nn'];
	$fecha_ini = $_POST['fecha_ini'];
	$fecha_fin = $_POST['fecha_fin'];
	$ruta_img = "http://$_SERVER[HTTP_HOST]/USUARIOS_REG/images/PLANTILLA PNG PARA LOGO EMPRESA.png";
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	if ($a == 'CDPP') {
		$tipo = 'CERTIFICADO DE DISPONIBILIDAD PRESUPUESTAL';
	}
	if ($a == 'CRPP') {
		$tipo = 'REGISTRO PRESUPUESTAL';
	}
	if ($a == 'COBP') {
		$tipo = 'OBLIGACION PRESUPUESTAL';
	}
?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>CONTAFACIL</title>


		<style type="text/css">
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
		<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
		</LINK>

		<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
	</head>

	<body>
		<table width="800" border="0" align="center">
			<tr>
				<td rowspan="4" align="center"><img src='<?php echo $ruta_img; ?>' width="150" /></td>
				<td align="center" colspan="5"></td>
			</tr>
			<tr>
				<td align="center" colspan="5">
					<font size="4"><b><?php echo $empresa; ?></b></font>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="5">
					<font size="4"><b>CONSULTA POR TIPO DE DOCUMENTO FUENTE</b></font>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="5">
					<font size="4"><b><?php echo $tipo; ?></b></font>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="6"></td>
			</tr>
		</table>

		<table width="800" border="0" align="center">
			<tr>
				<td colspan="3">
					<div align="center">
						<?php
						printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo10'>Usted ha seleccionado como <b>Fecha Inicial</b> : %s y como <b>Fecha Final</b> : %s</center>
	</div>
	", $fecha_ini, $fecha_fin);
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center">
							<?php
							//printf("%s<br>%s<br>%s",$a,$fecha_ini,$fecha_fin);
							if ($a == 'CDPP') {

								//-------
								$sq = "select * from cdpp where (fecha_reg between '$fecha_ini' and '$fecha_fin' ) order by fecha_reg asc ";
								$re = $cx->query($sq);

								printf("
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><B>No. COMP.</b></span>
</div>
</td>
<td align='center' width='80'><span class='Estilo4'><B>FECHA</b></span></td>
<td align='center' width='225'><span class='Estilo4'><B>COD. PPTAL</b></span></td>
<td align='center' width='225'><span class='Estilo4'><B>CUENTA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><B>CONCEPTO - DETALLE</b></span></td>
<td align='center' width='130'><span class='Estilo4'><B>VALOR</b></span></td>

</tr>

");
								$val = 0;
								while ($rw = $re->fetch_assoc()) {

									$tercero =  $rw["nat_com"] . $rw["jur_com"];

									printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#F5F5F5'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left' bgcolor='#F5F5F5' class='text'>%s</td>
<td align='left'><span class='Estilo4'>%s </span></td>
<td align='left' bgcolor='#F5F5F5'>%s</td>
<td align='right'>%s</td>

</tr>", 'CDPP' . $rw["cdpp"], $rw["fecha_reg"], $rw["cuenta"], utf8_decode($rw["nom_rubro"]), utf8_decode($rw["des"]), number_format($rw["valor"], 2, '.', ','));
									$val = $val + $rw["valor"];
								}

								printf("</table></center>");
								printf("
<br>
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td colspan='6' align='right'>
<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
<span class='Estilo4'><b>TOTAL: &nbsp;&nbsp;&nbsp; " . number_format($val, 2, ',', '.') . "&nbsp; </b></span>
</div>
</td>
</tr>
</table>
</center>

");
								//--------	

							}
							?>
							<table width="800" border="0" align="center">
								<tr>
									<td colspan="3">
										<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
											<div align="center">
												<?php
												if ($a == 'CRPP') {
													$sq = "select * from crpp where (fecha_crpp between '$fecha_ini' and '$fecha_fin' )  order by fecha_crpp asc ";
													$re = $cx->query($sq);

													printf("
<center>

<table width='1080' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><B>No. COMP.</b></span>
</div>
</td>
<td align='center' width='80'><span class='Estilo4'><B>FECHA</b></span></td>
<td align='center' width='225'><span class='Estilo4'><B>COD. PPTAL</b></span></td>
<td align='center' width='225'><span class='Estilo4'><B>DETALLE</b></span></td>
<td align='center' width='225'><span class='Estilo4'><B>TERCERO</b></span></td>
<td align='center' width='300'><span class='Estilo4'><B>CONCEPTO - DETALLE</b></span></td>
<td align='center' width='130'><span class='Estilo4'><B>VR. DEL DCTO</b></span></td>

</tr>

");
													$val = 0;
													while ($rw = $re->fetch_assoc()) {

														$tercero =  $rw["tercero"];

														$vr1 = $rw["cuenta"];
														$sqlxx2a = "select * from car_ppto_gas where cod_pptal ='$vr1'";
														$resultadoxx2a = $cx->query($sqlxx2a);
														while ($rowxx2a = $resultadoxx2a->fetch_assoc()) {
															$nom_rubro = $rowxx2a["nom_rubro"];
														}



														printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#F5F5F5'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left' bgcolor='#F5F5F5'  class='text'>%s</td>
<td align='left' bgcolor='#F5F5F5'>%s</span></td>
<td align='left'>%s</td>
<td align='left' bgcolor='#F5F5F5'>%s</td>
<td align='right'>%s</td>

</tr>", $rw["id_manu_crpp"], $rw["fecha_crpp"], $rw["cuenta"], utf8_decode($nom_rubro), utf8_decode($tercero), utf8_decode($rw["detalle_crpp"]), number_format($rw["vr_digitado"], 2, '.', ','));
														$val = $val + $rw["vr_digitado"];
													}

													printf("</table></center>");
													printf("
<br>
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td colspan='7' align='right'>
<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
<span class='Estilo4'><b>TOTAL: &nbsp;&nbsp;&nbsp; " . number_format($val, 2, ',', '.') . "&nbsp; </b></span>
</div>
</td>
</tr>
</table>
</center>

");
													//--------	

												}
												?>
												<table width="800" border="0" align="center">
													<tr>
														<td colspan="3">
															<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
																<div align="center">
																	<?php
																	if ($a == 'COBP') {

																		//-------
																		$sq = "select * from cobp where (fecha_cobp between '$fecha_ini' and '$fecha_fin' ) order by fecha_cobp asc ";
																		$re = $cx->query($sq);

																		printf("
<center>

<table width='1080' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><B>No. COMP.</b></span>
</div>
</td>
<td align='center' width='80'><span class='Estilo4'><B>FECHA</b></span></td>
<td align='center' width='225'><span class='Estilo4'><B>COD. PPTAL</b></span></td>
<td align='center' width='225'><span class='Estilo4'><B>DETALLE</b></span></td>
<td align='center' width='225'><span class='Estilo4'><B>TERCERO</b></span></td>
<td align='center' width='300'><span class='Estilo4'><B>CONCEPTO - DETALLE</b></span></td>
<td align='center' width='130'><span class='Estilo4'><B>VR. DEL DCTO</b></span></td>

</tr>

");
																		$val = 0;
																		while ($rw = $re->fetch_assoc()) {

																			$tercero =  $rw["tercero"];

																			printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#F5F5F5'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left' bgcolor='#F5F5F5' class='text'>%s</td>
<td align='left' bgcolor='#F5F5F5'>%s</td>
<td align='left'>%s</td>
<td align='center' bgcolor='#F5F5F5'>%s</td>
<td align='right'>%s</td>

</tr>", $rw["id_manu_cobp"], $rw["fecha_cobp"], $rw["cuenta"], utf8_decode($rw["nom_rubro"]), utf8_decode($tercero), utf8_decode($rw["des_cobp"]), number_format($rw["vr_digitado"], 2, '.', ','));
																			$val = $val + $rw["vr_digitado"];
																		}

																		printf("</table></center>");
																		printf("
<br>
<center>
<table width='1080' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td colspan='7' align='right'>
<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
<span class='Estilo4'><b>TOTAL: &nbsp;&nbsp;&nbsp; " . number_format($val, 2, ',', '.') . "&nbsp; </b></span>
</div>
</td>
</tr>
</table>
</center>

");
																		//--------	

																	}
																	?>
																</div>
															</div>
														</td>
													</tr>
												</table>
	</body>

	</html>






<?php
}
?>