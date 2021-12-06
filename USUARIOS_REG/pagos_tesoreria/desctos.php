<?php
session_start();
if (!$_SESSION["login"]) {
	header("Location: ../login.php");
	exit;
} else {
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
				color: #FFFFFF
			}
		</style>

		<script language="JavaScript">
			var nav4 = window.Event ? true : false;

			function acceptNum(evt) {
				// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
				var key = nav4 ? evt.which : evt.keyCode;
				return (key <= 13 || (key >= 48 && key <= 57));
			}
			//
		</script>

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
					<div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
						<div align="center" class="Estilo4"><strong>
								<?php
								include('../config.php');
								$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
								$sqlxx = "select * from fecha";
								$resultadoxx = $connectionxx->query($sqlxx);

								while ($rowxx = $resultadoxx->fetch_assoc()) {

									$idxx = $rowxx["id_emp"];
									$id_emp = $rowxx["id_emp"];
								}
								?>
								CONFIGURACION DE DESCUENTOS Y RETENCIONES</strong></div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
						<div align="center">
							<p>
								<?php
								//-------
								include('../config.php');
								$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
								$sq = "select * from retefuente order by id asc ";
								$re = $cx->query($sq);

								printf("
<center>

<table width='740' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
	<td colspan='6'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>RETENCION EN LA FUENTE</b></span>
	</div>
	</td>
</tr>

<tr bgcolor='#DCE9E5'>
		<td align='center' width='70'><span class='Estilo4'><b>COD </b></span></td>
		<td align='center' width='70'><span class='Estilo4'><b>CUENTA </b></span></td>
		<td align='center' width='380'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<span class='Estilo4'><b>CONCEPTO</b></span>
			</div>
		</td>
		<td align='center' width='100'><span class='Estilo4'><b>BASES Y TARIFAS</b></span></td>
		
		
		<td colspan ='2' align='center' width='40' bgcolor ='#0000FF'  class='Estilo4' valign='middle'><a href=\"new_concepto.php?var=retencion\" style='color:#FFFF00'>
		::: CREAR NUEVO :::</a>
		</td>
		
	


");

								while ($rw = $re->fetch_assoc()) {
									$sqx = "select * from rango where concepto='$rw[concepto]' ";
									$rex = $cx->query($sqx);
									$num_rangos = $rex->num_rows;
									if ($num_rangos < 1) {
										$fondo = "bgcolor=#CCCCCC";
									} else {
										$fondo = "";
									}
									printf("
<span class='Estilo4'>
<tr>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center' $fondo><span class='Estilo4'> %s &nbsp;&nbsp; </span></td>
<td align='center'><span class='Estilo4'><a href=\"mod_retefuente.php?id1=%s\"> <img src='../simbolos/modificarblanco.png' border='0' width='18' /></a></span></td>
<td align='center'><span class='Estilo4'><a href=\"eli_retefuente.php?id2=%s\"><img src='../simbolos/eliminarblanco.png' border='0' width='18' /></a></span></td>


</tr>", $rw["codigo_ret"], $rw["cuenta"], $rw["concepto"], $num_rangos, $rw["id"],	$rw["id"]);
								}

								printf("</table></center>");
								//--------	
								?>
								<br />
								<br />
								<?php

								//------- ****************************************************************************  RTE IVA *****************************************************
								$sq2 = "select * from reteiva order by id asc ";
								$re2 = $cx->query($sq2);

								printf("
<center>

<table width='740' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='6'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RETENCION IVA</b></span>
</div>
</td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='70'><span class='Estilo4'><b>COD </b></span></td>
<td align='center' width='70'><span class='Estilo4'><b>CUENTA </b></span></td>
<td align='center' width='380'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CONCEPTO</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>BASES Y TARIFAS</b></span></td>

<td colspan ='2' align='center' width='40' bgcolor ='#0000FF'  class='Estilo4' valign='middle'><a href=\"new_concepto.php?var=iva\" style='color:#FFFF00'>
::: CREAR NUEVO :::</a>
</td>


");

								while ($rw2 = $re2->fetch_assoc()) {
									$sqx = "select * from rango where concepto='$rw2[concepto]' ";
									$rex = $cx->query($sqx);
									$num_rangos = $rex->num_rows;
									if ($num_rangos < 1) {
										$fondo = "bgcolor=#CCCCCC";
									} else {
										$fondo = "";
									}
									printf("
<span class='Estilo4'>
<tr>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center' $fondo><span class='Estilo4'> %s &nbsp;&nbsp; </span></td>
<td align='center'><span class='Estilo4'><a href=\"mod_reteiva.php?id1=%s\"> <img src='../simbolos/modificarblanco.png' border='0' width='18' /> </a></span></td>
<td align='center'><span class='Estilo4'><a href=\"eli_reteiva.php?id4=%s\"> <img src='../simbolos/eliminarblanco.png' border='0' width='18' /></a></span></td>


</tr>", $rw2["codigo_ret"], $rw2["cuenta"], $rw2["concepto"], $num_rangos,  $rw2["id"],	$rw2["id"]);
								}

								printf("</table></center>");

								//--------	 **************************************** FIN RTE IVA 

								?>
								<br />
								<br />
								<?php
								//------- ****************************************************************************  RTE CREE *****************************************************
								$sq2 = "select * from retecree order by id asc ";
								$re2 = $cx->query($sq2);

								printf("
<center>

<table width='740' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='6'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RETENCION CREE</b></span>
</div>
</td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='70'><span class='Estilo4'><b>COD </b></span></td>
<td align='center' width='70'><span class='Estilo4'><b>CUENTA </b></span></td>
<td align='center' width='380'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CONCEPTO</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>BASES Y TARIFAS</b></span></td>
<a href=\"new_concepto.php?var=cree\">
<td colspan ='2' align='center' width='40' bgcolor ='#0000FF' style='color:#FFFF00' class='Estilo4' valign='middle'>
::: CREAR NUEVO :::
</td>
</a>

");

								while ($rw2 = $re2->fetch_assoc()) {
									$sqx = "select * from rango where concepto='$rw2[concepto]' ";
									$rex = $cx->query($sqx);
									$num_rangos = $rex->num_rows;
									if ($num_rangos < 1) {
										$fondo = "bgcolor=#CCCCCC";
									} else {
										$fondo = "";
									}
									printf("
<span class='Estilo4'>
<tr>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center' $fondo><span class='Estilo4'> %s &nbsp;&nbsp; </span></td>
<td align='center'><span class='Estilo4'><a href=\"mod_retecree.php?id1=%s\"> <img src='../simbolos/modificarblanco.png' border='0' width='18' /> </a></span></td>
<td align='center'><span class='Estilo4'><a href=\"eli_retecree.php?id4=%s\"> <img src='../simbolos/eliminarblanco.png' border='0' width='18' /></a></span></td>


</tr>", $rw2["codigo_ret"], $rw2["cuenta"], $rw2["concepto"], $num_rangos,  $rw2["id"],	$rw2["id"]);
								}

								printf("</table></center>");

								//--------	 **************************************** FIN RTE CREE 

								?>
								<br />
								<br />
								<?php
								//------- ****************************************************************************  RTE ICA *****************************************************

								$sq2 = "select * from reteica order by id asc ";
								$re2 = $cx->query($sq2);

								printf("
<center>

<table width='740' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='6'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>RETENCION INDUSTRIA Y COMERCIO</b></span>
</div>
</td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='70'><span class='Estilo4'><b>COD </b></span></td>
<td align='center' width='70'><span class='Estilo4'><b>CUENTA </b></span></td>
<td align='center' width='380'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CONCEPTO</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>BASES Y TARIFAS</b></span></td>

<td colspan ='2' align='center' width='40' bgcolor ='#0000FF'  class='Estilo4' valign='middle'><a href=\"new_concepto.php?var=ica\" style='color:#FFFF00'>
::: CREAR NUEVO :::</a>
</td>


");

								while ($rw2 = $re2->fetch_assoc()) {
									$sqx = "select * from rango where concepto='$rw2[concepto]' ";
									$rex = $cx->query($sqx);
									$num_rangos = $rex->num_rows;
									if ($num_rangos < 1) {
										$fondo = "bgcolor=#CCCCCC";
									} else {
										$fondo = "";
									}
									printf("
<span class='Estilo4'>
<tr>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center' $fondo><span class='Estilo4'> %s &nbsp;&nbsp; </span></td>
<td align='center'><span class='Estilo4'><a href=\"mod_reteica.php?id1=%s\"> <img src='../simbolos/modificarblanco.png' border='0' width='18' /> </a></span></td>
<td align='center'><span class='Estilo4'><a href=\"eli_reteica.php?id4=%s\"> <img src='../simbolos/eliminarblanco.png' border='0' width='18' /></a></span></td>


</tr>", $rw2["codigo_ret"], $rw2["cuenta"], $rw2["concepto"], $num_rangos,  $rw2["id"],	$rw2["id"]);
								}

								printf("</table></center>");

								//--------	 **************************************** FIN RTE ICA


								?>
								<br />
								<br />



								<!-- PARA DESCUENTOS EN SALUD Y DEMAS -->


								<?php
								//-------
								include('../config.php');
								$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
								$sq = "select * from dctos_deduc_cecp order by id asc ";
								$re = $cx->query($sq);

								printf("
<center>

<table width='500' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
	<td colspan='4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>DESCUENTOS Y DEDUCCIONES</b></span>
	</div>
	</td>
</tr>

<tr bgcolor='#DCE9E5'>
		<td align='center' width='60'><span class='Estilo4'><b>MAN/AUT</b></span></td>
		<td align='center' width='60'><span class='Estilo4'><b>CUENTA </b></span></td>
		<td align='center' width='350'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<span class='Estilo4'><b>CONCEPTO</b></span>
			</div>
		</td>
		<td colspan ='1' align='center' width='150' style='color:#FFFF00' class='Estilo4' valign='middle'></td>
");

								while ($rw = $re->fetch_assoc()) {
									if ($rw['contab'] == 'SI')
										$checksi = "checked='checked'";
									else
										$checksi = "";
									printf("
		<span class='Estilo4'>
		<tr>
		<td align='center'><span class='Estilo4'><input type='checkbox' name='automan' disabled='disabled' %s/></span></td>
		<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
		<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
		<td align='center'><span class='Estilo4'><a href=\"mod_des_deduc.php?iddd=%s\"> <img src='../simbolos/modificarblanco.png' border='0' width='18' /></a></span></td>
		</tr>", $checksi, $rw["cuenta"], $rw["concepto"], $rw["id"], $rw["id"]);
								}

								printf("</table></center>");
								//--------	
								?>


								<!-- FIN DE DESCUENTSO EN SALUD -->

								<br />
								<br />

							</p>
							<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'> <span class="Estilo4"><strong>SELECCIONE EL MODO COMO DESEA TRABAJAR LAS ESTAMPILLAS : </strong></span> <br />
								<br />
								<?php
								$sqlxx2 = "select * from modo_estampillas";
								$resultadoxx2 = $connectionxx->query($sqlxx2);
								while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
									$auto = $rowxx2["auto"];
									$manu = $rowxx2["manu"];
								}
								?>

								<form method="post" name="a" id="a" action="proc_mod_estampilla.php">
									<label> <span class="Estilo4">
											<?php if ($auto == 'NO') { ?></span>
										<input type="checkbox" name="auto" value="SI" />
										<span class="Estilo4"><span class="Estilo4">AUTOMATICO</span>
										<?php } else { ?>
											<input type="checkbox" name="auto" value="SI" checked="checked" />
											<span class="Estilo4">AUTOMATICO
											<?php } ?>
											</span></label>
									<span class="Estilo8">:::</span>
									<input name="Submit" type="submit" class="Estilo4" value="Actualizar" />

								</form>
								<br />
								<br />
								<span class="Estilo4">Si selecciona automatico se usaran en los Comprobantes de Egreso las bases y tarifas establecidas por el usuario<br />
									<strong>caso contrario</strong><br />
									en los Comprobantes de Egreso el usuario digitara los valores de las Estampillas </span>
							</div>
							<p> <br />
								<?php
								//-------

								$sq3 = "select * from estampillas order by id asc ";
								$re3 = $cx->query($sq3);

								printf("
<center>

<table width='700' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='5'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>ESTAMPILLAS</b></span>
</div>
</td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='70'><span class='Estilo4'><b>CUENTA</b></span></td>
<td align='center' width='350'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CONCEPTO</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>BASES Y TARIFAS</b></span></td>

<td colspan ='2' align='center' width='40' bgcolor ='#0000FF' class='Estilo4' valign='middle'> <a href=\"new_concepto.php?var=estampilla\" style='color:#FFFF00' >
::: CREAR NUEVO :::</a>
</td>


");

								while ($rw3 = $re3->fetch_assoc()) {
									$sqx = "select * from rango where concepto='$rw3[concepto]' ";
									$rex = $cx->query($sqx);
									$num_rangos = $rex->num_rows;
									if ($num_rangos < 1) {
										$fondo = "bgcolor=#CCCCCC";
									} else {
										$fondo = "";
									}
									printf("
<span class='Estilo4'>
<tr>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center' $fondo><span class='Estilo4'> %s &nbsp;&nbsp; </span></td>
<td align='center'><span class='Estilo4'><a href=\"mod_estampillas.php?id1=%s\"> <img src='../simbolos/modificarblanco.png' border='0' width='18' /></a></span></td>
<td align='center'><span class='Estilo4'><a href=\"eli_estampillas.php?id6=%s\"><img src='../simbolos/eliminarblanco.png' border='0' width='18' /></a></span></td>


</tr>", $rw3["cuenta"], $rw3["concepto"], $num_rangos, $rw3["id"],	$rw3["id"]);
								}

								printf("</table></center>");
								//--------	
								?>
							</p>
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
									<?php include('../config.php');
									$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
									$sqlxx = "select * from fecha";
									$resultadoxx = $connectionxx->query($sqlxx);

									while ($rowxx = $resultadoxx->fetch_assoc()) {
										$ano = $rowxx["ano"];
									}
									echo $ano;
									?>
								</strong> </span> <br />
							<span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"]; ?></u> </span>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td width="266">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
						<div align="center"><?php include('../config.php');
											echo $nom_emp ?><br />
							<?php echo $dir_tel ?><BR />
							<?php echo $muni ?> <br />
							<?php echo $email ?> </div>
					</div>
				</td>
				<td width="266">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
						<div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
							</a><BR />
							<a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a>
						</div>
					</div>
				</td>
				<td width="266">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
						<div align="center">Desarrollado por <br />
							<a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
							Derechos Reservados - 2009
						</div>
					</div>
				</td>
			</tr>
		</table>
	</body>

	</html>






<?php
}
?>