<?php
set_time_limit(1200);
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CUENTAS POR PAGAR.xls");
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
function CalculaEdad($fecha_pago,$fecha_obl) {
       // datos fecha obligacion en partes
	   // separamos en partes las fechas
		$mes =array("0","31","28","31","31","30","31","31","30","31","30","31");
		$array_obl = explode ("/",$fecha_obl);
		$array_pag = explode ("/",$fecha_pago);
		
		$anos =  $array_pag[0] - $array_obl[0]; // calculamos a�os
		$meses = $array_pag[1] - $array_obl[1]; // calculamos meses
		$dias =  $array_pag[2] - $array_obl[2]; // calculamos d�as 
	   	
		$inicial =$array_obl[1]*1;
		$final =   $array_pag[1]*1;
		
		for ($i = $inicial; $i <= $final; $i++)
		{
			if ($i == $inicial)
			{
				$cdias = $mes[$inicial] -  $array_obl[2]; 	
			}	
			if ($i > $inicial and $i < $final)
			{
			    $cdias2 = $cdias2 +  $mes[$i];
			}
			if ($i == $final and $i != $inicial)
			{
				$cdias3 = $array_pag[2]; 	
			}
		}  
		$cdiasf = $cdias +  $cdias2+ $cdias3;
		return($cdiasf);
}
include('../config.php');
echo "<table border='1'>";
echo "<tr>
			<td>CUENTA</td>
			<td>DETALLE</td>
			<td>FECHA</td>
			<td>No CDP</td>
			<td>No COBP</td>
			<td>No OBCG</td>
			<td>pgcp</td
			<td>TERCERO</td>
			<td>CC/NIT</td>
			<td>CONCEPTO</td>
			<td>VALOR X PAGAR</td>
			<td>EDAD</td>
			<td>HASTA 60 DIAS</td>
			<td>DE 61 A 90 DIAS</td>
			<td>DE 91 A 18O DIAS</td>
			<td>DE 181 A 360 DIAS</td>
			<td>MAYOR A 360 DIAS</td>
	 </tr>";	
$fecha = $_POST['fecha_fin'];
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
   	$sq2 ="select * from cobp where vr_digitado > 0 and liq !='SI' and fecha_cobp <= '$fecha' group by id_auto_cobp order by fecha_cobp asc";
	$re2 = $cx->query($sq2);
		while($row2 = $re2->fetch_assoc())
		{
			$sq3 = "select * from ceva where fecha_ceva <= '$fecha' and (id_auto_cobp = '$row2[id_auto_cobp]' or id_auto_ceva ='$row2[ceva]')";
			$re3 = $cx->query($sq3);
			$filas = mysql_num_rows($re3);
			if ($filas == 0)
			{
				$edad = CalculaEdad($fecha,$row2['fecha_cobp']);
				$sq4 ="select sum(vr_digitado) as valors from cobp where id_auto_cobp = '$row2[id_auto_cobp]' group by id_auto_cobp";
				$re4 = mysql_db_query($database, $sq4, $cx);
				$rw4 = mysql_fetch_array($re4);
					
					$sq5="select id_manu_obcg,pgcp2 from obcg where id_auto_cobp ='$row2[id_auto_cobp]'";
					$rs5=mysql_db_query($database,$sq5,$cx);
					$rw5 = mysql_fetch_array($rs5);
				// Por edades
				if ($edad <= 60) $sesenta = $rw4[valors]; else $sesenta =0;
				if ($edad > 60 and $edad <= 90) $noventa = $rw4[valors]; else $noventa =0;
				if ($edad > 90 and $edad <= 180) $cochenta = $rw4[valors]; else $cochenta =0;
				if ($edad > 180 and $edad <= 360) $tresesenta = $rw4[valors]; else $tresesenta =0;
				if ($edad > 360) $cresesenta = $rw4[valors]; else $cresesenta =0;
				
				echo "<tr>
					<td class='text'>$row2[cuenta]</td>
					<td>$row2[nom_rubro]</td>
					<td>$row2[fecha_cobp]</td>
					<td>$row2[id_manu_cdpp]</td>
					<td>$row2[id_manu_cobp]</td>
					<td>$rw5[id_manu_obcg]</td>
					<td>$rw5[pgcp2]</td>
					<td>$row2[tercero]</td>
					<td class='text'>$row2[ccnit]</td>
					<td>$row2[des_cobp]</td>
					<td>$rw4[valors]</td>
					<td>$edad</td>
					<td>$sesenta</td>
					<td>$noventa</td>
					<td>$cochenta</td>
					<td>$tresesenta</td>
					<td>$cresesenta</td>
	 				</tr>";
					$edad =0;
					$sesenta =0;
					$noventa =0;
					$cochenta =0;
					$tresesenta =0;
					$cresesenta =0;
			}
	 	}
echo "</table>";
?>
</body>
</html>