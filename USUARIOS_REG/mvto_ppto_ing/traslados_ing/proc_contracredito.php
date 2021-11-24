<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	$id_emp = $_POST['id_emp'];
	$cod_pptal = $_POST['cod_pptal'];

	$fecha_adi = $_POST['fecha_adi'];
	$ppto_aprob = isset($_POST['ppto_aprob']) ? $_POST['ppto_aprob'] : 0;
	$tipo_acto = $_POST['tipo_acto'];
	$num_acto = $_POST['num_acto'];
	$valor_adi = $_POST['valor_adi'];
	$concepto_adi = $_POST['concepto_adi'];
	$definitivo = $_POST['definitivo'];




	include('../../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "SELECT * from vf";
	$resultadoxx = $cx->query($sqlxx);
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$ax = $rowxx["fecha_ini"];
		$bx = $rowxx["fecha_fin"];
	}
	$res = $cx->query("SELECT nom_rubro from car_ppto_ing where cod_pptal='$cod_pptal'");
	while ($rw = $res->fetch_assoc()) {
		$nom_rubro = $rw["nom_rubro"];
	}

	if ($fecha_adi > $bx or $fecha_adi < $ax) {
		printf("<center class='Estilo4'>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='contracredito.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
		</center>");
	} else {

		$sq = "INSERT INTO contracreditos_ing 
			( id_emp , cod_pptal , nom_rubro , fecha_adi , ppto_aprob , 
			tipo_acto , num_acto , valor_adi , concepto_adi) 
			VALUES ( '2' , '$cod_pptal' , '$nom_rubro' , '$fecha_adi' , 
			'$ppto_aprob' , '$tipo_acto' , '$num_acto' , '$valor_adi' , '$concepto_adi')";

		$res = $cx->query($sq);
	}
	//printf("%s <br><br></center>", $error);



	printf("<BR><BR><center class='Estilo4'>CONTRACREDITO ALMACENADO CON EXITO<br><br>");
	printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080;    	width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='contracredito.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
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