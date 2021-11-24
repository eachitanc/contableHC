<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<title>CONTAFACIL</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: underline;
	color: #666666;
}
a:active {
	text-decoration: none;
	color: #666666;
}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
.Estilo8 {color: #FFFFFF}
-->
</style>

<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
.Estilo9 {
	color: #FF0000;
	font-weight: bold;
}
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo9 {font-weight: bold}
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo15 {color: #000000}
.Estilo17 {font-weight: bold}
.Estilo18 {	color: #FF0000;
	font-weight: bold;
}
.Estilo18 {font-weight: bold}
-->
</style>
<body>
<div align="center">
<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
</div>
<br />
<br />
<?
$corte=$_GET['corte'];
$tipo=$_GET['tipo'];


include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

//************* borro la tabla		
$tabla6="fut_aux_gasf";
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

$tabla7="fut_aux_gasf";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `id` int(11) NOT NULL auto_increment,
  `fecha` varchar(100) NOT NULL default '',
  `cuenta` varchar(100) NOT NULL default '',
  `comprometido` decimal(20,2) NOT NULL default '0.00',
  `obligado` decimal(20,2) NOT NULL default '0.00',
  `pagado` decimal(20,2) NOT NULL default '0.00',
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
//*****************

$sqlxx = "select sum(vr_digitado) as total, fecha_crpp, cuenta from crpp where fecha_crpp <= '$corte' group by cuenta";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $fecha_crpp=$corte;
  $cuenta_crpp=$rowxx["cuenta"];
  $comprometido_crpp=$rowxx[total]/1000;
  
  //printf("$fecha_crpp / $cuenta_crpp / $comprometido_crpp<br>");
  
  	$sql = "INSERT INTO fut_aux_gasf (fecha,cuenta,comprometido,obligado,pagado) VALUES ('$fecha_crpp','$cuenta_crpp','$comprometido_crpp','0','0')";
	mysql_db_query($database, $sql, $conexion) or die(mysql_error());
  
}

//*****************
//*****************

$sqlxx = "select sum(vr_digitado) as total, fecha_cobp, cuenta from cobp where fecha_cobp <= '$corte' group by cuenta";
$resultadoxx = mysql_db_query($database, $sqlxx, $conexion);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $fecha_cobp=$corte;
  $cuenta_cobp=$rowxx["cuenta"];
  $obligado_cobp=$rowxx[total]/1000;
  
  //printf("$fecha_crpp / $cuenta_crpp / $comprometido_crpp<br>");
  
  	$sql = "INSERT INTO fut_aux_gasf (fecha,cuenta,comprometido,obligado,pagado) VALUES ('$fecha_cobp','$cuenta_cobp','0','$obligado_cobp','0')";
	mysql_db_query($database, $sql, $conexion) or die(mysql_error());
  
}

//*****************
//*****************


$sqlceva = "
SELECT SUM(cobp.vr_digitado) AS total, cobp.cuenta, ceva.fecha_ceva 
FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp 
WHERE ceva.fecha_ceva <= '$corte'
GROUP BY cobp.cuenta";
$resultadoxx = mysql_db_query($database, $sqlceva, $conexion);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $fecha_ceva=$corte;
  $cuenta_ceva=$rowxx["cuenta"];
  $pagado_ceva=$rowxx[total]/1000;
  
  //printf("$fecha_crpp / $cuenta_crpp / $comprometido_crpp<br>");
  
  	$sql = "INSERT INTO fut_aux_gasf (fecha,cuenta,comprometido,obligado,pagado) VALUES ('$fecha_ceva','$cuenta_ceva','0','0','$pagado_ceva')";
	mysql_db_query($database, $sql, $conexion) or die(mysql_error());
  
}

$sqlceva_ac = "
SELECT SUM(cobp.vr_digitado) AS total, cobp.cuenta, ceva.fecha_ceva 
FROM cobp INNER JOIN ceva ON cobp.ceva = ceva.id_auto_ceva
WHERE ceva.fecha_ceva <= '$corte'
GROUP BY cobp.cuenta";
$resultadoxx_ac = mysql_db_query($database, $sqlceva_ac, $conexion);

while($rowxx_ac = mysql_fetch_array($resultadoxx_ac)) 
{
  $fecha_ceva=$corte;
  $cuenta_ceva_ac=$rowxx_ac["cuenta"];
  $pagado_ceva_ac=$rowxx_ac[total]/1000;
  
  //printf("$fecha_crpp / $cuenta_crpp / $comprometido_crpp<br>");
  
  	$sql = "INSERT INTO fut_aux_gasf (fecha,cuenta,comprometido,obligado,pagado) VALUES ('$fecha_ceva','$cuenta_ceva_ac','0','0','$pagado_ceva_ac')";
	mysql_db_query($database, $sql, $conexion) or die(mysql_error());
  
}

///***********************
///***********************
///***********************


//************* borro la tabla		
$tabla6="fut_aux_gasf_ok";
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

$tabla7="fut_aux_gasf_ok";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `id` int(11) NOT NULL auto_increment,
  `ctrl` varchar(200) NOT NULL default '',
  `cod_fut` varchar(200) NOT NULL default '',
  `ent_eje` varchar(200) NOT NULL default '',
  `fuente_rec` varchar(200) NOT NULL default '',
  `ppto_aprob` decimal(20,2) NOT NULL default '0.00',
  `definitivo` decimal(20,2) NOT NULL default '0.00',
  `compromisos` decimal(20,2) NOT NULL default '0.00',
  `obligado` decimal(20,2) NOT NULL default '0.00',
  `pagado` decimal(20,2) NOT NULL default '0.00',
  `tip_acto_adtvo` varchar(200) NOT NULL default '',
  `num_acto_adtvo` varchar(200) NOT NULL default '',
  `fecha_acto_adtvo` varchar(200) NOT NULL default '',
  `cod_ser_deuda` varchar(200) NOT NULL default '',
  `proc_rec` varchar(200) NOT NULL default '',
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

if($tipo == 'FUNCIONAMIENTO' or $tipo == 'INVERSION')
{
$sqlxx2 = "
SELECT car_ppto_gas.tip_dato, car_ppto_gas.cod_fut, car_ppto_gas.ppto_aprob, car_ppto_gas.cod_pptal, car_ppto_gas.unidad_ejecutora, car_ppto_gas.fuentes_recursos , car_ppto_gas.opc1,car_ppto_gas.vigencia,car_ppto_gas.cod_ser_deuda,car_ppto_gas.proc_rec

,sum(fut_aux_gasf.comprometido) as total1 
,sum(fut_aux_gasf.obligado) as total2 
,sum(fut_aux_gasf.pagado) as total3

FROM car_ppto_gas LEFT JOIN fut_aux_gasf ON car_ppto_gas.cod_pptal = fut_aux_gasf.cuenta
WHERE car_ppto_gas.tip_dato = 'D' and (car_ppto_gas.opc1 = '$tipo' or (car_ppto_gas.opc1 = 'SERVICIO_DEUDA' and  car_ppto_gas.proc_rec ='S')) 
GROUP BY car_ppto_gas.cod_pptal
";
}

if($tipo == 'RESERVAS')
{
$sqlxx2 = "
SELECT car_ppto_gas.tip_dato, car_ppto_gas.cod_fut, car_ppto_gas.ppto_aprob, car_ppto_gas.cod_pptal, car_ppto_gas.unidad_ejecutora, car_ppto_gas.fuentes_recursos , car_ppto_gas.opc1,car_ppto_gas.vigencia,car_ppto_gas.cod_ser_deuda

,sum(fut_aux_gasf.comprometido) as total1 
,sum(fut_aux_gasf.obligado) as total2 
,sum(fut_aux_gasf.pagado) as total3

FROM car_ppto_gas LEFT JOIN fut_aux_gasf ON car_ppto_gas.cod_pptal = fut_aux_gasf.cuenta
WHERE car_ppto_gas.tip_dato = 'D' and car_ppto_gas.vigencia = 'ANTERIOR'
GROUP BY car_ppto_gas.fuentes_recursos,car_ppto_gas.cod_ser_deuda
";
}

if($tipo == 'REGALIAS')
{
	
$sqlxx2 = "
SELECT car_ppto_gas.tip_dato, car_ppto_gas.cod_fut, car_ppto_gas.ppto_aprob, car_ppto_gas.cod_pptal, car_ppto_gas.unidad_ejecutora, car_ppto_gas.fuentes_recursos , car_ppto_gas.opc1,car_ppto_gas.vigencia,car_ppto_gas.nom_rubro,car_ppto_gas.proc_rec

,sum(fut_aux_gasf.comprometido) as total1 
,sum(fut_aux_gasf.obligado) as total2 
,sum(fut_aux_gasf.pagado) as total3

FROM car_ppto_gas LEFT JOIN fut_aux_gasf ON car_ppto_gas.cod_pptal = fut_aux_gasf.cuenta
WHERE car_ppto_gas.tip_dato = 'D' and car_ppto_gas.opc1 = 'INVERSION'
GROUP BY car_ppto_gas.cod_pptal

";
}
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{

$ctrl='D';
$cod_fut=$rowxx2["cod_fut"];
$ent_eje=$rowxx2["unidad_ejecutora"];
$fuente_rec=$rowxx2["fuentes_recursos"];
$ppto_aprob=round($rowxx2["ppto_aprob"]/1000);
$proc_rec=$rowxx2["proc_rec"];
///******************
$cod_pptal=$rowxx2["cod_pptal"];//printf("cod_pptal : $cod_pptal <br>");

$link=mysql_connect($server,$dbuser,$dbpass);

$resulta=mysql_query("select SUM(valor_adi) AS TOTAL from adi_ppto_gas WHERE (fecha_adi <= '$corte') and cod_pptal LIKE '$cod_pptal%'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total_adi=$row[0]; 

$resulta2=mysql_query("select SUM(valor_adi) AS TOTAL from red_ppto_gas WHERE (fecha_adi <= '$corte') and cod_pptal LIKE '$cod_pptal%'",$link) or die (mysql_error());
$row2=mysql_fetch_row($resulta2);
$total_red=$row2[0];

$resulta3=mysql_query("select SUM(valor_adi) AS TOTAL from creditos WHERE (fecha_adi <= '$corte') and cod_pptal LIKE '$cod_pptal%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$total_cre=$row3[0];

$resulta4=mysql_query("select SUM(valor_adi) AS TOTAL from contracreditos WHERE (fecha_adi <= '$corte') and cod_pptal LIKE '$cod_pptal%'",$link) or die (mysql_error());
$row4=mysql_fetch_row($resulta4);
$total_ccre=$row4[0];


$definitivo=($ppto_aprob) + round(($total_adi/1000)) - round(($total_red/1000)) + round(($total_cre/1000)) - round(($total_ccre/1000));

//*******************

$compromisos=round($rowxx2[total1]);//printf("vr_efectivo : $vr_efectivo <br>");
$obligado=round($rowxx2[total2]);//printf("vr_sin_sit : $vr_sin_sit <br>");
$pagado=round($rowxx2[total3]);//printf("vr_sin_sit : $vr_sin_sit <br>");


//******************* inf de reservas

$tip_acto_adtvo='';
$num_acto_adtvo='';
$fecha_acto_adtvo='';

$cod_ser_deuda=$rowxx2["cod_ser_deuda"];
if ($tipo =='REGALIAS')
{
$cod_ser_deuda=$rowxx2["nom_rubro"];
}

$cod=$rowxx2[opc1];
//****** inseto en fut_aux_gasf_ok
$sql = "INSERT INTO fut_aux_gasf_ok (ctrl,cod_fut,ent_eje,fuente_rec,ppto_aprob,definitivo,compromisos,obligado,pagado,tip_acto_adtvo,num_acto_adtvo,fecha_acto_adtvo,cod_ser_deuda,proc_rec) 
VALUES 
('$ctrl','$cod_fut','$ent_eje','$fuente_rec','$ppto_aprob','$definitivo','$compromisos','$obligado','$pagado','$tip_acto_adtvo','$num_acto_adtvo','$fecha_acto_adtvo','$cod','$proc_rec')";
mysql_db_query($database, $sql, $conexion) or die(mysql_error());
}
printf("
<div align='center'>
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='fut_ingresos_2.php?corte=$corte' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
");
?>

<?
if($tipo != 'RESERVAS')
{
?>

<form id="form1" name="form1" method="post">
  <div align="center" class="Estilo4"><strong>GENERAR INFORME DE <? printf("$tipo");?></strong><br />
<input type="hidden" name="tipo" value="<? printf("$tipo");?>" />
	<br />
	<br />
	<input name="Submit" type="submit" class="Estilo4" value="Generar Informe" onClick="this.form.action = 'fut_gastos_f3.php'">
  </div>
</form>
<?
}
else
{
?>
<form id="form1" name="form1" method="post">
  <div align="center" class="Estilo4"><strong>GENERAR INFORME DE RESERVAS</strong><br />
<input type="hidden" name="tipo" value="<? printf("$tipo");?>" />
	<br />
	<br />
	<input name="Submit" type="submit" class="Estilo4" value="Generar Informe" onClick="this.form.action = 'fut_gastos_f3.php'">
  </div>
</form>
<? 
}
?>

<?
}
?>