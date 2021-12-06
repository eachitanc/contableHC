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

		<script type="text/javascript" src="javas.js"> </script>
		<script src="../jquery.js"></script>
		<script type="text/javascript" src="../jquery.validate.js"></script>

		<style type="text/css">
			<!--
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
				font-size: 10px;
				color: #666666;
			}

			.suggestionsBox {
				position: relative;
				left: 60px;
				margin: 0px 0px 0px 0px;
				width: 600px;
				background-color: #335194;
				-moz-border-radius: 7px;
				-webkit-border-radius: 7px;
				border: 2px solid #2AAAFF;
				color: #fff;
				font-size: 11px;
			}

			.suggestionList {
				margin: 0px;
				padding: 0px;
			}

			.suggestionList li {

				margin: 0px 0px 3px 0px;
				padding: 3px;
				cursor: pointer;
			}

			.suggestionList li:hover {
				background-color: #659CD8;
			}
			-->
		</style>

		<style type="text/css">
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
		</style>

		<script>
			function validar(e) {
				tecla = (document.all) ? e.keyCode : e.which;
				if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) + punto
				patron = /\d/; //ver nota 
				te = String.fromCharCode(tecla);
				return patron.test(te);
			}
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
								$acc = '';
								while ($rowxx = $resultadoxx->fetch_assoc()) {

									$idxx = $rowxx["id_emp"];
									$id_emp = $rowxx["id_emp"];
								}

								$id = $_GET['iddd'];
								printf("%s", $id);
								$automanu = isset($_POST['automan']) ? $_POST['automan'] : '';
								printf("%s", $automanu);
								$sq = "select * from dctos_deduc_cecp where id = '$id' ";
								$re = $connectionxx->query($sq);
								while ($rw = $re->fetch_assoc()) {
									$concepto = $rw["concepto"];
									$cuenta = $rw["cuenta"];
									$contab = $rw["contab"];
								}

								?>
								MODIFICAR</strong></div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
						<div align="left">
							<form name="a" method="post" onsubmit="return confirm('Verifique que todos los datos estan correctos')">
								<table align="center" width="453" border="1" class="bordepunteado1">
									<tr>
										<td colspan="2" bgcolor="#DCE9E5">
											<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
												<div align="center" class="Estilo4"><strong>DESCUENTOS Y DEDUCCIONES </strong></div>
											</div>
										</td>
									</tr>
									<tr>
										<td width="115">
											<div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
												<strong>CONCEPTO </strong>
											</div>
										</td>
										<td width="320">
											<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
												<input disabled="disabled" name="concepto" type="text" class="Estilo4" id="concepto" style="width:300px;" value="<?php printf("%s", $concepto); ?>" />
											</div>
										</td>
									</tr>
									<tr>
										<?php
										//$acc='block';
										for ($i = 1; $i < 2; $i++) {
											echo "<tr aling='left' style='position:relative; display:$acc;' id='fil$i' >
					 <td><div aling='left' class='Estilo4' style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'><strong>CUENTA P.G.C.P </strong></div></td>
					  <td><div aling='left' style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span aling='left' class='Estilo4'>
						  <input name='cuenta' type='text' class='Estilo4' id='pgcp$i' style='width:180px;' value='$cuenta' onkeyup='lookup(this.value,$i);'>
					  </span></div>
					 <div aling='left' class='suggestionsBox' id='sugges$i' style='display: none; position:absolute; left: 536px;'>
								<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
								<div aling='left' class='suggestionList' id='autoSug$i'>
									&nbsp;
								</div>
					 </div>
					  </td>
					  
					</tr>";
											if ($i == 2) {
												$acc = 'none';
											}
										}
										?>

									</tr>

									<tr>
										<td colspan="2">
											<div class="Estilo4" style="padding-left:145px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
												<strong>REGISTRO AUTOMATICO </strong>
												<?php
												if ($contab == 'SI') {
													if ($concepto == 'ReteICA')
														echo "<input name='contabauto' type='checkbox' value='SI' disabled='disabled' checked='checked'/>";
													else
														echo "<input name='contabauto' type='checkbox' value='SI' checked='checked'/>";
												} else {
													echo "<input name='contabauto' type='checkbox' value='SI'/>";
												}
												?>
											</div>

										</td>
									</tr>

									<tr>
										<td colspan="2">
											<div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:5px;">
												<div align="center">
													<input type="hidden" name="idd" value="<?php printf("%s", $id); ?>" />
													<input name="Submit322" type="submit" class="Estilo4" value="Procesa Cambios" onclick="this.form.action = 'p_mod_des_deduc.php'" />
												</div>
											</div>
										</td>
									</tr>
								</table>
							</form>
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
									<div align="center"><a href='desctos.php' target='_parent'>VOLVER </a> </div>
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