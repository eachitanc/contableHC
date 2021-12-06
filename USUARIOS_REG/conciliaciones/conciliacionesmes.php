<?php
set_time_limit(600);
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	// verifico permisos del usuario
	include('../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");

	$sql = "SELECT conta FROM usuarios2 where login = '$_SESSION[login]'";
	$res = $cx->query($sql);
	$rw = $res->fetch_assoc();
	if ($rw['conta'] == 'SI') {


?>

		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<title>CONTAFACIL</title>


			<style type="text/css">
				.Estilo2 {
					font-size: 9px
				}

				.Estilo4 {
					font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
					font-size: 10px;
					color: #333333;
				}

				a {
					font-family: Verdana, Arial, Helvetica, sans-serif;
					font-size: 11px;
					color: #666666;
				}

				a:link {
					text-decoration: none;
				}

				a:visited {
					text-decoration: none;
					color: #666666;
				}

				a:hover {
					text-decoration: underline;
					color: #666666;
				}

				a:active {
					text-decoration: none;
					color: #666666;
				}

				.Estilo7 {
					font-family: Verdana, Arial, Helvetica, sans-serif;
					font-size: 9px;
					color: #666666;
				}

				.Estilo8 {
					color: #FFFFFF
				}
			</style>

			<style>
				.fc_main {
					background: #FFFFFF;
					border: 1px solid #000000;
					font-family: Verdana;
					font-size: 10px;
				}

				.fc_date {
					border: 1px solid #D9D9D9;
					cursor: pointer;
					font-size: 10px;
					text-align: center;
				}

				.fc_dateHover,
				TD.fc_date:hover {
					cursor: pointer;
					border-top: 1px solid #FFFFFF;
					border-left: 1px solid #FFFFFF;
					border-right: 1px solid #999999;
					border-bottom: 1px solid #999999;
					background: #E7E7E7;
					font-size: 10px;
					text-align: center;
				}

				.fc_wk {
					font-family: Verdana;
					font-size: 10px;
					text-align: center;
				}

				.fc_wknd {
					color: #FF0000;
					font-weight: bold;
					font-size: 10px;
					text-align: center;
				}

				.fc_head {
					background: #000066;
					color: #FFFFFF;
					font-weight: bold;
					text-align: left;
					font-size: 11px;
				}
			</style>
			<style type="text/css">
				table.bordepunteado1 {
					border-style: solid;
					border-collapse: collapse;
					border-width: 2px;
					border-color: #004080;
				}
			</style>
			<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
			</LINK>

			<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

			<script>
				function validar(e) {
					tecla = (document.all) ? e.keyCode : e.which;
					if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
					patron = /\d/; //ver nota 
					te = String.fromCharCode(tecla);
					return patron.test(te);
				}
			</script>



			<style type="text/css">
				.Estilo9 {
					color: #990000
				}
			</style>


			<script>
				function chk_pgcp1() {
					var pos_url = 'comprueba_cta.php';
					var cod = document.getElementById('cod_ini').value;
					var req = new XMLHttpRequest();
					if (req) {
						req.onreadystatechange = function() {
							if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
								document.getElementById('resultado').innerHTML = req.responseText;
							}
						}
						req.open('GET', pos_url + '?cod=' + cod, true);
						req.send(null);
					}
				}
			</script>

			<script>
				function chk_pgcp2() {
					var pos_url = 'comprueba_cta2.php';
					var cod = document.getElementById('cod_fin').value;
					var req = new XMLHttpRequest();
					if (req) {
						req.onreadystatechange = function() {
							if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
								document.getElementById('resultado2').innerHTML = req.responseText;
							}
						}
						req.open('GET', pos_url + '?cod=' + cod, true);
						req.send(null);
					}
				}
			</script>

		</head>

		<body>
			<table width="800" border="0" align="center">
				<tr>

					<td colspan="3">
						<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
							<div align="center">
								<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
							</div>
						</div>
					</td>
				</tr>

				<tr>
					<td colspan="3">
						<?php
						include('../config.php');

						//**** variables para generacion dinamica

						$base = $database;
						$conexion = new mysqli($server, $dbuser, $dbpass, $database);

						$sqlxx = "select * from fecha";
						$resultadoxx = $conexion->query($sqlxx);
						while ($rowxx = $resultadoxx->fetch_assoc()) {
							$idxx = $rowxx["id_emp"];
							$id_emp = $rowxx["id_emp"];
						}

						//**********************

						$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
						$sqlxx = "select * from fecha";
						$resultadoxx = $connectionxx->query($sqlxx);

						while ($rowxx = $resultadoxx->fetch_assoc()) {

							$idxx = $rowxx["id_emp"];
							$id_emp = $rowxx["id_emp"];
							$ano = $rowxx["ano"];
						}

						$sqlxx3 = "select * from fecha_ini_op";
						$resultadoxx3 = $connectionxx->query($sqlxx3);

						while ($rowxx3 = $resultadoxx3->fetch_assoc()) {
							$desde = $rowxx3["fecha_ini_op"];
						}



						//**** variables para generacion dinamica
						$base = $database;
						$conexion = new mysqli($server, $dbuser, $dbpass, $database);


						?>
						<center>
							<form name="a" method="post">
								<table width="600" border="1" align="center" class="bordepunteado1">
									<tr>
										<td colspan="2" bgcolor="#DCE9E5">
											<div class="Estilo5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
												<div align="center" class="Estilo4"><b>CONCILIACIONES POR MES </b></div>
											</div>
										</td>
									</tr>






									<tr>
										<td colspan="2">
											<div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
												<div align="center"><strong>CODIGO DE INICIO DEL P.G.C.P </strong><strong> : </strong></div>
											</div>
										</td>
									</tr>

									<tr>
										<td colspan="2">
											<div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
												<div align="center">
													<select name="cod_ini" class="Estilo4" id="cod_ini" style="width: 400px;">
														<?php
														include('../config.php');
														$db = new mysqli($server, $dbuser, $dbpass, $database);

														$strSQL = "SELECT * FROM pgcp WHERE id_emp = '$idxx' AND cod_pptal like '1110%' ORDER BY cod_pptal";
														$rs = $db->query($strSQL);
														while ($r = $rs->fetch_assoc()) {
															echo "<OPTION VALUE=\"" . $r["cod_pptal"] . "\">" . $r["cod_pptal"] . " - " . $r["nom_rubro"] . "</b></OPTION>";
														}
														?>
													</select>
												</div>
											</div>
										</td>
									</tr>



									<td colspan="2">
										<div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
											<div align="center"><strong>CODIGO FINAL DEL P.G.C.P </strong><strong> : </strong></div>
										</div>
									</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
							<div align="center">
								<select name="cod_fin" class="Estilo4" id="cod_fin" style="width: 400px;">
									<?php
									include('../config.php');
									$db = new mysqli($server, $dbuser, $dbpass, $database);

									$strSQL1 = "SELECT MAX(cod_pptal) FROM pgcp WHERE cod_pptal like '1110%'";
									$rs = $db->query($strSQL1);
									while ($r = $rs->fetch_array()) {
										$ulpgcp = $r[0];
									}

									$strSQL = "SELECT * FROM pgcp WHERE id_emp = '$idxx' AND cod_pptal like '1110%' ORDER BY cod_pptal";
									$rs = $db->query($strSQL);
									while ($r = $rs->fetch_assoc()) {
										if ($r["cod_pptal"] == $ulpgcp)
											echo "<OPTION VALUE=\"" . $r["cod_pptal"] . "\" selected>" . $r["cod_pptal"] . " - " . $r["nom_rubro"] . "</b></OPTION>";
										else
											echo "<OPTION VALUE=\"" . $r["cod_pptal"] . "\">" . $r["cod_pptal"] . " - " . $r["nom_rubro"] . "</b></OPTION>";
									}
									?>
								</select>
							</div>
						</div>
					</td>
				</tr>






				<tr>
					<td>
						<div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
							<div align="right"><strong>SELECCIONE MES O PERIODO DE REPORTE : </strong></div>
						</div>
					</td>
					<td>
						<div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">

							<div align="center">
								<?php
								include('../config.php');
								$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
								$sqlxx = "select * from fecha";
								$resultadoxx = $connectionxx->query($sqlxx);

								while ($rowxx = $resultadoxx->fetch_assoc()) {
									$ano = $rowxx["ano"];
								}
								$anio = substr($ano, 0, 4);

								?>
								<select name="mes" class="Estilo4" id="mes">
									<option value="<?php printf("$anio/01/31"); ?>">ENERO </option>
									<option value="<?php printf("$anio/02/28"); ?>">FEBRERO </option>
									<option value="<?php printf("$anio/03/31"); ?>">MARZO </option>
									<option value="<?php printf("$anio/04/30"); ?>">ABRIL </option>
									<option value="<?php printf("$anio/05/31"); ?>">MAYO </option>
									<option value="<?php printf("$anio/06/30"); ?>">JUNIO </option>
									<option value="<?php printf("$anio/07/31"); ?>">JULIO </option>
									<option value="<?php printf("$anio/08/31"); ?>">AGOSTO </option>
									<option value="<?php printf("$anio/09/30"); ?>">SEPTIEMBRE </option>
									<option value="<?php printf("$anio/10/31"); ?>">OCTUBRE </option>
									<option value="<?php printf("$anio/11/30"); ?>">NOVIEMBRE </option>
									<option value="<?php printf("$anio/12/31"); ?>">DICIEMBRE </option>
								</select>
								<br />
							</div>
						</div>
					</td>
				</tr>



				<tr>




				<tr>
					<td colspan="2">
						<div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
							<div align="center">
								<div align="center">
									<input name="Submit322" type="submit" class="Estilo4" value="Generar Consulta" onclick="this.form.action = 'aa1.php'" />
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
			</form>
			</center>
			</td>
			</tr>
			<tr>
				<td colspan="3">
					<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
						<div align="center">
							<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
								<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
									<div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center"> <span class="Estilo4">Fecha de esta Sesion:</span> <br />
							<span class="Estilo4"> <strong>
									<?php include('../config.php');
									$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
									$sqlxx = "select * from fecha";
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
			<tr>
				<td width="266">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
						<div align="center"><?php include('../config.php');
											echo $nom_emp ?><br />
							<?php echo $dir_tel ?><BR />
							<?php echo $muni ?> <br />
							<?php echo $email ?> </div>
					</div>
				</td>
				<td width="266">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
						<div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
							</a><BR />
							<a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a>
						</div>
					</div>
				</td>
				<td width="266">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
						<div align="center">Desarrollado por <br />
							<a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
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
		echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
	}
}
?>