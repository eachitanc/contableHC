<?
set_time_limit(7200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<title>CONTAFACIL</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" >
<style type="text/css">
<!--
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
-->
</style>

<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<?
$corte=$_POST['corte'];


include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

//************* borro la tabla		
$tabla6="cgr_aux_gas";
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

$tabla7="cgr_aux_gas";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(

  `id` int(11) NOT NULL auto_increment,
  `fecha` varchar(100) NOT NULL default '',
  `cuenta` varchar(100) NOT NULL default '',
  `adiciones` decimal(20,2) NOT NULL default '0.00',
  `reducciones` decimal(20,2) NOT NULL default '0.00',
  `creditos` decimal(20,2) NOT NULL default '0.00',
  `contracreditos` decimal(20,2) NOT NULL default '0.00',
  `cdpp` decimal(20,2) NOT NULL default '0.00',
  `cdpp_r` decimal(20,2) NOT NULL default '0.00',
  `crpp_r` decimal(20,2) NOT NULL default '0.00',
  `obligaciones` decimal(20,2) NOT NULL default '0.00',
  `obligaciones_r` decimal(20,2) NOT NULL default '0.00',
  `pagos` decimal(20,2) NOT NULL default '0.00',
  `con_comp` decimal(20,2) NOT NULL default '0.00',
  `sin_comp` decimal(20,2) NOT NULL default '0.00',
  
  
   PRIMARY KEY  (`id`)
)TYPE=MyISAM AUTO_INCREMENT=1 COLLATE=latin1_general_ci";
		
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

include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from car_ppto_gas where tip_dato = 'D' order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);

while($rw = mysql_fetch_array($re)) 
{
	
	$link=mysql_connect($server,$dbuser,$dbpass);
	//****
	$cod=$rw["cod_pptal"];
	//****
	$resulta=mysql_query("select SUM(valor_adi) AS TOTAL from adi_ppto_gas WHERE (fecha_adi <= '$corte' ) and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row=mysql_fetch_row($resulta);
	$total_adi=$row[0]; 
	//****
	$resulta2=mysql_query("select SUM(valor_adi) AS TOTAL from red_ppto_gas WHERE (fecha_adi <= '$corte' ) and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row2=mysql_fetch_row($resulta2);
	$total_red=$row2[0];
	//****
	$resulta3=mysql_query("select SUM(valor_adi) AS TOTAL from creditos WHERE (fecha_adi <= '$corte' ) and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_cre=$row3[0];
	
	$resulta4=mysql_query("select SUM(valor_adi) AS TOTAL from contracreditos WHERE (fecha_adi <= '$corte' ) and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ccre=$row4[0];
	
	//*** OBLIGACIONES
	
	
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from cobp WHERE (fecha_cobp <= '$corte' ) and cuenta LIKE '$cod%' and vr_digitado <> '0' and liq =''",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$obligaciones=$row7[0];
	
		
	$resulta77=mysql_query("select SUM(vr_digitado) AS TOTAL from cobp WHERE (fecha_cobp <= '$corte' ) and cuenta LIKE '$cod%' and vr_digitado <> '0' and liq <>''",$link) or die (mysql_error());
	$row77=mysql_fetch_row($resulta77);
	$obligaciones_r=$row77[0]*-1;

//*** PAGOS

	
	$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva <= '$corte' ) AND cobp.cuenta LIKE '$cod%' AND cobp.vr_digitado <> '0' ",$link) or die (mysql_error());
	$row8=mysql_fetch_row($sqlceva);
	$pagos1=$row8[0];
	
	$sq33 =  mysql_query("select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva <= '$corte') AND cobp.cuenta LIKE '$cod%' AND cobp.vr_digitado <> '0' AND cobp.pagado ='SI'",$link) or die (mysql_error());
	$rw33 = mysql_fetch_array ($sq33);
	$total_ceva_acum = $rw33['total2'];

	$pagos = $pagos1 + $total_ceva_acum;
//**** CDPP
	
	$resulta5=mysql_query("select SUM(valor) AS TOTAL from cdpp WHERE (fecha_reg <= '$corte' ) and cuenta LIKE '$cod%' and liq1 =''",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$cdpp=$row5[0];
	// LIQUIDADOS	
	$resulta55=mysql_query("select SUM(valor) AS TOTAL from cdpp WHERE (fecha_reg <= '$corte' ) and cuenta LIKE '$cod%' and liq1 <>''",$link) or die (mysql_error());
	$row55=mysql_fetch_row($resulta55);
	$cdpp_r=$row55[0]*-1;

//**** COMPROMETIDO

	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from crpp WHERE (fecha_crpp <= '$corte' ) and cuenta LIKE '$cod%' and vr_digitado <> '0' and pago = 'ANTICIPO' and liq1 =''" ,$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$con_comp=$row6[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from crpp WHERE (fecha_crpp <= '$corte' ) and cuenta LIKE '$cod%' and vr_digitado <> '0' and pago <> 'ANTICIPO' and liq1 =''",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$sin_comp=$row6[0];
	
	$resulta66=mysql_query("select SUM(vr_digitado) AS TOTAL from crpp WHERE (fecha_crpp <= '$corte' ) and cuenta LIKE '$cod%' and vr_digitado <> '0' and pago <> 'ANTICIPO' and liq1 <>''",$link) or die (mysql_error());
	$row66=mysql_fetch_row($resulta66);
	$crpp_r=$row66[0]*-1;
	//****
	
	$sql = "
	INSERT INTO cgr_aux_gas (fecha,cuenta,adiciones,reducciones,creditos,contracreditos,cdpp,cdpp_r,obligaciones,pagos,con_comp,sin_comp,crpp_r,obligaciones_r) 
	VALUES
	('$corte','$cod','$total_adi','$total_red','$total_cre','$total_ccre','$cdpp','$cdpp_r','$obligaciones','$pagos','$con_comp','$sin_comp','$crpp_r','$obligaciones_r')";
	mysql_db_query($database, $sql, $conexion) or die(mysql_error());
}




//**********************
//**********************
//************* borro la tabla		
$tabla6="cgr_aux_gas_ok";
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

$tabla7="cgr_aux_gas_ok";
$anadir7="CREATE TABLE ";
$anadir7.=$tabla7;
$anadir7.="
(
`id` int(11) NOT NULL auto_increment,
`dep` varchar(200) NOT NULL default '',
`ctrl` varchar(200) NOT NULL default '',
`cod_cgr` varchar(200) NOT NULL default '',
`vig_gasto` varchar(200) NOT NULL default '',
`unidad_ejec` varchar(200) NOT NULL default '',
`cod_rec` varchar(200) NOT NULL default '',
`oer` varchar(200) NOT NULL default '',
`cda` varchar(200) NOT NULL default '',
`finalidad_gasto` varchar(200) NOT NULL default '',
`ppto_aprob` decimal(20,2) NOT NULL default '0.00',
`sum_adiciones` decimal(20,2) NOT NULL default '0.00',
`sum_reducciones` decimal(20,2) NOT NULL default '0.00',
`cancelaciones` decimal(20,2) NOT NULL default '0.00',
`sum_creditos` decimal(20,2) NOT NULL default '0.00',
`sum_contracreditos` decimal(20,2) NOT NULL default '0.00',
`sum_aplazamientos` decimal(20,2) NOT NULL default '0.00',
`sum_desaplazamientos` decimal(20,2) NOT NULL default '0.00',
`definitivo` decimal(20,2) NOT NULL default '0.00',
`suma_cdpp` decimal(20,2) NOT NULL default '0.00',
`reversion_cdpp` decimal(20,2) NOT NULL default '0.00',
`sit_fondos` varchar(200) NOT NULL default '',
`num_compromisos` varchar(200) NOT NULL default '',
`num_obligaciones` varchar(200) NOT NULL default '',
`num_pagos` varchar(200) NOT NULL default '',
`ent_recip` varchar(200) NOT NULL default '',
`sum_comprom_con_anti` decimal(20,2) NOT NULL default '0.00',
`sum_comprom_sin_anti` decimal(20,2) NOT NULL default '0.00',
`reversion_gastos_compro` decimal(20,2) NOT NULL default '0.00',
`sum_obligacion` decimal(20,2) NOT NULL default '0.00',
`rever_gastos_obligados` decimal(20,2) NOT NULL default '0.00',
`pagos` decimal(20,2) NOT NULL default '0.00',
`anulacion_pagos` decimal(20,2) NOT NULL default '0.00',
`adi_pac` decimal(20,2) NOT NULL default '0.00',
`red_pac` decimal(20,2) NOT NULL default '0.00',
`anticipos_pac` decimal(20,2) NOT NULL default '0.00',
`aplazamientos_pac` decimal(20,2) NOT NULL default '0.00',
`pac_definitivo` decimal(20,2) NOT NULL default '0.00',
`saldo_x_eje` decimal(20,2) NOT NULL default '0.00',






PRIMARY KEY  (`id`)
)TYPE=MyISAM AUTO_INCREMENT=1 COLLATE=latin1_general_ci";

mysql_select_db ($base, $conexion);

if(mysql_query ($anadir7 ,$conexion)) 
{
echo "";
}
else
{
echo "";
}
//**********************
//**********************

$ctrl ='D';
$cancelaciones ='0';
$sum_aplazamientos ='0';
$sum_desaplazamientos ='0';
$definitivo ='';
$reversion_gastos_compro ='0';
$rever_gastos_obligados ='0';
$anulacion_pagos ='0';
$anticipos ='0';
$dep='07';



$sqlxx2 = "SELECT 

car_ppto_gas.cod_cgr, 
car_ppto_gas.vigencia_gasto, 
car_ppto_gas.cod_rec, 
car_ppto_gas.oer,
car_ppto_gas.cda, 
car_ppto_gas.finalidad_gasto, 
sum(car_ppto_gas.ppto_aprob) as tx,
sum(cgr_aux_gas.adiciones) as total1 ,
sum(cgr_aux_gas.reducciones) as total2 ,
sum(cgr_aux_gas.creditos) as total3 ,
sum(cgr_aux_gas.contracreditos) as total4 ,

sum(cgr_aux_gas.cdpp) as total5 ,
sum(cgr_aux_gas.cdpp_r) as total20 ,
sum(cgr_aux_gas.obligaciones) as total6 ,
sum(cgr_aux_gas.obligaciones_r) as total22 ,

sum(cgr_aux_gas.pagos) as total7 ,

sum(cgr_aux_gas.con_comp) as total8 ,
sum(cgr_aux_gas.sin_comp) as total9 ,
sum(cgr_aux_gas.crpp_r) as total21 ,


car_ppto_gas.situacion,
car_ppto_gas.uni_ejec_cgr,
car_ppto_gas.ent_recip,
car_ppto_gas.tip_dato, 
car_ppto_gas.cod_pptal, 
cgr_aux_gas.cuenta

FROM car_ppto_gas LEFT JOIN cgr_aux_gas ON car_ppto_gas.cod_pptal = cgr_aux_gas.cuenta

WHERE car_ppto_gas.tip_dato = 'D'

GROUP BY car_ppto_gas.cod_cgr,car_ppto_gas.vigencia_gasto,car_ppto_gas.cod_rec, car_ppto_gas.oer, car_ppto_gas.cda, car_ppto_gas.finalidad_gasto
";

$resultadoxx2 = mysql_db_query($database, $sqlxx2, $conexion);

while($rowxx2 = mysql_fetch_array($resultadoxx2))
{
	
	$cod = $rowxx2["cod_pptal"];
	//***
	$cod_cgr  = $rowxx2["cod_cgr"]; 
	//***
	$vig_gasto  = $rowxx2["vigencia_gasto"]; 
	//if($ctrl_vig_gasto == 'ACTUAL')
	//$vig_gasto='1';}else{$vig_gasto='2';}
	//***
	$cod_rec  = $rowxx2["cod_rec"];  
	$oer  = $rowxx2["oer"];   
	$cda  = $rowxx2["cda"];   
	$finalidad_gasto  = $rowxx2["finalidad_gasto"];   
	$uni_ejec_cgr  = $rowxx2["uni_ejec_cgr"]; 
	$ppto_aprob   = number_format($rowxx2[tx],0,'','');  
	$sum_adiciones = number_format($rowxx2[total1],0,'',''); 
	$sum_reducciones = number_format($rowxx2[total2],0,'',''); 
	$sum_creditos = number_format($rowxx2[total3],0,'','');  
	$sum_contracreditos = number_format($rowxx2[total4],0,'',''); 
	$suma_cdpp = number_format($rowxx2[total5],0,'',''); 
	$reversion_cdpp = number_format($rowxx2[total20],0,'',''); 
	$sum_obligacion = number_format($rowxx2[total6],0,'',''); 
	$pagos = number_format($rowxx2[total7],0,'',''); 
	
	
	$sum_comprom_con_anti = number_format($rowxx2[total8],0,'',''); 
	$sum_comprom_sin_anti = number_format($rowxx2[total9],0,'',''); 
	$reversion_gastos_compro = number_format($rowxx2[total21],0,'',''); 
	$rever_gastos_obligados = number_format($rowxx2[total22],0,'',''); 
	//****
	$sit_fondos = $rowxx2["situacion"];  
	//***
	$resulta4=mysql_query("
	SELECT COUNT(DISTINCT(id_manu_crpp)) 
	FROM crpp JOIN car_ppto_gas ON car_ppto_gas.cod_pptal = crpp.cuenta
	WHERE car_ppto_gas.cod_cgr = '$cod_cgr'
	GROUP BY car_ppto_gas.cod_cgr
	",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$num_compromisos=$row4[0];
	//***
	$resulta4=mysql_query("
	SELECT COUNT(DISTINCT(id_manu_cobp)) 
	FROM cobp JOIN car_ppto_gas ON car_ppto_gas.cod_pptal = cobp.cuenta
	WHERE car_ppto_gas.cod_cgr = '$cod_cgr'
	GROUP BY car_ppto_gas.cod_cgr
	",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$num_obligaciones =$row4[0];
	//***
	$resulta4=mysql_query("
	SELECT COUNT(DISTINCT(id_manu_cobp)) 
	FROM cobp JOIN car_ppto_gas ON car_ppto_gas.cod_pptal = cobp.cuenta
	WHERE car_ppto_gas.cod_cgr = '$cod_cgr' and pagado = 'SI'
	GROUP BY car_ppto_gas.cod_cgr
	",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$num_pagos =$row4[0];
	//***
	$ent_recip = $rowxx2["ent_recip"];
	//*** 
	
	
	
	/*$resulta4=mysql_query("
	SELECT sum(crpp.vr_digitado) as tot_con_a
	FROM car_ppto_gas INNER JOIN crpp ON car_ppto_gas.cod_pptal = crpp.cuenta
	WHERE car_ppto_gas.cod_cgr = '$cod_cgr' and pago = 'ANTICIPO' and crpp.fecha_crpp <= '$corte'
	GROUP BY car_ppto_gas.cod_cgr
	",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$sum_comprom_con_anti=$row4[0];
	
	//***
	$resulta4=mysql_query("
	SELECT sum(crpp.vr_digitado) as tot_sin_a
	FROM car_ppto_gas INNER JOIN crpp ON car_ppto_gas.cod_pptal = crpp.cuenta
	WHERE car_ppto_gas.cod_cgr = '$cod_cgr' and pago <> 'ANTICIPO' and crpp.fecha_crpp <= '$corte'
	GROUP BY car_ppto_gas.cod_cgr
	",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$sum_comprom_sin_anti=$row4[0];*/
	 
	
	//***** seccion pac
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from pac_gastos where cod_pptal = '$cod' group by cod_pptal";
	$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
	while($rowxx = mysql_fetch_array($resultadoxx)) 
	{
		$adi_pac=number_format($rowxx["suma_adi"],0,'',''); 
		$red_pac=number_format($rowxx["suma_red"],0,'',''); 
		
		$anticipos_pac='0';
		$aplazamientos_pac='0';
		$pac_definitivo=$ppto_aprob+$adi_pac-$red_pac;
		//$saldo_x_eje=$pac_definitivo-$pagos;
		
		//printf("adi : $adi_pac <br>red : $red_pac <br>definitivo : $pac_definitivo <br>saldo : $saldo_x_eje <br><br>");
		
	}
	
	
	 
	 
	 
	
	//****** inserto en cgr_aux_gas_ok
	
	$sql = "INSERT INTO cgr_aux_gas_ok 
	
	(ctrl,cod_cgr,vig_gasto,cod_rec,oer,cda,finalidad_gasto,unidad_ejec,ppto_aprob,sum_adiciones,sum_reducciones,cancelaciones,sum_creditos,sum_contracreditos,sum_aplazamientos,sum_desaplazamientos,definitivo,suma_cdpp,reversion_cdpp,sit_fondos,num_compromisos,num_obligaciones,num_pagos,ent_recip,sum_comprom_con_anti,sum_comprom_sin_anti,reversion_gastos_compro,sum_obligacion,rever_gastos_obligados,pagos,anulacion_pagos,adi_pac,red_pac,anticipos_pac,aplazamientos_pac,pac_definitivo,saldo_x_eje,dep)
	VALUES 
	('$ctrl','$cod_cgr','$vig_gasto','$cod_rec','$oer','$cda','$finalidad_gasto','$uni_ejec_cgr','$ppto_aprob','$sum_adiciones','$sum_reducciones','$cancelaciones','$sum_creditos','$sum_contracreditos','$sum_aplazamientos','$sum_desaplazamientos','$definitivo','$suma_cdpp','$reversion_cdpp','$sit_fondos','$num_compromisos','$num_obligaciones','$num_pagos','$ent_recip','$sum_comprom_con_anti','$sum_comprom_sin_anti','$reversion_gastos_compro','$sum_obligacion','$rever_gastos_obligados','$pagos','$anulacion_pagos','$adi_pac','$red_pac','$anticipos_pac','$aplazamientos_pac','$pac_definitivo','$saldo_x_eje','$dep')";
	
	mysql_db_query($database, $sql, $conexion) or die(mysql_error());
}

// consulta cuentas por pagar
$sq3 = "select * from cxp where tip_dato = 'D' order by cod_pptal asc ";
$re3 = mysql_db_query($database, $sq3, $cx);

while($rw3 = mysql_fetch_array($re3)) 
{
	$sq4 ="select sum(valor) as pag_cxp from cecp_cuenta where cuenta = '$rw3[cod_pptal]'";
	$re4 = mysql_db_query($database, $sq4, $cx);
	$rw4 = mysql_fetch_array($re4);
	
	$sq5 ="select * from cecp_cuenta where cuenta = '$rw3[cod_pptal]'";
	$re5 = mysql_db_query($database, $sq5, $cx);
	$fil = mysql_num_rows($re5);

	
	$sql = "INSERT INTO cgr_aux_gas_ok 
	
	(ctrl,cod_cgr,vig_gasto,cod_rec,oer,cda,finalidad_gasto,unidad_ejec,sit_fondos,ent_recip,pagos,num_pagos)
	VALUES 
	('$ctrl','$rw3[cod_cgr]','3','$rw3[cod_rec]','$rw3[oer]','$rw3[cda]','$rw3[finalidad_gasto]','$rw3[uni_ejec_cgr]','$sit_fondos','$rw3[ent_recip]','$rw4[pag_cxp]','$fil')";
	
	mysql_db_query($database, $sql, $conexion) or die(mysql_error());


}


} // end loger
?>
<br />
<br />

<center>
<div align="center" class="Titulotd" style="width:50%;padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">REPORTES ECONOMIA Y FINANZAS - CATEGORIA PRESUPUESTAL <?php echo $corte; ?></div>
<br />
<table border="1" align="center" cellpadding="2" cellspacing="0" class="bordepunteado1" width="50%">
<tr class="Titulotd">
	<td width="25%">Categor&iacute;a</td>
	<td colspan="3" width="75%">Formato</td>
    
</tr>
	<tr class="Estilo4">
		<td align="left">PROGRAMACION</td>
		<td align="left">Vigencia actual</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=PROG_1&archivo=540"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>
    <tr class="Estilo4">
		<td align="left">PROGRAMACION</td>
		<td align="left">Reservas</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=PROG_2&archivo=541"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>
    <tr class="Estilo4">
		<td align="left">PROGRAMACION</td>
		<td align="left">Cuentas por pagar</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=CXPP_3&archivo=542"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>

    <tr class="Estilo4">
		<td align="left">PROGRAMACION</td>
		<td align="left">Vigencia futura - Actual</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=PROG_4&archivo=546"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>
    <tr class="Estilo4">
		<td align="left">PROGRAMACION</td>
		<td align="left">Vigencia futura - Reserva</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=PROG_5&archivo=547"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>
        <tr class="Estilo4">
		<td align="left">PROGRAMACION</td>
		<td align="left">Vigencia futura - C x P</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=PROG_6&archivo=548"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>
		<tr class="Estilo4">
		<td align="left">EJECUCION</td>
		<td align="left">Vigencia actual</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=EJEC_1&archivo=543"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>
    <tr class="Estilo4">
		<td align="left">EJECUCION</td>
		<td align="left">Reservas</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=EJEC_2&archivo=544"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>
        <tr class="Estilo4">
		<td align="left">EJECUCION</td>
		<td align="left">Cuentas por pagar</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=EJEC_3&archivo=545"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>

    <tr class="Estilo4">
		<td align="left">EJECUCION</td>
		<td align="left">Vigencia futura - Actual</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=EJEC_4&archivo=549"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>
    <tr class="Estilo4">
		<td align="left">EJECUCION</td>
		<td align="left">Vigencia futura - Reserva</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=EJEC_5&archivo=550"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>
        <tr class="Estilo4">
		<td align="left">EJECUCION</td>
		<td align="left">Vigencia futura - C x P</td>
		<td align="center"><a href="cgr_gastos_3.php?tipo=EJEC_6&archivo=551"><img src="../simbolos/fuentes/reporte.jpg" border="0" width="18px" /></a></td>
        <td></td>
	</tr>

</table>
<?
printf("
<br><br>
<div align='center'>
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='cgr_gastos.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>

");	
?>