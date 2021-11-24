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
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }
   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $connectionxx);

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
$re4 = mysql_db_query($database, $sq4, $cx);
$rw4 = mysql_fetch_array($re4);
$nombre = strtoupper($rw4['nombre']);
$cuenta3 = $cuenta2[0].$cuenta2[1];
// inicio consulta
	//$sq = "select * from lib_aux where (fecha between '$fecha_ini' and '$fecha_fin' ) and cuenta = '$cuenta' and credito > 0 order by fecha asc ";
	// Cambiar consulta
	$re = mysql_db_query($database, $sq, $cx);
	while($rw = mysql_fetch_array($re)) 
	{
		$sq6="select sum(credito) as total from lib_aux where (cuenta like '1110%' or cuenta like '1105%') and id_auto ='$rw[id_auto]' group by id_auto";
		$re6 = mysql_db_query($database, $sq6, $cx);
		$rw6 = mysql_fetch_array($re6);
		$sq2 = "select cuenta,credito from lib_aux where (cuenta like '1110%' or cuenta like '1105%') and id_auto ='$rw[id_auto]'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		while ($rw2 =  mysql_fetch_array($re2))
		{
		if ($rw2['cuenta'] == '110501')
		{
		$valor = $rw['credito'];
		}else{
		$por = $rw2['credito'] / $rw6['total'];
		$valor = $rw['credito'] * $por;	
		}
	$sq5 = "INSERT INTO estamp_det (tipo,fecha, dcto, tercero, ccnit, detalle, credito, cta_bco ) values ('$rw[cuenta]','$rw[fecha]','$rw[dcto]','$rw[tercero]','$rw[ccnit]','$rw[detalle]','$valor','$rw2[cuenta]')";
	$res5 = mysql_db_query($database, $sq5, $cx);
		$valor =0;
		$por=0;
		}
		
		}// Fin for
// CONSULTA PARA MOSTRAR RESULTADOS
$sq7 ="select sum(credito) as valor,cta_bco from estamp_det where (fecha between '$fecha_ini' and '$fecha_fin' ) group by cta_bco";
$re7 = mysql_db_query($database, $sq7, $cx);
$fi7 = mysql_num_rows($re7);
$suma=0;
echo "<br>";
printf("
		<center>
		<table width='2400' BORDER='0' class='bordepunteado1'>
		<tr>
			<td bgcolor='#ffffff' align='center' colspan='5'><b>ALCALDIA MUNICIPAL DE IPIALES</b></td>
		</tr>
		<tr>
			<td bgcolor='#ffffff' align='center' colspan='5'><b>RELACION DE DESCUENTOS DE $nombre</b></td>
		</tr>
		<tr>
			<td bgcolor='#ffffff' align='center' colspan='5'><b>PERIODO $fecha_ini A $fecha_fin </b></td>
		</tr>
        </table></center><br><br>
		");
		printf("
		<center>
		<table width='2400' BORDER='1' class='bordepunteado1'>
		<tr>
		<td bgcolor='#DCE9E5' align='center' width='100'>Cuenta</td>
		<td bgcolor='#DCE9E5' align='right' width='150'>Valor</td>
		</tr>
		");
while ($rw7 =  mysql_fetch_array($re7))
{
	
	$tipo ='';
	if ($rw3['tipo'] =='29109001') $tipo ='PROCULTURA';
	if ($rw3['tipo'] =='29059008') $tipo ='ADULTO MAYOR';
	if ($rw3['tipo'] =='29059006') $tipo ='UDENAR';
	if ($rw3['tipo'] =='291013') $tipo ='CONTRIBUCIONES';
	if ($rw3['tipo'] =='29109002') $tipo ='PUBLICACIONES';
	echo "
		<tr>
			<td align='center'>$rw7[cta_bco]</td>
			<td align='center'>$rw7[valor]</td>
	</tr>
	";
	$suma = $suma + $rw7['valor'];
}	
	echo "
		<tr>
			<td bgcolor='#F7F7F7' align='left' ><b>TOTAL</b></td>
			<td bgcolor='#F7F7F7' align='right'><b>$suma<b></td>
		</tr>
	";
printf("</table></center><br><br>");
$total = $total + $suma;
$suma=0;

//--------	
?>	
</body>
</html>






<?
}
?>