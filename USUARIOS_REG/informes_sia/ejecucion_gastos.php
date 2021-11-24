<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201101_F07_AGR.xls");
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
// llegan las variables
$fecha_ini=$_GET['fecha_ini'];
$fecha_fin=$_GET['fecha_fin'];
$mes = $_GET['mes'];
$periodo = array ("","MARZO", "JUNIO", "SEPTIEMBRE", "DICIEMBRE","ANUAL");
for ($i=1;$i<=13;$i++)
{
	if ($mes == $i) $per = $periodo[$i];
}
printf("
<center>
<table width='950' BORDER='1' class='bordepunteado1'>
<tr>
<td bgcolor='#DCE9E5' align='center' width='140'><b>C�digo Rubro Presupuestal</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Nombre Rubro Presupuestal</b></td>
<td bgcolor='#DCE9E5' align='center'><b>C�digo Del Programa</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Apropiaci�n Inicial</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Credito</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Credito Acum</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Contracr�ditos</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Contracr�ditos Acum</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Aplazamientos</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Aplazamientos Acum</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Desaplazamientos</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Desaplazamientos Acum</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Reducciones</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Reducciones Acum</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Adiciones</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Adiciones Acum</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Compromisos Registro Presupuestal</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Compromisos Acum</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Obligado Acum</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Pagos</b></td>
<td bgcolor='#DCE9E5' align='center'><b>Pagos Acum</b></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Periodo reportado</span></td>
");
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "SELECT * from car_ppto_gas where tip_dato='D' ORDER BY cod_pptal";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re))
{
	if ($rw["cod_sia"] =='S' ||  $rw["cod_sia"] =='E' || $rw["cod_sia"] =='V' || $rw["cod_sia"] =='' || $rw["cod_sia"] =='T') $color = 'bgcolor=red';
	$cod_pptal=$rw["cod_pptal"];
// Datos para saldo inicial
			// Creditos
			$sq12 = "SELECT SUM(valor_adi) as valor_adi from creditos where cod_pptal ='$cod_pptal' and fecha_adi < '$fecha_ini'";
			$re12 = mysql_db_query($database, $sq12, $cx);
			while($rw12 = mysql_fetch_array($re12))
			{
			$valor_cred_ini=$rw12["valor_adi"];
			if ($valor_cred_ini=='')
				{
				$valor_cred_ini=0;
				}
			}
			// Contracreditos
			$sq13 = "SELECT SUM(valor_adi) as valor_adi from contracreditos where cod_pptal ='$cod_pptal' and fecha_adi < '$fecha_ini'";
			$re13 = mysql_db_query($database, $sq13, $cx);
			while($rw13 = mysql_fetch_array($re13))
			{
			$valor_ccred_ini=$rw13["valor_adi"];
			if ($valor_ccred_ini=='')
				{
				$valor_ccred_ini=0;
				}
			}
			// Reducciones
			$sq14 = "SELECT SUM(valor_adi) as valor_adi from red_ppto_gas where cod_pptal ='$cod_pptal' and fecha_adi < '$fecha_ini'";
			$re14= mysql_db_query($database, $sq14, $cx);
			while($rw14 = mysql_fetch_array($re14))
			{
			$valor_red_ini=$rw14["valor_adi"];
			if ($valor_red_ini=='')
				{
				$valor_red_ini=0;
				}
			}				
			// Adiciones
			$sq15 = "SELECT SUM(valor_adi) as valor_adi from adi_ppto_gas where cod_pptal ='$cod_pptal' and fecha_adi < '$fecha_ini'";
			$re15= mysql_db_query($database, $sq15, $cx);
			while($rw15 = mysql_fetch_array($re15))
			{
			$valor_adi_ini=$rw15["valor_adi"];
			if ($valor_adi_ini=='')
				{
				$valor_adi_ini=0;
				}
			}
			
			// Aplaamientos
			$sq15 = "SELECT SUM(valor_aplazado) as valor_apl from aplazamientos where cod_pptal ='$cod_pptal' and fecha_adi < '$fecha_ini'";
			$re15= mysql_db_query($database, $sq15, $cx);
			while($rw15 = mysql_fetch_array($re15))
			{
			$valor_apla_ini=$rw15["valor_apl"];
			if ($valor_apla_ini=='')
				{
				$valor_apla_ini=0;
				}
			}
			
			// Levanta aplazamientos
			$sq15 = "SELECT SUM(valor_levantado) as valor_lev from levanta_aplazamientos where cod_pptal ='$cod_pptal' and fecha_adi < '$fecha_ini'";
			$re15= mysql_db_query($database, $sq15, $cx);
			while($rw15 = mysql_fetch_array($re15))
			{
			$valor_lev_ini=$rw15["valor_lev"];
			if ($valor_lev_ini=='')
				{
				$valor_lev_ini=0;
				}
			}				

			$inicial = 	$rw["ppto_aprob"] +	$valor_adi_ini - $valor_red_ini + $valor_cred_ini - $valor_ccred_ini;
// Datos para movimiento
			$sq3 = "SELECT SUM(valor_adi) as valor_adi from creditos where cod_pptal ='$cod_pptal' and fecha_adi BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re3 = mysql_db_query($database, $sq3, $cx);
			$sq4 = "SELECT SUM(valor_adi) as valor_adi from contracreditos where cod_pptal ='$cod_pptal' and fecha_adi BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re4 = mysql_db_query($database, $sq4, $cx);
			$sq5 = "SELECT SUM(valor_aplazado) as valor_aplazado from aplazamientos where cod_pptal ='$cod_pptal' and fecha_adi BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re5 = mysql_db_query($database, $sq5, $cx);
			$sq6 = "SELECT SUM(valor_levantado) as valor_levantado from levanta_aplazamientos where cod_pptal ='$cod_pptal' and fecha_adi BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re6= mysql_db_query($database, $sq6, $cx);
			$sq7 = "SELECT SUM(valor_adi) as valor_adi from red_ppto_gas where cod_pptal ='$cod_pptal' and fecha_adi BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re7= mysql_db_query($database, $sq7, $cx);
			$sq8 = "SELECT SUM(valor_adi) as valor_adi from adi_ppto_gas where cod_pptal ='$cod_pptal' and fecha_adi BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re8= mysql_db_query($database, $sq8, $cx);
			$sq9 = "SELECT SUM(vr_digitado) as vr_digitado from crpp where cuenta ='$cod_pptal' and fecha_crpp BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re9= mysql_db_query($database, $sq9, $cx);
			
			$sq10 = "SELECT SUM(vr_digitado) as vr_digitado from cobp where cuenta ='$cod_pptal' and fecha_cobp  BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re10= mysql_db_query($database, $sq10, $cx);
			$sq11 = "select vr_digitado,id_auto_cobp,ceva from cobp where cuenta = '$cod_pptal' and pagado ='SI'";
			$re11= mysql_db_query($database, $sq11, $cx);
			while ($rw11 = mysql_fetch_array($re11))
			{
				$sq16= "select * from ceva where fecha_ceva BETWEEN '$fecha_ini' AND '$fecha_fin' and (id_auto_cobp ='$rw11[id_auto_cobp]' or id_auto_ceva ='$rw11[ceva]')";
				$re16= mysql_db_query($database, $sq16, $cx);
				$rw16 = mysql_fetch_array($re16);
				$fl16 = mysql_num_rows($re16);
				if ($fl16 >0)
				{
					$pagos += $rw11['vr_digitado'];
				}
	
			}
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
			$sq19 = "SELECT SUM(vr_digitado) as vr_digitado from crpp where cuenta ='$cod_pptal' and fecha_crpp <= '$fecha_fin'";
			$re19= mysql_db_query($database, $sq19, $cx);
			while($rw19 = mysql_fetch_array($re19))
			{
			$compro_acum=$rw19["vr_digitado"];
			if ($compro_acum=='')
				{
				$compro_acum=0;
				}
			}
			$sq21 = "select vr_digitado,id_auto_cobp,ceva from cobp where cuenta = '$cod_pptal' and pagado ='SI'";
			$re21= mysql_db_query($database, $sq21, $cx);
			while ($rw21 = mysql_fetch_array($re21))
			{
				$sq26= "select * from ceva where fecha_ceva <= '$fecha_fin' and (id_auto_cobp ='$rw21[id_auto_cobp]' or id_auto_ceva ='$rw21[ceva]')";
				$re26= mysql_db_query($database, $sq26, $cx);
				$rw26 = mysql_fetch_array($re26);
				$fl26 = mysql_num_rows($re26);
				if ($fl26 >0)
				{
					$pagos_acum += $rw21['vr_digitado'];
				}
	
			}
			
			$cred_acum = $valor_cred_ini + $valor_adi;
			$ccred_acum =$valor_ccred_ini + $valor_adi4;
			$apla_acum = $valor_apla_ini + $valor_aplazado;
			$leva_acum = $valor_lev_ini + $valor_levantado;
			$red_acum = $valor_red_ini + $valor_adic;
			$adi_acum = $valor_adi_ini + $adiciones;
			printf("
			<span class='Estilo4'>
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
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
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='center'>%s</td>
				</tr>", $rw["cod_sia"].$rw["cod_pptal"], ucfirst(ereg_replace("[,;]", "",$rw["nom_rubro"])), $rw["cod_sia"], $inicial, $valor_adi, $cred_acum,$valor_adi4, $ccred_acum,$valor_aplazado,$apla_acum, $valor_levantado,$leva_acum, $valor_adic,$red_acum, $adiciones, $adi_acum,$vr_digitado, $compro_acum,$cobp,$pagos,$pagos_acum,$per); 
			$pagos =0;
			$pagos_acum =0;
			$color='';
			$cred_acum = 0;
			$ccred_acum =0;
			$apla_acum = 0;
			$leva_acum = 0;
			$red_acum = 0;
			$adi_acum = 0;
			$cobp=0;
			
}
printf("</table></center>");
}
?>