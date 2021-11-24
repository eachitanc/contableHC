<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	// verifico permisos del usuario
	include('config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");
	$sql = "SELECT ppto FROM usuarios2 where login = '$_SESSION[login]'";
	$res = $cx->query($sql);
	$rw = $res->fetch_assoc();
	if ($rw['ppto'] == 'SI') {
?>

		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

			<title>CONTAFACIL</title>

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

				.Estilo4 {
					font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
					font-size: 10px;
					color: #333333;
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

				.Estilo9 {
					color: #FFFFFF
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

				.Estilo9 {
					font-weight: bold
				}

				.Estilo17 {
					font-weight: bold
				}

				.Estilo19 {
					font-weight: bold
				}

				.Estilo23 {
					font-weight: bold
				}

				.Estilo25 {
					font-weight: bold
				}

				.Estilo27 {
					font-weight: bold
				}

				.Estilo28 {
					font-size: 10px
				}

				.Estilo29 {
					color: #FFFFFF
				}

				.Estilo29 {
					font-weight: bold
				}

				.Estilo30 {
					color: #FFFFFF
				}

				.Estilo30 {
					font-weight: bold
				}
			</style>

			<script>
				function validar(e) {
					tecla = (document.all) ? e.keyCode : e.which;
					if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
					patron = /\d/; //ver nota 
					te = String.fromCharCode(tecla);
					return patron.test(te);
				}
			</script>


			<script type="text/javascript">
				function habilitar(obj) {
					var hab;
					frm = obj.form;
					num = obj.selectedIndex;
					if (num == 0) {
						hab = true;
						frm.ppto_aprob.value = 0;
						frm.msj.value = '';
					} else {
						hab = false;
						frm.ppto_aprob.value = '';
						frm.msj.value = ' <-- Digite Valor APROBADO';
					}

					frm.ppto_aprob.disabled = hab;
				}
			</script>

			<script language="JavaScript">
				function cambia() {
					with(document.empresa) {
						//indice.value = String(nn.selectedIndex);
						//opcion.value = nn.options[nn.selectedIndex].text;
						cod_pptal.value = nn.options[nn.selectedIndex].value;
					}
				}
			</script>

			<script language="">
				function cursor() {

					//location.reload()
					document.empresa.cod_pptal.focus();
					var miTexto = document.empresa.cod_pptal.value;
					document.empresa.cod_pptal.value = miTexto;

				}

				// 
			</script>

			<script type="text/javascript" language="JavaScript1.2" src="menu/stmenu.js"></script>



		</head>
		<!-- <body onLoad=cursor()>  -->

		<body onload="cursor()">
			<table width="750" border="0" align="center">
				<tr>

					<td width="750" colspan="3">
						<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
							<div align="center"><img src="../ADMIN/images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
						</div>
					</td>
				</tr>


				<tr>

					<td colspan="3">

						<form name="empresa" method="post" action="proc_carga_ppto_ing.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">
							<table width="750" border="0">
								<tr>
									<td>
										<table width="750" border="1" align="center" class="bordepunteado1">

											<tr>
												<td valign="top" bgcolor="#DCE9E5">
													<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
														<div align="center"><strong class="Estilo4">PRESUPUESTO DE INGRESOS </strong><br />
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>
													<div style="padding-left:20px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
														<script type="text/javascript" language="JavaScript1.2" src="menu/menu_ppto_ing.js"></script>
													</div>
												</td>
											</tr>
											<tr>
												<td valign="top">
													<div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
														<div align="center">
															<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
																<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
																	<div align="center"><a href='user.php' target='_parent'>VOLVER AL INICIO </a> </div>
																</div>
															</div>
														</div>
													</div>
												</td>
											</tr>
										</table>
										<br /><a name="a" id="a"></a>
										<table width="750" border="1" align="center" class="bordepunteado1">
											<tr>
												<td colspan="3" class="Estilo4" bgcolor='#DCE9E5'>
													<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
														<CENTER>
															<span class="Estilo4"><strong>CARGAR PRESUPUESTO DE INGRESOS</strong></span>
															<span style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;"></span>
														</CENTER>
													</div>
													</div>
												</td>
											</tr>

											<tr>
												<td bgcolor="#EBEBE4" class="Estilo4">
													<div id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
														<div align="center"><strong>FECHA DE INICIO DE OPERACIONES DE LA ACTUAL VIGENCIA </strong>(aaaa/mm/dd)</div>
													</div>
												</td>
												<td colspan="2" valign="middle" bgcolor="#EBEBE4" class="Estilo4">
													<div id="div2" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
														<div align="center">
															<?php
															//-------
															include('config.php');
															$connection = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
															$s = "SELECT * FROM fecha_ini_op";
															$r = $connection->query($s);
															while ($rw = $r->fetch_assoc()) {
																printf("<center class='Estilo4'><b>%s</b><center>", $rw["fecha_ini_op"]);
																$fecha_ini_op = $rw["fecha_ini_op"];
															}

															//--------	
															?>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="Estilo4">
													<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
														<div align="right">
															<?php
															include('config.php');
															$connection = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
															$sql = "select * from fecha";
															$resultado = $connection->query($sql);
															while ($row = $resultado->fetch_assoc()) {
																printf("<input name='ano' type='hidden' id='ano' value='%s' size='10'/><input name='id_emp' type='hidden' id='id_emp' value='%s' size='4'/>", $fecha_ini_op, $row["id_emp"]);
															}
															?>

															<?php
															include('config.php');
															$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
															$sqlxx = "select * from fecha";
															$resultadoxx = $connectionxx->query($sqlxx);

															while ($rowxx = $resultadoxx->fetch_assoc()) {

																$idxx = $rowxx["id_emp"];
																//printf("<span class='Estilo4'><b>Fecha de Trabajo ACTUAL = DIA: %s / MES: %s / A&Ntilde;O: %s </b></span><BR><span class='Estilo4'><b>Id Empresa ACTUAL = %s </b></span>", $row["dia"], $row["mes"], $row["ano"], $row["id_emp"]);  
															}
															?>
															<strong>CUENTAS CARGADAS HASTA LA FECHA</strong><br />
														</div>
													</div>
												</td>
												<td colspan="2" valign="middle" class="Estilo4">
													<div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

														<div align="left">
															<select name="nn" onchange="cambia()" class="Estilo4" style="width: 400px;">
																<?php
																include('config.php');
																$db = new mysqli($server, $dbuser, $dbpass, $database);
																$strSQL = "SELECT * FROM car_ppto_ing WHERE id_emp = '$idxx' ORDER BY cod_pptal";
																$rs = $db->query($strSQL);
																//$nr = $rs->fetch_assoc();
																while ($r = $rs->fetch_assoc()) {
																	echo "<OPTION VALUE=\"" . $r["cod_pptal"] . "\">" . $r["cod_pptal"] . " - " . $r["nom_rubro"] . "</b></OPTION>";
																}
																?>
															</select>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td bgcolor="#EBEBE4" class="Estilo4">
													<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
														<div align="right"><span class="Estilo17">CODIGO PRESUPUESTAL : </span><br />
															<span class="Estilo4">(Carga el Ultimo Codigo Digitado)</span>
														</div>
													</div>
												</td>
												<td width="454" colspan="2" bgcolor="#EBEBE4" class="Estilo4">
													<div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

														<div align="left">
															<!--muestro el ultimo cod_pptal almacenado-->

															<?php
															$sql = "SELECT * FROM tmp_cod_pptal";
															$consulta = $connection->query($sql);
															while ($row = $consulta->fetch_assoc()) {
																$tmp_cod_pptal = $row["cod"];
															}  ?>

															<input name="cod_pptal" type="text" class="Estilo7" id="cod_pptal" tabindex="0" value="<?php echo $tmp_cod_pptal; ?>" onkeyup="
var options = this.form.nn.options;for(var i = 0; i < options.length; i++){var match = options[i].value == this.value;if(match)break;}this.form.nn.selectedIndex = i;cambia();" size="40" maxlength="35" />
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="Estilo4">
													<div class="Estilo17" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
														<div align="right">NOMBRE DEL RUBRO : </div>
													</div>
												</td>
												<td colspan="2" class="Estilo4">
													<div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

														<div align="left">
															<input name="nom_rubro" type="text" class="Estilo7" id="nom_rubro" tabindex="0" onkeyup="empresa.nom_rubro.value=empresa.nom_rubro.value.toUpperCase();" size="50" maxlength="200" />
															<span class="Estilo9">..</span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td bordercolor="#EBEBE4" bgcolor="#EBEBE4" class="Estilo4">
													<div class="Estilo19" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
														<div align="right">TIPO DE CUENTA : </div>
													</div>
												</td>
												<td colspan="2" bordercolor="#EBEBE4" bgcolor="#EBEBE4" class="Estilo4">
													<div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

														<div align="left">
															<select name="selecprod" class="Estilo4" id="selecprod" onchange="habilitar(this)">
																<option value="M" nombre="M">Mayor - M </option>
																<option value="D" nombre="D">Detalle - D</option>
															</select>
															<input name="tipo_dato" type="hidden" class="Estilo4" id="tipo_dato" size="2" maxlength="2" />
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="Estilo4">
													<div class="Estilo23" id="main_div" style="padding-left:15px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
														<div align="right">PRESUPUESTO APROBADO : </div>
													</div>
												</td>
												<td colspan="2" class="Estilo4">
													<div id="main_div" style="padding-left:19px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
														<div align="left">
															<?php
															$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
															$s = "SELECT * FROM fecha";
															$r = $connectionxx->query($s);
															while ($rw = $r->fetch_assoc()) {
																$fecha_sesion = $rw["ano"];
															}

															$ss = "SELECT * FROM fecha_ini_op";
															$rs = $connectionxx->query($ss);
															while ($rws = ($rs->fetch_assoc())) {
																$fecha_ini_op = $rws["fecha_ini_op"];
															}
															?>
															<?php
															if ($fecha_sesion == $fecha_ini_op) {
															?>
																$
																<input name="ppto_aprob" type="text" class="Estilo4" id="ppto_aprob" onkeypress="return validar(event)" value="0" size="20" maxlength="20" disabled="disabled" />

																=
																<input name="msj" type="text" disabled="disabled" class="Estilo4" style="border:0px" size="40" />
															<?php } else {

																//		  printf("NADA");

															}
															?>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td bgcolor="#EBEBE4" class="Estilo4">
													<div class="Estilo25" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
														<div align="right">PROCEDENCIA DEL RECURSO : </div>
													</div>
												</td>
												<td colspan="2" bgcolor="#EBEBE4" class="Estilo4">
													<div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

														<div align="left">
															<select name="proc_rec" class="Estilo4" id="proc_rec">
																<option value="P">Propio</option>
																<option value="A">Administrado</option>
															</select>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="Estilo4">
													<div class="Estilo27" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:15px; padding-bottom:3px;">
														<div align="right">CON / SIN Situacion : </div>
													</div>
												</td>
												<td colspan="2" class="Estilo4">
													<div id="main_div" style="padding-left:30px; padding-top:5px; padding-right:3px; padding-bottom:3px;">

														<div align="left">
															<select name="situacion" class="Estilo4" id="situacion">
																<option value="C">Con Situacion</option>
																<option value="S">Sin Situacion</option>
															</select>
														</div>
													</div>
												</td>
											</tr>


											<tr>
												<td colspan="3" class="Estilo4">
													<div style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;" align="center">
														<input name="grabar" type="submit" class="Estilo4" id="grabar" value="Grabar" />
														<span class="Estilo29">:::</span>
														<input name="cancelar" type="reset" class="Estilo4" id="cancelar" value="Cancelar" />
													</div>
												</td>
											</tr>
										</table>
										<br />

										<table width="750" border="1" align="center" class="bordepunteado1">
											<tr class="bordepunteado1">
												<td colspan="2" valign="top" bgcolor="#DCE9E5">
													<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
														<div align="center" class="Estilo4">
															<div align="center"><span class="Estilo1 Estilo28">OPCIONES ADICIONALES CARGA INICIAL</span></div>
														</div>
													</div>
												</td>
											</tr>
											<tr class="bordepunteado1">
												<td width="375" valign="middle">
													<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
														<div align="center"><span class="Estilo4">Cargar Presupuesto de Ingresos <br />desde Plantilla MS&reg; Excel&reg; </span><br />
														</div>
													</div>
												</td>
												<td valign="top" width="365">
													<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
														<div align="center"><span class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">CARGANDO PRESUPUESTO A :<br />
																<?php
																//-------
																include('config.php');
																$connectionx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
																$sqlx = "SELECT * FROM empresa where cod_emp = '$idxx'";
																$resultadox = $connectionx->query($sqlx);

																while ($rowx = $resultadox->fetch_assoc()) {
																	echo "<span class='Estilo4'><b>".$rowx["raz_soc"]."</b></span>";
																}
																//--------	
																?>
															</span><br />
														</div>
													</div>
												</td>
											</tr>
											<tr class="bordepunteado1">
												<td colspan="2">
													<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
														<div align="center"> <span class="Estilo4">Fecha de esta Sesion:</span> <br />
															<span class="Estilo4"> <strong>
																	<?php include('config.php');
																	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
																	$sqlxx = "SELECT * FROM fecha";
																	$resultadoxx = $connectionxx->query($sqlxx);

																	while ($rowxx = $resultadoxx->fetch_assoc()) {
																		$ano = $rowxx["ano"];
																	}
																	echo $ano;
																	?>
																</strong> </span> <br />
															<span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"]; ?></u> </span>
														</div>
													</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
				<tr>
					<td width="250">
						<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
							<div align="center"><?php include('config.php');
												echo $nom_emp ?><br />
								<?php echo $dir_tel ?><BR />
								<?php echo $muni ?> <br />
								<?php echo $email ?> </div>
						</div>
					</td>
					<td width="250">
						<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
							<div align="center"><a href="../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
								</a><BR />
								<a href="../condiciones.php" target="_blank">CONDICIONES DE USO </a>
							</div>
						</div>
					</td>
					<td width="250">
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