<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201101_F06_AGR.xls");
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
	mso-number-format:"#,##0.00"	
	}
</style>
</head>
<body>
<?
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select raz_soc from empresa where cod_emp = '2'";
$re2 = mysql_db_query($database, $sq2, $cx);
while($row2 = mysql_fetch_array($re2)) 
   {
   $empresa = $row2["raz_soc"];
   }

// llegan las variables
$fecha_ini=$_GET['fecha_ini'];
$fecha_fin=$_GET['fecha_fin'];
$anno = explode("/",$fecha_ini);
$fecha_vigencia = $anno[0]."/01/01";
$mes = $_GET['mes'];
$periodo = array ("","MARZO", "JUNIO", "SEPTIEMBRE", "DICIEMBRE", "ANUAL");
for ($i=1;$i<=13;$i++)
{
	if ($mes == $i) $per = $periodo[$i];
}

printf("
<center>
<table border='1' width='1170' class='bordepunteado1'>
<tr >
<td bgcolor='#DCE9E5' align='center' width='150'><span class='Estilo41'>C�digo Rubro Presupuestal</span></td>
<td bgcolor='#DCE9E5' align='center' width='500'><span class='Estilo41'>Nombre Rubro Presupuestal</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Presupuesto Inicial</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Adiciones</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Adiciones acumuladas</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Reducciones</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Reducciones acumuladas</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Recaudos</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Recaudos acumulados</span></td>
<td bgcolor='#DCE9E5' align='center' width='130'><span class='Estilo41'>Periodo reportado</span></td>
</tr>
");
$sq = "SELECT cod_pptal, nom_rubro, ppto_aprob,cod_sia from car_ppto_ing where tip_dato='D' ORDER BY cod_pptal";
$re = mysql_db_query($database, $sq, $cx);
		while($rw = mysql_fetch_array($re))
		{
			if ($rw["cod_sia"] =='S' ||  $rw["cod_sia"] =='E' || $rw["cod_sia"] =='V' || $rw["cod_sia"] =='' || $rw["cod_sia"] =='T') $color = 'bgcolor=red';
			$cod_pptal=$rw["cod_pptal"];
// Datos para saldo inicial
			// Adiciones
			
			$sq11 = "SELECT SUM(valor_adi) as valor_adi from adi_ppto_ing where cod_pptal ='$cod_pptal' and fecha_adi < '$fecha_ini' and fecha_adi >='$fecha_vigencia'";
			  // Adiciones
			$re11 = mysql_db_query($database, $sq11, $cx);
			while($rw11 = mysql_fetch_array($re11))
			{
			$valor_adi_ini=$rw11["valor_adi"];
			if ($valor_adi_ini=='')
				{
				$valor_adi_ini=0;
				}
			}
			// Reducciones
			$sq12 = "SELECT SUM(valor_adi) as valor_adi from red_ppto_ing where cod_pptal ='$cod_pptal' and fecha_adi < '$fecha_ini' ";  // Reducciones
			$re12 = mysql_db_query($database, $sq12, $cx);
			while($rw12 = mysql_fetch_array($re12))
			{
			$valor_red_ini=$rw12["valor_adi"];
			if ($valor_red_ini=='')
				{
				$valor_red_ini=0;
				}
			}
			// Creditos en ingresos
			$sq13 = "SELECT SUM(valor_adi) as valor_adi from creditos_ing where cod_pptal ='$cod_pptal' and fecha_adi < '$fecha_ini' ";  // Creditos
			$re13 = mysql_db_query($database, $sq13, $cx);
			while($rw13= mysql_fetch_array($re13))
			{
			$valor_cred_ini=$rw13["valor_adi"];
			if ($valor_cred_ini=='')
				{
				$valor_cred_ini=0;
				}
			}
			// valor contracreditos
			$sq14 = "SELECT SUM(valor_adi) as valor_adi from contracreditos_ing where cod_pptal ='$cod_pptal' and fecha_adi < '$fecha_ini'";  // Contracreditos
			$re14 = mysql_db_query($database, $sq14, $cx);
			while($rw14 = mysql_fetch_array($re14))
			{
			$valor_ccred_ini=$rw14["valor_adi"];
			if ($valor_ccred_ini=='')
				{
				$valor_ccred_ini=0;
				}
			}
			
			$inicial =  $rw["ppto_aprob"] + $valor_adi_ini - $valor_red_ini + $valor_cred_ini - $valor_ccred_ini;
// Datos para movimiento...
			$sq3 = "SELECT SUM(valor_adi) as valor_adi from adi_ppto_ing where cod_pptal ='$cod_pptal' and fecha_adi BETWEEN '$fecha_ini' AND '$fecha_fin'";  // Adiciones
			$re3 = mysql_db_query($database, $sq3, $cx);
			$sq4 = "SELECT SUM(valor_adi) as valor_adi from red_ppto_ing where cod_pptal ='$cod_pptal' and fecha_adi BETWEEN '$fecha_ini' AND '$fecha_fin'";  // Reducciones
			$re4 = mysql_db_query($database, $sq4, $cx);
			$sq9 = "SELECT SUM(valor_adi) as valor_adi from creditos_ing where cod_pptal ='$cod_pptal' and fecha_adi BETWEEN '$fecha_ini' AND '$fecha_fin'";  // Creditos
			$re9 = mysql_db_query($database, $sq9, $cx);
			while($rw9 = mysql_fetch_array($re9))
			{
			$cred_adi=$rw9["valor_adi"];
			if ($cred_adi=='')
				{
				$cred_adi=0;
				}
			}
			$sq10 = "SELECT SUM(valor_adi) as valor_adi from contracreditos_ing where cod_pptal ='$cod_pptal' and fecha_adi BETWEEN '$fecha_ini' AND '$fecha_fin'";  // Contracreditos
			$re10 = mysql_db_query($database, $sq10, $cx);
			while($rw10 = mysql_fetch_array($re10))
			{
			$ccred_adi=$rw10["valor_adi"];
			if ($ccred_adi=='')
				{
				$ccred_adi=0;
				}
			}
			$sq5 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_ncbt where cuenta ='$cod_pptal' and fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re5 = mysql_db_query($database, $sq5, $cx);
				while($rw5 = mysql_fetch_array($re5))
				{
				$vr_digitado =$rw5["vr_digitado"];
				}
			$sq6 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_rcgt where cuenta ='$cod_pptal' and fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re6 = mysql_db_query($database, $sq6, $cx);
				while($rw6 = mysql_fetch_array($re6))
				{
				$vr_digitado =$rw6["vr_digitado"]+$vr_digitado;
				}
			$sq7 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_roit where cuenta ='$cod_pptal' and fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re7 = mysql_db_query($database, $sq7, $cx);
				while($rw7 = mysql_fetch_array($re7))
				{
				$vr_digitado =$rw7["vr_digitado"]+$vr_digitado;
				}	
			$sq8 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_tnat where cuenta ='$cod_pptal' and fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re8 = mysql_db_query($database, $sq8, $cx);
			while($rw8 = mysql_fetch_array($re8))
				{
				$vr_digitado =$rw8["vr_digitado"]+$vr_digitado;
				}
if ($empresa =='MUNICIPIO DE IPIALES')
{			
			$sq9 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_rica where cuenta ='$cod_pptal' and fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re9 = mysql_db_query($database, $sq9, $cx);
			while($rw9 = mysql_fetch_array($re9))
				{
				$vr_digitado =$rw9["vr_digitado"]+$vr_digitado;
				}
			$sq91 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_rica1 where cuenta ='$cod_pptal' and fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re91 = mysql_db_query($database, $sq91, $cx);
			while($rw91 = mysql_fetch_array($re91))
				{
				$vr_digitado =$rw91["vr_digitado"]+$vr_digitado;
				}
			$sq92 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_rica2 where cuenta ='$cod_pptal' and fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re92 = mysql_db_query($database, $sq92, $cx);
			while($rw92 = mysql_fetch_array($re92))
				{
				$vr_digitado =$rw92["vr_digitado"]+$vr_digitado;
				}
			$sq10 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_riip where cuenta ='$cod_pptal' and fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re10 = mysql_db_query($database, $sq10, $cx);
			while($rw10 = mysql_fetch_array($re10))
				{
				$vr_digitado =$rw10["vr_digitado"]+$vr_digitado;
				}
			$sq11 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_riur where cuenta ='$cod_pptal' and fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re11 = mysql_db_query($database, $sq11, $cx);
			while($rw11 = mysql_fetch_array($re11))
				{
				$vr_digitado =$rw11["vr_digitado"]+$vr_digitado;
				}
			$sq12 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_rtic where cuenta ='$cod_pptal' and fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin'";
			$re12 = mysql_db_query($database, $sq12, $cx);
			while($rw12 = mysql_fetch_array($re12))
				{
				$vr_digitado =$rw12["vr_digitado"]+$vr_digitado;
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
			
			
// datos para valor acumulado *********************************************************************
			
			$sq5 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_ncbt where cuenta ='$cod_pptal' and fecha_recaudo <= '$fecha_fin'";
			$re5 = mysql_db_query($database, $sq5, $cx);
				while($rw5 = mysql_fetch_array($re5))
				{
				$vr_digitado2 =$rw5["vr_digitado"];
				}
			$sq6 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_rcgt where cuenta ='$cod_pptal' and fecha_recaudo <= '$fecha_fin'";
			$re6 = mysql_db_query($database, $sq6, $cx);
				while($rw6 = mysql_fetch_array($re6))
				{
				$vr_digitado2 =$rw6["vr_digitado"]+$vr_digitado2;
				}
			$sq7 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_roit where cuenta ='$cod_pptal' and fecha_recaudo <= '$fecha_fin'";
			$re7 = mysql_db_query($database, $sq7, $cx);
				while($rw7 = mysql_fetch_array($re7))
				{
				$vr_digitado2 =$rw7["vr_digitado"]+$vr_digitado2;
				}	
			$sq8 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_tnat where cuenta ='$cod_pptal' and fecha_recaudo <= '$fecha_fin'";
			$re8 = mysql_db_query($database, $sq8, $cx);
			while($rw8 = mysql_fetch_array($re8))
				{
				$vr_digitado2 =$rw8["vr_digitado"]+$vr_digitado2;
				}
if ($empresa =='MUNICIPIO DE IPIALES')
{			
			
			$sq9 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_rica where cuenta ='$cod_pptal' and fecha_recaudo <= '$fecha_fin'";
			$re9 = mysql_db_query($database, $sq9, $cx);
			while($rw9 = mysql_fetch_array($re9))
				{
				$vr_digitado2 =$rw9["vr_digitado"]+$vr_digitado2;
				}
			$sq91 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_rica1 where cuenta ='$cod_pptal' and fecha_recaudo <= '$fecha_fin'";
			$re91 = mysql_db_query($database, $sq91, $cx);
			while($rw91 = mysql_fetch_array($re91))
				{
				$vr_digitado2 =$rw91["vr_digitado"]+$vr_digitado2;
				}
			$sq92 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_rica2 where cuenta ='$cod_pptal' and fecha_recaudo <= '$fecha_fin'";
			$re92 = mysql_db_query($database, $sq92, $cx);
			while($rw92 = mysql_fetch_array($re92))
				{
				$vr_digitado2 =$rw92["vr_digitado"]+$vr_digitado2;
				}
			$sq10 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_riip where cuenta ='$cod_pptal' and fecha_recaudo <= '$fecha_fin'";
			$re10 = mysql_db_query($database, $sq10, $cx);
			while($rw10 = mysql_fetch_array($re10))
				{
				$vr_digitado2 =$rw10["vr_digitado"]+$vr_digitado2;
				}
			$sq11 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_riur where cuenta ='$cod_pptal' and fecha_recaudo <= '$fecha_fin'";
			$re11 = mysql_db_query($database, $sq11, $cx);
			while($rw11 = mysql_fetch_array($re11))
				{
				$vr_digitado2 =$rw11["vr_digitado"]+$vr_digitado2;
				}
			$sq12 = "SELECT SUM(vr_digitado) as vr_digitado from recaudo_rtic where cuenta ='$cod_pptal' and fecha_recaudo <= '$fecha_fin'";
			$re12 = mysql_db_query($database, $sq12, $cx);
			while($rw12 = mysql_fetch_array($re12))
				{
				$vr_digitado2 =$rw12["vr_digitado"]+$vr_digitado2;
				}
}
// ************************************************************************* fin acumulados
		
			
			$adi_acum = $valor_adi_ini + $valor_adi + $valor_cred_ini+$cred_adi;
			$red_acum = $valor_red_ini + $valor_adi4 + $valor_ccred_ini + $ccred_adi;
			$suma = $inicial+ $valor_adi + $cred_adi + $valor_adi4 + $ccred_adi + $vr_digitado + $adi_acum + $red_acum + $vr_digitado2 ;
			
			if ($suma >0)
			{
				printf("
				<span class='Estilo4'>
				<tr $color>
				<td align='left' class='text'><span>%s </span></td>
				<td align='left'><span class='Estilo4'> %s </span></td>
				<td align='right'> %.2f </td>
				<td align='right'> %.2f </td>
				<td align='right'> %.2f </td>
				<td align='right'> %.2f </td>
				<td align='right'> %.2f </td>
				<td align='right'> %.2f </td>
				<td align='right'> %.2f  </td>
				<td align='right'> %s </td>
					</tr>", $rw["cod_sia"].$rw["cod_pptal"], ucfirst($rw["nom_rubro"]), $inicial, $valor_adi + $cred_adi,$adi_acum,$valor_adi4 + $ccred_adi,$red_acum, $vr_digitado,$vr_digitado2,$per); 
			}
		$color='';
		}
printf("</table></center>");
?>
</body>
</html>
<?
}
?>
