<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
?>
	<title>CONTAFACIL</title>
	<style type="text/css">
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

		.Estilo9 {
			font-weight: bold
		}

		.Estilo10 {
			font-weight: bold
		}

		.Estilo11 {
			font-weight: bold
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
	<?php
	include('../config.php');
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);
	$consecutivo = isset($_GET['var']) ? $_GET['var'] : '';
	$cuenta = isset($_GET['cta_cdpp']) ? $_GET['cta_cdpp'] : '';
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$idxx = $rowxx["id_emp"];
		$id_emp = $rowxx["id_emp"];
	}

	include('../config.php');
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from reip_ing where consecutivo = '$consecutivo' and cuenta ='$cuenta'";
	$resultadoxx = $connectionxx->query($sqlxx);

	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$nom_rubro = $rowxx["nom_rubro"];
	}

	$valor = $_GET['vr_x_reg'];

	?>
	<style type="text/css">
		.Estilo8 {
			color: #FFFFFF
		}
	</style>
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

		.Estilo13 {
			color: #000000
		}
	</style>

	<script>
		$(document).ready(function() {
			$("#commentForm").validate();
		});
	</script>
	<center>
		<form name="form1" method="post" id="commentForm">
			<table width="500" border="1" align="center" class="bordepunteado1">
				<tr>
					<td bgcolor="#F5F5F5">
						<div class="Estilo4 Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
							<div align="right">FECHA DE REVERSION.</div>
						</div>
					</td>
					<td colspan="2">
						<div id="main_div" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
							<div align="center">
								<?php
								//aplica para cuando se hace el proceso liquidando al reves.... crpp to cdpp

								$sqlxxq = "select * from reip_ing where consecutivo = '$consecutivo' and cuenta = '$cuenta'";
								$resultadoxxq = $connectionxx->query($sqlxxq);

								while ($rowxxq = $resultadoxxq->fetch_assoc()) {
									$vr_crppq = $rowxxq["vr_recaudado"];

									if ($vr_crppq < 0) {
										$vr_obligado = $vr_crppq;
									} else {
										$vr_obligado = '';
									}
								}

								//************************

								?>
								<input type="hidden" name="consecutivo" value="<?php printf("$consecutivo"); ?>" />
								<input type="hidden" name="cuenta" value="<?php printf("$cuenta"); ?>" />
								<input type="hidden" name="nom_rubro" value="<?php printf(isset($nom_rubro) ? "$nom_rubro" : ''); ?>" />
								<input type="hidden" name="cdpp" value="<?php printf(isset($cdpp) ? "$cdpp" : ''); ?>" />
								<input type="hidden" name="vr_obligado" value="<?php printf(isset($vr_obligado) ? "$vr_obligado" : ''); ?>" />
								<input type="hidden" name="liq1" value="<?php $liq1 = 'SI';
																		printf("$liq1"); ?>" />
								<input type="hidden" name="liq2" value="<?php $liq2 = isset($_GET['vr_x_reg']) ? $_GET['vr_x_reg'] * (-1) : '';
																		printf("$liq2"); ?>" />

								<input name="fecha_reg" type="text" class="Estilo4" id="fecha_reg" value="<?php $bb = date("Y/m/d");
																											printf($bb); ?>" size="12" />
								<span class="Estilo6 Estilo8">:::</span>
								<input name="button" type="button" class="Estilo4" onclick="displayCalendar(document.form1.fecha_reg,'yyyy/mm/dd',this)" value="Ver Calendario" />
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td bgcolor="#F5F5F5">
						<div class="Estilo4 Estilo9" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
							<div align="right">CONCEPTO DE REVERSION.</div>
						</div>
					</td>
					<td colspan="2">
						<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
							<div align="center">
								<textarea name="des" cols="50" rows="5" class="Estilo4" id="des" onkeyup="form1.des.value=form1.des.value.toUpperCase();">REVERSION DE SALDO</textarea>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td bgcolor="#F5F5F5">
						<div class="Estilo4 Estilo11" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
							<div align="right">VALOR DE LA REVERSION.</div>
						</div>
					</td>
					<td colspan="2">
						<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
							<div align="center">
								<input name="valor" type="text" class="required max Estilo4" id="valor" onkeypress="return validar(event)" style="text-align:center" value="<?php printf("%s", $valor); ?>" max="<?php printf("%s", $valor); ?>" />
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:5px;">
							<div align="center">
								<input name="Submit" type="submit" class="Estilo4" value="Reversar Saldo" onclick="this.form.action = 'liqreip.php'" />
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td width="200"></td>
					<td width="150"></td>
					<td width="150"></td>
				</tr>
			</table>
		</form>

		<!--*********************************************************************************************************-->

		<?php

		$id_empa = $id_emp;
		$consecutivoa = isset($_POST['consecutivo']) ? $_POST['consecutivo'] : '';
		$fecha_rega = isset($_POST['fecha_reg']) ? $_POST['fecha_reg'] : '';
		$desa = isset($_POST['des']) ? $_POST['des'] : '';
		$cuentaa = isset($_POST['cuenta']) ? $_POST['cuenta'] : '';
		$nom_rubroa = isset($_POST['nom_rubro']) ? $_POST['nom_rubro'] : '';
		$valora = isset($_POST['valor']) ? $_POST['valor'] * (-1) : 0;
		$cdppa = isset($_POST['cdpp']) ? $_POST['cdpp'] : '';
		$vr_obligadoa = isset($_POST['vr_obligado']) ? $_POST['vr_obligado'] : '';
		$liq1a = isset($_POST['liq1']) ? $_POST['liq1'] : '';
		$liq2a = isset($_POST['liq2']) ? $_POST['liq2'] : '';


		if ($liq1a != '') {


			include('../config.php');
			$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
			$sql = "INSERT INTO reip_ing (id_emp,consecutivo,fecha_reg,des,cuenta,nom_rubro,valor,vr_recaudado,liq1) 
		VALUES ('$id_empa','$consecutivoa','$fecha_rega','$desa','$cuentaa','$nom_rubroa','$valora','$vr_obligadoa','SI')";
			$connectionxx->query($sql);

			//sacar total de vr_obligado y comparar con total de valor, si son =0 -> contab = si

			$link = new mysqli($server, $dbuser, $dbpass, $database);
			$resulta = $link->query("select SUM(vr_recaudado) AS TOTAL from reip_ing WHERE consecutivo = '$consecutivoa'");
			$row = $resulta->fetch_row();
			$total = $row[0];
			$tot_vr_obligado = $total;

			$resulta2 = $link->query("select SUM(valor) AS TOTAL from reip_ing WHERE consecutivo = '$consecutivoa'");
			$row2 = $resulta2->fetch_array();
			$total2 = $row2[0];
			$tot_vr = $total2;

			if ($tot_vr == $tot_vr_obligado) {

				$sql3 = "UPDATE reip_ing set contab='SI' where consecutivo = '$consecutivoa'";
				$resultado3 = $connectionxx->query($sql3);
			}

		?>
			<DIV id="prepage" style="position:absolute; font-family:arial; font-size:16; left:0px; top:0px; background-color:white; layer-background-color:white; height:100%; width:100%;">
				<TABLE width=100%>
					<TR>
						<TD>
							<br />
							<br />
							<br />
							<center>
								<B>LA REVERSION SE REALIZO CON EXITO</B>
								<br />
								<br />
								<a href="hisreip.php?consecutivo=<?php printf($consecutivoa); ?>" target="_parent">VOLVER</a>
							</center>
						</TD>
					</TR>
				</TABLE>
			</DIV>

		<?php
		}
		?>

		<form name="form2">
			<input type="button" value="Atr�s" onclick="history.back()" class=Estilo4>
		</form>
	</center>
<?php
}
?>