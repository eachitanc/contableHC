<?php 
function incrementa_mes($fecha) {
$ex=explode("/", $fecha);
$anno =$ex[0];
$mes =$ex[1];
$dia =$ex[2];
if ($mes =='12') {$mes='01'; $anno++; $ctr =1;}
if ($mes =='11') {$mes='12';}
if ($mes =='10') {$mes='11'; if ($dia >30) {$dia=30;}}
if ($mes =='09') {$mes='10';}
if ($mes =='08') {$mes='09';}
if ($mes =='07') {$mes='08'; if ($dia >30) {$dia=30;}}
if ($mes =='06') {$mes='07';}
if ($mes =='05') {$mes='06'; if ($dia >30) {$dia=30;}}
if ($mes =='04') {$mes='05';}
if ($mes =='03') {$mes='04'; if ($dia >30) {$dia=30;}}
if ($mes =='02') {$mes='03';}
if ($mes =='01' && $ctr !=1) {$mes='02'; if ($dia >28) {$dia=28;}}
$fecha2 =$anno."/".$mes."/".$dia;
return $fecha2;
}
function suma_fechas($fecha2){ 
	$nuevafecha = strtotime($fecha2) -1; 
	$fecha = date("Y/m/d", $nuevafecha);
	return $fecha;
	echo $fecha;
}

function dias_diferencia($fecha_ini)
	{
	//defino fecha 1
	$fecha_ini = split('/', $fecha_ini);
	$ano1 = $fecha_ini[0];
	$mes1 = $fecha_ini[1];
	$dia1 = $fecha_ini[2];
	
	//defino fecha actual
	$fecha_fin = date('Y/m/d');
	$fecha_fin = split('/', $fecha_fin);
	$ano2 = $fecha_fin[0];
	$mes2 = $fecha_fin[1];
	$dia2 = $fecha_fin[2];
	//calculo timestam de las dos fechas
	$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
	$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2);
	//resto a una fecha la otra
	$segundos_diferencia = $timestamp1 - $timestamp2;
	//echo $segundos_diferencia;
	//convierto segundos en días
	$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
	//obtengo el valor absoulto de los días (quito el posible signo negativo)
	$dias_diferencia = abs($dias_diferencia);
	//quito los decimales a los días de diferencia
	$dias_diferencia = floor($dias_diferencia);
	return $dias_diferencia;
}
?> 



