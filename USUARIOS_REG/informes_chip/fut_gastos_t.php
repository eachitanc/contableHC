<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=TRANSFERENCIAS_COMPROMETIDAS-FUT_GASTOS_FUNCIONAMIENTO.xls");
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
$corte =$_GET['corte'];
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
printf("
<center>
<table BORDER='1' class='bordepunteado1'>
<tr>
<td  bgcolor='#DCE9E5' align='center'>C</td>
<td  bgcolor='#DCE9E5' align='center'>Codigo Presupuestal</td>
<td  bgcolor='#DCE9E5' align='center'>Nombre Rubro</td>
<td  bgcolor='#DCE9E5' align='center'>No Comprobante</td>
<td  bgcolor='#DCE9E5' align='center'>Nombre Entidad Receptora</td>
<td  bgcolor='#DCE9E5' align='center'>Concepto FUT</td>
<td  bgcolor='#DCE9E5' align='center'>Codigo FUT Entidad</td>
<td  bgcolor='#DCE9E5' align='center'>Valor Transferencia</td>
</tr>
");
$sq = "select * from car_ppto_gas where cod_fut like '1.3%' and tip_dato='D' order by cod_pptal";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT * from crpp where cuenta ='$rw[cod_pptal]' and fecha_crpp <='$corte'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			
				printf("
				<tr>
				<td bgcolor='#cccccc' align='center'>%s</td>
				<td bgcolor='#cccccc' align='left' class='text'>%s</td>
				<td bgcolor='#cccccc' align='left'>%s</td>
				<td bgcolor='#cccccc' align='center'>%s</td>
				<td bgcolor='#cccccc' align='left'>%s</td>
				<td align='left'>%s</td>
				<td align='right' bgcolor='#FFFF33'>%s</td>
				<td align='right'>%s</td>
				</tr>",'G',$rw["cod_pptal"],ucfirst(ereg_replace("[,;]", "",$rw["nom_rubro"])), $rw10["id_manu_crpp"],$rw10["tercero"],$rw["cod_fut"],'',round($rw10["vr_digitado"]/1000),0); 
			
}
printf("</table></center>");
}
?>
</body>
</html>
		