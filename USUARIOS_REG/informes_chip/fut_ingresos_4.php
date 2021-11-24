<?
set_time_limit(1800);

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Fut_Ingresos_Reservas.xls");
header("Pragma: no-cache");
header("Expires: 0"); 

include("../config.php");
$cx = new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database, $cx);
$rea =mysql_db_query($database,"select * from fut_aux_ing",$cx);
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
$sql = "SELECT ctrl,cod_fut,sum(ppto_aprob),sum(definitivo),sum(vr_efectivo),sum(vr_sin_sit),acto_fut,num_acto_fut,porcentaje_fut,sum(vr_fut),fuente,vigencia FROM fut_aux_ing_ok where vigencia ='RESERVA' group by cod_fut";
$res = mysql_db_query($database,$sql, $cx) or die(mysql_error());
$cott= 1;
	printf("
	<table  border='1'>
	<tr>
	<td align='center'>S</td>
	<td align='center'>$cod_cgn</td>
	<td align='center'>$periodo2</td>
	<td align='center'>$anno</td>
	<td align='center'>INGRESOS_PARA_RESERVA</td>
	</tr>
	");
	while($rw = mysql_fetch_assoc($res)) 
	{ 
	$sum_ctrl = $rw["sum(ppto_aprob)"] + $rw["sum(definitivo)"] + $rw["sum(vr_efectivo)"] + $rw["sum(vr_sin_sit)"];
	
			if ($sum_ctrl >0)
			{
			$inicial = $inicial + $rw["sum(ppto_aprob)"];
			$defin = $defin + $rw["sum(definitivo)"];
			$rec_cf = $rec_cf + $rw["sum(vr_efectivo)"];
			$rec_sf = $rec_sf + $rw["sum(vr_sin_sit)"];
			$rec_tot =  $rw["sum(vr_efectivo)"]+$rw["sum(vr_sin_sit)"];
			if($rw["porcentaje_fut"] >0)
			{
				$rw["acto_fut"] ='true';
			}
			printf("
			<tr>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='right' bgcolor='#CCCCCC'>%s</td>
			<td align='right'>%s</td>
			<td align='center'></td>
			
			</tr>
			",'D',$rw["cod_fut"],$rw["sum(definitivo)"], $rec_tot); 
		}  
	}
	$rec = $rec_cf + $rec_sf;
printf("
	<tr>
		<td align='center'>D</td>
		<td align='left'>VAL</td>
		<td align='right' bgcolor='#CCCCCC'>$defin</td>
		<td align='right'>$rec</td>
		<td align='right'></td>
		</tr>
	</table>");
?>