<?php
set_time_limit(1800);
session_start();
?>
<html>

<head>
	<title>CONTAFACIL ...::: Informe por terceros :::...</title>

	<script language="">
		//function cursor(){document.login.login.focus();}
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
$rw['teso'] = 'SI';
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
							$num = isset($_POST['cheque']) ? $_POST['cheque'] : 0;
							$sqt = "select nombre, num_id from z_terceros where num_id ='$num'";
							$ret = $cx->query($sqt);
							$rwt = $ret->fetch_assoc();
							?>
							<table border="0" cellspacing="0" cellpadding="2" width="90%">
								<tr class='Estilo5'>
									<td align="center"><?php echo $rwt['nombre']; ?></td>
								</tr>
								<tr class='Estilo8'>
									<td align="center">Identificado(a) con C.C/NIT No: <?php echo $rwt['num_id'] //number_format($rwt['num_id'], 0, '.', '.'); ?></td>
								</tr>

							</table>
							<br>
							<br>
							<table border="1" cellspacing="0" cellpadding="2" width="90%">
								<tr class='Estilo7'>
									<td>Concepto</td>
									<td>Ingresos</td>
									<td>Retefuente</td>
									<td>IVA</td>
								</tr>
								<?php
								$total = 0;
								$bases = 0;
								//mysql_db_query($database,"TRUNCATE TABLE retefte_det",$cx);

								/* Busco retenciones para generar informe */
								$sq44 = "select sum(pago_nodeducible) as base, sum(retefuente_prac) as retencion, sum(reteiva_comun) as reteiva,concepto from certingresos where  ccnit = '$num' group by concepto";
								$re44 = $cx->query($sq44) or die(mysqli_error($cx));
								while ($rw44 = $re44->fetch_assoc()) {
									$sql2 = "select nombre from certitipo where cod = '$rw44[concepto]'";
									$re2 = $cx->query($sql2);
									$rw22 = $re2->fetch_assoc();
									$base = number_format($rw44['base'], 0, '.', ',');
									$rete = number_format($rw44['retencion'], 0, '.', ',');
									$iva = number_format($rw44['reteiva'], 0, '.', ',');
									$por = round((($rw44['retencion'] / $rw44['base']) * 100), 2);
									echo "  <tr class='Estilo8'>
						<td>$rw22[nombre]</td>
						<td align='right'>$base</td>
						<td align='right'>$rete</td>
						<td align='right'>$iva</td>
					</tr>	
			";
									$totalr = $totalr + $rw44['retencion'];
									$totale = $totale + $rw44['base'];
									$totali = $totali + $rw44['reteiva_comun'];
								}
								$base = 0;
								$rete = 0;
								$iva = 0;
								$totale = number_format($totale, 2, '.', ',');
								$totalr = number_format($totalr, 2, '.', ',');
								$totali = number_format($totali, 2, '.', ',');
								echo "<tr class='Estilo7'>
		    <td >Total</td>
			<td align='right'>$totale</td>
			<td align='right'>$totalr</td>
		    <td align='right'>$totali</td>
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