<?php
set_time_limit(1200);
session_start();
if (!$_SESSION["login"]) {
	header("Location: ../login.php");
	exit;
} else {
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=PAC_GASTOS.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
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
		<style type="text/css">
			.Estilo10 {
				color: #FFFFFF;
				font-weight: bold;
			}

			.Estilo11 {
				font-size: 10px
			}

			.text {
				mso-number-format: "\@"
			}
		</style>
	</head>

	<body>
		<?php
		//-------
		include('../config.php');
		$cxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$sxx = "select * from fecha";
		$rxx = $cxx->query($sxx);
		while ($rowxxx = $rxx->fetch_assoc()) {
			$idxxx = $rowxxx["id_emp"];
			$id_emp = $rowxxx["id_emp"];
			$ano = $rowxxx["ano"];
		}
		$sxxq = "select * from fecha_ini_op";
		$rxxq = $cxx->query($sxxq);
		while ($rowxxxq = $rxxq->fetch_assoc()) {
			$fecha_ini_op = $rowxxxq["fecha_ini_op"];
		}
		$cx2 = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$sq2 = "select * from empresa where cod_emp = '$idxxx'";
		$re2 = $cx2->query($sq2);
		while ($row2 = $re2->fetch_assoc()) {
			$empresa = $row2["raz_soc"];
		}
		//--------	--------------------------------------------------------------------------------------------

		$fecha_ini = '2016/01/01'; //printf("fecha ini : %s",$fecha_ini);
		$fecha_fin = '2016/01/01';	//printf("fecha fin : %s",$fecha_fin);

		$anno = substr($ano, 0, 4);
		// Para cargar la url e incluir imagenes al archivo que se genera
		//echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/imagen.gif";          
		//***** Consulto la base para llenar la tabla 
		$ruta_img = "http://$_SERVER[HTTP_HOST]/USUARIOS_REG/images/PLANTILLA PNG PARA LOGO EMPRESA.png";
		?>
		<table width="800" border="0" align="center">
			<tr>
				<td rowspan="5" align="center"><img src='<?php echo $ruta_img; ?>' /></td>
				<td align="center" colspan="15"></td>
			</tr>
			<tr>
				<td align="center" colspan="15">
					<font size="4"><b><?php echo $empresa; ?></b></font>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="15">
					<font size="4"><b>EJECUCION P.A.C. DE GASTOS</b></font>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="15">
					<font size="4"><b>VIGENCIA <?php echo $anno; ?></b></font>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="15"></td>
			</tr>
			<tr>
				<td align="left" colspan="16"><b>FECHA DE CORTE 22:</b><?php echo $fecha_fin; ?></td>
			</tr>
		</table>

		<?php
		//-------
		include('../config.php');
		$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$sq = "select * from car_ppto_gas order by cod_pptal asc ";
		$re = $cx->query($sq);

		printf("
<center>

<table width='2400' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Cod. Pptal</b></span>
</div>
</td>
<td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Vr. Inicial</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Reducciones</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Creditos</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>ContraCreditos</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Enero</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Febrero</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Marzo</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Abril</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Mayo</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Junio</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Julio</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Agosto</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Septiembre</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Octubre</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Novienmbre</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Diciembre</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Total</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Tipo</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Nivel</b></span></td>
");
		while ($rw = $re->fetch_assoc()) {
			$link = new mysqli($server, $dbuser, $dbpass, $database);
			//****
			$cod = $rw["cod_pptal"];
			//****
			//****
			$resultax = $link->query("SELECT SUM(ppto_aprob) AS TOTAL from car_ppto_gas WHERE (ano between '$fecha_ini' and '$fecha_fin' )  and tip_dato ='D' and cod_pptal LIKE '$cod%'") or die(mysqli_error($link));
			$rowx = $resultax->fetch_row();
			$inicial = $rowx[0];
			//****
			$resulta = $link->query("SELECT SUM(valor_adi) AS TOTAL from adi_ppto_gas WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal LIKE '$cod%'") or die(mysqli_error($link));
			$row = $resulta->fetch_row();
			$total_adi = $row[0];

			$resulta2 = $link->query("SELECT SUM(valor_adi) AS TOTAL from red_ppto_gas WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal LIKE '$cod%'") or die(mysqli_error($link));
			$row2 = $resulta2->fetch_row();
			$total_red = $row2[0];

			$resulta3 = $link->query("SELECT SUM(valor_adi) AS TOTAL from creditos WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal LIKE '$cod%'") or die(mysqli_error($link));
			$row3 = $resulta3->fetch_row();
			$total_cre = $row3[0];

			$resulta4 = $link->query("SELECT SUM(valor_adi) AS TOTAL from contracreditos WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' )  and cod_pptal LIKE '$cod%'") or die(mysqli_error($link));
			$row4 = $resulta4->fetch_row();
			$total_ccre = $row4[0];

			$definitivo = $inicial + $total_adi - $total_red + $total_cre - $total_ccre;
			$resulta5 = $link->query("SELECT SUM(valor) AS TOTAL from cdpp WHERE (fecha_reg between '$fecha_ini' and '$fecha_fin' )  and cuenta LIKE '$cod%'") or die(mysqli_error($link));
			$row5 = $resulta5->fetch_row();
			$total_cdpp = $row5[0];
			// fechas
			$anno2 = explode("/", $fecha_ini);
			$anno = $anno2[0];
			// enero
			$ene_ini = $anno . "/01/01";
			$ene_fin = $anno . "/01/31";
			$sqlceva = $link->query("SELECT SUM(enero) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();
			$enero = $row8[0];
			// febrero
			$feb_ini = $anno . "/02/01";
			$feb_fin = $anno . "/02/29";
			$sqlceva = $link->query("SELECT SUM(febrero) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();

			$febrero = $row8[0];
			// marzo
			$mar_ini = $anno . "/03/01";
			$mar_fin = $anno . "/03/31";
			$sqlceva = $link->query("SELECT SUM(marzo) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();

			$marzo = $row8[0];
			// Abril 
			$abr_ini = $anno . "/04/01";
			$abr_fin = $anno . "/04/31";
			$sqlceva = $link->query("SELECT SUM(abril) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();

			$abril = $row8[0];
			// Mayo
			$may_ini = $anno . "/05/01";
			$may_fin = $anno . "/05/31";
			$sqlceva = $link->query("SELECT SUM(mayo) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();

			$mayo = $row8[0];
			// Junio
			$jun_ini = $anno . "/06/01";
			$jun_fin = $anno . "/06/30";
			$sqlceva = $link->query("SELECT SUM(junio) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();
			$junio = $row8[0];
			// Julio
			$jul_ini = $anno . "/07/01";
			$jul_fin = $anno . "/07/31";
			$sqlceva = $link->query("SELECT SUM(julio) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();
			$julio = $row8[0];
			// Agosto
			$ago_ini = $anno . "/08/01";
			$ago_fin = $anno . "/08/31";
			$sqlceva = $link->query("SELECT SUM(agosto) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();
			$agosto = $row8[0];
			// Septiembre
			$sep_ini = $anno . "/09/01";
			$sep_fin = $anno . "/09/30";
			$sqlceva = $link->query("SELECT SUM(septiembre) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();
			$septiembre = $row8[0];
			// octubre
			$oct_ini = $anno . "/10/01";
			$oct_fin = $anno . "/10/31";
			$sqlceva = $link->query("SELECT SUM(octubre) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();
			$octubre = $row8[0];
			// Noviembre
			$nov_ini = $anno . "/11/01";
			$nov_fin = $anno . "/11/30";
			$sqlceva = $link->query("SELECT SUM(noviembre) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();
			$noviembre = $row8[0];
			// Diciembre
			$dic_ini = $anno . "/12/01";
			$dic_fin = $anno . "/12/31";
			$sqlceva = $link->query("SELECT SUM(diciembre) AS enero FROM pac_gastos where  cod_pptal LIKE '$cod%' ") or die(mysqli_error($link));
			$row8 = $sqlceva->fetch_row();
			$diciembre = $row8[0];
			$total_ceva = $enero + $febrero + $marzo + $abril + $mayo + $junio + $julio + $agosto + $septiembre + $octubre + $noviembre + $diciembre;
			//$saldo_sin_afec = $definitivo - $total_cdpp;
			$total_crpp = 0;
			$total_cobp = 0;
			$saldo_x_ejec = $definitivo - $total_crpp;
			$reservas = $total_crpp - $total_cobp;
			$cxp = $total_cobp - $total_ceva;

			printf("
<span class='Estilo4'>
<tr>
<td align='left' class='text'>%s</td>
<td align='left'><span class='Estilo4'> %s </span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s </span></td>
<td align='right'><span class='Estilo4'>%s</span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>

<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>


</tr>", $rw["cod_pptal"], ucfirst($rw["nom_rubro"]), number_format($inicial, 2, '.', ','), number_format($total_adi, 2, '.', ','), number_format($total_red, 2, '.', ','), number_format($total_cre, 2, '.', ','), number_format($total_ccre, 2, '.', ','), number_format($definitivo, 2, '.', ','), number_format($enero, 2, '.', ','), number_format($febrero, 2, '.', ','), number_format($marzo, 2, '.', ','), number_format($abril, 2, '.', ','), number_format($mayo, 2, '.', ','), number_format($junio, 2, '.', ','),  number_format($julio, 2, '.', ','), number_format($agosto, 2, '.', ','), number_format($septiembre, 2, '.', ','), number_format($octubre, 2, '.', ','), number_format($noviembre, 2, '.', ','), number_format($diciembre, 2, '.', ','), number_format($total_ceva, 2, '.', ','), $rw["tip_dato"], $rw["nivel"]);
		}
		printf("</table></center>");
		//--------	
		?>
		<br />
		<br />
	</body>

	</html>
<?php
}
?>