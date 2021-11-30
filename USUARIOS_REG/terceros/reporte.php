<?php
set_time_limit(600);
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=REPORTE_DE_TERCEROS.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Documento sin título</title>
	</head>

	<body>
		<table border="1">
			<tr>
				<td bgcolor='#DCE9E5'>CLASE</td>
				<td bgcolor='#DCE9E5'>TIPO_ID</td>
				<td bgcolor='#DCE9E5'>NUM_ID</td>
				<td bgcolor='#DCE9E5'>DV</td>
				<td bgcolor='#DCE9E5'>CLASE</td>
				<td bgcolor='#DCE9E5'>REGIMEN</td>
				<td bgcolor='#DCE9E5'>ENT_OFI</td>
				<td bgcolor='#DCE9E5'>PRI_APE</td>
				<td bgcolor='#DCE9E5'>SEG_APE</td>
				<td bgcolor='#DCE9E5'>PRI_NOM</td>
				<td bgcolor='#DCE9E5'>SEG_NOM</td>
				<td bgcolor='#DCE9E5'>RAZ_SOC</td>
				<td bgcolor='#DCE9E5'>PAIS</td>
				<td bgcolor='#DCE9E5'>DPTO</td>
				<td bgcolor='#DCE9E5'>MPIO</td>
				<td bgcolor='#DCE9E5'>DIR</td>
				<td bgcolor='#DCE9E5'>TEL</td>
				<td bgcolor='#DCE9E5'>FAX</td>
				<td bgcolor='#DCE9E5'>EMAIL</td>
				<td bgcolor='#DCE9E5'>CONTABILIDAD</td>
				<td bgcolor='#DCE9E5'>PPTO</td>
				<td bgcolor='#DCE9E5'>TESORERIA</td>
				<td bgcolor='#DCE9E5'>ALMACEN</td>
				<td bgcolor='#DCE9E5'>INTERVENTOR</td>
			</tr>
			<?php
			include('../config.php');
			$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
			$sq2 = "select * from terceros_naturales order by num_id asc";
			$rs = $cx->query($sq2);
			while ($rw = $rs->fetch_assoc()) {
				$rnsoc = isset($rw['raz_soc2']) ? $rw['raz_soc2'] : '';
				echo ("
<tr>
    <td>NATURAL</td>
	<td>" . $rw['tipo_id'] . "</td>
	<td>" . $rw['num_id'] . "</td>
	<td>" . $rw['dv'] . "</td>
	<td>" . $rw['clase'] . "</td>
	<td>" . $rw['ent_ofi'] . "</td>
	<td>" . $rw['regimen'] . "</td>
	<td>" . $rw['pri_ape'] . "</td>
	<td>" . $rw['seg_ape'] . "</td>
	<td>" . $rw['pri_nom'] . "</td>
	<td>" . $rw['seg_nom'] . "</td>
	<td>" . $rnsoc . "</td>
	<td>" . $rw['pais'] . "</td>
	<td>" . $rw['dpto'] . "</td>
	<td>" . $rw['mpio'] . "</td>
	<td>" . $rw['dir'] . "</td>
	<td>" . $rw['tel'] . "</td>
	<td>" . $rw['fax'] . "</td>
	<td>" . $rw['email'] . "</td>
	<td>" . $rw['contabilidad'] . "</td>
	<td>" . $rw['ppto'] . "</td>
	<td>" . $rw['tesoreria'] . "</td>
	<td>" . $rw['almacen'] . "</td>
	<td>" . $rw['interventor'] . "</td>
</tr>
");
			}
			$sq2 = "select * from terceros_juridicos order by num_id2 asc";
			$rs = $cx->query($sq2);
			while ($rw = $rs->fetch_assoc()) {
				echo ("
<tr>
    <td>JURIDICOS</td>
	<td>" . $rw['tip_id2'] . "</td>
	<td>" . $rw['num_id2'] . "</td>
	<td>" . $rw['dv2'] . "</td>
	<td>" . $rw['clase2'] . "</td>
	<td>" . $rw['regimen2'] . "</td>
	<td>" . $rw['ent_ofi2'] . "</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td>" . $rw['raz_soc2'] . "</td>
	<td>" . $rw['pais2'] . "</td>
	<td>" . $rw['dpto2'] . "</td>
	<td>" . $rw['mpio2'] . "</td>
	<td>" . $rw['dir2'] . "</td>
	<td>" . $rw['tel2'] . "</td>
	<td>" . $rw['fax2'] . "</td>
	<td>" . $rw['em2'] . "</td>
	<td>" . $rw['contabilidad2'] . "</td>
	<td>" . $rw['ppto2'] . "</td>
	<td>" . $rw['tesoreria2'] . "</td>
	<td>" . $rw['almacen2'] . "</td>
	<td>" . $rw['interventor'] . "</td>
</tr>
");
			}

			?>

		</table>


	</body>

	</html>
<?php
}
?>