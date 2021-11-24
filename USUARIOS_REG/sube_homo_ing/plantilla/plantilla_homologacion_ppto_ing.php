<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=homologacion_ingresos.xls");
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
		<table width="800" border="0" align="center">
			<tr>
				<td width="798">
					<div align="center">
						<?php
						//-------
						include('../../config.php');
						$connection = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
						$sql = "SELECT * from fecha";
						$resultado = $connection->query($sql);
						while ($row = $resultado->fetch_assoc()) {
							$id = $row["id_emp"];
							$idxx = $row["id_emp"];
							$id_emp = $row["id_emp"];
						}
						$sq = "SELECT * from car_ppto_ing where id_emp = '$id' order by cod_pptal asc ";
						$re = $connection->query($sq);
						printf("
<center>
<table width='1610' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Cod. Pptal</b></span>
</div>
</td>
<td align='center' width='350'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
<td align='center' width='30'><span class='Estilo4'><b>Tipo</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Cod FUT</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Libre/Condicio</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Acto Adtvo</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>No. Acto Adtvo</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Porcent.</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Valor</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Fondo Local - Ejecucion</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Fondo Local - Tesoreria</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Cod CGR</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Cod Recurso</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Cod OER</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Cod CDA</b></span></td>
<td align='center' width='130'><span class='Estilo4'><b>Ent Recip</b></span></td>
<td align='center' width='130'><span class='Estilo4'><b>Cod SIA</b></span></td>
<td align='center' width='130'><span class='Estilo4'><b>Banco SIA</b></span></td>
<td align='center' width='130'><span class='Estilo4'><b>Cod Cabildos</b></span></td>
<td align='center' width='130'><span class='Estilo4'><b>Fuente Cabildos</b></span></td>
</tr>
");
						while ($rw = $re->fetch_assoc()) {
							$vr_aprob = $rw["ppto_aprob"];
							$cod_pptal = $rw["cod_pptal"];
							$tip_dato = $rw["tip_dato"];
							if ($tip_dato == 'M') {
								printf("
	<span class='Estilo4'>
	<tr>
	<td align='left' bgcolor='#EEEEEE' class='text'> %s </td>
	<td align='left' bgcolor='#EEEEEE'>%s</td>
	<td align='center' bgcolor='#EEEEEE'>%s</td>
	", $rw["cod_pptal"],  preg_replace("[,;]", "", $rw["nom_rubro"]), $rw["tip_dato"]);
							} else {
								printf("
	<span class='Estilo4'>
	<tr>
	<td align='left' class='text'> %s </td>
	<td align='left'>%s</td>
	<td align='center'>%s</td>
	", $rw["cod_pptal"],  preg_replace("[,;]", "", $rw["nom_rubro"]), $rw["tip_dato"]);
							}
							if ($tip_dato == 'M') {
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
							} else {
								$eval1 = $rw["cod_fut"];
								$sql = "SELECT * FROM fut_ingresos where cod_fut = '$eval1'";
								$result = $connection->query($sql);
								if ($result->num_rows == 0) {
									printf("<td align='center' style='background-color:red;'><span class='Estilo4' style='color:white;'>%s</span></td>", $rw["cod_fut"]);
								} else {
									printf("<td align='center' style='background-color:green;'><span class='Estilo4' style='color:white;'>%s</span></td>", $rw["cod_fut"]);
								}
								printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["libre_con_fut"]);
								printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["acto_fut"]);
								printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["num_acto_fut"]);
								printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["porcentaje_fut"]);
								printf("<td align='right'><span class='Estilo4'>%s</span></td>", $rw["vr_fut"]);
								printf("<td align='right'><span class='Estilo4'>%s</span></td>", $rw["fondo_local"]);
								printf("<td align='right'><span class='Estilo4'>%s</span></td>", $rw["fondo_local_tes"]);
								$eval2 = $rw["cod_cgr"];
								$sql = "SELECT * FROM cgr_ingresos where cod_cgr like '$eval2%'";
								$result = $connection->query($sql);
								if ($result->num_rows == 0 || $result->num_rows > 1) {
									printf("<td align='center' style='background-color:red;'><span class='format' style='color:white;'>%s</span></td>", $rw["cod_cgr"]);
								} else {
									printf("<td align='center' style='background-color:green;'><span class='format' style='color:white;'>%s</span></td>", $rw["cod_cgr"]);
								}
								// Campo codigo recurso cgr
								$sq21 = "SELECT * FROM cod_recurso_cgr_ing where cod_rec='$rw[cod_rec]'";
								$re21 = $connection->query($sq21);
								if (($re21->num_rows == 0)) {
									printf("<td align='center' class='text' style='background-color:red;'>%s</td>", $rw["cod_rec"]);
								} else {
									printf("<td align='center' class='text' >%s</td>", $rw["cod_rec"]);
								}
								// campo origen especifico
								$sq22 = "SELECT * FROM oer_cgr_ing  where cod_oer='$rw[oer]'";
								$re22 = $connection->query($sq22);
								if (($re22->num_rows == 0)) {
									printf("<td align='center' class='text'  style='background-color:red;'>%s</td>", $rw["oer"]);
								} else {
									printf("<td align='center' class='text'>%s</td>", $rw["oer"]);
								}
								// Campo cds
								$sq23 = "SELECT * FROM cda_cgr_ing  where cod_cda='$rw[cda]'";
								$re23 =$connection->query($sq23);
								if ($re23->num_rows == 0) {
									printf("<td align='center' class='text' style='background-color:red;'>%s</td>", $rw["cda"]);
								} else {
									printf("<td align='center' class='text'>%s</td>", $rw["cda"]);
								}

								// entidad reciproca cgr
								$sq23 = "SELECT * FROM terceros_cgr_ing  where cod_ter='$rw[ent_recip]'";
								$re23 = $connection->query($sq23);
								if ($re23->num_rows == 0) {
									printf("<td align='center' class='text' style='background-color:red;'>%s</td>", $rw["ent_recip"]);
								} else {
									printf("<td align='center' class='text'>%s</td>", $rw["ent_recip"]);
								}


								// *********************  SIA  ************************************************************************************

								$eval13 = $rw["cod_sia"];
								$sql = "SELECT * FROM codigo_sia where cod_sia='$eval13' and clase='1'";
								$result = $connection->query($sql);
								if ($result->num_rows == 0) {
									printf("<td align='center' style='background-color:red;'><span class='format' style='color:white;'>%s</span></td>", $rw["cod_sia"]);
								} else {
									printf("<td align='center' style='background-color:green;'><span class='format' style='color:white;'>%s</span></td>", $rw["cod_sia"]);
								}
								// Banco sia
								$eval14 = $rw["banco_sia"];
								if ($eval14 != '') {
									$sql = "SELECT * FROM pgcp where cod_pptal='$eval14' and tip_dato='D'";
									$result = $connection->query($sql);
									if ($result->num_rows == 0) {
										printf("<td align='center' style='background-color:red;'><span class='format' style='color:white;'>%s</span></td>", $rw["banco_sia"]);
									} else {
										printf("<td align='center'><span class='format'>%s</span></td>", $rw["banco_sia"]);
									}
								} else {
									printf("<td align='center'><span class='format'>%s</span></td>", $rw["banco_sia"]);
								}
								// Cabildos
								printf("<td align='center' class='text'>%s</td>", $rw["cod_cabildo"]);
								printf("<td align='center' class='text'>%s</td>", $rw["fuente_cabildo"]);
							}
						}
						printf("</tr>");
						printf("</table></center>");
						//--------	
						?>
					</div>
				</td>
			</tr>
		</table>
	</body>

	</html>
<?php
}
?>