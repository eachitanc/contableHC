<?php
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=REPORTE_FLS_TESORERIA.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GCP - CONTRATACION</title>
<style>
.text
  {
 mso-number-format:"\@"
  }
.date
	{
	mso-number-format:"yyyy\/mm\/dd"	
	}
.numero
	{
	mso-number-format:"0"	
	}
</style>
</head>
<body>
<?php 
include("../../config.php");
$cx=mysql_connect ($server, $dbuser, $dbpass);
$rea =mysql_db_query($database,"select * from fut_aux_ing",$cx);
$rwa =mysql_fetch_array($rea);
$fecha = $rwa["fecha"];
$reb =mysql_db_query($database,"select * from empresa",$cx);
$rwb =mysql_fetch_array($reb);
$cod_cgn = $rwb["cod_cgn"];
$fecha2 = explode("/", $fecha);
$anno = $fecha2[0];
$periodo = $fecha2[1];
if ($periodo =='03') $periodo2 ='10103';
if ($periodo =='06') $periodo2 ='10406';
if ($periodo =='09') $periodo2 ='10709';
if ($periodo =='12') $periodo2 ='11012';
// Para cargar la url e incluir imagenes al archivo que se genera
//echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/imagen.gif";          
//***** Consulto la base para llenar la tabla 
printf("
<table width='1500' BORDER='1'>
<tr>
<td align='center'>S</td>
<td align='center'>$cod_cgn</td>
<td align='center'>$periodo2</td>
<td align='center'>$anno</td>
<td>REPORTE_DE_TESORERIA</td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
</tr>
		");
include('../../config.php');

$sq = "SELECT   ctrl, cod_cgr, sum(subsidiado), sum(salud_publica), sum(prest_servicios), sum(inversion), sum(funcionamiento), sum(total) from fls_tesoreria group by ctrl,cod_cgr";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
{
	if ($rw["sum(total)"] >0)
	{
printf("<tr>
	<td align='center' width='20'>%s</td>
	<td align='left' width='150'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
		</tr>",$rw["ctrl"],$rw["cod_cgr"],$rw["sum(subsidiado)"],$rw["sum(salud_publica)"],$rw["sum(prest_servicios)"],$rw["sum(inversion)"],$rw["sum(funcionamiento)"],0,$rw["sum(total)"]);
	}
} // End While rw
echo "</table>";
?>
</body>
</html>
<?php          
}
?>
