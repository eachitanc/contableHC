<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	// verifico permisos del usuario
	include('../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");

	$sql = "SELECT ppto FROM usuarios2 where login = '$_SESSION[login]'";
	$res = $cx->query($sql);;
	$rw = $res->fetch_assoc();
	if ($rw['ppto'] == 'SI') {

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

				.Estilo8 {
					color: #FFFFFF
				}

				.Estilo9 {
					color: #990000;
					font-weight: bold;
				}
			</style>
			<!--muestra - oculta naturales -->
			<SCRIPT language="javascript">
				function MostrarOcultar(objetoVisualizar) {


					if (document.all['naturales'].style.display == 'none') {
						document.all['naturales'].style.display = 'block';
						document.a.ter_nat.disabled = false;
						document.all['juridicos'].style.display = 'none';
						document.a.ter_jur.disabled = true;
					} else {
						document.a.ter_nat.disabled = true;
						document.a.ter_jur.disabled = true;
						document.all['naturales'].style.display = 'none';
						document.all['juridicos'].style.display = 'none';
					}



				}
			</SCRIPT>
			<!--muestra - oculta juridicos -->
			<SCRIPT language="javascript">
				function MostrarOcultar2(objetoVisualizar) {

					if (document.all['juridicos'].style.display == 'none') {
						document.all['naturales'].style.display = 'none';
						document.a.ter_nat.disabled = true;
						document.all['juridicos'].style.display = 'block';
						document.a.ter_jur.disabled = false;
					} else {
						document.a.ter_nat.disabled = true;
						document.a.ter_jur.disabled = true;
						document.all['naturales'].style.display = 'none';
						document.all['juridicos'].style.display = 'none';
					}



				}
			</SCRIPT>


			<script>
				function validar(e) {
					tecla = (document.all) ? e.keyCode : e.which;
					if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
					patron = /\d/; //ver nota 
					te = String.fromCharCode(tecla);
					return patron.test(te);
				}
			</script>

			<!--validacion de forms-->
			<script src="../jquery.js"></script>
			<script type="text/javascript" src="../jquery.validate.js"></script>
			<style type="text/css">
				* {
					font-family: Verdana;
					font-size: 10px;
				}

				label {
					width: 10em;
					float: left;
				}

				label.error {
					float: none;
					color: red;
					padding-left: .5em;
					vertical-align: top;
				}

				p {
					clear: both;
				}

				.submit {
					margin-left: 12em;
				}

				em {
					font-weight: bold;
					padding-right: 1em;
					vertical-align: top;
				}

				.Estilo10 {
					color: #990000;
					font-style: italic;
				}
			</style>

			<script>
				$(document).ready(function() {
					$("#commentForm").validate();
				});
			</script>

			<script>
				function chk_reip() {
					var pos_url = '../comprobadores/comprueba_reip.php';
					var cod = document.getElementById('id_manu_reip').value;
					var req = new XMLHttpRequest();
					if (req) {
						req.onreadystatechange = function() {
							if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
								document.getElementById('res_reip').innerHTML = req.responseText;
							}
						}
						req.open('GET', pos_url + '?cod=' + cod, true);
						req.send(null);
					}
				}

				function consecutivo2() {
					var fec = document.getElementById('fecha_reg').value;
					var pos_url2 = 'consultas/concec_reip.php';
					var req1 = new XMLHttpRequest();
					if (req1) {
						req1.onreadystatechange = function() {
							if (req1.readyState == 4) {
								var dato = req1.responseText;
								var elem = dato.split(',');
								concec = elem[0];
								fecha2 = elem[1];
								document.getElementById('id_manu_reip').value = concec;
								if (fec != fecha2) {
									alert("Fecha sugerida para el consecutivo disponible: " + fecha2);
								}
							}
						}
						req1.open('POST', pos_url2 + '?cod=' + fec, false);
						req1.send(null);
					}

				}
			</script>



			<script type="text/javascript">
				function mostrarVentana() {
					var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
					var x = screen.width;
					ventana.style.marginTop = "200px"; // Definimos su posici�n vertical. La ponemos fija para simplificar el c�digo
					ventana.style.marginLeft = x - 300; //((document.body.clientWidth-10) / 2) +  "px"; // Definimos su posici�n horizontal
					ventana.style.display = 'block'; // Y lo hacemos visible
					parent.frames['datamain'].window.location.reload();

				}

				function ocultarVentana() {
					var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
					ventana.style.display = 'none'; // Y lo hacemos invisible
				}
			</script>
			<!--fin val forms-->

			<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
			</LINK>

			<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
			<style type="text/css">
				.Estilo11 {
					color: #F5F5F5
				}
			</style>
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
						<div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
							<div align="center" class="Estilo4"><strong>MOVIMIENTOS - EJECUCION PRESUPUESTO DE INGRESOS </strong></div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
							<form method="post" action="mvto.php">
								<table width="800" border="0" align="center">
									<tr>
										<td width="600"><?php
														include('../config.php');
														$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
														$sqlxx = "select * from fecha";
														$resultadoxx = $connectionxx->query($sqlxx);

														while ($rowxx = $resultadoxx->fetch_assoc()) {

															$idxx = $rowxx["id_emp"];
														}
														?>
											<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
												<div align="center"><span class="Estilo4"><strong>Seleccione el Documento Fuente </strong>: </span>
													<select name="nn" class="Estilo4" style="width: 350px;">
														<?php
														include('../config.php');
														$db = new mysqli($server, $dbuser, $dbpass, $database);

														$strSQL = "SELECT * FROM dctos_fuente_comprobantes  WHERE id_emp = '$idxx' AND ppto_ing = 'SI' ";
														$rs = $db->query($strSQL);
														while ($r = $rs->fetch_assoc()) {
															echo "<OPTION VALUE=\"" . $r["cod"] . "\">" . $r["cod"] . " - " . $r["nombre"] . "</b></OPTION>";
														}
														$sq3 = "select cargo from usuarios2 where login = '$_SESSION[login]'";
														$re3 = $connectionxx->query($sq3);
														$rw3 = $re3->fetch_assoc();
														if ($rw3['cargo'] == "REVISOR") {

															$ver_boton = "style=display:none";
														} else {
															$ver_boton = '';
														}
														?>
													</select>
												</div>
											</div>
										</td>
										<td width="190">
											<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
												<div align="center">
													<input name="Submit" type="submit" class="Estilo4" value="Seleccionar Documento" />
												</div>
											</div>
										</td>
									</tr>
								</table>
							</form>

							<div align="center">



								<?php

								$archivo = "mvto.php";
								$a = isset($_POST['nn']) ? $_POST['nn'] : '';
								$f = '';

								if ($a == 'REIP') {
								?>

									<table>
										<tr>
											<td>


												<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
													<div align="center">

														<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
															<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
																<div align="center"><a href='mvto_reg.php' target='_parent'>..:: NUEVO ::.. </a> </div>
															</div>
														</div>
													</div>
												</div>


											</td>


										</tr>
									</table>


									<br />
									<form id="commentForm" name="a" method="post">
										<br />
									</form>
									<BR />

									<div>
										<?php
										include('../objetos/filtro.php');
										?>
									</div>
									<?php
									if ($pendiente == "") {
									} else {
									?>
										<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
											<div align="center"><strong>RECONOCIMIENTOS ALMACENADOS HASTA LA FECHA
												</strong> <span class="Estilo9">&quot;SIN CONTABILIZAR &quot; </span><br /><BR />
												<a href="../mvto_contable/menu_cont.php" target="_parent">...::: IR A CONTABILIDAD :::...</a>
											</div>
										</div>
										<BR />


			</table>


			<?php
										//-------


										include('../config.php');
										$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

										if (isset($_POST["buscar"])) {
											$filtro = "and (id_manu_reip LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
										} else {
											$filtro = '';
										}


										$a = "select distinct(consecutivo) , fecha_reg, tercero, id_manu_reip, consecutivo from reip_ing where id_emp = '$idxx' and contab ='NO' and liq1=''";
										if (empty($tercero)) {
											$c = "";
										} else {
											$c = "and tercero =$tercero2";
										}
										if ($fecha2 == "MES") {
											$f = "and fecha_reg between '$f1' and '$f2'";
										}
										if ($fecha2 == "DIA") {
											$f = "and fecha_reg ='$fechafil'";
										}
										if ($fecha2 == "AÑO") {
											$f = "and fecha_reg between '$a1' and '$a2'";
										}
										$gby = "group by consecutivo";
										$orden = "order by fecha_reg  asc";
										$sq = "$a $c $filtro $f $gby $orden";

										$re = $cx->query($sq);

			?>

			<table width='80%' BORDER='1' class='bordepunteado1' align="center">
				<tr bgcolor='#DCE9E5'>
					<td align='center' width='15%'>
						FECHA
					</td>
					<td align='center' width='15%'>
						CONCECUTIVO
					</td>
					<td align='center' width='42%'>
						TERCERO
					</td>
					<td align='center' width='15%'>
						VALOR
					</td>
					<td align='center' width='4%'>

					</td>
					<td align='center' width='4%'>

					</td>
					<td align='center' width='4%'>

					</td>
					<td align='center' width='4%'>

					</td>
				</tr>

				<?php

										while ($rw = $re->fetch_assoc()) {
											$fecha_reg = $rw["fecha_reg"];
											$num = $rw["id_manu_reip"];
											$tercero = $rw["tercero"];
											$concec = $rw["consecutivo"];
				?>
					<tr>
						<td align='center'>
							<?php print($fecha_reg); ?>
						</td>
						<td align='center'>
							<?php print($num); ?>
						</td>
						<td align='left'>
							<?php print($tercero); ?>
						</td>
						<td align='right' style="Padding-right:10px">

							<?php
											$resulta2 = $cx->query("select SUM(valor) AS TOTAL from reip_ing WHERE consecutivo = '$concec'");
											$row2 = $resulta2->fetch_array();
											$total2 = $row2[0];
											print(number_format($total2, 2, ",", "."));

							?>

						</td>
						<td align='center'>
							<?php print "<a href='confirma_modificar_mvto.php?consecutivo=$concec'> <img $ver_boton src='../simbolos/modificarblanco.png' border='0' width='18px' title='Modificar'  /></a>"; ?>
						</td>
						<td align='center'>
							<?php print "<a href='confirma_borra_mvto.php?consecutivo=$concec'> <img $ver_boton src='../simbolos/eliminarblanco.png' border='0' width='18px' title='Eliminar'/></a>"; ?>
						</td>
						<td align='center'>
							<?php print "<a href='imp_reip.php?consecutivo=$concec' target='_blank'> <img src='../simbolos/imprimirblanco.png' border='0' width='18px' /></a>"; ?>
						</td>
						<td align='center'>
							<?php print "<a href='hisreip.php?consecutivo=$concec'> <img $ver_boton src='../simbolos/historiablanco.png' border='0' width='18px' title='Reversar' /></a>"; ?>
						</td>

					</tr>

				<?php
										}


				?>
			</table>


		<?php
									}
									if (!isset($registrado)) {
									} else {

		?>

			<BR />
			<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
				<div align="center"><strong>RECONOCIMIENTOS ALMACENADOS HASTA LA FECHA
					</strong> <span class="Estilo9">&quot;CONTABILIZADOS &quot; </span><br />
					Si desea modificar un Reconocimiento Contabilizado, <br />
					este debera ser eliminado del modulo Movimientos - Opcion 4.1 del Menu Principal </div>
			</div>
			<BR />

			<?php
										//-------
										include('../config.php');
										$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

										if (isset($_POST["buscar"])) {
											$filtro = "and (id_manu_reip LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%') ";
										} else {
											$filtro = '';
										}


										$a = "select consecutivo, fecha_reg,tercero, id_manu_reip,consecutivo from reip_ing where contab ='SI' and liq1=''";
										if (empty($tercero)) {
											$c = "";
										} else {
											$c = "and tercero =$tercero2";
										}
										if ($fecha2 == "MES") {
											$f = "and fecha_reg between '$f1' and '$f2'";
										}
										if ($fecha2 == "DIA") {
											$f = "and fecha_reg ='$fechafil'";
										}
										if ($fecha2 == "AÑO") {
											$f = "and fecha_reg between '$a1' and '$a2'";
										}
										$gby = "group by consecutivo";
										$orden = "order by fecha_reg  asc";
										$sq2 = "$a  $filtro $f $gby $orden";


										$re2 = $cx->query($sq2);

			?>

			<table width='100%%' BORDER='1' class='bordepunteado1' align="center">
				<tr bgcolor='#DCE9E5'>
					<td align='center' width='10%'>
						FECHA
					</td>
					<td align='center' width='15%'>
						CONCECUTIVO
					</td>
					<td align='center' width='54%'>
						TERCERO
					</td>
					<td align='center' width='15%'>
						VALOR
					</td>
					<td align='center' width='3%'>

					</td>
					<td align='center' width='3%'>

					</td>
				</tr>

				<?php

										while ($rw2 = $re2->fetch_assoc()) {
											$fecha_reg = $rw2["fecha_reg"];
											$num = $rw2["id_manu_reip"];
											$tercero = $rw2["tercero"];
											$concec2 = $rw2["consecutivo"];
				?>
					<tr>
						<td align='center'>
							<?php print($fecha_reg); ?>
						</td>
						<td align='center'>
							<?php print($num); ?>
						</td>
						<td align='left'>
							<?php print($tercero); ?>
						</td>
						<td align='right' style="Padding-right:10px">

							<?php
											$resulta2 = $cx->query("select SUM(valor) AS TOTAL from reip_ing WHERE consecutivo = '$concec2' ");
											$row2 = $resulta2->fetch_array();
											$total2 = $row2[0];
											print(number_format($total2, 2, ",", "."));

							?>

						</td>

						<td align='center'>
							<?php print "<a href='imp_reip.php?consecutivo=$concec2' target='_blank'> <img src='../simbolos/imprimirblanco.png' border='0' width='18px' /></a>"; ?>
						</td>
						<td align='center'>
							<?php print "<a href='hisreip.php?consecutivo=$concec2'> <img src='../simbolos/historiablanco.png' border='0' width='18px' title='Reversar' /></a>"; ?>
						</td>

					</tr>

				<?php
										}

				?>
			</table>




	<?php
									}
								}
	?>
	</div>
	</div>
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