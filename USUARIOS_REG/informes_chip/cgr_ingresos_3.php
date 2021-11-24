<?
set_time_limit(3600);
$tipo=$_POST['tipo'];
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CGR_INGRESOS_$tipo.xls");
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
.alinear
	{
	text-align:inherit;
	}
</style>
</head>
<body>
<?
include("../config.php");

$cx = new mysqli($server, $dbuser, $dbpass, $database);
$reb =mysql_db_query($database,"select * from empresa",$cx);
$rwb =mysql_fetch_array($reb);
$cod_cgn = $rwb["cod_cgn"];
$rea =mysql_db_query($database,"select * from cgr_aux_ing",$cx);
$rwa =mysql_fetch_array($rea);
$fecha = $rwa["fecha"];
$fecha2 = explode("/", $fecha);
$anno = $fecha2[0];
$periodo = $fecha2[1];
if ($periodo =='03') $periodo2 ='10103';
if ($periodo =='06') $periodo2 ='10406';
if ($periodo =='09') $periodo2 ='10709';
if ($periodo =='12') $periodo2 ='11012';
if($tipo == 'PROG')
{
	printf("
	<center>
	<table width='1500' BORDER='1'>
	<tr>
	<td align='center'>$cod_cgn</td>
	<td align='center'>$periodo2</td>
	<td align='center'>$anno</td>
	<td>PROGRAMACIONDEINGRESOS</td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	</tr>
	<tr>
	<td align='center' bgcolor='#CCCCCC'>CONCEPTO</td>
	<td align='center' bgcolor='#CCCCCC'>CODIGO RECURSOS</td>
	<td align='center' bgcolor='#CCCCCC'>ORIGEN ESPECIFICO</td>
	<td align='center' bgcolor='#CCCCCC'>DESTINACION RECURSO</td>
	<td align='center' bgcolor='#CCCCCC'>SITUACION DE FONDOS</td>
	<td align='center' bgcolor='#CCCCCC'>ACTO ADMIN</td>
	<td align='center' bgcolor='#CCCCCC'>INICIAL</td>
	<td align='center' bgcolor='#CCCCCC'>ADICIONES</td>
	<td align='center' bgcolor='#CCCCCC'>REDUCIONES</td>
	<td align='center' bgcolor='#CCCCCC'>CREDITOS</td>
	<td align='center' bgcolor='#CCCCCC'>CONTRACREDITOS</td>
	<td align='center' bgcolor='#CCCCCC'>APLAAMIENTOS</td>
	<td align='center' bgcolor='#CCCCCC'>DESAPLAZAMIENTOS</td>
	<td align='center' bgcolor='#CCCCCC'>DEFINITIVO</td>
	</tr>
	
	");

$queEmp = "
SELECT 
cod_cgr,
rec,
oer,
cda,
sit_fondos,
if (acto = '', 'NA' , acto) as acto,
sum(inicial),
sum(adiciones),
sum(reducciones),
sum(creditos),
sum(contracreditos),
(sum(inicial)+sum(adiciones)-sum(reducciones)+sum(creditos)-sum(contracreditos)) as definitivo

FROM cgr_aux_ing group by cod_cgr,rec,oer,cda,acto,sit_fondos";
$resEmp = mysql_query($queEmp, $cx) or die(mysql_error());

while($datatmp = mysql_fetch_array($resEmp)) 
{ 
	$inicial = $datatmp['sum(inicial)'];
	$adiciones = $datatmp['sum(adiciones)'];
	$reducciones = $datatmp['sum(reducciones)'];
	$creditos = $datatmp['sum(creditos)'];
	$ccreditos = $datatmp['sum(contracreditos)'];
	$definitivo = $datatmp['definitivo'];
	$suma = $inicial + $adiciones + $reducciones + $creditos + $ccreditos + $aplazamientos + $desaplazamientos;
	$sit =$datatmp['sit_fondos'];
	if($sit=='C') $sit2=1;
	if($sit=='S') $sit2=2;
	if ($suma !=0)
	{
		echo "
		<tr>
		<td align='left'>$datatmp[cod_cgr]</td>
		<td align='center' class='text'>$datatmp[rec]</td>
		<td align='center' class='text'>$datatmp[oer]</td>
		<td align='center' class='text'>$datatmp[cda]</td>
		<td align='center'>$sit2</td>
		<td align='center' bgcolor='#CCCCCC'>$datatmp[acto]</td>
		<td align='right'>$inicial</td>
		<td align='right'>$adiciones</td>
		<td align='right'>$reducciones</td>
		<td align='right'>$creditos</td>
		<td align='right'>$ccreditos</td>
		<td align='right'>0</td>
		<td align='right'>0</td>
		<td align='right'>$definitivo</td>
		</tr>
		
		";
	}
} // end while 

} // end if prog 

// ***************************************************   EJECUCION DE INGRESOS ****************************************************

if($tipo == 'EJEC')
{
	printf("
	<center>
	<table width='1500' BORDER='1'>
	<tr>
	<td align='center'>$cod_cgn</td>
	<td align='center'>$periodo2</td>
	<td align='center'>$anno</td>
	<td>EJECUCIONDEINGRESOS</td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	<td align='center'></td>
	</tr>
	<tr>
	<td align='center' bgcolor='#CCCCCC'>CONCEPTO</td>
	<td align='center' bgcolor='#CCCCCC'>CODIGO RECURSOS</td>
	<td align='center' bgcolor='#CCCCCC'>ORIGEN ESPECIFICO</td>
	<td align='center' bgcolor='#CCCCCC'>DESTINACION RECURSO</td>
	<td align='center' bgcolor='#CCCCCC'>SITUACION DE FONDOS</td>
	<td align='center' bgcolor='#CCCCCC'>No REGISTROS</td>
	<td align='center' bgcolor='#CCCCCC'>ENTIDAD RECIPROCA</td>
	<td align='center' bgcolor='#CCCCCC'>ACTO ADMIN</td>
	<td align='center' bgcolor='#CCCCCC'>RECAUDOS</td>
	<td align='center' bgcolor='#CCCCCC'>DEVOLUCIONES</td>
	<td align='center' bgcolor='#CCCCCC'>REVERSION RECAUDOS</td>
	<td align='center' bgcolor='#CCCCCC'>OTROS INGRESOS (ESE)</td>
	<td align='center' bgcolor='#CCCCCC'>REV OTROS ING (ESE)</td>
	<td align='center' bgcolor='#CCCCCC'>RECAUDOS VA</td>
	<td align='center' bgcolor='#CCCCCC'>REVERSION REC VA</td>
	</tr>
	");

$queEmp = "SELECT
    cod_cgr
    , rec
    , oer
    , cda
	, sit_fondos
    , SUM(registros) as registros
    , recip
    , if (acto = '', 'NA' , acto) as acto
    , SUM(recaudos) as recaudos
FROM
    cgr_aux_ing
GROUP BY cod_cgr, rec, oer, cda, sit_fondos, recip, acto
HAVING (SUM(recaudos) >0)
";
$resEmp = mysql_query($queEmp, $cx) or die(mysql_error());
while($datatmp = mysql_fetch_array($resEmp)) 
{ 
	$recaudos = $datatmp['recaudos'];
	$registros = $datatmp['registros'];
	$devoluciones = 0;
	$reversion_recaudos = 0;
	$recaudos_vig_anteriores =0;
	$reversion_recaudos_vig_anteriores = 0;
	
	$sit3 =$datatmp['sit_fondos'];
	if($sit3=='C') $sit4=1;
	if($sit3=='S') $sit4=2;
	echo "
		<tr>
		<td align='left'>$datatmp[cod_cgr]</td>
		<td align='center' class='text'>$datatmp[rec]</td>
		<td align='center' class='text'>$datatmp[oer]</td>
		<td align='center' class='text'>$datatmp[cda]</td>
		<td align='center'>$sit4</td>
		<td align='center'>$registros</td>
		<td align='left' class='text'>$datatmp[recip]</td>
		<td align='center'  bgcolor='#CCCCCC'>$datatmp[acto]</td>
		<td align='right'>$recaudos</td>
		<td align='right'>$devoluciones</td>
		<td align='right'>$reversion_recaudos</td>
		<td align='right'  bgcolor='#FF9900'>0</td>
		<td align='right'  bgcolor='#FF9900'>0</td>
		<td align='right'>$recaudos_vig_anteriores</td>
		<td align='right'>$reversion_recaudos_vig_anteriores</td>
		</tr>
		
		";
} // end while 

} // end if ejec


