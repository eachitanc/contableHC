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

	$old_cuenta = $_POST['old_cuenta'];
	$new_cuenta = $_POST['cuenta'];

	$new_valor = $_POST['valor'];
	$old_valor = $_POST['old_valor'];

	$consecutivo = $_POST['consecutivo'];

	/*printf("

id : %s
<br>
old_cuenta : %s
<br>
new_cuenta : %s
<br>
new_valor : %s
<br>
old_valor : %s
<br>
consecutivo : %s

",
$id
,
$old_cuenta
,
$new_cuenta
,
$new_valor
,
$old_valor
,
$consecutivo

);*/


	//*****************
	// consulta ppto
	$sql = "select * from car_ppto_ing where id_emp ='$idxx' and cod_pptal ='$new_cuenta'";
	$resultado = $connectionxx->query($sql);;

	while ($row = $resultado->fetch_assoc()) {

		$definitivo = $row["definitivo"];
	}

	//*****************
	$link =new mysqli($server, $dbuser, $dbpass, $database);
	$resulta = $link->query("select SUM(valor) AS TOTAL from reip_ing WHERE id_emp ='$idxx' and cuenta ='$new_cuenta'") or die(mysqli_error($link));
	$row = $resulta->fetch_row();
	$total = $row[0];
	$total_recaudado = $total;

	$vr_eval = $total_recaudado + $new_valor;
	$saldox = $definitivo - $total_recaudado;

	/// inicio bloque
	if ($vr_eval > $definitivo) {
		printf("<br><br><center class='Estilo4'>El <b>SALDO</b> disponible para realizar <B>RECONOCIMIENTOS</B> a la cuenta <b>" . $new_cuenta . "</b>  es <br><br>...::: " . $saldox . " :::...<BR><BR><b>NO</b> puede hacer <b>RECONOCIMIENTOS</b> por un valor superior al indicado<BR><BR>Verifique su Informacion<br><br><br>");
		printf("
<br>
<center class='Estilo4'>
<form method='post' action='confirma_borra_mvto.php'>
<input type='hidden' name='consecutivo' value='%s'>
<input type='submit' name='Submit' value='Volver' class='Estilo4' />
</form>
</center>
", $consecutivo);
	} else {

		//***********

		$sqla = "select * from reip_ing where id_emp ='$idxx' and id ='$id'";
		$resultadoa = $connectionxx->query($sqla);

		while ($rowa = $resultadoa->fetch_assoc()) {
			$saldo = $rowa["saldo"];
			$valor = $rowa["valor"];
			$definitivo = $rowa["definitivo"];
		}


		//le sumo el valor al saldo

		$var_saldo = $saldo + $old_valor;

		//actualizao el saldo de todos

		$sqlx1 = "update reip_ing set saldo='$var_saldo' where id_emp= '$idxx' and cuenta ='$old_cuenta' ";
		$resultado1 = $connectionxx->query($sqlx1);

		// calculo el nuevo saldo

		$nuevo_saldo = $var_saldo - $new_valor;

		//actualizar el saldo de todos
		$sqlx2 = "update reip_ing set saldo='$nuevo_saldo' where id_emp= '$idxx' and cuenta ='$new_cuenta' ";
		$resultado2 = $connectionxx->query($sqlx2);

		//actualizar el registro especifico
		$sqlx3 = "update reip_ing set valor='$new_valor' where id_emp= '$idxx' and id ='$id' ";
		$resultado3 = $connectionxx->query($sqlx3);



		printf("
	<br>
	<center class='Estilo4'><br>
	Registro Modificado con Exito<br>
	<form method='post' action='confirma_borra_mvto.php'>
	<input type='hidden' name='consecutivo' value='%s'>
	<input type='submit' name='Submit' value='Volver' class='Estilo4' />
	</form>
	</center>
	", $consecutivo);
	}




	?>



<?php
}
?>