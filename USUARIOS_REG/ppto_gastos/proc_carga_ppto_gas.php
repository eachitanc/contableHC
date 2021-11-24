<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {

	include('../config.php');
	////------------------
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$s = "SELECT * from fecha";
	$r = $connectionxx->query($s);
	while ($rw = $r->fetch_assoc()) {
		$fecha_sesion = $rw["ano"];
	}

	$ss = "SELECT * from fecha_ini_op";
	$rs = $connectionxx->query($ss);
	while ($rws = $rs->fetch_assoc()) {
		$fecha_ini_op = $rws["fecha_ini_op"];
	}

	$ano = $fecha_sesion;

	//asigno ppto_aprob = 0  si ano no coincide con fecha_ini op
	if ($ano == $fecha_ini_op) {
		$ppto_aprob = $_POST['ppto_aprob'];
	} else {

		$ppto_aprob = '0';
	}
	///-------------------



	$id_emp = $_POST['id_emp'];
	$cod_pptal = $_POST['cod_pptal'];
	$nom_rubro = $_POST['nom_rubro'];
	$tip_dato = $_POST['selecprod'];
	//convierto a minusculas el nombre de las cuentas tipo DETALLE
	if ($tip_dato == 'M') {
	} else {
		$nom_rubro = strtolower($nom_rubro);
	}

	$proc_rec = $_POST['proc_rec'];
	$situacion = $_POST['situacion'];
	$afectado = '0';
	$inversion = isset($_POST['inversion'])?$_POST['inversion']:null;
	$opc1 = $_POST['opc1'];
	$vigencia = $_POST['vigencia'];

	$consultax =$connectionxx->query("SELECT * from vf ");
	while ($rowx = $consultax->fetch_assoc()) {
		$ax = $rowx["fecha_ini"];
		$bx = $rowx["fecha_fin"];
	}

	if ($ano > $bx or $ano < $ax) {
		printf("<center class='Estilo4'>Esta Fecha <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual</center>");
	} else {

		//---------------------------- saco el id de la empresa ----------------------------
		$sqlxx = "SELECT * from fecha";
		$resultadoxx = $connectionxx->query($sqlxx);
		while ($rowxx = $resultadoxx->fetch_assoc()) {
			$idxx = $rowxx["id_emp"];
		}


		$sql = "UPDATE tmp_cod_pptal set cod='$cod_pptal'";
		$resultado = $connectionxx->query($sql);

		$ingreso = substr($cod_pptal, 0, 1);

		if ($ingreso == 1) {
			echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar NO ES DE GASTOS<br><br>
			<a href='carga_ppto_gas.php'>Volver</a></center>";
		} elseif ($ingreso == 0 || $ingreso >= 2) {

			$cadena = $cod_pptal;
			$longitud = strlen($cadena);
			printf("<center class='Estilo4'><B>ANALISIS DE LOS DATOS INGRESADOS POR EL USUARIO</B><BR><br>
	        Codigo presupuestal = %s", $cadena);

			switch ($longitud) {

				case (0):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 1<br><br> Verifique nuevamente su informacion</center>";
					//break;
					//---------------------
				case (1):
					$tipo = 1;
					$codigo = $cadena;
					$padre = substr($codigo, 0, $tipo);
					$nivel = 1;
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else {

						//----------------------------------------------------------------------------------
						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$codigo' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);
						if ($result->num_rows == 0) {
							//--------- INSERCION DEL NUEVO COD_PPTAL -----

							$sql = "INSERT INTO car_ppto_gas ( ano , id_emp , padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , 
			proc_rec , situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) VALUES ( '$ano', '$id_emp', '', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel', 
			'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
							$connectionxx->query($sql);
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br>
			<br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						}
					}


					break;
					//---------------------
				case (2):
					$tipo = 1;
					$codigo = $cadena;
					$nivel = 2;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else {

						//----------------------------------------------------------------------------------
						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {
							//------ verifico que exista el padre ---

							$sql1 = "SELECT * from car_ppto_gas where cod_pptal= '$padre' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 1 $sql1<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Gastos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO car_ppto_gas ( ano , id_emp , padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , 
			proc_rec , situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato',
			'$nivel', '$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br>
			<br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						}

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre = '2' AND nivel = '2' AND 						
			id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '2' 
			AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//------------------------------------------------------
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre = '0' AND nivel = '2' AND 						
			id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '0' AND 
			id_emp = '$idxx'";
						$connectionxx->query($sqlB);
					}

					break;
					//---------------------
				case (3):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 22<br><br> Verifique nuevamente su informacion</center>";
					// break;
					//---------------------
				case (4):
					$tipo = 2;
					$codigo = $cadena;
					$nivel = 3;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else {

						//------------------------- calculo de codigos y niveles ----------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = $nivel - 2;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = $nivel - 1;

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c2' and nivel = '2' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);
							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 2<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL DE 3ER NIVEL-----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						}

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre='$padre' AND nivel=$nivel 
			AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE cod_pptal = '$c2' AND 
			nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre = '2' AND nivel = '2' AND 						
			id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '2' 
			AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre = '0' AND nivel = '2' AND 						
			id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '0' AND 
			id_emp = '$idxx'";
						$connectionxx->query($sqlB);
					}

					break;
					//---------------------
				case (5):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 3<br><br> Verifique nuevamente su informacion</center>";
					// break;
					//---------------------
				case (6):
					$tipo = 4;
					$codigo = $cadena;
					$nivel = 4;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c3' and nivel = '3' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 3 $sql1<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre='$padre' AND nivel=$nivel AND 
			id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1', definitivo='$nuevo_total' WHERE cod_pptal = '$c3' AND nivel = 
			'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre = '2' AND nivel = '2' AND 						
			id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '2' 
			AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre = '0' AND nivel = '2' AND 						
			id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '0' AND 
			id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}

					break;
					//---------------------
				case (7):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 4<br><br> Verifique nuevamente su informacion</center>";
					// break;
					//---------------------
				case (8):
					$tipo = 6;
					$codigo = $cadena;
					$nivel = 5;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;


						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c4' and nivel = '4' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 4 $sql1<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres



						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre='$padre' AND nivel=$nivel AND 
			id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1', definitivo='$nuevo_total' WHERE cod_pptal = '$c4' AND nivel = 
			'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre='$c3' AND nivel=$niv4 AND 
			id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1', definitivo='$nuevo_total' WHERE cod_pptal = '$c3' AND nivel = 
			'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre = '2' AND nivel = '2' AND 						
			id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '2' 
			AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE padre = '0' AND nivel = '2' AND 						
			id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' WHERE cod_pptal = '0' AND 
			id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}

					break;
					//---------------------
				case (9):

					//---------------------
				case (10):
					$tipo = 8;
					$codigo = $cadena;
					$nivel = 6;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c5 = substr($codigo, 0, 8);
						$niv5 = 5; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c5' and nivel = '5' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 5<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '2' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '2'	AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}


					break;
					//---------------------
				case (11):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 5<br><br> Verifique nuevamente su informacion</center>";
					//break;
					//---------------------
				case (12):
					$tipo = 10;
					$codigo = $cadena;
					$nivel = 7;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c5 = substr($codigo, 0, 8);
						$niv5 = 5;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c6 = substr($codigo, 0, 10);
						$niv6 = 6; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c6' and nivel = '6' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 6<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '2' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '2'	AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}
					break;
					//---------------------
				case (13):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 6<br><br> Verifique nuevamente su informacion</center>";
					//break;
					//---------------------
				case (14):
					$tipo = 12;
					$codigo = $cadena;
					$nivel = 8;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c5 = substr($codigo, 0, 8);
						$niv5 = 5;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c6 = substr($codigo, 0, 10);
						$niv6 = 6;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c7 = substr($codigo, 0, 12);
						$niv7 = 7; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c7' and nivel = '7' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 7<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres


						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '2' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '2'	AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}

					break;
					//---------------------
				case (15):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 7<br><br> Verifique nuevamente su informacion</center>";
					//break;
					//---------------------
				case (16):
					$tipo = 14;
					$codigo = $cadena;
					$nivel = 9;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c5 = substr($codigo, 0, 8);
						$niv5 = 5;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c6 = substr($codigo, 0, 10);
						$niv6 = 6;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c7 = substr($codigo, 0, 12);
						$niv7 = 7;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c8 = substr($codigo, 0, 14);
						$niv8 = 8; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c8' and nivel = '8' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 8<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres



						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '2' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '2'	AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}

					break;
					//---------------------
				case (17):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 8<br><br> Verifique nuevamente su informacion</center>";
					// break;
					//---------------------	
				case (18):
					$tipo = 16;
					$codigo = $cadena;
					$nivel = 10;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c5 = substr($codigo, 0, 8);
						$niv5 = 5;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c6 = substr($codigo, 0, 10);
						$niv6 = 6;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c7 = substr($codigo, 0, 12);
						$niv7 = 7;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c8 = substr($codigo, 0, 14);
						$niv8 = 8;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c9 = substr($codigo, 0, 16);
						$niv9 = 9; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c9' and nivel = '9' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 9<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '2' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '2'	AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}

					break;
					//---------------------
				case (19):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 9<br><br> Verifique nuevamente su informacion</center>";
					// break;
					//---------------------
				case (20):
					$tipo = 18;
					$codigo = $cadena;
					$nivel = 11;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c5 = substr($codigo, 0, 8);
						$niv5 = 5;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c6 = substr($codigo, 0, 10);
						$niv6 = 6;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c7 = substr($codigo, 0, 12);
						$niv7 = 7;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c8 = substr($codigo, 0, 14);
						$niv8 = 8;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c9 = substr($codigo, 0, 16);
						$niv9 = 9;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c10 = substr($codigo, 0, 18);
						$niv10 = 10; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c10' and nivel = '10' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 10<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres


						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '2' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '2'	AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}

					break;
					//---------------------
				case (21):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 10<br><br> Verifique nuevamente su informacion</center>";
					// break; 
					//---------------------
				case (22):
					$tipo = 20;
					$codigo = $cadena;
					$nivel = 12;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c5 = substr($codigo, 0, 8);
						$niv5 = 5;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c6 = substr($codigo, 0, 10);
						$niv6 = 6;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c7 = substr($codigo, 0, 12);
						$niv7 = 7;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c8 = substr($codigo, 0, 14);
						$niv8 = 8;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c9 = substr($codigo, 0, 16);
						$niv9 = 9;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c10 = substr($codigo, 0, 18);
						$niv10 = 10;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c11 = substr($codigo, 0, 20);
						$niv11 = 11; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c11' and nivel = '11' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 11<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres



						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 12 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 11 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c11' AND nivel = '$niv11' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c10' AND nivel=$niv11 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '2' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '2'	AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}


					break;
					//---------------------
				case (23):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 11<br><br> Verifique nuevamente su informacion</center>";
					// break; 
					//---------------------
				case (24):
					$tipo = 22;
					$codigo = $cadena;
					$nivel = 13;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c5 = substr($codigo, 0, 8);
						$niv5 = 5;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c6 = substr($codigo, 0, 10);
						$niv6 = 6;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c7 = substr($codigo, 0, 12);
						$niv7 = 7;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c8 = substr($codigo, 0, 14);
						$niv8 = 8;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c9 = substr($codigo, 0, 16);
						$niv9 = 9;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c10 = substr($codigo, 0, 18);
						$niv10 = 10;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c11 = substr($codigo, 0, 20);
						$niv11 = 11;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c12 = substr($codigo, 0, 22);
						$niv12 = 12; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c12' and nivel = '12' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 12<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres


						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 13 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 12 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c12' AND nivel = '$niv12' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 12 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c11' AND nivel=$niv12 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 11 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c11' AND nivel = '$niv11' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c10' AND nivel=$niv11 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '2' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '2'	AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}

					break;
					//---------------------	
				case (25):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 12<br><br> Verifique nuevamente su informacion</center>";
					//break; 
					//---------------------
				case (26):
					$tipo = 24;
					$codigo = $cadena;
					$nivel = 14;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c5 = substr($codigo, 0, 8);
						$niv5 = 5;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c6 = substr($codigo, 0, 10);
						$niv6 = 6;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c7 = substr($codigo, 0, 12);
						$niv7 = 7;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c8 = substr($codigo, 0, 14);
						$niv8 = 8;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c9 = substr($codigo, 0, 16);
						$niv9 = 9;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c10 = substr($codigo, 0, 18);
						$niv10 = 10;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c11 = substr($codigo, 0, 20);
						$niv11 = 11;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c12 = substr($codigo, 0, 22);
						$niv12 = 12;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c13 = substr($codigo, 0, 24);
						$niv13 = 13; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c13' and nivel = '13' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 13<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres


						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 14 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 13 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c13' AND nivel = '$niv13' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	 
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 13 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c12' AND nivel=$niv13 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 12 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c12' AND nivel = '$niv12' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 12 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c11' AND nivel=$niv12 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 11 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c11' AND nivel = '$niv11' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c10' AND nivel=$niv11 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '2' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1', definitivo='$nuevo_total' 
			WHERE cod_pptal = '2'	AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}

					break;
					//---------------------		  
				case (27):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 13<br><br> Verifique nuevamente su informacion</center>";
					// break; 
					//---------------------
				case (28):
					$tipo = 26;
					$codigo = $cadena;
					$nivel = 15;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c5 = substr($codigo, 0, 8);
						$niv5 = 5;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c6 = substr($codigo, 0, 10);
						$niv6 = 6;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c7 = substr($codigo, 0, 12);
						$niv7 = 7;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c8 = substr($codigo, 0, 14);
						$niv8 = 8;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c9 = substr($codigo, 0, 16);
						$niv9 = 9;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c10 = substr($codigo, 0, 18);
						$niv10 = 10;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c11 = substr($codigo, 0, 20);
						$niv11 = 11;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c12 = substr($codigo, 0, 22);
						$niv12 = 12;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c13 = substr($codigo, 0, 24);
						$niv13 = 13;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c14 = substr($codigo, 0, 26);
						$niv14 = 14; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c14' and nivel = '14' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 14<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 15 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 14 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c14' AND nivel = '$niv14' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 14 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c13' AND nivel=$niv14 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 13 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c13' AND nivel = '$niv13' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	 
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 13 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c12' AND nivel=$niv13 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 12 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c12' AND nivel = '$niv12' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 12 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c11' AND nivel=$niv12 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 11 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c11' AND nivel = '$niv11' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c10' AND nivel=$niv11 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '2' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '2'	AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}

					break;
					//---------------------	
				case (29):
					$error = "<center class='Estilo4'><br><br><b>Codigo Presupuestal</B> ...:::" . $cadena . ":::... <B> ES INCORRECTO</b><br><br><B><u>RECUERDE</u></B><br><br>Debe Ingresar la Cuentas por <B>PARES</B> y cada <b>PAR</b> no debe exceder 99 14<br><br> Verifique nuevamente su informacion</center>";
					//break; 
					//---------------------
				case (30):
					$tipo = 28;
					$codigo = $cadena;
					$nivel = 16;
					$padre = substr($cadena, 0, $tipo);
					printf('<br>Esta cuenta depende de = %s <br>El nivel de esta Cuenta es %s', $padre, $nivel);

					// consulto si el padre es MAYOR o DETALLE para evitar papas DETALLE con hijos DETALLE
					$consulta =$connectionxx->query("SELECT tip_dato from car_ppto_gas where cod_pptal ='$padre' and id_emp ='$idxx'");
					while ($row = $consulta->fetch_assoc()) {
						$mayor_detalle = $row["tip_dato"];
					}

					if ($mayor_detalle == 'D') {
						printf("<center class='Estilo4'><br><br><B>RESPUESTA DEL SISTEMA</B><BR><BR>El Codigo Presupuestal<BR> ...:::<b>" . $cadena . "
	   </b>:::...<br> 
		Depende de la Cuenta<BR>...::: <B>" . $padre . "</B>:::...<br>que es una Cuenta tipo <B>" . $mayor_detalle . "etalle</b>
		<br><br>
		<B><u>ATENCION</u></B><br><br>De una Cuenta DETALLE <U><B>NO</B></U> puede depender otra cuenta de tipo DETALLE o MAYOR
		<br><br> Verifique nuevamente su informacion</center>");
					} else { // igual

						//------------calculo de codigos y niveles-----------------------------------------------	 
						//---------------------------- calculo codigo y nivel para padre nivel 1 ----------------------------
						$c1 = substr($codigo, 0, 1);
						$niv1 = 1;

						//---------------------------- calculo codigo y nivel para padre nivel 2 ----------------------------
						$c2 = substr($codigo, 0, 2);
						$niv2 = 2;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c3 = substr($codigo, 0, 4);
						$niv3 = 3;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c4 = substr($codigo, 0, 6);
						$niv4 = 4;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c5 = substr($codigo, 0, 8);
						$niv5 = 5;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c6 = substr($codigo, 0, 10);
						$niv6 = 6;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c7 = substr($codigo, 0, 12);
						$niv7 = 7;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c8 = substr($codigo, 0, 14);
						$niv8 = 8;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c9 = substr($codigo, 0, 16);
						$niv9 = 9;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c10 = substr($codigo, 0, 18);
						$niv10 = 10;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c11 = substr($codigo, 0, 20);
						$niv11 = 11;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c12 = substr($codigo, 0, 22);
						$niv12 = 12;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c13 = substr($codigo, 0, 24);
						$niv13 = 13;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c14 = substr($codigo, 0, 26);
						$niv14 = 14;

						//---------------------------- calculo codigo y nivel para padre nivel 3 ----------------------------
						$c15 = substr($codigo, 0, 28);
						$niv15 = 15; //aumentar un nivel 

						// ------------------- verificar que el cod pptal no existe en la empresa actual --
						$sql = "SELECT * from car_ppto_gas where cod_pptal='$cod_pptal' and id_emp='$idxx'";
						$result = $connectionxx->query($sql);

						if ($result->num_rows == 0) {

							//------ verifico que exista el padre ---
							$sql1 = "SELECT * from car_ppto_gas where cod_pptal = '$c15' and nivel = '15' and id_emp='$idxx'";
							$result1 = $connectionxx->query($sql1);

							if ($result1->num_rows > 1) {
								echo "<br><br>
				<center class='Estilo4'>
				<b>El codigo presupuestal que intenta grabar NO TIENE CUENTA MAYOR ASIGNADA 15<br><br>
				<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion
				</center>";
							} else {

								//--------- INSERCION DEL NUEVO COD_PPTAL -----

								$sql = "INSERT INTO 
			        car_ppto_gas ( ano , id_emp, padre , cod_pptal , nom_rubro , tip_dato , nivel , ppto_aprob , proc_rec ,                    situacion, afectado, pac, definitivo, inversion, opc1, vigencia ) 
			     	VALUES ( '$ano', '$id_emp', '$padre', '$cod_pptal', '$nom_rubro', '$tip_dato', '$nivel',                    
					'$ppto_aprob', '$proc_rec', '$situacion', '$afectado', 'NO', '$ppto_aprob', '$inversion', '$opc1', '$vigencia')";
								$connectionxx->query($sql);
							}
						} else {
							echo "<br><br><center class='Estilo4'><b>El codigo presupuestal que intenta grabar ya existe en la Base de Datos<br><br>
			<a href='consulta_ppto_gas.php'>Consulte el Plan Presupuestal de Ingresos</a> y Verifique su Informacion</center>";
						} // aumentar el codigo al comparar padres


						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 16 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$padre' AND nivel=$nivel AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 15 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c15' AND nivel = '$niv15' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 15 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c14' AND nivel=$niv15 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 14 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c14' AND nivel = '$niv14' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 14 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c13' AND nivel=$niv14 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 13 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c13' AND nivel = '$niv13' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	 
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 13 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c12' AND nivel=$niv13 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 12 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c12' AND nivel = '$niv12' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 12 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c11' AND nivel=$niv12 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 11 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c11' AND nivel = '$niv11' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 11 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c10' AND nivel=$niv11 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 10 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c10' AND nivel = '$niv10' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 10 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c9' AND nivel=$niv10 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 9 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c9' AND nivel =	'$niv9' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 9 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c8' AND nivel=$niv9 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 8 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c8' AND nivel =	'$niv8' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 8 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c7' AND nivel=$niv8 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 7 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c7' AND nivel =	'$niv7' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 7 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c6' AND nivel=$niv7 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 6 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c6' AND nivel =	'$niv6' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 6 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c5' AND nivel=$niv6 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 5 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c5' AND nivel =	'$niv5' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 5 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c4' AND nivel=$niv5 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 4 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c4' AND nivel =	'$niv4' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);
						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 4 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre='$c3' AND nivel=$niv4 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 3 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado ='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '$c3' AND nivel =	'$niv3' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//---------------------------------------------------	  
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 3 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas WHERE 
			padre='$c2' AND nivel=$niv3 AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE  - NIVEL 2 -  -----
						$sqlB = "UPDATE car_ppto_gas SET afectado = '1', definitivo='$nuevo_total' WHERE 
			cod_pptal = '$c2' AND nivel = '$niv2' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//-----------------------------------------------------------		
						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 1 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '2' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 1 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '2'	AND id_emp = '$idxx'";
						$connectionxx->query($sqlB);

						//--------- SUMO TODOS LOS REGISTROS DE NIVEL 2 opcion cuando empiezan en 0 -----
						$link = new mysqli($server, $dbuser, $dbpass, $database);
						$resulta =$connectionxx->query("SELECT SUM(definitivo) AS TOTAL from car_ppto_gas 
			WHERE padre = '0' AND nivel = '2' AND id_emp='$idxx'");
						$row = $resulta->fetch_array();
						$total = $row[0];
						$nuevo_total = $total;
						//--------- ACTUALIZAR PADRE NIVEL 1 CUANDO EMPIEZA CON 0 -----
						$sqlB = "UPDATE car_ppto_gas SET  afectado='1' , definitivo='$nuevo_total'
			WHERE cod_pptal = '0' AND id_emp = '$idxx'";
						$connectionxx->query($sqlB); // cambiar

					}

					break;
					//---------------------		  	    
				default:
					$error = "<center class='Estilo4'><br><br><b>La Extension del Codigo Presupuestal Ingresado Excede al Nivel 16 </b><br>Verifique nuevamente su informacion</center>";
			}
			// printf("%s <br><br></center>",$error); 

		}
	}


?>
	<style type="text/css">
		<!--
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

		.Estilo8 {
			color: #000000;
			font-size: 12px;
			font-weight: bold;
		}

		.Estilo9 {
			color: #FFFFFF
		}
		-->
	</style>
<?php
}
?><title>CONTAFACIL</title>

<body onload="document.forms[0]['a'].focus()">
	<center>
		<form name="a" action="carga_ppto_gas.php">
			<input name="a" type="submit" class="Estilo4" value="Volver" />
		</form>
	</center>
</body>