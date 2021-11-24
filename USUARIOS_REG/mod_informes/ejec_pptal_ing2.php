<?
set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=EJECUCION_DE_INGRESOS cc.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<script>
function VerFecha()
{
	if (document.getElementById("mov_periodo").checked)
		{
			document.getElementById("fecha_periodo").style.display="inline";
			document.getElementById("mov_mes").checked='';
		}else{
			document.getElementById("fecha_periodo").style.display="none";
		}
}

function VerMes()
{
	if (document.getElementById("mov_mes").checked)
		{
			document.getElementById("mov_periodo").checked='';
			document.getElementById("fecha_periodo").style.display="none";
		}
}
</script>

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

	$fecha_ini=$_POST['fecha_ini']; //printf("fecha ini : %s",$fecha_ini);
	$fecha_fin=$_POST['fecha_fin'];	//printf("fecha fin : %s",$fecha_fin);
	$tipo = $_POST['mov_mes'];
	$fecha_per = $_POST['fecha_per'];
	$mov_periodo = $_POST['mov_periodo'];
	$central = $_POST['central'];
	$anno = substr($ano,0,4);
	if($central ==1) $sia = "and cod_sia != 'E' and cod_sia != 'S' and cod_sia != 'T' and cod_sia != 'v'"; 	
// Para cargar la url e incluir imagenes al archivo que se genera
//echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/imagen.gif";          
//***** Consulto la base para llenar la tabla 
$ruta_img = "http://$_SERVER[HTTP_HOST]/USUARIOS_REG/images/PLANTILLA PNG PARA LOGO EMPRESA.png";
if($mov_periodo =='')
{

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
    <td align="center" colspan="11"><font size="4"><b>EJECUCION PRESUPUESTAL DE INGRESOS </b></font></td>
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
$sq = "select * from car_ppto_ing where id_emp = '$id_emp' $sia order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);
// ******************************************************* con recaudos del mes **********************************************************************************
if ($tipo ==1) 
{
	printf("
	<center>
	
	<table width='1800' BORDER='1' class='bordepunteado1'>
	<tr bgcolor='#DCE9E5'>
	<td align='center' width='150'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>Cod. Pptal</b></span>
	</div>
	</td>
	<td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Vr. Inicial</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones del mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
		<td align='center' width='150'><span class='Estilo4'><b>Reducciones del mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reducciones</b></span></td>
		<td align='center' width='150'><span class='Estilo4'><b>Creditos del mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Creditos</b></span></td>
		<td align='center' width='150'><span class='Estilo4'><b>Contracreditos del mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Contracreditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reconocimientos Mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reconocimientos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Recaudos Mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Recaudos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Saldo x Ejec</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Cuentas x Cobrar</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
	
	");
	
	// Calculo de gastos por mes 
	$mes = split("/",$fecha_fin);
	
	if ($mes[1]=="01") {$mes_ini = "$anno/01/01"; $mes_fin ="$anno/01/31";}
	if ($mes[1]=="02") {$mes_ini = "$anno/02/01"; $mes_fin ="$anno/02/29";}
	if ($mes[1]=="03") {$mes_ini = "$anno/03/01"; $mes_fin ="$anno/03/31";}
	if ($mes[1]=="04") {$mes_ini = "$anno/04/01"; $mes_fin ="$anno/04/30";}
	if ($mes[1]=="05") {$mes_ini = "$anno/05/01"; $mes_fin ="$anno/05/31";}
	if ($mes[1]=="06") {$mes_ini = "$anno/06/01"; $mes_fin ="$anno/06/30";}
	if ($mes[1]=="07") {$mes_ini = "$anno/07/01"; $mes_fin ="$anno/07/31";}
	if ($mes[1]=="08") {$mes_ini = "$anno/08/01"; $mes_fin ="$anno/08/31";}
	if ($mes[1]=="09") {$mes_ini = "$anno/09/01"; $mes_fin ="$anno/09/30";}
	if ($mes[1]=="10") {$mes_ini = "$anno/10/01"; $mes_fin ="$anno/10/31";}
	if ($mes[1]=="11") {$mes_ini = "$anno/11/01"; $mes_fin ="$anno/11/30";}
	if ($mes[1]=="12") {$mes_ini = "$anno/12/01"; $mes_fin ="$anno/12/31";}

	while($rw = mysql_fetch_array($re)) 
	   {
	
	$link=mysql_connect($server,$dbuser,$dbpass);
	
	//****
	
	$cod=$rw["cod_pptal"];
	$cod_sia= $rw["cod_sia"];
	
	$nom_rubro=$rw["nom_rubro"];
	//****
	
	$resultax=mysql_query("select SUM(ppto_aprob) AS TOTAL from car_ppto_ing WHERE ano <= '$fecha_fin'  and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%' ",$link) or die (mysql_error());
	$rowx=mysql_fetch_row($resultax);
	$inicial=$rowx[0];
	//****
	
	$resulta=mysql_query("select SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row=mysql_fetch_row($resulta);
	$total_adi=$row[0]; 
	
	
	$resulta2=mysql_query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row2=mysql_fetch_row($resulta2);
	$total_red=$row2[0];
	
	$resulta9=mysql_query("select SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE fecha_adi <= '$fecha_fin'  and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row9=mysql_fetch_row($resulta9);
	$total_cotracred=$row9[0];
	
	$resulta8=mysql_query("select SUM(valor_adi) AS TOTAL from creditos_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_cred=$row8[0];
	
	$definitivo = $inicial + $total_adi - $total_red + $total_cred - $total_cotracred;
	
	
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE fecha_reg <=  '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
    $resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	echo "select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'";
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];	
	
if ($empresa =='MUNICIPIO DE IPIALES')
{
	
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE fecha_recaudo <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE fecha_recaudo <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];


	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE fecha_recaudo  <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];


$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE fecha_recaudo <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}


	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE fecha_recaudo  <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
	$reconocimientos = $total_reip + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
	$recaudos = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
	$saldo_x_ejec = $definitivo - $reconocimientos;
	$cxc = $reconocimientos - $recaudos;
	
	// Consultas VALORES CAUSADOS EN EL MES ***********************************************************************************************************
	
	$resulta10=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$mes_ini' and '$fecha_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row10=mysql_fetch_row($resulta10);
	$total_reip_mes=$row10[0];
	
	$resulta11=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE fecha_recaudo  <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row11=mysql_fetch_row($resulta11);
	$total_ncbt_mes=$row11[0];
	
	$resulta12=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row12=mysql_fetch_row($resulta12);
	$total_rcgt_mes=$row12[0];
	
	$resulta13=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row13=mysql_fetch_row($resulta13);
	$total_tnat_mes=$row13[0];
	
	$resulta14=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row14=mysql_fetch_row($resulta14);
	$total_roit_mes=$row14[0];
	
	 $resulta15=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row15=mysql_fetch_row($resulta15);
	$total_riip_mes=$row15[0];
if ($empresa =='MUNICIPIO DE IPIALES')
{

	
	$resulta15=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row15=mysql_fetch_row($resulta15);
	$total_riur_mes=$row15[0];
	
	$resulta15=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row15=mysql_fetch_row($resulta15);
	$total_rtic_mes=$row15[0];
	
	$resulta15=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row15=mysql_fetch_row($resulta15);
	$total_rica_mes=$row15[0];
	
	$resulta151=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row151=mysql_fetch_row($resulta151);
	$total_rica_mes1=$row151[0];
	
	$resulta152=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row152=mysql_fetch_row($resulta152);
	$total_rica_mes2=$row152[0];
}
	$sq153 ="select SUM(valor_adi) AS totalam from adi_ppto_ing WHERE (fecha_adi between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'";
	$resulta153=mysql_query($sq153,$link) or die (mysql_error());
	$row153=mysql_fetch_row($resulta153);
	$total_adi_mes=$row153[0];
	
	$resulta154=mysql_query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE (fecha_adi between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row154=mysql_fetch_row($resulta154);
	$total_red_mes=$row154[0];
	
	$resulta155=mysql_query("select SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE (fecha_adi between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row155=mysql_fetch_row($resulta155);
	$total_ccr_mes=$row155[0];
	
	$resulta156=mysql_query("select SUM(valor_adi) AS TOTAL from creditos_ing WHERE (fecha_adi between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row156=mysql_fetch_row($resulta156);
	$total_cre_mes=$row156[0];

	
	$recaudos_mes = $total_roit_mes + $total_ncbt_mes + $total_rcgt_mes + $total_tnat_mes + $total_riip_mes+ $total_riur_mes+ $total_rtic_mes+ $total_rica_mes+$total_rica_mes1+ $total_rica_mes2;
	
	$reconocimientos_mes = $recaudos_mes + $total_reip_mes - $total_roit_mes ;
	
	printf("
	<span class='Estilo4'>
	<tr>
	
	<td align='left' class='text'>%s </td>  
	<td align='left'><span class='Estilo4'>%s</span></td>
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
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	
	
	</tr>", $cod , $nom_rubro, number_format($inicial,2,'.',','),  number_format($total_adi_mes,2,'.',',') ,number_format($total_adi,2,'.',','),  number_format($total_red_mes,2,'.',','),number_format($total_red,2,'.',','),number_format($total_cre_mes,2,'.',','),number_format($total_cred,2,'.',','),number_format($total_ccr_mes,2,'.',','),number_format($total_cotracred,2,'.',','), number_format($definitivo,2,'.',','),  number_format($reconocimientos_mes,2,'.',','), number_format($reconocimientos,2,'.',','), number_format($recaudos_mes,2,'.',','),number_format($recaudos,2,'.',','), number_format($saldo_x_ejec,2,'.',','), number_format($cxc,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
	
	
	   $reconocimientos_mes=0;
	   }
	printf("</table></center>");
	
}else{
	
	printf("
	<center>
	
	<table width='1800' BORDER='1' class='bordepunteado1'>
	<tr bgcolor='#DCE9E5'>
	<td align='center' width='150'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>Cod. Pptal</b></span>
	</div>
	</td>
	<td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Vr. Inicial</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reducciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Creditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Contracreditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reconocimientos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Recaudos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Saldo x Ejec</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Cuentas x Cobrar</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
	");
	
	while($rw = mysql_fetch_array($re)) 
	   {
	
	$link=mysql_connect($server,$dbuser,$dbpass);
	
	//****
	
	$cod=$rw["cod_pptal"];
	$nom_rubro=$rw["nom_rubro"];
	//****
	
	//****
	$resultax=mysql_query("select SUM(ppto_aprob) AS TOTAL from car_ppto_ing WHERE ano <= '$fecha_fin'  and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$rowx=mysql_fetch_row($resultax);
	$inicial=$rowx[0];
	//****
	
	$resulta=mysql_query("select SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE fecha_adi <= '$fecha_fin'  and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row=mysql_fetch_row($resulta);
	$total_adi=$row[0]; 
	
	$resulta2=mysql_query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row2=mysql_fetch_row($resulta2);
	$total_red=$row2[0];
	
	$resulta9=mysql_query("select SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row9=mysql_fetch_row($resulta9);
	$total_cotracred=$row9[0];
	
	$resulta8=mysql_query("select SUM(valor_adi) AS TOTAL from creditos_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_cred=$row8[0];
	
	$definitivo = $inicial + $total_adi - $total_red + $total_cred - $total_cotracred;
	
	
	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE fecha_reg <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt where fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE fecha_recaudo <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riip=$row8[0];
	
if ($empresa =='MUNICIPIO DE IPIALES')
{
	
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_riur=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rtic=$row8[0];
	
	$resulta8=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_rica=$row8[0];

	$resulta81=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row81=mysql_fetch_row($resulta81);
	$total_rica1=$row81[0];

	$resulta82=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row82=mysql_fetch_row($resulta82);
	$total_rica2=$row82[0];
}
	
	
	$reconocimientos = $total_reip + $total_ncbt + $total_rcgt + $total_tnat + $total_riip+ $total_riur+ $total_rtic+ $total_rica+ $total_rica1+ $total_rica2;
	$recaudos = $total_roit + $total_ncbt + $total_rcgt + $total_tnat + $total_riip + $total_riur+ $total_rtic+ $total_rica+ $total_rica1+ $total_rica2;
	$saldo_x_ejec = $definitivo - $reconocimientos;
	$cxc = $reconocimientos - $recaudos;
	
	
	
	printf("
	<span class='Estilo4'>
	<tr>
	<td align='left' class='text'>%s</td>
	<td align='left'><span class='Estilo4'>%s</span></td>
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
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	</tr>", $cod, $nom_rubro, number_format($inicial,2,'.',','), number_format($total_adi,2,'.',','), number_format($total_red,2,'.',','),number_format($total_cred,2,'.',','),number_format($total_cotracred,2,'.',','), number_format($definitivo,2,'.',','), number_format($reconocimientos,2,'.',','), number_format($recaudos,2,'.',','), number_format($saldo_x_ejec,2,'.',','), number_format($cxc,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
	
	
	   }
	   
	printf("</table></center>");

}

}else{
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
    <td align="center" colspan="11"><font size="4"><b>EJECUCION PRESUPUESTAL DE INGRESOS X PERIODO</b></font></td>
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
	<center>
	
	<table width='1800' BORDER='1' class='bordepunteado1'>
	<tr bgcolor='#DCE9E5'>
	<td align='center' width='150'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>Cod. Pptal</b></span>
	</div>
	</td>
	<td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reducciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Creditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Contracreditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reconocimientos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Recaudos</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
	");
	
	// Calculo de gastos por mes 
	$mes = split("/",$fecha_fin);
	
	if ($mes[1]=="01") {$mes_ini = "$anno/01/01"; $mes_fin ="$anno/01/31";}
	if ($mes[1]=="02") {$mes_ini = "$anno/02/01"; $mes_fin ="$anno/02/29";}
	if ($mes[1]=="03") {$mes_ini = "$anno/03/01"; $mes_fin ="$anno/03/31";}
	if ($mes[1]=="04") {$mes_ini = "$anno/04/01"; $mes_fin ="$anno/04/30";}
	if ($mes[1]=="05") {$mes_ini = "$anno/05/01"; $mes_fin ="$anno/05/31";}
	if ($mes[1]=="06") {$mes_ini = "$anno/06/01"; $mes_fin ="$anno/06/30";}
	if ($mes[1]=="07") {$mes_ini = "$anno/07/01"; $mes_fin ="$anno/07/31";}
	if ($mes[1]=="08") {$mes_ini = "$anno/08/01"; $mes_fin ="$anno/08/31";}
	if ($mes[1]=="09") {$mes_ini = "$anno/09/01"; $mes_fin ="$anno/09/30";}
	if ($mes[1]=="10") {$mes_ini = "$anno/10/01"; $mes_fin ="$anno/10/31";}
	if ($mes[1]=="11") {$mes_ini = "$anno/11/01"; $mes_fin ="$anno/11/30";}
	if ($mes[1]=="12") {$mes_ini = "$anno/12/01"; $mes_fin ="$anno/12/31";}
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from car_ppto_ing where id_emp = '$id_emp' order by cod_pptal asc ";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
{
	
	$link=mysql_connect($server,$dbuser,$dbpass);
	
	//****
	
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
	
		$resulta=mysql_query("select SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row=mysql_fetch_row($resulta);
	$total_adi_p=$row[0]; 
	
	$resulta2=mysql_query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row2=mysql_fetch_row($resulta2);
	$total_red_p=$row2[0];
	
	$resulta9=mysql_query("select SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row9=mysql_fetch_row($resulta9);
	$total_cotracred_p=$row9[0];
	
	$resulta8=mysql_query("select SUM(valor_adi) AS TOTAL from creditos_ing WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'",$link) or die (mysql_error());
	$row8=mysql_fetch_row($resulta8);
	$total_cred=$row8[0];

	$resulta3=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row3=mysql_fetch_row($resulta3);
	$total_reip=$row3[0];
	
	$resulta4=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row4=mysql_fetch_row($resulta4);
	$total_ncbt=$row4[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rcgt=$row5[0];
if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_riip=$row5[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_riur=$row5[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rtic=$row5[0];
	
	$resulta5=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row5=mysql_fetch_row($resulta5);
	$total_rica=$row5[0];


$resulta51=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row51=mysql_fetch_row($resulta51);
	$total_rica1=$row51[0];


$resulta52=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row52=mysql_fetch_row($resulta52);
	$total_rica2=$row52[0];
}
	
	$resulta6=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row6=mysql_fetch_row($resulta6);
	$total_tnat=$row6[0];
	
	$resulta7=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row7=mysql_fetch_row($resulta7);
	$total_roit=$row7[0];
	
	$reconocimientos = $total_reip + $total_ncbt + $total_rcgt + $total_tnat + $total_riip + $total_riur + $total_rtic + $total_rica + $total_rica1+ $total_rica2 ;
	$recaudos = $total_roit + $total_ncbt + $total_rcgt + $total_tnat + $total_riip + $total_riur + $total_rtic + $total_rica + $total_rica1+ $total_rica2 ;
	$saldo_x_ejec = $definitivo - $reconocimientos;
	$cxc = $reconocimientos - $recaudos;
	
	// Consultas reconocimientos mes
	
	$resulta10=mysql_query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row10=mysql_fetch_row($resulta10);
	$total_reip_mes=$row10[0];
	
	$resulta11=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row11=mysql_fetch_row($resulta11);
	$total_ncbt_mes=$row11[0];
	
	$resulta12=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row12=mysql_fetch_row($resulta12);
	$total_rcgt_mes=$row12[0];
	
	$resulta13=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row13=mysql_fetch_row($resulta13);
	$total_tnat_mes=$row13[0];
	
	$resulta14=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'",$link) or die (mysql_error());
	$row14=mysql_fetch_row($resulta14);
	$total_roit_mes=$row14[0];

if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta15=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row15=mysql_fetch_row($resulta15);
	$total_riip_mes=$row15[0];
	
	$resulta15=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row15=mysql_fetch_row($resulta15);
	$total_riur_mes=$row15[0];
	
	$resulta15=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row15=mysql_fetch_row($resulta15);
	$total_rtic_mes=$row15[0];
	
	$resulta15=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row15=mysql_fetch_row($resulta15);
	$total_rica_mes=$row15[0];


$resulta151=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row151=mysql_fetch_row($resulta151);
	$total_rica_mes1=$row151[0];


$resulta152=mysql_query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'",$link) or die (mysql_error());
	$row152=mysql_fetch_row($resulta152);
	$total_rica_mes2=$row152[0];
}

	$reconocimientos_mes = $total_reip_mes + $total_ncbt_mes + $total_rcgt_mes + $total_tnat_mes + $total_riip_mes +$total_riur_mes +$total_rtic_mes +$total_rica_mes +$total_rica_mes1 +$total_rica_mes2 ;
	$recaudos_mes = $total_roit_mes + $total_ncbt_mes + $total_rcgt_mes + $total_tnat_mes +$total_riip_mes +$total_riur_mes +$total_rtic_mes +$total_rica_mes +$total_rica_mes1 +$total_rica_mes2 ;
	
	printf("
	<span class='Estilo4'>
	<tr>
	
	<td align='left' class='text'>%s</td>
	<td align='left'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	
	
	
	</tr>", $cod, $nom_rubro, number_format($definitivo,2,'.',','), number_format($total_adi_p,2,'.',','), number_format($total_red_p,2,'.',','),number_format($total_cred_p,2,'.',','),number_format($total_cotracred_p,2,'.',','),   number_format($reconocimientos,2,'.',','), number_format($recaudos,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
	
	
	   
}
	printf("</table></center>");
	

	
}
	
//--------	
?>
<br />
</body>
</html>
<?
}
?>