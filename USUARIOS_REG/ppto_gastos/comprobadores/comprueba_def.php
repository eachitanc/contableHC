<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
	
	$codigo_pptal =$_REQUEST['cod'];
	
	include('../../config.php');		
	$cx = $cx->query($sq)or die ("Conexion no Exitosa");
	/* 
	
	$val = mysql_query("select definitivo from car_ppto_gas where cod_pptal ='$codigo_pptal'", $cx);
	while ($row = mysql_fetch_array($val))
	{ 
	$ppto_aprob = $row["definitivo"];
	$valor_aprob3=number_format($ppto_aprob,2,",",".");
	echo "$ppto_aprob";
	}*/
	
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
				
				$def_gastos = $inicial_gasto + $adicion_gas - $reduccion_gas + $creditos  - $contracreditos;
				echo "$def_gastos";
		
?>
