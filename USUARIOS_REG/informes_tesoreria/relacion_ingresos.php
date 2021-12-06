<?php
set_time_limit(1800);
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	include('../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");

	$sql = "SELECT teso FROM usuarios2 where login = '$_SESSION[login]'";
	$res = $cx->query($sql);
	$rw = $res->fetch_assoc();
	if ($rw['teso'] == 'SI') {


		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=RELACION_DE_INGRESOS.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<title>CONTAFACIL</title>
			<style>
				.text {
					mso-number-format: "\@"
				}

				.date {
					mso-number-format: "yyyy\/mm\/dd"
				}

				.numero {
					mso-number-format: "0"
				}
			</style>
		</head>

		<body>
	<?php
		include('../config.php');
		$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		// llegan las variables
		$fecha_ini = $_POST['fecha_ini'];
		$fecha_fin = $_POST['fecha_fin'];
		$codigo = $_POST['cod_ini'];
		if ($codigo  != '') $fil = "and cuenta like '$codigo%'";
		$mes = 13;
		$periodo = array("", "ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE", "ANUAL");
		for ($i = 1; $i <= 13; $i++) {
			if ($mes == $i) $per = $periodo[$i];
		}
		$suma = 0;

		printf("
<center>
<table BORDER='1' class='bordepunteado1'>
<tr>
<td  bgcolor='#DCE9E5' align='center'>Codigo Presupuestal</td>
<td  bgcolor='#DCE9E5' align='center'>Detalle</td>
<td  bgcolor='#DCE9E5' align='center'>Fecha De Recaudo</td>
<td  bgcolor='#DCE9E5' align='center'>Numero De Recibo</td>
<td  bgcolor='#DCE9E5' align='center'>Recibido De</td>
<td  bgcolor='#DCE9E5' align='center'>Concepto Recaudo</td>
<td  bgcolor='#DCE9E5' align='center'>Valor</td>
</tr>
");
		$sq = "select * from recaudo_ncbt where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' $fil order by fecha_recaudo";
		$re = $cx->query($sq);
		while ($rw = $re->fetch_assoc()) {
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia,nom_rubro from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = $cx->query($sq10);
			$rw10 = $re10->fetch_assoc();
			printf("
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			</tr>", $rw["cuenta"], $rw10["nom_rubro"], $rw["fecha_recaudo"], $rw["id_manu_ncbt"], $rw["tercero"], ucfirst(preg_replace("[,;]", "", $rw["des_recaudo"])), number_format($rw["vr_digitado"], 2, '.', ','));
			$suma = $suma + $rw["vr_digitado"];
		}
		// consulta recaudo
		$sq = "select * from recaudo_rcgt where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' $fil order by fecha_recaudo";
		$re = $cx->query($sq);
		while ($rw = $re->fetch_assoc()) {
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia,nom_rubro from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = $cx->query($sq10);
			$rw10 = $re10->fetch_assoc();
			printf("
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			</tr>", $rw["cuenta"], $rw10["nom_rubro"], $rw["fecha_recaudo"], $rw["id_manu_rcgt"], $rw["tercero"], ucfirst(preg_replace("[,;]", "", $rw["des_recaudo"])), number_format($rw["vr_digitado"], 2, '.', ','));
			$suma =  $suma + $rw["vr_digitado"];
		}
		// recaudos predial
		$sq = "select * from recaudo_riip where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' $fil order by fecha_recaudo";
		$re = $cx->query($sq);
		while ($rw = $re->fetch_assoc()) {
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia,nom_rubro from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = $cx->query($sq10);
			$rw10 = $re10->fetch_assoc();
			printf("
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			</tr>", $rw["cuenta"], $rw10["nom_rubro"], $rw["fecha_recaudo"], $rw["id_manu_rcgt"], $rw["tercero"], ucfirst(preg_replace("[,;]", "", $rw["des_recaudo"])), number_format($rw["vr_digitado"], 2, '.', ','));
			$suma = $suma + $rw["vr_digitado"];
		}
		// recaudos urbanismo
		$sq = "select * from recaudo_riur where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' $fil order by fecha_recaudo";
		$re = $cx->query($sq);
		while ($rw = $re->fetch_assoc()) {
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia,nom_rubro from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = $cx->query($sq10);
			$rw10 = $re10->fetch_assoc();
			printf("
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			</tr>", $rw["cuenta"], $rw10["nom_rubro"], $rw["fecha_recaudo"], $rw["id_manu_rcgt"], $rw["tercero"], ucfirst(preg_replace("[,;]", "", $rw["des_recaudo"])), number_format($rw["vr_digitado"], 2, '.', ','));
			$suma = $suma + $rw["vr_digitado"];
		}
		// recaudos reteica
		$sq = "select * from recaudo_rtic where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' $fil order by fecha_recaudo";
		$re = $cx->query($sq);
		while ($rw = $re->fetch_assoc()) {
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia,nom_rubro from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = $cx->query($sq10);
			$rw10 = $re10->fetch_assoc();
			printf("
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			</tr>", $rw["cuenta"], $rw10["nom_rubro"], $rw["fecha_recaudo"], $rw["id_manu_rcgt"], $rw["tercero"], ucfirst(preg_replace("[,;]", "", $rw["des_recaudo"])), number_format($rw["vr_digitado"], 2, '.', ','));
			$suma = $suma + $rw["vr_digitado"];
		}
		// recaudos ica
		$sq = "select * from recaudo_rica where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' $fil order by fecha_recaudo";
		$re = $cx->query($sq);
		while ($rw = $re->fetch_assoc()) {
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia,nom_rubro from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = $cx->query($sq10);
			$rw10 = $re10->fetch_assoc();
			printf("
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			</tr>", $rw["cuenta"], utf8_decode($rw10["nom_rubro"]), $rw["fecha_recaudo"], $rw["id_manu_rcgt"], $rw["tercero"], ucfirst(preg_replace("[,;]", "", $rw["des_recaudo"])), number_format($rw["vr_digitado"], 2, '.', ','));
			$suma = $suma + $rw["vr_digitado"];
		}

		// recaudos ica
		$sq = "select * from recaudo_rica1 where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' $fil order by fecha_recaudo";
		$re = $cx->query($sq);
		while ($rw = $re->fetch_assoc()) {
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia,nom_rubro from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = $cx->query($sq10);
			$rw10 = $re10->fetch_assoc();
			printf("
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			</tr>", $rw["cuenta"], $rw10["nom_rubro"], $rw["fecha_recaudo"], $rw["id_manu_rcgt"], $rw["tercero"], ucfirst(preg_replace("[,;]", "", $rw["des_recaudo"])), number_format($rw["vr_digitado"], 2, '.', ','));
			$suma = $suma + $rw["vr_digitado"];
		}

		// recaudos ica
		$sq = "select * from recaudo_rica2 where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' $fil order by fecha_recaudo";
		$re = $cx->query($sq);
		while ($rw = $re->fetch_assoc()) {
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia,nom_rubro from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = $cx->query($sq10);
			$rw10 = $re10->fetch_assoc();
			printf("
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			</tr>", $rw["cuenta"], $rw10["nom_rubro"], $rw["fecha_recaudo"], $rw["id_manu_rcgt"], $rw["tercero"], ucfirst(preg_replace("[,;]", "", $rw["des_recaudo"])), number_format($rw["vr_digitado"], 2, '.', ','));
			$suma = $suma + $rw["vr_digitado"];
		}
		//
		$sq = "select * from recaudo_roit where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' $fil order by fecha_recaudo";
		$re = $cx->query($sq);
		while ($rw = $re->fetch_assoc()) {
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia,nom_rubro from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = $cx->query($sq10);
			$rw10 = $re10->fetch_assoc();
			printf("
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			</tr>", $rw["cuenta"], $rw10["nom_rubro"], $rw["fecha_recaudo"], $rw["id_manu_roit"], $rw["tercero"], ucfirst(preg_replace("[,;]", "", $rw["des_recaudo"])), number_format($rw["vr_digitado"], 2, '.', ','));
			$suma = $suma + $rw["vr_digitado"];
		}
		$sq = "select * from recaudo_tnat where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' $fil order by fecha_recaudo";
		$re = $cx->query($sq);
		while ($rw = $re->fetch_assoc()) {
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia,nom_rubro from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = $cx->query($sq10);
			$rw10 = $re10->fetch_assoc();
			printf("
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			</tr>", $rw["cuenta"], $rw10["nom_rubro"], $rw["fecha_recaudo"], $rw["id_manu_tnat"], $rw["tercero"], ucfirst(preg_replace("[,;]", "", $rw["des_recaudo"])), number_format($rw["vr_digitado"], 2, '.', ','));
			$suma = $suma + $rw["vr_digitado"];
		}
		// fin de la tabla con totales
		$tsuma = number_format($suma, 2, '.', ',');
		echo "<tr>
<td  bgcolor='#E4E4E4' colspan='6' align='right'><b>TOTAL</b></td>
<td  bgcolor='#E4E4E4' align='right'><b>$tsuma<b></td>
</tr>";


		printf("</table></center>");
	} else { // si no tiene persisos de usuario
		echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
		echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
	}
}
	?>
		</body>

		</html>