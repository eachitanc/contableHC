<?php
set_time_limit(1200);
session_start();
if(!isset($_SESSION["login"]))
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
<?php
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }
   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = $connectionxx->query($sqlxx3);

while($rowxx3 = $resultadoxx3->fetch_assoc()) 
   {
   $desde=$rowxx3["fecha_ini_op"];
   }    
?>	
	<form name="a" method="post" action="retefuente.php">
</form>	
	<?php
	$fecha_ini=$_POST['fecha_ini'];
	$fecha_fin=$_POST['fecha_fin'];	
	$cuenta=$_POST['cuenta'];
	$cuenta2 = split(",",$cuenta);
	if($cuenta2[1] == '') 
	{
		$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta2[0]' and credito > 0 order by fecha asc ";
	}else{
		$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and (cuenta = '$cuenta2[0]' or cuenta = '$cuenta2[1]')  and credito > 0 order by fecha asc ";
		}
//-------
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
mysql_db_query($database,"TRUNCATE TABLE estamp_det",$cx);

$sq4 ="select nombre from desc_list where cuenta = '$cuenta'";
$re4 = $cx->query($sq4);
$rw4 = $re4->fetch_assoc();
$nombre = strtoupper($rw4['nombre']);
$cuenta3 = $cuenta2[0].$cuenta2[1];
// inicio consulta
	//$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta' and credito > 0 order by fecha asc ";
	// Cambiar consulta
	$re = $cx->query($sq);
	while($rw = $re->fetch_assoc()) 
	{
		$sq2 = "select cuenta from lib_aux where (cuenta like '1110%' or cuenta like '190101%') and id_auto ='$rw[id_auto]'";
		$re2 = $cx->query($sq2);
		$rw2 =  $re2->fetch_assoc(); 
	$sq5 = "INSERT INTO estamp_det (tipo,fecha, dcto, tercero, ccnit, detalle, credito, cta_bco ) values ('$rw[cuenta]','$rw[fecha]','$rw[dcto]','$rw[tercero]','$rw[ccnit]','$rw[detalle]','$rw[credito]','$rw2[cuenta]')";
	$res5 = $cx->query($sq5);
	}// Fin for
// CONSULTA PARA MOSTRAR RESULTADOS
	$sq5 ="select raz_soc,nit,dv from empresa where cod_emp ='$idxx'";
	$re5 = $cx->query($sq5);
	$rw5 = $re5->fetch_assoc();
	$sq4 ="select cuenta,nombre from desc_list where cuenta ='$cuenta'";
	$re4 = $cx->query($sq4);
	$rw4 = $re4->fetch_assoc();
	$nombre = strtoupper($rw4['nombre']);
echo("
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
	$re = $cx->query($sq);
	while($rw = $re->fetch_assoc()) 
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






<?php
}
?>