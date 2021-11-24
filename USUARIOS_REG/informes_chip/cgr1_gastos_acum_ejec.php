<?php
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CGR_GASTOS_EJEC.xls");
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
include("../config.php");
$conEmp = new mysqli($server, $dbuser, $dbpass, $database);
$reb =mysql_db_query($database,"select * from empresa",$conEmp);
$rwb =mysql_fetch_array($reb);
$cod_cgn = $rwb["cod_cgn"];
//mysql_select_db($database, $conEmp);
$rea =mysql_db_query($database,"select * from cgr_aux_gas",$conEmp);
$rwa =mysql_fetch_array($rea);
$fecha = $rwa["fecha"];
$fecha2 = explode("/", $fecha);
$anno = $fecha2[0];
$periodo = $fecha2[1];
if ($periodo =='03') $periodo2 ='10103';
if ($periodo =='06') $periodo2 ='10406';
if ($periodo =='09') $periodo2 ='10709';
if ($periodo =='12') $periodo2 ='11012';
//***** Consulto la base para llenar la tabla 
printf("
<table width='1500' BORDER='1'>
<tr>
<td align='center'>S</td>
<td align='center'>$cod_cgn</td>
<td align='center'>$periodo2</td>
<td align='center'>$anno</td>
<td>EJECUCIONDEGASTOS</td>
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
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
</tr>
<tr>
<td  bgcolor='#CCCCCC' align='center'>CONTROL</td>
<td bgcolor='#CCCCCC' align='center'>CONCEPTO</td>
<td bgcolor='#CCCCCC' align='center'>VIGENCIA</td>
<td bgcolor='#CCCCCC' align='center'>DEPENDENCIA</td>
<td bgcolor='#CCCCCC' >RECURSOS</td>
<td bgcolor='#CCCCCC' align='center'>ORIGEN</td>
<td bgcolor='#CCCCCC' align='center'>DESTINACION</td>
<td bgcolor='#CCCCCC' align='center'>FINALIDAD</td>
<td bgcolor='#CCCCCC' align='center'>SITUACION</td>
<td bgcolor='#CCCCCC' align='center'>No COMP</td>
<td bgcolor='#CCCCCC' align='center'>No OBLI</td>
<td bgcolor='#CCCCCC' align='center'>No PAGO</td>
<td bgcolor='#CCCCCC' align='center'>RECIPROCA</td>
<td bgcolor='#CCCCCC' align='center'>COMP ANTICIPO</td>
<td bgcolor='#CCCCCC' align='center'>COMP SIN ANTICIPO</td>
<td bgcolor='#CCCCCC' align='center'>REVER COMP</td>
<td bgcolor='#CCCCCC' align='center'>OBLIGACION</td>
<td bgcolor='#CCCCCC' align='center'>REVER OBLI</td>
<td bgcolor='#CCCCCC' align='center'>PAGOS</td>
<td bgcolor='#CCCCCC' align='center'>ANULACION PAGOS</td>
<td bgcolor='#CCCCCC' align='center'>RESERVAS PTALES</td>
<td bgcolor='#CCCCCC' align='center'>CUENTAS X PAGAR</td>
<td bgcolor='#CCCCCC' align='center'>OBL X EJEC</td>
</tr>
		");
include('../config.php');
$cx=mysql_connect ($server, $dbuser, $dbpass);
$sq = "SELECT  ctrl, cod_cgr, vig_gasto, unid_ejec, cod_rec, oer, cda, finalidad_gasto,situacion,sum(n_com),sum(n_obl),sum(n_pag),reciproca,sum(compromisos_ca),sum(compromisos_sa),sum(compromisos_rev),sum(obligaciones),sum(obligaciones_rev),sum(pagos),sum(pagos_rev) from cgr_gastos_acumula group by ctrl, cod_cgr, vig_gasto, unid_ejec, cod_rec, oer, cda, finalidad_gasto,situacion,reciproca";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
{
$suma = $rw["sum(compromisos_ca)"]+$rw["sum(compromisos_sa)"]+$rw["sum(compromisos_rev)"]+$rw["sum(obligaciones)"]+$rw["sum(obligaciones_rev)"]+$rw["sum(pagos)"]+$rw["sum(pagos_rev)"];
if ($suma >0)
{
printf("<tr>
	<td align='center' width='20'>%s</td>
	<td align='left' width='150'>%s</td>
	<td align='center' width='20'>%s</td>
	<td align='center' width='50' class='text' bgcolor='#CCCCCC'>%s</td>
	<td align='center' >%s</td>
	<td align='center' width='50' class='text'>%s</td>
	<td align='center' width='60' class='text'>%s</td>
	<td align='right' width='50'>%s</td>
	<td align='right' width='30'>%s</td>
	<td align='right' width='30'>%s</td>
	<td align='right' width='30' bgcolor='#CCCCCC'>%s</td>
	<td align='right' width='30' >%s</td>
	<td align='right' width='120' class='text'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
	<td align='right' width='100' bgcolor='#CCCCCC'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	<td align='right' width='100'>%s</td>
	</tr>
	",$rw["ctrl"],$rw["cod_cgr"],$rw["vig_gasto"],$rw["unid_ejec"],$rw["cod_rec"],$rw["oer"],$rw["cda"],$rw["finalidad_gasto"],$rw["situacion"],$rw["sum(n_com)"],$rw["sum(n_obl)"],$rw["sum(n_pag)"],$rw["reciproca"],$rw["sum(compromisos_ca)"],$rw["sum(compromisos_sa)"],$rw["sum(compromisos_rev)"],$rw["sum(obligaciones)"],$rw["sum(obligaciones_rev)"],$rw["sum(pagos)"],$rw["sum(pagos_rev)"],0,0,0);
} // end if
$suma =0;
} // End While rw
echo "</table>";
?>
</body>
</html>
<?php          
}
?>
