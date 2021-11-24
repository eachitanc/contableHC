<?
set_time_limit(5600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=FORMATO_201102_F06A_10_CDN.xls");
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
$sq2 = "select raz_soc from empresa where cod_emp = '2'";
$re2 = mysql_db_query($database, $sq2, $cx);
while($row2 = mysql_fetch_array($re2)) 
   {
   $empresa = $row2["raz_soc"];
   }


// llegan las variables
$fecha_ini=$_GET['fecha_ini'];
$fecha_fin=$_GET['fecha_fin'];
$mes = $_GET['mes'];
$periodo = array ("","MARZO", "JUNIO", "SEPTIEMBRE", "DICIEMBRE","ANUAL");
for ($i=1;$i<=13;$i++)
{
	if ($mes == $i) $per = $periodo[$i];
}

printf("
<center>
<table BORDER='1' class='bordepunteado1'>
<tr>
<td  bgcolor='#DCE9E5' align='center'>Codigo Presupuestal</td>
<td  bgcolor='#DCE9E5' align='center'>Fecha De Recaudo</td>
<td  bgcolor='#DCE9E5' align='center'>Periodo reportado</td>
<td  bgcolor='#DCE9E5' align='center'>Numero De Recibo</td>
<td  bgcolor='#DCE9E5' align='center'>Recibido De</td>
<td  bgcolor='#DCE9E5' align='center'>Concepto Recaudo</td>
<td  bgcolor='#DCE9E5' align='center'>Valor</td>
<td  bgcolor='#DCE9E5' align='center'>No.Cuenta Bancaria Destino</td>
<td  bgcolor='#DCE9E5' align='center'>Banco</td>
</tr>
");

$sq = "select * from recaudo_ncbt where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' order by fecha_recaudo";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			$cuenta_banco = $rw10['banco_sia'];
			if ($rw10["cod_sia"] =='S' ||  $rw10["cod_sia"] =='E' || $rw10["cod_sia"] =='V' || $rw10["cod_sia"] =='' || $rw10["cod_sia"] =='T') $color = 'bgcolor=red';
			if (!$cuenta_banco)
				{
					for ($i=1;$i<=15;$i++)
					 {
						 $cod_conta = $rw['pgcp'.$i];
						 $cod_conta2 = substr($cod_conta,0,4); 
						 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
						 $cuenta_banco = $cod_conta;
					 }
				}
			$sq11 = "SELECT cod_sia, num_cta from pgcp where cod_pptal ='$cuenta_banco'";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			printf("
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			</tr>",$rw10["cod_sia"].$rw["cuenta"], $rw["fecha_recaudo"],$per,$rw["id_manu_ncbt"],$rw["tercero"],ucfirst(ereg_replace("[,;]", "",$rw["des_recaudo"])),$rw["vr_digitado"], $rw11["num_cta"], $rw11["cod_sia"]); 
			$color='';
}
$sq = "select * from recaudo_rcgt where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' order by fecha_recaudo";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			$cuenta_banco = $rw10['banco_sia'];
				if ($rw10["cod_sia"] =='S' ||  $rw10["cod_sia"] =='E' || $rw10["cod_sia"] =='V' || $rw10["cod_sia"] =='' || $rw10["cod_sia"] =='T') $color = 'bgcolor=red';
			$sq4 ="SELECT MAX(id) as ids FROM recaudo_rcgt WHERE (id_recau ='$rw[id_recau]');";
			$rs4 = $rs4 =mysql_db_query($database,$sq4,$cx);
			$rw4=mysql_fetch_array($rs4);
			$sq3 ="select * from recaudo_rcgt where id = '$rw4[ids]'";
			$rs3 =mysql_db_query($database,$sq3,$cx);
			$rw3=mysql_fetch_array($rs3);
			if (!$cuenta_banco)
				{
					for ($i=1;$i<=161;$i++)
					 {
						 $cod_conta = $rw3['pgcp'.$i];
						 $cod_conta2 = substr($cod_conta,0,4); 
						 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
						 $cuenta_banco = $cod_conta;
					 }
				}
			$sq11 = "SELECT cod_sia, num_cta from pgcp where cod_pptal ='$cuenta_banco'";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			printf("
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			</tr>",$rw10["cod_sia"].$rw["cuenta"], $rw["fecha_recaudo"],$per,$rw["id_manu_rcgt"],$rw["tercero"],ucfirst(ereg_replace("[,;]", "",$rw["des_recaudo"])),$rw["vr_digitado"], $rw11["num_cta"], $rw11["cod_sia"]); 
			$color='';
}
$sq = "select * from recaudo_roit where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' order by fecha_recaudo";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			$cuenta_banco = $rw10['banco_sia'];
				if ($rw10["cod_sia"] =='S' ||  $rw10["cod_sia"] =='E' || $rw10["cod_sia"] =='V' || $rw10["cod_sia"] =='' || $rw10["cod_sia"] =='T') $color = 'bgcolor=red';
			if (!$cuenta_banco)
				{
					for ($i=1;$i<=15;$i++)
					 {
						 $cod_conta = $rw['pgcp'.$i];
						 $cod_conta2 = substr($cod_conta,0,4); 
						 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
						 $cuenta_banco = $cod_conta;
					 }
				}
			$sq11 = "SELECT cod_sia, num_cta from pgcp where cod_pptal ='$cuenta_banco'";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			printf("
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			</tr>",$rw10["cod_sia"].$rw["cuenta"], $rw["fecha_recaudo"],$per,$rw["id_manu_roit"],$rw["tercero"],ucfirst(ereg_replace("[,;]", "",$rw["des_recaudo"])),$rw["vr_digitado"], $rw11["num_cta"], $rw11["cod_sia"]); 
			$color='';
}
$sq = "select * from recaudo_tnat where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' order by fecha_recaudo";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			$cuenta_banco = $rw10['banco_sia'];
				if ($rw10["cod_sia"] =='S' ||  $rw10["cod_sia"] =='E' || $rw10["cod_sia"] =='V' || $rw10["cod_sia"] =='' || $rw10["cod_sia"] =='T') $color = 'bgcolor=red';
			if (!$cuenta_banco)
				{
					for ($i=1;$i<=15;$i++)
					 {
						 $cod_conta = $rw['pgcp'.$i];
						 $cod_conta2 = substr($cod_conta,0,4); 
						 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
						 $cuenta_banco = $cod_conta;
					 }
				}
			$sq11 = "SELECT cod_sia, num_cta from pgcp where cod_pptal ='$cuenta_banco'";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			printf("
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			</tr>",$rw10["cod_sia"].$rw["cuenta"], $rw["fecha_recaudo"],$per,$rw["id_manu_tnat"],$rw["tercero"],ucfirst(ereg_replace("[,;]", "",$rw["des_recaudo"])),$rw["vr_digitado"], $rw11["num_cta"], $rw11["cod_sia"]); 
			$color='';
}


if ($empresa =='MUNICIPIO DE IPIALES')
{
$sq = "select * from recaudo_riip where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' order by fecha_recaudo";
//$sq = "select * from recaudo_riip where fecha_recaudo BETWEEN '2015/03/02' AND '2015/03/02' order by fecha_recaudo";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			$cuenta_banco = $rw10['banco_sia'];
				if ($rw10["cod_sia"] =='S' ||  $rw10["cod_sia"] =='E' || $rw10["cod_sia"] =='V' || $rw10["cod_sia"] =='' || $rw10["cod_sia"] =='T') $color = 'bgcolor=red';
			$sq4 ="SELECT MAX(id) as ids FROM recaudo_riip WHERE (id_recau ='$rw[id_recau]');";
			$rs4 = $rs4 =mysql_db_query($database,$sq4,$cx);
			$rw4=mysql_fetch_array($rs4);
			$sq3 ="select * from lib_aux2 where id_auto = '$rw[id_recau]' and cuenta like '1110%'";
			$rs3 =mysql_db_query($database,$sq3,$cx);
			$rw3=mysql_fetch_array($rs3);
			$cuenta_banco = $rw3['cuenta'];
			// Consultar cuenta banco
			/*
			if (!$cuenta_banco)
				{
					for ($i=1;$i<=301;$i++)
					 {
						 $cod_conta = $rw3['pgcp'.$i];
						 $cod_conta2 = substr($cod_conta,0,4); 
						 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
						 $cuenta_banco = $cod_conta;
					 }
				}
				*/
			$sq11 = "SELECT cod_sia, num_cta from pgcp where cod_pptal ='$cuenta_banco'";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			printf("
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			</tr>",$rw10["cod_sia"].$rw["cuenta"], $rw["fecha_recaudo"],$per,$rw["id_manu_rcgt"],$rw["tercero"],ucfirst(ereg_replace("[,;]", "",$rw["des_recaudo"])),$rw["vr_digitado"], $rw11["num_cta"], $rw11["cod_sia"]); 
			$color='';
}


$sq = "select * from recaudo_rica where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' order by fecha_recaudo";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			$cuenta_banco = $rw10['banco_sia'];
				if ($rw10["cod_sia"] =='S' ||  $rw10["cod_sia"] =='E' || $rw10["cod_sia"] =='V' || $rw10["cod_sia"] =='' || $rw10["cod_sia"] =='T') $color = 'bgcolor=red';
			$sq4 ="SELECT MAX(id) as ids FROM recaudo_rica WHERE (id_recau ='$rw[id_recau]');";
			$rs4 = $rs4 =mysql_db_query($database,$sq4,$cx);
			$rw4=mysql_fetch_array($rs4);
			$sq3 ="select * from recaudo_rica where id = '$rw4[ids]'";
			$rs3 =mysql_db_query($database,$sq3,$cx);
			$rw3=mysql_fetch_array($rs3);


			if (!$cuenta_banco)
				{
					for ($i=1;$i<=161;$i++)
					 {
						 $cod_conta = $rw3['pgcp'.$i];
						 $cod_conta2 = substr($cod_conta,0,4); 
						 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
						 $cuenta_banco = $cod_conta;
					 }
				}
			$sq11 = "SELECT cod_sia, num_cta from pgcp where cod_pptal ='$cuenta_banco'";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			printf("
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			</tr>",$rw10["cod_sia"].$rw["cuenta"], $rw["fecha_recaudo"],$per,$rw["id_manu_rcgt"],$rw["tercero"],ucfirst(ereg_replace("[,;]", "",$rw["des_recaudo"])),$rw["vr_digitado"], $rw11["num_cta"], $rw11["cod_sia"]); 
			$color='';
}

$sq = "select * from recaudo_rica1 where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' order by fecha_recaudo";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			$cuenta_banco = $rw10['banco_sia'];
				if ($rw10["cod_sia"] =='S' ||  $rw10["cod_sia"] =='E' || $rw10["cod_sia"] =='V' || $rw10["cod_sia"] =='' || $rw10["cod_sia"] =='T') $color = 'bgcolor=red';
			$sq4 ="SELECT MAX(id) as ids FROM recaudo_rica1 WHERE (id_recau ='$rw[id_recau]');";
			$rs4 = $rs4 =mysql_db_query($database,$sq4,$cx);
			$rw4=mysql_fetch_array($rs4);
			$sq3 ="select * from recaudo_rica1 where id = '$rw4[ids]'";
			$rs3 =mysql_db_query($database,$sq3,$cx);
			$rw3=mysql_fetch_array($rs3);


			if (!$cuenta_banco)
				{
					for ($i=1;$i<=161;$i++)
					 {
						 $cod_conta = $rw3['pgcp'.$i];
						 $cod_conta2 = substr($cod_conta,0,4); 
						 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
						 $cuenta_banco = $cod_conta;
					 }
				}
			$sq11 = "SELECT cod_sia, num_cta from pgcp where cod_pptal ='$cuenta_banco'";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			printf("
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			</tr>",$rw10["cod_sia"].$rw["cuenta"], $rw["fecha_recaudo"],$per,$rw["id_manu_rcgt"],$rw["tercero"],ucfirst(ereg_replace("[,;]", "",$rw["des_recaudo"])),$rw["vr_digitado"], $rw11["num_cta"], $rw11["cod_sia"]); 
			$color='';
}

$sq = "select * from recaudo_rica2 where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' order by fecha_recaudo";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			$cuenta_banco = $rw10['banco_sia'];
				if ($rw10["cod_sia"] =='S' ||  $rw10["cod_sia"] =='E' || $rw10["cod_sia"] =='V' || $rw10["cod_sia"] =='' || $rw10["cod_sia"] =='T') $color = 'bgcolor=red';
			$sq4 ="SELECT MAX(id) as ids FROM recaudo_rica2 WHERE (id_recau ='$rw[id_recau]');";
			$rs4 = $rs4 =mysql_db_query($database,$sq4,$cx);
			$rw4=mysql_fetch_array($rs4);
			$sq3 ="select * from recaudo_rica2 where id = '$rw4[ids]'";
			$rs3 =mysql_db_query($database,$sq3,$cx);
			$rw3=mysql_fetch_array($rs3);


			if (!$cuenta_banco)
				{
					for ($i=1;$i<=161;$i++)
					 {
						 $cod_conta = $rw3['pgcp'.$i];
						 $cod_conta2 = substr($cod_conta,0,4); 
						 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
						 $cuenta_banco = $cod_conta;
					 }
				}
			$sq11 = "SELECT cod_sia, num_cta from pgcp where cod_pptal ='$cuenta_banco'";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			printf("
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			</tr>",$rw10["cod_sia"].$rw["cuenta"], $rw["fecha_recaudo"],$per,$rw["id_manu_rcgt"],$rw["tercero"],ucfirst(ereg_replace("[,;]", "",$rw["des_recaudo"])),$rw["vr_digitado"], $rw11["num_cta"], $rw11["cod_sia"]); 
			$color='';
}


$sq = "select * from recaudo_riur where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' order by fecha_recaudo";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			$cuenta_banco = $rw10['banco_sia'];
				if ($rw10["cod_sia"] =='S' ||  $rw10["cod_sia"] =='E' || $rw10["cod_sia"] =='V' || $rw10["cod_sia"] =='' || $rw10["cod_sia"] =='T') $color = 'bgcolor=red';
			$sq4 ="SELECT MAX(id) as ids FROM recaudo_riur WHERE (id_recau ='$rw[id_recau]');";
			$rs4 = $rs4 =mysql_db_query($database,$sq4,$cx);
			$rw4=mysql_fetch_array($rs4);
			$sq3 ="select * from recaudo_riur where id = '$rw4[ids]'";
			$rs3 =mysql_db_query($database,$sq3,$cx);
			$rw3=mysql_fetch_array($rs3);

			if (!$cuenta_banco)
				{
					for ($i=1;$i<=15;$i++)
					 {
						 $cod_conta = $rw3['pgcp'.$i];
						 $cod_conta2 = substr($cod_conta,0,4); 
						 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
						 $cuenta_banco = $cod_conta;
					 }
				}
			$sq11 = "SELECT cod_sia, num_cta from pgcp where cod_pptal ='$cuenta_banco'";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			printf("
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			</tr>",$rw10["cod_sia"].$rw["cuenta"], $rw["fecha_recaudo"],$per,$rw["id_manu_rcgt"],$rw["tercero"],ucfirst(ereg_replace("[,;]", "",$rw["des_recaudo"])),$rw["vr_digitado"], $rw11["num_cta"], $rw11["cod_sia"]); 
			$color='';
}

$sq = "select * from recaudo_rtic where fecha_recaudo BETWEEN '$fecha_ini' AND '$fecha_fin' order by fecha_recaudo";
$re = mysql_db_query($database, $sq, $cx);
while ($rw = mysql_fetch_array($re))
{
			// Consulto banco relacionado con la cuenta
			$sq10 = "SELECT cod_sia,banco_sia from car_ppto_ing where cod_pptal ='$rw[cuenta]'";
			$re10 = mysql_db_query($database, $sq10, $cx);	
			$rw10 = mysql_fetch_array($re10);
			$cuenta_banco = $rw10['banco_sia'];
				if ($rw10["cod_sia"] =='S' ||  $rw10["cod_sia"] =='E' || $rw10["cod_sia"] =='V' || $rw10["cod_sia"] =='' || $rw10["cod_sia"] =='T') $color = 'bgcolor=red';
			$sq4 ="SELECT MAX(id) as ids FROM recaudo_rtic WHERE (id_recau ='$rw[id_recau]');";
			$rs4 = $rs4 =mysql_db_query($database,$sq4,$cx);
			$rw4=mysql_fetch_array($rs4);
			$sq3 ="select * from recaudo_rtic where id = '$rw4[ids]'";
			$rs3 =mysql_db_query($database,$sq3,$cx);
			$rw3=mysql_fetch_array($rs3);

			if (!$cuenta_banco)
				{
					for ($i=1;$i<=15;$i++)
					 {
						 $cod_conta = $rw3['pgcp'.$i];
						 $cod_conta2 = substr($cod_conta,0,4); 
						 if ($cod_conta2 =='1110' or $cod_conta2 =='1120')
						 $cuenta_banco = $cod_conta;
					 }
				}
			$sq11 = "SELECT cod_sia, num_cta from pgcp where cod_pptal ='$cuenta_banco'";
			$re11 = mysql_db_query($database, $sq11, $cx);	
			$rw11 = mysql_fetch_array($re11);
			printf("
			<tr $color>
			<td align='left' class='text'>%s</td>
			<td align='center' class='date'>%s</td>
			<td align='center'>%s</td>
			<td align='center'>%s</td>
			<td align='left'>%s</td>
			<td align='left'>%s</td>
			<td align='right' width='90'>%s</td>
			<td align='left'>%s</td>
			<td align='center'>%s</td>
			</tr>",$rw10["cod_sia"].$rw["cuenta"], $rw["fecha_recaudo"],$per,$rw["id_manu_rcgt"],$rw["tercero"],ucfirst(ereg_replace("[,;]", "",$rw["des_recaudo"])),$rw["vr_digitado"], $rw11["num_cta"], $rw11["cod_sia"]); 
			$color='';
}

}
printf("</table></center>");
}
?>
</body>
</html>
		