<?
set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=EJECUCION_DE_INGRESOS.xls");
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
	<td align='center' width='150'><span class='Estilo4'><b>Disponibilidades</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Compromisos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Obligaciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Pagos</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
	");
	
	// Calculo de gastos por mes 
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sq = "select * from z_central_gas  order by cod asc ";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
{
	
	$cod=$rw["cod"];
	$nom=$rw["nombre"];
	//****
	
	//****
	$sql="select SUM(def) AS TOTAL from z_central_gas WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs1=mysql_query($sql,$cx);
	$rw1=mysql_fetch_row($rs1);
	$def=$rw1[0];
	
	$sq2="select SUM(adi) AS TOTAL from z_central_gas WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs2=mysql_query($sq2,$cx);
	$rw2=mysql_fetch_row($rs2);
	$adi=$rw2[0];
	
	$sq3="select SUM(cre) AS TOTAL from z_central_gas WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs3=mysql_query($sq3,$cx);
	$rw3=mysql_fetch_row($rs3);
	$cre=$rw3[0];
	
	$sq4="select SUM(ccre) AS TOTAL from z_central_gas WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs4=mysql_query($sq4,$cx);
	$rw4=mysql_fetch_row($rs4);
	$ccre=$rw4[0];
	
	$sq5="select SUM(com) AS TOTAL from z_central_gas WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs5=mysql_query($sq5,$cx);
	$rw5=mysql_fetch_row($rs5);
	$com=$rw5[0];
	
	$sq6="select SUM(obl) AS TOTAL from z_central_gas WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs6=mysql_query($sq6,$cx);
	$rw6=mysql_fetch_row($rs6);
	$obl=$rw6[0];
	
	$sq7="select SUM(pag) AS TOTAL from z_central_gas WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs7=mysql_query($sq7,$cx);
	$rw7=mysql_fetch_row($rs7);
	$pag=$rw7[0];
	
	
	$sq8="select SUM(cdp) AS TOTAL from z_central_gas WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs8=mysql_query($sq8,$cx);
	$rw8=mysql_fetch_row($rs8);
	$cdp=$rw8[0];
	//****
	
	
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
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	
	
	
	</tr>", $cod, $nom, number_format($def,2,'.',','), number_format($adi,2,'.',','), number_format($red,2,'.',','),number_format($cre,2,'.',','),number_format($ccre,2,'.',','),   number_format($cdp,2,'.',','),   number_format($com,2,'.',','), number_format($obl,2,'.',','), number_format($pag,2,'.',','), $rw["tip"], $rw["niv"]); 
	
	
	   
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