<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
?>
	<html>
	<style type="text/css">
		.Estilo1 {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;

		}

		.Estilo2 {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
		}

		.Estilo3 {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 12px;
			font-weight: bold;
		}

		a:link {
			color: #666666;
			text-decoration: none;
		}

		a:visited {
			color: #666666;
			text-decoration: none;
		}

		a:hover {
			color: #666666;
			text-decoration: underline;
		}

		a:active {
			color: #666666;
			text-decoration: none;
		}
	</style>
	<title>CONTAFACIL</title>

	<body>
		<?php
		include('../config.php');

		$id_obcg = $_GET['id'];
		$vr_obcg = $_GET['val'];

		$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$sqlxx = "select * from fecha";
		$resultadoxx = $connectionxx->query($sqlxx);

		while ($rowxx = $resultadoxx->fetch_assoc()) {
			$id_emp = $rowxx["id_emp"];
		}

		$sqlxxqw = "select * from fecha_ini_op";
		$resultadoxxqw = $connectionxx->query($sqlxxqw);

		while ($rowxxqw = $resultadoxxqw->fetch_assoc()) {
			$fecha_ini_op = $rowxxqw["fecha_ini_op"];
		}

		$link = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");


		$result = $link->query("SELECT * FROM car_ppto_gas where id_emp ='$id_emp' and tip_dato = 'D' and ano = '" . $fecha_ini_op . "'");
		$tot_ctas_d = $result->num_rows;
		printf("<br><br><center class ='Estilo1'>Total Cuentas Detalle encontradas y Creadas en la Fecha de Inicio de Operaciones " . $fecha_ini_op . " = %s <br><br></center>", $tot_ctas_d);

		$result2 = $link->query("SELECT * FROM car_ppto_gas where id_emp ='$id_emp' and tip_dato = 'D' and pac ='SI' and ano = '$fecha_ini_op'");
		$tot_ctas_d_pac = $result2->num_rows;
		printf("<center class ='Estilo1'>Total Cuentas Detalle -  Creadas en la Fecha de Inicio de Operaciones con P.A.C elaborado = %s</center>", $tot_ctas_d_pac);

		if ($tot_ctas_d != $tot_ctas_d_pac) {
			printf("<br><br><br><center class ='Estilo1'>NO PUEDE REALIZAR PAGOS HASTA TANTO <BR><b>TODAS</b> LAS CUENTAS DEL PRESUPUESTO INICIAL DE GASTOS TENGAN P.A.C ELABORADO</center><br><br><br>");
		} else {

			$sqlxxa1a = "select * from obcg where id_emp ='$id_emp' and id_auto_obcg = '$id_obcg'";
			$resultadoxxa1a = $connectionxx->query($sqlxxa1a);

			while ($rowxxa1a = $resultadoxxa1a->fetch_assoc()) {
				$id_cobp = $rowxxa1a["id_auto_cobp"];
			}

			$sqlxxa1 = "select * from cobp where id_emp ='$id_emp' and id_auto_cobp = '$id_cobp'";
			$resultadoxxa1 = $connectionxx->query($sqlxxa1);

			while ($rowxxa1 = $resultadoxxa1->fetch_assoc()) {
				$cuenta = $rowxxa1["cuenta"];
				$vr_digitado = $rowxxa1["vr_digitado"];
			}
			$ano='';
			$ano2 = substr($ano, 0, 8);

			$sqlxxa2 = "select * from pac_gastos where id_emp ='$id_emp' and cod_pptal = '$cuenta' and fecha_reg like '" . $ano2 . "%'";
			$resultadoxxa2 = $connectionxx->query($sqlxxa2);

			while ($rowxxa2 = $resultadoxxa2->fetch_assoc()) {
				$sal_pac_ene = $rowxxa2["sal_pac_ene"];
				$sal_pac_feb = $rowxxa2["sal_pac_feb"];
				$sal_pac_mar = $rowxxa2["sal_pac_mar"];
				$sal_pac_abr = $rowxxa2["sal_pac_abr"];
				$sal_pac_may = $rowxxa2["sal_pac_may"];
				$sal_pac_jun = $rowxxa2["sal_pac_jun"];
				$sal_pac_jul = $rowxxa2["sal_pac_jul"];
				$sal_pac_ago = $rowxxa2["sal_pac_ago"];
				$sal_pac_sep = $rowxxa2["sal_pac_sep"];
				$sal_pac_oct = $rowxxa2["sal_pac_oct"];
				$sal_pac_nov = $rowxxa2["sal_pac_nov"];
				$sal_pac_dic = $rowxxa2["sal_pac_dic"];
			}

			/*if (($sal_pac_ene < $vr_obcg) and ($sal_pac_feb < $vr_obcg) and ($sal_pac_mar < $vr_obcg) and ($sal_pac_abr < $vr_obcg) and ($sal_pac_may < $vr_obcg) and ($sal_pac_jun < $vr_obcg) and ($sal_pac_jul < $vr_obcg) and ($sal_pac_ago < $vr_obcg) and ($sal_pac_sep < $vr_obcg) and ($sal_pac_oct < $vr_obcg) and ($sal_pac_nov < $vr_obcg) and ($sal_pac_dic < $vr_obcg))
		{
		
		 $dife=$vr_obcg - $sal_pac_ene;
		
  		printf("<br><br><br><center class ='Estilo2'>NO PUEDE REALIZAR PAGOS HASTA TANTO ACTUALICE EL P.A.C DE CADA CUENTA Y/O
          <BR><BR><b>ADICIONE AL P.A.C</b> DE LA CUENTA ".$cuenta." <BR><BR>
		  EL VALOR DE $".$dife."= <br><br><br></center>");*/

		?>
			<!--<br><center><a href="../ppto_gastos/adi_red_pac_ing.php" target="_parent" class="Estilo2"><strong>...::: HACER ADICION AL P.A.C :::...</strong></a></center><BR>
--><?php
			/*}
		else
		{*/

	?>
			<form method="POST" action="p_pago_obcg.php">
				<div align="center"><br>
					<input type="hidden" name="id_obcg" value="<?php printf("%s", $id_obcg); ?>"><br>

					...:::
					<input name="Submit" type="submit" class="Estilo2" value="CONTINUAR PAGO">
					:::...
					<br>
					<br>

				</div>
			</form>

		<?php
			//}
		}
		?>

		<div align="center">
			<?php
			printf("

<center class='Estilo9'>
<form method='post' action='pagos_tesoreria.php'>
<input type='hidden' name='nn' value='CEVA'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo2' /> :::...
</form>
</center>
");

			?>
		</div>
	</body>

	</html>
<?php
}
?>