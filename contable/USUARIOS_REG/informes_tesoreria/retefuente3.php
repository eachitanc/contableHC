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
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
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
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
mysql_db_query($database,"TRUNCATE TABLE retefte_det",$cx);
$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta like '2365%' and cuenta not like '243627%'  ";
$re = mysql_db_query($database, $sq, $cx);
while($rw3 = mysql_fetch_array($re)) 
{
	// Sumatoria del valo total pagado
	$sq15 ="select sum(credito) as total_pagado from lib_aux where id_auto ='$rw3[id_auto]' and  cuenta like '2365%' ";
	$re15 =mysql_db_query($database,$sq15,$cx);
	$rw15 =mysql_fetch_array($re15);
	$sq2 = "select cuenta,credito from lib_aux where (cuenta like '1110%' or cuenta like '2365%' ) and id_auto ='$rw3[id_auto]'";
	$re2 = mysql_db_query($database, $sq2, $cx);
	while ($rw2 =  mysql_fetch_array($re2))
	{ 
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
		$porcentaje = $rw2['credito'] / $rw15['total_pagado'];
		$valor = $porcentaje * $rw3['credito'];
		
		}
		if ($tipo_dcto == 'CECP')
		{
			$sq4 = "select * from cecp where id_auto_cecp ='$rw3[id_auto]'";
			$re4 = mysql_db_query($database, $sq4, $cx);
			$rw4 =  mysql_fetch_array($re4); 	
		$bruto = $rw4["total_pagado"] + $rw4["salud"] + $rw4["pension"] + $rw4["libranza"] + $rw4["f_solidaridad"] + $rw4["f_empleados"] + $rw4["sindicato"] + $rw4["embargo"] + $rw4["cruce"] + $rw4["otros"] + $rw4["vr_retefuente"] + $rw4["vr_reteiva"] + $rw4["vr_reteica"] + $rw4["vr_estampilla1"] + $rw4["vr_estampilla2"] + $rw4["vr_estampilla3"] + $rw4["vr_estampilla4"] + $rw4["vr_estampilla5"];	
		$base = $bruto - $rw['vr_reteiva'];	
		$porcentaje = $rw2['credito'] / $rw15['total_pagado'];
		$valor = $porcentaje * $rw3['credito'];
		}
		if ($tipo_dcto == 'OBCG')
		{
			$sq4 = "select sum(debito) as base from lib_aux where id_auto ='$rw3[id_auto]'";
			$re4 = mysql_db_query($database, $sq4, $cx);
			$rw4 =  mysql_fetch_array($re4); 
			$base = $rw4["base"];	
			$valor = $rw3['credito'];
		}
		//base del iva
		$cuentas = substr($rw3['cuenta'], 0, 6);
		if($cuentas =='243625') $base =0;
		// insert
	$sq5 = "INSERT INTO retefte_det (id_auto,dcto,cuenta,detalle,base,debito,credito,cta_bco) values ('$rw3[id_auto]','$rw3[dcto]','$rw3[cuenta]','$rw3[detalle]','$base','$rw3[debito]','$valor','')";
	$res = mysql_db_query($database, $sq5, $cx);
	}
	$valor =0;
	$porcentaje =0;
}
// Inicio del reporte
printf("
<center>
<table width='2400' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>Cuenta</td>
<td align='center' width='220'>Nombre</td>
<td align='center' width='220'>Base</td>
<td align='center' width='220'>Retencion</td>
</tr>
");
// buscar el numero de cuentas que hay en la tabla
$sq7 ="select distinct cuenta as cuenta from retefte_det where credito >0 order by cuenta asc";
$re7 = mysql_db_query($database, $sq7, $cx);
$fi7 = mysql_num_rows($re7);
$j=0;
while ($rw7 =  mysql_fetch_array($re7))
{
	$cuenta=$rw7['cuenta'];
	$sq16= "select sum(base) as base, sum(credito) as credito from  retefte_det where cuenta = $rw7[cuenta] group by cuenta";
	$re16 = mysql_db_query($database, $sq16, $cx);
	$rw16=  mysql_fetch_array($re16);
	// consulta el nombre de la cuenta
	$sq17="select nom_rubro from pgcp where cod_pptal ='$rw7[cuenta]'";
	$re17=mysql_db_query($database,$sq17,$cx);
	$rw17=mysql_fetch_array($re17);
	echo "<tr>";
	echo("<td align='left' width='80'>$cuenta</td>");
	echo("<td align='left' width='80'>$rw17[nom_rubro]</td>");
	echo("<td align='right' width='80'>$rw16[base]</td>");
	printf("<td align='rigth' width='80'>$rw16[credito]</td>");
	echo "</tr>";
} 	


printf("</table></center>");
//--------	
?>	
</body>
</html>
<?
}
?>