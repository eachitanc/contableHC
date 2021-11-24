<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201102_F33A_10_CDN.xls");
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
<td bgcolor='#DCE9E5' align='center'><b>C�digo Presupuestal</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Fuente De Financiaci�n</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Presupuesto Inicial</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Presupuesto Definitivo</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Compromisos</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Pagos</b></td>
</tr>
");
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "SELECT cod_pptal, nom_rubro, padre, ppto_aprob,cod_sia,sectores_inversion,fuente_recursos from car_ppto_gas where tip_dato='D' and opc1='INVERSION' ORDER BY cod_pptal";
$re = mysql_db_query($database, $sq, $cx);
		while($rw = mysql_fetch_array($re))
		{
			$cod_pptal=$rw["cod_pptal"];
			$sq3 = "SELECT SUM(valor_adi) as valor_adi from creditos where cod_pptal ='$cod_pptal'";
			$re3 = mysql_db_query($database, $sq3, $cx);
			$sq4 = "SELECT SUM(valor_adi) as valor_adi from contracreditos where cod_pptal ='$cod_pptal'";
			$re4 = mysql_db_query($database, $sq4, $cx);
			$sq5 = "SELECT SUM(valor_aplazado) as valor_aplazado from aplazamientos where cod_pptal ='$cod_pptal'";
			$re5 = mysql_db_query($database, $sq5, $cx);
			$sq6 = "SELECT SUM(valor_levantado) as valor_levantado from levanta_aplazamientos where cod_pptal ='$cod_pptal'";
			$re6= mysql_db_query($database, $sq6, $cx);
			$sq7 = "SELECT SUM(valor_adi) as valor_adi from red_ppto_gas where cod_pptal ='$cod_pptal'";
			$re7= mysql_db_query($database, $sq7, $cx);
			$sq8 = "SELECT SUM(valor_adi) as valor_adi from adi_ppto_gas where cod_pptal ='$cod_pptal'";
			$re8= mysql_db_query($database, $sq8, $cx);
			$sq9 = "SELECT SUM(vr_digitado) as vr_digitado from crpp where cuenta ='$cod_pptal'";
			$re9= mysql_db_query($database, $sq9, $cx);
			$sq10 = "SELECT SUM(vr_digitado) as vr_digitado from cobp where cuenta ='$cod_pptal'";
			$re10= mysql_db_query($database, $sq10, $cx);
			$sq11 = "SELECT SUM(vr_digitado) as vr_digitado from cobp where cuenta ='$cod_pptal' and pagado='SI'";
			$re11= mysql_db_query($database, $sq11, $cx);
			while($rw3 = mysql_fetch_array($re3))
			{
			$valor_adi=$rw3["valor_adi"];
			if ($valor_adi=='')
				{
				$valor_adi=0;
				}
			}
			while($rw4 = mysql_fetch_array($re4))
			{
			$valor_adi4=$rw4["valor_adi"];
			if ($valor_adi4=='')
				{
				$valor_adi4=0;
				}
			}
			while($rw5 = mysql_fetch_array($re5))
			{
			$valor_aplazado=$rw5["valor_aplazado"];
			if ($valor_aplazado=='')
				{
				$valor_aplazado=0;
				}
			}	
			while($rw6 = mysql_fetch_array($re6))
			{
			$valor_levantado=$rw6["valor_levantado"];
			if ($valor_levantado=='')
				{
				$valor_levantado=0;
				}
			}						
			while($rw7 = mysql_fetch_array($re7))
			{
			$valor_adic=$rw7["valor_adi"];
			if ($valor_adic=='')
				{
				$valor_adic=0;
				}
			}				
			while($rw8 = mysql_fetch_array($re8))
			{
			$adiciones=$rw8["valor_adi"];
			if ($adiciones=='')
				{
				$adiciones=0;
				}
			}			
			while($rw9 = mysql_fetch_array($re9))
			{
			$vr_digitado=$rw9["vr_digitado"];
			if ($vr_digitado=='')
				{
				$vr_digitado=0;
				}
			}
			while($rw10 = mysql_fetch_array($re10))
			{
			$cobp=$rw10["vr_digitado"];
			if ($cobp=='')
				{
				$cobp=0;
				}
			}
			while($rw11 = mysql_fetch_array($re11))
			{
			$pagos=$rw11["vr_digitado"];
			if ($pagos=='')
				{
				$pagos=0;
				}
			}
			$definitivo =  $rw["ppto_aprob"] + $adiciones - $valor_adic + $valor_adi - $valor_adi4;
			$fuente_rec =substr($rw["sectores_inversion"],0,2); 
			if ($fuente_rec =='C1') {$fuente_fin ='RP';}
			if ($fuente_rec =='C2') {$fuente_fin ='SGP';}
			if ($fuente_rec =='C3') {$fuente_fin ='OTROS';}
			if ($fuente_rec =='') {$fuente_fin ='';}
			printf("
			<span class='Estilo4'>
			<tr>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='right'>%s</td>
			<td align='right' class='numero'>%s</td>
			<td align='right' class='numero'>%s</td>
			<td align='right' class='numero'>%s</td>
			</tr>", $rw["sectores_inversion"], $fuente_fin, $rw["ppto_aprob"], $definitivo,$vr_digitado,$pagos); 
			$definitivo=0;
			$rw["ppto_aprob"]=0;
			$adiciones=0;
			$valor_adic=0;
			$valor_adi=0;
			$valor_adi4=0;
			}
printf("</table></center>");
}
?>