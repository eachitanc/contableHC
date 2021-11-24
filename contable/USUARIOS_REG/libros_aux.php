<?
session_start();
if(!session_is_registered("login"))
{
header("Location: login.php");
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
	  <img src="images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='carga_ppto_ing.php' target='_parent'>VOLVER </a> </div>
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

include('config.php');				
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
      <div align="center" class="Estilo5"><b>PASO 2 </b>: Seleccione <b>Cuenta Presupuestal de Ingresos  </b><b></b></div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div class="Estilo4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo5">
        <select name="cuenta" class="Estilo4" id="cuenta" style="width: 400px;">
          <option value=""></option>
          <?

$db = mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($database);
$strSQL = "SELECT * FROM car_ppto_ing WHERE id_emp = '$idxx'  ORDER BY cod_pptal";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = mysql_fetch_array($rs);
	echo "<OPTION VALUE=\"".$r["cod_pptal"]."\">".$r["cod_pptal"]." - ".$r["nom_rubro"]."</b></OPTION>";
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
include('config.php');
$db = mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($database);
$strSQL = "SELECT * FROM dctos_fuente_comprobantes  WHERE id_emp = '$idxx' AND ppto_ing = 'SI' ";
$rs = mysql_query($strSQL);
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++) {
	$r = mysql_fetch_array($rs);
	echo "<OPTION VALUE=\"".$r["cod"]."\">".$r["cod"]." - ".$r["nombre"]."</b></OPTION>";
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
if($dcto == 'REIP')
{ 
	
		$sqlxxa = "select * from car_ppto_ing where id_emp = '$id_emp' and cod_pptal ='$cuenta'";
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
	
	//***************** reip
		$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
		$sq = "select * from reip_ing where (fecha_reg between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta' and id_emp = '$id_emp' order by fecha_reg " ;
		$re = mysql_db_query($database, $sq, $cx);
		$acu=0;
		while($rw = mysql_fetch_array($re)) 
		   {
		
		$acu=$acu + $rw["valor"];
		
		$saldo_reip=$saldo_ini-$acu;
		
		   
		printf("
		<span class='Estilo4'>
		<tr>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'>  %s  </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'>  </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		
		</tr>", $rw["fecha_reg"], $rw["id_manu_reip"], $rw["tercero"], $rw["des"], number_format($rw["valor"],2,',','.'),number_format($saldo_reip,2,',','.')); 
		
		
		   }
		
		if($saldo_reip == '')
		{ $b=0 + $saldo_ini;   
		}
		else
		{ $b=$saldo_reip;   
		}
		
		//printf("b = %s",$b);
		   
		//***** adiciones_ppto_ing  
		
		$sq2 = "select * from adi_ppto_ing where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		$acu2=0;
		while($rw2 = mysql_fetch_array($re2)) 
		   {
		   
		$acu2=$acu2 + $rw2["valor_adi"];
		$saldo_adi=$b+$acu2;
		   
		   
		printf("
		<span class='Estilo4'>
		<tr>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'>  ADICION  </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'>  </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		
		</tr>", $rw2["fecha_adi"], $rw2["tipo_acto"].$rw2["num_acto"],$rw2["concepto_adi"], number_format($rw2["valor_adi"],2,',','.'),number_format($saldo_adi,2,',','.')); 
		
		
		   }
		   
		if($saldo_adi == '')
		{ $c=0 + $b;   
		}
		else
		{ $c=$saldo_adi;   
		}
		
		//***** reducciones_ppto_ing   
		
		$sq2 = "select * from red_ppto_ing where (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal = '$cuenta' and id_emp = '$id_emp'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		$acu3=0;
		while($rw2 = mysql_fetch_array($re2)) 
		   {
		   
		$acu3=$acu3 + $rw2["valor_adi"];
		$saldo_red=$c-$acu3;
		   
		   
		printf("
		<span class='Estilo4'>
		<tr>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'>  REDUCCION  </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'>  </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		
		</tr>", $rw2["fecha_adi"], $rw2["tipo_acto"].$rw2["num_acto"],$rw2["concepto_adi"], number_format($rw2["valor_adi"],2,',','.'),number_format($saldo_red,2,',','.')); 
		
		
		   }
		
		if($saldo_red == '')
		{ $d=0 + $c;   
		}
		else
		{ $d=$saldo_red;   
		}
		
		//***** ncbt   
		
		$sq2 = "select * from recaudo_ncbt where (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta' and id_emp = '$id_emp'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		$acu4=0;
		while($rw2 = mysql_fetch_array($re2)) 
		   {
		   
		$acu4=$acu4 + $rw2["vr_digitado"];
		$saldo_ncbt=$d-$acu4;
		   
		   
		printf("
		<span class='Estilo4'>
		<tr>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'>  NOTA CREDITO  </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'>  </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		
		</tr>", $rw2["fecha_recaudo"], $rw2["id_recau"],$rw2["des_recaudo"], number_format($rw2["vr_digitado"],2,',','.'),number_format($saldo_ncbt,2,',','.')); 
		
		
		   }
		
		if($saldo_ncbt == '')
		{ $e=0 + $d;   
		}
		else
		{ $e=$saldo_ncbt;   
		}
		
		//***** RCGT   
		
		$sq2 = "select * from recaudo_rcgt where (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta' and id_emp = '$id_emp'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		$acu5=0;
		while($rw2 = mysql_fetch_array($re2)) 
		   {
		   
		$acu5=$acu5 + $rw2["vr_digitado"];
		$saldo_rcgt=$e-$acu5;
		   
		   
		printf("
		<span class='Estilo4'>
		<tr>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'>  RECIBO DE CAJA  </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'>  </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		
		</tr>", $rw2["fecha_recaudo"], $rw2["id_manu_rcgt"],$rw2["des_recaudo"], number_format($rw2["vr_digitado"],2,',','.'),number_format($saldo_rcgt,2,',','.')); 
		
		
		   }
		
		if($saldo_rcgt == '')
		{ $f=0 + $e;   
		}
		else
		{ $f=$saldo_rcgt;   
		}
		
		//***** TNAT   
		
		$sq2 = "select * from recaudo_tnat where (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta' and id_emp = '$id_emp'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		$acu6=0;
		while($rw2 = mysql_fetch_array($re2)) 
		   {
		   
		$acu6=$acu6 + $rw2["vr_digitado"];
		$saldo_tnat=$f-$acu6;
		   
		   
		printf("
		<span class='Estilo4'>
		<tr>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='left'><span class='Estilo4'>  TRANSFERENCIA DE LA NACION  </span></td>
		<td align='left'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'>  </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		<td align='right'><span class='Estilo4'> %s </span></td>
		
		</tr>", $rw2["fecha_recaudo"], $rw2["id_recau"],$rw2["des_recaudo"], number_format($rw2["vr_digitado"],2,',','.'),number_format($saldo_tnat,2,',','.')); 
		
		
		   }
		
		if($saldo_tnat == '')
		{ $g=0 + $f;   
		}
		else
		{ $g=$saldo_tnat;   
		}
		printf("</table></center>");
		//--------	
		
		//printf("b : %s <br>c : %s <br>d : %s <br>e : %s <br>f : %s <br>",$b,$c,$d);
	
}
?></td>
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
            <div align="center"><a href='carga_ppto_ing.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('config.php');				
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
	  <div align="center"><?PHP include('config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email?>	</div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>






<?
}
?>