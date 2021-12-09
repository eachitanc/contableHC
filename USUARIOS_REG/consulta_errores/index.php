<?php
set_time_limit(1800);
session_start();
if (!isset($_SESSION["login"])) {
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
		<style type="text/css">
			table.bordepunteado1 {
				border-style: solid;
				border-collapse: collapse;
				border-width: 2px;
				border-color: #004080;
			}

			.Estilo9 {
				font-weight: bold
			}
		</style>
		<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
		</LINK>

		<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
		<style type="text/css">
			.Estilo15 {
				color: #000000
			}

			.Estilo17 {
				font-weight: bold
			}
		</style>
	</head>


	</head>

	<body>
		<table width="800" border="0" align="center">

			<tr>
				<td width="2394" colspan="3"><?php
												//-------
												include('../config.php');
												$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
												$sq = "select * from lib_aux where cuenta = '' order by cuenta asc ";
												$re = $cx->query($sq) or die(mysqli_error($cx));

												printf("
<center>

<table width='300' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' colspan='3'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Documentos en donde se encuentra un Mvto Contable con codigo PGCP en Blanco</b></span>
</div>
</td>
</tr>



<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>DOCUMENTO</b></span>
</div>
</td>

<td align='center' width='150'><span class='Estilo4'><b>VR DEBITO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>VR CREDITO</b></span></td>


</tr>


");

												while ($rw = $re->fetch_assoc()) {
													printf("
<span class='Estilo4'>
<tr>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>

</tr>", $rw["dcto"], $rw["debito"], $rw["credito"]);
												}

												printf("</table></center>");
												//--------	
												?>
					<br />
					<?php
					//-------

					$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
					$sq = "select lib_aux.dcto, sum(lib_aux.debito), sum(lib_aux.credito) from lib_aux group by lib_aux.dcto";
					$re2 = $cx->query($sq);

					printf("
<center>

<table width='300' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' colspan='3'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Documentos en donde el Vr Debito <br>NO ES IGUAL<br> al Vr Credito</b></span>
</div>
</td>
</tr>



<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>DOCUMENTO</b></span>
</div>
</td>

<td align='center' width='150'><span class='Estilo4'><b>VR DEBITO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>VR CREDITO</b></span></td>


</tr>


");

					while ($rw2 = $re2->fetch_assoc()) {

						$debito = $rw2["sum(lib_aux.debito)"];
						$credito = $rw2["sum(lib_aux.credito)"];

						$val = $debito - $credito;

						if ($val != '0') {
							printf("
		<span class='Estilo4'>
		<tr>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		
		</tr>", $rw2["dcto"], $debito, $credito);
						}
					}
					printf("</table></center>");
					//--------	
					?>
					<br />
					<?php
					//-------

					$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
					$sq = "select * from lib_aux";
					$re2 = $cx->query($sq);

					// COMPROBANTES DONDE NO SE DEBE HACER CONTABILIDAD
					printf("
<center>

<table width='300' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' colspan='3'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Comprobantes en donde <br>NO SE DEBE<br> realizar Mvto Contable</b></span>
</div>
</td>
</tr>



<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>DOCUMENTO</b></span>
</div>
</td>

<td align='center' width='150'><span class='Estilo4'><b>VR DEBITO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>VR CREDITO</b></span></td>


</tr>


");

					while ($rw2 = $re2->fetch_assoc()) {

						$a = substr($rw2["dcto"], 0, 4);

						if ($a == 'CRPP' or $a == 'COBP' or $a == 'REIP') {
							printf("
			<span class='Estilo4'>
			<tr>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			
			</tr>", $rw2["dcto"], $rw2["debito"], $rw2["credito"]);
						}
					}
					printf("</table></center>");
					//--------	
					?>
					<br />
					<?php
					//-------
					// CRUVCE DE CAUSACION CONTABLE ***************************
					/*
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "
SELECT lib_aux.cuenta, sum(lib_aux.debito) as sumdebito, sum(lib_aux.credito) as sumcredito, sum(lib_aux.debito - lib_aux.credito) as saldo
		FROM lib_aux 
		INNER JOIN ceva ON (lib_aux.ref = ceva.id_manu_cobp)
		INNER JOIN cobp ON (ceva.id_manu_cobp = cobp.id_manu_cobp)
		WHERE (lib_aux.ref <>'' AND lib_aux.cuenta like '2%')and(lib_aux.cuenta not like '2436%')AND (lib_aux.cuenta not like '2440%') AND (cobp.tesoreria ='NO') 
		GROUP BY lib_aux.ref, lib_aux.cuenta
		HAVING (saldo <> '0') 
		ORDER BY lib_aux.ref ASC
";
$re2 = $cx->query($sq) or die ($resultadoxx2 .mysql_error()."");

printf("
<center>

<table width='1000' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' colspan='9'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Validador de Causacion de Registros de Gastos</b><br>Verifique el Registro del Pasivo entre la Causacion Contable y el Pago</span>
</div>
</td>
</tr>



<tr bgcolor='#DCE9E5'>
<td align='center' width='80'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Fecha</b></span>
</div>
</td>

<td align='center' width='80'><span class='Estilo4'><b>Referencia</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Dcto</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Cuenta</b></span></td>
<td align='center' width='80'><span class='Estilo4'><b>Nombre</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>Detalle</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Tercero</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Debito</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Credito</b></span></td>


</tr>


");

while($rw2 = $re2->fetch_assoc()) 
{

	$ref=$rw2["ref"];

		$sq2 = "SELECT * FROM lib_aux WHERE (ref ='$ref')  ORDER BY dcto DESC";
		$re2 = $cx->query($sq2);
		
		while($rw2a = $re2->fetch_assoc()) 
		{
			printf("
			<span class='Estilo4'>
			<tr>
			<td align='center'><span class='Estilo4'> %s </span></td>
			<td align='center'><span class='Estilo4'> %s </span></td>
			<td align='center'><span class='Estilo4'> %s </span></td>
			<td align='center'><span class='Estilo4'> %s </span></td>
			<td align='center'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='right'><span class='Estilo4'> %s </span></td>
			<td align='right'><span class='Estilo4'> %s </span></td>
			
			</tr>",$rw2a['fecha'],$rw2a['ref'],$rw2a['dcto'],$rw2a['cuenta'],$rw2a['nombre'],$rw2a['detalle'],$rw2a['tercero'],$rw2a['debito'],$rw2a['credito']); 
		}
		
}
printf("</table></center>");
*/
					//--------	
					?>
					<br />
					<?php
					//-------

					$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
					$sq = "SELECT * from lib_aux LEFT JOIN pgcp ON lib_aux.cuenta = pgcp.cod_pptal WHERE pgcp.cod_pptal is Null";
					$re = $cx->query($sq) or die($re . mysqli_error($cx) . "");

					printf("
<center>

<table width='500' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' colspan='5'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Comprobantes en donde <br>LA CUENTA UTILIZADA<br> no coincide con el plan contable</b></span>
</div>
</td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>DOCUMENTO</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CUENTA</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>VR DEBITO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>VR CREDITO</b></span></td>


</tr>


");

					while ($rw2 = $re->fetch_assoc()) {

						printf("
			<span class='Estilo4'>
			<tr>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			
			</tr>", $rw2["dcto"], $rw2["fecha"], $rw2["cuenta"], $rw2["debito"], $rw2["credito"]);
					}
					printf("</table></center>");
					//--------	
					?>

					<br />
					<?php
					$sq2 = "SELECT * from lib_aux LEFT JOIN pgcp ON lib_aux.cuenta = pgcp.cod_pptal WHERE pgcp.tip_dato ='M'";
					$re2 = $cx->query($sq2) or die($re2 . mysqli_error($cx) . "");

					printf("
<center>

<table width='500' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td align='center' colspan='5'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Comprobantes en donde <br>LA CUENTA UTILIZADA<br> es de tipo Mayor</b></span>
</div>
</td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>DOCUMENTO</b></span>
</div>
</td>
<td align='center' width='100'><span class='Estilo4'><b>FECHA</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CUENTA</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>VR DEBITO</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>VR CREDITO</b></span></td>


</tr>


");

					while ($rw2 = $re2->fetch_assoc()) {

						printf("
			<span class='Estilo4'>
			<tr>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			<td align='left'><span class='Estilo4'> %s </span></td>
			
			</tr>", $rw2["dcto"], $rw2["fecha"], $rw2["cuenta"], $rw2["debito"], $rw2["credito"]);
					}
					printf("</table></center>");

					//-------

					?>
					<br />

				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div style="padding-left:5px; padding-top:20px; padding-right:5px; padding-bottom:10px;">
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
		</table>
	</body>

	</html>
<?php
}
?>