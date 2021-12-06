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
						<div align="center" class="Estilo5">Ver informe de ejecuci�n por tercero<BR>
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
								<form action="informe_terceros.php" method="POST" class="miform" name="tercero">
									<tr>
										<td>
											<div id="main_div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
												<div align="right"><span class="Estilo5">C.C.: Tercero</span> </div>
											</div>
										</td>
										<td>
											<input type="text" name="tercero_doc" id="tercero_doc" onKeyPress="return validar(event)">
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
							<BR>
							<a href="../user.php" class="Estilo12">VOLVER</a>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td width="200">
					<div class="dtree Estilo1 Estilo2 Estilo4" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
						<div align="center">
							<?php include('../config.php');
							echo $nom_emp ?>
							<br />
							<?php echo $dir_tel ?><BR />
							<?php echo $muni ?> <br />
							<?php echo $email ?>
						</div>
					</div>
				</td>
				<td width="200">
					<div class="dtree Estilo1 Estilo2 Estilo4" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
						<div align="center">POLITICAS DE PRIVACIDAD <BR />
							<BR />
							CONDICIONES DE USO
						</div>
					</div>
				</td>
				<td width="200">
					<div class="dtree Estilo1 Estilo2 Estilo4" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
						<div align="center">Desarrollado por <br />
							<a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
							Derechos Reservados - 2009
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