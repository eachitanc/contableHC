<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=homologacion_gastos.xls");
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
	</head>

	<body>
		<table width="800" border="0" align="center">
			<tr>
				<td width="798">
					<div align="center">
						<?php
						//-------
						include('../config.php');

						$connection = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
						$sql = "SELECT * from fecha";
						$resultado = $connection->query($sql);
						while ($row = $resultado->fetch_assoc()) {
							$id = $row["id_emp"];
							$idxx = $row["id_emp"];
							$id_emp = $row["id_emp"];
						}
						$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
						$sq = "SELECT * from car_ppto_gas where id_emp = '$id' order by cod_pptal asc ";
						$re = $cx->query($sq);
						printf("
<center>
<table width='1620' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='120'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Cod. Pptal</b></span>
</div>
</td>
<td align='center' width='350'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
<td align='center' width='30'><b>Tipo</b></td>
<td align='center' width='30'><b>Tipo gasto</b></td>
<td align='center' width='80'><span class='Estilo4'><b>Cod FUT</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Fuentes Rec</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Uni Eje</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Sit Fondos</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Vigencia</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Fondo Local</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Cod Gastos<br>Vig. Anterior (Reserv)</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Cod CGR</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Cod Recurso</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>OER</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>CDA</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Vig. Gasto</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Fin. Gasto</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Uni Ejec</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Ent Recip</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Codigo SIA</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Clase pago SIA</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Banco Pagos</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Fuente recursos</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Sectores inversion</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Cod Cabildos</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Fuente Cabildos</b></span></td>
</tr>
");
						while ($rw = $re->fetch_assoc()) {
							$vr_aprob = $rw["ppto_aprob"];
							$cod_pptal = $rw["cod_pptal"];
							$tip_dato = $rw["tip_dato"];
							$nombrer = $rw["nom_rubro"];
							$nom_rubro = preg_replace("[,;]", "", $nombrer);
							if ($tip_dato == 'M') {
								printf("
			<span class='Estilo4'>
			<tr>
			<td align='left' bgcolor='#EEEEEE' class='text'> %s </td>
			<td align='left' bgcolor='#EEEEEE'><span class='Estilo4'> %s </span></td>
			<td align='center'bgcolor='#EEEEEE'>%s</td>
			<td align='left'bgcolor='#EEEEEE'>%s</td>
			", $rw["cod_pptal"], $nom_rubro, $rw["tip_dato"], '');
							} else {
								printf("
			<span class='Estilo4'>
			<tr>
			<td align='left' class='text'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'>%s</span></td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			", $rw["cod_pptal"], $nom_rubro, $rw["tip_dato"], $rw["opc1"]);
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
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
								printf("<td align='right' bgcolor='#EEEEEE'><span class='Estilo4'>  </span></td>");
							} else {
								$eval1 = $rw["cod_fut"];
								$sql = "SELECT * FROM fut_gastos where cod_fut = '$eval1'";
								$result = $connection->query($sql);
								if ($result->num_rows == 0) {
									printf("<td align='center' style='background-color:red;'><span class='Estilo4' style='color:white;'>%s</span></td>", $rw["cod_fut"]);
								} else {
									printf("<td align='center' style='background-color:green;'><span class='Estilo4' style='color:white;'>%s</span></td>", $rw["cod_fut"]);
								}
								printf("<td align='center' class='text'>%s</td>", $rw["fuentes_recursos"]);
								printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["unidad_ejecutora"]);
								printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["situacion"]);
								printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["vigencia"]);
								printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["fondo_local"]);
								printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["cod_ser_deuda"]);

								// ************************************************ CGR ***********************************************************

								$eval2 = $rw["cod_cgr"];
								$sql = "SELECT * FROM cgr_gastos where cod like '$eval2%'";
								$result = $connection->query($sql);
								if ($result->num_rows == 0 || $result->num_rows > 1) {
									printf("<td align='center' style='background-color:red;'><span class='Estilo4' style='color:white;'>%s</span></td>", $rw["cod_cgr"]);
								} else {
									printf("<td align='center' style='background-color:green;'><span class='Estilo4' style='color:white;'>%s</span></td>", $rw["cod_cgr"]);
								}

								//  Codigo del recurso
								$sq21 = "SELECT * FROM cod_recurso_cgr_gastos  where cod='$rw[cod_rec]'";
								$re21 = $connection->query($sq21);
								if (($re21->num_rows == 0)) {
									printf("<td align='center' style='background-color:red;'><span class='Estilo4'>%s</span></td>", $rw["cod_rec"]);
								} else {
									printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["cod_rec"]);
								}

								// codigo recurso

								$sq23 = "SELECT * FROM oer_cgr_gastos  where cod='$rw[oer]'";
								$re23 = $connection->query($sq23);
								if (($re23->num_rows == 0)) {
									printf("<td align='center' class='text' style='background-color:red;'>%s</td>", $rw["oer"]);
								} else {
									printf("<td align='center' class='text'>%s</td>", $rw["oer"]);
								}

								// Campo cds
								$sq24 = "SELECT * FROM cda_cgr_gastos  where cod='$rw[cda]'";
								$re24 = $connection->query($sq24);
								if (($re24->num_rows == 0)) {
									printf("<td align='center' class='text' style='background-color:red;'>%s</td>", $rw["cda"]);
								} else {
									printf("<td align='center' class='text'>%s</td>", $rw["cda"]);
								}
								// Vigencia del gasto
								$sq25 = "SELECT * FROM vigencia_gasto_cgr where cod='$rw[vigencia_gasto]'";
								$re25 =  $connection->query($sq25);
								if (($re25->num_rows == 0)) {
									printf("<td align='center' style='background-color:red;'>%s</td>", $rw["vigencia_gasto"]);
								} else {
									printf("<td align='center'>%s</td>", $rw["vigencia_gasto"]);
								}

								// finalidad del gasto
								$sq27 = "SELECT * FROM finalidad_gasto_cgr  where cod='$rw[finalidad_gasto]'";
								$re27 =  $connection->query($sq27);
								if (($re27->num_rows == 0)) {
									printf("<td align='center' style='background-color:red;'><span class='Estilo4'>%s</span></td>", $rw["finalidad_gasto"]);
								} else {
									printf("<td align='center'><span class='Estilo4'>%s</span></td>", $rw["finalidad_gasto"]);
								}


								// 	Unidad ejecutora
								$sq27 = "SELECT * FROM uni_eje_cgr_gas where cod='$rw[uni_ejec_cgr]'";
								$re27 =  $connection->query($sq27);
								if (($re27->num_rows == 0)) {
									printf("<td align='center'  class='text' style='background-color:red;'>%s</td>", $rw["uni_ejec_cgr"]);
								} else {
									printf("<td align='center'  class='text'>%s</td>", $rw["uni_ejec_cgr"]);
								}

								// entidad reciproca cgr
								$sq23 = "SELECT * FROM terceros_cgr_ing  where cod_ter='$rw[ent_recip]'";
								$re23 = $connection->query($sq23);
								if (($re23->num_rows == 0)) {
									printf("<td align='center' class='text' style='background-color:red;'>%s</td>", $rw["ent_recip"]);
								} else {
									printf("<td align='center' class='text'><span class='Estilo4'>%s</span></td>", $rw["ent_recip"]);
								}

								// *************************************************   CGR *********************************************		

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
										printf("<td align='center' style='background-color:red;'><span class='format' style='color:white;'>%s</span></td>", $rw["banco_sia"]);
									} else {
										printf("<td align='center'><span class='format'>%s</span></td>", $rw["banco_pago"]);
									}
								} else {
									printf("<td align='center'><span class='format'>%s</span></td>", $rw["banco_pago"]);
								}
								// fuente de recursos
								/*$fuentes=array("SGP","REGALIAS","COFINANCIACION","RENTAS CEDIDAS","RECURSOS PROPIOS","OTROS"); 
			$i=0;
			for ($i=0;$i<=5;$i++)
			{
			  if ($rw["fuente_recursos"] == $fuentes[$i]) 
			  {
			  	$error = "bgcolor=whith";
				break;
			  }else{
			  	$error = "bgcolor=red";
			  }
			  
			} */
								printf("<td align='center' bgcolor='#FFFF00' >%s</td>", 'Homologar Pgcp');
								$sectores = array("C1A", "C1B", "C1C", "C1D", "C1E", "C1F", "C1G", "C1H", "C1I", "C1J", "C1K", "C1L", "C2A", "C2B", "C2C", "C2D", "C2E", "C2F", "C2G", "C2H", "C2I", "C2J", "C2K", "C2L", "C3A", "C3B", "C3C", "C3D", "C3E", "C3F", "C3G", "C3H", "C3I", "C3J", "C3K", "C3L");
								if ($rw["opc1"] == 'INVERSION') {
									$j = 0;
									for ($j = 0; $j <= 35; $j++) {
										if ($rw["sectores_inversion"] == $sectores[$j]) {
											$error2 = "bgcolor=whith";
											break;
										} else {
											$error2 = "bgcolor=red";
										}
									} // end for
								} else {
									$error2 = "bgcolor=#EEEEEE";
								}
								printf("<td align='center' $error2>%s</td>", $rw["sectores_inversion"]);
								// Cabildos
								printf("<td align='center' class='text'><span class='Estilo4'>%s</span></td>", $rw["cod_cabildo"]);
								printf("<td align='center' class='text'><span class='Estilo4'>%s</span></td>", $rw["fuente_cabildo"]);
							}
							printf("</tr>");
						} //fin while
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