<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
?>
	<?php

	include('../config.php');
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);

	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$id_emp = $rowxx["id_emp"];
		$ano = $rowxx["ano"];
	}


	$id_emp = $id_emp;
	$fecha_reg = $ano;
	$tipo_id = $_POST['tipo_id'];
	$num_id = $_POST['num_id'];
	$dv = $_POST['dv'];
	$clase = $_POST['clase'];
	$regimen = $_POST['regimen'];
	$ent_ofi = $_POST['ent_ofi'];
	$pri_ape = $_POST['pri_ape'];
	$seg_ape = $_POST['seg_ape'];
	$pri_nom = $_POST['pri_nom'];
	$seg_nom = $_POST['seg_nom'];
	$nom_com = $_POST['nom_com'];
	$pais = $_POST['select'];
	$dpto = $_POST['select2'];
	$mpio = $_POST['select3'];
	$dir = $_POST['dir'];
	$tel = $_POST['tel'];
	$fax = $_POST['fax'];
	$em = $_POST['email'];
	$contabilidad = $_POST['contabilidad'];
	$ppto = isset($_POST['ppto']) ? $_POST['ppto'] : '';
	$tesoreria = $_POST['tesoreria'];
	$almacen = isset($_POST['almacen']) ? $_POST['almacen'] : '';
	$interventor = isset($_POST['interventor']) ? $_POST['interventor'] : '';
	$monto = $_POST['monto'];
	$embargo = isset($_POST['embargo']) ? $_POST['embargo'] : '';




	include('../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from vf";
	$resultadoxx = $cx->query($sqlxx);
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$ax = $rowxx["fecha_ini"];
		$bx = $rowxx["fecha_fin"];
	}

	$sql = "select * from terceros_naturales where num_id='$num_id'";
	$result = $cx->query($sql) or die();
	if ($result->num_rows == 0) {
		if ($fecha_reg > $bx or $fecha_reg < $ax) {
			printf("<br><br><center class='Estilo4'>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
			<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
			  <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
				<div align='center'><a href='terceros.php' target='_parent'>VOLVER </a> </div>
			  </div>
			</div>
			</center>");
		} else {
			$sq = "INSERT INTO terceros_naturales ( id_emp , fecha_reg , tipo_id , num_id , dv , clase , regimen , ent_ofi , pri_ape , seg_ape , pri_nom , seg_nom , nom_com , pais , dpto , mpio , dir , tel , fax , email , contabilidad , ppto , tesoreria , almacen,interventor,embargo,monto) VALUES ( '$id_emp' , '$fecha_reg' , '$tipo_id' , '$num_id' , '$dv' , '$clase' , '$regimen' , '$ent_ofi' , '$pri_ape' , '$seg_ape' , '$pri_nom' , '$seg_nom' , '$nom_com' , '$pais' , '$dpto' , '$mpio' , '$dir' , '$tel' , '$fax' , '$em' , '$contabilidad' , '$ppto' , '$tesoreria' , '$almacen','$interventor','$embargo','$monto')";

			$res = $cx->query($sq);





			printf("<br><br><center class='Estilo4'>DATOS ALMACENADOS CON EXITO<br><br>");
			printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080;    	width:150px'>
			  <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
				<div align='center'><a href='terceros.php' target='_parent'>VOLVER </a> </div>
			  </div>
			</div></center>");
		}
	} else {

		printf("<br><br><center class='Estilo4'>EL NUMERO DE IDENTIFICACION YA EXISTE<BR><BR>VERIFIQUE NUEVAMENTE SU INFORMACION<br><br>");
		printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080;    	width:150px'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
		<div align='center'><a href='terceros.php' target='_parent'>VOLVER </a> </div>
		</div>
		</div></center>");
	}




	?>
<?php
}
?>
<title>CONTAFACIL</title>
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