<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../../login.php");
	exit;
} else {
	include('../../config.php');
	// recibo informacion del usuario
	$ingresa = isset($_POST['nn']) ? $_POST['nn'] : '';
	// cx bd
	$error = '';
	if ($connection = new mysqli($server, $dbuser, $dbpass, $database)) {
	} else {
		die("Error conectandose a la base.");
	}
	// saco el id de la empresa
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$idxx = $rowxx["id_emp"];
	}


	// verifico que los campos afectado y afectado_otros sean 0   
	$sq = "select * from cxp where id_emp = '$idxx' and cod_pptal = '$ingresa'";
	$re = $connectionxx->query($sq);
	while ($r = $re->fetch_assoc()) {
		$a1 = $r["afectado"];
		$a2 = $r["afectado_otros"];
		$h = $r["definitivo"];
	}

	// valido el resultado
	if ($a1 == '0' and $a2 == '0') {
		//resto el valor a todos sus padres
		$longitud = strlen($ingresa);
		switch ($longitud) {
			case (0):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (1):

				break;
				//---------
			case (2):
				$tipo = 1;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 2;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (3):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (4):
				$tipo = 2;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 3;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (5):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (6):
				$tipo = 4;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 4;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (7):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (8):
				$tipo = 6;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 5;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (9):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (10):
				$tipo = 8;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 6;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe - $h;
				$sqlpe = "UPDATE cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
				$resultadope = $connection->query($sqlpe);
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}

				break;
				//---------
			case (11):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (12):
				$tipo = 10;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 7;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf - $h;
				$sqlpf = "UPDATE cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
				$resultadopf = $connection->query($sqlpf);
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe - $h;
				$sqlpe = "UPDATE cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
				$resultadope = $connection->query($sqlpe);
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (13):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (14):
				$tipo = 12;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 8;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg - $h;
				$sqlpg = "UPDATE cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
				$resultadopg = $connection->query($sqlpg);
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf - $h;
				$sqlpf = "UPDATE cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
				$resultadopf = $connection->query($sqlpf);
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe - $h;
				$sqlpe = "UPDATE cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
				$resultadope = $connection->query($sqlpe);
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (15):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (16):
				$tipo = 14;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 9;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph - $h;
				$sqlph = "UPDATE cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
				$resultadoph = $connection->query($sqlph);
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg - $h;
				$sqlpg = "UPDATE cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
				$resultadopg = $connection->query($sqlpg);
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf - $h;
				$sqlpf = "UPDATE cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
				$resultadopf = $connection->query($sqlpf);
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe - $h;
				$sqlpe = "UPDATE cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
				$resultadope = $connection->query($sqlpe);
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (17):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (18):
				$tipo = 16;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 10;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi - $h;
				$sqlpi = "UPDATE cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
				$resultadopi = $connection->query($sqlpi);
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph - $h;
				$sqlph = "UPDATE cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
				$resultadoph = $connection->query($sqlph);
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg - $h;
				$sqlpg = "UPDATE cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
				$resultadopg = $connection->query($sqlpg);
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf - $h;
				$sqlpf = "UPDATE cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
				$resultadopf = $connection->query($sqlpf);
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe - $h;
				$sqlpe = "UPDATE cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
				$resultadope = $connection->query($sqlpe);
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (19):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (20):
				$tipo = 18;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 11;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj - $h;
				$sqlpj = "UPDATE cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
				$resultadopj = $connection->query($sqlpj);
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi - $h;
				$sqlpi = "UPDATE cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
				$resultadopi = $connection->query($sqlpi);
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph - $h;
				$sqlph = "UPDATE cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
				$resultadoph = $connection->query($sqlph);
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg - $h;
				$sqlpg = "UPDATE cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
				$resultadopg = $connection->query($sqlpg);
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf - $h;
				$sqlpf = "UPDATE cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
				$resultadopf = $connection->query($sqlpf);
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe - $h;
				$sqlpe = "UPDATE cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
				$resultadope = $connection->query($sqlpe);
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (21):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (22):
				$tipo = 20;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 12;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 12
				$pk = substr($codigo, 0, 20);
				$consultapk = $connection->query("SELECT * from cxp where cod_pptal ='$pk' and id_emp ='$idxx'");
				while ($rowpk = $consultapk->fetch_assoc()) {
					$vrpk = $rowpk["definitivo"];
				}
				$respk = $vrpk - $h;
				$sqlpk = "UPDATE cxp set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
				$resultadopk = $connection->query($sqlpk);
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj - $h;
				$sqlpj = "UPDATE cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
				$resultadopj = $connection->query($sqlpj);
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi - $h;
				$sqlpi = "UPDATE cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
				$resultadopi = $connection->query($sqlpi);
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph - $h;
				$sqlph = "UPDATE cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
				$resultadoph = $connection->query($sqlph);
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg - $h;
				$sqlpg = "UPDATE cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
				$resultadopg = $connection->query($sqlpg);
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf - $h;
				$sqlpf = "UPDATE cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
				$resultadopf = $connection->query($sqlpf);
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe - $h;
				$sqlpe = "UPDATE cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
				$resultadope = $connection->query($sqlpe);
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (23):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (24):
				$tipo = 22;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 13;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 13
				$pl = substr($codigo, 0, 22);
				$consultapl = $connection->query("SELECT * from cxp where cod_pptal ='$pl' and id_emp ='$idxx'");
				while ($rowpl = $consultapl->fetch_assoc()) {
					$vrpl = $rowpl["definitivo"];
				}
				$respl = $vrpl - $h;
				$sqlpl = "UPDATE cxp set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
				$resultadopl = $connection->query($sqlpl);
				// padre cuenta nivel 12
				$pk = substr($codigo, 0, 20);
				$consultapk = $connection->query("SELECT * from cxp where cod_pptal ='$pk' and id_emp ='$idxx'");
				while ($rowpk = $consultapk->fetch_assoc()) {
					$vrpk = $rowpk["definitivo"];
				}
				$respk = $vrpk - $h;
				$sqlpk = "UPDATE cxp set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
				$resultadopk = $connection->query($sqlpk);
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj - $h;
				$sqlpj = "UPDATE cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
				$resultadopj = $connection->query($sqlpj);
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi - $h;
				$sqlpi = "UPDATE cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
				$resultadopi = $connection->query($sqlpi);
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph - $h;
				$sqlph = "UPDATE cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
				$resultadoph = $connection->query($sqlph);
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg - $h;
				$sqlpg = "UPDATE cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
				$resultadopg = $connection->query($sqlpg);
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf - $h;
				$sqlpf = "UPDATE cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
				$resultadopf = $connection->query($sqlpf);
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe - $h;
				$sqlpe = "UPDATE cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
				$resultadope = $connection->query($sqlpe);
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (25):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (26):
				$tipo = 24;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 14;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 14
				$pm = substr($codigo, 0, 24);
				$consultapm = $connection->query("SELECT * from cxp where cod_pptal ='$pm' and id_emp ='$idxx'");
				while ($rowpm = $consultapm->fetch_assoc()) {
					$vrpm = $rowpm["definitivo"];
				}
				$respm = $vrpm - $h;
				$sqlpm = "UPDATE cxp set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
				$resultadopm = $connection->query($sqlpm);
				// padre cuenta nivel 13
				$pl = substr($codigo, 0, 22);
				$consultapl = $connection->query("SELECT * from cxp where cod_pptal ='$pl' and id_emp ='$idxx'");
				while ($rowpl = $consultapl->fetch_assoc()) {
					$vrpl = $rowpl["definitivo"];
				}
				$respl = $vrpl - $h;
				$sqlpl = "UPDATE cxp set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
				$resultadopl = $connection->query($sqlpl);
				// padre cuenta nivel 12
				$pk = substr($codigo, 0, 20);
				$consultapk = $connection->query("SELECT * from cxp where cod_pptal ='$pk' and id_emp ='$idxx'");
				while ($rowpk = $consultapk->fetch_assoc()) {
					$vrpk = $rowpk["definitivo"];
				}
				$respk = $vrpk - $h;
				$sqlpk = "UPDATE cxp set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
				$resultadopk = $connection->query($sqlpk);
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj - $h;
				$sqlpj = "UPDATE cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
				$resultadopj = $connection->query($sqlpj);
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi - $h;
				$sqlpi = "UPDATE cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
				$resultadopi = $connection->query($sqlpi);
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph - $h;
				$sqlph = "UPDATE cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
				$resultadoph = $connection->query($sqlph);
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg - $h;
				$sqlpg = "UPDATE cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
				$resultadopg = $connection->query($sqlpg);
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf - $h;
				$sqlpf = "UPDATE cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
				$resultadopf = $connection->query($sqlpf);
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe - $h;
				$sqlpe = "UPDATE cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
				$resultadope = $connection->query($sqlpe);
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (27):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (28):
				$tipo = 26;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 15;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 15
				$pn = substr($codigo, 0, 26);
				$consultapn = $connection->query("SELECT * from cxp where cod_pptal ='$pn' and id_emp ='$idxx'");
				while ($rowpn = $consultapn->fetch_assoc()) {
					$vrpn = $rowpn["definitivo"];
				}
				$respn = $vrpn - $h;
				$sqlpn = "UPDATE cxp set definitivo = '$respn' where cod_pptal ='$pn' and id_emp ='$idxx'";
				$resultadopn = $connection->query($sqlpn);
				// padre cuenta nivel 14
				$pm = substr($codigo, 0, 24);
				$consultapm = $connection->query("SELECT * from cxp where cod_pptal ='$pm' and id_emp ='$idxx'");
				while ($rowpm = $consultapm->fetch_assoc()) {
					$vrpm = $rowpm["definitivo"];
				}
				$respm = $vrpm - $h;
				$sqlpm = "UPDATE cxp set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
				$resultadopm = $connection->query($sqlpm);
				// padre cuenta nivel 13
				$pl = substr($codigo, 0, 22);
				$consultapl = $connection->query("SELECT * from cxp where cod_pptal ='$pl' and id_emp ='$idxx'");
				while ($rowpl = $consultapl->fetch_assoc()) {
					$vrpl = $rowpl["definitivo"];
				}
				$respl = $vrpl - $h;
				$sqlpl = "UPDATE cxp set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
				$resultadopl = $connection->query($sqlpl);
				// padre cuenta nivel 12
				$pk = substr($codigo, 0, 20);
				$consultapk = $connection->query("SELECT * from cxp where cod_pptal ='$pk' and id_emp ='$idxx'");
				while ($rowpk = $consultapk->fetch_assoc()) {
					$vrpk = $rowpk["definitivo"];
				}
				$respk = $vrpk - $h;
				$sqlpk = "UPDATE cxp set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
				$resultadopk = $connection->query($sqlpk);
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj - $h;
				$sqlpj = "UPDATE cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
				$resultadopj = $connection->query($sqlpj);
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi - $h;
				$sqlpi = "UPDATE cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
				$resultadopi = $connection->query($sqlpi);
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph - $h;
				$sqlph = "UPDATE cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
				$resultadoph = $connection->query($sqlph);
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg - $h;
				$sqlpg = "UPDATE cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
				$resultadopg = $connection->query($sqlpg);
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf - $h;
				$sqlpf = "UPDATE cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
				$resultadopf = $connection->query($sqlpf);
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe - $h;
				$sqlpe = "UPDATE cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
				$resultadope = $connection->query($sqlpe);
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------
			case (29):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
				break;
				//---------
			case (30):
				$tipo = 28;
				$codigo = $ingresa;
				$padre = substr($codigo, 0, $tipo);
				$nivel = 16;
				// actualizo el valor de todos los padres
				// padre cuenta nivel 16
				$po = substr($codigo, 0, 28);
				$consultapo = $connection->query("SELECT * from cxp where cod_pptal ='$po' and id_emp ='$idxx'");
				while ($rowpo = $consultapo->fetch_assoc()) {
					$vrpo = $rowpo["definitivo"];
				}
				$respo = $vrpo - $h;
				$sqlpo = "UPDATE cxp set definitivo = '$respo' where cod_pptal ='$po' and id_emp ='$idxx'";
				$resultadopo = $connection->query($sqlpo);
				// padre cuenta nivel 15
				$pn = substr($codigo, 0, 26);
				$consultapn = $connection->query("SELECT * from cxp where cod_pptal ='$pn' and id_emp ='$idxx'");
				while ($rowpn = $consultapn->fetch_assoc()) {
					$vrpn = $rowpn["definitivo"];
				}
				$respn = $vrpn - $h;
				$sqlpn = "UPDATE cxp set definitivo = '$respn' where cod_pptal ='$pn' and id_emp ='$idxx'";
				$resultadopn = $connection->query($sqlpn);
				// padre cuenta nivel 14
				$pm = substr($codigo, 0, 24);
				$consultapm = $connection->query("SELECT * from cxp where cod_pptal ='$pm' and id_emp ='$idxx'");
				while ($rowpm = $consultapm->fetch_assoc()) {
					$vrpm = $rowpm["definitivo"];
				}
				$respm = $vrpm - $h;
				$sqlpm = "UPDATE cxp set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
				$resultadopm = $connection->query($sqlpm);
				// padre cuenta nivel 13
				$pl = substr($codigo, 0, 22);
				$consultapl = $connection->query("SELECT * from cxp where cod_pptal ='$pl' and id_emp ='$idxx'");
				while ($rowpl = $consultapl->fetch_assoc()) {
					$vrpl = $rowpl["definitivo"];
				}
				$respl = $vrpl - $h;
				$sqlpl = "UPDATE cxp set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
				$resultadopl = $connection->query($sqlpl);
				// padre cuenta nivel 12
				$pk = substr($codigo, 0, 20);
				$consultapk = $connection->query("SELECT * from cxp where cod_pptal ='$pk' and id_emp ='$idxx'");
				while ($rowpk = $consultapk->fetch_assoc()) {
					$vrpk = $rowpk["definitivo"];
				}
				$respk = $vrpk - $h;
				$sqlpk = "UPDATE cxp set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
				$resultadopk = $connection->query($sqlpk);
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj - $h;
				$sqlpj = "UPDATE cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
				$resultadopj = $connection->query($sqlpj);
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi - $h;
				$sqlpi = "UPDATE cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
				$resultadopi = $connection->query($sqlpi);
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph - $h;
				$sqlph = "UPDATE cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
				$resultadoph = $connection->query($sqlph);
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg - $h;
				$sqlpg = "UPDATE cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
				$resultadopg = $connection->query($sqlpg);
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf - $h;
				$sqlpf = "UPDATE cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
				$resultadopf = $connection->query($sqlpf);
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe - $h;
				$sqlpe = "UPDATE cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
				$resultadope = $connection->query($sqlpe);
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd - $h;
				$sqlpd = "UPDATE cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
				$resultadopd = $connection->query($sqlpd);
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc - $h;
				$sqlpc = "UPDATE cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
				$resultadopc = $connection->query($sqlpc);
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb - $h;
				$sqlpb = "UPDATE cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
				$resultadopb = $connection->query($sqlpb);
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa - $h;
				$sqlpa = "UPDATE cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
				$resultadopa = $connection->query($sqlpa);
				// actualizo afectado del padre a 0 si este no tiene mas hijos 


				$result = $connection->query("SELECT * from cxp where padre ='$padre' and id_emp ='$idxx' ");
				$num_rows = $result->num_rows;
				if ($num_rows > '1') {
				} else {
					$sql2 = "UPDATE cxp set afectado='0' where cod_pptal ='$padre' and id_emp ='$idxx'";
					$resultado2 = $connection->query($sql2);
				}
				break;
				//---------

			default:
				$error = "<center class='Estilo4'><br><br><b>La Extension del Codigo Presupuestal Ingresado Excede al Nivel 16 </b><br>Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
		}
		printf("%s <br><br></center>", $error);
		//elimino el registro
		$cx = new mysqli($server, $dbuser, $dbpass, $database);

		$sSQL = "Delete from cxp Where cod_pptal='$ingresa' and id_emp = '$idxx'";
		$cx->query($sSQL);
		printf("<center class='Estilo4'><br><br>Cuenta <b>ELIMINADA</b> con exito<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='../consulta_ppto_gas.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>");
	} else {
		echo "<br><br><center class='Estilo4'>El codigo presupuestal que intenta <b>ELIMINAR</b><br>
<b>NO EXISTE </b> o ha sido afectado por otras cuentas<br><BR><B>NO SE PUEDE EJECUTAR ESTA ACCION</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='eliminar_codigo.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	}



?>
<?php
}
?><title>CONTAFACIL</title>
<style type="text/css">
	.Estilo1 {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 12px;
		font-weight: bold;
	}

	.Estilo2 {
		font-size: 9px
	}

	.Estilo4 {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		color: #333333;
	}

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

	.Estilo7 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 9px;
		color: #666666;
	}

	.Estilo8 {
		color: #FFFFFF
	}
</style>

<style>
	.fc_main {
		background: #FFFFFF;
		border: 1px solid #000000;
		font-family: Verdana;
		font-size: 10px;
	}

	.fc_date {
		border: 1px solid #D9D9D9;
		cursor: pointer;
		font-size: 10px;
		text-align: center;
	}

	.fc_dateHover,
	TD.fc_date:hover {
		cursor: pointer;
		border-top: 1px solid #FFFFFF;
		border-left: 1px solid #FFFFFF;
		border-right: 1px solid #999999;
		border-bottom: 1px solid #999999;
		background: #E7E7E7;
		font-size: 10px;
		text-align: center;
	}

	.fc_wk {
		font-family: Verdana;
		font-size: 10px;
		text-align: center;
	}

	.fc_wknd {
		color: #FF0000;
		font-weight: bold;
		font-size: 10px;
		text-align: center;
	}

	.fc_head {
		background: #000066;
		color: #FFFFFF;
		font-weight: bold;
		text-align: left;
		font-size: 11px;
	}
</style>

<style type="text/css">
	table.bordepunteado1 {
		border-style: solid;
		border-collapse: collapse;
		border-width: 2px;
		border-color: #004080;
	}

	.Estilo15 {
		font-size: 11px
	}
</style>