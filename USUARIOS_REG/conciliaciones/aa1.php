<?php
set_time_limit(600);
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

		<script>
			function cerrarVentana() {
				window.close()
			}
		</script>
		<style type="text/css">
			.Estilo2 {
				font-size: 10px;
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-weight: bolder;
				color: #333333;
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
		<style type="text/css">
			.Estilo8 {
				font-weight: bold
			}

			.Estilo9 {
				font-weight: bold
			}

			.Estilo10 {
				color: #FFFFFF;
				font-weight: bold;
			}

			.Estilo11 {
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
		</style>
		<style type="text/css">
			table.bordepunteado1 {
				border-style: solid;
				border-collapse: collapse;
				border-width: 2px;
				border-color: #004080;
			}
		</style>
		<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
		</LINK>

		<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
		<script>
			function validar(e) {
				tecla = (document.all) ? e.keyCode : e.which;
				if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
				patron = /\d/; //ver nota 
				te = String.fromCharCode(tecla);
				return patron.test(te);
			}

			function formatea(valor) {
				var valor = valor.toString();
				var num = valor.replace(/\,/g, '');
				if (!isNaN(num)) {
					num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1,');
					num = num.split('').reverse().join('').replace(/^[\,]/, '');
					return num;
				}
			}

			function formato(id, val) {
				document.getElementById(id).value = formatea(val);
			}
		</script>


		<!--linea de insercion del jquery-->

		<script type="text/javascript" language="javascript" src="../jquery.js"></script>


		<!-- inicio mostrar tabla-->

		<!--**************************-->
		<script type="text/javascript">
			$(function() {

				$("#mostrar").click(function(event) {
					event.preventDefault();
					$("#caja").slideToggle();
				});

			});
		</script>
		<!--**************************-->

		<style type="text/css">
			a {
				color: #993300;
				text-decoration: none;
			}

			#caja {
				width: 100%;
				display: none;
				padding: 5px;
				border: 2px solid #ffffff;
				background-color: #ffffff;
			}

			#mostrar {
				display: block;
				width: 100%;
				padding: 5px;
				border: 2px solid #D0E8F4;
				background-color: #ECF8FD;
			}
		</style>

		<!-- fin mostrar tabla-->




	</head>

	<body>
		<br />
		</div>
		</div>
		<div align="center">
			<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:120px'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
					<div align="center"><a href='conciliacionesmes.php' target='_parent'>VOLVER </a> </div>
				</div>
			</div>
		</div>

		<div align="center" class="Estilo4">
			<div style='padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;'>
				<?php
				include('../config.php');
				$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

				$cuenta = isset($_GET['cuenta']) ? $_GET['cuenta'] : '';
				$sqlxx3 = "select * from fecha_ini_op";
				$resultadoxx3 = $cx->query($sqlxx3);

				while ($rowxx3 = $resultadoxx3->fetch_assoc()) {
					$fecha_ini_op = $rowxx3["fecha_ini_op"];
				}
				if ($cuenta != '') {
					//**********************adiciona campo empresa genero
					$tabla1 = "delete from aux_conciliaciones2 where cuenta = '$cuenta';";

					if ($cx->query($tabla1)) {
						echo "";
					} else {
						echo "";
					};
					$tabla2 = "INSERT INTO aux_conciliaciones2 SELECT * FROM aux_conciliaciones;";
					if ($cx->query($tabla2)) {
						echo "";
					} else {
						echo "";
					};
					echo "esta es la cuenta" . $cuenta;
				}

				$cod_ini = $_POST['cod_ini'];
				$cod_fin = $_POST['cod_fin'];
				$mes = $_POST['mes'];
				if (!$_POST['mes']) $mes = $_GET['mes'];
				$a = date("Y", strtotime($mes));
				$b = date("m", strtotime($mes));
				$c = date("d", strtotime($mes));

				$meses = array('', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
				$mesct = array('', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
				for ($i = 1; $i < 13; $i++) {
					if ($mesct[$i] == $b) $periodo = $meses[$i];
				}

				function esBisiesto($year = NULL)
				{
					return checkdate(2, 29, ($year == NULL) ? date('Y') : $year); // devolvemos true si es bisiesto
				}
				$bis = esBisiesto($a);
				$fecha_fin = '';
				if ($bis == 1) {
					$ene = 31;
					$feb = 29;
					$mar = 31;
					$abr = 30;
					$may = 31;
					$jun = 30;
					$jul = 31;
					$ago = 31;
					$sep = 30;
					$oct = 31;
					$nov = 30;
					$dic = 31;
					$nene = "01";
					$nfeb = "02";
					$nmar = "03";
					$nabr = "04";
					$nmay = "05";
					$njun = "06";
					$njul = "07";
					$nago = "08";
					$nsep = "09";
					$noct = "10";
					$nnov = "11";
					$ndic = "12";
				} else {
					$ene = 31;
					$feb = 28;
					$mar = 31;
					$abr = 30;
					$may = 31;
					$jun = 30;
					$jul = 31;
					$ago = 31;
					$sep = 30;
					$oct = 31;
					$nov = 30;
					$dic = 31;
					$nene = "01";
					$nfeb = "02";
					$nmar = "03";
					$nabr = "04";
					$nmay = "05";
					$njun = "06";
					$njul = "07";
					$nago = "08";
					$nsep = "09";
					$noct = "10";
					$nnov = "11";
					$ndic = "12";
				}
				if ($b == $nene or $b == $nmar or $b == $nmay or $b == $njul or $b == $nago or $b == $noct or $b == $ndic) {
					$ts1 = strtotime($mes);
					$ts = strtotime('-30 days', $ts1);
					$mes1 = date('Y/m/d', $ts);
				}
				if ($b == $nabr or $b == $njun or $b == $nsep or $b == $nnov) {
					$ts1 = strtotime($fecha_fin);
					$ts = strtotime('-29 days', $ts1);
					$mes1 = date('Y/m/d', $ts);
				}


				if ($bis == 1) {
					if ($b == $nfeb) {
						$ts1 = strtotime($fecha_fin);
						$ts = strtotime('-28 days', $ts1);
						$mes1 = date('Y/m/d', $ts);
					}
				} else {
					if ($b == $nfeb) {
						$ts1 = strtotime($fecha_fin);
						$ts = strtotime('-27 days', $ts1);
						$mes1 = date('Y/m/d', $ts);
					}
				}
				if ($mes == $a . '/02/28' && $bis == 1) {
					$fecha_fin = $a . "/02/29";
					$fecha_marca = $a . "/02/29";
				} else {
					$fecha_fin = $mes;
				}
				echo "
<center>
<table width='85%' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>

<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>CONSULTA CONCILIACIONES MES DE $periodo</b></span>
<br>
<br>
<div aling='center'> <font color='red'><b>Cuentas con diferencia pendiente de conciliar</b></font></div>
<div aling='center'> <font color='gren'><b>Cuentas sin conciliaci&oacute;n con movimiento</b></font></div>
</div>
<td align='center' width='6%'><span class='Estilo2'>Fecha</span></td>
<td align='center' width='7%'><span class='Estilo2'>Cuenta</span></td>
<td align='center' width='25%'><span class='Estilo2'>Nombre de la Cuenta</span></td>
<td align='center' width='10%'><span class='Estilo2'>Saldo en Libros</span></td>
<td align='center' width='12%'><span class='Estilo2'>Saldo Extracto</span></td>
<td align='center' width='10%'><span class='Estilo2'>Total Debitos Pendientes</span></td>
<td align='center' width='10%'><span class='Estilo2'>Saldo Creditos Pendientes</span></td>
<td align='center' width='10%'><span class='Estilo2'>Total Diferencia a Conciliar</span></td>
<td align='center' width='10%'><span class='Estilo2'>Conciliar</span></td>
<td align='center' width='10%'><span class='Estilo2'>Imprimir</span></td>
";
				if ($cod_ini and $cod_fin) $codigos = "and cod_pptal between '$cod_ini' and '$cod_fin'";
				$sq = "select cod_pptal, nom_rubro from  pgcp where tip_dato='D' and (cod_pptal like '1110%' or cod_pptal like '190101%')  order by cod_pptal asc ";
				$re = $cx->query($sq);
				while ($rw1 = $re->fetch_assoc()) {
					$cuenta = $rw1['cod_pptal'];
					$nombre = $rw1['nom_rubro'];
					// consultar el saldo en libros segun la fecha de corte
					$ss22a = "select * from sico where cuenta = '$cuenta'";
					$re21 = $cx->query($ss22a);
					$re21x = $re21->num_rows;
					if ($re21x == '1') {
						while ($rw21 = $re21->fetch_assoc()) {
							$sico = $rw21["debito"];
						}
					} else {
						$sico = 0;
					}
					$s22 = "select SUM(debito) as tot_debito, SUM(credito) as tot_creditos from lib_aux where cuenta = '$cuenta' and fecha <= '$fecha_fin' and fecha >= '$fecha_ini_op'";
					$re22 = $cx->query($s22) or die(mysqli_error($cx));
					while ($rw22 = $re22->fetch_assoc()) {
						$debitos = $rw22["tot_debito"];
						$creditos = $rw22["tot_creditos"];
					}
					//Evaluo si la cuenta se movio en el mes seleccionado
					$s23 = "select SUM(debito) as tot_debito, SUM(credito) as tot_creditos from lib_aux where cuenta = '$cuenta' and (fecha BETWEEN '$mes1' and '$mes')";
					$re23 = $cx->query($s23) or die(mysqli_error($cx));
					while ($rw23 = $re23->fetch_assoc()) {
						$debitos_mes = $rw23["tot_debito"];
						$creditos_mes = $rw23["tot_creditos"];
					}
					// consulto valores credito pendientes de conciliar de vigencias anteriores
					$sqx1 = "select sum(debito) as debito, sum(credito) as credito from aux_conciliaciones_vig_ant where cuenta ='$cuenta' and fecha <='$fecha_fin' and (fecha_marca >'$fecha_fin' or fecha_marca='')";
					$rex1 = $cx->query($sqx1);

					while ($rwx1 = $rex1->fetch_assoc()) {
						$debitos_vig_ant = $rwx1['debito'];
						$creditos_vig_ant = $rwx1['credito'];
					}
					// Consulto pendientes de la vigencia
					$sqx2 = "select sum(debito) as debito, sum(credito) as credito from aux_conciliaciones2 where cuenta ='$cuenta' and fecha <='$fecha_fin' and (fecha_marca >'$fecha_fin' or fecha_marca='' or fecha_marca  IS NULL)";
					$rex2 = $cx->query($sqx2);
					while ($rwx2 = $rex2->fetch_assoc()) {
						$debitos_vig = $rwx2['debito'];
						$creditos_vig = $rwx2['credito'];
					}
					$debitos_t =	$debitos_vig_ant + $debitos_vig;
					$creditos_t =	$creditos_vig_ant + $creditos_vig;
					$saldo = $sico + $debitos - $creditos;
					$suma = $debitos_mes + $creditos_mes;
					if ($saldo == '0' and $suma != '0') {
						//print("$cuenta ** $debitos_t *** $creditos_t");
					}
					// Busco en el axiliar de conciliacones el estado de la cuenta cunado el saldo en libros sea diferente de cero
					$sq2 = "select distinct (fecha_fin), cuenta, nom_rubro, saldo_final, saldo_extracto from aux_conciliaciones2 where cuenta =  '$cuenta' and fecha_fin ='$fecha_fin' order by cuenta asc ";
					$re2 = $cx->query($sq2);
					$re3 = $re2->num_rows;
					//$cont2=1;
					if ($re3 == '1') {
						while ($rw = $re2->fetch_assoc()) {
							$cont2 = $cont2 + 1;
							echo "<form name='concil_$cont2' id='concil_$cont2' method='post' action='conciliaciones2.php' ";
							$saldo_extracto = $rw["saldo_extracto"];
							$resaltado = '';
							$diferencia = (round($saldo_extracto * 100) / 100)  +  (round($debitos_t * 100) / 100) - (round($creditos_t * 100) / 100) - (round($saldo * 100) / 100);
							$diferencia = (round($diferencia * 100) / 100);
							if ($diferencia == '0') {
								$color = "";
							} else {
								$color = "bgcolor=#FF3300";
							}
							$saldoe = number_format($rw['saldo_extracto'], 2, '.', ',');
							printf(
								"
				<span class='Estilo4'>
				<tr>
				<td align='center'><input type='text' name='fecha_fin' id='fecha_fin' value='$rw[fecha_fin]'  size='10' style='background:#ffffff; border:none;font-size:11px;' readonly /></td>
				<td align='center' ><input type='text' name='nn' id='nn' value='$rw[cuenta]'  size='10' style='background:#ffffff; border:none;font-size:11px;' readonly/></td>
				<td align='left'><span class='Estilo4'> %s </span></td>
				<td align='right'><span class='Estilo4'> %s </span></td>
				<td align='right'><input type='text' name='saldo' id='saldo_$cont2' value='$saldoe'  size='20' style='text-align:right;background:#ffffff; border:none;font-size:11px;' onblur='formato(id,value);'/></td>
				<td align='right'><span class='Estilo4'> %s </span></td>
				<td align='right'><span class='Estilo4'> %s </span></td>
				<td align='right' $color><span class='Estilo4'> %s </span></td>
				<td align='center' ><span class='Estilo4'><input type='submit' value='Conciliar' style='background:#ffffff; color:#0066FF; border:none;font-size:13px;cursor:pointer'> </span></td>
				<td align='center'><a href='imp_conciliacion.php?cuenta=$rw[cuenta]&fecha_fin=$rw[fecha_fin]&saldo=$saldo' target='_new'>Imprimir</a> </td>
				</tr>",
								$rw["nom_rubro"],
								number_format($saldo, 2, '.', ','),
								number_format($debitos_t, 2, '.', ','),
								number_format($creditos_t, 2, '.', ','),
								number_format($diferencia, 2, '.', ',')
							);
							$diferencia = '';

							echo "</form>";
						}
					}

					// Fin If que anida consulta con aux_conciliaciones
					else {
						if ($saldo != 0  || $saldo == 0) {
							$cont2 = $cont2 + 1;

							echo "<form name='concil_$cont2' id='concil_$cont2' method='post' action='conciliaciones2.php' ";
							printf(
								"
						<span class='Estilo4'>
						<tr>
						<td align='center'><input type='text' name='fecha_fin' id='fecha_fin' value='$fecha_fin'  size='10' style='background:#ffffff; border:none;font-size:11px;' readonly /></td>
						<td align='center' bgcolor='#00CC66'><input type='text' name='nn' id='nn' value='$rw1[cod_pptal]'  size='10' style='background:#ffffff; border:none;font-size:11px;' readonly/></td>
						<td align='left'><span class='Estilo4'> %s </span></td>
						<td align='right'><span class='Estilo4'> %s </span></td>
						<td align='right'><input type='text' name='saldo' id='saldo_$cont2' value='0.00'  size='20' style='text-align:right;background:#ffffff; border:none;font-size:11px;' onblur='formato(id,value);'/></td>
						
						<td align='right'><span class='Estilo4'> %s </span></td>
						<td align='right'><span class='Estilo4'> %s </span></td>
						<td align='right' $color><span class='Estilo4'> %s </span></td>
						<td align='center' ><span class='Estilo4'><input type='submit' value='Conciliar' style='background:#ffffff; color:#0066FF; border:none;font-size:13px;cursor:pointer'></span> </td>
						</tr>",
								$rw1['nom_rubro'],
								number_format($saldo, 2, ',', '.'),
								number_format($tot_debitos, 2, ',', '.'),
								number_format('0.00', 2, ',', '.'),
								number_format($diferencia, 2, ',', '.')
							);
							echo "</form>";
						}
					}
				} // Fin while busca cuentas de bancos en pgcp

				//  echo "$rw[cuenta]";

				printf("</table></center>");
				?><br />
				<br />
			</div>
		</div>
		<div align="center">
			<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:120px'>
				<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
					<div align="center"><a href='conciliacionesmes.php' target='_parent'>VOLVER </a> </div>
				</div>
			</div>
		</div>
	</body>

	</html>
<?php
}
?>