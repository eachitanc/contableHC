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
	$id_ceva = $_POST['id_ceva'];
	$fecha_c = $_POST['fecha_c']; //echo $fecha_c;

	include('../config.php');
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);

	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$id_emp = $rowxx["id_emp"];
	}


	$sqlxx1 = "select * from ceva where id_emp ='$id_emp' and id_auto_ceva = '$id_ceva'";
	$resultadoxx1 = $connectionxx->query($sqlxx1);

	while ($rowxx1 = $resultadoxx1->fetch_assoc()) {
		$id_auto_cobp = $rowxx1["id_auto_cobp"];
	}
	$consultax = $connectionxx->query("select * from vf ");
	while ($rowx = $consultax->fetch_assoc()) {
		$ax = $rowx["fecha_ini"]; // echo $ax;
		$bx = $rowx["fecha_fin"]; // echo $bx;
	}

	if ($fecha_c > $bx || $fecha_c < $ax) {

		printf("
			<center class='Estilo4'><br><br>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
			</center>");

		printf("

			<center class='Estilo4'>
			<form method='post' action='pagos_tesoreria.php' >
			<input type='hidden' name='nn' value='CEVA'>
			...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
			</form>
			</center>
			");

		///**********************
	} else {



		$sqla1 = "update obcg set pagado='NO' where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp'";
		$resultadoa1 = $connectionxx->query($sqla1);

		$sqla2 = "update cobp set pagado='NO' where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp'";
		$resultadoa2 = $connectionxx->query($sqla2);



		$cx = new mysqli($server, $dbuser, $dbpass, $database);

		$sSQL = "Delete From ceva Where id_emp='$id_emp' and id_auto_ceva ='$id_ceva'";
		$cx->query($sSQL) or die(mysqli_error($cx));


		printf("
<br>
<center class='Estilo8'>
<b><span class='Estilo9'>REGISTRO ELIMINADO CON EXITO</span></b><BR><BR>
<form method='post' action='pagos_tesoreria.php'>
<input type='hidden' name='nn' value='CEVA'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
");
	}

	?>
<?php
}
?>