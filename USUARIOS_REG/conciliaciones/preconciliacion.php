<?php 
set_time_limit(1200);
include('../config.php');
$cx=mysql_connect ($server, $dbuser, $dbpass);
echo "hola";
$sq = "SELECT * from aux_estracto where deb > 0";
$re = $cx->query($sq);
$fecha_m = '2015/12/31';
while($rw = $re->fetch_assoc()) 
{
	//$fecha = '2015/07/' . substr($rw['fecha'],-2);
	$sq2 = "select * from aux_conciliaciones where fecha_fin = '$fecha_m' and debito = '$rw[deb]' and fecha = '$rw[fecha]' and pre =''";
	$re2 = $cx->query($sq2);
	$rw2 = $re2->fetch_assoc();
	$fl2 = $re2->num_rows;
	if ($fl2 > 0)
	{
		//Actualiza conciliaciones
		$sq3 ="UPDATE `aux_estracto` SET `estado` = 'SI' WHERE `id` ='$rw[id]'" ;		
		$re3 = mysql_db_query($database, $sq3, $cx);
		// 
		$sq4 ="UPDATE `aux_conciliaciones` SET `pre` = 'SI', estado ='SI', flag1='1', flag2='1', fecha_marca ='$fecha_m' WHERE `consecutivo` ='$rw2[consecutivo]' and dcto = '$rw2[dcto]'" ;		
		$re4 = mysql_db_query($database, $sq4, $cx);

	} 
	
	// buscar similares sin marcar solo por valor
/*
}

$sq = "SELECT * from aux_estracto where cre > 0";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
	$fecha = '2015/07/' . substr($rw['fecha'],-2);
	$sq2 = "select * from aux_conciliaciones where fecha_fin = '2015/07/31' and cheque = '$rw[dcto]' and credito = '$rw[cre]' and pre =''";
	$re2 = $cx->query($sq2);
	$rw2 = $re2->fetch_assoc();
	$fl2 = $re2->num_rows;
	if ($fl2 > 0)
	{
		//Actualiza conciliaciones
		$sq3 ="UPDATE `aux_estracto` SET `estado` = 'SI' WHERE `id` ='$rw[id]'" ;		
		$re3 = mysql_db_query($database, $sq3, $cx);
		// 
		$sq4 ="UPDATE `aux_conciliaciones` SET `pre` = 'SI' WHERE `consecutivo` ='$rw2[consecutivo]'" ;		
		$re4 = mysql_db_query($database, $sq4, $cx);

	} 

 	echo "<br> natural $rw[fecha] :::.. $sq2";
*/	
}
$sq = "SELECT * from aux_estracto where deb > 0 and estado =''";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc()) 
{
	//$fecha = '2015/07/' . substr($rw['fecha'],-2);
	$sq3 = "select * from aux_conciliaciones where fecha_fin = '$fecha_m' and debito = '$rw[deb]' and pre =''";
	$re3 = mysql_db_query($database, $sq3, $cx);
	$rw3 = mysql_fetch_array($re3);
	$fl3 = mysql_num_rows($re3);
	if ($fl3 > 0)
	{
		//Actualiza conciliaciones
		$sq4 ="UPDATE `aux_estracto` SET `estado` = 'PP' WHERE `id` ='$rw[id]'" ;		
		$re4 = mysql_db_query($database, $sq4, $cx);
		// 
		$sq5 ="UPDATE `aux_conciliaciones` SET `pre` = 'PP'  WHERE `consecutivo` ='$rw3[consecutivo]'" ;		
		$re5 = mysql_db_query($database, $sq5, $cx);

	} 
}

?> 
