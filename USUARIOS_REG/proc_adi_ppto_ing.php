<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {

	include('config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$id_emp = $_POST['id_emp'];
	$cod_pptal = $_POST['cod_pptal'];
	$sql = "SELECT nom_rubro from car_ppto_ing where cod_pptal ='$cod_pptal'";
	$res = $cx->query($sql);
	$row = $res->fetch_assoc();
	$nom_rubro = $row["nom_rubro"];
	$fecha_adi = $_POST['fecha_adi'];
	$ppto_aprob = $_POST['ppto_aprob'];
	$tipo_acto = $_POST['tipo_acto'];
	$num_acto = $_POST['num_acto'];
	$valor_adi = $_POST['valor_adi'];
	$concepto_adi = $_POST['concepto_adi'];

	//printf("%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>",$id_emp,$cod_pptal,$nom_rubro,$fecha_adi,$ppto_aprob,$tipo_acto,$num_acto,$valor_adi,$concepto_adi);

	$resultadoxx = $cx->query("SELECT * from vf");
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$ax = $rowxx["fecha_ini"];
		$bx = $rowxx["fecha_fin"];
	}


	if ($fecha_adi > $bx or $fecha_adi < $ax) {
		printf("<center class='Estilo4'>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
		</center>");
	} else {

		$res = $cx->query("INSERT INTO adi_ppto_ing ( id_emp , cod_pptal , nom_rubro , fecha_adi , ppto_aprob , tipo_acto , num_acto , valor_adi , concepto_adi) VALUES ( '$id_emp' , '$cod_pptal' , '$nom_rubro' , '$fecha_adi' , '$ppto_aprob' , '$tipo_acto' , '$num_acto' , '$valor_adi' , '$concepto_adi')");

		$afectado_otros = '1';
		$cx->query("UPDATE car_ppto_ing Set afectado_otros='$afectado_otros' Where cod_pptal = '$cod_pptal' and id_emp ='$id_emp'");

		//sumo el valor a todos sus padres
		$ingresa = $cod_pptal;
		$idxx = $id_emp;
		$h = $valor_adi;
		$longitud = strlen($ingresa);
		switch ($longitud) {
			case (0):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (3):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (5):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (7):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (9):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe + $h;
				$resultadope = $cx->query("UPDATE car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'");
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");


				break;
				//---------
			case (11):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf + $h;
				$resultadopf = $cx->query("UPDATE car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'");
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe + $h;
				$resultadope = $cx->query("UPDATE car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'");
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (13):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg + $h;
				$resultadopg = $cx->query("UPDATE car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'");
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf + $h;
				$resultadopf = $cx->query("UPDATE car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'");
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe + $h;
				$resultadope = $cx->query("UPDATE car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'");
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (15):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph + $h;
				$resultadoph = $cx->query("UPDATE car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'");
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg + $h;
				$resultadopg = $cx->query("UPDATE car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'");
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf + $h;
				$resultadopf = $cx->query("UPDATE car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'");
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe + $h;
				$resultadope = $cx->query("UPDATE car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'");
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (17):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi + $h;
				$resultadopi = $cx->query("UPDATE car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'");
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph + $h;
				$resultadoph = $cx->query("UPDATE car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'");
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg + $h;
				$resultadopg = $cx->query("UPDATE car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'");
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf + $h;
				$resultadopf = $cx->query("UPDATE car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'");
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe + $h;
				$resultadope = $cx->query("UPDATE car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'");
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (19):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj + $h;
				$resultadopj = $cx->query("UPDATE car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'");
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi + $h;
				$resultadopi = $cx->query("UPDATE car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'");
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph + $h;
				$resultadoph = $cx->query("UPDATE car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'");
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg + $h;
				$resultadopg = $cx->query("UPDATE car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'");
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf + $h;
				$resultadopf = $cx->query("UPDATE car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'");
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe + $h;
				$resultadope = $cx->query("UPDATE car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'");
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (21):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 12
				$pk = substr($codigo, 0, 20);
				$consultapk = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pk' and id_emp ='$idxx'");
				while ($rowpk = $consultapk->fetch_assoc()) {
					$vrpk = $rowpk["definitivo"];
				}
				$respk = $vrpk + $h;
				$resultadopk = $cx->query("UPDATE car_ppto_ing set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'");
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj + $h;
				$resultadopj = $cx->query("UPDATE car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'");
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi + $h;
				$resultadopi = $cx->query("UPDATE car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'");
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph + $h;
				$resultadoph = $cx->query("UPDATE car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'");
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg + $h;
				$resultadopg = $cx->query("UPDATE car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'");
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf + $h;
				$resultadopf = $cx->query("UPDATE car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'");
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe + $h;
				$resultadope = $cx->query("UPDATE car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'");
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (23):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 13
				$pl = substr($codigo, 0, 22);
				$consultapl = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pl' and id_emp ='$idxx'");
				while ($rowpl = $consultapl->fetch_assoc()) {
					$vrpl = $rowpl["definitivo"];
				}
				$respl = $vrpl + $h;
				$resultadopl = $cx->query("UPDATE car_ppto_ing set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'");
				// padre cuenta nivel 12
				$pk = substr($codigo, 0, 20);
				$consultapk = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pk' and id_emp ='$idxx'");
				while ($rowpk = $consultapk->fetch_assoc()) {
					$vrpk = $rowpk["definitivo"];
				}
				$respk = $vrpk + $h;
				$resultadopk = $cx->query("UPDATE car_ppto_ing set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'");
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj + $h;
				$resultadopj = $cx->query("UPDATE car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'");
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi + $h;
				$resultadopi = $cx->query("UPDATE car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'");
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph + $h;
				$resultadoph = $cx->query("UPDATE car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'");
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg + $h;
				$resultadopg = $cx->query("UPDATE car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'");
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf + $h;
				$resultadopf = $cx->query("UPDATE car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'");
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe + $h;
				$resultadope = $cx->query("UPDATE car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'");
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (25):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 14
				$pm = substr($codigo, 0, 24);
				$consultapm = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pm' and id_emp ='$idxx'");
				while ($rowpm = $consultapm->fetch_assoc()) {
					$vrpm = $rowpm["definitivo"];
				}
				$respm = $vrpm + $h;
				$resultadopm = $cx->query("UPDATE car_ppto_ing set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'");
				// padre cuenta nivel 13
				$pl = substr($codigo, 0, 22);
				$consultapl = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pl' and id_emp ='$idxx'");
				while ($rowpl = $consultapl->fetch_assoc()) {
					$vrpl = $rowpl["definitivo"];
				}
				$respl = $vrpl + $h;
				$resultadopl = $cx->query("UPDATE car_ppto_ing set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'");
				// padre cuenta nivel 12
				$pk = substr($codigo, 0, 20);
				$consultapk = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pk' and id_emp ='$idxx'");
				while ($rowpk = $consultapk->fetch_assoc()) {
					$vrpk = $rowpk["definitivo"];
				}
				$respk = $vrpk + $h;
				$resultadopk = $cx->query("UPDATE car_ppto_ing set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'");
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj + $h;
				$resultadopj = $cx->query("UPDATE car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'");
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi + $h;
				$resultadopi = $cx->query("UPDATE car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'");
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph + $h;
				$resultadoph = $cx->query("UPDATE car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'");
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg + $h;
				$resultadopg = $cx->query("UPDATE car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'");
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf + $h;
				$resultadopf = $cx->query("UPDATE car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'");
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe + $h;
				$resultadope = $cx->query("UPDATE car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'");
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (27):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 15
				$pn = substr($codigo, 0, 26);
				$consultapn = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pn' and id_emp ='$idxx'");
				while ($rowpn = $consultapn->fetch_assoc()) {
					$vrpn = $rowpn["definitivo"];
				}
				$respn = $vrpn + $h;
				$resultadopn = $cx->query("UPDATE car_ppto_ing set definitivo = '$respn' where cod_pptal ='$pn' and id_emp ='$idxx'");
				// padre cuenta nivel 14
				$pm = substr($codigo, 0, 24);
				$consultapm = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pm' and id_emp ='$idxx'");
				while ($rowpm = $consultapm->fetch_assoc()) {
					$vrpm = $rowpm["definitivo"];
				}
				$respm = $vrpm + $h;
				$resultadopm = $cx->query("UPDATE car_ppto_ing set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'");
				// padre cuenta nivel 13
				$pl = substr($codigo, 0, 22);
				$consultapl = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pl' and id_emp ='$idxx'");
				while ($rowpl = $consultapl->fetch_assoc()) {
					$vrpl = $rowpl["definitivo"];
				}
				$respl = $vrpl + $h;
				$resultadopl = $cx->query("UPDATE car_ppto_ing set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'");
				// padre cuenta nivel 12
				$pk = substr($codigo, 0, 20);
				$consultapk = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pk' and id_emp ='$idxx'");
				while ($rowpk = $consultapk->fetch_assoc()) {
					$vrpk = $rowpk["definitivo"];
				}
				$respk = $vrpk + $h;
				$resultadopk = $cx->query("UPDATE car_ppto_ing set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'");
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj + $h;
				$resultadopj = $cx->query("UPDATE car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'");
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi + $h;
				$resultadopi = $cx->query("UPDATE car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'");
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph + $h;
				$resultadoph = $cx->query("UPDATE car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'");
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg + $h;
				$resultadopg = $cx->query("UPDATE car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'");
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf + $h;
				$resultadopf = $cx->query("UPDATE car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'");
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe + $h;
				$resultadope = $cx->query("UPDATE car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'");
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------
			case (29):
				$error = "
<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $ingresa . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99<br><br> Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
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
				//lo actualizo a el mismo
				$c = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$codigo' and id_emp ='$idxx'");
				while ($r = $c->fetch_assoc()) {
					$vr = $r["definitivo"];
				}
				$re = $vr + $h;
				$res = $cx->query("UPDATE car_ppto_ing set definitivo = '$re' where cod_pptal ='$codigo' and id_emp ='$idxx'");
				// actualizo el valor de todos los padres
				// padre cuenta nivel 16
				$po = substr($codigo, 0, 28);
				$consultapo = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$po' and id_emp ='$idxx'");
				while ($rowpo = $consultapo->fetch_assoc()) {
					$vrpo = $rowpo["definitivo"];
				}
				$respo = $vrpo + $h;
				$resultadopo = $cx->query("UPDATE car_ppto_ing set definitivo = '$respo' where cod_pptal ='$po' and id_emp ='$idxx'");
				// padre cuenta nivel 15
				$pn = substr($codigo, 0, 26);
				$consultapn = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pn' and id_emp ='$idxx'");
				while ($rowpn = $consultapn->fetch_assoc()) {
					$vrpn = $rowpn["definitivo"];
				}
				$respn = $vrpn + $h;
				$resultadopn = $cx->query("UPDATE car_ppto_ing set definitivo = '$respn' where cod_pptal ='$pn' and id_emp ='$idxx'");
				// padre cuenta nivel 14
				$pm = substr($codigo, 0, 24);
				$consultapm = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pm' and id_emp ='$idxx'");
				while ($rowpm = $consultapm->fetch_assoc()) {
					$vrpm = $rowpm["definitivo"];
				}
				$respm = $vrpm + $h;
				$resultadopm = $cx->query("UPDATE car_ppto_ing set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'");
				// padre cuenta nivel 13
				$pl = substr($codigo, 0, 22);
				$consultapl = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pl' and id_emp ='$idxx'");
				while ($rowpl = $consultapl->fetch_assoc()) {
					$vrpl = $rowpl["definitivo"];
				}
				$respl = $vrpl + $h;
				$resultadopl = $cx->query("UPDATE car_ppto_ing set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'");
				// padre cuenta nivel 12
				$pk = substr($codigo, 0, 20);
				$consultapk = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pk' and id_emp ='$idxx'");
				while ($rowpk = $consultapk->fetch_assoc()) {
					$vrpk = $rowpk["definitivo"];
				}
				$respk = $vrpk + $h;
				$resultadopk = $cx->query("UPDATE car_ppto_ing set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'");
				// padre cuenta nivel 11
				$pj = substr($codigo, 0, 18);
				$consultapj = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pj' and id_emp ='$idxx'");
				while ($rowpj = $consultapj->fetch_assoc()) {
					$vrpj = $rowpj["definitivo"];
				}
				$respj = $vrpj + $h;
				$resultadopj = $cx->query("UPDATE car_ppto_ing set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'");
				// padre cuenta nivel 10
				$pi = substr($codigo, 0, 16);
				$consultapi = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pi' and id_emp ='$idxx'");
				while ($rowpi = $consultapi->fetch_assoc()) {
					$vrpi = $rowpi["definitivo"];
				}
				$respi = $vrpi + $h;
				$resultadopi = $cx->query("UPDATE car_ppto_ing set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'");
				// padre cuenta nivel 9
				$ph = substr($codigo, 0, 14);
				$consultaph = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$ph' and id_emp ='$idxx'");
				while ($rowph = $consultaph->fetch_assoc()) {
					$vrph = $rowph["definitivo"];
				}
				$resph = $vrph + $h;
				$resultadoph = $cx->query("UPDATE car_ppto_ing set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'");
				// padre cuenta nivel 8
				$pg = substr($codigo, 0, 12);
				$consultapg = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pg' and id_emp ='$idxx'");
				while ($rowpg = $consultapg->fetch_assoc()) {
					$vrpg = $rowpg["definitivo"];
				}
				$respg = $vrpg + $h;
				$resultadopg = $cx->query("UPDATE car_ppto_ing set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'");
				// padre cuenta nivel 7
				$pf = substr($codigo, 0, 10);
				$consultapf = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pf' and id_emp ='$idxx'");
				while ($rowpf = $consultapf->fetch_assoc()) {
					$vrpf = $rowpf["definitivo"];
				}
				$respf = $vrpf + $h;
				$resultadopf = $cx->query("UPDATE car_ppto_ing set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'");
				// padre cuenta nivel 6
				$pe = substr($codigo, 0, 8);
				$consultape = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pe' and id_emp ='$idxx'");
				while ($rowpe = $consultape->fetch_assoc()) {
					$vrpe = $rowpe["definitivo"];
				}
				$respe = $vrpe + $h;
				$resultadope = $cx->query("UPDATE car_ppto_ing set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'");
				// padre cuenta nivel 5
				$pd = substr($codigo, 0, 6);
				$consultapd = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pd' and id_emp ='$idxx'");
				while ($rowpd = $consultapd->fetch_assoc()) {
					$vrpd = $rowpd["definitivo"];
				}
				$respd = $vrpd + $h;
				$resultadopd = $cx->query("UPDATE car_ppto_ing set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'");
				// padre cuenta nivel 4
				$pc = substr($codigo, 0, 4);
				$consultapc = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pc' and id_emp ='$idxx'");
				while ($rowpc = $consultapc->fetch_assoc()) {
					$vrpc = $rowpc["definitivo"];
				}
				$respc = $vrpc + $h;
				$resultadopc = $cx->query("UPDATE car_ppto_ing set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'");
				// padre cuenta nivel 3
				$pb = substr($codigo, 0, 2);
				$consultapb = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pb' and id_emp ='$idxx'");
				while ($rowpb = $consultapb->fetch_assoc()) {
					$vrpb = $rowpb["definitivo"];
				}
				$respb = $vrpb + $h;
				$resultadopb = $cx->query("UPDATE car_ppto_ing set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'");
				// padre cuenta nivel 2
				$pa = substr($codigo, 0, 1);
				$consultapa = $cx->query("SELECT * from car_ppto_ing where cod_pptal ='$pa' and id_emp ='$idxx'");
				while ($rowpa = $consultapa->fetch_assoc()) {
					$vrpa = $rowpa["definitivo"];
				}
				$respa = $vrpa + $h;
				$resultadopa = $cx->query("UPDATE car_ppto_ing set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'");

				break;
				//---------

			default:
				$error = "<center class='Estilo4'><br><br><b>La Extension del Codigo Presupuestal Ingresado Excede al Nivel 16 </b><br>Verifique nuevamente su informacion<br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
		}
		//printf("%s <br><br></center>", $error);



		printf("<center class='Estilo4'>DATOS ALMACENADOS CON EXITO<br><br>");
		printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080;    	width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
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

	a {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 11px;
		color: #666666;
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

	a:link {
		text-decoration: none;
	}

	.Estilo7 {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 11px;
		color: #666666;
	}

	.Estilo4 {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		color: #333333;
	}
</style>

<style type="text/css">
	table.bordepunteado1 {
		border-style: solid;
		border-collapse: collapse;
		border-width: 2px;
		border-color: #004080;
	}
</style>