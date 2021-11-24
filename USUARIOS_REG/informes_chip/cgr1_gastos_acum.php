<?php
set_time_limit(3600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CGR_GASTOS.xls");
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
// Para cargar la url e incluir imagenes al archivo que se genera
//echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/imagen.gif";          
//***** Consulto la base para llenar la tabla 
printf("
<table width='1500' BORDER='1'>
<tr>
<td align='center'>S</td>
<td align='center'>COD_ENTIDAD</td>
<td align='center'>$periodo2</td>
<td align='center'>$anno</td>
<td>PROGRAMACIONDEGASTOS</td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
</tr>
		");
include('../config.php');
$cx=mysql_connect ($server, $dbuser, $dbpass);
$sq = "SELECT  ctrl, cod_cgr, vig_gasto, cod_rec,oer, cda, finalidad_gasto, sum(ppto_aprob) as aprobado, sum(sum_adiciones) as adicion, sum(sum_reducciones) as reduccion, sum(cancelaciones) as cancelacion, sum(sum_creditos) as creditos, sum(sum_contracreditos) as contracreditos, sum(sum_aplazamientos) as aplazamientos,sum(sum_desaplazamientos) as desaplazamientos, sum(definitivo) as definitivo,sum(suma_cdpp) as cdpp,sum(reversion_cdpp) as reversar_cdpp from cgr_gastos_acumula group by ctrl,cod_cgr,vig_gasto, cod_rec, oer, cda, finalidad_gasto";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
{
printf("<tr>
	<td align='center' width='20'>%s</td>
	<td align='left' width='150'>%s</td>
	<td align='center' width='20'>%s</td>
	<td align='center' width='50'>%s</td>
	<td align='center' class='text'>%s</td>
	<td align='center' width='50' class='text'>%s</td>
	<td align='center' width='60'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
		</tr>",$rw["ctrl"],$rw["cod_cgr"],$rw["vig_gasto"],$rw["cod_rec"],$rw["oer"],$rw["cda"],$rw["finalidad_gasto"],$rw["aprobado"],$rw["adicion"],$rw["reduccion"],$rw["cancelacion"],$rw["creditos"],$rw["contracreditos"],$rw["aplazamientos"],$rw["desaplazamientos"],$rw["definitivo"],$rw["cdpp"],$rw["reversar_cdpp"]);
} // End While rw
echo "</table>";
?>
</body>
</html>
<?php          
}
?>
