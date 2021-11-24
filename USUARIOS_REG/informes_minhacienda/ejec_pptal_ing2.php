<?
set_time_limit(2600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=MARCO_FISCAL_INGRESOS.xls");
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
$cxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
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
$cx2 = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq2 = "select * from empresa where cod_emp = '$idxxx'";
$re2 = mysql_db_query($database, $sq2, $cx2);
while($row2 = mysql_fetch_array($re2)) 
   {
   $empresa = $row2["raz_soc"];
   }
//--------	--------------------------------------------------------------------------------------------

	$fecha_ini='2000/01/01'; //printf("fecha ini : %s",$fecha_ini);
	$fecha_fin=$_POST['fecha_fin'];	//printf("fecha fin : %s",$fecha_fin);
	$tipo = $_POST['mov_mes'];

$anno = substr($ano,0,4);	
// Para cargar la url e incluir imagenes al archivo que se genera
//echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/imagen.gif";          
//***** Consulto la base para llenar la tabla 
$ruta_img = "http://$_SERVER[HTTP_HOST]/USUARIOS_REG/images/PLANTILLA PNG PARA LOGO EMPRESA.png";
?>
<table width="800" border="0" align="center">
<tr>
  <td rowspan="5" align="center"><img src='<?php echo $ruta_img; ?>' /></td>
	<td align="center" colspan="11"></td>
</tr>
<tr>
	<td align="center" colspan="11"><font size="4"><b><?php echo $empresa; ?></b></font></td>
</tr>
<tr>
    <td align="center" colspan="11"><font size="4"><b>EJECUCION P.A.C. DE INGRESOS</b></font></td>
</tr>
<tr>
    <td align="center" colspan="11"><font size="4"><b>VIGENCIA <?php echo $anno; ?></b></font></td>
</tr>
<tr>
	<td align="center" colspan="11"></td>
</tr>
<tr>
	<td align="left" colspan="12"><b>FECHA DE CORTE :</b><?php echo $fecha_fin; ?></td>
</tr>
</table>
<br />
<?
	printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo4'>Usted ha seleccionado como <b>Fecha Inicial</b> : %s y como <b>Fecha Final</b> : %s</center>
	</div>
	",$fecha_ini,$fecha_fin);
	?>
<?php
//-------
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from car_ppto_ing where id_emp = '$id_emp' order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);


	printf("
	<center>
	
	<table width='1800' BORDER='1' class='bordepunteado1'>
	<tr bgcolor='#DCE9E5'>
	<td align='center' width='150'><span class='Estilo4'><b>Cod. Pptal</b></span></td>
	<td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
	<td align='center' width='300'><span class='Estilo4'><b>Codigo Fut</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Vr. Inicial</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reducciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Creditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Contracreditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Enero</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Febrero</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Marzo</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Abril</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Mayo</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Junio</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Julio</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Agosto</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Septiembre</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Octubre</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Noviembre</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Diciembre</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Total</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
	
	");
	
	while($rw = mysql_fetch_array($re)) 
	   {
	
	$link=mysql_connect($server,$dbuser,$dbpass);
	
	//****
	$fut=$rw["cod_fut"];
	$cod=$rw["cod_pptal"];
	$nom_rubro=$rw["nom_rubro"];
	//****
	
	//****
	
	$resultax=mysql_query("select SUM(ppto_aprob) AS TOTAL from car_ppto_ing WHERE (ano between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$rowx=mysql_fetch_row($resultax);
	$inicial=$rowx[0];
	//****
	
	$resulta=mysql_query("select SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row=mysql_fetch_row($resulta);
	$total_adi=$row[0]; 
	
	$resulta2=mysql_query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row2=mysql_fetch_row($resulta2);
	$total_red=$row2[0];
	
	$resulta9=mysql_query("select SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row9=mysql_fetch_row($resulta9);
	$total_cotracred=$row9[0];
	
	$resulta8=mysql_query("select SUM(valor_adi) AS TOTAL from creditos_ing WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_cred=$row8[0];
	
	$definitivo = $inicial + $total_adi - $total_red + $total_cred - $total_cotracred;
	
	
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];

if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin')  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin')  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	
	
	
	$reconocimientos = $total_reip + $total_ncbt + $total_rcgt + $total_tnat;
	$recaudos = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
	$saldo_x_ejec = $definitivo - $reconocimientos;
	$cxc = $reconocimientos - $recaudos;
	
// fechas
$anno2 = split("/",$fecha_ini);
$anno = $anno2[0];
// enero
$ene_ini = $anno."/01/01";
$ene_fin = $anno."/01/31";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$ene_ini' and '$ene_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$ene_ini' and '$ene_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$ene_ini' and '$ene_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$ene_ini' and '$ene_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$ene_ini' and '$ene_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$ene_ini' and '$ene_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$ene_ini' and '$ene_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$ene_ini' and '$ene_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$ene_ini' and '$ene_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$ene_ini' and '$ene_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$ene_ini' and '$ene_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	


	$recaudos_ene =  $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
// febrero
$feb_ini = $anno."/02/01";
$feb_fin = $anno."/02/29";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$feb_ini' and '$feb_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$feb_ini' and '$feb_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$feb_ini' and '$feb_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$feb_ini' and '$feb_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$feb_ini' and '$feb_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$feh_ini' and '$feb_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$feh_ini' and '$feb_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$feh_ini' and '$feb_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$feh_ini' and '$feb_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$feh_ini' and '$feb_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$feh_ini' and '$feb_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	


	$recaudos_feb = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
// marzo
$mar_ini = $anno."/03/01";
$mar_fin = $anno."/03/31";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$mar_ini' and '$mar_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$mar_ini' and '$mar_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$mar_ini' and '$mar_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$mar_ini' and '$mar_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$mar_ini' and '$mar_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
	if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$mar_ini' and '$mar_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$mar_ini' and '$mar_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$mar_ini' and '$mar_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$mar_ini' and '$mar_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$mar_ini' and '$mar_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$mar_ini' and '$mar_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	


	$recaudos_mar =$total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
// Abril 
$abr_ini = $anno."/04/01";
$abr_fin = $anno."/04/31";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$abr_ini' and '$abr_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$abr_ini' and '$abr_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$abr_ini' and '$abr_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$abr_ini' and '$abr_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$abr_ini' and '$abr_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];

	if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$abr_ini' and '$abr_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$abr_ini' and '$abr_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$abr_ini' and '$abr_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$abr_ini' and '$abr_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$abr_ini' and '$abr_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$abr_ini' and '$abr_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	


	$recaudos_abr = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
// Mayo
$may_ini = $anno."/05/01";
$may_fin = $anno."/05/31";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$may_ini' and '$may_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$may_ini' and '$may_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$may_ini' and '$may_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$may_ini' and '$may_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$may_ini' and '$may_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
		if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$may_ini' and '$may_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$may_ini' and '$may_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$may_ini' and '$may_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$may_ini' and '$may_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$may_ini' and '$may_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$may_ini' and '$may_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	


	$recaudos_may = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
// Junio
$jun_ini = $anno."/06/01";
$jun_fin = $anno."/06/30";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$jun_ini' and '$jun_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$jun_ini' and '$jun_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$jun_ini' and '$jun_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$jun_ini' and '$jun_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$jun_ini' and '$jun_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
			if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$jun_ini' and '$jun_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$jun_ini' and '$jun_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$jun_ini' and '$jun_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$jun_ini' and '$jun_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$jun_ini' and '$jun_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$jun_ini' and '$jun_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	


	$recaudos_jun =$total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
// Julio
$jul_ini = $anno."/07/01";
$jul_fin = $anno."/07/31";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$jul_ini' and '$jul_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$jul_ini' and '$jul_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$jul_ini' and '$jul_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$jul_ini' and '$jul_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$jul_ini' and '$jul_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];

			if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$jul_ini' and '$jul_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$jul_ini' and '$jul_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$jul_ini' and '$jul_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$jul_ini' and '$jul_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$jul_ini' and '$jul_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$jul_ini' and '$jul_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	

	$recaudos_jul = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;

// Agosto
$ago_ini = $anno."/08/01";
$ago_fin = $anno."/08/31";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$ago_ini' and '$ago_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$ago_ini' and '$ago_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$ago_ini' and '$ago_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$ago_ini' and '$ago_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$ago_ini' and '$ago_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
				if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$ago_ini' and '$ago_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$ago_ini' and '$ago_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$ago_ini' and '$ago_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$ago_ini' and '$ago_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$ago_ini' and '$ago_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$ago_ini' and '$ago_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	


	$recaudos_ago = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
// Septiembre
$sep_ini = $anno."/09/01";
$sep_fin = $anno."/09/30";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$sep_ini' and '$sep_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$sep_ini' and '$sep_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$sep_ini' and '$sep_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$sep_ini' and '$sep_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$sep_ini' and '$sep_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
				if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$sep_ini' and '$sep_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$sep_ini' and '$sep_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$sep_ini' and '$sep_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$sep_ini' and '$sep_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$sep_ini' and '$sep_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$sep_ini' and '$sep_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	



	$recaudos_sep = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
// octubre
$oct_ini = $anno."/10/01";
$oct_fin = $anno."/10/31";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$oct_ini' and '$oct_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$oct_ini' and '$oct_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$oct_ini' and '$oct_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$oct_ini' and '$oct_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$oct_ini' and '$oct_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
					if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$oct_ini' and '$oct_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$oct_ini' and '$oct_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$oct_ini' and '$oct_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$oct_ini' and '$oct_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$oct_ini' and '$oct_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$oct_ini' and '$oct_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	



	$recaudos_oct = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
// Noviembre
$nov_ini = $anno."/11/01";
$nov_fin = $anno."/11/30";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$nov_ini' and '$nov_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$nov_ini' and '$nov_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$nov_ini' and '$nov_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$nov_ini' and '$nov_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$nov_ini' and '$nov_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
						if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$nov_ini' and '$nov_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$nov_ini' and '$nov_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$nov_ini' and '$nov_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$nov_ini' and '$nov_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$nov_ini' and '$nov_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$nov_ini' and '$nov_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	



	$recaudos_nov = $recaudos_oct = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
// Diciembre
$dic_ini = $anno."/12/01";
$dic_fin = $anno."/12/31";
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$dic_ini' and '$dic_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$dic_ini' and '$dic_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$dic_ini' and '$dic_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$dic_ini' and '$dic_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$dic_ini' and '$dic_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
							if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$dic_ini' and '$dic_fin' )  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$dic_ini' and '$dic_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$dic_ini' and '$dic_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$dic_ini' and '$dic_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$dic_ini' and '$dic_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$dic_ini' and '$dic_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}	


	$recaudos_dic = $recaudos_oct = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
	printf("
	<span class='Estilo4'>
	<tr>
	<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
	<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
	<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	
	</tr>", $cod, $nom_rubro, $fut, number_format($inicial,2,',','.'), number_format($total_adi,2,',','.'), number_format($total_red,2,',','.'),number_format($total_cred,2,',','.'),number_format($total_cotracred,2,',','.'), number_format($definitivo,2,',','.'), number_format($recaudos_ene,2,',','.'), number_format($recaudos_feb,2,',','.'), number_format($recaudos_mar,2,',','.'), number_format($recaudos_abr,2,',','.'), number_format($recaudos_may,2,',','.'), number_format($recaudos_jun,2,',','.'), number_format($recaudos_jul,2,',','.'), number_format($recaudos_ago,2,',','.'), number_format($recaudos_sep,2,',','.'), number_format($recaudos_oct,2,',','.'), number_format($recaudos_nov,2,',','.'), number_format($recaudos_dic,2,',','.'), number_format($recaudos,2,',','.'), $rw["tip_dato"], $rw["nivel"]); 
	
	
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