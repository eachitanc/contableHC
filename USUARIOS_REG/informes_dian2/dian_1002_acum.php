<?php
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Dian_1002_acum.xls");
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
			<td class='Estilo4' bgcolor='#009999'><b>MUNICIPIO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>PAIS</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>VALOR PAGADO</b></td>
			<td class='Estilo4' bgcolor='#009999'><b>VALOR RETENCION</b></td>
		</tr>
		";
include('../config.php');
$cx=mysql_connect ($server, $dbuser, $dbpass);
$sq = "SELECT  concepto, tipo_doc, numero, dv, ape1, ape2, nom1, nom2, razon_social,dir, depto, mun, pais, sum(valor_deduc) as valor1, sum(valor_nodeduc) as valor2 from dian_1001  group by concepto,numero,ape1, ape2, nom1, nom2, razon_social";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re)) 
{
$concepto=$rw["concepto"];
$tipo_documento=$rw["tipo_doc"];
$n_doc=$rw["numero"];
$dv=$rw["dv"];
$apellido_1=$rw["ape1"];
$apellido_2=$rw["ape2"];
$nombre_1=$rw["nom1"];
$otros_nombres=$rw["nom2"];
$razon_social=$rw["razon_social"];
$direccion=$rw["dir"];
$dpto2=$rw["depto"];
$mcipio2=$rw["mun"];
$pais=$rw["pais"];;
$valor1=$rw["valor1"];
$valor2=$rw["valor2"];
echo "<tr>
			<td class='Estilo4'>$concepto</td>
			<td class='Estilo4'>$tipo_documento</td>
			<td class='Estilo4'>$n_doc</td>
			<td class='Estilo4'>$dv</td>
			<td class='Estilo4'>$apellido_1</td>
			<td class='Estilo4'>$apellido_2</td>
			<td class='Estilo4'>$nombre_1</td>
			<td class='Estilo4'>$otros_nombres</td>
			<td class='Estilo4'>$razon_social</td>
			<td class='Estilo4'>$direccion</td>
			<td class='text'>$dpto2</td>
			<td class='text'>$mcipio2</td>
			<td class='Estilo4'>$pais</td>
			<td align='right' class='Estilo4'>$valor1</td>
			<td align='right' class='Estilo4'>$valor2</td>
		</tr>
		";
$cont++; 
} // End While rw
$cont=$cont+1;
echo "</table>";
?>
</body>
</html>
<?php          
}
?>
