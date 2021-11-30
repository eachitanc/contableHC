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
	$tip_id2 = $_POST['tip_id2'];
	$num_id2 = $_POST['num_id2'];
	$dv2 = $_POST['dv2'];
	$clase2 = $_POST['clase2'];
	$regimen2 = $_POST['regimen2'];
	$ent_ofi2 = $_POST['ent_ofi2'];
	$raz_soc2 = $_POST['raz_soc2'];
	$nom_com2 = $_POST['nom_com2'];
	$pais2 = $_POST['selecta'];
	$dpto2 = $_POST['selectb'];
	$mpio2 = $_POST['selectc'];
	$dir2 = $_POST['dir2'];
	$tel2 = $_POST['tel2'];
	$fax2 = $_POST['fax2'];
	$em2 = $_POST['email2'];
	$contabilidad2 = $_POST['contabilidad2'];
	$ppto2 = $_POST['ppto2'];
	$tesoreria2 = $_POST['tesoreria2'];
	$almacen2 = $_POST['almacen2'];
	$pri_ape2 = $_POST['pri_ape2'];
	$seg_ape2 = $_POST['seg_ape2'];
	$pri_nom2 = $_POST['pri_nom2'];
	$seg_nom2 = $_POST['seg_nom2'];
	$dir22 = $_POST['dir22'];
	$tel22 = $_POST['tel22'];
	$fax22 = $_POST['fax22'];
	$em22 = $_POST['email22'];
	$interventor = $_POST['interventor'];
	$cree = $_POST['cree'];
	$act_eco = $_POST['act_eco'];

	include('../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from vf";
	$resultadoxx = $cx->query($sqlxx);
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$ax = $rowxx["fecha_ini"];
		$bx = $rowxx["fecha_fin"];
	}
	$sql = "select * from terceros_juridicos where num_id2='$num_id2'";
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
			$sq = "INSERT INTO terceros_juridicos ( id_emp , fecha_reg , tip_id2 , num_id2 , dv2 , clase2 , regimen2 , ent_ofi2 , raz_soc2 , nom_com2 , pais2 , dpto2 , mpio2 , dir2 , tel2 , fax2 , em2 , contabilidad2 , ppto2 , tesoreria2 , almacen2 ,interventor, pri_ape2 , seg_ape2 , pri_nom2 , seg_nom2 , dir22 , tel22 , fax22 , em22) VALUES ( '$id_emp','$fecha_reg','$tip_id2','$num_id2','$dv2','$clase2','$regimen2','$ent_ofi2','$raz_soc2','$nom_com2','$pais2','$dpto2','$mpio2','$dir2','$tel2','$fax2','$em2','$contabilidad2','$ppto2','$tesoreria2','$almacen2','$interventor','$pri_ape2','$seg_ape2','$pri_nom2','$seg_nom2','$dir22','$tel22','$fax22','$em22')";
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