<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
	// Recibo variables que llegan del cliente
	$codigo_pptal =$_REQUEST['cuenta'];
	$id =$_REQUEST['id'];
	
	include('../../config.php');		
	$cx = $cx->query($sq)or die ("Conexion no Exitosa");
	//Obtengo el valor definitivo del coidgo presupuestal seleccionado por el usuario
				$query3 = "SELECT ppto_aprob FROM car_ppto_gas where cod_pptal ='$codigo_pptal'"; 
				$resp3 = mysql_db_query($database,$query3,$cx);
				$row3 = mysql_fetch_array($resp3);
				$inicial_gasto = $row3[ppto_aprob];
				
				$query4 = "SELECT SUM(valor_adi) as total4 FROM adi_ppto_gas where cod_pptal ='$codigo_pptal'"; 
				$resp4 = mysql_db_query($database,$query4,$cx);
				$row4 = mysql_fetch_array($resp4);
				$adicion_gas = $row4[total4];
				
				$query5 = "SELECT SUM(valor_adi) as total5 FROM red_ppto_gas where cod_pptal ='$codigo_pptal'"; 
				$resp5 = mysql_db_query($database,$query5,$cx);
				$row5 = mysql_fetch_array($resp5);
				$reduccion_gas = $row5[total5];
				
				$query6 = "SELECT SUM(valor_adi) as total6 FROM creditos where cod_pptal ='$codigo_pptal'"; 
				$resp6 = mysql_db_query($database,$query6,$cx);
				$row6 = mysql_fetch_array($resp6);
				$creditos = $row6[total6];
				
				$queryx = "SELECT SUM(valor_adi) as total FROM contracreditos where cod_pptal ='$codigo_pptal'"; 
				$respx = mysql_db_query($database,$queryx,$cx);
				$rowx = mysql_fetch_array($respx);
				$contracreditos = $rowx[total];
				// Variable con el valor definitivo
				$def_gastos = $inicial_gasto + $adicion_gas - $reduccion_gas + $creditos  - $contracreditos;
	
	// Calculo el valor comprometido que tiene la cuenta
				$val = mysql_query("select sum(vr_obligado) as comp from cdpp where cuenta ='$codigo_pptal'", $cx);
				while ($row5 = mysql_fetch_array($val))
				{ 
					$ppto_comp = $row5["comp"];
				}
				$val2 = mysql_query("select sum(valor_aplazado) as aplazodo from aplazamientos where cod_pptal ='$codigo_pptal' and fecha_adi <='$fecha_corte'", $cx);
				while ($row6 = mysql_fetch_array($val2))
				{ 
				$ppto_aplaza = $row6["aplazodo"];
				}
				// Variable con valor comprometido
				$comporometido = $ppto_comp + $ppto_aplaza;
		
	// Obtengo el valor del registro actual seleccionado, consulto con la cuenta seleccionada por el usuario y el id del registro actual, si el usuario cambia la cuenta original la consulta devolvera cero.
	
				$sql2 = "select valor_adi from red_ppto_gas where cod_pptal ='$codigo_pptal' and id ='$id'";
				$res7 = mysql_db_query($database,$sql2,$cx);	
				$row7 = mysql_fetch_array($res7);
				$valor_mod = $row7['valor_adi'];
				
	// Devulvo valores calculados al cliente
				$saldo = $def_gastos - $comporometido;
				
				echo $def_gastos .",".$comporometido.",".$saldo.",".($valor_mod + $saldo);
?>
