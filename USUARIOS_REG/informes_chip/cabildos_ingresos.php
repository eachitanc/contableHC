<?
set_time_limit(1800);
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Ingresos_SGP_Regalias.xls");
header("Pragma: no-cache");
header("Expires: 0"); 
// Conexionae con la base datos
include("../config.php");
$cx=mysql_connect ($server, $dbuser, $dbpass);
$corte =$_GET["corte"];
// Creo la tabla temporal para generar el informe
//************* borro la tabla	
$tabla1="fut_cab_ing";
$anadir1="truncate TABLE ";
$anadir1.=$tabla1;
$anadir1.=" ";

mysql_select_db ($database, $cx);

		if(mysql_query ($anadir1 ,$cx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};

//********************crea tabla fut_aux_ing

$tabla7="fut_cab_ing";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `id` int(11) NOT NULL auto_increment,
  `codigo` varchar(100) NOT NULL default '',
  `concepto` varchar(100) NOT NULL default '',
  `fuente` varchar(100) NOT NULL default '',
  `inicial` decimal(20,2) NOT NULL default '0.00',
  `definitivo` decimal(20,2) NOT NULL default '0.00',
  `recaudo` decimal(20,2) NOT NULL default '0.00',
   PRIMARY KEY  (`id`)
)TYPE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1";
		
		mysql_select_db ($database, $cx);

		if(mysql_query ($anadir7 ,$cx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		}
//*****************
// Cargo la tabla con los datos solicitados
mysql_select_db($database, $cx);
$reb =mysql_db_query($database,"select * from empresa",$cx);
$rwb =mysql_fetch_array($reb);
$cod_cgn = $rwb["cod_cgn"];
$fecha2 = explode("/", $corte);
$anno = $fecha2[0];
$periodo = $fecha2[1];
if ($periodo =='03') $periodo2 ='10103';
if ($periodo =='06') $periodo2 ='10406';
if ($periodo =='09') $periodo2 ='10709';
if ($periodo =='12') $periodo2 ='11012';
// Consulto presupuesto aprobado
$sql = "SELECT sum(ppto_aprob) as aprobado, cod_pptal, cod_cabildo, fuente_cabildo FROM car_ppto_ing where tip_dato='D' group by cod_pptal";
$res = mysql_db_query($database,$sql, $cx) or die(mysql_error());
	while($rw = mysql_fetch_array($res)) 
	{ 
	$recaudo =0;
		$cod_pptal =$rw["cod_pptal"]; 
		$aprobado =($rw["aprobado"]); 
		$cod =$rw["cod_cabildo"]; 
		$fuente =$rw["fuente_cabildo"]; 
		// Consulto estado de adiciones
		$sq2 = "SELECT sum(valor_adi) as adicion  FROM adi_ppto_ing where cod_pptal='$cod_pptal' and fecha_adi <='$corte' group by cod_pptal";
		$re2 = mysql_db_query($database,$sq2, $cx) or die(mysql_error());
			while($rw2 = mysql_fetch_array($re2)) 
			{
				$adicion =$rw2["adicion"];
			}
		// Consulto estado de reducciones
		$sq3 = "SELECT sum(valor_adi) as reduccion  FROM red_ppto_ing where cod_pptal='$cod_pptal' and fecha_adi <='$corte' group by cod_pptal";
		$re3 = mysql_db_query($database,$sq3, $cx) or die(mysql_error());
			while($rw3 = mysql_fetch_array($re3)) 
			{
				$reduccion =$rw3["reduccion"];
			}
		$definitivo = ($aprobado + $adicion - $reduccion);
		// Consulto el valor recaudado
		$sq4 = "SELECT sum(vr_digitado) as recaudo1  FROM recaudo_ncbt where cuenta='$cod_pptal' and fecha_recaudo <='$corte' group by cuenta";
		$re4 = mysql_db_query($database,$sq4, $cx) or die(mysql_error());
			while($rw4 = mysql_fetch_array($re4)) 
			{
				$recaudo1 =$rw4["recaudo1"];
			}
		$sq5 = "SELECT sum(vr_digitado) as recaudo2  FROM recaudo_rcgt where cuenta='$cod_pptal' and fecha_recaudo <='$corte' group by cuenta";
		$re5 = mysql_db_query($database,$sq5, $cx) or die(mysql_error());
			while($rw5 = mysql_fetch_array($re5)) 
			{
				$recaudo2 =$rw5["recaudo2"];
			}
		$sq6 = "SELECT sum(vr_digitado) as recaudo3  FROM recaudo_roit where cuenta='$cod_pptal' and fecha_recaudo <='$corte' group by cuenta";
		$re6 = mysql_db_query($database,$sq6, $cx) or die(mysql_error());
			while($rw6 = mysql_fetch_array($re6)) 
			{
				$recaudo3 =$rw6["recaudo3"];
			}
		$sq7 = "SELECT sum(vr_digitado) as recaudo4  FROM recaudo_tnat where cuenta='$cod_pptal' and fecha_recaudo <='$corte' group by cuenta";
		$re7 = mysql_db_query($database,$sq7, $cx) or die(mysql_error());
			while($rw7 = mysql_fetch_array($re7)) 
			{
				$recaudo4 =$rw7["recaudo4"];
			}
		$recaudo = ($recaudo1 + recaudo2 + $recaudo3 + $recaudo4);
		// Cargo los datos en la tabla
		$sq8 = "INSERT INTO fut_cab_ing (codigo,fuente,inicial,definitivo,recaudo) VALUES ('$cod','$fuente','$aprobado','$definitivo','$recaudo')";
		mysql_db_query($database, $sq8, $cx) or die(mysql_error());
		$recaudo =0;
		$recaudo1 =0;
		$recaudo2 =0;
		$recaudo3 =0;
		$recaudo4 =0;
		$definitivo=0;
		$adicion=0;
	}
	// genero la tabla para presentar el informe
	echo "<table border='1'>
		<tr>
			<td>S</td>
			<td>$cod_cgn</td>
			<td>$periodo2</td>
			<td>$anno</td>
			<td>INGRESOS_SGP_REGALIAS</td>
			<td></td>
		</tr>
		<tr>
			<td bgcolor='#009999'>CTRL</td>
			<td bgcolor='#009999'>CONCEPTO</td>
			<td bgcolor='#009999'>FUENTE</td>
			<td bgcolor='#009999'>INICIAL</td>
			<td bgcolor='#009999'>DEFINITIVO</td>
			<td bgcolor='#009999'>RECAUDO</td>
		</tr>";
	// consulto la tabla para generar el reporte general
	$sq10 = "SELECT sum(inicial) as inicial, sum(definitivo) as def, sum(recaudo) as recaudo FROM fut_cab_ing";
	$re10 = mysql_db_query($database,$sq10, $cx) or die(mysql_error());
		while($rw10 = mysql_fetch_array($re10)) 
		{
			$inicial=$rw10["inicial"];
			$def=$rw10["def"];
			$recaudo=$rw10["recaudo"];
		}
	$sq11 = "SELECT codigo FROM fut_cab_ing";
	$re11 = mysql_db_query($database,$sq11, $cx) or die(mysql_error());
    $rw11 = mysql_fetch_array($re11);
	$cod_cabi=$rw11["codigo"]; 
	$cod_cab = explode(".", $cod_cabi);
		echo "<tr>
			<td>D</td>
			<td>$cod_cab[0]</td>
			<td></td>
			<td>$inicial</td>
			<td>$def</td>
			<td>$recaudo</td>
		</tr>";
		echo "<tr>
			<td>D</td>
			<td>$cod_cab[0].$cod_cab[1]</td>
			<td></td>
			<td>$inicial</td>
			<td>$def</td>
			<td>$recaudo</td>
		</tr>";
		echo "<tr>
			<td>D</td>
			<td>$cod_cab[0].$cod_cab[1].$cod_cab[2]</td>
			<td></td>
			<td>$inicial</td>
			<td>$def</td>
			<td>$recaudo</td>
		</tr>";
		
	$sq9 = "SELECT codigo,fuente,sum(inicial) as inicial, sum(definitivo) as def, sum(recaudo) as recaudo FROM fut_cab_ing group by codigo,fuente";
	$re9 = mysql_db_query($database,$sq9, $cx) or die(mysql_error());
		while($rw9 = mysql_fetch_array($re9)) 
		{
		echo "<tr>
			<td>D</td>
			<td>$rw9[codigo]</td>
			<td>$rw9[fuente]</td>
			<td>$rw9[inicial]</td>
			<td>$rw9[def]</td>
			<td>$rw9[recaudo]</td>
		</tr>";
		}
	echo "</table>";	
//************* borro la tabla	
$tabla1="fut_cab_ing";
$anadir1="truncate TABLE ";
$anadir1.=$tabla1;
$anadir1.=" ";
mysql_select_db ($database, $cx);
		if(mysql_query ($anadir1 ,$cx)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};
//******************** cierro concexion con la base
$cx = null;
?>
