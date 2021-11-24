<?
set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Aprobado_pac_gastos.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<style>
.text
  {
 mso-number-format:"\@"
  }
.date
	{
	mso-number-format:"yyyy\/mm\/dd"	
	}
.numero
	{
	mso-number-format:"0"	
	}
</style>
</head>
<body>
<div align="center" class="Estilo4">
<div style='padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;'>
 <?
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
printf("
<center>
<table width='950' BORDER='1' class='bordepunteado1'>
<tr>
<td bgcolor='#DCE9E5' align='center'><b>Cuenta</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Nombre</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Aprobado</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Enero</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Febrero</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Marzo</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Abril</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Mayo</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Junio</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Julio</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Agosto</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Septiembre</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Octubre</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Noviembre</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Diciembre</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Resago</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Total Pac</b></td>
</tr>
");
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Consulto A�O de la vigencia actual
$sql = "select * from fecha";
$res = mysql_db_query($database, $sql, $cx);
while($row = mysql_fetch_array($res)) 
{
$ano=$row["ano"];
}
$anno = substr($ano,0,4);
// Defino fechas de corte
// Cargo uno a uno los rubros del plan presupuestal
$sq = "select * from car_ppto_gas group by cod_pptal order by cod_pptal asc";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc())
{
	$ejecutado=0;
	$resago=0;
	$total=0;
	$cod_pptal = $rw["cod_pptal"];
	$nom_rubro = $rw["nom_rubro"];
	// Consulto cuanto es el valor INICIAL de cada rubro
	$sq1 = "SELECT SUM(ppto_aprob) as inicial from car_ppto_gas where cod_pptal like '$cod_pptal%'";
	$re1 = mysql_db_query($database, $sq1, $cx);
	$rw1 = mysql_fetch_array($re1);
	// Consulto valores ADICION para cada cuenta
	$sq2 = "SELECT SUM(valor_adi) as adicion from adi_ppto_gas where cod_pptal like '$cod_pptal%'";
	$re2= mysql_db_query($database, $sq2, $cx);
	$rw2 = $re2->fetch_assoc();
	// Consulto valor REDUCCION para cada cuenta
	$sq3 = "SELECT SUM(valor_adi) as reduccion from red_ppto_gas where cod_pptal like '$cod_pptal%'";
	$re3= mysql_db_query($database, $sq3, $cx);		
	$rw3 = mysql_fetch_array($re3);
	// Consulto valor CREDITO para cada cuenta
	$sq4 = "SELECT SUM(valor_adi) as credito from creditos where cod_pptal like '$cod_pptal%'";
	$re4 = mysql_db_query($database, $sq4, $cx);
	$rw4 = mysql_fetch_array($re4);
	// Consulto valor CONTRACREDITO para cada rubro
	$sq5 = "SELECT SUM(valor_adi) as contracredito from contracreditos where cod_pptal like '$cod_pptal%'";
	$re5 = mysql_db_query($database, $sq5, $cx);
	$rw5 = mysql_fetch_array($re5);
	$definitivo = $rw1["inicial"] + $rw2["adicion"] - $rw3["reduccion"] + $rw4["credito"] - $rw5["contracredito"];
	// Consulto pagos ENERO
	$sq6 = "SELECT SUM(enero) as enero from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re6 = mysql_db_query($database, $sq6, $cx);
	$rw6 = mysql_fetch_array($re6);
	if (!$rw6["enero"]) $rw6["enero"] =0;
	// Consulto pagos FEBRERO
	$sq7 = "SELECT SUM(febrero) as febrero from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re7 = mysql_db_query($database, $sq7, $cx);
	$rw7 = mysql_fetch_array($re7);
	if (!$rw7["febrero"]) $rw7["febrero"] =0;
	// Consulto pagos MARZO
	$sq8 = "SELECT SUM(marzo) as marzo from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re8 = mysql_db_query($database, $sq8, $cx);
	$rw8 = mysql_fetch_array($re8);
	if (!$rw8["marzo"]) $rw8["marzo"] =0;
	// Consulto pagos ABRIL
	$sq9 = "SELECT SUM(abril) as abril from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re9 = mysql_db_query($database, $sq9, $cx);
	$rw9 = mysql_fetch_array($re9);
	if (!$rw9["abril"]) $rw9["abril"] =0;
	// Consulto pagos MAYO
	$sq10 = "SELECT SUM(mayo) as mayo from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re10 = mysql_db_query($database, $sq10, $cx);
	$rw10 = mysql_fetch_array($re10);
	if (!$rw10["mayo"]) $rw10["mayo"] =0;
	// Consulto pagos JUNIO
	$sq11 = "SELECT SUM(junio) as junio from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re11 = mysql_db_query($database, $sq11, $cx);
	$rw11 = mysql_fetch_array($re11);
	if (!$rw11["junio"]) $rw11["junio"] =0;
	// Consulto pagos JULIO
	$sq12 = "SELECT SUM(julio) as julio from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re12 = mysql_db_query($database, $sq12, $cx);
	$rw12 = mysql_fetch_array($re12);
	if (!$rw12["julio"]) $rw12["julio"] =0;
	// Consulto pagos AGOSTO
	$sq13 = "SELECT SUM(agosto) as agosto from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re13 = mysql_db_query($database, $sq13, $cx);
	$rw13 = mysql_fetch_array($re13);
	if (!$rw13["agosto"]) $rw13["agosto"] =0;
	// Consulto pagos SEPTIEMBRE
	$sq14 = "SELECT SUM(septiembre) as septiembre from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re14 = mysql_db_query($database, $sq14, $cx);
	$rw14 = mysql_fetch_array($re14);
	if (!$rw14["septiembre"]) $rw14["septiembre"] =0;
	// Consulto pagos OCTUBRE
	$sq15 = "SELECT SUM(octubre) as octubre from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re15 = mysql_db_query($database, $sq15, $cx);
	$rw15 = mysql_fetch_array($re15);
	if (!$rw15["octubre"]) $rw15["octubre"] =0;
	// Consulto pagos NOVIEMBRE
	$sq16 = "SELECT SUM(noviembre) as noviembre from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re16 = mysql_db_query($database, $sq16, $cx);
	$rw16 = mysql_fetch_array($re16);
	if (!$rw16["noviembre"]) $rw16["noviembre"] =0;
	// Consulto pagos DICIEMBRE
	$sq17 = "SELECT SUM(diciembre) as diciembre from pac_gastos where cod_pptal like '$cod_pptal%'";
	$re17 = mysql_db_query($database, $sq17, $cx);
	$rw17 = mysql_fetch_array($re17);
	if (!$rw17["diciembre"]) $rw17["diciembre"] =0;
	$diciembre = $rw17["diciembre"] + $rw2["adicion"] - $rw3["reduccion"] + $rw4["credito"] - $rw5["contracredito"];
			printf("
			<span class='Estilo4'>
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			</tr>", $rw["cod_pptal"], ucfirst(preg_replace("[,;]", "",$rw["nom_rubro"])), $definitivo,(int)$rw6["enero"],(int)$rw7["febrero"],(int)$rw8["marzo"],(int)$rw9["abril"],(int)$rw10["mayo"],(int)$rw11["junio"],(int)$rw12["julio"],(int)$rw13["agosto"],(int)$rw14["septiembre"],(int)$rw15["octubre"],(int)$rw16["noviembre"],(int)$diciembre,$resago,$total); 
			}
printf("</table></center>");
}
?>