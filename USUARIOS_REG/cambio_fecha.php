<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
} else {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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

			.Estilo8 {
				color: #FFFFFF
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

			.Estilo9 {
				color: #FF0000;
				font-weight: bold;
			}
		</style>


	</head>

	<body>
		<table width="600" border="0" align="center">
			<tr>

				<td width="600" colspan="3">
					<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
						<div align="center"><img src="../ADMIN/images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">

					<table width="595" border="0" align="center">
						<tr>
							<td bgcolor="#F0F0F0">
								<div align="center">
									<div style='padding-left:5px; padding-top:30px; padding-right:5px; padding-bottom:30px;'>
										<?php
										include('config.php');

										$a = $_POST['inicio'];
										$id_emp = $_POST['id_emp'];
										global $server, $database, $dbpass, $dbuser, $charset;
										$cx = new mysqli($server, $dbuser, $dbpass, $database);

										$consultax = "select * from vf ";
										$resultadox = $cx->query($consultax);

										while ($rowx = $resultadox->fetch_assoc()) {
											$ax = $rowx["fecha_ini"];
											$bx = $rowx["fecha_fin"];
										}

										if ($a > $bx or $a < $ax) {
											printf("<center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual</center>");
										} else {
											$sq = "select * from  fecha where user = '$_SESSION[login]'";
											$rs = $cx->query($sq);
											$fil = $rs->num_rows;

											if ($fil == 0) {
												$sq2 = "insert into fecha (ano,id_emp, user ) values('$a','$id_emp','$_SESSION[login]')";
												$resultado = $cx->query($sq2);
											}
											if ($fil > 0) {
												$sql = "update fecha set ano='$a',id_emp='$id_emp' where user ='$_SESSION[login]'";
												$resultado = $cx->query($sql);
											}
											//-------
											$consulta = $cx->query("select * from fecha  where user ='$_SESSION[login]'");
											while ($row = $consulta->fetch_assoc()) {
												printf("<span class='Estilo4'><b>Fecha de Trabajo Definida para esta Sesion</b><br><br> ...::: %s  :::...</span><br><br>", $row["ano"]);

												$id = $row["id_emp"];
											}
											//--------

											$connectionx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
											$sqlx = "select * from empresa where cod_emp = '$id'";
											$resultadox = $connectionx->query($sqlx);

											while ($rowx = $resultadox->fetch_assoc()) {
												printf("<span class='Estilo4'><b>Empresa con la que Trabajara Esta Sesion </b><br><br>...::: %s :::...</span>", $rowx["raz_soc"]);
											}
											//--------						    

										}


										?>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td align="center">
								<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
									<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
										<div align="center"><a href='user.php' target='_parent'>VOLVER</a> </div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center"> <span class="Estilo4">Fecha de esta Sesion:</span> <br />
										<span class="Estilo4"> <strong>
												<?php include('config.php');
												$connectionxx = new mysqli($server, $dbuser, $dbpass, $database);
												$sess = $_SESSION['login'];
												$sqlxx = "SELECT * from fecha where user ='$sess'";
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
					</table>
				</td>
			</tr>

			<tr>
				<td width="200">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
						<div align="center"><?php include('config.php');
											echo $nom_emp ?><br />
							<?php echo $dir_tel ?><BR />
							<?php echo $muni ?> <br />
							<?php echo $email ?> </div>
					</div>
				</td>
				<td width="200">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
						<div align="center"><a href="../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
							</a><BR />
							<a href="../condiciones.php" target="_blank">CONDICIONES DE USO </a>
						</div>
					</div>
				</td>
				<td width="200">
					<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
						<div align="center">Desarrollado por <br />
							<a href="http://www.qualisoftsalud.com" target="_blank"><img src="../ADMIN/images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
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