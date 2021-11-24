<?
set_time_limit(7200);
$tipo2=$_GET['tipo'];
$archivo = $_GET['archivo'];
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$archivo.xls");
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

$conEmp = new mysqli($server, $dbuser, $dbpass, $database);
$reb =mysql_db_query($database,"select * from empresa",$conEmp);
$rwb =mysql_fetch_array($reb);
$cod_cgn = $rwb["cod_cgn"];
//mysql_select_db($database, $conEmp);
$rea =mysql_db_query($database,"select * from cgr_aux_gas",$conEmp);
$rwa =mysql_fetch_array($rea);
$fecha = $rwa["fecha"];
$fecha2 = explode("/", $fecha);
$anno = $fecha2[0];
$periodo = $fecha2[1];
if ($periodo =='03') $periodo2 ='10103';
if ($periodo =='06') $periodo2 ='10406';
if ($periodo =='09') $periodo2 ='10709';
if ($periodo =='12') $periodo2 ='11012';
$vig = explode("_", $tipo2);
$tipo = $vig[0];
$vigencia=  $vig[1];
if ($vigencia =='1') $titulo ='ACTUAL';
if ($vigencia =='2') $titulo ='RESERVA';
if ($vigencia =='4') $titulo ='VIGENCIA FUTURA';
if ($vigencia =='3') $titulo ='CUENTAS POR PAGAR';
if($tipo == 'PROG')
{
	printf("
	<center>
	<table width='1500' BORDER='1'>
	<tr>
	<td align='center'>PROGRAMACION DE GASTOS $titulo - $archivo</td>
	<td align='center'></td>
	<td align='center'></td>
	<td></td>
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
	<td align='center'></td>
	</tr>
	<tr>
	<td align='center' bgcolor='#CCCCCC'>CONCEPTOS</td>
	<td align='center' bgcolor='#CCCCCC'>DEPENDENCIA</td>
	<td align='center' bgcolor='#CCCCCC'>RECURSOS</td>
	<td bgcolor='#CCCCCC'>ORIEGEN</td>
	<td align='center' bgcolor='#CCCCCC'>DESTINACION</td>
	<td align='center' bgcolor='#CCCCCC'>FINALIDAD</td>
	<td align='center' bgcolor='#CCCCCC'>INICIAL</td>
	<td align='center' bgcolor='#CCCCCC'>ADICIONES</td>
	<td align='center' bgcolor='#CCCCCC'>REDUCIONES</td>
	<td align='center' bgcolor='#CCCCCC'>CREDITOS</td>
	<td align='center' bgcolor='#CCCCCC'>CONTRACREDITOS</td>
	<td align='center' bgcolor='#CCCCCC'>APLAAMIENTOS</td>
	<td align='center' bgcolor='#CCCCCC'>DESAPLAZAMIENTOS</td>
	<td align='center' bgcolor='#CCCCCC'>DEFINITIVO</td>
	<td align='center' bgcolor='#CCCCCC'>CDPS</td>
	<td align='center' bgcolor='#CCCCCC'>REVERSION CDPS</td>
	</tr>
	
	");
	$queEmp = "
	SELECT 
	ctrl,
	cod_cgr,
	vig_gasto,
	cod_rec,
	oer,
	cda,
	unidad_ejec,
	finalidad_gasto,
	sum(ppto_aprob) ,
	sum(sum_adiciones) ,
	sum(sum_reducciones) ,
	sum(cancelaciones) ,
	sum(sum_creditos) ,
	sum(sum_contracreditos) ,
	sum(sum_aplazamientos) ,
	sum(sum_desaplazamientos) ,
	(sum(ppto_aprob)+sum(sum_adiciones)-sum(sum_reducciones)+sum(sum_creditos)-sum(sum_contracreditos)) as definitivo ,
	sum(suma_cdpp) ,
	sum(reversion_cdpp)
	FROM cgr_aux_gas_ok where vig_gasto ='$vigencia' group by cod_cgr,vig_gasto,cod_rec,oer,cda,unidad_ejec,finalidad_gasto";
	$res = mysql_db_query($database,$queEmp,$conEmp) or die(mysql_error());
	while($row = mysql_fetch_array($res)) 
	{ 
	$suma = $row["sum(ppto_aprob)"]+$row["sum(sum_adiciones)"]+$row["sum(sum_reducciones)"]+$row["sum(cancelaciones)"]+$row["sum(sum_creditos)"]+$row["sum(sum_contracreditos)"]+$row["sum(sum_aplazamientos)"]+$row["sum(sum_desaplazamientos)"] ;
	if ($row["vig_gasto"]==2) 
		{
			$row["sum(suma_cdpp)"]=0; 
			$row["sum(reversion_cdpp)"]=0;
			$row["sum(ppto_aprob)"]= $row["sum(sum_adiciones)"]-$row["sum(sum_reducciones)"]+$row["sum(sum_creditos)"]-$row["sum(sum_contracreditos)"];
			$row["sum(sum_adiciones)"]=0;
			$row["sum(sum_reducciones)"]=0;
			$row["sum(sum_creditos)"]=0;
			$row["sum(sum_contracreditos)"]=0;
		}
	if ($suma !=0)
	{
		printf("
		<tr>
		<td align='left' width='150'>%s</td>
		<td align='center' width='30' class='text'>%s</td>
		<td align='center' width='40'>%s</td>
		<td align='center' class='text'>%s</td>
		<td align='center' width='50' class='text'>%s</td>
		<td align='center' width='60'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
		<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
		</tr>
		",$row["cod_cgr"],$row["unidad_ejec"],$row["cod_rec"],$row["oer"],$row["cda"],$row["finalidad_gasto"],$row["sum(ppto_aprob)"],$row["sum(sum_adiciones)"],$row["sum(sum_reducciones)"],$row["sum(sum_creditos)"],$row["sum(sum_contracreditos)"],$row["sum(sum_aplazamientos)"],$row["sum(sum_desaplazamientos)"],$row["definitivo"],$row["sum(suma_cdpp)"],$row["sum(reversion_cdpp)"]);
	 } // end if
}

printf("</table></center>");
}
if($tipo == 'CXPP')
{
// CUENTAS POR PAGAR
printf("
	<center>
	<table width='1500' BORDER='1'>
	<tr>
	<td align='center'>PROGRAMACIONDEGASTOS CUENTAS POR PAGAR - $archivo</td>
	<td align='center'></td>
	<td align='center'></td>
	<td></td>
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
	<td align='center'></td>
	<td align='center'></td>
	</tr>
	<tr>
	<td align='center' bgcolor='#CCCCCC'>CONCEPTOS</td>
	<td align='center' bgcolor='#CCCCCC'>VIGENCIA</td>
	<td align='center' bgcolor='#CCCCCC'>RECURSOS</td>
	<td bgcolor='#CCCCCC'>ORIEGEN</td>
	<td align='center' bgcolor='#CCCCCC'>DESTINACION</td>
	<td align='center' bgcolor='#CCCCCC'>FINALIDAD</td>
	<td align='center' bgcolor='#CCCCCC'>INICIAL</td>
	<td align='center' bgcolor='#CCCCCC'>ADICIONES</td>
	<td align='center' bgcolor='#CCCCCC'>REDUCIONES</td>
	<td align='center' bgcolor='#CCCCCC'>CANCELACIONES</td>
	<td align='center' bgcolor='#CCCCCC'>CREDITOS</td>
	<td align='center' bgcolor='#CCCCCC'>CONTRACREDITOS</td>
	<td align='center' bgcolor='#CCCCCC'>APLAAMIENTOS</td>
	<td align='center' bgcolor='#CCCCCC'>DESAPLAZAMIENTOS</td>
	<td align='center' bgcolor='#CCCCCC'>DEFINITIVO</td>
	<td align='center' bgcolor='#CCCCCC'>CDPS</td>
	<td align='center' bgcolor='#CCCCCC'>REVERSION CDPS</td>
	</tr>
	
	");
$sq2 ="SELECT
 			 cod_cgr
		    , SUM(ppto_aprob)
    		, tip_dato
			, cod_rec
			, oer
			, cda
			, finalidad_gasto
			, situacion
			, ent_recip
			, uni_ejec_cgr
		FROM
			cxp
		WHERE (tip_dato ='D')
		GROUP BY cod_cgr,cod_rec,oer,cda,finalidad_gasto;
	  ";
$rs2 = mysql_query($sq2,$conEmp);
while ($row2 = mysql_fetch_array($rs2))
{
	$cxp = $row2["SUM(cxp.ppto_aprob)"] -  $row2["SUM(cecp_cuenta.valor)"];
	$sq3 = "SELECT
				cxp.cod_cgr
				, COUNT(cecp_cuenta.id_auto_cecp) AS num
				, sum(cecp_cuenta.valor) AS pagado
			FROM
				cxp
				INNER JOIN cecp_cuenta 
					ON (cxp.cod_pptal = cecp_cuenta.cuenta)
			WHERE (cxp.cod_cgr ='$row2[cod_cgr]')
			GROUP BY cxp.cod_cgr;
	";
	$rs3 = mysql_query($sq3,$conEmp);
	$rw3 = mysql_fetch_array($rs3);
	// cuenta por pagar
	printf("
	<tr>
		<td align='left' width='150'>%s</td>
		<td align='center' width='20'>%s</td>
		<td align='center' width='50'>%s</td>
		<td align='center' class='text'>%s</td>
		<td align='center' width='50' class='text'>%s</td>
		<td align='center' width='60'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100'>%s</td>
		<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
		<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
	</tr>
	",$row2["cod_cgr"],3,$row2["cod_rec"],$row2["oer"],$row2["cda"],$row2["finalidad_gasto"],$row2["SUM(ppto_aprob)"],0,0,0,0,0,0,0,0,0,0);
} 

}
 
printf("</table></center>");

// Ejecutado ***************************************************************
if($tipo == 'EJEC')
{
printf("
<center>
<table width='1500' BORDER='1'>
<tr>
<td align='center'>EJECUCION DE GASTOS $titulo - $archivo</td>
<td align='center'></td>
<td></td>
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
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
</tr>
<tr>
<td bgcolor='#CCCCCC' align='center'>CONCEPTO</td>
<td bgcolor='#CCCCCC' align='center'>DEPENDENCIA</td>
<td bgcolor='#CCCCCC' >RECURSOS</td>
<td bgcolor='#CCCCCC' align='center'>ORIGEN</td>
<td bgcolor='#CCCCCC' align='center'>DESTINACION</td>
<td bgcolor='#CCCCCC' align='center'>FINALIDAD</td>
<td bgcolor='#CCCCCC' align='center'>SITUACION</td>
<td bgcolor='#CCCCCC' align='center'>No COMP</td>
<td bgcolor='#CCCCCC' align='center'>No OBLI</td>
<td bgcolor='#CCCCCC' align='center'>No PAGO</td>
<td bgcolor='#CCCCCC' align='center'>RECIPROCA</td>
<td bgcolor='#CCCCCC' align='center'>COMP ANTICIPO</td>
<td bgcolor='#CCCCCC' align='center'>COMP SIN ANTICIPO</td>
<td bgcolor='#CCCCCC' align='center'>REVER COMP</td>
<td bgcolor='#CCCCCC' align='center'>OBLIGACION</td>
<td bgcolor='#CCCCCC' align='center'>REVER OBLI</td>
<td bgcolor='#CCCCCC' align='center'>PAGOS</td>
<td bgcolor='#CCCCCC' align='center'>ANULACION PAGOS</td>
<td bgcolor='#CCCCCC' align='center'>RESERVAS</td>
<td bgcolor='#CCCCCC' align='center'>CXP</td>
<td bgcolor='#CCCCCC' align='center'>OBLI X EJEC</td>
</tr>
");

$queEmp = "
SELECT 
ctrl,
cod_cgr,
vig_gasto,
dep,
cod_rec,
oer,
cda,
unidad_ejec,
finalidad_gasto,
sit_fondos,
(if (num_compromisos = '' , 0, num_compromisos)) as num_compromisos,
(if (num_obligaciones = '' , 0, num_obligaciones)) as num_obligaciones,
(if (num_pagos = '' , 0, num_pagos)) as num_pagos,
ent_recip,
sum(sum_comprom_con_anti),
sum(sum_comprom_sin_anti),
sum(reversion_gastos_compro) ,
sum(sum_obligacion) ,
sum(rever_gastos_obligados) ,
sum(pagos) ,
sum(anulacion_pagos) ,
(sum(sum_comprom_con_anti)+sum(sum_comprom_sin_anti)-sum(sum_obligacion)) as reserva ,
(sum(sum_obligacion)-sum(pagos)) as cxp ,
(sum(pagos) * 0) as obli_x_eje
FROM cgr_aux_gas_ok where vig_gasto ='$vigencia' GROUP BY cod_cgr,vig_gasto,cod_rec, oer, cda, finalidad_gasto, sit_fondos, ent_recip,unidad_ejec";
$resEmp = mysql_query($queEmp, $conEmp) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
while($row = mysql_fetch_assoc($resEmp)) 
{ 
	if ($row["vig_gasto"]==2) {$row["sum(sum_comprom_con_anti)"]=0;$row["sum(sum_comprom_sin_anti)"]=0;}
	$suma2= $row["sum(sum_comprom_con_anti)"]+$row["sum(sum_comprom_sin_anti)"]+$row["sum(sum_obligacion)"]+$row["sum(pagos)"];
	if ($suma2 >0)
	{
	//if ($row["vig_gasto"] ==3) $row["cxp"]=0;
	$sit =$row['sit_fondos'];
	if($sit=='C') $sit2=1;
	if($sit=='S') $sit2=2;

	printf("
	<tr>
	<td align='left' width='150'>%s</td>
	<td align='center' width='50' class='text' bgcolor='#CCCCCC'>%s</td>
	<td align='center' >%s</td>
	<td align='center' width='50' class='text'>%s</td>
	<td align='center' width='60' class='text'>%s</td>
	<td align='right' width='50'>%s</td>
	<td align='right' width='30'>%s</td>
	<td align='right' width='30'>%s</td>
	<td align='right' width='30' bgcolor='#CCCCCC'>%s</td>
	<td align='right' width='30' >%s</td>
	<td align='right' width='120' class='text'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
	<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
	</tr>
	",$row["cod_cgr"],$row["unidad_ejec"],$row["cod_rec"],$row["oer"],$row["cda"],$row["finalidad_gasto"],$sit2,$row["num_compromisos"],$row["num_obligaciones"],$row["num_pagos"],$row["ent_recip"],$row["sum(sum_comprom_con_anti)"],$row["sum(sum_comprom_sin_anti)"],$row["sum(reversion_gastos_compro)"],$row["sum(sum_obligacion)"],$row["sum(rever_gastos_obligados)"],$row["sum(pagos)"],$row["sum(anulacion_pagos)"],$row["reserva"],$row["cxp"],$row["obli_x_eje"]);
	}
}

printf("</table></center>");
}

// ******************************* FIN EJECUCION DE GASTOS

?>
</body>
</html>