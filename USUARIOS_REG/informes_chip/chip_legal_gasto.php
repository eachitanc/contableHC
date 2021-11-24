<?
set_time_limit(1800);
 header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Legalizacion_Gastos.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<style>
.text
  {
 mso-number-format:"\@"
  }
-->
</style>
<?php
// Conexionae con la base datos
include("../config.php");
$cx=mysql_connect ($server, $dbuser, $dbpass);
mysql_select_db("$database");
$fecha_ini =$_POST["fecha_ini"];
$fecha_fin =$_POST["fecha_fin"];
// Consulto todos los pagaos realizados en el periodo
echo "<table border='1'>
		<tr>
			<td bgcolor='#009999'>No EGRESO</td>
			<td bgcolor='#009999'>VALOR DEL PAGO</td>
			<td bgcolor='#009999'>NIT</td>
			<td bgcolor='#009999'>TERCERO</td>
			<td bgcolor='#009999'>N DOCUMENTO RECIBO B/S</td>
			<td bgcolor='#009999'>VALOR DE RECIBOP DE BIENES</td>
			<td bgcolor='#009999'>SALDO X LEGALIAR</td>
			<td bgcolor='#CCCCCC'>CONTROL</td>
			<td bgcolor='#CCCCCC'>FECHA_PAGO</td>
			<td bgcolor='#CCCCCC'>DETALLE</td>
			<td bgcolor='#CCCCCC'>VALOR CRP</td>
			<td bgcolor='#CCCCCC'>RUBRO</td>
			<td bgcolor='#CCCCCC'>CONCEPTO</td>
		</tr>";
$i =0;
$sql = "SELECT id_manu_ceva,ccnit,tercero,salud, pension, libranza, f_solidaridad, f_empleados, sindicato, embargo, cruce, otros, vr_retefuente,vr_reteiva,vr_reteica,vr_estampilla1,vr_estampilla2,vr_estampilla3,vr_estampilla4,vr_estampilla5,total_pagado,id_auto_crpp,fecha_ceva,des_ceva FROM ceva where fecha_ceva between '$fecha_ini' and '$fecha_fin'  order by fecha_ceva asc";
$res = mysql_query($sql, $cx) or die(mysql_error());
	while($rw = mysql_fetch_array($res)) 
	{
		// 
		$sq2 ="select ctrl, pago,detalle_crpp,id_manu_crpp,cuenta,vr_digitado from crpp where id_auto_crpp = '$rw[id_auto_crpp]'";
		$rs2 = mysql_query($sq2,$cx);
		$rw2 = mysql_fetch_array($rs2);
			$sq3 ="select nom_rubro from car_ppto_gas where cod_pptal = '$rw2[cuenta]'";
			$rs3= mysql_query($sq3);
			$rw3 =mysql_fetch_array($rs3);

		if($rw2['ctrl']=='NO')
		{
			// Pagado 
			$pagado = $rw['salud']+ $rw['pension']+ $rw['libranza']+ $rw['f_solidaridad']+ $rw['f_empleados']+ $rw['sindicato']+ $rw['embargo']+ $rw['cruce']+ $rw['otros']+ $rw['vr_retefuente']+$rw['vr_reteiva']+$rw['vr_reteica']+$rw['vr_estampilla1']+$rw['vr_estampilla2']+$rw['vr_estampilla3']+$rw['vr_estampilla4']+$rw['vr_estampilla5']+$rw['total_pagado'];
			// nombre rubro
			echo "<tr>
			<td>$rw[id_manu_ceva]</td>
			<td>$pagado</td>
			<td>$rw[ccnit]</td>
			<td>$rw[tercero]</td>
			<td>&nbsp; </td>
			<td> &nbsp;</td>
			<td>0</td>
			<td  bgcolor='#CCCCCC'>$rw2[pago]</td>
			<td  bgcolor='#CCCCCC'>$rw[fecha_ceva]</td>
			<td  bgcolor='#CCCCCC'>$rw2[id_manu_crpp] $rw[des_ceva]</td>
			<td  bgcolor='#CCCCCC'>$rw2[vr_digitado] </td>
			<td  bgcolor='#CCCCCC' class='text'>$rw2[cuenta] </td>
			<td  bgcolor='#CCCCCC'>$rw3[nom_rubro] </td>
		</tr>";
		$i++;
		$pagado=0;
		}
		
		if($rw2['ctrl']=='SI')
		{
			// Pagado 
			$pagado = $rw['salud']+ $rw['pension']+ $rw['libranza']+ $rw['f_solidaridad']+ $rw['f_empleados']+ $rw['sindicato']+ $rw['embargo']+ $rw['cruce']+ $rw['otros']+ $rw['vr_retefuente']+$rw['vr_reteiva']+$rw['vr_retecree']+$rw['vr_reteica']+$rw['vr_estampilla1']+$rw['vr_estampilla2']+$rw['vr_estampilla3']+$rw['vr_estampilla4']+$rw['vr_estampilla5']+$rw['total_pagado'];
			echo "<tr>
			<td bgcolor='#FFCC00'>$rw[id_manu_ceva]</td>
			<td bgcolor='#FFCC00'>$pagado</td>
			<td bgcolor='#FFCC00'>$rw[ccnit]</td>
			<td bgcolor='#FFCC00'>$rw[tercero]</td>
			<td bgcolor='#FFCC00'>&nbsp; </td>
			<td bgcolor='#FFCC00'> &nbsp;</td>
			<td bgcolor='#FFCC00'>0</td>
			<td  bgcolor='#CCCCCC'>$rw2[pago]</td>
			<td  bgcolor='#CCCCCC'>$rw[fecha_ceva]</td>
			<td  bgcolor='#CCCCCC'>$rw2[id_manu_crpp] $rw[des_ceva]</td>
			<td  bgcolor='#CCCCCC'>$rw2[vr_digitado] </td>
			<td  bgcolor='#CCCCCC' class='text'>$rw2[cuenta] </td>
			<td  bgcolor='#CCCCCC'>$rw3[nom_rubro] </td>
		</tr>";
		$i++;
		$pagado=0;
		}
	}
echo "</table>";
//******************** cierro concexion con la base
$cx = null;
?>
