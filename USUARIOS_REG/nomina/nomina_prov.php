<?php
include('../config.php');
$cx =mysql_connect($server,$dbuser,$dbpass) or die ("Fallo en la Conexion a la Base de Datos");

// Funciones de liquidacion de nomina
$fecha= '2018/07/31';
$detalle='PROVISION BENEFICIOS EMPLEADOS MES DE JULIO DE 2018';
$doc = 'NCON20180123';
// Datos de la tabla
echo "<table>
		<tr>
			<td>Fecha</td>
			<td>Doc</td>
			<td>Cuenta</td>
			<td>Detalle</td>
			<td>Tercero</td>
			<td>CC</td>
			<td>Debito</td>
			<td>Credito</td>
			<td>Cheque</td>
		</tr>";
$sql="select * from nomina_empleados";
$re = mysql_query($sql,$cx);
while ($rw =mysql_fetch_array($re))
{
	$aux_tra =0;
	// Terceros
	$sq2="select * from terceros_naturales where id = $rw[id_emp]";
	$re2=mysql_query($sq2,$cx);
	$rw2=mysql_fetch_array($re2);
	//	Plan de cargos
	$sq3="select * from nomina_plan where id = $rw[id_cargo]";
	$re3=mysql_query($sq3,$cx);
	$rw3=mysql_fetch_array($re3);
	// Gastos de prepresentacion
	$gastos_rep = $rw3['sueldo'] * ($rw3['gastos_rep']/100);
	// Salario minimo para calculos
	$sq4="select * from nomina_salariomin where anno = '2018'";
	$re4=mysql_query($sq4,$cx);
	$rw4=mysql_fetch_array($re4);
	// para calculo de subsidios
	$base = $rw3['sueldo'];
	$salario = $rw4['salario'] *2 ;
	if($base <= $salario)
	{
		$aux_alimenta = $rw4['aux_alimenta'];	
	}else{
		$aux_alimenta =0;
		}
	// Para auxilio de tranporte
	if($base <= $salario && $rw['aux_trans'] != 'NO')
	{
		$aux_tra = $rw4['aux_trans'];	
	}else{
		$aux_alimenta =0;
		}
	// Total devengado
	$devengado = $rw3[sueldo] + $gastos_rep +$aux_tra+$aux_alimenta;
	//********************************************************************************//
	// Liquidacion de prestaciones sociales
	if (($rw3[sueldo] + $gastos_rep)<= $rw4['bonifica'])
		{
			$bonifica = (($rw3[sueldo] + $gastos_rep) *0.5)/12;	
		}else{
			$bonifica = (($rw3[sueldo] + $gastos_rep) *0.35)/12;		
		}
	// bonificacion por prestacion de servicios
	$sq5 ="select * from nomina_beneficios where emp ='$rw[id]' and beneficio =1";
	$re5 =mysql_query($sq5,$cx);
	$rw5 =mysql_fetch_array($re5);
	echo "<tr>
			<td>$fecha</td>
			<td>$doc</td>
			<td>$rw5[debito]</td>
			<td>$detalle</td>
			<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
			<td>$rw2[num_id]</td>
			<td>$bonifica</td>
			<td>0</td>
			<td></td>
		</tr>";
	echo "<tr>
			<td>$fecha</td>
			<td>$doc</td>
			<td>$rw5[credito]</td>
			<td>$detalle</td>
			<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
			<td>$rw2[num_id]</td>
			<td>0</td>
			<td>$bonifica</td>
			<td></td>
		</tr>";	
		
		// Prima de servicios
		$prima_ser = (($rw3['sueldo'] + $aux_tra + $aux_alimenta)/2)/12;
		$sq6 ="select * from nomina_beneficios where emp ='$rw[id]' and beneficio =2";
		$re6 =mysql_query($sq6,$cx);
		$rw6 =mysql_fetch_array($re6);
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw6[debito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>$prima_ser</td>
				<td>0</td>
				<td></td>
			</tr>";
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw6[credito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>0</td>
				<td>$prima_ser</td>
				<td></td>
			</tr>";	
		// Prima de vacaciones
		$prima_vac =((($rw3['sueldo'] + $aux_tra + $aux_alimenta+$gastos_rep + ($bonifica) +($prima_ser))*15)/30)/12;
		$sq7 ="select * from nomina_beneficios where emp ='$rw[id]' and beneficio =3";
		$re7 =mysql_query($sq7,$cx);
		$rw7 =mysql_fetch_array($re7);
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw7[debito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>$prima_vac</td>
				<td>0</td>
				<td></td>
			</tr>";
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw7[credito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>0</td>
				<td>$prima_vac</td>
				<td></td>
			</tr>";	
		// Liquidacion de vacaciones
		$vacaciones =((($rw3['sueldo'] + $aux_tra + $aux_alimenta+$gastos_rep + ($bonifica) +($prima_ser))*22)/30)/12;
		$sq8 ="select * from nomina_beneficios where emp ='$rw[id]' and beneficio =4";
		$re8 =mysql_query($sq8,$cx);
		$rw8 =mysql_fetch_array($re8);
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw8[debito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>$vacaciones</td>
				<td>0</td>
				<td></td>
			</tr>";
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw8[credito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>0</td>
				<td>$vacaciones</td>
				<td></td>
			</tr>";	
		// Liquidacion de navidad
		$prima_navidad =($rw3['sueldo'] + $aux_tra + $aux_alimenta+$gastos_rep + ($bonifica) +($prima_ser)+($prima_vac))/12;
		$sq9 ="select * from nomina_beneficios where emp ='$rw[id]' and beneficio =5";
		$re9 =mysql_query($sq9,$cx);
		$rw9 =mysql_fetch_array($re9);
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw9[debito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>$prima_navidad</td>
				<td>0</td>
				<td></td>
			</tr>";
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw9[credito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>0</td>
				<td>$prima_navidad</td>
				<td></td>
			</tr>";	
		// Bonificacion de recreacion
		$bonifica_rec = ($rw3[sueldo] / 30)/12;
		$sq10 ="select * from nomina_beneficios where emp ='$rw[id]' and beneficio =6";
		$re10 =mysql_query($sq10,$cx);
		$rw10=mysql_fetch_array($re10);
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw10[debito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>$bonifica_rec</td>
				<td>0</td>
				<td></td>
			</tr>";
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw10[credito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>0</td>
				<td>$bonifica_rec</td>
				<td></td>
			</tr>";	
		// Cesantias
		$cesantias =($rw3['sueldo'] + $aux_tra + $aux_alimenta+$gastos_rep + ($bonifica) +($prima_ser)+($prima_vac)+($prima_navidad))/12;
		$sq11 ="select * from nomina_beneficios where emp ='$rw[id]' and beneficio =7";
		$re11 =mysql_query($sq11,$cx);
		$rw11=mysql_fetch_array($re11);
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw11[debito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>$cesantias</td>
				<td>0</td>
				<td></td>
			</tr>";
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw11[credito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>0</td>
				<td>$cesantias</td>
				<td></td>
			</tr>";	
		// Intereses Cesantias
		$int_cesantias =($cesantias * 0.12);
		$sq12 ="select * from nomina_beneficios where emp ='$rw[id]' and beneficio =8";
		$re12 =mysql_query($sq12,$cx);
		$rw12=mysql_fetch_array($re12);
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw12[debito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>$int_cesantias</td>
				<td>0</td>
				<td></td>
			</tr>";
		echo "<tr>
				<td>$fecha</td>
				<td>$doc</td>
				<td>$rw12[credito]</td>
				<td>$detalle</td>
				<td>$rw2[pri_ape] $rw2[seg_ape] $rw2[pri_nom] $rw2[seg_nom]</td>
				<td>$rw2[num_id]</td>
				<td>0</td>
				<td>$int_cesantias</td>
				<td></td>
			</tr>";	
		// Pension
		$pension = ($rw3[sueldo] + $gastos_rep)*0.12;
		$salud = ($rw3[sueldo] + $gastos_rep)*0.085;
		
}
echo "</table>";