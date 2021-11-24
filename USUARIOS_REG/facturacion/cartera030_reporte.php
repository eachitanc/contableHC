<?php
set_time_limit(1800);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CARTERA_C30.xls");
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
<table border="1" class="bordepunteado1" align="center">
    <tr> 
	<td >Ccnit</td>
    <td >tercero</td>
    <td >Fecha fact</td>
    <td >Fecha Rad</td>
    <td >No cuenta</td>
    <td >Valor</td>
    <td >Glosa</td>
    <td >Recaudo</td>
    <td >Saldo</td>
       
    </tr>
<?
$fecha =$_POST['fecha'];
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
mysql_select_db("$database"); 
$sq1="select cta_radicado,cta_copago,cta_sinradicar from ctas_cartera";
	$rs1 =mysql_query($sq1,$cx);
	while ($rw1 =mysql_fetch_array($rs1))
	{
		// consulto en el libro auxiliar el estado de estas cuentas
		$sq2="select distinct ref,tercero,ccnit from lib_aux4 where cuenta = $rw1[cta_radicado] and fecha <='$fecha'" ;
		$rs2 =mysql_query($sq2,$cx);
		while ($rw2 =mysql_fetch_array($rs2))
		{
			// Calculo valor de la cuenta facturada radicado +  copago
			$sq3 ="select sum(debito) as valor from lib_aux4 where ref ='$rw2[ref]' and (cuenta = $rw1[cta_radicado] or cuenta = $rw1[cta_copago]) group by ref ";
			$rs3 =mysql_query($sq3,$cx);
			$rw3 =mysql_fetch_array($rs3);
			// consulto la cuenta registrada para glosas
			$sq5="select distinct cta_glosa from contrato_evento" ;
			$rs5 =mysql_query($sq5,$cx);
			$rw5 =mysql_fetch_array($rs5);
			// Valor glosado de la cuenta
			$sq4="select sum(debito) as glosa from lib_aux4 where ref ='$rw2[ref]' and cuenta = $rw5[cta_glosa] group by ref";
			$rs4 =mysql_query($sq4,$cx);
			$rw4 =mysql_fetch_array($rs4);
			// valor recaudado
			$sq6 ="select sum(credito) as recaduo from lib_aux4 where ref ='$rw2[ref]' and (id_auto like 'COPG%' or id_auto like 'RECF%') and cuenta ='13190201'  group by ref ";
			$rs6 =mysql_query($sq6,$cx);
			$rw6 =mysql_fetch_array($rs6);
			// Valor recaudado como copagos
			$sq7 ="select sum(debito) as recaduo_cop from lib_aux4 where ref ='$rw2[ref]' and cuenta ='$rw1[cta_copago]' group by ref ";
			$rs7 =mysql_query($sq7,$cx);
			$rw7 =mysql_fetch_array($rs7);
			$recaudo = $rw6['recaduo'] +$rw7['recaduo_cop'];
			$saldo = $rw3['valor'] - 	$recaudo - $rw4['glosa'];
			// seleccionar la fecha de facturacion 
			$sq8="select  fecha_ref from lib_aux4  where ref ='$rw2[ref]' and id_auto like 'FACT%'";
			$rs8 =mysql_query($sq8,$cx);
			$rw8 =mysql_fetch_array($rs8);
			
			// seleccionar la fecha de radicacion 
			$sq9="select distinct fecha_ref from lib_aux4  where ref ='$rw2[ref]' and cuenta = '$rw1[cta_radicado]' and id_auto not like 'RECF%' ";
			$rs9 =mysql_query($sq9,$cx);
			$rw9 =mysql_fetch_array($rs9);
				echo "<tr>
					<td >$rw2[ccnit]</td>
					<td >$rw2[tercero]</td>
					<td >$rw8[fecha_ref]</td>
					<td >$rw9[fecha_ref]</td>
					<td class='text'>$rw2[ref]</td>
					<td align='right'>$rw3[valor]</td>
					<td align='right'>$rw4[glosa]</td>
					<td align='right'>$recaudo</td>
					<td align='right'>$saldo</td>
					</tr>
			";
			$recaudo =0;
			$saldo=0;
			$fecha_pre=0;
		}
	}

}
?>
</table>
</body>
</html>