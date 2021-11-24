<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$fecha_pago = $_GET['fecha_pag'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

// Determino consecutivo ref
			$sq3="select max(ref) as ref from lib_aux4";
			$re3 = mysql_query($sq3, $cx);
			$rw3 = mysql_fetch_array($re3);
			$ref =$rw3['ref']+1;
// Determino cuenta segun tipo de pago
$tipo ='Efectivo';
$sq5 ="select debito,credito from cca_pagos where tipo ='$tipo'";
$re5 = mysql_query($sq5, $cx);
$rw5 = mysql_fetch_array($re5);
$debito = $rw5['debito'];
$credito =$rw5['credito'];
// realizo la consulta a z pagos para requerir datos
$sq2 ="select * from z_aux_pagos";
$res = mysql_query($sq2, $cx);
while ($row = mysql_fetch_array($res))
		{			
			//Consultar tercero
			$sq6 ="select nombre from z_terceros where num_id ='$row[tercero]'";
			$re6 = mysql_query($sq6, $cx);
			$rw6 = mysql_fetch_array($re6);
			// Determino id_auto
			$resulta = mysql_query("SHOW TABLE STATUS FROM $database LIKE 'lib_aux4'");
			while($array = mysql_fetch_array($resulta)) 
			{
			$consecutivo = $array[Auto_increment];
			}
			$consecutivo = "CEPL".$consecutivo;
			// Determino id_manu
			$sq4="select max(dcto) as dcto from lib_aux4";
			$re4 = mysql_query($sq4, $cx);
			$rw4 = mysql_fetch_array($re4);
			if ($rw4['dcto'] =='') 
			{
				// tomo el año
				$anno = substr($fecha_pago,0,4);	
				$dcto = $anno . '0000';
				$dcto = $dcto + 1;
			}else{
				$dcto = $rw4['dcto']+1;	
			}
		// Realizo insert de valor
		$sq13 ="insert into lib_aux4 (fecha_ini,fecha_fin,litros,precio,tipo,forma_pago,id_auto,fecha,dcto,ref,cuenta,detalle,ccnit,debito,credito,cheque,cliente,tercero) values('$row[fecha_ini]','$row[fecha_fin]',$row[litros],$row[precio],'VAL','forma_pago','$consecutivo','$fecha_pago','$dcto','$ref','$debito','$row[concepto]','$row[tercero]','$row[valor]',0,'cheque','$row[cliente]','$rw6[nombre]')";
			$re13 = mysql_query($sq13);
		// Realizo insert de descuento
		if($row['descuentos'] > 0)
		{
			// busco los descuentos registrados para la respectiva quincena
		}
		$neto = $row['valor'] - $desc;
		// Realizo insert de neto
		$sq13 ="insert into lib_aux4 (fecha_ini,fecha_fin,litros,precio,tipo,forma_pago,id_auto,fecha,dcto,ref,cuenta,detalle,ccnit,debito,credito,cheque,cliente,tercero) values('$row[fecha_ini]','$row[fecha_fin]',$row[litros],$row[precio],'NET','forma_pago','$consecutivo','$fecha_pago','$dcto','$ref','$credito','$row[concepto]','$row[tercero]','0',$neto,'cheque','$row[cliente]','$rw6[nombre]')";
			$re13 = mysql_query($sq13);	
		}
    	
$cx = null;
?>
