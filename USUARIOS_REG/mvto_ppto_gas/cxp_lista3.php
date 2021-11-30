<?php
set_time_limit(1200);
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CUENTAS_POR_PAGAR.xls");
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
include('../config.php');
echo "<table border='1'>";
echo "<tr>
			<td>ORDEN</td>
			<td>IMPUTACION</td>
			<td>NOMBRE RUBRO</td>
			<td>No DOCUMENTO</td>
			<td>BENEFICIARIO</td>
			<td>DETALLE</td>
			<td>VALOR INICIAL DEL CONTRATO</td>
			<td>FECHA INICIAL DEL CONTRATO</td>
			<td>CDP No</td>
			<td>VALOR CDP</td>
			<td>CRP No</td>
			<td>VALOR CRP</td>
			<td>CDP ADICION</td>
			<td>RP ADICION</td>
			<td>VALOR ADICION</td>
			<td>VALOR FINAL DEL CONTRATO</td>
			<td>VALOR TRAMITADO</td>
			<td>SALDO POR PAGAR</td>
	 </tr>";								
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
   	$sq2 ="select * from cobp where vr_digitado > 0 and liq !='SI' group by id_auto_cobp,cuenta";  //distint
	$re2 = $cx->query($sq2);
	$contt =0;
		while($row2 = $re2->fetch_assoc())
		{
			$sq3 = "select * from ceva where id_auto_cobp = '$row2[id_auto_cobp]' or id_auto_ceva ='$row2[ceva]'";
			$re3 = $cx->query($sq3);
			$filas = mysql_num_rows($re3);
			if ($filas == 0)
			{
				
				$sq6 ="select * from crpp where id_auto_crpp = '$row2[id_auto_crpp]' and cuenta ='$row2[cuenta]'";
				$re6 = mysql_db_query($database, $sq6, $cx);
				$rw6 = mysql_fetch_array($re6);
				
				$sq7 ="select * from cdpp where consecutivo= '$rw6[id_auto_cdpp]' and cuenta ='$row2[cuenta]'";
				$re7 = mysql_db_query($database, $sq7, $cx);
				$rw7 = mysql_fetch_array($re7);
				
				$sq4 ="select sum(vr_digitado) as valors from cobp where id_auto_cobp = '$row2[id_auto_cobp]' and cuenta ='$row2[cuenta]'";
				$re4 = mysql_db_query($database, $sq4, $cx);
				$rw4 = mysql_fetch_array($re4);
					
					$sq5="select id_manu_obcg,pgcp2 from obcg where id_auto_cobp ='$row2[id_auto_cobp]'";
					$rs5=mysql_db_query($database,$sq5,$cx);
					$rw5 = mysql_fetch_array($rs5);
				$contt ++;
				echo "<tr bgcolor='$contt'>
					<td class='text'>$fil</td>
					<td class='text'>$row2[cuenta]</td>
					<td>$row2[nom_rubro]</td>
					<td class='text'>$row2[ccnit]</td>
					<td class='text'>$row2[tercero]</td>
					<td>$row2[des_cobp]</td>
					<td>$rw6[vr_digitado]</td>
					<td>$rw6[fecha_crpp]</td>
					<td>$rw6[id_manu_cdpp]</td>
					<td>$rw7[valor]</td>
					<td>$rw6[id_manu_crpp]</td>
					<td>$rw6[vr_digitado]</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>$rw4[valors]</td>
	 				</tr>";
			}
	 	}
echo "</table>";
?>
</body>
</html>