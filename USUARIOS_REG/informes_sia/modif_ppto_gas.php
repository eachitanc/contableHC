<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201101_F08B_AGR.xls");
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
	mso-number-format:"#,##0.00"	
	}
</style>
</head>
<body>
<?
include('../config.php');
$base=$database;
$conexion=mysql_connect ($server, $dbuser, $dbpass);
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
printf("
<center>
<table BORDER='1' class='bordepunteado1' width='1070'>
<tr>
<td bgcolor='#DCE9E5' align='center' width='140'><span class='Estilo41'>C�digo Rubro Presupuestal</span></td>
<td bgcolor='#DCE9E5' align='center' width='140'><span class='Estilo41'>Acto Administrativo</span></td>
<td bgcolor='#DCE9E5' align='center' width='100'><span class='Estilo41'>Fecha</span></td>
<td bgcolor='#DCE9E5' align='center' width='115'><span class='Estilo41'>Adici�n</span></td>
<td bgcolor='#DCE9E5' align='center' width='115'><span class='Estilo41'>Reducci�n</span></td>
<td bgcolor='#DCE9E5' align='center' width='115'><span class='Estilo41'>Cr�dito</span></td>
<td bgcolor='#DCE9E5' align='center' width='115'><span class='Estilo41'>Contracr�dito</span></td>
<td bgcolor='#DCE9E5' align='center' width='115'><span class='Estilo41'>Aplazamiento</span></td>
<td bgcolor='#DCE9E5' align='center' width='115'><span class='Estilo41'>Desaplazamiento</span></td>
</tr>
");
$sq = "SELECT cod_pptal, nom_rubro,cod_sia from car_ppto_gas where tip_dato='D' ORDER BY cod_pptal";
$re = mysql_db_query($database, $sq, $cx);
		while($rw = mysql_fetch_array($re))
		{
			$cod_pptal=$rw["cod_pptal"];
			$sq3 = "SELECT tipo_acto,num_acto,fecha_adi,sum(valor_adi) as valor_adi from adi_ppto_gas where cod_pptal ='$cod_pptal' group by tipo_acto,num_acto,fecha_adi";
			$re3 = mysql_db_query($database, $sq3, $cx);
			while($rw3 = mysql_fetch_array($re3))
			{
			$tipo_acto=$rw3["tipo_acto"]."&nbsp;".$rw3["num_acto"];
			if ($rw3["valor_adi"] >0)
				{
					printf("
					<span class='Estilo4'>
					<tr>
					<td align='left' class='text'>%s</td>
					<td align='center'><span class='Estilo4'> %s </span></td>
					<td align='center' class='date'>%s</td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					</tr>", $rw["cod_sia"].$rw["cod_pptal"], $tipo_acto, $rw3["fecha_adi"], $rw3["valor_adi"], 0, 0, 0,0,0); 
				}
			}
			$sq6 = "SELECT tipo_acto,num_acto,fecha_adi,sum(valor_adi) as valor_adi from red_ppto_gas where cod_pptal ='$cod_pptal' group by tipo_acto,num_acto,fecha_adi";
			$re6 = mysql_db_query($database, $sq6, $cx);
			while($rw6 = mysql_fetch_array($re6))
			{
			$tipo_acto=$rw6["tipo_acto"]."&nbsp;".$rw6["num_acto"];
			if ($rw6["valor_adi"] >0)
				{
					printf("
					<span class='Estilo4'>
					<tr>
					<td align='left' class='text'>%s</td>
					<td align='center'><span class='Estilo4'> %s </span></td>
					<td align='center' class='date'>%s</td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					</tr>", $rw["cod_sia"].$rw["cod_pptal"], $tipo_acto, $rw6["fecha_adi"],0,$rw6["valor_adi"], 0, 0,0,0); 
				}
			}
			$sq7 = "SELECT tipo_acto,num_acto,fecha_adi,sum(valor_adi) as valor_adi from creditos where cod_pptal ='$cod_pptal' group by tipo_acto,num_acto,fecha_adi";
			$re7 = mysql_db_query($database, $sq7, $cx);
			while($rw7 = mysql_fetch_array($re7))
			{
			$tipo_acto=$rw7["tipo_acto"]."&nbsp;".$rw7["num_acto"];
			if ($rw7["valor_adi"] >0)
				{
					printf("
					<span class='Estilo4'>
					<tr>
					<td align='left' class='text'>%s</td>
					<td align='center'><span class='Estilo4'> %s </span></td>
					<td align='center' class='date'>%s</td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					</tr>", $rw["cod_sia"].$rw["cod_pptal"], $tipo_acto, $rw7["fecha_adi"],0,0,$rw7["valor_adi"], 0,0,0); 
				}
			}
			$sq8 = "SELECT  tipo_acto,num_acto,fecha_adi,sum(valor_adi) as valor_adi from contracreditos where cod_pptal ='$cod_pptal' group by tipo_acto,num_acto,fecha_adi";
			$re8 = mysql_db_query($database, $sq8, $cx);
			while($rw8 = mysql_fetch_array($re8))
			{
			$tipo_acto=$rw8["tipo_acto"]."&nbsp;".$rw8["num_acto"];
			if ($rw8["valor_adi"] >0)
				{
					printf("
					<span class='Estilo4'>
					<tr>
					<td align='left' class='text'>%s</td>
					<td align='center'><span class='Estilo4'> %s </span></td>
					<td align='center' class='date'>%s</td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					</tr>", $rw["cod_sia"].$rw["cod_pptal"], $tipo_acto, $rw8["fecha_adi"],0,0,0,$rw8["valor_adi"],0,0); 
				}
			}
			$sq9 = "SELECT id,tipo_acto,num_acto,fecha_adi,sum(valor_aplazado) as valor_aplazado from aplazamientos where cod_pptal ='$cod_pptal' group by tipo_acto,num_acto,fecha_adi";
			$re9 = mysql_db_query($database, $sq9, $cx);
			while($rw9 = mysql_fetch_array($re9))
			{
			$id =$rw9["id"];
			$tipo_acto=$rw9["tipo_acto"]."&nbsp;".$rw9["num_acto"];
				$sq91 = "SELECT aplazado from levanta_aplazamientos where id_padre ='$id'";
				$re91 = mysql_db_query($database, $sq91, $cx);
				while($rw91 = mysql_fetch_array($re91))
				{
					$valor_aplazado =$rw91["aplazado"];
				}
			if ($valor_aplazado >0)
				{
					printf("
					<span class='Estilo4'>
					<tr>
					<td align='left' class='text'>%s</td>
					<td align='center'><span class='Estilo4'> %s </span></td>
					<td align='center' class='date'>%s</td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					</tr>", $rw["cod_sia"].$rw["cod_pptal"], $tipo_acto, $rw9["fecha_adi"],0,0,0,0,$valor_aplazado,0); 
				}
			}
			$sq10 = "SELECT tipo_acto,num_acto,fecha_adi,sum(valor_levantado) as valor_levantado from levanta_aplazamientos where cod_pptal ='$cod_pptal' group by tipo_acto,num_acto,fecha_adi";
			$re10 = mysql_db_query($database, $sq10, $cx);
			while($rw10 = mysql_fetch_array($re10))
			{
			$tipo_acto=$rw10["tipo_acto"]."&nbsp;".$rw10["num_acto"];
			if ($rw10["valor_levantado"] >0)
				{
					printf("
					<span class='Estilo4'>
					<tr>
					<td align='left' class='text'>%s</td>
					<td align='center'><span class='Estilo4'> %s </span></td>
					<td align='center' class='date'>%s</td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					<td align='right'><span class='Estilo4'> %s </span></td>
					</tr>", $rw["cod_sia"].$rw["cod_pptal"], $tipo_acto, $rw10["fecha_adi"],0,0,0,0,0,$rw10["valor_levantado"]); 
				}
			}
		}
printf("</table></center>");
}
?>