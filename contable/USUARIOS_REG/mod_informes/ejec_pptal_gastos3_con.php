<?
set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=EJECUCION_GASTOS_REGISTRO.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
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
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
-->
</style>

<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo10 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo11 {font-size: 10px}

.text
  {
 mso-number-format:"\@"
  }
-->
</style>
</head>


</head>

<body>
<?php
//-------
include('../config.php');	
$cxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sxx = "select * from fecha";
$rxx = mysql_db_query($database, $sxx, $cxx);
while($rowxxx = mysql_fetch_array($rxx)) 
   {
   $idxxx=$rowxxx["id_emp"];
   $id_emp=$rowxxx["id_emp"];
   $ano=$rowxxx["ano"];
   }
$sxxq = "select * from fecha_ini_op";
$rxxq = mysql_db_query($database, $sxxq, $cxx);
while($rowxxxq = mysql_fetch_array($rxxq)) 
   {
   $fecha_ini_op=$rowxxxq["fecha_ini_op"];
   }   
$cx2 = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from empresa where cod_emp = '$idxxx'";
$re2 = mysql_db_query($database, $sq2, $cx2);
while($row2 = mysql_fetch_array($re2)) 
   {
   $empresa = $row2["raz_soc"];
   }
//--------	--------------------------------------------------------------------------------------------

	$fecha_ini=$_POST['fecha_ini']; //printf("fecha ini : %s",$fecha_ini);
	$fecha_fin=$_POST['fecha_fin'];	//printf("fecha fin : %s",$fecha_fin);
	$tipo = $_POST['mov_mes'];
	$fecha_per = $_POST['fecha_per'];
	$mov_periodo = $_POST['mov_periodo'];
	$consolida = $_POST['consolida'];

$anno = substr($ano,0,4);	
// Para cargar la url e incluir imagenes al archivo que se genera
//echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/imagen.gif";          
//***** Consulto la base para llenar la tabla 
$ruta_img = "http://$_SERVER[HTTP_HOST]/USUARIOS_REG/images/PLANTILLA PNG PARA LOGO EMPRESA.png";
if($mov_periodo =='')
{
?>
<table width="800" border="0" align="center">
<tr>
  <td rowspan="5" align="center"><img src='<?php echo $ruta_img; ?>' /></td>
	<td align="center" colspan="15"></td>
</tr>
<tr>
	<td align="center" colspan="15"><font size="4"><b><?php echo $empresa; ?></b></font></td>
</tr>
<tr>
    <td align="center" colspan="15"><font size="4"><b>EJECUCION PRESUPUESTAL DE GASTOS</b></font></td>
</tr>
<tr>
    <td align="center" colspan="15"><font size="4"><b>VIGENCIA <?php echo $anno; ?></b></font></td>
</tr>
<tr>
	<td align="center" colspan="15"></td>
</tr>
<tr>
	<td align="left" colspan="16"><b>FECHA DE CORTE :</b><?php echo $fecha_fin; ?></td>
</tr>
</table>

<?php
	// ************************************ EJECUCION CON CORTE POR MES **************************************************************************************
	include('../config.php');				
	$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
	$sq = "select * from ppto_consolida where entidad ='MUNICIPIO DE IPIALES' order by cod asc ";
	$re = mysql_db_query($database, $sq, $cx);
	
	printf("
	<center>
	<table width='2400' BORDER='1' class='bordepunteado1'>
	<tr bgcolor='#DCE9E5'>
	<td align='center' width='150'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>Cod. Pptal</b></span>
	</div>
	</td>
	<td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro </b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Vr. Inicial</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones_mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reducciones_mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reducciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Creditos_mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Creditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>ContraCreditos_mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>ContraCreditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Compromisos mes CDP</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Compromisos CDP</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Compromisos mes RP</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Compromisos RP</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Obligaciones mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Obligaciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Pagos mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Pagos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Saldo x Ejec</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reservas</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Cuentas x Pagar</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
	");
	
	while($rw = mysql_fetch_array($re)) 
	{
		$link=mysql_connect($server,$dbuser,$dbpass);
		//****
		$cod=$rw["cod"];
		//****
		//****  SALDOS ACUMULADOS
		$resultax=mysql_query("select SUM(ini) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$rowx=mysql_fetch_row($resultax);
		$inicial=$rowx[0]; 
		//****
		$resulta=mysql_query("select SUM(adi) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row=mysql_fetch_row($resulta);
		$total_adi=$row[0]; 
		
		$resulta2=mysql_query("select SUM(red) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row2=mysql_fetch_row($resulta2);
		$total_red=$row2[0];
		
		$resulta3=mysql_query("select SUM(cred) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row3=mysql_fetch_row($resulta3);
		$total_cre=$row3[0];
		
		$resulta4=mysql_query("select SUM(ccred) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row4=mysql_fetch_row($resulta4);
		$total_ccre=$row4[0];
		
		$definitivo = $inicial + $total_adi - $total_red + $total_cre - $total_ccre;
		$resulta5=mysql_query("select SUM(cdp) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row5=mysql_fetch_row($resulta5);
		$total_cdpp=$row5[0];
		
		$resulta6=mysql_query("select SUM(rp) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row6=mysql_fetch_row($resulta6);
		$total_crpp=$row6[0];
		
		$resulta7=mysql_query("select SUM(obl) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row7=mysql_fetch_row($resulta7);
		$total_cobp=$row7[0];
		
		$sqlceva = mysql_query("SELECT SUM(pag) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row8=mysql_fetch_row($sqlceva);
		$total_ceva1=$row8[0];
					
		$total_ceva = $total_ceva1 + $total_ceva_acum;
		//$saldo_sin_afec = $definitivo - $total_cdpp;
		$saldo_x_ejec = $definitivo - $total_crpp;
		$reservas = $total_crpp - $total_cobp;
		$cxp = $total_cobp - $total_ceva;
		
		// Calculos gastos del mes 
		$resulta55=mysql_query("select SUM(cdp_mes) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row55=mysql_fetch_row($resulta55);
		$total_cdpp_mes=$row55[0];

		$resulta10=mysql_query("select SUM(rp_mes) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row10=mysql_fetch_row($resulta10);
		$total_crpp_mes=$row10[0];
		
		$resulta11=mysql_query("select SUM(obl_mes) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row11=mysql_fetch_row($resulta11);
		$total_cobp_mes=$row11[0];
		
		$sqlcevam = mysql_query("SELECT SUM(pag_mes) from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row12=mysql_fetch_row($sqlcevam);
		$total_ceva_mes1=$row12[0];
		
				
		$total_ceva_mes = $total_ceva_mes1 + $total_ceva_acum_mes;
		
	// modificaciones mes
		$resulta=mysql_query("select SUM(adi_mes) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row=mysql_fetch_row($resulta);
		$total_adi_mes=$row[0];
		
		$resulta=mysql_query("select SUM(red_mes) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row=mysql_fetch_row($resulta);
		$total_red_mes=$row[0]; 
			
		$resulta=mysql_query("select SUM(cred_mes) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row=mysql_fetch_row($resulta);
		$total_cre_mes=$row[0];
		
		$resulta=mysql_query("select SUM(ccred_mes) AS TOTAL from ppto_consolida WHERE consolida= 'SI' and tipo ='D' and codigo LIKE '$cod%'",$link) or die (mysql_error());
		$row=mysql_fetch_row($resulta);
		$total_ccr_mes=$row[0];
		
		printf("
		<span class='Estilo4'>
		<tr>
		<td align='left' class='text'>%s</td>
		<td align='left'><span class='Estilo4'>%s</span></td>
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
		<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
		<td align='right'><span class='Estilo4'>%s</span></td>
		<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
		<td align='center'><span class='Estilo4'>%s</span></td>
		<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
		</tr>", $rw["cod"], ucfirst($rw["nombre"]), number_format($inicial,2,'.',','), number_format($total_adi_mes,2,'.',','), number_format($total_adi,2,'.',','),number_format($total_red_mes,2,'.',','),number_format($total_red,2,'.',','), number_format($total_cre_mes,2,'.',','),number_format($total_cre,2,'.',','), number_format($total_ccr_mes,2,'.',','),number_format($total_ccre,2,'.',','), number_format($definitivo,2,'.',','),number_format($total_cdpp_mes,2,'.',','),number_format($total_cdpp,2,'.',','),number_format($total_crpp_mes,2,'.',','),number_format($total_crpp,2,'.',','),number_format($total_cobp_mes,2,'.',','), number_format($total_cobp,2,'.',','),number_format($total_ceva_mes,2,'.',','),number_format($total_ceva,2,'.',','), number_format($saldo_x_ejec,2,'.',','), number_format($reservas,2,'.',','), number_format($cxp,2,'.',','), $rw["tipo"], $rw["nivel"]); 
		   }
	printf("</table></center>");

 // FIN INFORME POR PERIODO
	}
?>
<br />
<br />
</body>
</html>
<?
}
?>