<?php
session_start();
if (!$_SESSION["login"]) {
	header("Location: ../login.php");
	exit;
} else {
?>
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

		table.bordepunteado1 {
			border-style: solid;
			border-collapse: collapse;
			border-width: 2px;
			border-color: #004080;
		}
	</style>
<?php
	include('../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	$concepto = isset($_POST['concepto']) ? $_POST['concepto'] : '';
	$cuenta = isset($_POST['cuenta']) ? $_POST['cuenta'] : '';
	$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
	$sqlx = "select * from reteica where id ='$id'";
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
	// Actualio las tablas cecp y ceva con el concepto modificado de la retefuente
	$sqx = "update cecp set reteica='$concepto' where reteica = '$concepto_ant'";
	$resx = $cx->query($sqx);
	$sqx1 = "update ceva set reteica='$concepto' where reteica = '$concepto_ant'";
	$resx1 = $cx->query($sqx1);
	// Actualizo los datos de la retencion
	$sql = "update reteica set concepto='$concepto', cuenta ='$cuenta', codigo_ret='$codigo' where id = '$id' ";
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
} // fin else encabeado
?>