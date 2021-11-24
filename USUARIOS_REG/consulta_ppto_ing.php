<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	// verifico permisos del usuario
	include('config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");
	$sql = "SELECT teso FROM usuarios2 where login = '$_SESSION[login]'";
	$res = $cx->query($sql);
	$rw = $res->fetch_assoc();
	if ($rw['teso'] == 'SI') {

?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<title>CONTAFACIL</title>
			<link rel="StyleSheet" href="dtree.css" type="text/css" />
			<script type="text/javascript" src="dtree.js"></script>

			<style type="text/css">
				<!--
				.Estilo1 {
					font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
					font-size: 12px;
					font-weight: bold;
				}

				.Estilo2 {
					font-size: 9px
				}

				a {
					font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
					font-size: 11px;
					color: #666666;
				}

				a:visited {
					color: #666666;
					text-decoration: none;
				}

				a:hover {
					color: #666666;
					text-decoration: underline;
				}

				a:active {
					color: #666666;
					text-decoration: none;
				}

				a:link {
					text-decoration: none;
				}

				.Estilo7 {
					font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
					font-size: 11px;
					color: #666666;
				}

				.Estilo4 {
					font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
					font-size: 10px;
					color: #333333;
				}
				-->
			</style>

			<style type="text/css">
				table.bordepunteado1 {
					border-style: solid;
					border-collapse: collapse;
					border-width: 2px;
					border-color: #004080;
				}

				.Estilo8 {
					color: #FF0000;
					font-weight: bold;
				}

				.Estilo9 {
					color: #FFFFFF
				}
			</style>

		</head>

		<!--<body onload = "document.forms[0]['a'].focus()">-->

		<body>
			<table width="850" border="0" align="center">
				<tr>

					<td width="980" colspan="3">
						<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
							<div align="center"><img src="../ADMIN/images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">

						<table width="800" border="0" align="center">
							<tr>
								<td>
									<div align="center">
										<p><span class="Estilo1">MAESTRO PRESUPUESTO DE INGRESOS</b></span>
											<br />
											<br />
											<?php
											$cxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");
											$sxx = "SELECT * from fecha";
											$rxx = $cxx->query($sxx);

											while ($rowxxx = $rxx->fetch_assoc()) {

												$idxxx = $rowxxx["id_emp"];
												//printf("<span class='Estilo4'><b>Fecha de Trabajo ACTUAL = DIA: %s / MES: %s / A&Ntilde;O: %s </b></span><BR><span class='Estilo4'><b>Id Empresa ACTUAL = %s </b></span>", $row["dia"], $row["mes"], $row["ano"], $row["id_emp"]);  
											}
											?>
											<?php
											//-------
											$cx2 = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");
											$sq2 = "SELECT * from empresa where cod_emp = '$idxxx'";
											$re2 = $cx2->query($sq2);

											while ($row2 = $re2->fetch_assoc()) {
												printf("<span class='Estilo4'><b>...::: %s :::...</b></span><br>", $row2["raz_soc"]);
											}
											//--------	--------------------------------------------------------------------------------------------
											?>
											<br />
											<?php
											//-------
											$connection = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");
											$sql = "SELECT * from fecha";
											$resultado = $connection->query($sql);

											while ($row = $resultado->fetch_assoc()) {

												$id = $row["id_emp"];
												//printf("<span class='Estilo4'><b>Fecha de Trabajo ACTUAL = DIA: %s / MES: %s / A&Ntilde;O: %s </b></span><BR><span class='Estilo4'><b>Id Empresa ACTUAL = %s </b></span>", $row["dia"], $row["mes"], $row["ano"], $row["id_emp"]);  
											}
											//--------	
											?>
										</p>
										<table width="800" border="1" class="bordepunteado1">
											<tr>
												<td bgcolor="#DCE9E5">
													<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
														<div align="center" class="Estilo4"><strong>IMPORTANTE</strong></div>
													</div>
												</td>
											</tr>
											<tr>
												<td align="left">
													<div style="padding-left:10px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
														<span class="Estilo4">
															1. Si selecciona un <strong>CODIGO PRESUPUESTAL</strong> puede <strong>MODIFICAR</strong> su nombre, procedencia, situacion. <br />
															2. Si desea MODIFICAR el <strong>VALOR APROBADO</strong> de una cuenta, debe ELIMINARLA Y VOLVER A CREARLA (Solo en Carga Inicial de Ppto).<br />
															3. Columna <strong>P.A.C </strong>: <strong>NO</strong> = No se ha definido P.A.C :::: <strong>SI</strong> = Ya se ha definido P.A.C <br />
															4. Recuerde <span class="Estilo8">
																<marquee scrolldelay="150" style="width:100px"> ACTUALIZAR P.A.C </marquee>
															</span> <span class="Estilo9">:</span>constantemente <br />

														</span>
													</div>
												</td>
											</tr>
										</table>
										<BR />
										<table width="800" border="1" align="center" class="bordepunteado1">
											<tr bgcolor='#DCE9E5'>
												<td colspan="3">
													<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
														<div align="center" class="Estilo1">Opciones Maestro Presupuesto de Ingresos </div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="Estilo4">

													<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
														<div align="center">
															<a href="modi_borra_ppto_ing/cambiar_codigo.php" target="_parent">
																Cambiar Cuenta
															</a>
														</div>
													</div>



												</td>
												<td class="Estilo4">
													<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
														<div align="center"><a href="modi_borra_ppto_ing/eliminar_codigo.php" target="_parent">Borrar Cuenta </a> </div>
													</div>
												</td>
												<td class="Estilo4">
													<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
														<div align="center"><a href="carga_ppto_ing.php#a" target="_parent">Nueva Cuenta </a> </div>
													</div>
												</td>
											</tr>
											<tr>
												<td width="266" class="Estilo4">
													<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
														<div align="center"><a href="equiv_pptal_ing_aa.php" target="_parent">Homologacion para Informes </a> </div>
													</div>
												</td>
												<td width="266" class="Estilo4">
													<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
														<div align="center"><a href="adi_red_pac_ing.php" target="_parent">Adicion - Reduccion P.A.C </a> </div>
													</div>
												</td>
												<td width="266" class="Estilo4">&nbsp;</td>
											</tr>
										</table>
										<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
											<div align="center">
												<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
													<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
														<div align="center"><a href='carga_ppto_ing.php' target='_parent'>VOLVER</a> </div>
													</div>
												</div>
											</div>
										</div>

										<?php
										//-------
										include('config.php');
										$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");
										$sq = "SELECT * from car_ppto_ing where id_emp = '$id' order by cod_pptal asc ";
										$re = $cx->query($sq);


										printf("
<center>

<table width='1080' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo1'>Detalle</span>
</div>
</td>
<td align='center' width='150'><span class='Estilo1'>Fecha Creacion</span></td>
<td align='center' width='50'><span class='Estilo1'>Situacion</span></td>
<td align='center' width='100'><span class='Estilo1'>Fuente</span></td>
<td align='center' width='100'><span class='Estilo1'>Vigencia</span></td>
<td align='center' width='150'><span class='Estilo1'>Cod. Pptal</span></td>
<td align='center' width='350'><span class='Estilo1'>Nombre Rubro</span></td>
<td align='center' width='30'><span class='Estilo1'>Tipo</span></td>
<td align='center' width='150'><span class='Estilo1'>Vr. Definitivo</span></td>
<td align='center' width='30'><span class='Estilo1'>&nbsp;P.A.C&nbsp;</span></td>
<td align='center' width='100'><span class='Estilo1'>&nbsp;Borrar P.A.C&nbsp;</span></td>


");

										while ($rw = $re->fetch_assoc()) {

											//****

											$cod = $rw["cod_pptal"];

											$nom_rubro = $rw["nom_rubro"];
											//****

											//****

											$resultax = $cx->query("SELECT SUM(ppto_aprob) AS TOTAL from car_ppto_ing WHERE  tip_dato ='D' and cod_pptal LIKE '$cod%'");
											$rowx = $resultax->fetch_array();
											$inicial = $rowx[0];
											//****

											$resulta = $cx->query("SELECT SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE  cod_pptal LIKE '$cod%'");
											$row = $resulta->fetch_array();
											$total_adi = $row[0];

											$resulta2 = $cx->query("SELECT SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE  cod_pptal LIKE '$cod%'");
											$row2 = $resulta2->fetch_array();
											$total_red = $row2[0];

											$resulta9 = $cx->query("SELECT SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE  cod_pptal LIKE '$cod%'");
											$row9 = $resulta9->fetch_array();
											$total_cotracred = $row9[0];

											$resulta8 = $cx->query("SELECT SUM(valor_adi) AS TOTAL from creditos_ing WHERE cod_pptal LIKE '$cod%'");
											$row8 = $resulta8->fetch_array();
											$total_cred = $row8[0];

											$definitivo = $inicial + $total_adi - $total_red + $total_cred - $total_cotracred;



											$ver3 = '';
											if ($rw["situacion"] == 'S') $ver3 = 'bgcolor=#CCFF33';
											if ($rw["tip_dato"] == 'D') {
												if ($rw["proc_rec"] == 'P') $proc = 'PROPIOS';
												if ($rw["proc_rec"] == 'R') $proc = 'REGALIAS';
												if ($rw["proc_rec"] == 'S') $proc = 'SGP';
												if ($rw["proc_rec"] == 'C') $proc = 'COLOMBIA HUMANITARIA';
												if ($rw["proc_rec"] == 'O') $proc = 'OTROS';
												if ($rw["proc_rec"] == 'A') $proc = '';
												$situa = $rw["situacion"];
												$fodo = '';
											} else {
												$proc = '';
												$situa = '';
												$fodo = 'bgcolor=#F5F5F5';
											}

											if ($rw["proc_rec"] == 'R') {
												$fodo2 = 'bgcolor=#FFCC00';
											} else {
												$fodo2 = '';
											}
											$fodo3 = '';
											$vr_df = $definitivo;
											printf(
												"
<span class='Estilo4'>
<tr $fodo>
<td align='center'>
<span class='Estilo4'>
<a href=\"ver_mas.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=900,height=590,scrollbars=yes'); return false;\">Ver Mas</a>
</span>
</td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center' $ver3><span class='Estilo4'> %s </span></td>
<td align='center' $fodo2><span class='Estilo4'> %s </span></td>
<td align='center' $fodo3><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'><a href=\"modi_nombre_cuenta.php?id=%s\"> %s </a></span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='right' class='Estilo4'>%s</td>
<td><span class='Estilo4'><a href=\"pac_ingresos.php?id1=%s\"> %s </a></span></td>
<td><span class='Estilo4'><a href=\"borra_pac.php?id2=%s\"> Borra PAC </a></span></td>
</tr>",
												$rw["cod_pptal"],
												$rw["ano"],
												$situa,
												$proc,
												$rw["vigencia"],
												$rw["cod_pptal"],
												$rw["cod_pptal"],
												$rw["nom_rubro"],
												$rw["tip_dato"],
												number_format($vr_df, 2, '.', ','),
												$rw["cod_pptal"],
												$rw["pac"],
												$rw["cod_pptal"]
											);
										}

										printf("</table></center>");
										//--------	
										?>

									</div>
								</td>
							</tr>


							<tr>
								<td>
									<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
										<div align="center">
											<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
												<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
													<div align="center"><a href='carga_ppto_ing.php' target='_parent'>VOLVER</a> </div>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>



									<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
										<div align="center">
											<span class="Estilo4">Fecha de esta Sesion:</span>
											<br />
											<span class="Estilo4">
												<strong>
													<?php include('config.php');
													$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");
													$sqlxx = "SELECT * from fecha";
													$resultadoxx = $connectionxx->query($sqlxx);

													while ($rowxx = $resultadoxx->fetch_assoc()) {
														$ano = $rowxx["ano"];
													}
													echo $ano;
													?>
												</strong>
											</span>
											<br />
											<span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"]; ?></u>
											</span>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr align="center">
					<td width="283">
						<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
							<div align="center"><?php include('config.php');
												echo $nom_emp ?><br />
								<?php echo $dir_tel ?><BR />
								<?php echo $muni ?> <br />
								<?php echo $email ?> </div>
						</div>
					</td>
					<td width="283">
						<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
							<div align="center"><a href="../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
								</a><BR />
								<a href="../condiciones.php" target="_blank">CONDICIONES DE USO </a>
							</div>
						</div>
					</td>
					<td width="283">
						<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
							<div align="center">Desarrollado por <br />
								<a href="http://www.qualisoftsalud.com" target="_blank"><img src="../ADMIN/images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
								Derechos Reservados - 2009
							</div>
						</div>
					</td>
				</tr>
			</table>
		</body>

		</html>
<?php
	} else { // si no tiene persisos de usuario
		echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
		echo "<center>Click <a href=\"user.php\">aqu&iacute; para volver</a></center>";
	}
}
?>