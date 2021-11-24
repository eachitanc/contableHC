<?
set_time_limit(1800);
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$_POST[tipo].xls");
header("Pragma: no-cache");
header("Expires: 0"); 
include("../config.php");
// Selleccion datos generales para los encabezados.
$cx = new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database, $cx);
$rea =mysql_db_query($database,"select * from fut_aux_gasf",$cx);
$rwa =mysql_fetch_array($rea);
$fecha = $rwa["fecha"];
$reb =mysql_db_query($database,"select * from empresa",$cx);
$rwb =mysql_fetch_array($reb);
$cod_cgn = $rwb["cod_cgn"];
$fecha2 = explode("/", $fecha);
$anno = $fecha2[0];
$periodo = $fecha2[1];
if ($periodo =='03') $periodo2 ='10103';
if ($periodo =='06') $periodo2 ='10406';
if ($periodo =='09') $periodo2 ='10709';
if ($periodo =='12') $periodo2 ='11012';

$tipo=$_POST['tipo'];

if($tipo == 'RESERVAS')
{
		printf("
		<table  border='1'>
		<tr>
		<td align='center'>S</td>
		<td align='center'>$cod_cgn</td>
		<td align='center'>$periodo2</td>
		<td align='center'>$anno</td>
		<td align='center'>GASTOS_DE_INVERSION</td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		</tr>
		");	
		$sql = "SELECT ctrl,cod_ser_deuda,fuente_rec,tip_acto_adtvo,num_acto_adtvo,fecha_acto_adtvo,sum(definitivo),sum(obligado),sum(pagado) from fut_aux_gasf_ok group by cod_ser_deuda";
		$res = mysql_db_query($database,$sql, $cx) or die(mysql_error());
		while($rw = mysql_fetch_array($res)) 
		{ 
		printf("
		<tr>
		<td align='center'>%s</td>
		<td align='left'>%s</td>
		<td align='center'>%s</td>
		<td align='center'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		</tr>
		",'D',$rw["cod_ser_deuda"],$rw["fuente_rec"],$rw["tip_acto_adtvo"], $rw["num_acto_adtvo"],$rw["fecha_acto_adtvo"],$rw["sum(definitivo)"], $rw["sum(obligado)"], $rw["sum(pagado)"]); 
	}  
	printf("</table>");
}
if($tipo == 'INVERSION')
{
	printf("
	<table  border='1'>
	<tr>
	<td align='center'>S</td>
	<td align='center'>$cod_cgn</td>
	<td align='center'>$periodo2</td>
	<td align='center'>$anno</td>
	<td align='center'>GASTOS_DE_INVERSION</td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	</tr>
	");	
	$sql = "SELECT ctrl,cod_fut,fuente_rec,sum(ppto_aprob),sum(definitivo),sum(compromisos),sum(obligado),sum(pagado) FROM fut_aux_gasf_ok where proc_rec != 'R' group by cod_fut,fuente_rec ";
	$res = mysql_db_query($database,$sql,$cx) or die(mysql_error());
	$sum=0;
	while($rw = mysql_fetch_array($res)) 
	{ 
		if ($rw["cod_fut"] !='')
		{
		$sum = $rw["sum(ppto_aprob)"]+$rw["sum(definitivo)"]+$rw["sum(compromisos)"]+ $rw["sum(obligado)"]+ $rw["sum(pagado)"];
		if ($sum >0)
		{
		printf("
		<tr>
		<td align='center'>%s</td>
		<td align='left'>%s</td>
		<td align='center'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		</tr>
		",'D',$rw["cod_fut"],$rw["fuente_rec"], $rw["sum(ppto_aprob)"],$rw["sum(definitivo)"],$rw["sum(compromisos)"], $rw["sum(obligado)"], $rw["sum(pagado)"]);
		$total_apr = $total_apr + $rw["sum(ppto_aprob)"];
		$total_def = $total_def + $rw["sum(definitivo)"];
		$total_com = $total_com + $rw["sum(compromisos)"];
		$total_obl= $total_obl + $rw["sum(obligado)"];
		$total_pag = $total_pag + $rw["sum(pagado)"];
		}
		}
	} 
	printf("
		<tr>
		<td align='center'>%s</td>
		<td align='left'>%s</td>
		<td align='center'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		</tr>
		",'D','VAL',700,$total_apr,$total_def,$total_com,$total_obl, $total_pag);
	
	 
	printf("</table>");
}
// Consulta para funcionamiento
if($tipo == 'FUNCIONAMIENTO')
{
	printf("
	<table  border='1'>
	<tr>
	<td align='center'>S</td>
	<td align='center'>$cod_cgn</td>
	<td align='center'>$periodo2</td>
	<td align='center'>$anno</td>
	<td align='center'>GASTOS_FUNCIONAMIENTO</td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	</tr>
	");	
	$sql = "SELECT ctrl,cod_fut,ent_eje,fuente_rec,sum(ppto_aprob),sum(definitivo),sum(compromisos),sum(obligado),sum(pagado) FROM fut_aux_gasf_ok group by cod_fut,ent_eje,fuente_rec";
	$res = mysql_db_query($database,$sql,$cx) or die(mysql_error());
	
	while($rw = mysql_fetch_array($res)) 
	{ 
		$suma = $rw["sum(ppto_aprob)"] + $rw["sum(definitivo)"] + $rw["sum(compromisos)"] + $rw["sum(obligado)"] + $rw["sum(pagado)"];
		if ($suma >0)
		{
		printf("
		<tr>
		<td align='center'>%s</td>
		<td align='left'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		</tr>
		",'D',$rw["cod_fut"],$rw["ent_eje"],$rw["fuente_rec"], $rw["sum(ppto_aprob)"],$rw["sum(definitivo)"],$rw["sum(compromisos)"], $rw["sum(obligado)"], $rw["sum(pagado)"]); 
		}  
	}
	printf("</table>");
}
if($tipo == 'REGALIAS')
{
	printf("
	<table  border='1'>
	<tr>
	<td align='center'>S</td>
	<td align='center'>$cod_cgn</td>
	<td align='center'>$periodo2</td>
	<td align='center'>$anno</td>
	<td align='center'>EJECUCION_GASTOS_SGR</td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	</tr>
	");	
	$sql = "SELECT ctrl,cod_fut,fuente_rec,ent_eje,cod_ser_deuda,sum(ppto_aprob),sum(definitivo),sum(compromisos),sum(obligado),sum(pagado) FROM fut_aux_gasf_ok where proc_rec = 'R' group by cod_fut,fuente_rec,ent_eje,cod_ser_deuda ";
	$res = mysql_db_query($database,$sql,$cx) or die(mysql_error());
	while($rw = mysql_fetch_array($res)) 
	{ 
		if ($rw["cod_fut"] !='')
		{
		if ($rw["sum(definitivo)"]>0)
		{
		printf("
		<tr>
		<td align='center'>%s</td>
		<td align='left'>%s</td>
		<td align='center'>BPIN</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='left'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='center'>%s</td>
		<td align='center'>%s</td>
		</tr>
		",'D',$rw["cod_fut"],$rw["fuente_rec"],$rw['ent_eje'], $rw['cod_ser_deuda'],$rw["sum(definitivo)"],$rw["sum(compromisos)"], $rw["sum(obligado)"], $rw["sum(pagado)"]);
		$total_apr = $total_apr + $rw["sum(ppto_aprob)"];
		$total_def = $total_def + $rw["sum(definitivo)"];
		$total_com = $total_com + $rw["sum(compromisos)"];
		$total_obl= $total_obl + $rw["sum(obligado)"];
		$total_pag = $total_pag + $rw["sum(pagado)"];
		}
		}
	} 
	printf("
		<tr>
		<td align='center'>%s</td>
		<td align='left'>%s</td>
		<td align='center'>NA</td>
		<td align='right'>%s</td>
		<td align='right'>300</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='right'>%s</td>
		<td align='center'>%s</td>
		<td align='center'>%s</td>
		</tr>
		",'D','VAL',300,'NA',$total_def,$total_com,$total_obl, $total_pag);
	
	 
	printf("</table>");
}
?>