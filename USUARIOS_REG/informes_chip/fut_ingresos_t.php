<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=TRANSFERENCIAS_RECIBIDAS-FUT_INGRESOS.xls");
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
<td  bgcolor='#DCE9E5' align='center'>Nombre Entidad Giradora</td>
<td  bgcolor='#DCE9E5' align='center'>Concepto FUT</td>
<td  bgcolor='#DCE9E5' align='center'>Codigo FUT Entidad</td>
<td  bgcolor='#DCE9E5' align='center'>Valor Girado</td>
</tr>
");
$sq = "select * from car_ppto_ing where cod_fut like 'TI.A.2.6%' and tip_dato='D' order by cod_pptal";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT * from recaudo_ncbt  where cuenta ='$rw[cod_pptal]' and fecha_recaudo <='$corte' ";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			while ($rw10 = mysql_fetch_array($re10))
			{
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
				</tr>",'I',$rw["cod_pptal"],ucfirst(ereg_replace("[,;]", "",$rw["nom_rubro"])), $rw10["id_manu_ncbt"],$rw10["tercero"],$rw["cod_fut"],'',round($rw10["vr_digitado"]/1000,0)); 
			}
			$sq11 = "SELECT * from recaudo_rcgt  where cuenta ='$rw[cod_pptal]' and fecha_recaudo <='$corte'";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			while ($rw11 = mysql_fetch_array($re11))
			{
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
				</tr>",'I',$rw["cod_pptal"],ucfirst(ereg_replace("[,;]", "",$rw["nom_rubro"])), $rw11["id_manu_rcgt"],$rw11["tercero"],$rw["cod_fut"],'',round($rw11["vr_digitado"]/1000,2)); 
			}
			$sq12 = "SELECT * from recaudo_roit  where cuenta ='$rw[cod_pptal]' and fecha_recaudo <='$corte'";
			$re12 = mysql_db_query($database, $sq12, $cx);	
			while ($rw12 = mysql_fetch_array($re12))
			{
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
				</tr>",'I',$rw["cod_pptal"],ucfirst(ereg_replace("[,;]", "",$rw["nom_rubro"])), $rw12["id_manu_roit"],$rw12["tercero"],$rw["cod_fut"],'',round($rw12["vr_digitado"]/1000,2)); 
			}
			$sq13 = "SELECT * from recaudo_tnat  where cuenta ='$rw[cod_pptal]' and fecha_recaudo <='$corte'";
			$re13 = mysql_db_query($database, $sq13, $cx);	
			while ($rw13 = mysql_fetch_array($re13))
			{
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
				</tr>",'I',$rw["cod_pptal"],ucfirst(ereg_replace("[,;]", "",$rw["nom_rubro"])), $rw13["id_manu_tnat"],$rw13["tercero"],$rw["cod_fut"],'',round($rw13["vr_digitado"]/1000,2)); 
			}
}
printf("</table></center>");
}
?>
</body>
</html>
		