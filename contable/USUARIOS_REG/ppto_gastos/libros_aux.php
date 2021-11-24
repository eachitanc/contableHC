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
<style type="text/css">
<!--
.Estilo10 {font-weight: bold; color: #FFFFFF; }
.Estilo11 {
	color: #FFFFFF;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
</head>


</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td colspan="3">
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
            <div align="center"><a href='carga_ppto_gas.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">
<?
//$cuentax=$_POST['cuenta'];
//$cuenta=$_GET['vr'].$cuentax;
//printf("%s",$cuenta);

include('../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }
   
   
/*$sqlxx2 = "select * from car_ppto_gas where id_emp='$id_emp' and cod_pptal ='$cuenta'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
   {
   
   $nom_rubro=$rowxx2["nom_rubro"];
   $definitivo=$rowxx2["ppto_aprob"];
   $tip_dato=$rowxx2["tip_dato"];

 
   }   */
   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   
   $desde=$rowxx3["fecha_ini_op"];
   $desde_a = substr($desde,0,7);
   }    
   
/*$ts = strtotime('-1 month');
$hasta=date('Y/m/d', $ts);
$hasta_a = substr($hasta,0,7);
$actual=date('Y/m/d');
$actual_a = substr($actual,0,7);*/


/*if($tip_dato == 'M')
{
printf("<br><br><center><span class ='Estilo4'>LA CUENTA SELECCIONADA ES UNA CUENTA DE TIPO MAYOR</span></center><br><br>");
}
else
{*/
?>	
<form name="a" method="post" action="">
  <table width="600" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="2" bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo5"><b>NOTA</b>: La consulta se hara con base a la <b>Fecha de Inicio</b> y <b>Fecha Final</b> que usted seleccione </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo5"><b>PASO 1 </b>: Seleccione <b>Fecha de Inicio</b> y <b>Fecha Final</b></div>
    </div></td>
    </tr>
  <tr>
    <td><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">SELECCIONE FECHA DE INICIO </div>
    </div></td>
    <td><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">SELECCIONE FECHA FINAL </div>
    </div></td>
  </tr>
  <tr>
    <td><div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <input name="fecha_ini" type="text" class="Estilo4" id="fecha_ini" value="<?php printf($desde); ?>" size="12" />
        <span class="Estilo10">::</span>
        <input name="button" type="button" class="Estilo4" id="button" onclick="displayCalendar(document.a.fecha_ini,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
      </div>
    </div></td>
    <td><div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <input name="fecha_fin" type="text" class="Estilo4" id="fecha_fin" value="<?php printf($ano); ?>" size="12" />
        <span class="Estilo10">::</span>
        <input name="button2" type="button" class="Estilo4" id="button2" onclick="displayCalendar(document.a.fecha_fin,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo5"><b>PASO 2 </b>: Seleccione <b>Cuenta Presupuestal de Gastos  </b><b></b></div>
    </div></td>
  </tr>
  <?php
  	$codigo =$_POST['cuenta'];
	$libro = $_POST['dcto'];
  ?>
  <tr>
    <td colspan="2"><div class="Estilo4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo5">
        <select name="cuenta" class="Estilo4" id="cuenta" style="width: 400px;">
          <option value=""></option>
          <?

$db = mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($database);
$strSQL = "SELECT * FROM car_ppto_gas WHERE id_emp = '$idxx' ORDER BY cod_pptal";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = mysql_fetch_array($rs);
	if ($r['cod_pptal'] == $codigo)
	{
		echo "<OPTION selected='selected' VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</b></OPTION>";
	}else{
		echo "<OPTION VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</b></OPTION>";
	}
}
?>
        </select>

      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo5"><b>PASO 3 </b>: Seleccione <b>Documento Fuente  </b><b></b></div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><div class="Estilo4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo5">
        <select name="dcto" class="Estilo4" id="dcto" style="width: 350px;">
          <?
include('../config.php');
$db = mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($database);
$strSQL = "SELECT * FROM dctos_fuente_comprobantes  WHERE id_emp = '$idxx' AND ppto_gas = 'SI' ";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = mysql_fetch_array($rs);
	if ($r['cod']==$libro)
	{
		echo "<OPTION selected='selected' VALUE=\"".$r["cod"]."\">".$r["cod"]." - ".$r["nombre"]."</b></OPTION>";
	}else{
		echo "<OPTION VALUE=\"".$r["cod"]."\">".$r["cod"]." - ".$r["nombre"]."</b></OPTION>";
	}
}
?>
                </select>
      </div>
    </div></td>
  </tr>
  
  
  <tr>
    <td colspan="2"><div class="Estilo4" style="padding-left:3px; padding-top:15px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo5"><b></b>
        <input name="Submit3222" type="submit" class="Estilo4"  value="Consultar" 
			onclick="this.form.action = 'libros_aux.php'" />
      </div>
    </div></td>
  </tr>
</table>
</form>	</td>
  </tr>
  <tr>
    <td colspan="3">
<?
	$fecha_ini=$_POST['fecha_ini']; //printf("fecha_ini : %s<br>",$fecha_ini);
	$fecha_fin=$_POST['fecha_fin'];	//printf("fecha_fin : %s<br>",$fecha_fin);
	$cuenta=$_POST['cuenta']; //printf("cuenta : %s <br>",$cuenta);
	$dcto=$_POST['dcto']; //printf("dcto : %s <br>",$dcto);	
	
	//******** calculo de fechas para saldos iniciales
	
	$ts1 = strtotime($fecha_fin);
	$ts = strtotime('-1 day',$ts1);
	$hasta=date('Y/m/d', $ts); 

	//printf("desde : %s <br> hasta : %s",$desde,$hasta);
?>	
	</td>
  </tr>
  <tr>
    <td colspan="3">
<?php
if($dcto == 'CDPP')
{ 

	$sqlxxa = "select * from car_ppto_gas where id_emp = '$id_emp' and cod_pptal ='$cuenta'";
	$resultadoxxa = mysql_db_query($database, $sqlxxa, $connectionxx);
	
	while($rowxxa = mysql_fetch_array($resultadoxxa)) 
	{
	  $ppto_aprob=$rowxxa["ppto_aprob"];
	}
	$saldo_ini=$ppto_aprob;


//-------

printf("
<center>

<table width='1150' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#990000'>
<td align='left' colspan = '4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo11'><b>Cuenta Seleccionada</b> ...::: ".$cuenta." :::...</span>
</div>
</td>

<td align='left' colspan = '3'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo11'><b>Apropiacion Inicial ...:::...</b> ".number_format($saldo_ini,2,',','.')." </span>
</div>
</td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Fecha</b></span>
</div>
</td>
<td align='center' width='150'><span class='Estilo4'><b>Dcto</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>Tercero</b></span></td>
<td align='center' width='500'><span class='Estilo4'><b>Concepto / Detalle</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Debitos</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Creditos</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Saldo</b></span></td>
</tr>
");


//********************borrar

$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

//********************

$tabla6="lib_aux_cdp";
$anadir6="truncate TABLE ";
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
//******************** crear
$tabla7="lib_aux_cdp";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `id` int(11) NOT NULL auto_increment,
  `fecha` varchar(200) NOT NULL default '',
  `dcto` varchar(200) NOT NULL default '',
  `tercero` varchar(200) NOT NULL default '',
  `concepto` varchar(200) NOT NULL default '',
  `debito` varchar(200) NOT NULL default '',
  `credito` varchar(200) NOT NULL default '',
  `saldo` varchar(200) NOT NULL default '',
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
//*************************		



$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
//***** adiciones_ppto_gas   

$sq2 = "select * from adi_ppto_gas where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
while($rw2 = mysql_fetch_array($re2)) 
   {
$fechax=$rw2["fecha_adi"];
$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
$tercerox="ADICION";
$conceptox=$rw2["concepto_adi"];
$debitox=$rw2["valor_adi"];
$creditox='0';
$saldox='0';

$sql_ok = "INSERT INTO lib_aux_cdp (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }
//***** creditos   

$sq2 = "select * from creditos where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
while($rw2 = mysql_fetch_array($re2)) 
   {
$fechax=$rw2["fecha_adi"];
$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
$tercerox="CREDITO";
$conceptox=$rw2["concepto_adi"];
$debitox=$rw2["valor_adi"];
$creditox='0';
$saldox='0';

$sql_ok = "INSERT INTO lib_aux_cdp (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }
//***************** DISPONIBILIDADES
$sq = "select * from cdpp where (fecha_reg between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta' and id_emp = '$id_emp'";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
   {

$ctrla1=$rw["valor"];
   
if($ctrla1 > '0')
{
$var1x=$rw["valor"];
$debitox='0';
}
else
{
$ctrla1a=$ctrla1*-1;
$var1x='0';
$debitox=$ctrla1a;
}


$fechax=$rw["fecha_reg"];
$dctox=CDPP.$rw["cdpp"];
$tercerox="DISPONIBILIDAD";
$conceptox=$rw["des"];
$creditox=$var1x;
$saldox='0';

$sql_ok = "INSERT INTO lib_aux_cdp (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
mysql_query($sql_ok, $connectionxx) or die(mysql_error());

   }
////*************************************

//***** reducciones_ppto_gas   

$sq2 = "select * from red_ppto_gas where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
while($rw2 = mysql_fetch_array($re2)) 
   {
   
$fechax=$rw2["fecha_adi"];
$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
$tercerox="REDUCCION";
$conceptox=$rw2["concepto_adi"];
$debitox='0';
$creditox=$rw2["valor_adi"];
$saldox='0';

$sql_ok = "INSERT INTO lib_aux_cdp (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
mysql_query($sql_ok, $connectionxx) or die(mysql_error());

   }
//***** contra creditos   

$sq2 = "select * from contracreditos where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
while($rw2 = mysql_fetch_array($re2)) 
   {
$fechax=$rw2["fecha_adi"];
$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
$tercerox="CONTRACREDITO";
$conceptox=$rw2["concepto_adi"];
$debitox='0';
$creditox=$rw2["valor_adi"];
$saldox='0';

$sql_ok = "INSERT INTO lib_aux_cdp (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }

//******* IMPRESION DE RESULTADOS

$sq2 = "select * from lib_aux_cdp order by fecha asc";
$re2 = mysql_db_query($database, $sq2, $cx);
$acumdeb=0;
$acumcre=0;

while($rw2 = mysql_fetch_array($re2)) 
   {
		$debitox1=$rw2["debito"];
		$creditox1=$rw2["credito"];
		
		if($debitox1 == '0')
		{
		$acumcre=$acumcre+$creditox1;
		$saldox1=$saldo_ini+$acumdeb-$acumcre;
		}
		else
		{
		$acumdeb=$acumdeb+$debitox1;
		$saldox1=$saldo_ini+$acumdeb-$acumcre;
		}

	printf("
	<span class='Estilo4'>
	<tr>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='right'><span class='Estilo4'> %s </span></td>
	<td align='right'><span class='Estilo4'> %s </span></td>
	<td align='right'><span class='Estilo4'> %s </span></td>
	
	</tr>",$rw2["fecha"],$rw2["dcto"],$rw2["tercero"],$rw2["concepto"],number_format($rw2["debito"],2,',','.'),number_format($rw2["credito"],2,',','.'),number_format($saldox1,2,',','.')); 

    }


printf("</table></center>");
//--------	

//printf("b : %s <br>c : %s <br>d : %s <br>e : %s <br>f : %s <br>",$b,$c,$d,$e,$f);

}
?>
<?php
if($dcto == 'CRPP')
{ 

	$sqlxxa = "select * from car_ppto_gas where id_emp = '$id_emp' and cod_pptal ='$cuenta'";
	$resultadoxxa = mysql_db_query($database, $sqlxxa, $connectionxx);
	
	while($rowxxa = mysql_fetch_array($resultadoxxa)) 
	{
	  $ppto_aprob=$rowxxa["ppto_aprob"];
	}
	$saldo_ini=$ppto_aprob;

//-------


//********************borrar

$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

//********************

$tabla6="lib_aux_crp";
$anadir6="truncate TABLE ";
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
//******************** crear
$tabla7="lib_aux_crp";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `id` int(11) NOT NULL auto_increment,
  `fecha` varchar(200) NOT NULL default '',
  `dcto` varchar(200) NOT NULL default '',
  `tercero` varchar(200) NOT NULL default '',
  `concepto` varchar(200) NOT NULL default '',
  `debito` varchar(200) NOT NULL default '',
  `credito` varchar(200) NOT NULL default '',
  `saldo` varchar(200) NOT NULL default '',
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
//*************************		


printf("
<center>

<table width='1150' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#990000'>
<td align='left' colspan = '4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo11'><b>Cuenta Seleccionada</b> ...::: ".$cuenta." :::...</span>
</div>
</td>

<td align='left' colspan = '3'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo11'><b>Apropiacion Inicial ...:::...</b> ".number_format($saldo_ini,2,',','.')." </span>
</div>
</td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Fecha</b></span>
</div>
</td>
<td align='center' width='150'><span class='Estilo4'><b>Dcto</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>Tercero</b></span></td>
<td align='center' width='500'><span class='Estilo4'><b>Concepto / Detalle</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Debitos</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Creditos</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Saldo</b></span></td>
</tr>
");

//***************** REGISTROS

$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from crpp where (fecha_crpp between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta' and id_emp = '$id_emp' ";
$re = mysql_db_query($database, $sq, $cx);
$acu=0;
while($rw = mysql_fetch_array($re)) 
   {
		$ctrla2=$rw["vr_digitado"];
		if($ctrla2 > '0')
		{
		$creditux=$rw["vr_digitado"];
		$debitox='0';
		}
		else
		{
		$ctrla2=$ctrla2*-1;
		$creditux='0';
		$debitox=$ctrla2;
		}
		
		$fechax=$rw["fecha_crpp"];
		$dctox=$rw["id_manu_crpp"];
		$tercerox=$rw["tercero"];
		$conceptox=$rw["detalle_crpp"];
		$creditox=$creditux;
		$saldox='0';
		
		$sql_ok = "INSERT INTO lib_aux_crp (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
		mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }
   

//***** adiciones_ppto_gas   

$sq2 = "select * from adi_ppto_gas where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
$acu2=0;
while($rw2 = mysql_fetch_array($re2)) 
   {
		$fechax=$rw2["fecha_adi"];
		$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
		$tercerox='ADICION';
		$conceptox=$rw2["concepto_adi"];
		$debitox=$rw2["valor_adi"];
		$creditox='0';
		$saldox='0';
		
		$sql_ok = "INSERT INTO lib_aux_crp (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
		mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }
 

//***** reducciones_ppto_gas   

$sq2 = "select * from red_ppto_gas where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
$acu3=0;
while($rw2 = mysql_fetch_array($re2)) 
   {
		$fechax=$rw2["fecha_adi"];
		$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
		$tercerox='REDUCCION';
		$conceptox=$rw2["concepto_adi"];
		$debitox='0';
		$creditox=$rw2["valor_adi"];
		$saldox='0';
		
		$sql_ok = "INSERT INTO lib_aux_crp (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
		mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }

//***** creditos   

$sq2 = "select * from creditos where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
$acu4=0;
while($rw2 = mysql_fetch_array($re2)) 
   {
		$fechax=$rw2["fecha_adi"];
		$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
		$tercerox='CREDITO';
		$conceptox=$rw2["concepto_adi"];
		$debitox=$rw2["valor_adi"];
		$creditox='0';
		$saldox='0';
		
		$sql_ok = "INSERT INTO lib_aux_crp (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
		mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }

//***** contra creditos   

$sq2 = "select * from contracreditos where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
$acu5=0;
while($rw2 = mysql_fetch_array($re2)) 
   {
		$fechax=$rw2["fecha_adi"];
		$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
		$tercerox='CONTRACREDITO';
		$conceptox=$rw2["concepto_adi"];
		$debitox='0';
		$creditox=$rw2["valor_adi"];
		$saldox='0';
		
		$sql_ok = "INSERT INTO lib_aux_crp (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
		mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }


//******* IMPRESION DE RESULTADOS

$sq2 = "select * from lib_aux_crp order by fecha asc";
$re2 = mysql_db_query($database, $sq2, $cx);
$acumdeb=0;
$acumcre=0;

while($rw2 = mysql_fetch_array($re2)) 
   {


	$debitox1=$rw2["debito"];
	$creditox1=$rw2["credito"];
	
	if($debitox1 == '0')
	{
	$acumcre=$acumcre+$creditox1;
	$saldox1=$saldo_ini+$acumdeb-$acumcre;
	}
	else
	{
	$acumdeb=$acumdeb+$debitox1;
	$saldox1=$saldo_ini+$acumdeb-$acumcre;
	}
 
	printf("
	<span class='Estilo4'>
	<tr>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='right'><span class='Estilo4'> %s </span></td>
	<td align='right'><span class='Estilo4'> %s </span></td>
	<td align='right'><span class='Estilo4'> %s </span></td>
	
	</tr>",$rw2["fecha"],$rw2["dcto"],$rw2["tercero"],$rw2["concepto"],number_format($rw2["debito"],2,',','.'),number_format($rw2["credito"],2,',','.'),number_format($saldox1,2,',','.')); 

  }
 
printf("</table></center>");
//--------	

//printf("b : %s <br>c : %s <br>d : %s <br>e : %s <br>f : %s <br>",$b,$c,$d,$e,$f);

}
?>
<?php
if($dcto == 'COBP')
{ 

	$sqlxxa = "select * from car_ppto_gas where id_emp = '$id_emp' and cod_pptal ='$cuenta'";
	$resultadoxxa = mysql_db_query($database, $sqlxxa, $connectionxx);
	
	while($rowxxa = mysql_fetch_array($resultadoxxa)) 
	{
	  $ppto_aprob=$rowxxa["ppto_aprob"];
	}
	$saldo_ini=$ppto_aprob;

//-------

//********************borrar

$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);

//********************

$tabla6="lib_aux_cob";
$anadir6="truncate TABLE ";
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
//******************** crear
$tabla7="lib_aux_cob";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `id` int(11) NOT NULL auto_increment,
  `fecha` varchar(200) NOT NULL default '',
  `dcto` varchar(200) NOT NULL default '',
  `tercero` varchar(200) NOT NULL default '',
  `concepto` varchar(200) NOT NULL default '',
  `debito` varchar(200) NOT NULL default '',
  `credito` varchar(200) NOT NULL default '',
  `saldo` varchar(200) NOT NULL default '',
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
//*************************	

printf("
<center>

<table width='1150' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#990000'>
<td align='left' colspan = '4'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo11'><b>Cuenta Seleccionada</b> ...::: ".$cuenta." :::...</span>
</div>
</td>

<td align='left' colspan = '3'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo11'><b>Apropiacion Inicial ...:::...</b> ".number_format($saldo_ini,2,',','.')." </span>
</div>
</td>
</tr>

<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Fecha</b></span>
</div>
</td>
<td align='center' width='150'><span class='Estilo4'><b>Dcto</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>Tercero</b></span></td>
<td align='center' width='500'><span class='Estilo4'><b>Concepto / Detalle</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Debitos</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Creditos</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>Saldo</b></span></td>
</tr>
");

//***************** OBLIGACIONES

$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from cobp where (fecha_cobp between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta' and id_emp = '$id_emp'";
$re = mysql_db_query($database, $sq, $cx);
$acu=0;
while($rw = mysql_fetch_array($re)) 
   {
		$fechax=$rw["fecha_cobp"];
		$dctox=$rw["id_manu_cobp"];
		$tercerox=$rw["tercero"];
		$conceptox=$rw["des_cobp"];
		$debitox='0';
		$creditox=$rw["vr_digitado"];
		$saldox='0';
		
		$sql_ok = "INSERT INTO lib_aux_cob (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
		mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }
//***** adiciones_ppto_gas   

$sq2 = "select * from adi_ppto_gas where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
$acu2=0;
while($rw2 = mysql_fetch_array($re2)) 
   {
		$fechax=$rw2["fecha_adi"];
		$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
		$tercerox='ADICION';
		$conceptox=$rw2["concepto_adi"];
		$debitox=$rw2["valor_adi"];
		$creditox='0';
		$saldox='0';
		
		$sql_ok = "INSERT INTO lib_aux_cob (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
		mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }

//***** reducciones_ppto_gas   

$sq2 = "select * from red_ppto_gas where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
$acu3=0;
while($rw2 = mysql_fetch_array($re2)) 
   {
		$fechax=$rw2["fecha_adi"];
		$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
		$tercerox='REDUCCION';
		$conceptox=$rw2["concepto_adi"];
		$debitox='0';
		$creditox=$rw2["valor_adi"];
		$saldox='0';
		
		$sql_ok = "INSERT INTO lib_aux_cob (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
		mysql_query($sql_ok, $connectionxx) or die(mysql_error());

   }

//***** creditos   

$sq2 = "select * from creditos where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
$acu4=0;
while($rw2 = mysql_fetch_array($re2)) 
   {
		$fechax=$rw2["fecha_adi"];
		$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
		$tercerox='CREDITO';
		$conceptox=$rw2["concepto_adi"];
		$debitox=$rw2["valor_adi"];
		$creditox='0';
		$saldox='0';
		
		$sql_ok = "INSERT INTO lib_aux_cob (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
		mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }
//***** contra creditos   

$sq2 = "select * from contracreditos where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
$re2 = mysql_db_query($database, $sq2, $cx);
$acu5=0;
while($rw2 = mysql_fetch_array($re2)) 
   {
		$fechax=$rw2["fecha_adi"];
		$dctox=$rw2["tipo_acto"].$rw2["num_acto"];
		$tercerox='CONTRACREDITO';
		$conceptox=$rw2["concepto_adi"];
		$debitox='0';
		$creditox=$rw2["valor_adi"];
		$saldox='0';
		
		$sql_ok = "INSERT INTO lib_aux_cob (fecha,dcto,tercero,concepto,debito,credito,saldo) VALUES ('$fechax','$dctox','$tercerox','$conceptox','$debitox','$creditox','$saldox')";
		mysql_query($sql_ok, $connectionxx) or die(mysql_error());
   }

//******* IMPRESION DE RESULTADOS

$sq2 = "select * from lib_aux_cob order by fecha asc";
$re2 = mysql_db_query($database, $sq2, $cx);
$acumdeb=0;
$acumcre=0;

while($rw2 = mysql_fetch_array($re2)) 
   {


	$debitox1=$rw2["debito"];
	$creditox1=$rw2["credito"];
	
	if($debitox1 == '0')
	{
	$acumcre=$acumcre+$creditox1;
	$saldox1=$saldo_ini+$acumdeb-$acumcre;
	}
	else
	{
	$acumdeb=$acumdeb+$debitox1;
	$saldox1=$saldo_ini+$acumdeb-$acumcre;
	}
 
	printf("
	<span class='Estilo4'>
	<tr>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='left'><span class='Estilo4'> %s </span></td>
	<td align='right'><span class='Estilo4'> %s </span></td>
	<td align='right'><span class='Estilo4'> %s </span></td>
	<td align='right'><span class='Estilo4'> %s </span></td>
	
	</tr>",$rw2["fecha"],$rw2["dcto"],$rw2["tercero"],$rw2["concepto"],number_format($rw2["debito"],2,',','.'),number_format($rw2["credito"],2,',','.'),number_format($saldox1,2,',','.')); 

  } 

printf("</table></center>");
//--------	

//printf("b : %s <br>c : %s <br>d : %s <br>e : %s <br>f : %s <br>",$b,$c,$d,$e,$f);

}
?>

	
	</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='carga_ppto_gas.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
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
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?PHP include('../config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email?>	</div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>






<?
}
?>