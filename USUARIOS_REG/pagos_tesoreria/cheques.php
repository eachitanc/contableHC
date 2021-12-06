<?php
set_time_limit(1800);
session_start();
?>
<html>

<head>
	<title>CONTAFACIL ...::: Informe por terceros :::...</title>

	<script language="">
		//function cursor(){document.login.login.focus();}
		// -->
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
						<div align="center" class="Estilo5">Confirmar pagos por cheques<BR>
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
								<form action="cheques.php" method="POST" class="miform" name="tercero">
									<tr>
										<td>
											<div id="main_div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
												<div align="right"><span class="Estilo5">No cheque:</span> </div>
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
							<table border="1" cellspacing="0" cellpadding="2" width="90%">
								<tr class='Estilo7'>
									<td>FECHA</td>
									<td>NOMBRE</td>
									<td>DOCUMENTO</td>
									<td>VALOR</td>
								</tr>
								<?php
								$total = 0;
								$num = isset($_POST['cheque']) ? $_POST['cheque'] : '';
								if ($num != '') {
									$sq2 = "select fecha,tercero,credito,cheque from lib_aux where cheque like '%$num%'";
									$rs2 = $cx->query($sq2) or die(mysqli_error($cx));
									while ($rw2 = $rs2->fetch_assoc()) {
										$valor = number_format($rw2['credito'], 2, '.', ',');
										echo "  <tr class='Estilo8'>
				  	<td>$rw2[fecha]</td>
    				<td>$rw2[tercero]</td>
      				<td>$rw2[cheque]</td>
				  	<td align='right'>$valor</td>
 				</tr>	
		";
										$total = $total + $rw2['credito'];
									}
								}
								$total = number_format($total, 2, '.', ',');
								echo "<tr class='Estilo8'>
		   <td colspan='2'>&nbsp;</td>
		    <td align='left'>TOTAL</td>
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