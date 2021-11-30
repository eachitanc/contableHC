<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	$ver_boton = '';
	$filtro = '';
	// verifico permisos del usuario
	include('../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Conexion no Exitosa");

	$sql = "SELECT ppto FROM usuarios2 where login = '$_SESSION[login]'";
	$res = $cx->query($sql);
	$rw = $res->fetch_assoc();
	if ($rw['ppto'] == 'SI') {

?>

		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<title>CONTAFACIL</title>



			<style type="text/css">
				.Estilo2 {
					font-size: 9px
				}

				.Estilo4 {
					font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
					font-size: 10px;
					color: #333333;
				}

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

				.Estilo7 {
					font-family: Verdana, Arial, Helvetica, sans-serif;
					font-size: 9px;
					color: #666666;
				}
			</style>

			<style>
				.fc_main {
					background: #FFFFFF;
					border: 1px solid #000000;
					font-family: Verdana;
					font-size: 10px;
				}

				.fc_date {
					border: 1px solid #D9D9D9;
					cursor: pointer;
					font-size: 10px;
					text-align: center;
				}

				.fc_dateHover,
				TD.fc_date:hover {
					cursor: pointer;
					border-top: 1px solid #FFFFFF;
					border-left: 1px solid #FFFFFF;
					border-right: 1px solid #999999;
					border-bottom: 1px solid #999999;
					background: #E7E7E7;
					font-size: 10px;
					text-align: center;
				}

				.fc_wk {
					font-family: Verdana;
					font-size: 10px;
					text-align: center;
				}

				.fc_wknd {
					color: #FF0000;
					font-weight: bold;
					font-size: 10px;
					text-align: center;
				}

				.fc_head {
					background: #000066;
					color: #FFFFFF;
					font-weight: bold;
					text-align: left;
					font-size: 11px;
				}
			</style>
			<style type="text/css">
				table.bordepunteado1 {
					border-style: solid;
					border-collapse: collapse;
					border-width: 2px;
					border-color: #004080;
				}

				.Estilo8 {
					color: #990000
				}
			</style>


			<script>
				function validar(e) {
					tecla = (document.all) ? e.keyCode : e.which;
					if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
					patron = /\d/; //ver nota 
					te = String.fromCharCode(tecla);
					return patron.test(te);
				}
			</script>


			<link type="text/css" rel="stylesheet" href="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
			</LINK>
			<SCRIPT type="text/javascript" src="../calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

			<link href="../nobordeimg.css" rel="stylesheet" type="text/css" />



		</head>

		<body>

			<table width="800" border="0" align="center">
				<tr>

					<td colspan="3">
						<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
							<div align="center">
								<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
							</div>
						</div>
					</td>
				</tr>


				<tr>
					<td colspan="3">
						<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
							<div align="center">
								<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
									<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
										<div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
							<div align="center" class="Estilo4"><strong>MOVIMIENTOS - EJECUCION PRESUPUESTO DE GASTOS</strong></div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
							<form method="post" action="mvto.php">
								<table width="800" border="0" align="center">
									<tr>
										<td width="600">
											<?php
											include('../config.php');
											$mesh = array('cc', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
											$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
											$sqlxx = "select * from fecha";
											$resultadoxx = $connectionxx->query($sqlxx);
											// Datos para mostrar listas
											$ini = isset($_GET['ini']) ? $_GET['ini'] : '';
											$fin = isset($_GET['fin']) ? $_GET['fin'] : '';
											$indice = isset($_GET['k']) ? $_GET['k'] : '';
											$muestra = 250;
											if (!isset($_GET['ini'])) {
												$ini = 0;
												$fin = $muestra;
											}


											while ($rowxx = $resultadoxx->fetch_assoc()) {

												$idxx = $rowxx["id_emp"];
												$id_emp = $rowxx["id_emp"];
												$ano = $rowxx["ano"];
											}
											//list($an, $me, $di)  = explode('/', $ano);
											//$f1 = "$an/$me/01";
											//$f2 = "$an/$me/31";
											?>
											<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
												<div align="center"><span class="Estilo4"><strong>Seleccione el Documento Fuente </strong>: </span>
													<select name="nn" class="Estilo4" style="width: 350px;">
														<?php
														include('../config.php');
														$db = new mysqli($server, $dbuser, $dbpass, $database);

														$strSQL = "SELECT * FROM dctos_fuente_comprobantes  WHERE id_emp = '$idxx' AND ppto_gas = 'SI' ";
														$rs = $db->query($strSQL);
														while ($r = $rs->fetch_assoc()) {
															echo "<OPTION VALUE=\"" . $r["cod"] . "\">" . $r["cod"] . " - " . $r["nombre"] . "</b></OPTION>";
														}

														$sq3 = "select cargo from usuarios2 where login = '$_SESSION[login]'";
														$re3 = $db->query($sq3);
														$rw3 = $re3->fetch_assoc();
														if ($rw3['cargo'] == "REVISOR") {
															$ver_boton = "style=display:none";
														}

														?>
													</select>
												</div>
											</div>
										</td>
										<td width="190">
											<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
												<div align="center">
													<input name="fec" type="hidden" value=" <?php printf($ano); ?> " />
													<input name="Submit" type="submit" class="Estilo4" value="Seleccionar Documento" />
												</div>
											</div>
										</td>
									</tr>
								</table>
							</form>

							<div align="center">



								<?php

								$archivo = "mvto.php";

								$a = "";
								if (isset($_POST['nn'])) {
									$a = $_POST['nn'];
								}

								if (isset($_GET['a'])) {
									$a = $_GET['a'];
								}

								if ($a == 'CDPP') {
								?>
									<br />
									<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;"> <span class="Estilo4 Estilo8"><strong>CERTIFICADO DE DISPONIBILIDAD PRESUPUESTAL CDP

											</strong></span>

										<br /><br />
										<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:500px'>
											<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
												<a href="nuevo_cdpp.php" target="_parent">...::: NUEVO CERTIFICADO DE DISPONIBILIDAD PRESUPUESTAL :::... </a>
											</div>
										</div>
										<br />
										<br />
										<div align="left" style="padding-left:3px;cursor:pointer"><input type="button" name="boton" value="Importar" style="background:#72A0CF; color:#FFFFFF; border:none" onclick="window.open('upload.php','_self')" />
											<input type="button" name="boton" value="Nomina" style="background:#72A0CF; color:#FFFFFF; border:none" onclick="window.open('menu_nomina.php','_self')" />
										</div>
										<?php
										include('../objetos/filtro.php');

										if ($pendiente == "") {
										} else {
											//-------

											include('../config.php');
											$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
											if (isset($_POST["buscar"])) {
												$filtro = "and (des LIKE  '%$buscar%' OR cdpp LIKE  '%$buscar%') ";
											} else {
												$filtro = '';
											}


											$a = "select consecutivo, tercero,  fecha_reg, cdpp, des from cdpp where id_emp = '$id_emp' and contab = 'NO'";
											if (empty($tercero)) {
												$c = "";
											} else {
												$c = "and tercero =$tercero2";
											}
											if ($fecha2 == "MES") {
												$f = "and fecha_reg between '$f1' and '$f2'";
											}
											if ($fecha2 == "DIA") {
												$f = "and fecha_reg ='$fechafil'";
											}
											if ($fecha2 == "A�O") {
												$f = "and fecha_reg between '$a1' and '$a2'";
											}
											$gby = "group by consecutivo";
											$orden = "order by fecha_reg,cdpp desc";
											$sql = "$a $c $filtro $f $gby $orden";

											$re = $cx->query($sql);




											printf("
<center>

<table width='900' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'><b>CODIGO</b></span>
</div>
</td>

<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION DEL CDPP</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR CDPP:</b></span></td>
<td align='center'><span class='Estilo4'><b>X REGISTRAR:</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>

</tr>


");

											while ($rw = $re->fetch_assoc()) {

												$axz = $rw["consecutivo"];
												$resulta = $cx->query("select SUM(valor) AS TOTAL from cdpp WHERE consecutivo = '$axz' AND id_emp='$id_emp'");
												$row = $resulta->fetch_row();
												$total = $row[0];
												$nuevo_total = $total;

												$sq3 = "select sum(vr_digitado) from crpp where id_auto_cdpp ='$axz' group by id_auto_cdpp";
												$rs3 = $cx->query($sq3);
												$rw3 = $rs3->fetch_assoc();
												$saldo_reg = $total - $rw3['sum(vr_digitado)'];

												printf("
<span class='Estilo4'>
<tr>
<td align='left'  bgcolor='#DCE9E5'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><div style='padding-left:10px; padding-top:3px; padding-right:3px; padding-bottom:3px;'><span class='Estilo4'> %s </span></div></td>
<td align='right'><span class='Estilo4'> %s &nbsp;</span></td>
<td align='right'><span class='Estilo4'> %s &nbsp;</span></td>


<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"nuevo_crpp.php?a=%s\" style='color:#0033FF'>Registrar</a>
</span>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<a href=\"borra_cdpp2.php?id=%s\" title ='Eliminar'>
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'></a>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"modifica_cdpp2.php?id=%s\" title='Modificar / Consultar'>
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'></a>
</td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_cdpp.php?d=%s\" target=\"_blank\"  title ='Imprimir / Consultar'>
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir / Consultar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"hiscdp.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1000,height=600,scrollbars=yes'); return false;\"  title ='Historia del Documento'>
<img $ver_boton src='../simbolos/fuentes/historia.png' width='20' height='20' border='0' title='Historia del Documento'></a>
</td>


</tr>", "CDPP" . $rw["cdpp"], $rw["fecha_reg"], substr($rw["des"], 0, 85), number_format($nuevo_total, 2, ',', '.'), number_format($saldo_reg, 2, ',', '.'), $rw["consecutivo"], $rw["consecutivo"], $rw["consecutivo"], $rw["consecutivo"], $rw["consecutivo"]);
											}

											printf("</table></center><br><br>");
											//--------  


											$cx = null;
										}



										//-------
										if (!isset($registrado)) {
										} else {
										?>
											<br />
											<div><span class="Estilo4 Estilo8"><strong>CDPP - REGISTRADOS POR EL VALOR TOTAL</strong></span></div>

										<?php
											include('../config.php');
											$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
											//$sq = "select consecutivo, tercero,  fecha_reg, cdpp, des from cdpp where id_emp = '$id_emp' and contab = 'SI'    ";
											//$re = $cx->query($sq);
											$limitar = "limit $ini,$fin";
											if (isset($_POST["buscar"])) {
												if ($_POST["buscar"] != "") {
													$filtro = "and (des LIKE  '%$buscar%' OR cdpp LIKE  '%$buscar%') ";
													$limitar = '';
												}
											} else {
												$filtro = '';
												$limitar = '';
											}

											$a = "select consecutivo, tercero,  fecha_reg, cdpp, des from cdpp where id_emp = '$id_emp' and contab = 'SI' ";
											if (empty($tercero)) {
												$c = "";
											} else {
												$c = "and tercero =$tercero2";
											}
											if ($fecha2 == "MES") {
												$f = "and fecha_reg between '$f1' and '$f2'";
											}
											if ($fecha2 == "DIA") {
												$f = "and fecha_reg ='$fechafil'";
											}
											if ($fecha2 == "A�O") {
												$f = "and fecha_reg between '$a1' and '$a2'";
											}
											$gby = "group by consecutivo";
											$orden = "order by fecha_reg desc,cdpp desc";
											// Gerero listas de paginacion
											$sql = "$a  $c $filtro $f $gby $orden";
											$resf = $cx->query($sql);
											$filas = $resf->num_rows;
											$listas = ceil($filas / $muestra);
											$sql2 = "$a $c $filtro $f  $gby  $orden $limitar ";


											$re = $cx->query($sql2);




											printf("
<center>

<table width='900' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'><b>CODIGO</b></span>
</div>
</td>

<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>DESCRIPCION DEL CDPP</b></span></td>
<td align='center'><span class='Estilo4'><b>X VALOR DE</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>



</tr>


");

											while ($rw = $re->fetch_assoc()) {

												$axz1 = $rw["consecutivo"];
												$link = new mysqli($server, $dbuser, $dbpass, $database);
												$sql = "select SUM(valor) AS TOTAL from cdpp WHERE consecutivo = '$axz1' AND id_emp='$id_emp'";
												$resulta = $link->query($sql);
												$row = $resulta->fetch_assoc();
												$total = $row['TOTAL'];
												$nuevo_total1 = $total;

												printf("
			<span class='Estilo4'>
			<tr>
			
			<td align='left' bgcolor='#DCE9E5'><span class='Estilo4'>&nbsp; %s </span></td>
			<td align='center'><span class='Estilo4'> %s </span></td>
			<td align='left'><div style='padding-left:10px; padding-top:3px; padding-right:3px; padding-bottom:3px;'><span class='Estilo4'> %s </span></div></td>
			<td align='right'><span class='Estilo4'> %s &nbsp;</span></td>
			
			
			<td align='center' bgcolor='#DCE9E5'>
			<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
			<span class='Estilo4'>
			<a href=\"imp_cdpp.php?d=%s\" target=\"_blank\" title='Imprimir / Consultar'>
			<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir / Consultar' >
			</span>
			</div>
			</td>
			
			<td align='center' bgcolor='#DCE9E5'>
			<span class='Estilo4'>
			<a href=\"hiscdp.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1000,height=600,scrollbars=yes'); return false;\" title='Historia del Documento'>
			<img $ver_boton src='../simbolos/fuentes/historia.png' width='20' height='20' border='0' title='Historia del Documento' ></a>
			</span>
			</td>
			
			</tr>", "CDPP" . $rw["cdpp"], $rw["fecha_reg"], substr($rw["des"], 0, 95), number_format($nuevo_total1, 2, ',', '.'), $rw["consecutivo"], $rw["consecutivo"]);
											} // fin while

											printf("</table></center><br><br>");
											//--------  
											echo "<&nbsp;";
											for ($i = 0; $i < $listas; $i++) {
												$inicio = ($i * $muestra) + 1;
												$k = $i + 1;
												if ($k == $indice) {
													echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=CDPP&k=$k&nn=CDPP'><b>$k</b></a>&nbsp;";
												} else {
													echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=CDPP&k=$k&nn=CDPP'>$k</a>&nbsp;";
												}
											}
											echo ">&nbsp;";
										} // fin else

									} // fin in CDPP




									//****************************************************** FIN CDP
									if ($a == 'CRPP') {

										?>

										<div class="Estilo4 Estilo8" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
											<div align="center"><strong> CERTIFICADOS DE REGISTRO PRESUPUESTAL<br /><br />
												</strong>
											</div>
										</div>
										<br />
										<div align="left" style="padding-left:3px;"><input type="button" name="boton" value="Obligar por lotes" style="background:#72A0CF; color:#FFFFFF; border:none" onclick="window.open('obligar_lotes.php','_self')" /></div>
										<?php

										include('../objetos/filtro.php');

										if ($pendiente == "") {
										} else {


											$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

											if (isset($_POST["buscar"])) {
												$filtro = "and (id_manu_crpp LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR detalle_crpp LIKE '%$buscar%' or id_manu_cdpp like '%$buscar%')";
											} else {
												$filtro = '';
											}

											$a = "select id_auto_crpp,id_auto_cdpp, id_manu_crpp, id_manu_cdpp, fecha_crpp, tercero , contrato, t_humano, inversion, subsidiado  from crpp where id_emp = '$id_emp' and ctrl = 'NO' ";
											if (empty($tercero)) {
												$c = "";
											} else {
												$c = "and tercero =$tercero2";
											}
											if ($fecha2 == "MES") {
												$f = "and fecha_crpp between '$f1' and '$f2'";
											}
											if ($fecha2 == "DIA") {
												$f = "and fecha_crpp ='$fechafil'";
											}
											if ($fecha2 == "A�O") {
												$f = "and fecha_crpp <= '$a2'";
											}
											$gby = "group by id_auto_crpp";
											$orden = "order by fecha_crpp,id_manu_crpp desc";
											$sq2 = "$a $c $filtro $f $gby $orden";

											$re2 = $cx->query($sq2);

											printf("
<center>
<table width='900' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CRPP</b></span>
</div>
</td>

<td align='center'><span class='Estilo4'><b>CDPP</b></span></td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>VALOR CRPP</b></span></td>
<td align='center'><span class='Estilo4'><b>X OBLIGAR</b></span></td>

<td align='center' colspan=5><span class='Estilo4'><b></b></span></td>
<td align='center' colspan=2><span class='Estilo4'><b>SIA</b></span></td>
</tr>

");

											while ($rw2 = $re2->fetch_assoc()) {

												$axz11 = $rw2["id_auto_crpp"];
												$resulta = $cx->query("select SUM(vr_digitado) AS TOTAL from crpp WHERE id_auto_crpp = '$axz11' AND id_emp='$id_emp'");
												$row = $resulta->fetch_row();
												$total = $row[0];
												$resulta2 = $cx->query("select SUM(vr_digitado) AS TOTAL from cobp WHERE id_auto_crpp = '$axz11' AND id_emp='$id_emp'");
												$row2 = $resulta2->fetch_row();
												$total2 = $row2[0];

												$nuevo_total11 = $total;
												$saldo = $total  - $total2;

												printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>

<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><div style='padding-left:10px; padding-top:3px; padding-right:3px; padding-bottom:3px;'><span class='Estilo4'> %s </span></div></td>
<td align='right'><span class='Estilo4'>%s&nbsp;</span></td>
<td align='right'><span class='Estilo4'>%s&nbsp;</span></td>



<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a $ver_boton href=\"nuevo_cobp.php?id0=%s\" style='color:#0033FF'>Obligar</a>
</span>
</div>
</td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"borra_crpp.php?id1=%s\" title='Eliminar'>
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"modifica_crpp.php?id1a=%s\" title='Modificar / Consultar'>
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar / Consultar'></a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_crpp.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'></a>
</a>
</span>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"hiscrp.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1000,height=600,scrollbars=yes'); return false;\"  title ='Historia del Documento'>
<img $ver_boton src='../simbolos/fuentes/historia.png' width='20' height='20' border='0' title='Historia del Documento'></a>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_crppsia.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/rp.png' width='20' height='20' border='0' title='Imprimir'></a>
</a>
</span>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_cdppsia.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/cdp.png' width='20' height='20' border='0' title='Imprimir'></a>
</a>
</span>
</td>

</tr>", $rw2["id_manu_crpp"], $rw2["id_manu_cdpp"], $rw2["fecha_crpp"], $rw2["tercero"], number_format($nuevo_total11, 2, ',', '.'), number_format($saldo, 2, ',', '.'), $rw2["id_auto_crpp"], $rw2["id_auto_crpp"], $rw2["id_auto_crpp"], $rw2["id_auto_crpp"], $rw2["id_auto_crpp"], $rw2["id_auto_crpp"], $rw2["id_auto_cdpp"]);
											}

											printf("</table></center>");
										}


										if (!isset($registrado)) {
										} else {
										?>
											<BR />
											<div class="Estilo4 " style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
												<div align="center"><strong> CERTIFICADOS DE REGISTRO PRESUPUESTAL<br />
														<br />
														<span class="Estilo4 Estilo8"><strong> OBLIGADOS POR EL VALOR TOTAL <br><?php echo $mesh[$me + 0] . " DE " . $an; ?></strong></span> <br />
													</strong><br />
												</div>
											</div>
											<br />

										<?php
											$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
											$limitar = "limit $ini,$fin";
											if (isset($_POST["buscar"])) {
												$filtro = "and (id_manu_crpp LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR detalle_crpp LIKE '%$buscar%' or id_manu_cdpp like '%$buscar%') ";
												$limitar = '';
											} else {
												$filtro = '';
												$limitar = '';
											}

											$a = "select id_auto_crpp,id_auto_cdpp, id_manu_crpp, id_manu_cdpp , id_auto_cdpp, fecha_crpp, tercero , contrato, t_humano, inversion, subsidiado  from crpp where id_emp = '$id_emp' and ctrl = 'SI'";
											if (empty($tercero)) {
												$c = "";
											} else {
												$c = "and tercero =$tercero2";
											}
											if ($fecha2 == "MES") {
												$f = "and fecha_crpp between '$f1' and '$f2'";
											}
											if ($fecha2 == "DIA") {
												$f = "and fecha_crpp ='$fechafil'";
											}
											if ($fecha2 == "A�O") {
												$f = "and fecha_crpp between '$a1' and '$a2'";
											}
											$gby = "group by id_auto_crpp";
											$orden = "order by fecha_crpp desc,id_manu_crpp desc, id desc";
											// Gerero listas de paginacion
											$sql = "$a $c $filtro $f $gby $orden";
											$resf = $cx->query($sql);
											$filas = $resf->num_rows;
											$listas = ceil($filas / $muestra);

											$sq2 = "$a $c $filtro $f $gby $orden $limitar";






											$re2 = $cx->query($sq2);

											printf("
<center>
<table width='900' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CRPP</b></span>
</div>
</td>

<td align='center'><span class='Estilo4'><b>CDPP</b></span></td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>X VALOR DE</b></span></td>

<td align='center' colspan=3><span class='Estilo4'><b></b></span></td>
<td align='center' colspan=2><span class='Estilo4'><b>SIA</b></span></td>
</tr>

");

											while ($rw2 = $re2->fetch_assoc()) {

												$ida1 = $rw2["id_auto_cdpp"];
												$ida2 = $rw2["id_manu_cdpp"];


												$axz111 = $rw2["id_auto_crpp"];
												$link = new mysqli($server, $dbuser, $dbpass, $database);
												$resulta = $link->query("select SUM(vr_digitado) AS TOTAL from crpp WHERE id_auto_crpp = '$axz111' AND id_emp='$id_emp'");
												$row = $resulta->fetch_row();
												$total = $row[0];
												$nuevo_total111 = $total;

												printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>

<td align='left'><span class='Estilo4'>&nbsp;%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><div style='padding-left:10px; padding-top:3px; padding-right:3px; padding-bottom:3px;'><span class='Estilo4'> %s </span></div></td>
<td align='right'><span class='Estilo4'>%s&nbsp;</span></td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"modifica_crpp.php?id1a=%s\" title='Modificar / Consultar'>
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar / Consultar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_crpp.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimirr'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"hiscrp.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1000,height=600,scrollbars=yes'); return false;\"  title ='Historia del Documento'>
<img $ver_boton src='../simbolos/fuentes/historia.png' width='20' height='20' border='0' title='Historia del Documento'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_crppsia.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/rp.png' width='20' height='20' border='0' title='Imprimir'></a>
</a>
</span>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_cdppsia.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/cdp.png' width='20' height='20' border='0' title='Imprimir'></a>
</a>
</span>
</td>

</tr>", $rw2["id_manu_crpp"], $rw2["id_manu_cdpp"], $rw2["fecha_crpp"], $rw2["tercero"], number_format($nuevo_total111, 2, ',', '.'), $rw2["id_auto_crpp"], $rw2["id_auto_crpp"], $rw2["id_auto_crpp"], $rw2["id_auto_crpp"], $rw2["id_auto_cdpp"]);
											}

											printf("</table></center>");
											echo "<br><&nbsp;";
											for ($i = 0; $i < $listas; $i++) {
												$inicio = ($i * $muestra) + 1;
												$k = $i + 1;
												if ($k == $indice) {
													echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=CRPP&k=$k&nn=CRPP'><b>$k</b></a>&nbsp;";
												} else {
													echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=CRPP&k=$k&nn=CRPP'>$k</a>&nbsp;";
												}
											}
											echo ">&nbsp;";
										}
									}
									//******************************************************
									if ($a == 'COBP') {

										?>
										<div class="Estilo4 Estilo8" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
											<div align="center"><strong> CERTIFICADOS DE OBLIGACION PRESUPUESTAL <br />
													<br />
												</strong><br />
											</div>
										</div>
										<?php

										include('../objetos/filtro.php');


										if ($pendiente == "") {
										} else {
											$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

											if (isset($_POST["buscar"])) {
												$filtro = "and (id_manu_cobp LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR des_cobp LIKE '%$buscar%') ";
											} else {
												$filtro = '';
											}

											$a = "select distinct(id_auto_cobp), id_manu_cobp, des_cobp,  id_manu_crpp, id_manu_cdpp, fecha_cobp, tercero, contab, tesoreria from cobp where id_emp = '$id_emp' and contab='NO' and tesoreria ='NO' and liq = ''";
											if (empty($tercero)) {
												$c = "";
											} else {
												$c = "and tercero =$tercero2";
											}
											if ($fecha2 == "MES") {
												$f = "and fecha_cobp between '$f1' and '$f2'";
											}
											if ($fecha2 == "DIA") {
												$f = "and fecha_cobp ='$fechafil'";
											}
											if ($fecha2 == "A�O") {
												$f = "and fecha_cobp between '$a1' and '$a2'";
											}
											$gby = "";
											$orden = "order by fecha_cobp,id_manu_cobp desc";
											$sq2 = "$a $c $filtro $f $gby $orden";

											$re2 = $cx->query($sq2);

											printf("
<center>
<table width='900' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>COBP</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>CRPP</b></span></td>
<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>X VALOR DE</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center' colspan=5><span class='Estilo4'><b></b></span></td>
</tr>

");

											while ($rw2 = $re2->fetch_assoc()) {

												$var1x = 'OBCG';


												$a1a = $rw2["id_auto_cobp"];
												$resulta = $cx->query("select SUM(vr_digitado) AS TOTAL from cobp WHERE id_auto_cobp = '$a1a' AND id_emp='$id_emp' ");
												$row = $resulta->fetch_row();
												$total = $row[0];
												$nuevo_totala = $total;

												printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>

<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><div style='padding-left:10px; padding-top:3px; padding-right:3px; padding-bottom:3px;'><span class='Estilo4'> %s </span></div></td>
<td align='right'><span class='Estilo4'>%s&nbsp;</span></td>


<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<a $ver_boton href=\"../mvto_contable/menu_cont.php?id0=%s\" style='color:#0033FF'>Contabilizar</a>
</div>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"borra_cobp.php?id1=%s\" title='Eliminar'>
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"modifica_cobp.php?id1a=%s\" title='Modificar / Consultar / Enviar a Tesoreria'>
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar / Consultar / Enviar a Tesoreria'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_cobp.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img  src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"hiscobp.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1000,height=600,scrollbars=yes'); return false;\"  title ='Historia del Documento'>
<img $ver_boton src='../simbolos/fuentes/historia.png' width='20' height='20' border='0' title='Historia del Documento'></a>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"../contratacion_doc/generar_archivo_rp.php?id_cobp=%s&clase=Rp\" target='_parent' style='color:#0033FF'><img src='../simbolos/reporte2.jpg' width='20' height='20' border='0' title='Resoluci&oacute;n de pago'></a>
</span>
</div>
</td>


</tr>", $rw2["id_manu_cobp"], $rw2["id_manu_crpp"], $rw2["fecha_cobp"], $rw2["tercero"], number_format($nuevo_totala, 2, ',', '.'), $var1x, $rw2["id_auto_cobp"], $rw2["id_auto_cobp"], $rw2["id_auto_cobp"], $rw2["id_auto_cobp"], $rw2["id_auto_cobp"]);
											}
											printf("</table></center>");
										}

										if (!isset($registrado)) {
										} else {


										?>
											<br />
											<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
												<div align="center"><strong> CERTIFICADOS DE OBLIGACION PRESUPUESTAL <br />
														<br />
														<span class="Estilo4 Estilo8"><strong> CONTABILIZADOS </strong></span><BR /><br />
													</strong><a href="../mvto_contable/menu_cont.php" target="_parent">...::: IR A CONTABILIDAD :::...</a>
													<br />
												</div>
											</div>
											<br />

											<?php
											$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
											$limitar = "limit $ini,$fin";
											if (isset($_POST["buscar"])) {
												$filtro = "and (id_manu_cobp LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR des_cobp LIKE '%$buscar%') ";
												$limitar = '';
											} else {
												$filtro = '';
												$limitar = '';
											}

											$a = "select distinct(id_auto_cobp), id_manu_cobp,  des_cobp, id_manu_crpp, id_manu_cdpp, fecha_cobp, tercero, tesoreria from cobp where id_emp = '$id_emp' and (tesoreria ='NO' OR tesoreria = '') and contab ='SI' AND liq = ''";
											if (empty($tercero)) {
												$c = "";
											} else {
												$c = "and tercero =$tercero2";
											}
											if ($fecha2 == "MES") {
												$f = "and fecha_cobp between '$f1' and '$f2'";
											}
											if ($fecha2 == "DIA") {
												$f = "and fecha_cobp ='$fechafil'";
											}
											if ($fecha2 == "A�O") {
												$f = "and fecha_cobp between '$a1' and '$a2'";
											}
											$gby = "";
											$orden = "order by fecha_cobp desc,id_manu_cobp desc, id desc";
											// Gerero listas de paginacion
											$sql = "$a $c $filtro $f $gby $orden";
											$resf = $cx->query($sql);
											$filas = $resf->num_rows;
											$listas = ceil($filas / $muestra);

											$sq5 = "$a $c $filtro $f $gby $orden $limitar";



											$re2 = $cx->query($sq5);

											printf("
<center>
<table width='900' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>COBP</b></span>
</div>
</td>
<td align='center'><span class='Estilo4'><b>CDPP</b></span></td>
<td align='center'><span class='Estilo4'><b>FECHA COBP</b></span></td>
<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>X VALOR DE</b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>
<td align='center'><span class='Estilo4'><b></b></span></td>

</tr>

");

											while ($rw2 = $re2->fetch_assoc()) {

												$a1a1 = $rw2["id_auto_cobp"];
												$resulta = $cx->query("select SUM(vr_digitado) AS TOTAL from cobp WHERE id_auto_cobp = '$a1a1' AND id_emp='$id_emp'");
												$row = $resulta->fetch_row();
												$total = $row[0];
												$nuevo_totala1 = $total;

												printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>

<td align='center'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><div style='padding-left:10px; padding-top:3px; padding-right:3px; padding-bottom:3px;'><span class='Estilo4'> %s </span></div></td>
<td align='right'><span class='Estilo4'>%s&nbsp;</span></td>


<td align='center' bgcolor='#DCE9E5'>
<a href=\"modifica_cobp.php?id1a=%s\" title='Modificar / Consultar'>
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_cobp.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"hiscobp.php?vr=%s\" target=\"_blank\" onClick=\"window.open(this.href, this.target, 'width=1000,height=600,scrollbars=yes'); return false;\"  title ='Historia del Documento'>
<img $ver_boton src='../simbolos/fuentes/historia.png' width='20' height='20' border='0' title='Historia del Documento'></a>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>
<a href=\"../contratacion_doc/generar_archivo_rp.php?id_cobp=%s&clase=Rp\" target='_parent' style='color:#0033FF'><img src='../simbolos/reporte2.jpg' width='20' height='20' border='0' title='Resoluci&oacute;n de pago'></a>
</span>
</div>
</td>


</tr>", $rw2["id_manu_cobp"], $rw2["id_manu_cdpp"], $rw2["fecha_cobp"], $rw2["tercero"], number_format($nuevo_totala1, 2, ',', '.'), $rw2["id_auto_cobp"], $rw2["id_auto_cobp"], $rw2["id_auto_cobp"], $rw2["id_auto_cobp"]);
											}

											printf("</table></center>");
											echo "<br><&nbsp;";
											for ($i = 0; $i < $listas; $i++) {
												$inicio = ($i * $muestra) + 1;
												$k = $i + 1;
												if ($k == $indice) {
													echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=COBP&k=$k&nn=COBP'><b>$k</b></a>&nbsp;";
												} else {
													echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=COBP&k=$k&nn=COBP'>$k</a>&nbsp;";
												}
											}
											echo ">&nbsp;";


											?>

											<br />
											<div class="Estilo4" style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;'>
												<div align="center"><strong> CERTIFICADOS DE OBLIGACION PRESUPUESTAL <br />
														<br />
														<span class="Estilo4 Estilo8"><strong> ENVIADOS DIRECTAMENTE A TESORERIA ( Nominas y Contribuciones Inherentes a Nomina ) </strong></span><br />
														<br />
													</strong><a href="../pagos_tesoreria/pagos_tesoreria.php" target="_parent">...::: IR A TESORERIA :::...</a> <br />
												</div>
											</div>
											<br />

									<?php

											if (isset($_POST["buscar"])) {
												$filtro = "and (id_manu_cobp LIKE  '%$buscar%' OR tercero LIKE  '%$buscar%' OR des_cobp LIKE '%$buscar%')";
											} else {
												$filtro = '';
											}

											$a = "select distinct(id_auto_cobp), id_manu_cobp, des_cobp, id_manu_crpp, id_manu_cdpp, fecha_cobp, tercero, contab, tesoreria from cobp where id_emp = '$id_emp' and contab='NO' and tesoreria ='SI'";
											if (empty($tercero)) {
												$c = "";
											} else {
												$c = "and tercero =$tercero2";
											}
											if ($fecha2 == "MES") {
												$f = "and fecha_cobp between '$f1' and '$f2'";
											}
											if ($fecha2 == "DIA") {
												$f = "and fecha_cobp ='$fechafil'";
											}
											if ($fecha2 == "A�O") {
												$f = "and fecha_cobp between '$a1' and '$a2'";
											}
											$gby = "";
											$orden = "order by fecha_cobp desc ,id_manu_cobp desc, id desc";
											// Gerero listas de paginacion
											$sql = "$a $c $filtro $f $gby $orden";
											$resf = $cx->query($sql);
											$filas = $resf->num_rows;
											$listas = ceil($filas / $muestra);

											$sq6 = "$a $c $filtro $f $gby $orden limit $ini,$fin";



											$re2 = $cx->query($sq6);

											printf("
<center>
<table width='900' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>COBP</b></span>
</div>
</td>


<td align='center'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center'><span class='Estilo4'><b>X VALOR DE</b></span></td>
<td align='center' colspan=3><span class='Estilo4'><b></b></span></td>
</tr>

");

											while ($rw2 = $re2->fetch_assoc()) {

												$a1a = $rw2["id_auto_cobp"];
												$resulta = $cx->query("select SUM(vr_digitado) AS TOTAL from cobp WHERE id_auto_cobp = '$a1a' AND id_emp='$id_emp'");
												$row = $resulta->fetch_row();
												$total = $row[0];
												$nuevo_totala = $total;
												printf("
<span class='Estilo4'>
<tr>
<td align='left' bgcolor='#DCE9E5'>
<div style='padding-left:1px; padding-top:3px; padding-right:1px; padding-bottom:3px;'>
<span class='Estilo4'>&nbsp;%s</span>
</div>
</td>


<td align='center'><span class='Estilo4'>%s</span></td>
<td align='left'><div style='padding-left:10px; padding-top:3px; padding-right:3px; padding-bottom:3px;'><span class='Estilo4'> %s </span></div></td>
<td align='right'><span class='Estilo4'>%s&nbsp;</span></td>


<td align='center' bgcolor='#DCE9E5'>
<span class='Estilo4'>
<a href=\"borra_cobp.php?id1=%s\" title='Eliminar'>
<img $ver_boton src='../simbolos/fuentes/eliminar.png' width='20' height='20' border='0' title='Eliminar'>
</a>
</span>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"modifica_cobp.php?id1a=%s\" title='Modificar / Consultar / Enviar a Contabilidad'>
<img $ver_boton src='../simbolos/fuentes/modificar.png' width='20' height='20' border='0' title='Modificar / Consultar / Enviar a Contabilidad'>
</a>
</td>

<td align='center' bgcolor='#DCE9E5'>
<a href=\"imp_cobp.php?id2=%s\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'>
</a>
</td>


</tr>", $rw2["id_manu_cobp"], $rw2["fecha_cobp"], $rw2["tercero"], number_format($nuevo_totala, 2, ',', '.'),  $rw2["id_auto_cobp"], $rw2["id_auto_cobp"], $rw2["id_auto_cobp"]);
											}
											printf("</table></center>");
											echo "<br><&nbsp;";
											for ($i = 0; $i < $listas; $i++) {
												$inicio = ($i * $muestra) + 1;
												$k = $i + 1;
												if ($k == $indice) {
													echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=COBP&k=$k&nn=COBP'><b>$k</b></a>&nbsp;";
												} else {
													echo "<a href='$archivo?ini=$inicio&fin=$muestra&a=COBP&k=$k&nn=COBP'>$k</a>&nbsp;";
												}
											}
											echo ">&nbsp;";
										}
									}
									?>
									</div>
							</div>
					</td>
				</tr>

				<tr>
					<td colspan="3">
						<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
							<div align="center">

								<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
									<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
										<div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
							<div align="center"> <span class="Estilo4">Fecha de esta Sesion:</span> <br />
								<span class="Estilo4"> <strong>
										<?php echo $ano; ?>
									</strong> </span> <br />
								<span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"]; ?></u> </span>
							</div>
						</div>
					</td>
				</tr>
			</table>


		</body>

		</html>

<?php
	} else { // si no tiene persisos de usuario
		echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
		echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
	}
}
?>