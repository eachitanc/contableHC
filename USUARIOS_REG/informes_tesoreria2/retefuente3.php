<?
set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=RETENCION_FUENTE.xls");
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
<?
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$fecha_ini=$_POST['fecha_ini'];
	$fecha_fin=$_POST['fecha_fin'];	
	

$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }
$sqldatos = "select * from empresa";
$resdatos= mysql_db_query($database,$sqldatos,$connectionxx);
while ($rw1 = mysql_fetch_array($resdatos))
	{
		$entidad = $rw1["raz_soc"];
		$nit = $rw1["nit"];
		$rep = $rw1["nom_rep_leg"];
		$conta = $rw1["nom_cont"];
	}    
?>
<table width='1380' border ='0' align='center' >
<tr>
	<td><b>ENTIDAD:</b></td>
	<td align="left"><?php echo $entidad; ?></td>
</tr>
<tr>
	<td><b>NIT:</b></td>
	<td align="left"><?php echo $nit; ?></td>
</tr>
<tr>
	<td><b>REPORTE:</b></td>
	<td>CONSOLIDADO RETENCION EN LA FUENTE</td>
</tr>
<tr>
	<td><b>FECHA INICIAL:</b></td>
	<td align="left"><?php echo $fecha_ini; ?></td>
</tr>
<tr>
	<td><b>FECHA FINAL:</b></td>
	<td align="left"><?php echo $fecha_fin; 
; ?></td>
</tr>

</table>
<br />
<?php 
   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $desde=$rowxx3["fecha_ini_op"];
   }    
?>	
	<form name="a" method="post" action="retefuente.php">
</form>	
	<?
//-------
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
mysql_db_query($database,"TRUNCATE TABLE retefte_det",$cx);
$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta like '2436%' and cuenta not like '243627%' ";
$re = mysql_db_query($database, $sq, $cx);
while($rw3 = mysql_fetch_array($re)) 
{
	$sq2 = "select cuenta from lib_aux where (cuenta like '1110%' or cuenta like '190101%') and id_auto ='$rw3[id_auto]'";
	$re2 = mysql_db_query($database, $sq2, $cx);
	$rw2 =  mysql_fetch_array($re2); 
//*** INFO base deacuerdo a documento ***//
//*** porcentaje retefuente 
$base =0;
$tipo_dcto = substr($rw3['dcto'], 0, 4); 
if ($tipo_dcto == 'CEVA')
{
	$sq4 = "select * from ceva where id_auto_ceva ='$rw3[id_auto]'";
	$re4 = mysql_db_query($database, $sq4, $cx);
	$rw4 =  mysql_fetch_array($re4); 	
$bruto = $rw4["total_pagado"] + $rw4["salud"] + $rw4["pension"] + $rw4["libranza"] + $rw4["f_solidaridad"] + $rw4["f_empleados"] + $rw4["sindicato"] + $rw4["embargo"] + $rw4["cruce"] + $rw4["otros"] + $rw4["vr_retefuente"] + $rw4["vr_reteiva"] + $rw4["vr_reteica"] + $rw4["vr_estampilla1"] + $rw4["vr_estampilla2"] + $rw4["vr_estampilla3"] + $rw4["vr_estampilla4"] + $rw4["vr_estampilla5"];	
$base = $bruto - $rw['vr_reteiva'];	
}
if ($tipo_dcto == 'CECP')
{
	$sq4 = "select * from cecp where id_auto_cecp ='$rw3[id_auto]'";
	$re4 = mysql_db_query($database, $sq4, $cx);
	$rw4 =  mysql_fetch_array($re4); 	
$bruto = $rw4["total_pagado"] + $rw4["salud"] + $rw4["pension"] + $rw4["libranza"] + $rw4["f_solidaridad"] + $rw4["f_empleados"] + $rw4["sindicato"] + $rw4["embargo"] + $rw4["cruce"] + $rw4["otros"] + $rw4["vr_retefuente"] + $rw4["vr_reteiva"] + $rw4["vr_reteica"] + $rw4["vr_estampilla1"] + $rw4["vr_estampilla2"] + $rw4["vr_estampilla3"] + $rw4["vr_estampilla4"] + $rw4["vr_estampilla5"];	
$base = $bruto - $rw['vr_reteiva'];	
}
//base del iva
$cuentas = substr($rw3['cuenta'], 0, 6);
if($cuentas =='243625') $base =0;
// insert

$sq5 = "INSERT INTO retefte_det (id_auto,dcto,cuenta,detalle,base,debito,credito,cta_bco) values ('$rw3[id_auto]','$rw3[dcto]','$rw3[cuenta]','$rw3[detalle]','$base','$rw3[debito]','$rw3[credito]','$rw2[cuenta]')";
$res = mysql_db_query($database, $sq5, $cx);
}

printf("
<center>
<table width='2400' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>Cuenta</td>
<td align='center' width='220'>Nombre</td>
");
// buscar el numero de cuentas que hay en la tabla
$sq7 ="select distinct cta_bco as cta_b from retefte_det where credito >0 order by cta_bco asc";
$re7 = mysql_db_query($database, $sq7, $cx);
$fi7 = mysql_num_rows($re7);
$j=0;
while ($rw7 =  mysql_fetch_array($re7))
{
	$cuenta_bco[$j] = $rw7['cta_b'];	
	$j++;
} 	
for ($i=0;$i<$fi7;$i++)
{
	printf("
	<td align='center' width='80'>$cuenta_bco[$i]</td>");
}

printf("
<td align='center' width='100'>Total Rte</td>
<td align='center' width='100'>Total Pago</td>
<td align='center' width='100'>Total Base</td>
</tr>
");

// consultar por cada cuenta y 
$sq8 = "select distinct cuenta from retefte_det where credito >0";
$re8 = mysql_db_query($database, $sq8, $cx);
$k=0;
while ($rw8 =  mysql_fetch_array($re8))
{
	$sq11 = "select nom_rubro from pgcp where cod_pptal = '$rw8[cuenta]'";
	$re11 = mysql_db_query($database, $sq11, $cx);
	$rw11 =  mysql_fetch_array($re11);
	printf("<tr bgcolor='#ffffff'>
	<td align='center'>$rw8[cuenta]</td>
	<td align='left'>$rw11[nom_rubro]</td>	
	");
	// consulto la tabla para llenar los valores de cada cuenta
	for ($i=0;$i<$fi7;$i++)
	{
		$sq12 ="select sum(credito) as val from retefte_det where cuenta ='$rw8[cuenta]' and cta_bco ='$cuenta_bco[$i]'";
		$re12 = mysql_db_query($database, $sq12, $cx);
		$rw12 =  mysql_fetch_array($re12);
		$credito = 	$rw12['val'];
		if ($credito =='') $credito=0.00;
		printf("
		<td align='right'>$credito</td>
		");
		$k++;
	}
	// consultar el total de la retencion por cada cuenta o tipo de retencion
		$sq13 ="select sum(credito) as valt, sum(base) as base from retefte_det where cuenta ='$rw8[cuenta]'";
		$re13 = mysql_db_query($database, $sq13, $cx);
		$rw13 = mysql_fetch_array($re13);
		$pago = round(($rw13['valt']/1000),0)*1000; 
		$base = round(($rw13['base']/1000),0)*1000; 
	printf("
		<td align='right' bgcolor='#CCCCCC'>$rw13[valt]</td>
		<td align='right' bgcolor='#FFCC00'>$pago</td>
		<td align='right' bgcolor='#FFCC00'>$base </td>
		</tr>
		");
	$pago=0;
	$base=0;
	
	
}
printf("<tr bgcolor='#ffffff'>
			<td align='left' colspan='2' bgcolor='#CCCCCC'>Total Rte</td>
			");
$i=0;
$sum=0;
$baset=0;
for ($i=0;$i<$fi7;$i++)
{
		$sq14="select sum(credito) as valt, sum(base) as base from retefte_det where cta_bco ='$cuenta_bco[$i]'";
		$re14 = mysql_db_query($database, $sq14, $cx);
		$rw14 = mysql_fetch_array($re14);
		printf("
			<td align='right' bgcolor='#CCCCCC'>$rw14[valt]</td>
			");
		$sum = $sum + $rw14['valt'];
		$base2 = $base2 + $rw14['base'];
}
printf("<td align='right' bgcolor='#CCCCCC'>$sum</td>
			");
$sumt = round(($sum/1000),0)*1000;
printf("<td align='right' bgcolor='#FFCC00'>$sumt</td>
			"); 
$baset = round(($base2/1000),0)*1000;
printf("<td align='right' bgcolor='#FFCC00'>$baset</td>
			");
// para final redondeado
printf("<tr bgcolor='#FFFFFF'>
			<td align='left' colspan='2' bgcolor='#FFCC00'>Total Pago</td>
			"); 
$i=0;
$suma=0;
for ($i=0;$i<$fi7;$i++)
{
		$sq14="select sum(credito) as valt from retefte_det where cta_bco ='$cuenta_bco[$i]'";
		$re14 = mysql_db_query($database, $sq14, $cx);
		$rw14 = mysql_fetch_array($re14);
		$suma = round(($rw14['valt']/1000),0)*1000;
		printf("
			<td align='right' bgcolor='#FFCC00'>$suma</td>
			");
		$sum = $sum + $rw14['valt'];
		$base2 = $base2 + $rw14['base'];
}
printf("<td align='left' colspan='3'>&nbsp;</td>
			");
printf("</tr></table></center>");
//--------	
?>	
</body>
</html>
<?
}
?>