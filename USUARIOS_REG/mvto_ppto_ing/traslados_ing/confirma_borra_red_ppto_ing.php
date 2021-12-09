<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../../login.php");
	exit;
} else {
?>
	<?php
	$id_emp = isset($_POST['id_emp']) ? $_POST['id_emp'] : '';
	$id = $_POST['id']; //echo $id;
	$fecha_adi = $_POST['fecha_a'];
	$error='';
	//printf("%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>	
	include('../../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from vf";
	$resultadoxx = $cx->query($sqlxx);
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$ax = $rowxx["fecha_ini"];
		$bx = $rowxx["fecha_fin"];
	}
	if ($fecha_adi > $bx or $fecha_adi < $ax) {
		printf("<center class='Estilo4'>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
		</center>");
	} else {
		$sq = "Delete From red_ppto_ing Where id='$id'";
		$res = $cx->query($sq);
		printf("%s <br><br></center>", $error);
		printf("<center class='Estilo4'>REGISTRO ELIMINADO CON EXITO<br><br>");
		printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080;    	width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='red_ppto_ing.php' target='_parent'>VOLVER </a> </div>
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