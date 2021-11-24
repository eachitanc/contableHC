<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201101_F03A_10_CDN.xls");
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
 $i=0;
include('../config.php');
$base=$database;
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlv = mysql_db_query($database,"select * from vf",$cx);

while ($rwv = mysql_fetch_array($sqlv))
	{
		$fecha_ini = $rwv["fecha_ini"];
	} 
function esBisiesto($year=NULL) {
    return checkdate(2, 29, ($year==NULL)? date('Y'):$year); // devolvemos true si es bisiesto
}


	$cod2 = explode("/", $fecha_ini);
	$anno = $cod2[0]; 
$bis = esBisiesto($anno); 
if ($bis==1) $dias = array('31','29','31','30','31','30','31','31','30','31','30','31'); else $dias = array('31','28','31','30','31','30','31','31','30','31','30','31');
	$periodo = array ("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
	$mes =array('01','02','03','04','05','06','07','08','09','10','11','12');
		printf("
		<center>
		<table BORDER='1' class='bordepunteado1'  width='1625'>
		<tr>
		<td  bgcolor='DCE9E5' align='center' width='100'><span class='Estilo41'>C�digo Contable</span></td>
		<td  bgcolor='DCE9E5' align='center' width='50'><span class='Estilo41'>Banco</span></td>
		<td  bgcolor='DCE9E5' align='center' width='100'><span class='Estilo41'>No. De Cuenta</span></td>
		<td  bgcolor='DCE9E5' align='center' width='140'><span class='Estilo41'>Denominaci�n</span></td>
		<td  bgcolor='DCE9E5' align='center' width='100'><span class='Estilo41'>Fuente De Financiaci�n</span></td>
		<td  bgcolor='DCE9E5' align='center' width='100'><span class='Estilo41'>Mes</span></td>
		<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Saldo Inicial Libros</span></td>
		<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Saldo Inicial Extracto</span></td>
		<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Ingresos</span></td>
		<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Egresos</span></td>
		<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Notas Debito</span></td>
		<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Notas Credito</span></td>
		<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Saldo Final Libros</span></td>
		<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Saldo Final Extracto Bancario</span></td>
		<td  bgcolor='cccccc' align='center' width='115'><span class='Estilo41'>Saldo Conciliado</span></td>
		<td  bgcolor='cccccc' align='center' width='115'><span class='Estilo41'>Validado</span></td>
		</tr>
		");
$mes2 = $_GET['mes']- 1;
for ($i=0;$i<12;$i++)
{
	$sq = "select * from  pgcp where (cod_pptal like '1110%' or cod_pptal like '1132%') and tip_dato='D' order by cod_pptal asc ";
	//$sq = "select * from  pgcp where (cod_pptal like '190101%') and tip_dato='D' order by cod_pptal asc ";
	$re = mysql_db_query($database, $sq, $cx);
	$fini_mes = $anno."/".$mes[$i]."/01"; 
	$ffin_mes = $anno."/".$mes[$i]."/".$dias[$i]; 
	$fmes_ant = $anno."/".$mes[$i-1]."/".$dias[$i-1]; 
	while ($rw1 = mysql_fetch_array($re))
	{
	$cuenta =$rw1["cod_pptal"];
	// consultar el saldo en libros segun la fecha de corte
		$ss22a = "select * from sico where cuenta = '$cuenta'";
		$re21 = mysql_db_query($database, $ss22a, $cx);
		$re21x = mysql_num_rows($re21);
		if ($re21x =='1')
		{
		while($rw21 = mysql_fetch_array($re21)) 
			{
			  $sico=$rw21["debito"];
			}
		}else{
		$sico =0;
		}
		$s22 = "select SUM(debito) as tot_debito, SUM(credito) as tot_creditos from lib_aux where cuenta = '$cuenta' and fecha < '$fini_mes'"; // fechaini 
		$re22 = mysql_db_query($database, $s22, $cx);
		while($rw22 = mysql_fetch_array($re22)) 
		{
		  $debitos=$rw22["tot_debito"];
		  $creditos=$rw22["tot_creditos"]; 
		}
		$saldo_ini = $sico + $debitos - $creditos;
		if ($saldo_ini =='') $saldo_ini=0;
		//suma de movimientos del mes para establecer saldo final
		$sq2 = "select SUM(debito) as tot_debito, SUM(credito) as tot_creditos from lib_aux where cuenta = '$cuenta' and fecha <= '$ffin_mes'"; // fechaini 
		$re2 = mysql_db_query($database, $sq2, $cx);
		while($rw2 = mysql_fetch_array($re2)) 
		{
		  $debitosf=$rw2["tot_debito"];
		  $creditosf=$rw2["tot_creditos"]; 
		}
		$saldo_fin = $sico + $debitosf - $creditosf;
		if ($saldo_fin =='') $saldo_fin=0;
		// Sumo ingresos del mes
		$sq3 = "select SUM(debito) as ingresos from lib_aux where cuenta = '$cuenta' and (fecha BETWEEN '$fini_mes' and '$ffin_mes') and (dcto like 'NCBT%'  or dcto like 'ROIT%' OR dcto like 'TNAT%' or dcto like 'RCGT%' or dcto like 'COBA%' or dcto like 'CEVA%' or dcto like 'RIIP%' or dcto like 'RIUR%' or dcto like 'RTIC%' or dcto like 'RICA%' or dcto like 'REIN%' or dcto like 'IPU%' or dcto like 'RC%' or dcto like 'NCSF%' or dcto like 'CESP%' or dcto like 'NDSP%')";
		$re3 = mysql_db_query($database, $sq3, $cx);
		while($rw3 = mysql_fetch_array($re3)) 
		{
			$ingresos=$rw3["ingresos"];
		}
		if ($ingresos =='') $ingresos=0;
		$sq4 = "select SUM(credito) as egresos from lib_aux where cuenta = '$cuenta' and (fecha BETWEEN '$fini_mes' and '$ffin_mes') and (dcto like 'CESP%'  or dcto like 'CEVA%' or dcto like 'CECP%')";
		$re4 = mysql_db_query($database, $sq4, $cx);
		while($rw4 = mysql_fetch_array($re4)) 
		{
			$egresos=$rw4["egresos"];
		}
		if ($egresos =='') $egresos=0;
		//sumo las notas credito
		$sq5 = "select SUM(debito) as ncreditos from lib_aux where cuenta = '$cuenta' and (fecha BETWEEN '$fini_mes' and '$ffin_mes') and (dcto like 'NCON%' or dcto like 'NCSP%' or dcto like 'TFIN%')";
		$re5 = mysql_db_query($database, $sq5, $cx);
		while($rw5 = mysql_fetch_array($re5)) 
		{
			$n_cred=$rw5["ncreditos"];
		}
		if ($n_cred =='') $n_cred=0;
		//Sumo notas debito
		$sq6 = "select SUM(credito) as ndebito from lib_aux where cuenta = '$cuenta' and (fecha BETWEEN '$fini_mes' and '$ffin_mes') and (dcto like 'NDSP%' or dcto like 'NCON%' OR dcto LIKE 'TFIN%')";
		$re6 = mysql_db_query($database, $sq6, $cx);
		while($rw6 = mysql_fetch_array($re6)) 
		{
			$n_deb=$rw6["ndebito"];
		}
		if ($n_deb =='') $n_deb=0;
		// Consulto saldo en extractos
		$re7 = mysql_db_query ($database,"select saldo_extracto from aux_conciliaciones2 where cuenta ='$cuenta' and fecha_fin ='$ffin_mes'",$cx);
		$rw7 = mysql_fetch_array($re7);
		// Consulto saldo en extractos
		$re8 = mysql_db_query ($database,"select saldo_extracto from aux_conciliaciones2 where cuenta ='$cuenta' and fecha_fin ='$fmes_ant'",$cx);
		$rw8 = mysql_fetch_array($re8);
	if($saldo_ini == 0 && $rw8["saldo_extracto"] ==0 && $ingresos == 0 && $egresos ==0 && $n_deb ==0 && $n_cred ==0  && $saldo_fin == 0)
	{
	}else{
	if ($rw1["cod_sia"] =='') {$fondo1 ="bgcolor='#ffff66'";}else{$fondo1='';}
	if ($rw1["num_cta"] =='') {$fondo2 ="bgcolor='#ffff66'";}else{$fondo2='';}
	if ($rw1["nom_banco1"] =='') {$fondo3 ="bgcolor='#ffff66'";}else{$fondo3='';}
	if ($rw1["fuentes_recursos"] =='') {$fondo4 ="bgcolor='#ffff66'";}else{$fondo4='';}
	if ($rw8["saldo_extracto"] =='') {$fondo5 ="bgcolor='#ffff66'"; $rw8["saldo_extracto"]="Complementar con el extracto";}else{$fondo5=''; }
	
	$saldo_conciliado = $saldo_fin - $rw7["saldo_extracto"];
	$val=0;
	$val = round(($saldo_ini + $ingresos -$egresos - $n_deb + $n_cred - $saldo_fin),2);
	$movi= $ingresos -$egresos - $n_deb + $n_cred;
	if ($movi ==0) {$rw8["saldo_extracto"] =$saldo_ini; $rw7["saldo_extracto"] = $saldo_fin;}
	if ($val ==0)  {$fondo6= "bgcolor='cccccc'"; $mensaje ="Ok"; }else{$fondo6="bgcolor='red'"; $mensaje ="Error";} 
	if ($mes2 == $i)
		{
	printf ("	<tr>
		<td align='center'> %s </td>
		<td align='center' $fondo1> %s </td>
		<td align='center' $fondo2> %s </td>
		<td align='center' $fondo3> %s </td>
		<td align='center' $fondo4> %s </td>
		<td align='center'> %s </td>
		<td align='right'> %s </td>
		<td align='right' $fondo5> %s </td>
		<td align='right'> %s </td>
		<td align='right'> %s </td>
		<td align='right'> %s </td>
		<td align='right'> %s </td>
		<td align='right'> %s </td>
		<td align='right'> %s </td>
		<td align='right' bgcolor='cccccc'> %s </td>
		<td align='center' $fondo6> %s </td>
		</tr>",$rw1["cod_pptal"], $rw1["cod_sia"],$rw1["num_cta"],$rw1["nom_banco1"],$rw1["fuentes_recursos"],$periodo[$i],$saldo_ini,$rw8["saldo_extracto"],$ingresos,$egresos,$n_deb,$n_cred,$saldo_fin,$rw7["saldo_extracto"],$saldo_fin, $mensaje);
	}
		if ($mes2 == 12)
	{
	printf ("	<tr>
		<td align='center'> %s </td>
		<td align='center' $fondo1> %s </td>
		<td align='center' $fondo2> %s </td>
		<td align='center' $fondo3> %s </td>
		<td align='center' $fondo4> %s </td>
		<td align='center'> %s </td>
		<td align='right'> %s </td>
		<td align='right' $fondo5> %s </td>
		<td align='right'> %s </td>
		<td align='right'> %s </td>
		<td align='right'> %s </td>
		<td align='right'> %s </td>
		<td align='right'> %s </td>
		<td align='right'> %s </td>
		<td align='right' bgcolor='cccccc'> %s </td>
		<td align='center' $fondo6> %s </td>
		</tr>",$rw1["cod_pptal"], $rw1["cod_sia"],$rw1["num_cta"],$rw1["nom_banco1"],$rw1["fuentes_recursos"],$periodo[$i],$saldo_ini,$rw8["saldo_extracto"],$ingresos,$egresos,$n_deb,$n_cred,$saldo_fin,$rw7["saldo_extracto"],$saldo_fin, $mensaje);
	}

	}
	} // Fin while 
}// fin for
printf("</table></center>");
}
?>

