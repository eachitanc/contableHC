<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Documento sin t&iacute;tulo</title>

	<link type="text/css" rel="stylesheet" href="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
	</LINK>
	<SCRIPT type="text/javascript" src="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

	<style type="text/css">
		.form {
			background-color: #EEEEEE;
		}

		.sidebar {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 11px;
			padding: 3px;
			text-align: justify;
		}

		.sidebar3 {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 11px;
			padding: 3px;
			text-align: justify;
			color: #FF0000;
		}
	</style>
</head>

<body>
	<?php
	$document1 = '';
	$document2 = '';
	$ver_pendiente = '';
	$nom_registrados = "Registrados";
	$nom_pendientes = "Pendientes";
	if (isset($_POST["nn"])) $_POST["nn"] = $_POST["nn"];
	else  $_POST["nn"] = '';
	if (isset($_GET["nn"])) $_GET["nn"] = $_GET["nn"];
	else  $_GET["nn"] = '';
	if (isset($_POST["pendiente"])) $_SESSION["pendiente"] = $_POST["pendiente"];
	else $_SESSION["pendiente"] = '';
	if (isset($_POST["registrado"])) $_SESSION["registrado"] = $_POST["registrado"];
	else $_SESSION["registrado"] = '';
	$_POST["nn"] . $_GET["nn"];
	if ($document1 == "") {
		$document1 = isset($_REQUEST["nn"]) ? $_REQUEST["nn"] : '';
		//echo $document1;
		if ($document1 == "CDPP") {
			$nom_pendientes = "Por registrar";
		}
		if ($document1 == "CRPP") {
			$nom_pendientes = "Por Obligar";
			$nom_registrados = "Obligados";
		}
		if ($document1 == "COBP" || $document1 == "CAIC" || $document1 == "OBCG" || $document1 == "REIP") {
			$nom_pendientes = "Por contabilizar";
			$nom_registrados = "Contabilizados";
		}
		if ($document1 == "") {
			$nom_pendientes = "Por pagar";
			$nom_registrados = "Pagados";
		}
		if ($document1 == "ROIT") {
			$nom_pendientes = "Por recaudar";
			$nom_registrados = "Recaudados";
		}
		if ($document2 == "CECP") {
			$registrado = 1;
			$fecha2 = "MES";
			$pendiente = 0;
			$ver_pendiente = "none";
			$nom_registrados = "Pagados";
			$nom_pendientes = "";
		}

		if ($document1 == "CEVA") {
			$nom_pendientes = "Por pagar";
			$nom_registrados = "Pagados";
		}
		if (empty($_SESSION["fecha"])) {
			$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
			$sqlxx = "select * from fecha";
			$resultadoxx = $connectionxx->query($sqlxx);

			while ($rowxx = $resultadoxx->fetch_assoc()) {
				$idxx = $rowxx["id_emp"];
				$id_emp = $rowxx["id_emp"];
				$ano = $rowxx["ano"];
			}

			$_SESSION["fecha"] = $ano;
			$fechafil = $_SESSION["fecha"];
			$_SESSION["fecha2"] = "A�O";
			$fecha2 = $_SESSION["fecha2"];
			$_SESSION["pendiente"] = 1;
			$pendiente = $_SESSION["pendiente"];
			$tercerox = "";
			$tercero2 = "'" . $tercerox . "'";
			list($an, $me, $di)  = explode('/', $fechafil);
			$f1 = "$an/$me/01";
			$f2 = "$an/$me/31";
			$a1 = "$an/01/01";
			$a2 = "$an/12/31";

			$document = $_POST["nn"] . $_GET["nn"];
			if ($document == "CESP" || $document == "NCON" || $document == "NCSP" || $document == "NDSP" || $document == "TFIN" || $document == "COBA" || $document == "NCBT" || $document == "TNAT" || $document == "RCGT" || $document == "RIIP" || $document == "RIUR" || $document == "RTIC" || $document == "RICA" || $document == "ICA1" || $document == "ICA2" || $document == "REIN" || $document == "NCSF") {
				$registrado = 1;
				$fecha2 = "MES";
				$pendiente = "";
				$ver_pendiente = "none";
				$nom_registrados = "Contabilizados";
			}
		} else {
			if (empty($_POST["fecha"])) {

				$fechafil = $_SESSION["fecha"];
				$fecha2 = $_SESSION["fecha2"];
				$pendiente = $_SESSION["pendiente"];
				$registrado = $_SESSION["registrado"];
				$tercerox = "";
				$tercero2 = "'" . $tercerox . "'";
				list($an, $me, $di)  = explode('/', $fechafil);
				$f1 = "$an/$me/01";
				$f2 = "$an/$me/31";
				$a1 = "$an/01/01";
				$a2 = "$an/12/31";
				$document = $_POST["nn"] . $_GET["nn"];
				if ($document == "CESP" || $document == "NCON" || $document == "NCSP" || $document == "NDSP" || $document == "TFIN" || $document == "COBA" || $document == "NCBT" || $document == "TNAT" || $document == "RCGT" || $document == "RIIP" || $document == "RIUR" || $document == "RTIC" || $document == "RICA" || $document == "ICA1" || $document == "ICA2" || $document == "REIN" || $document == "NCSF") {
					$registrado = 1;
					$nom_registrados = "Contabilizados";
					$pendiente = "";
					$ver_pendiente = "none";
				}
			} else {
				$_SESSION["fecha"] = $_POST["fecha"];
				$_SESSION["fecha2"] = $_POST["fecha2"];
				$fechafil = $_SESSION["fecha"];
				$fecha2 = $_SESSION["fecha2"];
				$pendiente = $_SESSION["pendiente"];
				$registrado = $_SESSION["registrado"];
				$tercerox = "";
				$tercero2 = "'" . $tercerox . "'";
				list($an, $me, $di)  = explode('/', $fechafil);
				$f1 = "$an/$me/01";
				$f2 = "$an/$me/31";
				$a1 = "$an/01/01";
				$a2 = "$an/12/31";
				$buscar = $_POST["buscar"];
				if (isset($_POST["nn"])) $_POST["nn"] = $_POST["nn"];
				else  $_POST["nn"] = '';
				if (isset($_GET["nn"])) $_GET["nn"] = $_GET["nn"];
				else $_GET["nn"] = '';
				$document = $_POST["nn"] . $_GET["nn"];
				if ($document == "CESP" || $document == "NCON" || $document == "NCSP" || $document == "NDSP" || $document == "TFIN" || $document == "COBA" || $document == "NCBT" || $document == "TNAT" || $document == "RCGT" || $document == "RIIP" || $document == "RIUR" || $document == "RTIC" || $document == "RICA" || $document == "ICA1" || $document == "ICA2" || $document == "REIN" || $document == "NCSF") {
					$ver_pendiente = "none";
					$nom_registrados = "Contabilizados";
				}
			}
		}
	} else {
		if ($document1 == "CEVA") {
			$registrado = 1;

			$pendiente = 1;
			$ver_pendiente = "none";
			$nom_registrados = "Anulados";
			$nom_pendientes = "";
		}
	}

	?>


	<table border="0" width="100%">
		<tr align="center">
			<td>
				<form class="form" action="<?php //echo $archivo; 
											?>" method="post" name="form1">
					<?php
					if (empty($pendiente)) {
					?><input name="pendiente" type="checkbox" value="1" style="display: <?php echo $ver_pendiente ?>" /><span class="sidebar" style="display:<?php echo $ver_pendiente ?>"><?php echo $nom_pendientes; ?></span><?
																																																							} else {
																																																								?><input name="pendiente" type="checkbox" value="1" checked style="display:<?php echo $ver_pendiente ?>" /><span class="sidebar3"><?php echo $nom_pendientes; ?></span><?php
																																																																																																	}

																																																																																																	if (empty($registrado)) {
																																																																																																		?><input name="registrado" type="checkbox" value="1" /><span class="sidebar"><?php echo $nom_registrados; ?></span><?php
																																																																																																	} else {
																																																																												?><input name="registrado" type="checkbox" value="1" checked /><span class="sidebar3"><?php echo $nom_registrados; ?></span><?php
																																																																																																	}
																																																																	?>

					<input name="fecha" type="text" class="Estilo4" id="fecha" value="<?php printf($fechafil); ?>" size="12" />
					<input name="button" type="button" class="Estilo4" onclick="displayCalendar(document.form1.fecha,'yyyy/mm/dd',this)" value="Ver Calendario" />
					<select name="fecha2" class="Estilo4">
						<?php
						if (empty($fecha2)) {
							echo "	<option selected>A�O</option>
										<option > MES </option>
										<option>DIA </option>";
						}
						if ($fecha2 == "A�O") {
							echo "	<option selected>A�O</option>
										<option> MES </option>
										<option>DIA </option>";
						}
						if ($fecha2 == "MES") {
							echo "	<option >A�O</option>
										<option selected> MES </option>
										<option>DIA </option>";
						}
						if ($fecha2 == "DIA") {
							echo "	<option >A�O</option>
										<option > MES </option>
										<option selected>DIA </option>";
						}
						?>
					</select>
					
					<input name="buscar" type="text" size="50" class="Estilo4" />
					<input name="nn" type="hidden" value="<?php //echo $a; ?>" />
					<input name="archivo" type="hidden" value="<?php //echo $archivo; 
																?>" />
					<input type="submit" class="Estilo4" value="Filtrar" />
				</form>
			</td>
		</tr>
	</table>

</body>

</html>