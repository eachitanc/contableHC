<?
set_time_limit(1200);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=RELACION_DE_ESTAMPILLAS.xls");
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
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
   }
   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $cx);

while($rowxx3 = mysql_fetch_array($resultadoxx3)) 
   {
   $desde=$rowxx3["fecha_ini_op"];
   }    
?>	
	<form name="a" method="post" action="retefuente.php">
</form>	
	<?
	$fecha_ini=$_POST['fecha_ini'];
	$fecha_fin=$_POST['fecha_fin'];
	$cuenta = $_POST['cuenta'];	
	
//-------
	$sq5 ="select raz_soc,nit,dv from empresa where cod_emp ='$idxx'";
	$re5 = mysql_db_query($database, $sq5, $cx);
	$rw5 = mysql_fetch_array($re5);
	$sq4 ="select cuenta,nombre from desc_list where cuenta ='$cuenta'";
	$re4 = mysql_db_query($database, $sq4, $cx);
	$rw4 = mysql_fetch_array($re4);
	$nombre = strtoupper($rw4['nombre']);
printf("
<center>
<table width='2400' BORDER='0' class='bordepunteado1'>
<tr bgcolor='#ffffff'>
<td align='center' colspan='7'></td>
</tr>
<tr bgcolor='#ffffff'>
<td align='center' colspan='7'>$rw5[raz_soc]</td>
</tr>
<tr bgcolor='#ffffff'>
<td align='center' colspan='7'>CONSOLIDADO DE DESCUENTOS DE $nombre</td>
</tr>
<tr bgcolor='#ffffff'>
<td align='center' colspan='7'>Periodo $fecha_ini - $fecha_fin</td>
</tr>
<tr bgcolor='#ffffff'>
<td align='center' colspan='7'></td>
</tr>
</table>
");
// inicio consulta
echo "
<table width='2400' BORDER='1' class='bordepunteado1'>
	<tr bgcolor='#DCE9E5'>
	<td align='center' width='100'>Fecha</td>
	<td align='center' width='100'>Documento</td>
	<td align='left' width='200'>Concepto</td>
	<td align='left' width='300'>Tercero</td>
	<td align='center' width='100'>CC/Nit</td>
	<td align='right' width='100'>Valor</td>
	<td align='center' width='100'>Cta</td>
	</tr>
	";
	$sq ="select * from estamp_det order by fecha asc";
	//$sq = "select * from lib_aux where cuenta = '$cuenta' and credito > 0 and (fecha between '$fecha_ini' and '$fecha_fin' )";
	$re = mysql_db_query($database, $sq, $cx);
	while($rw = mysql_fetch_array($re)) 
	{
	echo "
		<tr>
			<td align='center'>$rw[fecha]</td>
			<td align='center'>$rw[dcto]</td>
			<td align='left'>$rw[tercero]</td>
			<td align='left'>$rw[ccnit]</td>
			<td align='center'>$rw[detalle]</td>
			<td align='right'>$rw[credito]</td>
			<td align='center'>$rw[cta_bco]</td>
	</tr>
	";
	}// FIN DEL WHILE




printf("</table></center>");
//--------	
?>	
</body>
</html>






<?
}
?>