<?php
session_start();
if (!$_SESSION["login"]) {
	header("Location: ../login.php");
	exit;
} else {
?>
	<style type="text/css">
		a {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 11px;
			color: #666666;
		}

		a:link {
			text-decoration: none;
		}

		a:visited {
			text-decoration: none;
			color: #666666;
		}

		a:hover {
			text-decoration: underline;
			color: #666666;
		}

		a:active {
			text-decoration: none;
			color: #666666;
		}

		.Estilo9 {
			font-size: 10px;
			font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		}
	</style>
	<?php

	include('../config.php');
	// conexion				
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	// id_emp
	$sqlxx = "select * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);
	$tipa = $tipb = $tipc = $tipd = $tipe = $tipf = $tipg = $tiph = $tipi = $tipj = $tipk = $tipl = $tipm = $tipn = $tipo = '';
	$ter_jur = '';
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$id_emp = $rowxx["id_emp"];
		$idxx = $rowxx["id_emp"];
		$ano = $rowxx["ano"];
	}
	//********** primera llegada para validacion
	$fecha_cecp = $_POST['fecha_cecpp'];
	$id_auto = isset($_POST['id_cp']) ? $_POST['id_cp'] : '';
	$id_manu_cecp = $_POST['id_manu_cecp'];
	$nt = isset($_POST['nombre_tercero']) ? $_POST['nombre_tercero'] : '';
	$rt = isset($_POST['regimen_tercero']) ? $_POST['regimen_tercero'] : '';
	$cn = isset($_POST['ccnit']) ? $_POST['ccnit'] : '';
	$concepto_pago = $_POST['concepto_pago'];
	$cuenta_cxp = isset($_POST['cuenta_cxp']) ? $_POST['cuenta_cxp'] : '';
	$iva = $_POST['iva'];
	//$vr_tot_obli_con_iva = $_POST['vr_tot_obli_con_iva']; 
	//$saldo_vr_tot_obli_con_iva = $_POST['saldo_vr_tot_obli_con_iva']; 
	$vr_obli_para_pago_mas_iva = $_POST['vr_obli_para_pago_mas_iva'];
	$forma_pago = $_POST['forma_pago'];
	$total_pagado = $_POST['total_pagado'];
	$pgcp1 = isset($_POST['pgcp1']) ? $_POST['pgcp1'] : 0; //echo $pgcp1;
	$pgcp2 = isset($_POST['pgcp2']) ? $_POST['pgcp2'] : 0;
	$pgcp3 = isset($_POST['pgcp3']) ? $_POST['pgcp3'] : 0;
	$pgcp4 = isset($_POST['pgcp4']) ? $_POST['pgcp4'] : 0;
	$pgcp5 = isset($_POST['pgcp5']) ? $_POST['pgcp5'] : 0;
	$pgcp6 = isset($_POST['pgcp6']) ? $_POST['pgcp6'] : 0;
	$pgcp7 = isset($_POST['pgcp7']) ? $_POST['pgcp7'] : 0;
	$pgcp8 = isset($_POST['pgcp8']) ? $_POST['pgcp8'] : 0;
	$pgcp9 = isset($_POST['pgcp9']) ? $_POST['pgcp9'] : 0;
	$pgcp10 = isset($_POST['pgcp10']) ? $_POST['pgcp10'] : 0;
	$pgcp11 = isset($_POST['pgcp11']) ? $_POST['pgcp11'] : 0;
	$pgcp12 = isset($_POST['pgcp12']) ? $_POST['pgcp12'] : 0;
	$pgcp13 = isset($_POST['pgcp13']) ? $_POST['pgcp13'] : 0;
	$pgcp14 = isset($_POST['pgcp14']) ? $_POST['pgcp14'] : 0;
	$pgcp15 = isset($_POST['pgcp15']) ? $_POST['pgcp15'] : 0;
	$des1 = isset($_POST['des1']) ? $_POST['des1'] : 0;
	$des2 = isset($_POST['des2']) ? $_POST['des2'] : 0;
	$des3 = isset($_POST['des3']) ? $_POST['des3'] : 0;
	$des4 = isset($_POST['des4']) ? $_POST['des4'] : 0;
	$des5 = isset($_POST['des5']) ? $_POST['des5'] : 0;
	$des6 = isset($_POST['des6']) ? $_POST['des6'] : 0;
	$des7 = isset($_POST['des7']) ? $_POST['des7'] : 0;
	$des8 = isset($_POST['des8']) ? $_POST['des8'] : 0;
	$des9 = isset($_POST['des9']) ? $_POST['des9'] : 0;
	$des10 = isset($_POST['des10']) ? $_POST['des10'] : 0;
	$des11 = isset($_POST['des11']) ? $_POST['des11'] : 0;
	$des12 = isset($_POST['des12']) ? $_POST['des12'] : 0;
	$des13 = isset($_POST['des13']) ? $_POST['des13'] : 0;
	$des14 = isset($_POST['des14']) ? $_POST['des14'] : 0;
	$des15 = isset($_POST['des15']) ? $_POST['des15'] : 0;
	$vr_deb_1 = isset($_POST['vr_deb_1']) ? $_POST['vr_deb_1'] : 0; //echo $vr_deb_1;
	$vr_deb_2 = isset($_POST['vr_deb_2']) ? $_POST['vr_deb_2'] : 0; //echo $vr_deb_3;
	$vr_deb_3 = isset($_POST['vr_deb_3']) ? $_POST['vr_deb_3'] : 0;
	$vr_deb_4 = isset($_POST['vr_deb_4']) ? $_POST['vr_deb_4'] : 0;
	$vr_deb_5 = isset($_POST['vr_deb_5']) ? $_POST['vr_deb_5'] : 0;
	$vr_deb_6 = isset($_POST['vr_deb_6']) ? $_POST['vr_deb_6'] : 0;
	$vr_deb_7 = isset($_POST['vr_deb_7']) ? $_POST['vr_deb_7'] : 0;
	$vr_deb_8 = isset($_POST['vr_deb_8']) ? $_POST['vr_deb_8'] : 0;
	$vr_deb_9 = isset($_POST['vr_deb_9']) ? $_POST['vr_deb_9'] : 0;
	$vr_deb_10 = isset($_POST['vr_deb_10']) ? $_POST['vr_deb_10'] : 0;
	$vr_deb_11 = isset($_POST['vr_deb_11']) ? $_POST['vr_deb_11'] : 0;
	$vr_deb_12 = isset($_POST['vr_deb_12']) ? $_POST['vr_deb_12'] : 0;
	$vr_deb_13 = isset($_POST['vr_deb_13']) ? $_POST['vr_deb_13'] : 0;
	$vr_deb_14 = isset($_POST['vr_deb_14']) ? $_POST['vr_deb_14'] : 0;
	$vr_deb_15 = isset($_POST['vr_deb_15']) ? $_POST['vr_deb_15'] : 0;
	$vr_cre_1 = isset($_POST['vr_cre_1']) ? $_POST['vr_cre_1'] : 0; //echo $vr_cre_1;
	$vr_cre_2 = isset($_POST['vr_cre_2']) ? $_POST['vr_cre_2'] : 0; //echo $vr_cre_2;
	$vr_cre_3 = isset($_POST['vr_cre_3']) ? $_POST['vr_cre_3'] : 0;
	$vr_cre_4 = isset($_POST['vr_cre_4']) ? $_POST['vr_cre_4'] : 0;
	$vr_cre_5 = isset($_POST['vr_cre_5']) ? $_POST['vr_cre_5'] : 0;
	$vr_cre_6 = isset($_POST['vr_cre_6']) ? $_POST['vr_cre_6'] : 0;
	$vr_cre_7 = isset($_POST['vr_cre_7']) ? $_POST['vr_cre_7'] : 0;
	$vr_cre_8 = isset($_POST['vr_cre_8']) ? $_POST['vr_cre_8'] : 0;
	$vr_cre_9 = isset($_POST['vr_cre_9']) ? $_POST['vr_cre_9'] : 0;
	$vr_cre_10 = isset($_POST['vr_cre_10']) ? $_POST['vr_cre_10'] : 0;
	$vr_cre_11 = isset($_POST['vr_cre_11']) ? $_POST['vr_cre_11'] : 0;
	$vr_cre_12 = isset($_POST['vr_cre_12']) ? $_POST['vr_cre_12'] : 0;
	$vr_cre_13 = isset($_POST['vr_cre_13']) ? $_POST['vr_cre_13'] : 0;
	$vr_cre_14 = isset($_POST['vr_cre_14']) ? $_POST['vr_cre_14'] : 0;
	$vr_cre_15 = isset($_POST['vr_cre_15']) ? $_POST['vr_cre_15'] : 0;

	$tot_deb = $vr_deb_1 + $vr_deb_2 + $vr_deb_3 + $vr_deb_4 + $vr_deb_5 + $vr_deb_6 + $vr_deb_7 + $vr_deb_8 + $vr_deb_9 + $vr_deb_10 + $vr_deb_11 + $vr_deb_12 + $vr_deb_13 + $vr_deb_14 + $vr_deb_15;
	$tot_cre = $vr_cre_1 + $vr_cre_2 + $vr_cre_3 + $vr_cre_4 + $vr_cre_5 + $vr_cre_6 + $vr_cre_7 + $vr_cre_8 + $vr_cre_9 + $vr_cre_10 + $vr_cre_11 + $vr_cre_12 + $vr_cre_13 + $vr_cre_14 + $vr_cre_15;

	$tot_deb_a = number_format($tot_deb, 2, ',', '.');
	$tot_cre_a = number_format($tot_cre, 2, ',', '.');

	// vigencia fiscal

	$consultax = $connectionxx->query("select * from vf ");
	while ($rowx = $consultax->fetch_assoc()) {
		$ax = $rowx["fecha_ini"];
		$bx = $rowx["fecha_fin"];
	}
	// tipo de dato de los pgcp
	// consulta tipo_dato de pgcp
	$sqla = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp1'";
	$resultadoa = $connectionxx->query($sqla);;
	while ($rowa = $resultadoa->fetch_assoc()) {
		$tipa = $rowa["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlb = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp2'";
	$resultadob = $connectionxx->query($sqlb);;
	while ($rowb = $resultadob->fetch_assoc()) {
		$tipb = $rowb["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlc = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp3'";
	$resultadoc = $connectionxx->query($sqlc);;
	while ($rowc = $resultadoc->fetch_assoc()) {
		$tipc = $rowc["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqld = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp4'";
	$resultadod = $connectionxx->query($sqld);
	while ($rowd = $resultadod->fetch_assoc()) {
		$tipd = $rowd["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqle = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp5'";
	$resultadoe = $connectionxx->query($sqle);
	while ($rowe = $resultadoe->fetch_assoc()) {
		$tipe = $rowe["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlf = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp6'";
	$resultadof = $connectionxx->query($sqlf);
	while ($rowf = $resultadof->fetch_assoc()) {
		$tipf = $rowf["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlg = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp7'";
	$resultadog = $connectionxx->query($sqlg);
	while ($rowg = $resultadog->fetch_assoc()) {
		$tipg = $rowg["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlh = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp8'";
	$resultadoh = $connectionxx->query($sqlh);
	while ($rowh = $resultadoh->fetch_assoc()) {
		$tiph = $rowh["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqli = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp9'";
	$resultadoi = $connectionxx->query($sqli);
	while ($rowi = $resultadoi->fetch_assoc()) {
		$tipi = $rowi["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlj = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp10'";
	$resultadoj = $connectionxx->query($sqlj);
	while ($rowj = $resultadoj->fetch_assoc()) {
		$tipj = $rowj["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlk = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp11'";
	$resultadok = $connectionxx->query($sqlk);
	while ($rowk = $resultadok->fetch_assoc()) {
		$tipk = $rowk["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqll = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp12'";
	$resultadol = $connectionxx->query($sqll);
	while ($rowl = $resultadol->fetch_assoc()) {
		$tipl = $rowl["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlm = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp13'";
	$resultadom = $connectionxx->query($sqlm);
	while ($rowm = $resultadom->fetch_assoc()) {
		$tipm = $rowm["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqln = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp14'";
	$resultadon = $connectionxx->query($sqln);
	while ($rown = $resultadon->fetch_assoc()) {
		$tipn = $rown["tip_dato"];
	}
	// consulta tipo_dato de pgcp
	$sqlo = "select * from pgcp where id_emp ='$id_emp' and cod_pptal ='$pgcp15'";
	$resultadoo = $connectionxx->query($sqlo);
	while ($rowo = $resultadoo->fetch_assoc()) {
		$tipo = $rowo["tip_dato"];
	}

	if ($fecha_cecp > $bx or $fecha_cecp < $ax) {

		// envio de datos para correccion



		printf("<center class='Estilo4'><b>NO</b> es posible guardar porque  la Fecha del CECP <b>NO </b> se encuentre dentro de la Vigencia Fiscal Actual<br><br> </center>");

		printf("
		
		
		
		<center class='Estilo4'>
<form method='post' action='pagos_tesoreria_cxp.php'>
<input type='hidden' name='nn' value='CECP'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>");

		///**********************
	} else {
		// grabacion

		$id_auto_cecp = 'CECP' . $_POST['id_auto_cecp']; //ok
		$id_manu_cecp = 'CECP' . $_POST['id_manu_cecp']; //ok
		$fecha_cecp = $_POST['fecha_cecpp'];
		$ter_nat = isset($_POST['ter_nat']) ? $_POST['ter_nat'] : '';
		$ter_jur = isset($_POST['ter_jur']) ? $_POST['ter_jur'] : '';
		if ($ter_nat) {
			$sql4 = "select * from terceros_naturales where id='$ter_nat' and id_emp='$id_emp' ";
			$resultado4 = $connectionxx->query($sql4);

			while ($row4 = $resultado4->fetch_assoc()) {
				$pri_ape = $row4["pri_ape"];
				$seg_ape = $row4["seg_ape"];
				$pri_nom = $row4["pri_nom"];
				$seg_nom = $row4["seg_nom"];
				$regimen = $row4["regimen"];
				$num_id = $row4["num_id"];
				$id = $row4["id"];
			}
			$nt = $pri_ape . " " . $seg_ape . " " . $pri_nom . " " . $seg_nom;
			$rt = $regimen;
			$cn = $num_id;
		}
		if ($ter_jur) {
			$sql5 = "select * from terceros_juridicos where id='$ter_jur' and id_emp='$id_emp' ";
			$resultado5 = $connectionxx->query($sql5);

			while ($row5 = $resultado5->fetch_assoc()) {
				$raz_soc = $row5["raz_soc2"];
				$regimen2 = $row5["regimen2"];
				$num_id2 = $row5["num_id2"];
				$id = $row5["id"];
			}
			$rt = $regimen2;
			$nt = $raz_soc;
			$cn = $num_id2;
		}
		$concepto_pago = $_POST['concepto_pago'];
		$salud = $_POST['salud'];
		$pension = $_POST['pension'];
		$libranza = $_POST['libranza'];
		$f_solidaridad = $_POST['f_solidaridad'];
		$f_empleados = $_POST['f_empleados'];
		$sindicato = $_POST['sindicato'];
		$embargo = $_POST['embargo'];
		$cruce = $_POST['cruce'];
		$otros = $_POST['otros'];
		$retefuente = $_POST['retefuente'];
		$vr_retefuente = $_POST['vr_retefuente'];
		$reteiva = $_POST['reteiva'];
		$vr_reteiva = $_POST['vr_reteiva'];
		$reteica = $_POST['reteica'];
		$a_partir_reteica = $_POST['a_partir_reteica'];
		$tarifa_reteica = $_POST['tarifa_reteica'];
		$vr_reteica = $_POST['vr_reteica'];
		$estampilla1 = $_POST['estampilla1'];
		$vr_estampilla1 = $_POST['vr_estampilla1'];
		$estampilla2 = $_POST['estampilla2'];
		$vr_estampilla2 = $_POST['vr_estampilla2'];
		$estampilla3 = $_POST['estampilla3'];
		$vr_estampilla3 = $_POST['vr_estampilla3'];
		$estampilla4 = $_POST['estampilla4'];
		$vr_estampilla4 = $_POST['vr_estampilla4'];
		$estampilla5 = $_POST['estampilla5'];
		$vr_estampilla5 = $_POST['vr_estampilla5'];


		$forma_pago = $_POST['forma_pago'];
		$concepto_dian = isset($_POST['codigo_dian']) ? $_POST['codigo_dian'] : '';
		$num_cheque = isset($_POST['num_cheque1']) ? $_POST['num_cheque1'] : ''; //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque = isset($_POST['banco_cheque1']) ? $_POST['banco_cheque1'] : ''; //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque = isset($_POST['cta_cheque1']) ? $_POST['cta_cheque1'] : ''; //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque2 = isset($_POST['num_cheque2']) ? $_POST['num_cheque2'] : '';  //printf("<br>num_cheque2 : %s <br>",$num_cheque2);
		$banco_cheque2 = isset($_POST['banco_cheque2']) ? $_POST['banco_cheque2'] : '';  //printf("<br>banco_cheque2 : %s <br>",$banco_cheque2);
		$cta_cheque2 = isset($_POST['cta_cheque2']) ? $_POST['cta_cheque2'] : '';  //printf("<br>cta_cheque2 : %s <br>",$cta_cheque2);

		$num_cheque3 = isset($_POST['num_cheque3']) ? $_POST['num_cheque3'] : '';  //printf("<br>num_cheque3 : %s <br>",$num_cheque3);
		$banco_cheque3 = isset($_POST['banco_cheque3']) ? $_POST['banco_cheque3'] : '';  //printf("<br>banco_cheque3 : %s <br>",$banco_cheque3);
		$cta_cheque3 = isset($_POST['cta_cheque3']) ? $_POST['cta_cheque3'] : '';  //printf("<br>cta_cheque3 : %s <br>",$cta_cheque3);

		$num_cheque4 = isset($_POST['num_cheque4']) ? $_POST['num_cheque4'] : '';  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque4 = isset($_POST['banco_cheque4']) ? $_POST['banco_cheque4'] : '';  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque4 = isset($_POST['cta_cheque4']) ? $_POST['cta_cheque4'] : '';  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque5 = isset($_POST['num_cheque5']) ? $_POST['num_cheque5'] : '';  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque5 = isset($_POST['banco_cheque5']) ? $_POST['banco_cheque5'] : '';  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque5 = isset($_POST['cta_cheque5']) ? $_POST['cta_cheque5'] : '';  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque6 = isset($_POST['num_cheque6']) ? $_POST['num_cheque6'] : '';  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque6 = isset($_POST['banco_cheque6']) ? $_POST['banco_cheque6'] : '';  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque6 = isset($_POST['cta_cheque6']) ? $_POST['cta_cheque6'] : '';  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque7 = isset($_POST['num_cheque7']) ? $_POST['num_cheque7'] : '';  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque7 = isset($_POST['banco_cheque7']) ? $_POST['banco_cheque7'] : '';  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque7 = isset($_POST['cta_cheque7']) ? $_POST['cta_cheque7'] : '';  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque8 = isset($_POST['num_cheque8']) ? $_POST['num_cheque8'] : 0;  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque8 = isset($_POST['banco_cheque8']) ? $_POST['banco_cheque8'] : 0;  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque8 = isset($_POST['cta_cheque8']) ? $_POST['cta_cheque8'] : 0;  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque9 = isset($_POST['num_cheque9']) ? $_POST['num_cheque9'] : 0;  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque9 = isset($_POST['banco_cheque9']) ? $_POST['banco_cheque9'] : 0;  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque9 = isset($_POST['cta_cheque9']) ? $_POST['cta_cheque9'] : 0;  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque10 = isset($_POST['num_cheque10']) ? $_POST['num_cheque10'] : 0;  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque10 = isset($_POST['banco_cheque10']) ? $_POST['banco_cheque10'] : 0;  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque10 = isset($_POST['cta_cheque10']) ? $_POST['cta_cheque10'] : 0;  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque11 = isset($_POST['num_cheque11']) ? $_POST['num_cheque11'] : 0;  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque11 = isset($_POST['banco_cheque11']) ? $_POST['banco_cheque11'] : 0;  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque11 = isset($_POST['cta_cheque11']) ? $_POST['cta_cheque11'] : 0;  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque12 = isset($_POST['num_cheque12']) ? $_POST['num_cheque12'] : 0;  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque12 = isset($_POST['banco_cheque12']) ? $_POST['banco_cheque12'] : 0;  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque12 = isset($_POST['cta_cheque12']) ? $_POST['cta_cheque12'] : 0;  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque13 = isset($_POST['num_cheque13']) ? $_POST['num_cheque13'] : 0;  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque13 = isset($_POST['banco_cheque13']) ? $_POST['banco_cheque13'] : 0;  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque13 = isset($_POST['cta_cheque13']) ? $_POST['cta_cheque13'] : 0;  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque14 = isset($_POST['num_cheque14']) ? $_POST['num_cheque14'] : 0;  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque14 = isset($_POST['banco_cheque14']) ? $_POST['banco_cheque14'] : 0;  //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque14 = isset($_POST['cta_cheque14']) ? $_POST['cta_cheque14'] : 0;  //printf("<br>cta_cheque : %s <br>",$cta_cheque);

		$num_cheque15 = isset($_POST['num_cheque15']) ? $_POST['num_cheque15'] : 0;  //printf("<br>num_cheque : %s <br>",$num_cheque);
		$banco_cheque15 = isset($_POST['banco_cheque15']) ? $_POST['banco_cheque15'] : 0; //printf("<br>banco_cheque : %s <br>",$banco_cheque);
		$cta_cheque15 = isset($_POST['cta_cheque15']) ? $_POST['cta_cheque15'] : 0;  //printf("<br>cta_cheque : %s <br>",$cta_cheque);


		$te = isset($_POST['te']) ? $_POST['te'] : 0;
		$total_pagado = isset($_POST['total_pagado']) ? $_POST['total_pagado'] : 0; //ok



		$pgcp1 = isset($_POST['pgcp1']) ? $_POST['pgcp1'] : 0;
		$pgcp2 = isset($_POST['pgcp2']) ? $_POST['pgcp2'] : 0;
		$pgcp3 = isset($_POST['pgcp3']) ? $_POST['pgcp3'] : 0;
		$pgcp4 = isset($_POST['pgcp4']) ? $_POST['pgcp4'] : 0;
		$pgcp5 = isset($_POST['pgcp5']) ? $_POST['pgcp5'] : 0;
		$pgcp6 = isset($_POST['pgcp6']) ? $_POST['pgcp6'] : 0;
		$pgcp7 = isset($_POST['pgcp7']) ? $_POST['pgcp7'] : 0;
		$pgcp8 = isset($_POST['pgcp8']) ? $_POST['pgcp8'] : 0;
		$pgcp9 = isset($_POST['pgcp9']) ? $_POST['pgcp9'] : 0;
		$pgcp10 = isset($_POST['pgcp10']) ? $_POST['pgcp10'] : 0;
		$pgcp11 = isset($_POST['pgcp11']) ? $_POST['pgcp11'] : 0;
		$pgcp12 = isset($_POST['pgcp12']) ? $_POST['pgcp12'] : 0;
		$pgcp13 = isset($_POST['pgcp13']) ? $_POST['pgcp13'] : 0;
		$pgcp14 = isset($_POST['pgcp14']) ? $_POST['pgcp14'] : 0;
		$pgcp15 = isset($_POST['pgcp15']) ? $_POST['pgcp15'] : 0;
		$des1 = isset($_POST['des1']) ? $_POST['des1'] : 0;
		$des2 = isset($_POST['des2']) ? $_POST['des2'] : 0;
		$des3 = isset($_POST['des3']) ? $_POST['des3'] : 0;
		$des4 = isset($_POST['des4']) ? $_POST['des4'] : 0;
		$des5 = isset($_POST['des5']) ? $_POST['des5'] : 0;
		$des6 = isset($_POST['des6']) ? $_POST['des6'] : 0;
		$des7 = isset($_POST['des7']) ? $_POST['des7'] : 0;
		$des8 = isset($_POST['des8']) ? $_POST['des8'] : 0;
		$des9 = isset($_POST['des9']) ? $_POST['des9'] : 0;
		$des10 = isset($_POST['des10']) ? $_POST['des10'] : 0;
		$des11 = isset($_POST['des11']) ? $_POST['des11'] : 0;
		$des12 = isset($_POST['des12']) ? $_POST['des12'] : 0;
		$des13 = isset($_POST['des13']) ? $_POST['des13'] : 0;
		$des14 = isset($_POST['des14']) ? $_POST['des14'] : 0;
		$des15 = isset($_POST['des15']) ? $_POST['des15'] : 0;
		$vr_deb_1 = isset($_POST['vr_deb_1']) ? $_POST['vr_deb_1'] : 0;
		$vr_deb_2 = isset($_POST['vr_deb_2']) ? $_POST['vr_deb_2'] : 0;
		$vr_deb_3 = isset($_POST['vr_deb_3']) ? $_POST['vr_deb_3'] : 0;
		$vr_deb_4 = isset($_POST['vr_deb_4']) ? $_POST['vr_deb_4'] : 0;
		$vr_deb_5 = isset($_POST['vr_deb_5']) ? $_POST['vr_deb_5'] : 0;
		$vr_deb_6 = isset($_POST['vr_deb_6']) ? $_POST['vr_deb_6'] : 0;
		$vr_deb_7 = isset($_POST['vr_deb_7']) ? $_POST['vr_deb_7'] : 0;
		$vr_deb_8 = isset($_POST['vr_deb_8']) ? $_POST['vr_deb_8'] : 0;
		$vr_deb_9 = isset($_POST['vr_deb_9']) ? $_POST['vr_deb_9'] : 0;
		$vr_deb_10 = isset($_POST['vr_deb_10']) ? $_POST['vr_deb_10'] : 0;
		$vr_deb_11 = isset($_POST['vr_deb_11']) ? $_POST['vr_deb_11'] : 0;
		$vr_deb_12 = isset($_POST['vr_deb_12']) ? $_POST['vr_deb_12'] : 0;
		$vr_deb_13 = isset($_POST['vr_deb_13']) ? $_POST['vr_deb_13'] : 0;
		$vr_deb_14 = isset($_POST['vr_deb_14']) ? $_POST['vr_deb_14'] : 0;
		$vr_deb_15 = isset($_POST['vr_deb_15']) ? $_POST['vr_deb_15'] : 0;
		$vr_cre_1 = isset($_POST['vr_cre_1']) ? ($_POST['vr_cre_1']) : 0;
		$vr_cre_2 = isset($_POST['vr_cre_2']) ? ($_POST['vr_cre_2']) : 0;
		$vr_cre_3 = isset($_POST['vr_cre_3']) ? ($_POST['vr_cre_3']) : 0;
		$vr_cre_4 = isset($_POST['vr_cre_4']) ? ($_POST['vr_cre_4']) : 0;
		$vr_cre_5 = isset($_POST['vr_cre_5']) ? ($_POST['vr_cre_5']) : 0;
		$vr_cre_6 = isset($_POST['vr_cre_6']) ? ($_POST['vr_cre_6']) : 0;
		$vr_cre_7 = isset($_POST['vr_cre_7']) ? ($_POST['vr_cre_7']) : 0;
		$vr_cre_8 = isset($_POST['vr_cre_8']) ? ($_POST['vr_cre_8']) : 0;
		$vr_cre_9 = isset($_POST['vr_cre_9']) ? ($_POST['vr_cre_9']) : 0;
		$vr_cre_10 = isset($_POST['vr_cre_10']) ? $_POST['vr_cre_10'] : 0;
		$vr_cre_11 = isset($_POST['vr_cre_11']) ? $_POST['vr_cre_11'] : 0;
		$vr_cre_12 = isset($_POST['vr_cre_12']) ? $_POST['vr_cre_12'] : 0;
		$vr_cre_13 = isset($_POST['vr_cre_13']) ? $_POST['vr_cre_13'] : 0;
		$vr_cre_14 = isset($_POST['vr_cre_14']) ? $_POST['vr_cre_14'] : 0;
		$vr_cre_15 = isset($_POST['vr_cre_15']) ? $_POST['vr_cre_15'] : 0;
		$tot_deb = $vr_deb_1 + $vr_deb_2 + $vr_deb_3 + $vr_deb_4 + $vr_deb_5 + $vr_deb_6 + $vr_deb_7 + $vr_deb_8 + $vr_deb_9 + $vr_deb_10 + $vr_deb_11 + $vr_deb_12 + $vr_deb_13 + $vr_deb_14 + $vr_deb_15;
		$tot_cre = $vr_cre_1 + $vr_cre_2 + $vr_cre_3 + $vr_cre_4 + $vr_cre_5 + $vr_cre_6 + $vr_cre_7 + $vr_cre_8 + $vr_cre_9 + $vr_cre_10 + $vr_cre_11 + $vr_cre_12 + $vr_cre_13 + $vr_cre_14 + $vr_cre_15;
		$tot_deb_a = number_format($tot_deb, 2, ',', '.');
		$tot_cre_a = number_format($tot_cre, 2, ',', '.');

		$sql = "INSERT INTO cecp ( 
									
id_emp, id_auto_cecp, id_manu_cecp, fecha_cecp, nt, rt, cn, concepto_pago, cuenta_cxp, iva,
vr_obli_para_pago_mas_iva,
salud, pension, libranza, f_solidaridad, f_empleados, sindicato, embargo, cruce, otros,
retefuente, vr_retefuente, reteiva, vr_reteiva, 
reteica, a_partir_reteica, tarifa_reteica, vr_reteica,
estampilla1, vr_estampilla1, estampilla2, vr_estampilla2, estampilla3, vr_estampilla3, estampilla4, vr_estampilla4, estampilla5, vr_estampilla5, 
forma_pago, concepto_dian, num_cheque, banco_cheque, cta_cheque, te, total_pagado, num_cheque2, banco_cheque2, cta_cheque2,num_cheque3, banco_cheque3, cta_cheque3,
num_cheque4, banco_cheque4, cta_cheque4,num_cheque5, banco_cheque5, cta_cheque5,num_cheque6, banco_cheque6, cta_cheque6,num_cheque7, banco_cheque7, cta_cheque7,
num_cheque8, banco_cheque8, cta_cheque8,num_cheque9, banco_cheque9, cta_cheque9,num_cheque10, banco_cheque10, cta_cheque10,num_cheque11, banco_cheque11, cta_cheque11,
num_cheque12, banco_cheque12, cta_cheque12,num_cheque13, banco_cheque13, cta_cheque13,num_cheque14, banco_cheque14, cta_cheque14,
num_cheque15, banco_cheque15, cta_cheque15,

pgcp1 , pgcp2 , pgcp3 , pgcp4 , pgcp5 , pgcp6 , pgcp7 , pgcp8 , pgcp9 , pgcp10 , pgcp11 , pgcp12 , pgcp13 , pgcp14 , pgcp15 , 
des1 , des2 , des3 , des4 , des5 , des6 , des7 , des8 , des9 , des10 , des11 , des12 , des13 , des14 , des15 , 
vr_deb_1 , vr_deb_2 , vr_deb_3 , vr_deb_4 , vr_deb_5 , vr_deb_6 , vr_deb_7 , vr_deb_8 , vr_deb_9 , 
vr_deb_10 , vr_deb_11 , vr_deb_12 , vr_deb_13 , vr_deb_14 , vr_deb_15 , 
vr_cre_1 , vr_cre_2 , vr_cre_3 , vr_cre_4 , vr_cre_5 , vr_cre_6 , vr_cre_7 , vr_cre_8 , vr_cre_9 , 
vr_cre_10 , vr_cre_11 , vr_cre_12 , vr_cre_13 , vr_cre_14 , vr_cre_15 , 
tot_deb, tot_cre


) VALUES ( 
			
'$id_emp', '$id_auto_cecp', '$id_manu_cecp', '$fecha_cecp', '$nt', '$rt', '$cn', '$concepto_pago', '$cuenta_cxp', '$iva',
'$vr_obli_para_pago_mas_iva',
'$salud', '$pension', '$libranza', '$f_solidaridad', '$f_empleados', '$sindicato', '$embargo', '$cruce', '$otros',
'$retefuente', '$vr_retefuente', '$reteiva', '$vr_reteiva', 
'$reteica', '$a_partir_reteica', '$tarifa_reteica', '$vr_reteica',
'$estampilla1', '$vr_estampilla1', '$estampilla2', '$vr_estampilla2', '$estampilla3', '$vr_estampilla3', '$estampilla4', '$vr_estampilla4',  '$estampilla5', '$vr_estampilla5', 
'$forma_pago', '$concepto_dian', '$num_cheque', '$banco_cheque', '$cta_cheque', '$te', '$total_pagado', 
'$num_cheque2', '$banco_cheque2', '$cta_cheque2','$num_cheque3', '$banco_cheque3', '$cta_cheque3',
'$num_cheque4', '$banco_cheque4', '$cta_cheque4','$num_cheque5', '$banco_cheque5', '$cta_cheque5','$num_cheque6', '$banco_cheque6', 
'$cta_cheque6','$num_cheque7', '$banco_cheque7', '$cta_cheque7',
'$num_cheque8', '$banco_cheque8', '$cta_cheque8','$num_cheque9', '$banco_cheque9', '$cta_cheque9','$num_cheque10', '$banco_cheque10', 
'$cta_cheque10','$num_cheque11', '$banco_cheque11', '$cta_cheque11',
'$num_cheque12', '$banco_cheque12', '$cta_cheque12','$num_cheque13', '$banco_cheque13', '$cta_cheque13','$num_cheque14', 
'$banco_cheque14', '$cta_cheque14',
'$num_cheque15', '$banco_cheque15', '$cta_cheque15',

'$pgcp1' , '$pgcp2' , '$pgcp3' , '$pgcp4' , '$pgcp5' , '$pgcp6' , '$pgcp7' , '$pgcp8' , '$pgcp9' , '$pgcp10' , '$pgcp11' , 
'$pgcp12' , '$pgcp13' , '$pgcp14' , '$pgcp15' , 
'$des1' , '$des2' , '$des3' , '$des4' , '$des5' , '$des6' , '$des7' , '$des8' , '$des9' , '$des10' , '$des11' , '$des12' , 
'$des13' , '$des14' , '$des15' , 
'$vr_deb_1' , '$vr_deb_2' , '$vr_deb_3' , '$vr_deb_4' , '$vr_deb_5' , '$vr_deb_6' , '$vr_deb_7' , '$vr_deb_8' , '$vr_deb_9' , 
'$vr_deb_10' , '$vr_deb_11' , '$vr_deb_12' , '$vr_deb_13' , '$vr_deb_14' , '$vr_deb_15' , 
'$vr_cre_1' , '$vr_cre_2' , '$vr_cre_3' , '$vr_cre_4', '$vr_cre_5' , '$vr_cre_6' , '$vr_cre_7' , '$vr_cre_8' , '$vr_cre_9' , 
'$vr_cre_10' , '$vr_cre_11' , '$vr_cre_12' , '$vr_cre_13' , '$vr_cre_14' , '$vr_cre_15' , 
'$tot_deb' , '$tot_cre'
)";


		$connectionxx->query($sql) or die(mysqli_error($connectionxx));

		$filas = isset($_POST["filas"]) ? $_POST["filas"] : 0;
		$i = 0;
		for ($i = 1; $i <= $filas; $i++) {
			$cuenta = $_POST['cuenta_cxp' . $i];
			$valor = $_POST['valor_pto' . $i];
			$sql2 = "INSERT INTO cecp_cuenta (fecha_cecp,id_auto_cecp,id_manu_cecp,cuenta,valor) VALUES ('$fecha_cecp','$id_auto_cecp', '$id_manu_cecp','$cuenta','$valor')";
			$connectionxx->query($sql2) or die(mysqli_error($connectionxx));
		}







		printf("<center class='Estilo9'><br><br>REGISTRO ALMACENADO CON EXITO<br><br></center>");
		printf("

<center class='Estilo4'>
<form method='post' action='pagos_tesoreria_cxp.php'>
<input type='hidden' name='nn' value='CECP'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
");
	} //fin else
	?>


<?php
}
?>