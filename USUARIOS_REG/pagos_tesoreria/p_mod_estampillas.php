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
	</style> <!-- definicion de estilos -->

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
	</style> <!-- definicion de estilos -->
<?php
	include('../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$concepto = isset($_POST['concepto']) ? $_POST['concepto'] : '';
	$cuenta = isset($_POST['cuenta']) ? $_POST['cuenta'] : '';
	$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
	// consulto cual es el nombre de la estampilla antes de realizar la modificaci�n
	$sqlx = "select * from estampillas where id ='$id'";
	$resx = $cx->query($sqlx);
	while ($rowx = $resx->fetch_assoc()) {
		$concepto_ant = $rowx["concepto"];
	}
	$ib = 0;
	$it = 0;
	$ita = 0;
	$ito = 0;
	for ($i = 0; $i < 6; $i++) {
		$bs = isset($_POST["base$i"]) ? $_POST["base$i"] : '';
		$tp = isset($_POST["tope$i"]) ? $_POST["tope$i"] : '';
		$tf = isset($_POST["tarifa$i"]) ? $_POST["tarifa$i"] : '';
		$idc = isset($_POST["id5$i"]) ? $_POST["id5$i"] : '';
		if ($bs > 0) {
			$base[$ib] = $_POST["base$i"];
			$ib++;
		}
		if ($tp > 0) {
			$tope[$it] = $_POST["tope$i"];
			$it++;
		}
		if ($tf > 0) {
			$tarifa[$ita] = $_POST["tarifa$i"];
			$ita++;
		}
		if ($idc > 0) {
			$id5[$ito] = $_POST["id5$i"];
			$ito++;
		}
	}
	$numrangos = count($base);
	// Actualizo las tablas cecp y ceva antes de realizar el cambio de nombre de la retencion
	for ($i = 1; $i < 6; $i++) {
		$sqx = "update cecp set estampilla$i='$concepto' where estampilla$i = '$concepto_ant'";
		$resx = $cx->query($sqx);
		$sqx1 = "update ceva set estampilla$i='$concepto' where estampilla$i = '$concepto_ant'";
		$resx1 = $cx->query($sqx1);
	}
	// Cambia el nombre y la cuenta de la estampilla
	$sql = "update estampillas set concepto='$concepto', cuenta ='$cuenta'  where id = '$id' ";
	$resultado = $cx->query($sql);
	for ($i = 0; $i < $numrangos; $i++) {
		// Consulto la tabla rangos para saber si el rango existe y decidir si guardo un nuevo registro o lo edito
		$idxx = isset($id5[$i]) ? $id5[$i] : '';
		$sqx2 = "select base,tope,tarifa from rango where concepto= '$concepto' and id ='$idxx'";
		$rex2 = $cx->query($sqx2);
		$maxi = $rex2->num_rows;
		if (empty($maxi)) {
			$sql = "INSERT INTO rango ( concepto ,base, tope, tarifa ) VALUES ( '$concepto' ,'$base[$i]', '$tope[$i]', '$tarifa[$i]')";
			$cx->query($sql) or die(mysqli_error($cx));
		} else {
			$sql = "update rango set concepto ='$concepto',base ='$base[$i]', tope='$tope[$i]', tarifa ='$tarifa[$i]' where id ='$id5[$i]'";
			$cx->query($sql) or die(mysqli_error($cx));
		}
	}
	for ($i = 0; $i < $numrangos; $i++) {
		$bss = isset($_POST["base$i"]) ? $_POST["base$i"] : '';
		if ($bss == '') {
			echo "";
		}
	}
	printf("
<br><br>
<center class='Estilo4'>
<b><span class='Estilo4'>REGISTRO MODIFICADO CON EXITO</span></b><BR><BR>
<form method='post' action='desctos.php'>
<input type='submit' name='Submit' value='Volver' class='Estilo4' />
</form>
</center>
");
	$cx = null;
} // Fin else inicio
?>