<?
// Resivo las variables de la funcion ajax
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$fecha_cor = $_REQUEST['fecha'];
// Consulto ingresos
				include('../config.php');				
				$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
				$query = "SELECT SUM(ppto_aprob) as total FROM car_ppto_ing where tip_dato='D'"; 
				$resp = mysql_db_query($database,$query,$cx);
				$row = mysql_fetch_array($resp);
				$inicial_ing = $row[total];
				$query1 = "SELECT SUM(valor_adi) as total1 FROM adi_ppto_ing where fecha_adi <='$fecha_cor'"; 
				$resp1 = mysql_db_query($database,$query1,$cx);
				$row1 = mysql_fetch_array($resp1);
				$adicion_ing = $row1[total1];
				$query2 = "SELECT SUM(valor_adi) as total2 FROM red_ppto_ing where fecha_adi <='$fecha_cor'"; 
				$resp2 = mysql_db_query($database,$query2,$cx);
				$row2 = mysql_fetch_array($resp2);
				$reduccion_ing = $row2[total2];  
				$query6 = "SELECT SUM(valor_adi) as total6 FROM creditos_ing where fecha_adi <='$fecha_cor'"; 
				$resp6 = mysql_db_query($database,$query6,$cx);
				$row6 = mysql_fetch_array($resp6);
				$creditos = $row6[total6];
				$queryx = "SELECT SUM(valor_adi) as total FROM contracreditos_ing where fecha_adi <='$fecha_cor'"; 
				$respx = mysql_db_query($database,$queryx,$cx);
				$rowx = mysql_fetch_array($respx);
				$contracreditos = $rowx[total];
				$def_ingresos = $inicial_ing + $adicion_ing - $reduccion_ing + $creditos - $contracreditos;
		// consulta gastos
				$query3 = "SELECT SUM(ppto_aprob) as total FROM car_ppto_gas where tip_dato='D'"; 
				$resp3 = mysql_db_query($database,$query3,$cx);
				$row3 = mysql_fetch_array($resp3);
				$inicial_gasto = $row3[total];
				$query4 = "SELECT SUM(valor_adi) as total4 FROM adi_ppto_gas where fecha_adi <='$fecha_cor'"; 
				$resp4 = mysql_db_query($database,$query4,$cx);
				$row4 = mysql_fetch_array($resp4);
				$adicion_gas = $row4[total4];
				$query5 = "SELECT SUM(valor_adi) as total5 FROM red_ppto_gas where fecha_adi <='$fecha_cor'"; 
				$resp5 = mysql_db_query($database,$query5,$cx);
				$row5 = mysql_fetch_array($resp5);
				$reduccion_gas = $row5[total5];
				$query6 = "SELECT SUM(valor_adi) as total6 FROM creditos where fecha_adi <='$fecha_cor'"; 
				$resp6 = mysql_db_query($database,$query6,$cx);
				$row6 = mysql_fetch_array($resp6);
				$creditos = $row6[total6];
				$queryx = "SELECT SUM(valor_adi) as total FROM contracreditos where fecha_adi <='$fecha_cor'"; 
				$respx = mysql_db_query($database,$queryx,$cx);
				$rowx = mysql_fetch_array($respx);
				$contracreditos = $rowx[total];
				$def_gastos = $inicial_gasto + $adicion_gas - $reduccion_gas + $creditos  - $contracreditos;
				$difer = $def_ingresos - $def_gastos;
				echo $difer;
?>