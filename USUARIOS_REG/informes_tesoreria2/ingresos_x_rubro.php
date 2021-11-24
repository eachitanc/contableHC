<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
	include('../config.php');
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT teso FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['teso']=='SI')
{


header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=RELACION DE INGRESOS.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
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
<?
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// llegan las variables
$fecha_ini = $_POST['fecha_ini'];
$fecha_fin = $_POST['fecha_fin'];
$rubro = $_POST['cod_ini'];
if ($codigo  !='') $fil = "and cuenta like '$codigo%'";
$mes = 13;
$periodo = array ("","ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE","ANUAL");
for ($i=1;$i<=13;$i++)
{
	if ($mes == $i) $per = $periodo[$i];
}
$suma=0;
echo "<table>
<tr>
	<td colspan='5' align='left'></td>
</tr>
<tr>
	<td colspan='5' align='center'><b>RELACION DE INGRESOS PRESUPUESTALES POR RUBRO</b></td>
</tr>
<tr>
	<td colspan='5' align='center'><b>Fecha Inicial</b> seleccionada <b>$fecha_ini</b> - <b>Fecha Final</b> seleccionada <b>$fecha_fin</b></td>
</tr>
<tr>
	<td colspan='5' align='left'></td>
</tr>
</table>";

$sq2 = "select cod_pptal,nom_rubro from car_ppto_ing where cod_pptal like '$rubro%' and tip_dato='D' order by cod_pptal asc";
$rs2 = mysql_db_query($database,$sq2,$cx);
while ($rw2 = mysql_fetch_array($rs2))
{
	echo "<table><tr>
	<td   colspan='5' align='left'><b>$rw2[cod_pptal] - $rw2[nom_rubro]</b></td>
	</tr></table>";
	printf("
	<center>
	<table BORDER='1' class='bordepunteado1'>
	<tr>
	<td  bgcolor='#DCE9E5' align='center'>Fecha De Recaudo</td>
	<td  bgcolor='#DCE9E5' align='center'>Numero De Recibo</td>
	<td  bgcolor='#DCE9E5' align='center'>Recibido De</td>
	<td  bgcolor='#DCE9E5' align='center'>Concepto Recaudo</td>
	<td  bgcolor='#DCE9E5' align='center'>Valor</td>
	</tr>
	");
	$sq = "select * from z_aux_ing  where fecha BETWEEN '$fecha_ini' AND '$fecha_fin' and rubro = '$rw2[cod_pptal]' order by fecha";
	$re = mysql_db_query($database, $sq, $cx);
	while ($rw = mysql_fetch_array($re))
	{
				printf("
				<tr>
				<td align='center' class='date'>%s</td>
				<td align='left'>%s</td>
				<td align='left'>%s</td>
				<td align='left'>%s</td>
				<td align='right' width='90'>%s</td>
				</tr>",$rw["fecha"],$rw["num"],$rw["ter"],ucfirst(ereg_replace("[,;]", "",$rw["des"])),number_format($rw["valor"],2,'.',',')); 
				$suma = $suma + $rw["valor"];
	}
	// fin de la tabla con totales
	$tsuma = number_format($suma,2,'.',',');
	echo "<tr>
	<td  bgcolor='#E4E4E4' colspan='4' align='right'><b>TOTAL</b></td>
	<td  bgcolor='#E4E4E4' align='right'><b>$tsuma<b></td>
	</tr>";
	echo "<table><tr>
	<td   colspan='5' align='left'></b></td>
	</tr></table>";

	$tsuma=0;
	$suma=0;
}

printf("</table></center>");
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
}
?>
</body>
</html>
