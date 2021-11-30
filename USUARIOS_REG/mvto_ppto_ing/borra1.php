<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
?>
	<title>CONTAFACIL</title>
	<style type="text/css">
		.Estilo1 {
			font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
			font-size: 12px;
			font-weight: bold;
		}

		.Estilo2 {
			font-size: 9px
		}

		a {
			font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
			font-size: 11px;
			color: #666666;
		}

		a:visited {
			color: #666666;
			text-decoration: none;
		}

		a:hover {
			color: #666666;
			text-decoration: underline;
		}

		a:active {
			color: #666666;
			text-decoration: none;
		}

		a:link {
			text-decoration: none;
		}

		.Estilo7 {
			font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
			font-size: 11px;
			color: #666666;
		}

		.Estilo4 {
			font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #333333;
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
	include("../config.php");

	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$idxx = $rowxx["id_emp"];
	}


	$id = $_POST['id'];
	$cuenta = $_POST['cuenta'];
	$consecutivo = $_POST['consecutivo'];

	//printf("id : %s<br>consecutivo : %s<br>cuenta : %s",$id,$consecutivo,$cuenta);


	$sqla = "select * from reip_ing where id_emp ='$idxx' and id ='$id'";
	$resultadoa = $connectionxx->query($sqla);

	while ($rowa = $resultadoa->fetch_assoc()) {
		$valor = $rowa["valor"];
		$saldo = $rowa["saldo"];
		$cuenta = $rowa["cuenta"];
	}

	$nuevo_saldo = $valor + $saldo;

	$sqlx = "update reip_ing set saldo='$nuevo_saldo' where id_emp= '$idxx' and cuenta ='$cuenta' ";
	$resultado = $connectionxx->query($sqlx);

	$cx = new mysqli($server, $dbuser, $dbpass, $database);

	$sSQL = "Delete From reip_ing Where id='$id' and id_emp ='$idxx'";
	$cx->query($sSQL);


	printf("
<br>
<center class='Estilo4'>
Imputacion <b>ELIMINADA</b> con Exito<br><br>
<form method='post' action='confirma_borra_mvto.php'>
<input type='hidden' name='consecutivo' value='%s'>
<input type='submit' name='Submit' value='Volver' class='Estilo4' />
</form>
</center>
", $consecutivo);

	?>
<?php
}
?>