<?php
set_time_limit(1800);
session_start();
?>
<html>

<head>
	<title>CONTAFACIL ...::: Informe por terceros :::...</title>

	<script language="">
		<!--
		//function cursor(){document.login.login.focus();}
		// 
		-->
	</script>

	<script language="JavaScript" type="text/javascript" src="javas.js"></script>
	<script type="text/javascript">
		function validar(e) {
			tecla = (document.all) ? e.keyCode : e.which;
			if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
			patron = /\d/; //ver nota 
			te = String.fromCharCode(tecla);
			return patron.test(te);
		}
	</script>



	<style type="text/css">
		<!--
		.Estilo1 {
			font-family: Verdana, Arial, Helvetica, sans-serif
		}

		.Estilo2 {
			font-size: 9px
		}

		.Estilo4 {
			color: #666666
		}

		.Estilo5 {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			color: #000000;
			font-size: 12px;
			font-weight: bold;
		}

		.Estilo7 {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			font-weight: bold;
		}

		a:link {
			text-decoration: none;
			color: #0000FF;
		}

		a:visited {
			text-decoration: none;
			color: #0000FF;
		}

		a:hover {
			text-decoration: underline;
			color: #0000FF;
		}

		a:active {
			text-decoration: none;
			color: #0000FF;
		}

		.Estilo8 {
			font-size: 12px;
			font-family: Verdana;
		}

		.Estilo11 {
			color: #CC0000
		}

		a {
			font-family: Verdana;
			font-size: 9px;
		}

		.Estilo12 {
			font-size: 10px
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
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php				// verifico permisos del usuario
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");

$sql = "SELECT teso FROM usuarios2 where login = '$_SESSION[login]'";
$res = $cx->query($sql);
$rw = $res->fetch_assoc();
if ($rw['teso'] == 'SI') {

?>

	<body>

		<table width="600" border="1" align="center" class="bordepunteado1">
			<tr>
				<td colspan="3">
					<div align="center"><img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100"></div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
						<div align="center" class="Estilo5">Generar certificado de ingresos<BR>
							<BR><br>
						</div>
						<div align="center" class="Estilo8 "></div>
					</div>
				</td>
			</tr>

			<tr>
				<td colspan="3">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:15px; padding-right:3px; padding-bottom:5px;">
						<div align="center">


							<table border="0" cellspacing="0" cellpadding="2">
								<form action="certifi.php" method="POST" class="miform" name="tercero">
									<tr>
										<td>
											<div id="main_div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
												<div align="right"><span class="Estilo5">No documento:</span> </div>
											</div>
										</td>
										<td>
											<input type="text" name="cheque" id="cheque" onKeyPress="return validar(event)">
										</td>
									</tr>

									<tr>
										<td colspan="2">
											<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:3px;">
												<center><input type="submit" value="Consultar" class="boton"></center>
											</div>
										</td>
									</tr>
								</form>
							</table>
							<br>
							<br>
							<br>
							<br>
							<?php
							$num = $_POST['cheque'];
							$sqt = "select nombre, num_id from Z_terceros where num_id ='$num'";
							$ret = mysql_query($sqt, $cx);
							$rwt = mysql_fetch_array($ret);
							?>
							<table border="0" cellspacing="0" cellpadding="2" width="90%">
								<tr class='Estilo5'>
									<td align="center"><?php echo $rwt['nombre']; ?></td>
								</tr>
								<tr class='Estilo8'>
									<td align="center">Identificado(a) con C.C/NIT No: <?php echo number_format($rwt['num_id'], 0, '.', '.'); ?></td>
								</tr>

							</table>
							<br>
							<br>
							<table border="1" cellspacing="0" cellpadding="2" width="90%">
								<tr class='Estilo7'>
									<td>Retenci&oacute;n</td>
									<td>%</td>
									<td>Base</td>
									<td>Valor</td>
								</tr>
								<?php
								$total = 0;
								$bases = 0;
								mysql_db_query($database, "TRUNCATE TABLE retefte_det", $cx);
								if ($num != '') {
									$sq2 = "select distinct id_auto,dcto,detalle from lib_aux where ccnit = '$num' and (id_auto like 'CEVA%' or id_auto like 'CESP%' or id_auto like 'CECP%')";
									$rs2 = mysql_query($sq2, $cx);
									while ($rw2 = mysql_fetch_array($rs2)) {
										// Buscar el valor del pago sin iva
										$sq3 = "select credito from lib_aux where cuenta like '243625%' and id_auto = '$rw2[id_auto]'";
										$rs3 = mysql_query($sq3, $cx);
										$rw3 = mysql_fetch_array($rs3);
										//valor pagado
										$sq4 = "select sum(debito) as pagado from lib_aux where id_auto = '$rw2[id_auto]'";
										$rs4 = mysql_query($sq4, $cx);
										$rw4 = mysql_fetch_array($rs4);
										$valor_pagado = $rw4['pagado'];
										// valor del iva descontado
										$sq6 = "select sum(credito) as iva from lib_aux where id_auto = '$rw2[id_auto]' and cuenta like '243625%'";
										$rs6 = mysql_query($sq6, $cx);
										$rw6 = mysql_fetch_array($rs6);
										// Busco en lib aux cuantas retenciones tiene
										$sq9 = "select sum(credito) as retenido from lib_aux where id_auto = '$rw2[id_auto]' and cuenta like '2436%' and cuenta not like '243625%' and cuenta not like '243627%'";
										$re9 = mysql_query($sq9, $cx);
										$rw9 = mysql_fetch_array($re9);
										// Busco en lib aux cuantas retenciones tiene
										$sq5 = "select * from lib_aux where id_auto = '$rw2[id_auto]' and cuenta like '2436%' and cuenta not like '243625%' and cuenta not like '243627%'";
										$re5 = mysql_query($sq5, $cx);
										$fil = mysql_num_rows($re5);
										if ($fil > 1) {
											// saco el valor del iva
											while ($rw5 = $re5->fetch_assoc()) {
												$base = ($rw5['credito'] / $rw9['retenido']) * $rw4['pagado'];
												$sq10 = "INSERT INTO retefte_det (id_auto,dcto,cuenta,detalle,base,debito,credito) values 	('$rw2[id_auto]','$rw2[dcto]','$rw5[cuenta]','$rw2[detalle]','$base','0.00','$rw5[credito]')";
												$res = $cx->query($sq10);
											}
											$base = 0;
										} else {
											// valor de la retencion por cada cuenta
											while ($rw5 = $re5->fetch_assoc()) {
												$retencion = $rw5['credito'] - $rw5['debito'];

												//while ($rw5 = $re5->fetch_assoc())

												// Si tiene una sola inserto la retencion en la fuente

												// Busco si tiene reteiva

												// Busco si tiene rete ica 
												$valor = number_format($rw2['credito'], 2, '.', ',');
												$sq10 = "INSERT INTO retefte_det (id_auto,dcto,cuenta,detalle,base,debito,credito) values 	('$rw2[id_auto]','$rw2[dcto]','$rw5[cuenta]','$rw2[detalle]','$rw4[pagado]','0.00','$retencion')";
												$res = $cx->query($sq10);
											}
										}
										$sq6 = "select * from lib_aux where id_auto = '$rw2[id_auto]' and cuenta like '243625%'";
										$re6 = mysql_query($sq6, $cx);
										while ($rw6 = $re6->fetch_assoc()) {
											$sq10 = "INSERT INTO retefte_det (id_auto,dcto,cuenta,detalle,base,debito,credito) values 	('$rw2[id_auto]','$rw2[dcto]','$rw6[cuenta]','$rw2[detalle]','0.00','0.00','$rw6[credito]')";
											$res = $cx->query($sq10);
										}
										$sq7 = "select * from lib_aux where id_auto = '$rw2[id_auto]' and cuenta like '243627%'";
										$re7 = mysql_query($sq7, $cx);
										while ($rw7 = $re7->fetch_assoc()) {
											$sq10 = "INSERT INTO retefte_det (id_auto,dcto,cuenta,detalle,base,debito,credito) values 	('$rw2[id_auto]','$rw2[dcto]','$rw7[cuenta]','$rw2[detalle]','$rw4[pagado]','0.00','$rw7[credito]')";
											$res = $cx->query($sq10);
										}
										$retencion = 0;
									}
								}
								/* Busco retenciones para generar informe */
								$sq44 = "select sum(base) as base, sum(credito) as retencion, cuenta from retefte_det where  cuenta like '2436%' and cuenta not like '243625%' and cuenta not like '243627%' group by cuenta";
								$re44 = mysql_query($sq44, $cx);
								while ($rw44 = mysql_fetch_array($re44)) {
									$sql2 = "select nom_rubro from pgcp where cod_pptal = '$rw44[cuenta]'";
									$re2 = mysql_query($sql2);
									$rw22 = $re2->fetch_assoc();
									$base = number_format($rw44['base'], 0, '.', ',');
									$rete = number_format($rw44[retencion], 0, '.', ',');
									$por = round((($rw44['retencion'] / $rw44['base']) * 100), 2);
									echo "  <tr class='Estilo8'>
						<td>Retefuente $rw22[nom_rubro]</td>
						<td align='right'>$por</td>
						<td align='right'>$base</td>
						<td align='right'>$rete</td>
					</tr>	
			";
									$total = $total + $rw44['retencion'];
								}
								$base = 0;
								$rete = 0;
								$sq44 = "select sum(base) as base, sum(credito) as retencion, cuenta from retefte_det where  cuenta like '243625%' group by cta_bco";
								$re44 = mysql_query($sq44, $cx);
								while ($rw44 = mysql_fetch_array($re44)) {
									$bases = $rw44['retencion'] / 0.15;
									$base = number_format($bases, 0, '.', ',');
									$rete = number_format($rw44['retencion'], 0, '.', ',');
									$por = 15;
									echo "  <tr class='Estilo8'>
						<td>Reteiva</td>
						<td align='right'>$por</td>
						<td align='right'>$base</td>
						<td align='right'>$rete</td>
						</tr>	
			";
									$total = $total + $rw44['retencion'];
								}
								$base = 0;
								$rete = 0;
								$sq44 = "select sum(base) as base, sum(credito) as retencion, cuenta from retefte_det where  cuenta like '243627%' group by cta_bco";
								$re44 = mysql_query($sq44, $cx);
								while ($rw44 = mysql_fetch_array($re44)) {
									$por = round(($rw44['retencion'] / $rw44['base']) * 100, 2);
									$base = number_format($rw44['base'], 0, '.', ',');
									$rete = number_format($rw44['retencion'], 0, '.', ',');
									echo "  <tr class='Estilo8'>
						<td>Reteica</td>
						<td align='right'>$por</td>
						<td align='right'>$base</td>
						<td align='right'>$rete</td>
						</tr>	
			";
									$total = $total + $rw44['retencion'];
								}
								$base = 0;
								$rete = 0;
								$sq44 = "select sum(base) as base, sum(credito) as retencion, cuenta from retefte_det where  cuenta = '' group by cta_bco";
								$re44 = mysql_query($sq44, $cx);
								while ($rw44 = mysql_fetch_array($re44)) {
									$base = number_format($rw44['base'], 0, '.', ',');
									echo "  <tr class='Estilo8'>
						<td>Pagos sin retenci&oacute;n</td>
						<td align='right'>0</td>
						<td align='right'>$base</td>
						<td align='right'>$rw44[retencion]</td>
						</tr>	
			";
									$total = $total + $rw44['retencion'];
								}
								$total = number_format($total, 2, '.', ',');
								echo "<tr class='Estilo7'>
		   <td colspan='3'>Total retenciones practicadas</td>
		    <td align='right'>$total</td>
  		</tr>";

								?>

							</table>

							<BR>
							<a href="../user.php" class="Estilo12">VOLVER</a>
						</div>
					</div>
				</td>
			</tr>

		</table>


		<!-- --------------------------------------------- -->


	</body>

</html>
<?php
} else { // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
} ?>