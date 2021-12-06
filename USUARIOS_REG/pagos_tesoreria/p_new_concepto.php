<?php
session_start();
if (!$_SESSION["login"]) {
	header("Location: ../login.php");
	exit;
} else {
?>

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
	</style>
	<?php
	$rb = isset($_POST['rb']) ? $_POST['rb'] : '';
	$concepto = isset($_POST['concepto']) ? $_POST['concepto'] : '';
	$a_partir = isset($_POST['a_partir']) ? $_POST['a_partir'] : '';
	$tarifa = isset($_POST['tarifa']) ? $_POST['tarifa'] : '';
	$cuenta = isset($_POST['cuenta']) ? $_POST['cuenta'] : '';
	$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';

	$base1 = isset($_POST['base1']) ? $_POST['base1'] : '';
	$base2 = isset($_POST['base2']) ? $_POST['base2'] : '';
	$base3 = isset($_POST['base3']) ? $_POST['base3'] : '';
	$base4 = isset($_POST['base4']) ? $_POST['base4'] : '';
	$base5 = isset($_POST['base5']) ? $_POST['base5'] : '';

	$tope1 = isset($_POST['tope1']) ? $_POST['tope1'] : '';
	$tope2 = isset($_POST['tope2']) ? $_POST['tope2'] : '';
	$tope3 = isset($_POST['tope3']) ? $_POST['tope3'] : '';
	$tope4 = isset($_POST['tope4']) ? $_POST['tope4'] : '';
	$tope5 = isset($_POST['tope5']) ? $_POST['tope5'] : '';

	$tarifa1 = isset($_POST['tarifa1']) ? $_POST['tarifa1'] : '';
	$tarifa2 = isset($_POST['tarifa2']) ? $_POST['tarifa2'] : '';
	$tarifa3 = isset($_POST['tarifa3']) ? $_POST['tarifa3'] : '';
	$tarifa4 = isset($_POST['tarifa4']) ? $_POST['tarifa4'] : '';
	$tarifa5 = isset($_POST['tarifa5']) ? $_POST['tarifa5'] : '';

	$ib = 0;
	$it = 0;
	$ita = 0;
	for ($i = 1; $i < 6; $i++) {
		if ($_POST["base$i"] > 0) {
			$base[$ib] = $_POST["base$i"];
			$ib++;
		}
		if ($_POST["tope$i"] > 0) {
			$tope[$it] = $_POST["tope$i"];
			$it++;
		}
		if ($_POST["tarifa$i"] > 0) {
			$tarifa[$ita] = $_POST["tarifa$i"];
			$ita++;
		}
	}
	$numrangos = count($base);


	include('../config.php');
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

	if ($rb == "estampillas") {
		$sql = "INSERT INTO $rb ( concepto , a_partir, tarifa, cuenta) VALUES ( '$concepto' , '$a_partir', '$tarifa', '$cuenta')";
		$connectionxx->query($sql) or die(mysqli_error($connectionxx));
		for ($i = 0; $i < $numrangos; $i++) {
			$sql = "INSERT INTO rango ( concepto ,base, tope, tarifa ) VALUES ( '$concepto' ,'$base[$i]', '$tope[$i]', '$tarifa[$i]')";
			$connectionxx->query($sql) or die(mysqli_error($connectionxx));
		}
	} else {
		$sql = "INSERT INTO $rb ( concepto , cuenta, codigo_ret ) VALUES ( '$concepto' , '$cuenta', '$codigo')";
		$connectionxx->query($sql) or die(mysqli_error($connectionxx));

		for ($i = 0; $i < $numrangos; $i++) {
			$sql = "INSERT INTO rango ( concepto ,base, tope, tarifa ) VALUES ( '$concepto' ,'$base[$i]', '$tope[$i]', '$tarifa[$i]')";
			$connectionxx->query($sql) or die(mysqli_error($connectionxx));
		}
	}

	printf("
		<br><br>
		<center class='Estilo4'>
		<b><span class='Estilo4'>REGISTRO INSERTADO CON EXITO</span></b><BR><BR>
		<form method='post' action='desctos.php'>
		<input type='submit' name='Submit' value='Volver' class='Estilo4' />
		</form>
		</center>
	");

	?>

<?php
}
?>