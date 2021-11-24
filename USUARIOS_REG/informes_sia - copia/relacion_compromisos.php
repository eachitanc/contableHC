<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201102_F07A_10_CDN.xls");
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
// llegan las variables
$fecha_ini=$_GET['fecha_ini'];
$fecha_fin=$_GET['fecha_fin'];
$mes = $_GET['mes'];
$periodo = array ("","ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE","ANUAL");
for ($i=1;$i<=13;$i++)
{
	if ($mes == $i) $per = $periodo[$i];
}

printf("
<center>
<table BORDER='1' class='bordepunteado1'>
<tr>
<td  bgcolor='#DCE9E5' align='center' width='140'><span class='Estilo41'>Codigo Rubro Presupuestal</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Nombre del Rubro</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Numero del Cdp</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Fecha del Cdp</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Periodo reportado</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Valor del Cdp</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Fecha De Registro Presupuestal</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Valor del Registro Presupuestal</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Beneficiario</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Cedula o Nit</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Detalle Del Compromiso</span></td>
</tr>
");
$sq = "SELECT ter_nat, ter_jur, cuenta, detalle_crpp, id_manu_cdpp,id_auto_cdpp,id_manu_crpp, fecha_crpp,fecha_cdpp, vr_orig, sum(vr_digitado) as vr_digitado, tercero from crpp where fecha_crpp BETWEEN '$fecha_ini' AND '$fecha_fin' group by cuenta,id_auto_crpp ORDER BY cuenta";
$re = mysql_db_query($database, $sq, $cx);
		while($rw = mysql_fetch_array($re))
		{
			$ter_nat=$rw["ter_nat"];
			$ter_jur=$rw["ter_jur"];
			if (!empty($ter_nat))
			{
			$sq8 = "SELECT num_id from terceros_naturales where id ='$ter_nat'";
			$re8 = mysql_db_query($database, $sq8, $cx);
				while($rw8 = mysql_fetch_array($re8))
				{
				$documento =$rw8["num_id"];
				}
			}	else
			{
			$sq9 = "SELECT num_id2 from terceros_juridicos where id ='$ter_jur'";
			$re9 = mysql_db_query($database, $sq9, $cx);
				while($rw9 = mysql_fetch_array($re9))
				{
				$documento =$rw9["num_id2"];
				}
			}	
			$sq10 = "SELECT nom_rubro,cod_sia from car_ppto_gas where cod_pptal ='$rw[cuenta]'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			if ($rw10["cod_sia"] =='S' ||  $rw10["cod_sia"] =='E' || $rw10["cod_sia"] =='V' || $rw10["cod_sia"] =='' || $rw10["cod_sia"] =='T') $color = 'bgcolor=red';
					$sq11= "select fecha_reg,sum(valor) from cdpp where consecutivo ='$rw[id_auto_cdpp]' group by consecutivo";
					$rs11= mysql_db_query($database, $sq11, $cx);
					while($rw11 = mysql_fetch_array($rs11))
					{
						$fecha_cdpp =$rw11["fecha_reg"];
						$valor_cdpp =$rw11["sum(valor)"];
					}
			printf("
			<span class='Estilo4'>
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='right'>%s</td>
			<td align='center'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='right' width='90'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
				</tr>",$rw10["cod_sia"].$rw["cuenta"], ucfirst(ereg_replace("[,;]", "",$rw10["nom_rubro"])), $rw["id_manu_cdpp"],$fecha_cdpp,$per, $valor_cdpp, $rw["fecha_crpp"], $rw["vr_digitado"], $rw["tercero"],$documento, ucfirst(ereg_replace("[,;]", "",$rw["detalle_crpp"]))); 
			$color='';
			}
printf("</table></center>");
}
?>
</body>
</html>
		