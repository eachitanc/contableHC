<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=homologacion_cxp.xls");
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
		//-------
		include('../config.php');

		$connection = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$sql = "select * from fecha";
		$resultado = $connection->query($sql);

		while ($row = $resultado->fetch_assoc()) {
			$id = $row["id_emp"];
			$idxx = $row["id_emp"];
			$id_emp = $row["id_emp"];
		}
		$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$sq = "select * from cxp where id_emp = '$id' order by cod_pptal asc ";
		$re = $cx->query($sq);
		printf("
<center>
<table width='1460' BORDER='1' class='bordepunteado1'>
<tr>
<td  bgcolor='#DCE9E5' align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='text'><b>Cod. Pptal</b></span>
</div>
</td>
<td bgcolor='#DCE9E5' align='center' width='350'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='30'><span class='Estilo4'><b>Tipo</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Cod FUT</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Fuentes Rec</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Uni Eje</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Sit Fondos</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Cod CGR</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Cod Recurso</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>OER</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>CDA</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Vig. Gasto</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Fin. Gasto</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Uni Ejec</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Ent Recip</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Codigo SIA</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Clase pago SIA</b></span></td>
<td bgcolor='#DCE9E5' align='center' width='80'><span class='Estilo4'><b>Banco Pagos</b></span></td>
</tr>
");
		while ($rw = $re->fetch_assoc()) {
			$vr_aprob = $rw["ppto_aprob"];
			$cod_pptal = $rw["cod_pptal"];
			$tip_dato = $rw["tip_dato"];
			printf("
		<tr>
		<td class='text' align='left'> %s </td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='center'>%s</td>
		", $rw["cod_pptal"], preg_replace("[,;]", "", $rw["nom_rubro"]), $rw["tip_dato"]);
			if ($tip_dato == 'M') {
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right' class='text'>  </span></td>");
				printf("<td align='right' class='text'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
				printf("<td align='right'><span class='Estilo4'>  </span></td>");
			} else {
				$eval1 = $rw["cod_fut"];
				$sql = "SELECT * FROM fut_gastos where cod_fut='$eval1'";
				$result = $connection->query($sql);
				if (($result->num_rows == 0)) {
					printf("<td align='center' style='background-color:red;'><span class='Estilo4' style='color:white;'>%s</span></td>", $rw["cod_fut"]);
				} else {
					printf("<td align='center' style='background-color:green;'><span class='Estilo4' style='color:white;'>%s</span></td>", $rw["cod_fut"]);
				}
				printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["fuentes_recursos"]);
				printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["unidad_ejecutora"]);
				printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["situacion"]);


				$eval2 = $rw["cod_cgr"];
				$sql = "SELECT * FROM cgr_gastos where cod='$eval2'";
				$result = $connection->query($sql);
				if (($result->num_rows == 0)) {
					printf("<td align='center' style='background-color:red;'><span class='Estilo4' style='color:white;'>%s</span></td>", $rw["cod_cgr"]);
				} else {
					printf("<td align='center' style='background-color:green;'><span class='Estilo4' style='color:white;'>%s</span></td>", $rw["cod_cgr"]);
				}


				printf("<td align='center'>%s</td>", $rw["cod_rec"]);
				printf("<td align='center' class='text'>%s</td>", $rw["oer"]);
				printf("<td align='center' class='text'>%s</td>", $rw["cda"]);
				printf("<td align='center' ><span class='Estilo4'>%s</span></td>", $rw["vigencia_gasto"]);
				printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["finalidad_gasto"]);
				printf("<td align='center' class='text'>%s</td>", $rw["uni_ejec_cgr"]);
				printf("<td align='center' class='text'>%s</td>", $rw["ent_recip"]);
				$eval13 = $rw["cod_sia"];
				$sql = "SELECT * FROM codigo_sia where cod_sia='$eval13' and clase='2'";
				$result = $connection->query($sql);
				if (($result->num_rows == 0)) {
					printf("<td align='center' style='background-color:red;'><span class='format' style='color:white;'>%s</span></td>", $rw["cod_sia"]);
				} else {
					printf("<td align='center' style='background-color:green;'><span class='format' style='color:white;'>%s</span></td>", $rw["cod_sia"]);
				}
				$eval14 = $rw["clase_pago_sia"];
				if ($eval14 != '') {
					$sql = "SELECT * FROM codigo_sia where cod_sia='$eval14' and clase='3'";
					$result = $connection->query($sql);
					if (($result->num_rows == 0)) {
						printf("<td align='center' style='background-color:red;'><span class='format' style='color:white;'>%s</span></td>", $rw["clase_pago_sia"]);
					} else {
						printf("<td align='center'><span class='format'>%s</span></td>", $rw["clase_pago_sia"]);
					}
				} else {
					printf("<td align='center'><span class='format'>%s</span></td>", $rw["clase_pago_sia"]);
				}

				$eval15 = $rw["banco_pago"];
				if ($eval15 != '') {
					$sql = "SELECT * FROM pgcp where cod_pptal='$eval15' and tip_dato='D'";
					$result = $connection->query($sql);
					if (($result->num_rows == 0)) {
						printf("<td align='center' style='background-color:red;'><span class='format' style='color:white;'>%s</span></td>", $rw["banco_pago"]);
					} else {
						printf("<td align='center'><span class='format'>%s</span></td>", $rw["banco_pago"]);
					}
				} else {
					printf("<td align='center'><span class='format'>%s</span></td>", $rw["banco_pago"]);
				}
			}
			printf("</tr>");
		} //fin while
		printf("</table></center>");
		//--------	
		?>
	</body>

	</html>
<?php
}
?>