<?
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201102_F7B2_10_CDN.xls");
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
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Fecha De Pago</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Periodo reporte</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>No. De Comprobante</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Beneficiario</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>C�dula O Nit</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Detalle De Pago</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Valor Comprobante De Pago</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Descuentos</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Neto Pagado</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>Banco</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>No. De Cuenta</span></td>
<td  bgcolor='#DCE9E5' align='center'><span class='Estilo41'>No. De Cheque O Nd</span></td>
</tr>
");
$sq = "SELECT * from conta_cesp where fecha_ncon BETWEEN '$fecha_ini' AND '$fecha_fin'ORDER BY fecha_ncon asc";
$re = mysql_db_query($database, $sq, $cx);
while($rw = mysql_fetch_array($re))
{
			// Buscamos terceros por nombre
			$ter_comp= ereg_replace("[ ]", "",$rw["tercero"]);
			$sq3 ="select * from terceros_naturales";
			$re3 = mysql_db_query($database,$sq3,$cx);
			while ($rw3 = mysql_fetch_array($re3))
			{
				$nat = $rw3["pri_ape"].$rw3["seg_ape"].$rw3["pri_nom"].$rw3["seg_nom"];
				$nat2= ereg_replace("[ ]", "",$nat);
				if ($ter_comp == $nat2)
				{
					$doc= $rw3["num_id"];
					break; 
				}else{
					$doc='';
				}	
			}
			if ($doc =='')
			{
				$sq4 ="select * from terceros_juridicos";
				$re4 = mysql_db_query($database,$sq4,$cx);
				while ($rw4 = mysql_fetch_array($re4))
				{
					$jur = $rw4["raz_soc2"];
					$jur2= ereg_replace("[ ]", "",$jur);
					if ($ter_comp == $jur2)
					{
						$doc= $rw4["num_id2"]; 
						break;
					}else{
						$doc='';
					}
				}
			}
			$i =0;
			$cont =0;
			for ($i=1;$i<=15;$i++)
			{
				$cod_conta = $rw['pgcp'.$i];
			 	$cod_conta2 = substr($cod_conta,0,4); 
			 	if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
			 	{
					$pgcp = $cod_conta;
					$neto = $rw["vr_cre_".$i];
					$cheque = $rw["cheque".$i];
					$sq2 = "SELECT cod_sia, num_cta,fuentes_recursos from pgcp where cod_pptal ='$cod_conta'";
					$re2 = mysql_db_query($database, $sq2, $cx);	
					$rw2 = mysql_fetch_array($re2);
					$cont++;
				}
			}
			if ($cont >1)
			{
				$error ="bgcolor=red";
			}
			$des = $rw["tot_deb"] - $neto;
			printf("
			<span class='Estilo4'>
			<tr>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='right'>%s</td>
			<td align='center'>%s</td>
			<td align='center' $error>%s</td>
			<td align='center'>%s</td>
				</tr>",$rw["fecha_ncon"], $per,$rw["id_manu_ncon"], $rw["tercero"], $doc, ucfirst(ereg_replace("[,;]", "",$rw["des_ncon"])), $rw["tot_deb"], $des,$neto,$rw2["cod_sia"],$rw2["num_cta"] ,$cheque); 
			}

printf("</table></center>");
}
?>
</body>
</html>
		