<?php
session_start();
if (!$_SESSION["login"]) {
	header("Location: ../login.php");
	exit;
} else {
?>
	<style type="text/css">
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

		.Estilo9 {
			font-size: 10px;
			font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		}
	</style>
<?php
	$id = $_GET['id4'];
	include('../config.php');
	$cont = 0;
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "SELECT * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$id_emp = $rowxx["id_emp"];
	}
	$sqlx = "SELECT * from reteica where id ='$id'";
	$resx = $connectionxx->query($sqlx);
	while ($rowx = $resx->fetch_assoc()) {
		$concepto = $rowx["concepto"];
	}
	$sqx = "SELECT * from cecp where reteica = '$concepto'";
	$resx = $connectionxx->query($sqx);
	$maxi = $resx->num_rows;
	if ($maxi > 0) {
		$cont = 1;
	}
	$sq2 = "SELECT * from ceva where reteica = '$concepto'";
	$res = $connectionxx->query($sq2);
	$exi = $res->num_rows;
	if ($exi > 0) {
		$cont++;
	}
	if ($cont == 0) {
		$cx = new mysqli($server, $dbuser, $dbpass, $database);

		$sSQL = "DELETE from reteica Where id ='$id'";
		$cx->query($sSQL) or die(mysqli_error($cx));
		printf("
<br><br>
<center class='Estilo8'>
<b><span class='Estilo9'>REGISTRO ELIMINADO CON EXITO</span></b><BR><BR>
<form method='post' action='desctos.php'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
");
	} else {
		printf("
<br><br>
<center class='Estilo8'>
<b><span class='Estilo9'>LA RETENCION YA HA SIDO UTILIZADA - NO SE PUEDE ELIMINAR</span></b><BR><BR>
<form method='post' action='desctos.php'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
");
	}
}
?>