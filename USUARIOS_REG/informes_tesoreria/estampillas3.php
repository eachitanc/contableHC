<?php
set_time_limit(1200);
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=RELACION_DE_ESTAMPILLAS.xls");
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
		$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$sqlxx = "select * from fecha";
		$resultadoxx = $connectionxx->query($sqlxx);

		while ($rowxx = $resultadoxx->fetch_assoc()) {

			$idxx = $rowxx["id_emp"];
			$id_emp = $rowxx["id_emp"];
			$ano = $rowxx["ano"];
		}

		$sqlxx3 = "select * from fecha_ini_op";
		$resultadoxx3 = $connectionxx->query($sqlxx3);

		while ($rowxx3 = $resultadoxx3->fetch_assoc()) {
			$desde = $rowxx3["fecha_ini_op"];
		}
		?>
		<form name="a" method="post" action="retefuente.php">
		</form>
		<?php
		$fecha_ini = $_POST['fecha_ini'];
		$fecha_fin = $_POST['fecha_fin'];
		$cuenta = $_POST['cuenta'];
		$cuenta2 = explode(",", $cuenta);
		if (!isset($cuenta2[1])) {
			$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta2[0]' and credito > 0 order by fecha asc ";
		} else {
			$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and (cuenta = '$cuenta2[0]' or cuenta = '$cuenta2[1]')  and credito > 0 order by fecha asc ";
		}
		//-------
		$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$cx->query("TRUNCATE TABLE estamp_det") or die(mysqli_error($cx));

		$sq4 = "select nombre from desc_list where cuenta = '$cuenta'";
		$re4 = $cx->query($sq4);
		$rw4 = $re4->fetch_assoc();
		$nombre = strtoupper($rw4['nombre']);
		$cta = isset($cuenta2[1]) ? $cuenta2[1] : '';
		$cuenta3 = $cuenta2[0] . $cta;
		// inicio consulta
		//$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta' and credito > 0 order by fecha asc ";
		// Cambiar consulta
		$re = $cx->query($sq) or die(mysqli_error($cx));
		while ($rw = $re->fetch_assoc()) {
			$sq6 = "select sum(credito) as total from lib_aux where (cuenta like '1110%' or cuenta like '1105%' or cuenta like '1908%') and id_auto ='$rw[id_auto]' group by id_auto";
			$re6 = $cx->query($sq6);
			$rw6 = $re6->fetch_assoc();
			$sq2 = "select cuenta,credito from lib_aux where (cuenta like '1110%' or cuenta like '1105%' or cuenta like '1908%') and id_auto ='$rw[id_auto]'";
			$re2 = $cx->query($sq2);
			while ($rw2 =  $re2->fetch_assoc()) {
				if ($rw2['cuenta'] == '110501') {
					$valor = $rw['credito'];
				} else {
					if ($rw6['total'] == 0) echo "<br> doc " . $rw['dcto'] . " --->" . $rw['credito'] . " --->" . $rw['id_auto'];
					$por = $rw2['credito'] / $rw6['total'];
					$valor = $rw['credito'] * $por;
				}


				$sq5 = "INSERT INTO estamp_det (tipo,fecha, dcto, tercero, ccnit, detalle, credito, cta_bco ) values ('$rw[cuenta]','$rw[fecha]','$rw[dcto]','$rw[tercero]','$rw[ccnit]','$rw[detalle]','$valor','$rw2[cuenta]')";
				$res5 = $cx->query($sq5);
				$valor = 0;
				$por = 0;
			}
		} // Fin for
		// CONSULTA PARA MOSTRAR RESULTADOS
		$sq7 = "select distinct ccnit as ccnits from estamp_det order by ccnit asc";
		$re7 = $cx->query($sq7);
		$fi7 = $re7->num_rows;
		$suma = 0;
		echo "<br>";
		printf("
		<center>
		<table width='2400' BORDER='0' class='bordepunteado1'>
		<tr>
			<td bgcolor='#ffffff' align='center' colspan='5'><b>ALCALDIA MUNICIPAL</b></td>
		</tr>
		<tr>
			<td bgcolor='#ffffff' align='center' colspan='5'><b>RELACION DE DESCUENTOS DE $nombre</b></td>
		</tr>
		<tr>
			<td bgcolor='#ffffff' align='center' colspan='5'><b>PERIODO $fecha_ini A $fecha_fin </b></td>
		</tr>
        </table></center><br><br>
		");
		while ($rw7 =  $re7->fetch_assoc()) {
			$sq8 = "select tercero from estamp_det where ccnit ='$rw7[ccnits]'";
			$re8 = $cx->query($sq8);
			$rw8 =  $re8->fetch_assoc();

			echo "
		<tr>
			<td align='left' colspan='5'><b>$rw8[tercero] - CC/NIT $rw7[ccnits]</b></td>
		</tr>
	";
			printf("
		<center>
		<table width='2400' BORDER='1' class='bordepunteado1'>
		<tr>
		<td bgcolor='#DCE9E5' align='center' width='100'>Fecha</td>
		<td bgcolor='#DCE9E5' align='center' width='100'>Documento</td>
		<td bgcolor='#DCE9E5' align='left' width='200'>Concepto</td>
		<td bgcolor='#DCE9E5' align='right' width='150'>Valor</td>
		<td bgcolor='#DCE9E5' align='center' width='100'>Cta</td>
		</tr>
		");
			$sq3 = "select * from estamp_det where ccnit ='$rw7[ccnits]' order by tipo asc";
			$re3 = $cx->query($sq3);
			while ($rw3 =  $re3->fetch_assoc()) {
				$tipo = '';
				if ($rw3['tipo'] == '29109001') $tipo = 'PROCULTURA';
				if ($rw3['tipo'] == '29059008') $tipo = 'ADULTO MAYOR';
				if ($rw3['tipo'] == '29059006') $tipo = 'UDENAR';
				if ($rw3['tipo'] == '291013') $tipo = 'CONTRIBUCIONES';
				if ($rw3['tipo'] == '29109002') $tipo = 'PUBLICACIONES';
				echo "
		<tr>
			<td align='center'>$rw3[fecha]</td>
			<td align='center'>$rw3[dcto]</td>
			<td align='left'>$rw3[detalle]</td>
			<td align='right'>$rw3[credito]</td>
			<td align='center'>$rw3[cta_bco]</td>
	</tr>
	";
				$suma = $suma + $rw3['credito'];
			}

			echo "
		<tr>
			<td bgcolor='#F7F7F7' align='left' colspan='3'><b>TOTAL</b></td>
			<td bgcolor='#F7F7F7' align='right'><b>$suma<b></td>
			<td bgcolor='#F7F7F7' align='right'>&nbsp;</td>
		</tr>
	";
			printf("</table></center><br><br>");
			$total = $total + $suma;
			$suma = 0;
		}
		//--------	
		printf("
		<center>
		<table width='2400' BORDER='0' class='bordepunteado1'>
		<tr>
			<td bgcolor='#FF9900' align='left' colspan='3'><b>GRAN TOTAL</b></td>
			<td bgcolor='#FF9900' align='right'><b>$total<b></td>
			<td bgcolor='#FF9900' align='right'>&nbsp;</td>
		</tr>
        </table></center><br><br>
		");

		?>
	</body>

	</html>






<?php
}
?>