<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<title>CONTAFACIL</title>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" ><!-- Estas lineas incluyen el archivo estilosh.css -->
</head>
<body>
<div align="center">
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
</div>
<br />
<br />
<?
$corte=$_POST['corte'];
if (!$_POST['corte'])
{
$corte=$_GET['corte'];
}

include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

//************* borro la tabla		
$tabla6="fut_aux_ing";
$anadir6="DROP TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";

mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir6 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};

//********************crea tabla fut_aux_ing

$tabla7="fut_aux_ing";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `id` int(11) NOT NULL auto_increment,
  `fecha` varchar(100) NOT NULL default '',
  `cuenta` varchar(100) NOT NULL default '',
  `vr_efectivo` decimal(20,2) NOT NULL default '0.00',
  `vr_sin_sit` decimal(20,2) NOT NULL default '0.00',
   PRIMARY KEY  (`id`)
)TYPE=MyISAM AUTO_INCREMENT=1 ";
		
		mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir7 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		}

//*****************
$sq22 = "select * from empresa where cod_emp = '2'";
$re22= mysql_db_query($database, $sq22, $conexion);
while($row2 = mysql_fetch_array($re22)) 
   {
   $empresa = $row2["raz_soc"];
   }


//*****************

$sqlxx = "
SELECT recaudo_ncbt.cuenta, car_ppto_ing.situacion, sum(recaudo_ncbt.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_ncbt ON car_ppto_ing.cod_pptal = recaudo_ncbt.cuenta 
WHERE recaudo_ncbt.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'C'
GROUP BY recaudo_ncbt.cuenta,car_ppto_ing.situacion
";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);

//printf("CON SITUACION <br><br>");

while($rowxx = mysql_fetch_array($resultadoxx))
{
$cuenta=$rowxx["cuenta"];
$situacion=$rowxx["situacion"];
$total=$rowxx[total]/1000;

//printf("$cuenta / $situacion / $total <br>");

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta','$total','0')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}

$sqlxx2 = "
SELECT recaudo_ncbt.cuenta, car_ppto_ing.situacion, sum(recaudo_ncbt.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_ncbt ON car_ppto_ing.cod_pptal = recaudo_ncbt.cuenta 
WHERE recaudo_ncbt.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'S'
GROUP BY recaudo_ncbt.cuenta,car_ppto_ing.situacion
";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

//printf("<br><br>SIN SITUACION <br>");

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
$cuenta2=$rowxx2["cuenta"];
$situacion2=$rowxx2["situacion"];
$total2=$rowxx2[total]/1000;

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta2','0','$total2')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());
//printf("$cuenta2 / $situacion2 / $total2 <br>");

}

//*****************
//*****************

$sqlxx = "
SELECT recaudo_rcgt.cuenta, car_ppto_ing.situacion, sum(recaudo_rcgt.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_rcgt ON car_ppto_ing.cod_pptal = recaudo_rcgt.cuenta 
WHERE recaudo_rcgt.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'C'
GROUP BY recaudo_rcgt.cuenta,car_ppto_ing.situacion
";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);

//printf("CON SITUACION <br><br>");

while($rowxx = mysql_fetch_array($resultadoxx))
{
$cuenta=$rowxx["cuenta"];
$situacion=$rowxx["situacion"];
$total=$rowxx[total]/1000;

//printf("$cuenta / $situacion / $total <br>");

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta','$total','0')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}


$sqlxx2 = "
SELECT recaudo_rcgt.cuenta, car_ppto_ing.situacion, sum(recaudo_rcgt.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_rcgt ON car_ppto_ing.cod_pptal = recaudo_rcgt.cuenta 
WHERE recaudo_rcgt.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'S'
GROUP BY recaudo_rcgt.cuenta,car_ppto_ing.situacion
";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

//printf("<br><br>SIN SITUACION <br>");

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
$cuenta2=$rowxx2["cuenta"];
$situacion2=$rowxx2["situacion"];
$total2=$rowxx2[total]/1000;

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta2','0','$total2')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());
//printf("$cuenta2 / $situacion2 / $total2 <br>");

}


//*****************
//*****************

$sqlxx = "
SELECT recaudo_roit.cuenta, car_ppto_ing.situacion, sum(recaudo_roit.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_roit ON car_ppto_ing.cod_pptal = recaudo_roit.cuenta 
WHERE recaudo_roit.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'C'
GROUP BY recaudo_roit.cuenta,car_ppto_ing.situacion
";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);

//printf("CON SITUACION <br><br>");

while($rowxx = mysql_fetch_array($resultadoxx))
{
$cuenta=$rowxx["cuenta"];
$situacion=$rowxx["situacion"];
$total=$rowxx[total]/1000;

//printf("$cuenta / $situacion / $total <br>");

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta','$total','0')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}


$sqlxx2 = "
SELECT recaudo_roit.cuenta, car_ppto_ing.situacion, sum(recaudo_roit.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_roit ON car_ppto_ing.cod_pptal = recaudo_roit.cuenta 
WHERE recaudo_roit.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'S'
GROUP BY recaudo_roit.cuenta,car_ppto_ing.situacion
";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

//printf("<br><br>SIN SITUACION <br>");

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
$cuenta2=$rowxx2["cuenta"];
$situacion2=$rowxx2["situacion"];
$total2=$rowxx2[total]/1000;

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta2','0','$total2')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());
//printf("$cuenta2 / $situacion2 / $total2 <br>");

}

//*****************
//*****************

$sqlxx = "
SELECT recaudo_tnat.cuenta, car_ppto_ing.situacion, sum(recaudo_tnat.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_tnat ON car_ppto_ing.cod_pptal = recaudo_tnat.cuenta 
WHERE recaudo_tnat.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'C'
GROUP BY recaudo_tnat.cuenta,car_ppto_ing.situacion
";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);

//printf("CON SITUACION <br><br>");

while($rowxx = mysql_fetch_array($resultadoxx))
{
$cuenta=$rowxx["cuenta"];
$situacion=$rowxx["situacion"];
$total=$rowxx[total]/1000;

//printf("$cuenta / $situacion / $total <br>");

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta','$total','0')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}


$sqlxx2 = "
SELECT recaudo_tnat.cuenta, car_ppto_ing.situacion, sum(recaudo_tnat.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_tnat ON car_ppto_ing.cod_pptal = recaudo_tnat.cuenta 
WHERE recaudo_tnat.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'S'
GROUP BY recaudo_tnat.cuenta,car_ppto_ing.situacion
";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

//printf("<br><br>SIN SITUACION <br>");

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
$cuenta2=$rowxx2["cuenta"];
$situacion2=$rowxx2["situacion"];
$total2=$rowxx2[total]/1000;

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta2','0','$total2')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());
//printf("$cuenta2 / $situacion2 / $total2 <br>");

}

///**************************************************     inicia municipio *******************************************************
if ($empresa =='MUNICIPIO DE IPIALES')
{


//*******************************************************************************************************************************

$sqlxx = "
SELECT recaudo_rica.cuenta, car_ppto_ing.situacion, sum(recaudo_rica.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_rica ON car_ppto_ing.cod_pptal = recaudo_rica.cuenta 
WHERE recaudo_rica.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'C'
GROUP BY recaudo_rica.cuenta,car_ppto_ing.situacion
";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);
//printf("CON SITUACION <br><br>");

while($rowxx = mysql_fetch_array($resultadoxx))
{
$cuenta=$rowxx["cuenta"];
$situacion=$rowxx["situacion"];
$total=$rowxx[total]/1000;

//printf("$cuenta / $situacion / $total <br>");

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta','$total','0')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}


$sqlxx2 = "
SELECT recaudo_rica.cuenta, car_ppto_ing.situacion, sum(recaudo_rica.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_rica ON car_ppto_ing.cod_pptal = recaudo_rica.cuenta 
WHERE recaudo_rica.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'S'
GROUP BY recaudo_rica.cuenta,car_ppto_ing.situacion
";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

//printf("<br><br>SIN SITUACION <br>");

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
$cuenta2=$rowxx2["cuenta"];
$situacion2=$rowxx2["situacion"];
$total2=$rowxx2[total]/1000;

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta2','0','$total2')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());
//printf("$cuenta2 / $situacion2 / $total2 <br>");

}

///**********************************************************************************************************************************************************


$sqlxx = "
SELECT recaudo_rica1.cuenta, car_ppto_ing.situacion, sum(recaudo_rica1.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_rica1 ON car_ppto_ing.cod_pptal = recaudo_rica1.cuenta 
WHERE recaudo_rica1.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'C'
GROUP BY recaudo_rica1.cuenta,car_ppto_ing.situacion
";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);

//printf("CON SITUACION <br><br>");

while($rowxx = mysql_fetch_array($resultadoxx))
{
$cuenta=$rowxx["cuenta"];
$situacion=$rowxx["situacion"];
$total=$rowxx[total]/1000;

//printf("$cuenta / $situacion / $total <br>");

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta','$total','0')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}


$sqlxx2 = "
SELECT recaudo_rica1.cuenta, car_ppto_ing.situacion, sum(recaudo_rica1.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_rica1 ON car_ppto_ing.cod_pptal = recaudo_rica1.cuenta 
WHERE recaudo_rica1.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'S'
GROUP BY recaudo_rica1.cuenta,car_ppto_ing.situacion
";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

//printf("<br><br>SIN SITUACION <br>");

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
$cuenta2=$rowxx2["cuenta"];
$situacion2=$rowxx2["situacion"];
$total2=$rowxx2[total]/1000;

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta2','0','$total2')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());
//printf("$cuenta2 / $situacion2 / $total2 <br>");

}

//*******************************************************************************************************************************



$sqlxx = "
SELECT recaudo_rica2.cuenta, car_ppto_ing.situacion, sum(recaudo_rica2.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_rica2 ON car_ppto_ing.cod_pptal = recaudo_rica2.cuenta 
WHERE recaudo_rica2.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'C'
GROUP BY recaudo_rica2.cuenta,car_ppto_ing.situacion
";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);

//printf("CON SITUACION <br><br>");

while($rowxx = mysql_fetch_array($resultadoxx))
{
$cuenta=$rowxx["cuenta"];
$situacion=$rowxx["situacion"];
$total=$rowxx[total]/1000;

//printf("$cuenta / $situacion / $total <br>");

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta','$total','0')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}


$sqlxx2 = "
SELECT recaudo_rica2.cuenta, car_ppto_ing.situacion, sum(recaudo_rica2.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_rica2 ON car_ppto_ing.cod_pptal = recaudo_rica2.cuenta 
WHERE recaudo_rica2.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'S'
GROUP BY recaudo_rica2.cuenta,car_ppto_ing.situacion
";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

//printf("<br><br>SIN SITUACION <br>");

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
$cuenta2=$rowxx2["cuenta"];
$situacion2=$rowxx2["situacion"];
$total2=$rowxx2[total]/1000;

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta2','0','$total2')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());
//printf("$cuenta2 / $situacion2 / $total2 <br>");

}

//*******************************************************************************************************************************



$sqlxx = "
SELECT recaudo_riip.cuenta, car_ppto_ing.situacion, sum(recaudo_riip.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_riip ON car_ppto_ing.cod_pptal = recaudo_riip.cuenta 
WHERE recaudo_riip.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'C'
GROUP BY recaudo_riip.cuenta,car_ppto_ing.situacion
";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);

//printf("CON SITUACION <br><br>");

while($rowxx = mysql_fetch_array($resultadoxx))
{
$cuenta=$rowxx["cuenta"];
$situacion=$rowxx["situacion"];
$total=$rowxx[total]/1000;

//printf("$cuenta / $situacion / $total <br>");

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta','$total','0')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}


$sqlxx2 = "
SELECT recaudo_riip.cuenta, car_ppto_ing.situacion, sum(recaudo_riip.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_riip ON car_ppto_ing.cod_pptal = recaudo_riip.cuenta 
WHERE recaudo_riip.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'S'
GROUP BY recaudo_riip.cuenta,car_ppto_ing.situacion
";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

//printf("<br><br>SIN SITUACION <br>");

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
$cuenta2=$rowxx2["cuenta"];
$situacion2=$rowxx2["situacion"];
$total2=$rowxx2[total]/1000;

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta2','0','$total2')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());
//printf("$cuenta2 / $situacion2 / $total2 <br>");

}

//*******************************************************************************************************************************



$sqlxx = "
SELECT recaudo_rtic.cuenta, car_ppto_ing.situacion, sum(recaudo_rtic.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_rtic ON car_ppto_ing.cod_pptal = recaudo_rtic.cuenta 
WHERE recaudo_rtic.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'C'
GROUP BY recaudo_rtic.cuenta,car_ppto_ing.situacion
";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);

//printf("CON SITUACION <br><br>");

while($rowxx = mysql_fetch_array($resultadoxx))
{
$cuenta=$rowxx["cuenta"];
$situacion=$rowxx["situacion"];
$total=$rowxx[total]/1000;

//printf("$cuenta / $situacion / $total <br>");

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta','$total','0')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}


$sqlxx2 = "
SELECT recaudo_rtic.cuenta, car_ppto_ing.situacion, sum(recaudo_rtic.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_rtic ON car_ppto_ing.cod_pptal = recaudo_rtic.cuenta 
WHERE recaudo_rtic.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'S'
GROUP BY recaudo_rtic.cuenta,car_ppto_ing.situacion
";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

//printf("<br><br>SIN SITUACION <br>");

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
$cuenta2=$rowxx2["cuenta"];
$situacion2=$rowxx2["situacion"];
$total2=$rowxx2[total]/1000;

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta2','0','$total2')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());
//printf("$cuenta2 / $situacion2 / $total2 <br>");

}

//*******************************************************************************************************************************



$sqlxx = "
SELECT recaudo_riur.cuenta, car_ppto_ing.situacion, sum(recaudo_riur.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_riur ON car_ppto_ing.cod_pptal = recaudo_riur.cuenta 
WHERE recaudo_riur.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'C'
GROUP BY recaudo_riur.cuenta,car_ppto_ing.situacion
";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);

//printf("CON SITUACION <br><br>");

while($rowxx = mysql_fetch_array($resultadoxx))
{
$cuenta=$rowxx["cuenta"];
$situacion=$rowxx["situacion"];
$total=$rowxx[total]/1000;

//printf("$cuenta / $situacion / $total <br>");

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta','$total','0')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}


$sqlxx2 = "
SELECT recaudo_riur.cuenta, car_ppto_ing.situacion, sum(recaudo_riur.vr_digitado) as total 
FROM car_ppto_ing 
INNER JOIN recaudo_riur ON car_ppto_ing.cod_pptal = recaudo_riur.cuenta 
WHERE recaudo_riur.fecha_recaudo <= '$corte' and car_ppto_ing.situacion = 'S'
GROUP BY recaudo_riur.cuenta,car_ppto_ing.situacion
";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

//printf("<br><br>SIN SITUACION <br>");

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
$cuenta2=$rowxx2["cuenta"];
$situacion2=$rowxx2["situacion"];
$total2=$rowxx2[total]/1000;

$sql = "INSERT INTO fut_aux_ing (fecha,cuenta,vr_efectivo,vr_sin_sit) VALUES ('$corte','$cuenta2','0','$total2')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());
//printf("$cuenta2 / $situacion2 / $total2 <br>");

}

//*******************************************************************************************************************************
}
//************************************************************** fin municipio **************************************************



//************* borro la tabla		
$tabla6="fut_aux_ing_ok";
$anadir6="DROP TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";

mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir6 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};

//********************crea tabla fut_aux_ing

$tabla7="fut_aux_ing_ok";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `id` int(11) NOT NULL auto_increment,
  `ctrl` varchar(200) NOT NULL default '',
  `cod_fut` varchar(200) NOT NULL default '',
  `ppto_aprob` decimal(20,2) NOT NULL default '0.00',
  `definitivo` decimal(20,2) NOT NULL default '0.00',
  `vr_efectivo` decimal(20,2) NOT NULL default '0.00',
  `vr_sin_sit` decimal(20,2) NOT NULL default '0.00',
  `acto_fut` varchar(200) NOT NULL default '',
  `num_acto_fut` varchar(200) NOT NULL default '',
  `porcentaje_fut` decimal(20,2) NOT NULL default '0.00',
  `vr_fut` decimal(20,2) NOT NULL default '0.00',
  `fuente` varchar(200) NOT NULL default '',
  `vigencia` varchar(200) NOT NULL default '',
   PRIMARY KEY  (`id`)
)TYPE=MyISAM AUTO_INCREMENT=1 ";
		
		mysql_select_db ($base, $conexion);

		if(mysql_query ($anadir7 ,$conexion)) 
		{
		echo "";
		}
		else
		{
		echo "";
		}
$sqlxx2 = "
SELECT car_ppto_ing.tip_dato, car_ppto_ing.cod_fut, car_ppto_ing.ppto_aprob, car_ppto_ing.definitivo, car_ppto_ing.acto_fut, car_ppto_ing.num_acto_fut, car_ppto_ing.porcentaje_fut, car_ppto_ing.vr_fut, car_ppto_ing.cod_pptal, car_ppto_ing.proc_rec, car_ppto_ing.vigencia, fut_aux_ing.cuenta

,sum(fut_aux_ing.vr_efectivo) as total1 
,sum(fut_aux_ing.vr_sin_sit) as total2 


FROM car_ppto_ing LEFT JOIN fut_aux_ing ON car_ppto_ing.cod_pptal = fut_aux_ing.cuenta
WHERE car_ppto_ing.tip_dato = 'D'
GROUP BY car_ppto_ing.cod_pptal
";

$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{

$cod_pptal=$rowxx2["cod_pptal"];//printf("cod_pptal : $cod_pptal <br>");
///******************

$link=mysql_connect($server,$dbuser,$dbpass);

$resulta=mysql_query("select SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE (fecha_adi <= '$corte') and cod_pptal LIKE '$cod_pptal%'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total_adi=$row[0]; 

$resulta2=mysql_query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE (fecha_adi <= '$corte') and cod_pptal LIKE '$cod_pptal%'",$link) or die (mysql_error());
$row2=mysql_fetch_row($resulta2);
$total_red=$row2[0];
//*******************
$tip_dato=$rowxx2["tip_dato"];//printf("tip_dato : $tip_dato <br>");
$cod_fut=$rowxx2["cod_fut"];//printf("cod_fut : $cod_fut <br>");
$ppto_aprob=round($rowxx2["ppto_aprob"]/1000);//printf("ppto_aprob : $ppto_aprob <br>");
$fuente=$rowxx2["proc_rec"];
$vigencia=$rowxx2["vigencia"];
$definitivo=($ppto_aprob) + round(($total_adi/1000)) - round(($total_red/1000));//printf("definitivo : $definitivo <br>");

$vr_efectivo=round($rowxx2[total1]);//printf("vr_efectivo : $vr_efectivo <br>");
$vr_sin_sit=round($rowxx2[total2]);//printf("vr_sin_sit : $vr_sin_sit <br>");

$acto_fut=$rowxx2["acto_fut"];//printf("acto_fut : $acto_fut <br>");
if($acto_fut == '')
{
$acto_fut='false';
}
else
{
$acto_fut='false';
}


//$num_acto_fut=$rowxx2["num_acto_fut"];
$num_acto_fut='NA';//printf("num_acto_fut : $num_acto_fut <br>");
$porcentaje_fut=$rowxx2["porcentaje_fut"];//printf("porcentaje_fut : $porcentaje_fut <br>");
$vr_fut=round($rowxx2["vr_fut"]);//printf("vr_fut : $vr_fut <br><br>");


//****** inseto en fut_aux_ing_ok

$sql = "INSERT INTO fut_aux_ing_ok (ctrl,cod_fut,ppto_aprob,definitivo,vr_efectivo,vr_sin_sit,acto_fut,num_acto_fut,porcentaje_fut,vr_fut,fuente,vigencia) VALUES ('D','$cod_fut','$ppto_aprob','$definitivo','$vr_efectivo','$vr_sin_sit','$acto_fut','$num_acto_fut','$porcentaje_fut','$vr_fut','$fuente','$vigencia')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());

}
}
?>
<br />
<center>
<div align="center" class="Titulotd" style="width:50%;padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">REPORTES CHIP - FORMATO UNICO TERRITORIAL A <?php echo $corte; ?></div>
<br />
<table border="1" align="center" cellpadding="2" cellspacing="0" class="bordepunteado1" width="50%">
<tr class="Titulotd">
	<td width="25%">Categor&iacute;a</td>
	<td colspan="3" width="75%">Formato</td>
    
</tr>
	<tr class="Estilo4">
		<td align="left">INGRESOS</td>
		<td align="left">Reporte Información</td>
		<td align="center"><a href="fut_ingresos_3.php"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>
	<tr class="Estilo4">
		<td align="left">INGRESOS</td>
		<td align="left">Transferencias Recibidas</td>
		<td align="center"><?php echo "<a href='fut_ingresos_t.php?corte=$corte'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>
	<tr class="Estilo4">
		<td align="left">GASTOS</td>
		<td align="left">Gastos de funcionamiento</td>
		<td align="center"><?php echo "<a href='fut_gastos_f2.php?corte=$corte&tipo=FUNCIONAMIENTO'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>
	<tr class="Estilo4">
		<td align="left">GASTOS</td>
		<td align="left">Transferencias comprometidas</td>
		<td align="center"><?php echo "<a href='fut_gastos_t.php?corte=$corte'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>
	<tr class="Estilo4">
		<td align="left">GASTOS</td>
		<td align="left">Gastos de Inversión</td>
		<td align="center"><?php echo "<a href='fut_gastos_f2.php?corte=$corte&tipo=INVERSION'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>
    <tr class="Estilo4">
		<td align="left">RESERVAS</td>
		<td align="left">Ingresos para reservas</td>
		<td align="center"><?php echo "<a href='fut_ingresos_4.php?corte=$corte'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>

	<tr class="Estilo4">
		<td align="left">RESERVAS</td>
		<td align="left">Reporte Reservas Presupuestales</td>
		<td align="center"><?php echo "<a href='fut_reserva.php?corte=$corte'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>
	<tr class="Estilo4">
		<td align="left">GASTOS</td>
		<td align="left">Reporte Cuentas Por Pagar</td>
		<td align="center"><?php echo "<a href='fut_cxp.php?corte=$corte'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
 		<td></td>
    </tr>
	<tr class="Estilo4">
		<td align="left">FONDO LOCAL</td>
		<td align="left">Ejecución Presupuestal</td>
		<td align="center"><?php echo "<a href='fut_fls_ejec.php?corte=$corte&tipo=EJECUCION_PRESUPUESTAL'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>
	</tr>
	<tr class="Estilo4">
		<td align="left">FONDO LOCAL</td>
		<td align="left">Ejecución Tesoreria</td>
		<td align="center"><?php echo "<a href='fut_fls_tes.php?corte=$corte&tipo=REPORTE_FLS_TESORERIA'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td align="center"><a href="fls_tesoreria/upload.php">Acumular</a></td>
    </tr>
	<tr class="Estilo4">
		<td align="left">CABILDO INDIGENA</td>
		<td align="left">Ejecución Ingresos</td>
		<td align="center"><?php echo "<a href='cabildos_ingresos.php?corte=$corte'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>
	<tr class="Estilo4">
		<td align="left">CABILDO INDIGENA</td>
		<td align="left">Ejecución Gastos</td>
		<td align="center"><?php echo "<a href='cabildos_gastos.php?corte=$corte'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>
    
  	<tr class="Estilo4">
		<td align="left">EXEDENTES DE LIQUIDES</td>
		<td align="left">Saldos disponibles</td>
		<td align="center"><?php echo "<a href='fut_exedentes_sal.php?corte=$corte&tipo=SALDOS_DISPONIBLES'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>
    
      	<tr class="Estilo4">
		<td align="left">SGR</td>
		<td align="left">Ejecuci&oacute;n de ingresos</td>
		<td align="center"><?php echo "<a href='fut_ingresos_5.php?corte=$corte&tipo=SALDOS_DISPONIBLES'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>

<tr class="Estilo4">
		<td align="left">SGR</td>
		<td align="left">Ejecuci&oacute;n de gastos</td>
		<td align="center"><?php echo "<a href='fut_gastos_f2.php?corte=$corte&tipo=REGALIAS'><img src='../simbolos/fuentes/reporte.jpg' border='0' width='18px' /></a>";?></td>
		<td></td>
    </tr>


</table>
</center>
<br />
<br />
<div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
		 	<div align="center">
		 		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
                	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
                  		<div align="center" class="Estilo6"><a href='fut_ingresos.php' target='_parent' class="sidebar2">VOLVER</a>
				 		</div>
		        	</div>
        	    </div>      
			</div>
</div>
</body>
</html>