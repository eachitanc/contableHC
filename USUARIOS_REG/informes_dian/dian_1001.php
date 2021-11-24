<?php
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Dian_1001.xls");
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
echo "<table border='1'>
		<tr>
			<td class='Estilo4' bgcolor='#009999'><b>RUBRO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>NOMBRE RUBRO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>TIPO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>CONCEPTO PAGO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>CONCEPTO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>TIPO DOC</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>NUMERO DOC</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>DV</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>PRIMER APELLIDO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>SEGUNDO APELLIDO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>PRIMER NOMBRE</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>OTROS NOMBRES</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>RAZON SOCIAL</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>DIRECCION</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>DEPARTAMENTO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>CODIGO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>MUNICIPIO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>CODIGO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>PAIS</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>PAGO DEDUCIBLE</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>PAGO NO DEDUCIBLE</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>IVA > VALOR DEDUCIBLE</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>IVA > VALOR NO DEDUCIBLE</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>RETEFUENTE PRACTICADA</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>RETEFUENTE ASUMIDA</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>RTEIVA R_COMUN</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>RTEIVA R_SIMPLIFICADO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>RTEIVA NO_RESIDENTES</b></td>
		</tr>
		";
include('../config.php');
$cx=mysql_connect ($server, $dbuser, $dbpass);
$sq = "SELECT * from dian_exogena where tipo = 'retefuente' and valor >'0' order by cuenta";
$re = mysql_db_query($database, $sq, $cx);
$cont=0;
while($rw = mysql_fetch_array($re)) 
{
	$concepto1	=$rw["codigo_1002"];  
	if ($concepto1)
	{
	$sq1x = "SELECT * from conceptos_dian where tipo='$concepto1' and clase ='PAGOS'";
		$re1x = mysql_db_query($database, $sq1x, $cx);
		while($rw1x = mysql_fetch_array($re1x)) 
			{
			$concepto=$rw1x["codigo"]; 
			}
	}else{
	$concepto ='';
	}
	$tipo_documento=$rw["tipo_documento"];
	$n_doc=$rw["documento"];
	$dv=$rw["dv"];
	$apellido_1=$rw["apellido_1"];
	$apellido_2=$rw["apellido_2"];
	$nombre_1=$rw["nombre_1"];
	$otros_nombres=$rw["otros_nombres"];
	$razon_social=$rw["razon_social"];
	$direccion=$rw["direccion"];
	$dpto=$rw["depto"];
	$tipo =substr($rw["id_ceva"],0,4);
		$sq1 = "SELECT cod_dpto from conceptos_et where tipo='D' and entidad ='$dpto'";
		$re1 = mysql_db_query($database, $sq1, $cx);
		while($rw1 = mysql_fetch_array($re1)) 
			{
			$dpto2=$rw1["cod_dpto"]; 
			}
	$mcipio=$rw["mcipio"];
	$sq2 = "SELECT cod_mcipio from conceptos_et where tipo='M' and entidad ='$mcipio' and cod_dpto ='$dpto2'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		while($rw2 = mysql_fetch_array($re2)) 
			{
			$mcipio2=$rw2["cod_mcipio"];
			}
	$pais=169;
	$valor_pagos=round($rw["valor"]);
	$cuenta =$rw["cuenta"];
	$id = $rw["id_ceva"];
	$nombre=$rw["nom_cuenta"];
	$nombre=ereg_replace("[,;]", "",$nombre);
	$concepto_pago=$rw["concepto"];
	$concepto_pago=ereg_replace("[,;]", "",$concepto_pago);
	$retencion = $rw["retencion"];
	if ($rw["codigo_1002"] == 2318) {$reteiva = $rw["reteiva"];}else{$reteiva=0;}
	if ($rw["codigo_1002"] == 2319) {$ivateorico = $rw["reteiva"];}else{$ivateorico=0;}
	echo "<tr>
				<td class='text' bgcolor='#CCCCCC'>$cuenta</td>
				<td class='Estilo4' bgcolor='#CCCCCC'>$nombre</td>
				<td class='Estilo4' bgcolor='#CCCCCC'>$tipo</td>
				<td class='Estilo4'bgcolor='#CCCCCC'>$concepto_pago</td>
				<td class='Estilo4' bgcolor='#FFFF33'>$concepto</td>
				<td class='Estilo4'>$tipo_documento</td>
				<td class='Estilo4'>$n_doc</td>
				<td class='Estilo4'>$dv</td>
				<td class='Estilo4'>$apellido_1</td>
				<td class='Estilo4'>$apellido_2</td>
				<td class='Estilo4'>$nombre_1</td>
				<td class='Estilo4'>$otros_nombres</td>
				<td class='Estilo4'>$razon_social</td>
				<td class='Estilo4'>$direccion</td>
				<td class='Estilo4' bgcolor='#CCCCCC'>$dpto</td>
				<td class='text'>$dpto2</td>
				<td class='Estilo4' bgcolor='#CCCCCC'>$mcipio</td>
				<td class='text'>$mcipio2</td>
				<td class='Estilo4'>$pais</td>
				<td class='Estilo4'>0</td>
				<td align='right' class='Estilo4'>$valor_pagos</td>
				<td align='right' class='Estilo4'>0</td>
				<td align='right' class='Estilo4'>0</td>
				<td align='right' class='Estilo4'>$retencion</td>
				<td align='right' class='Estilo4'>0</td>
				<td align='right' class='Estilo4'>$reteiva</td>
				<td align='right' class='Estilo4'>$ivateorico</td>
				<td align='right' class='Estilo4'>0</td>
			</tr>
			";
	$cont++; 
	$cuenta="";
} // End While rw
$cx=mysql_connect ($server, $dbuser, $dbpass);
$sq = "SELECT * from dian_exogena where tipo = 'reteiva' and retencion >'0' order by cuenta";
$re = mysql_db_query($database, $sq, $cx);
$cont=0;
while($rw = mysql_fetch_array($re)) 
{
	$concepto1	=$rw["codigo_1002"];  
	if ($concepto1)
	{
	$sq1x = "SELECT * from conceptos_dian where tipo='$concepto1' and clase ='PAGOS'";
		$re1x = mysql_db_query($database, $sq1x, $cx);
		while($rw1x = mysql_fetch_array($re1x)) 
			{
			$concepto=$rw1x["codigo"]; 
			}
	}else{
	$concepto ='';
	}
	$tipo_documento=$rw["tipo_documento"];
	$n_doc=$rw["documento"];
	$dv=$rw["dv"];
	$apellido_1=$rw["apellido_1"];
	$apellido_2=$rw["apellido_2"];
	$nombre_1=$rw["nombre_1"];
	$otros_nombres=$rw["otros_nombres"];
	$razon_social=$rw["razon_social"];
	$direccion=$rw["direccion"];
	$dpto=$rw["depto"];
		$sq1 = "SELECT cod_dpto from conceptos_et where tipo='D' and entidad ='$dpto'";
		$re1 = mysql_db_query($database, $sq1, $cx);
		while($rw1 = mysql_fetch_array($re1)) 
			{
			$dpto2=$rw1["cod_dpto"]; 
			}
	$mcipio=$rw["mcipio"];
	$sq2 = "SELECT cod_mcipio from conceptos_et where tipo='M' and entidad ='$mcipio' and cod_dpto ='$dpto2'";
		$re2 = mysql_db_query($database, $sq2, $cx);
		while($rw2 = mysql_fetch_array($re2)) 
			{
			$mcipio2=$rw2["cod_mcipio"];
			}
	$pais=169;
	$valor_pagos=round($rw["valor"]);
	$cuenta =$rw["cuenta"];
	$id = $rw["id_ceva"];
	$nombre=$rw["nom_cuenta"];
	$nombre=ereg_replace("[,;]", "",$nombre);
	$concepto_pago=$rw["concepto"];
	$concepto_pago=ereg_replace("[,;]", "",$concepto_pago);
	$retencion = $rw["retencion"];
	if ($rw["codigo_1002"] == 2318) {$reteiva = $rw["reteiva"];}else{$reteiva=0;}
	if ($rw["codigo_1002"] == 2319) {$ivateorico = $rw["reteiva"];}else{$ivateorico=0;}
	echo "<tr bgcolor='#CCCC00'>
				<td class='text' bgcolor='#CCCCCC'>$cuenta</td>
				<td class='Estilo4' bgcolor='#CCCCCC'>$nombre</td>
				<td class='Estilo4' bgcolor='#CCCCCC'></td>
				<td class='Estilo4'bgcolor='#CCCCCC'>$concepto_pago</td>
				<td class='Estilo4' bgcolor='#FFFF33'>$concepto</td>
				<td class='Estilo4'>$tipo_documento</td>
				<td class='Estilo4'>$n_doc</td>
				<td class='Estilo4'>$dv</td>
				<td class='Estilo4'>$apellido_1</td>
				<td class='Estilo4'>$apellido_2</td>
				<td class='Estilo4'>$nombre_1</td>
				<td class='Estilo4'>$otros_nombres</td>
				<td class='Estilo4'>$razon_social</td>
				<td class='Estilo4'>$direccion</td>
				<td class='Estilo4' bgcolor='#CCCCCC'>$dpto</td>
				<td class='text'>$dpto2</td>
				<td class='Estilo4' bgcolor='#CCCCCC'>$mcipio</td>
				<td class='text'>$mcipio2</td>
				<td class='Estilo4'>$pais</td>
				<td class='Estilo4'>0</td>
				<td align='right' class='Estilo4'>0</td>
				<td align='right' class='Estilo4'>0</td>
				<td align='right' class='Estilo4'>0</td>
				<td align='right' class='Estilo4'>0</td>
				<td align='right' class='Estilo4'>0</td>
				<td align='right' class='Estilo4'>$retencion</td>
				<td align='right' class='Estilo4'>$ivateorico</td>
				<td align='right' class='Estilo4'>0</td>
			</tr>
			";
	$cont++; 
	$cuenta="";
} // End While rw

$cont=$cont+1;
echo "
		</table>
		";
?>
</body>
</html>
<?php          
}
?>
