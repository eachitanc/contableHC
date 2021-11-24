<?
set_time_limit(1800);
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Gastos_de_Inversion_AE_SGP_Resguardos.xls");
header("Pragma: no-cache");
header("Expires: 0");
// Conexionae con la base datos
include("../config.php");
$cx=mysql_connect ($server, $dbuser, $dbpass);
$corte =$_GET["corte"];
// Creo la tabla temporal para generar el informe
//************* borro la tabla	
$tabla1="fut_cab_gas";
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
$tabla7="fut_cab_gas";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `id` int(11) NOT NULL auto_increment,
  `codigo` varchar(100) NOT NULL default '',
  `fuente` varchar(100) NOT NULL default '',
  `inicial` decimal(20,2) NOT NULL default '0.00',
  `definitivo` decimal(20,2) NOT NULL default '0.00',
  `comprometido` decimal(20,2) NOT NULL default '0.00',
  `obligado` decimal(20,2) NOT NULL default '0.00',
  `pagado` decimal(20,2) NOT NULL default '0.00',
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
$sql = "SELECT sum(ppto_aprob) as aprobado, cod_pptal, cod_cabildo, fuente_cabildo FROM car_ppto_gas where tip_dato='D' group by cod_pptal";
$res = mysql_db_query($database,$sql, $cx) or die(mysql_error());
	while($rw = mysql_fetch_array($res)) 
	{ 
		$cod_pptal =$rw["cod_pptal"]; 
		$aprobado =($rw["aprobado"]); 
		$cod =$rw["cod_cabildo"]; 
		$fuente =$rw["fuente_cabildo"]; 
		// Consulto estado de adiciones
		$sq2 = "SELECT sum(valor_adi) as adicion  FROM adi_ppto_gas where cod_pptal='$cod_pptal' and fecha_adi <='$corte' group by cod_pptal";
		$re2 = mysql_db_query($database,$sq2, $cx) or die(mysql_error());
			while($rw2 = mysql_fetch_array($re2)) 
			{
				$adicion =$rw2["adicion"]; 
			}
		// Consulto estado de reducciones
		$sq3 = "SELECT sum(valor_adi) as reduccion  FROM red_ppto_gas where cod_pptal='$cod_pptal' and fecha_adi <='$corte' group by cod_pptal";
		$re3 = mysql_db_query($database,$sq3, $cx) or die(mysql_error());
			while($rw3 = mysql_fetch_array($re3)) 
			{
				$reduccion =$rw3["reduccion"];
			}
		// Consulto estado de creditos
		$sq31 = "SELECT sum(valor_adi) as creditos  FROM creditos where cod_pptal='$cod_pptal' and fecha_adi <='$corte' group by cod_pptal";
		$re31 = mysql_db_query($database,$sq31, $cx) or die(mysql_error());
			while($rw31 = mysql_fetch_array($re31)) 
			{
				$creditos =$rw31["creditos"];
			}
		$sq32 = "SELECT sum(valor_adi) as contracred  FROM contracreditos where cod_pptal='$cod_pptal' and fecha_adi <='$corte' group by cod_pptal";
		$re32 = mysql_db_query($database,$sq32, $cx) or die(mysql_error());
			while($rw32 = mysql_fetch_array($re32)) 
			{
				$contracreditos =$rw32["contracred"];
			}
		$definitivo = $aprobado + $adicion + $creditos - $reduccion  - $contracreditos;
		// Consulto el valor comprometido
		$sq4 = "SELECT sum(vr_digitado) as comprometido  FROM crpp where cuenta='$cod_pptal' and fecha_crpp <='$corte' group by cuenta";
		$re4 = mysql_db_query($database,$sq4, $cx) or die(mysql_error());
			while($rw4 = mysql_fetch_array($re4)) 
			{
				$comprometido =($rw4["comprometido"]);
			}
		$sq5 = "SELECT sum(vr_digitado) as obligado  FROM cobp where cuenta='$cod_pptal' and fecha_cobp <='$corte' group by cuenta";
		$re5 = mysql_db_query($database,$sq5, $cx) or die(mysql_error());
			while($rw5 = mysql_fetch_array($re5)) 
			{
				$obligado =($rw5["obligado"]);
			}
		// calcular los pagos de acuerdo a la fecha de corte
		// 1 selecciono todos los pagos que esten dentro del periodo
		$sq6 = "SELECT sum(cobp.vr_digitado) as pagado
				FROM   ceva
              	INNER JOIN cobp ON (ceva.id_auto_cobp = cobp.id_auto_cobp)
				WHERE (cobp.pagado ='SI' AND cobp.cuenta ='$cod_pptal' AND ceva.fecha_ceva <='$corte');";
		$re6 = mysql_db_query($database,$sq6, $cx) or die(mysql_error());
			while($rw6 = mysql_fetch_array($re6)) 
			{
				$pagado =$rw6["pagado"];	
			}
		// Cargo los datos en la tabla
		$sq8 = "INSERT INTO fut_cab_gas (codigo,fuente,inicial,definitivo,comprometido,obligado,pagado) VALUES ('$cod','$fuente','$aprobado','$definitivo','$comprometido','$obligado','$pagado')";
		mysql_db_query($database, $sq8, $cx) or die(mysql_error());
		// Reinicializo variables
	    $comprometido=0;
		$obligado=0;
		$pagado=0;
		$definitivo = 0;
		$aprobado=0;
		$adicion=0;
		$reduccion=0;
		$creditos=0;
		$contracreditos=0;
	}
	// genero la tabla para presentar el informe
	echo "<table border='1'>
		<tr>
			<td>S</td>
			<td>$cod_cgn</td>
			<td>$periodo2</td>
			<td>$anno</td>
			<td>GASTOS_DE_INVERSION_AE_SGP_RESGUARDOS</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td bgcolor='#009999'>CTRL</td>
			<td bgcolor='#009999'>CONCEPTO</td>
			<td bgcolor='#009999'>COD RESGUARDO</td>
			<td bgcolor='#009999'>FUENTE</td>
			<td bgcolor='#009999'>INICIAL</td>
			<td bgcolor='#009999'>DEFINITIVO</td>
			<td bgcolor='#009999'>COMPROMETIDO</td>
			<td bgcolor='#009999'>OBLIGADO</td>
			<td bgcolor='#009999'>PAGADO</td>
		</tr>";
	// consulto la tabla para generar el reporte
	$sq9 = "SELECT codigo,fuente,sum(inicial) as inicial, sum(definitivo) as def, sum(comprometido) as com, sum(obligado) as obl, sum(pagado) as pag FROM fut_cab_gas group by codigo,fuente";
	$re9 = mysql_db_query($database,$sq9, $cx) or die(mysql_error());
		while($rw9 = mysql_fetch_array($re9)) 
		{
		echo "<tr>
			<td>D</td>
			<td>$rw9[codigo]</td>
			<td bgcolor='#D7FFFF'>Cod Resguardo</td>
			<td>$rw9[fuente]</td>
			<td>$rw9[inicial]</td>
			<td>$rw9[def]</td>
			<td>$rw9[com]</td>
			<td>$rw9[obl]</td>
			<td>$rw9[pag]</td>
		</tr>";
			
		}
	echo "</table>";	
//************* borro la tabla	
$tabla1="fut_cab_gas";
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
