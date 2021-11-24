<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {

	include("../config.php");

	$id = $_POST['id'];

	// saco el id de la empresa
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$idxx = $rowxx["id_emp"];
		$id_emp = $rowxx["id_emp"];
	}

	new mysqli($server, $dbuser, $dbpass, $database);

	$sSQL2 = "UPDATE car_ppto_gas Set pac='NO' , afectado_otros='0' Where cod_pptal = '$id' and id_emp ='$id_emp'";
	$connectionxx->query($sSQL2);

	new mysqli($server, $dbuser, $dbpass, $database);

	$sSQL = "DELETE From pac_gastos Where cod_pptal='$id' and id_emp ='$idxx'";
	$connectionxx->query($sSQL);

	printf("
<center class='Estilo4'><br><br><b>PAC ELIMINADO CON EXITO</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='consulta_ppto_gas.php' target='_parent'>VOLVER</a>
</div>
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