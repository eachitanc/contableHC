<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>


<style type="text/css">
<!--
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
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
</head>


</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td width="798" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
</table>
<div align="center">
<br />

<?

include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);


$corte=$_POST['corte'];

if($corte == '')
{
}
else
{
include('../config.php');	

//************* borro la tabla		
$tabla6="aux_corte_2193_gas";
$anadir6="drop TABLE ";
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
		
$tabla7="aux_corte_2193_gas";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
         `corte` varchar(100) NOT NULL default ''
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

$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql_ok = "INSERT INTO aux_corte_2193_gas (corte) VALUES ('$corte') ";
mysql_query($sql_ok, $connection) or die(mysql_error());		
}



?>

<form id="form1" name="form1" method="post" action="inf_2193.php">
  <div align="center">
    <select name="nivel" class="Estilo4" id="nivel">
      <option value="A">Anual</option>
      <option value="T">Trimestral</option>
    </select>
    <span class="Estilo8">:::</span> 
    <input name="Submit" type="submit" class="Estilo4" value="Filtrar Informe" />
  </div>
</form>
<br />
  <?php

$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "select * from aux_corte_2193_gas";
$resultado = mysql_db_query($database, $sql, $connection);

while($row = mysql_fetch_array($resultado)) 
   {
   $fecha_fin=$row["corte"];
   }


$aux=$_POST['nivel'];

if($aux == '')
{
$aux='T';
}

printf("<center><br><span class='Estilo4'>Filtro Seleccionado : %s</span></center><br><br>",$aux);  
  
//-------
include('../config.php');	

$connection = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "select * from fecha";
$resultado = mysql_db_query($database, $sql, $connection);

while($row = mysql_fetch_array($resultado)) 
   {
   
   $id=$row["id_emp"];
   $idxx=$row["id_emp"];
   $id_emp=$row["id_emp"];

   }


//****** lista de cuentas del pgcp configuradas por el usuario


$tabla6="aux_2193_gas";
$anadir6="drop TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";

mysql_select_db ($base, $connection);

		if(mysql_query ($anadir6 ,$connection)) 
		{
		echo "";
		}
		else
		{
		echo "";
		};	

///**** creo la tabla lib_aux

		$tabla7="aux_2193_gas";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `cod2193` varchar(200) NOT NULL default '',
  `concepto` varchar(200) NOT NULL default '',
  `cod_ppto_ing` varchar(200) NOT NULL default '',
  `def` varchar(200) NOT NULL default '',
  `compromisos` varchar(200) NOT NULL default '',
  `obligaciones` varchar(200) NOT NULL default '',
  `enero` varchar(200) NOT NULL default '',
  `febrero` varchar(200) NOT NULL default '',
  `marzo` varchar(200) NOT NULL default '',
  `abril` varchar(200) NOT NULL default '',
  `mayo` varchar(200) NOT NULL default '',
  `junio` varchar(200) NOT NULL default '',
  `julio` varchar(200) NOT NULL default '',
  `agosto` varchar(200) NOT NULL default '',
  `septiembre` varchar(200) NOT NULL default '',
  `octubre` varchar(200) NOT NULL default '',
  `noviembre` varchar(200) NOT NULL default '',
  `diciembre` varchar(200) NOT NULL default ''
  )TYPE=MyISAM ";
		
		mysql_select_db ($base, $connection);

		if(mysql_query ($anadir7 ,$connection)) 
		{
		//echo "listo";
		}
		else
		{
		//echo "no se pudo";
		}


$sqla = "select * from 2193_gas_ok";
$resultadoa = mysql_db_query($database, $sqla, $connection);

while($rowa = mysql_fetch_array($resultadoa)) 
   {

   $cod_homo=$rowa["cod_pptal"];
   $conceptoa=$rowa["concepto"];
   $cod_2193=$rowa["cod"];

//***************
		$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		$sqlxx = "select * from fecha_ini_op";
		$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
		
		while($rowxx = mysql_fetch_array($resultadoxx)) 
		{
		  $fecha_ini=$rowxx["fecha_ini_op"];
		}
		
//***************		
		$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
		$sqlxx = "select * from fecha";
		$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
		
		while($rowxx = mysql_fetch_array($resultadoxx)) 
		{
		$ano=$rowxx["ano"];
		}
		$anio = substr($ano,0,4);
//***************	

$link=mysql_connect($server,$dbuser,$dbpass);
// defiitivo
$rs23=mysql_query("select sum(ppto_aprob) as total from car_ppto_gas WHERE cod_pptal LIKE '$cod_homo%' and tip_dato='D'",$link) or die (mysql_error());
$rw23=mysql_fetch_row($rs23);
$inicial=$rw23[0];

$rs23=mysql_query("select sum(valor_adi) as total from adi_ppto_gas  WHERE  (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal LIKE '$cod_homo%'",$link) or die (mysql_error());
$rw23=mysql_fetch_row($rs23);
$adi=$rw23[0];

$rs23=mysql_query("select sum(valor_adi) as total from red_ppto_gas   WHERE  (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal LIKE '$cod_homo%'",$link) or die (mysql_error());
$rw23=mysql_fetch_row($rs23);
$red=$rw23[0];

$rs23=mysql_query("select sum(valor_adi) as total from creditos   WHERE  (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal LIKE '$cod_homo%'",$link) or die (mysql_error());
$rw23=mysql_fetch_row($rs23);
$cre_ing=$rw23[0];

$rs23=mysql_query("select sum(valor_adi) as total from contracreditos     WHERE  (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal LIKE '$cod_homo%'",$link) or die (mysql_error());
$rw23=mysql_fetch_row($rs23);
$crec_ing=$rw23[0];

$def = $inicial + $adi - $red + $cre_ing - $crec_ing; 

// comprometido
$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from crpp WHERE (fecha_crpp between '$fecha_ini' and '$fecha_fin' ) and cuenta LIKE '$cod_homo%' and vr_digitado <> '0'",$link) or die (mysql_error());
$row6=mysql_fetch_row($resulta6);
$total_crpp=$row6[0];

$compromisos = $total_crpp;

// obligaciones

$resulta61=mysql_query("select SUM(vr_digitado) AS TOTAL from cobp WHERE (fecha_cobp between '$fecha_ini' and '$fecha_fin' ) and cuenta LIKE '$cod_homo%' ",$link) or die (mysql_error());
$row61=mysql_fetch_row($resulta61);
$total_cobp=$row61[0];


$obligaciones = $total_cobp;


//****** recaudos mes de enero

$fecha_ini_ene= $anio.'/01/01';
$fecha_fin_ene= $anio.'/01/31';

$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_ene' AND '$fecha_fin_ene' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totene=$row8[0];


$recaudos_ene1 = $totene;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_ene' AND '$fecha_fin_ene' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_ene = $rw4['total2'];

$recaudos_ene = $recaudos_ene1 + $total_ceva_acum_ene;


//****** recaudos mes de febrero

$fecha_ini_feb=$anio.'/02/01';
$fecha_fin_feb=$anio.'/02/29';

$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_feb' AND '$fecha_fin_feb' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totfeb=$row8[0];

$recaudos_feb1 = $totfeb;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_feb' AND '$fecha_fin_feb' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_feb = $rw4['total2'];

$recaudos_feb = $recaudos_feb1 + $total_ceva_acum_feb;

//****** recaudos mes de marzo

$fecha_ini_mar=$anio.'/03/01';
$fecha_fin_mar=$anio.'/03/31';



$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_mar' AND '$fecha_fin_mar' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totmar=$row8[0];

$recaudos_mar1 = $totmar;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_mar' AND '$fecha_fin_mar' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_mar = $rw4['total2'];

$recaudos_mar = $recaudos_mar1 + $total_ceva_acum_mar;
//****** recaudos mes de abril

$fecha_ini_abr=$anio.'/04/01';
$fecha_fin_abr=$anio.'/04/30';

$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_abr' AND '$fecha_fin_abr' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totabr=$row8[0];

$recaudos_abr1 = $totabr;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_abr' AND '$fecha_fin_abr' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_abr = $rw4['total2'];

$recaudos_abr = $recaudos_abr1 + $total_ceva_acum_abr;

//****** recaudos mes de mayo

$fecha_ini_may=$anio.'/05/01';
$fecha_fin_may=$anio.'/05/31';

$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_may' AND '$fecha_fin_may' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totmay=$row8[0];

$recaudos_may1 = $totmay;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_may' AND '$fecha_fin_may' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_may = $rw4['total2'];

$recaudos_may = $recaudos_may1 + $total_ceva_acum_may;


//****** recaudos mes de junio

$fecha_ini_jun=$anio.'/06/01';
$fecha_fin_jun=$anio.'/06/30';

$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_jun' AND '$fecha_fin_jun' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totjun=$row8[0];

$recaudos_jun1 = $totjun;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_jun' AND '$fecha_fin_jun' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_jun = $rw4['total2'];

$recaudos_jun = $recaudos_jun1 + $total_ceva_acum_jun;

//****** recaudos mes de julio

$fecha_ini_jul=$anio.'/07/01';
$fecha_fin_jul=$anio.'/07/31';

$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_jul' AND '$fecha_fin_jul' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totjul=$row8[0];

$recaudos_jul1 = $totjul;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_jul' AND '$fecha_fin_jul' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_jul = $rw4['total2'];

$recaudos_jul = $recaudos_jul1 + $total_ceva_acum_jul;


//****** recaudos mes de agosto

$fecha_ini_ago=$anio.'/08/01';
$fecha_fin_ago=$anio.'/08/31';

$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_ago' AND '$fecha_fin_ago' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totago=$row8[0];

$recaudos_ago1 = $totago;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_ago' AND '$fecha_fin_ago' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_ago = $rw4['total2'];

$recaudos_ago = $recaudos_ago1 + $total_ceva_acum_ago;


//****** recaudos mes de septiembre

$fecha_ini_sep=$anio.'/09/01';
$fecha_fin_sep=$anio.'/09/30';

$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_sep' AND '$fecha_fin_sep' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totsep=$row8[0];

$recaudos_sep1 = $totsep;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_sep' AND '$fecha_fin_sep' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_sep = $rw4['total2'];

$recaudos_sep = $recaudos_sep1 + $total_ceva_acum_sep;

//****** recaudos mes de octubre

$fecha_ini_oct=$anio.'/10/01';
$fecha_fin_oct=$anio.'/10/31';

$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_oct' AND '$fecha_fin_oct' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totoct=$row8[0];

$recaudos_oct1 = $totoct;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_oct' AND '$fecha_fin_oct' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_oct = $rw4['total2'];

$recaudos_oct = $recaudos_oct1 + $total_ceva_acum_oct;


//****** recaudos mes de noviembre

$fecha_ini_nov=$anio.'/11/01';
$fecha_fin_nov=$anio.'/11/30';

$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_nov' AND '$fecha_fin_nov' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totnov=$row8[0];

$recaudos_nov1 = $totnov;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_nov' AND '$fecha_fin_nov' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_nov = $rw4['total2'];

$recaudos_nov = $recaudos_nov1 + $total_ceva_acum_nov;

//****** recaudos mes de diciembre

$fecha_ini_dic=$anio.'/12/01';
$fecha_fin_dic=$anio.'/12/31';

$sqlceva = mysql_query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini_dic' AND '$fecha_fin_dic' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> '0'",$link) or die (mysql_error());
$row8=mysql_fetch_row($sqlceva);
$totdic=$row8[0];

$recaudos_dic1 = $totdic;

		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini_dic' AND '$fecha_fin_dic' ) AND cobp.cuenta LIKE '$cod_homo%' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = mysql_query($sq4,$link);
		$rw4 = mysql_fetch_array ($rs4);
		$total_ceva_acum_dic = $rw4['total2'];

$recaudos_dic= $recaudos_dic1 + $total_ceva_acum_dic;



$sql_ok = "INSERT INTO aux_2193_gas 
						(cod2193,concepto,cod_ppto_ing,def,compromisos,obligaciones,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre) 
						VALUES 
						('$cod_2193','$conceptoa','$cod_homo','$def','$compromisos','$obligaciones','$recaudos_ene','$recaudos_feb','$recaudos_mar','$recaudos_abr','$recaudos_may','$recaudos_jun','$recaudos_jul','$recaudos_ago','$recaudos_sep','$recaudos_oct','$recaudos_nov','$recaudos_dic') ";
						mysql_query($sql_ok, $connection) or die(mysql_error());

   $obligaciones=0;
   }





//**** info para el primer trimestre


if($aux == 'A')
{
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from 2193_gas order by cod asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='1950' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#336666'>

<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4 Estilo8'><b>cod_trim</b></span>
</div>
</td>

<td align='center' width='30'><span class='Estilo4 Estilo8'><b>Tipo</b></span></td>
<td align='center' width='30'><span class='Estilo4 Estilo8'><b>Trim</b></span></td>
<td align='center' width='350'><span class='Estilo4 Estilo8'><b>Cuenta 2193/04 Trimestre</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Definitivo</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Compromisos</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Obligado</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Enero</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Febrero</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Marzo</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Abril</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Mayo</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Junio</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Julio</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Agosto</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Septiembre</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Octubre</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Noviembre</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Diciembre</b></span></td>

</tr>

");


while($rw = mysql_fetch_array($re)) 
   {
   
$cod=$rw["cod"];
$tipo=$rw["tipo"];
$concepto=$rw["concepto"];
$trim=$rw["trimestre"];

$link=mysql_connect($server,$dbuser,$dbpass);

$resulta3=mysql_query("select SUM(def) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$deft=$row3[0];

$resulta3=mysql_query("select SUM(compromisos) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$tota=$row3[0];

$resulta3=mysql_query("select SUM(obligaciones) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$obliga=$row3[0];

$resulta3=mysql_query("select SUM(enero) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totaene=$row3[0];

$resulta3=mysql_query("select SUM(febrero) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totafeb=$row3[0];

$resulta3=mysql_query("select SUM(marzo) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totamar=$row3[0];

$resulta3=mysql_query("select SUM(abril) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totaabr=$row3[0];

$resulta3=mysql_query("select SUM(mayo) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totamay=$row3[0];

$resulta3=mysql_query("select SUM(junio) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totajun=$row3[0];

$resulta3=mysql_query("select SUM(julio) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totajul=$row3[0];

$resulta3=mysql_query("select SUM(agosto) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totaago=$row3[0];

$resulta3=mysql_query("select SUM(septiembre) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totasep=$row3[0];

$resulta3=mysql_query("select SUM(octubre) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totaoct=$row3[0];

$resulta3=mysql_query("select SUM(noviembre) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totanov=$row3[0];

$resulta3=mysql_query("select SUM(diciembre) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totadic=$row3[0];

printf("

<span class='Estilo4'>
<tr>

<td align='left'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>

", $cod, $tipo, $trim, $concepto);

if($deft == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$deft);
}


if($tota == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$tota);
}

if($obliga == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$obliga);
}



if($totaene == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totaene);
}

if($totafeb == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totafeb);
}

if($totamar == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totamar);
}

if($totaabr == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totaabr);
}

if($totamay == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totamay);
}

if($totajun == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totajun);
}

if($totajul == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totajul);
}

if($totaago == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totaago);
}

if($totasep == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totasep);
}

if($totaoct == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totaoct);
}

if($totanov == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totanov);
}

if($totadic == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totadic);
}

printf("
</tr>
");

}//fin while

printf("</table></center>");
//--------	
}//******************************
else
{//******************************
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from 2193_gas where trimestre = 'T' order by cod asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>
<table width='1950' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#336666'>

<td align='center' width='100'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4 Estilo8'><b>cod_trim</b></span>
</div>
</td>

<td align='center' width='30'><span class='Estilo4 Estilo8'><b>Tipo</b></span></td>
<td align='center' width='30'><span class='Estilo4 Estilo8'><b>Trim</b></span></td>
<td align='center' width='350'><span class='Estilo4 Estilo8'><b>Cuenta 2193/04 Trimestre</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Compromisos</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Obligado</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Enero</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Febrero</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Marzo</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Abril</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Mayo</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Junio</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Julio</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Agosto</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Septiembre</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Octubre</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Noviembre</b></span></td>
<td align='center' width='120'><span class='Estilo4 Estilo8'><b>Diciembre</b></span></td>

</tr>

");


while($rw = mysql_fetch_array($re)) 
   {
   
$cod=$rw["cod"];
$tipo=$rw["tipo"];
$concepto=$rw["concepto"];
$trim=$rw["trimestre"];

$link=mysql_connect($server,$dbuser,$dbpass);

$resulta3=mysql_query("select SUM(compromisos) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$tota=$row3[0];

$resulta32=mysql_query("select SUM(obligaciones) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row32=mysql_fetch_row($resulta32);
$tota2=$row32[0];


$resulta3=mysql_query("select SUM(enero) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totaene=$row3[0];

$resulta3=mysql_query("select SUM(febrero) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totafeb=$row3[0];

$resulta3=mysql_query("select SUM(marzo) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totamar=$row3[0];

$resulta3=mysql_query("select SUM(abril) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totaabr=$row3[0];

$resulta3=mysql_query("select SUM(mayo) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totamay=$row3[0];

$resulta3=mysql_query("select SUM(junio) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totajun=$row3[0];

$resulta3=mysql_query("select SUM(julio) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totajul=$row3[0];

$resulta3=mysql_query("select SUM(agosto) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totaago=$row3[0];

$resulta3=mysql_query("select SUM(septiembre) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totasep=$row3[0];

$resulta3=mysql_query("select SUM(octubre) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totaoct=$row3[0];

$resulta3=mysql_query("select SUM(noviembre) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totanov=$row3[0];

$resulta3=mysql_query("select SUM(diciembre) AS TOTAL from aux_2193_gas WHERE cod2193 like '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$totadic=$row3[0];

printf("

<span class='Estilo4'>
<tr>

<td align='left'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='left'><span class='Estilo4'> %s </span></td>

", $cod, $tipo, $trim, $concepto);

if($tota == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$tota);
}

if($tota2 == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$tota2);
}


if($totaene == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totaene);
}

if($totafeb == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totafeb);
}

if($totamar == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totamar);
}

if($totaabr == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totaabr);
}

if($totamay == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totamay);
}

if($totajun == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totajun);
}

if($totajul == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totajul);
}

if($totaago == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totaago);
}

if($totasep == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totasep);
}

if($totaoct == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totaoct);
}

if($totanov == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totanov);
}

if($totadic == '')
{
printf("<td align='right'><span class='Estilo4'> 0.00 </span></td>");
}
else
{
printf("<td align='right'><span class='Estilo4'> %s </span></td>",$totadic);
}

printf("
</tr>
");

}//fin while

printf("</table></center>");
//--------	
}


?>
</div>
<table width="800" border="0" align="center">
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
            <span class="Estilo4"> <strong>
            <? include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
            </strong> </span> <br />
            <span class="Estilo4"><b>Usuario: </b><u><? echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  <tr>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <?PHP include('../config.php'); echo $nom_emp ?>
        <br />
        <?PHP echo $dir_tel ?><br />
        <?PHP echo $muni ?> <br />
        <?PHP echo $email?> </div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <br />
        </a><br />
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a></div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
      <div align="center">Desarrollado por <br />
            <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
        Derechos Reservados - 2009 </div>
    </div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>






<?
}
?>