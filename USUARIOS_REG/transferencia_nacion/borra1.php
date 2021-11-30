<?php
session_start();
if (!isset($_SESSION["login"])) {
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
	$id_recau = $_POST['id_recau'];
	$fecha_c = $_POST['fecha_c']; //echo $fecha_c;
	include('../config.php');
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);

	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$id_emp = $rowxx["id_emp"];
	}

	$sqlf = "select * from vf";
	$resf = $connectionxx->query($sqlf);
	$rowf = $resf->fetch_assoc();
	$fecha_cierre = $rowf["fecha_ini"]; //echo $fecha_cierre;
	if ($fecha_c <= $fecha_cierre) {
		printf("
			<center class='Estilo4'><br><br>La Fecha de registro 
			<b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
			</center>");

		printf("
			<br>
			<center class='Estilo8'>
			
			<form method='post' action='../recaudos_tesoreria/recaudos_tesoreria.php'>
			<input type='hidden' name='nn' value='TNAT'>
			<input type='submit' name='Submit' value='Volver' class='Estilo9' />
			</form>
			</center>
			");
	} else {

		$sSQL = "DELETE From recaudo_tnat Where id_emp='$id_emp' and id_recau ='$id_recau'";
		$connectionxx->query($sSQL) or die(mysqli_error($connectionxx));
		printf("
			<br>
			<center class='Estilo8'>
			<b><span class='Estilo9'>REGISTRO ELIMINADO CON EXITO</span></b><BR><BR>
			<form method='post' action='../recaudos_tesoreria/recaudos_tesoreria.php'>
			<input type='hidden' name='nn' value='TNAT'>
			<input type='submit' name='Submit' value='Volver' class='Estilo9' />
			</form>
			</center>
			");
	}
	?>
<?php
}
?>