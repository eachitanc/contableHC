<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201101_F08A_AGR.xls");
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
<table BORDER='1' class='bordepunteado1'  width='610'>
<tr>
<td  bgcolor='E0E0E0' align='center' width='140'><span class='Estilo41'>Tipo</span></td>
<td  bgcolor='DCE9E5' align='center' width='140'><span class='Estilo41'>Codigo Rubro Presupuestal</span></td>
<td  bgcolor='DCE9E5' align='center' width='140'><span class='Estilo41'>Acto Administrativo</span></td>
<td  bgcolor='DCE9E5' align='center' width='100'><span class='Estilo41'>Fecha</span></td>
<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Adiciones</span></td>
<td  bgcolor='DCE9E5' align='center' width='115'><span class='Estilo41'>Reduccion</span></td>
");
$sq = "SELECT cod_pptal, nom_rubro,cod_sia from car_ppto_ing where tip_dato='D' order by cod_pptal asc";
$re = mysql_db_query($database, $sq, $cx);
		while($rw = mysql_fetch_array($re))
		{
			$cod_pptal=$rw["cod_pptal"];
			$cod_sia =$rw["cod_sia"];
			$sq3 = "SELECT tipo_acto,num_acto,fecha_adi,sum(valor_adi) as valor_adi from adi_ppto_ing where cod_pptal ='$cod_pptal' group by tipo_acto,num_acto,fecha_adi";
			$re3 = mysql_db_query($database, $sq3, $cx);
			while($rw3 = mysql_fetch_array($re3))
			{
				$tipo_acto=$rw3["tipo_acto"]."&nbsp;".$rw3["num_acto"];
				$fecha_adi =$rw3["fecha_adi"];
				$valor_adi = $rw3["valor_adi"];
				$valor_adir =0;
					if ($valor_adi >0)
					{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='left' class='text' bgcolor='E0E0E0'>ADICION</td>
						<td align='left' class='text'>%s</td>
						<td align='center'><span class='Estilo4'> %s </span></td>
						<td align='center' class='date'>%s</td>
						<td align='right'><span class='Estilo4'> %s </span></td>
						<td align='right'><span class='Estilo4'> %s </span></td>
						</tr>", $rw["cod_sia"].$rw["cod_pptal"], $tipo_acto, $fecha_adi, $valor_adi, $valor_adir); 
					}
			}
			$sq6 = "SELECT tipo_acto,num_acto,fecha_adi,sum(valor_adi) as valor_adi from red_ppto_ing where cod_pptal ='$cod_pptal' group by tipo_acto,num_acto,fecha_adi";
			$re6 = mysql_db_query($database, $sq6, $cx);

			while($rw6 = mysql_fetch_array($re6))
			{
				$valor_adir=$rw6["valor_adi"];
				$tipo_acto=$rw6["tipo_acto"]."&nbsp;".$rw6["num_acto"];
				$fecha_adi =$rw6["fecha_adi"];
				$valor_adi = 0;
					if ($valor_adir >0)
					{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='left' class='text' bgcolor='E0E0E0'>REDUCCION</td>
						<td align='left' class='text'>%s</td>
						<td align='center'><span class='Estilo4'> %s </span></td>
						<td align='center' class='date'>%s</td>
						<td align='right'><span class='Estilo4'> %s </span></td>
						<td align='right'><span class='Estilo4'> %s </span></td>
						</tr>", $rw["cod_sia"].$rw["cod_pptal"], $tipo_acto, $fecha_adi, $valor_adi, $valor_adir); 
					}
			}	
			$sq7 = "SELECT tipo_acto,num_acto,fecha_adi,sum(valor_adi) as valor_adi from creditos_ing where cod_pptal ='$cod_pptal' group by tipo_acto,num_acto,fecha_adi";
			$re7 = mysql_db_query($database, $sq7, $cx);

			while($rw7 = mysql_fetch_array($re7))
			{
				$valor_adi=$rw7["valor_adi"];
				$tipo_acto=$rw7["tipo_acto"]."&nbsp;".$rw7["num_acto"];
				$fecha_adi =$rw7["fecha_adi"];
				$valor_adir = 0;
					if ($valor_adi >0)
					{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='left' class='text' bgcolor='E0E0E0'>CREDITO</td>
						<td align='left' class='text'>%s</td>
						<td align='center'><span class='Estilo4'> %s </span></td>
						<td align='center' class='date'>%s</td>
						<td align='right'><span class='Estilo4'> %s </span></td>
						<td align='right'><span class='Estilo4'> %s </span></td>
						</tr>", $rw["cod_sia"].$rw["cod_pptal"], $tipo_acto, $fecha_adi, $valor_adi, $valor_adir); 
					}
			}	
		
			$sq8 = "SELECT tipo_acto,num_acto,fecha_adi,sum(valor_adi) as valor_adi from contracreditos_ing where cod_pptal ='$cod_pptal' group by tipo_acto,num_acto,fecha_adi";
			$re8 = mysql_db_query($database, $sq8, $cx);

			while($rw8 = mysql_fetch_array($re8))
			{
				$valor_adir=$rw8["valor_adi"];
				$tipo_acto=$rw8["tipo_acto"]."&nbsp;".$rw8["num_acto"];
				$fecha_adi =$rw8["fecha_adi"];
				$valor_adi = 0;
					if ($valor_adir >0)
					{
						printf("
						<span class='Estilo4'>
						<tr>
						<td align='left' class='text' bgcolor='E0E0E0'>CONTRACREDITO</td>
						<td align='left' class='text'>%s</td>
						<td align='center'><span class='Estilo4'> %s </span></td>
						<td align='center' class='date'>%s</td>
						<td align='right'><span class='Estilo4'> %s </span></td>
						<td align='right'><span class='Estilo4'> %s </span></td>
						</tr>", $rw["cod_sia"].$rw["cod_pptal"], $tipo_acto, $fecha_adi, $valor_adi, $valor_adir); 
					}
			}	

	}
printf("</table></center>");
}
?>

