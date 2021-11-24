<?
set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=MODIFICACIONES_GASTOS_MENSUAL.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
.Estilo10 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo11 {font-size: 10px}

.text
  {
 mso-number-format:"\@"
  }
-->
</style>
</head>


</head>

<body>
<?php
//-------
include('../config.php');	
$cxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sxx = "select * from fecha";
$rxx = mysql_db_query($database, $sxx, $cxx);
while($rowxxx = mysql_fetch_array($rxx)) 
   {
   $idxxx=$rowxxx["id_emp"];
   $id_emp=$rowxxx["id_emp"];
   $ano=$rowxxx["ano"];
   }
$sxxq = "select * from fecha_ini_op";
$rxxq = mysql_db_query($database, $sxxq, $cxx);
while($rowxxxq = mysql_fetch_array($rxxq)) 
   {
   $fecha_ini_op=$rowxxxq["fecha_ini_op"];
   }   
$cx2 = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from empresa where cod_emp = '$idxxx'";
$re2 = mysql_db_query($database, $sq2, $cx2);
while($row2 = mysql_fetch_array($re2)) 
   {
   $empresa = $row2["raz_soc"];
   }
//--------	--------------------------------------------------------------------------------------------

	$fecha_ini=$_POST['fecha_inip']; //printf("fecha ini : %s",$fecha_ini);
	$fecha_fin=$_POST['fecha_fin'];	//printf("fecha fin : %s",$fecha_fin);

$anno = substr($ano,0,4);	
// Para cargar la url e incluir imagenes al archivo que se genera
//echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/imagen.gif";          
//***** Consulto la base para llenar la tabla 
$ruta_img = "http://$_SERVER[HTTP_HOST]/USUARIOS_REG/images/PLANTILLA PNG PARA LOGO EMPRESA.png";
?>
<table width="800" border="0" align="center">
<tr>
  <td rowspan="5" align="center"><img src='<?php echo $ruta_img; ?>' /></td>
	<td align="center" colspan="10"></td>
</tr>
<tr>
	<td align="center" colspan="10"><font size="4"><b><?php echo $empresa; ?></b></font></td>
</tr>
<tr>
    <td align="center" colspan="10"><font size="4"><b>REPORTE MODIFICACIONES MENSUALES  PRESUPUESTO DE GASTOS</b></font></td>
</tr>
<tr>
    <td align="center" colspan="10"><font size="4"><b>VIGENCIA <?php echo $anno; ?></b></font></td>
</tr>
<tr>
	<td align="center" colspan="10"></td>
</tr>
<tr>
	<td align="left" colspan="10"><b>FECHA INCIAL :</b><?php echo "$fecha_ini"; ?></td>
</tr>
<tr>
	<td align="left" colspan="10"><b>FECHA FINAL :</b><?php echo "$fecha_fin"; ?></td>
</tr>

</table>
<br />
<?php
//-------
include('../config.php');				
$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from car_ppto_gas where id_emp = '$id_emp' order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);

printf("
<center>

<table width='2550' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>Cod. Pptal</b></span>
</div>
</td>
<td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Reducciones</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Creditos</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>ContraCreditos</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Aplazamientos</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>Desaplazamientos</b></span></td>
<td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
<td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>




");

while($rw = mysql_fetch_array($re)) 
   {

$link=mysql_connect($server,$dbuser,$dbpass);

//****

$cod=$rw["cod_pptal"];
//****
$suma =0;

$resulta=mysql_query("select SUM(valor_adi) AS TOTAL from adi_ppto_gas WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total_adi=$row[0]; 

$resulta2=mysql_query("select SUM(valor_adi) AS TOTAL from red_ppto_gas WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
$row2=mysql_fetch_row($resulta2);
$total_red=$row2[0];

$resulta3=mysql_query("select SUM(valor_adi) AS TOTAL from creditos WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
$row3=mysql_fetch_row($resulta3);
$total_cre=$row3[0];

$resulta4=mysql_query("select SUM(valor_adi) AS TOTAL from contracreditos WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
$row4=mysql_fetch_row($resulta4);
$total_ccre=$row4[0];

$link=mysql_connect($server,$dbuser,$dbpass);
$resulta=mysql_query("select SUM(valor_aplazado) AS TOTAL from aplazamientos WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total5=$row[0]; 
$total_apla = $total5;

$link=mysql_connect($server,$dbuser,$dbpass);
$resulta=mysql_query("select SUM( valor_levantado) AS TOTAL from levanta_aplazamientos WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
$row=mysql_fetch_row($resulta);
$total5=$row[0]; 
$total_desapla = $total5;

$suma = $total_adi +  $total_red + $total_cre + $total_ccre + $total_apla + $total_desapla;

if ($suma !=0)
{
printf("
<span class='Estilo4'>
<tr>

<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>

<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s </span></td>
<td align='right'><span class='Estilo4'>%s</span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>
<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='right'><span class='Estilo4'>%s</span></td>

<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
<td align='center'><span class='Estilo4'>%s</span></td>


</tr>", $rw["cod_pptal"], $rw["nom_rubro"], number_format($total_adi,2,',','.'), number_format($total_red,2,',','.'), number_format($total_cre,2,',','.'), number_format($total_ccre,2,',','.'),  number_format($total_apla,2,',','.'), number_format($total_desapla,2,',','.'), $rw["tip_dato"], $rw["nivel"]); 

}
   }

printf("</table></center>");


//--------	
?>
<br />
</body>
</html>
<?
}
?>