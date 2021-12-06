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
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);

while($rowxx = $resultadoxx->fetch_assoc()) 
   {
   
   $idxx=$rowxx["id_emp"];
   $id_emp=$rowxx["id_emp"];
   $ano=$rowxx["ano"];
 
   }
   
$sqlxx3 = "select * from fecha_ini_op";
$resultadoxx3 = mysql_db_query($database, $sqlxx3, $cx);

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
	$cuenta = $_POST['cuenta'];	
	
//-------

printf("
<center>
<table width='2400' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='100'>Fecha</td>
<td align='center' width='100'>Documento</td>
<td align='left' width='200'>Concepto</td>
<td align='left' width='300'>Tercero</td>
<td align='center' width='100'>CC/Nit</td>
<td align='right' width='100'>Valor</td>
<td align='center' width='100'>Cta</td>
<td align='center' width='100'>Base</td>
</tr>
");
// inicio consulta
	$sq = "select * from lib_aux where cuenta = '$cuenta' and credito > 0 and (fecha between '$fecha_ini' and '$fecha_fin' )";
	$re = $cx->query($sq);
	while($rw = $re->fetch_assoc()) 
	{
		$sq3 ="select cuenta from lib_aux where dcto ='$rw[dcto]' and cuenta like '1110%'";
		$re3 = $cx->query($sq3);
		$rw3 = $re3->fetch_assoc();
		// sacar la base de la retencion
		$sopor = substr($rw['dcto'], 0, 4);
		//buscar base en ceva
		if ($sopor =='CEVA')
		{
		$sq4 ="select (total_pagado + salud + pension + libranza + f_solidaridad + f_empleados + sindicato + embargo + cruce + otros + vr_retefuente + vr_reteiva + vr_retecree + vr_reteica + vr_estampilla1 + vr_estampilla2 + vr_estampilla3 + vr_estampilla4 +estampilla5) as totalp from ceva where id_manu_ceva ='$rw[dcto]'";
	    }
		if ($sopor =='CECP')
		{
		$sq4 ="select (total_pagado + salud + pension + libranza + f_solidaridad + f_empleados + sindicato + embargo + cruce + otros + vr_retefuente + vr_reteiva +  vr_reteica + vr_estampilla1 + vr_estampilla2 + vr_estampilla3 + vr_estampilla4 +estampilla5) as totalp from cecp where id_manu_cecp ='$rw[dcto]'";
	    }
		$re4 = $cx->query($sq4);
		$rw4 = $re4->fetch_assoc();
	echo "
		<tr>
			<td align='center'>$rw[fecha]</td>
			<td align='center'>$rw[dcto]</td>
			<td align='left'>$rw[detalle]</td>
			<td align='left'>$rw[tercero]</td>
			<td align='center'>$rw[ccnit]</td>
			<td align='right'>$rw[credito]</td>
			<td align='center'>$rw3[cuenta]</td>
			<td align='right'>$rw4[totalp]</td>
	</tr>
	";
	$concepto='';
	$vr_rfte='';
	$cta ='';
	}// FIN DEL WHILE




printf("</table></center>");
//--------	
?>	
</body>
</html>






<?php
}
?>