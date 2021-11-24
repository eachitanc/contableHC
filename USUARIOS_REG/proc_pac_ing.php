<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
} else {
	//-------saco el id de la empresa
	include('config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sql = "select * from fecha";
	$resultado = $cx->query($sql);
	while ($row = $resultado->fetch_assoc()) {
		$id_emp = $row["id_emp"];
		$ano = $row["ano"];
	}

	$fecha_reg = $ano;
	$cod_pptal = $_POST['cod_pptal'];
	$nom_rubro = $_POST['nom_rubro'];
	$definitivo = $_POST['definitivo'];
	$meses = $_POST['meses'];
	$enero = $_POST['enero'];
	$febrero = $_POST['febrero'];
	$marzo = $_POST['marzo'];
	$abril = $_POST['abril'];
	$mayo = $_POST['mayo'];
	$junio = $_POST['junio'];
	$julio = $_POST['julio'];
	$agosto = $_POST['agosto'];
	$septiembre = $_POST['septiembre'];
	$octubre = $_POST['octubre'];
	$noviembre = $_POST['noviembre'];
	$diciembre = $_POST['diciembre'];
	$rezago = $_POST['rezago'];
	$total = $_POST['total'];
	$diferencia = $_POST['diferencia'];

	$pac = 'SI';
	$afectado_otros = '1';


	$consultax = $cx->query("select * from vf ");
	while ($rowx = $consultax->fetch_assoc()) {
		$ax = $rowx["fecha_ini"];
		$bx = $rowx["fecha_fin"];
	}

	if ($fecha_reg > $bx or $fecha_reg < $ax) {
		printf("<center class='Estilo4'>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='consulta_ppto_ing.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
		</center>");
	} else {

		$sq = "INSERT INTO pac_ingresos ( 	id_emp , fecha_reg , cod_pptal , nom_rubro , definitivo , meses ,
									enero , febrero , marzo , abril , mayo , junio , julio , agosto ,
									septiembre , octubre , noviembre , diciembre , rezago , total , diferencia ) 
									VALUES ( '$id_emp', '$fecha_reg', '$cod_pptal', '$nom_rubro', '$definitivo', '$meses'
									, '$enero', '$febrero', '$marzo', '$abril', '$mayo'
									, '$junio', '$julio', '$agosto', '$septiembre', '$octubre', '$noviembre'
									, '$diciembre', '$rezago', '$total', '$diferencia')";

		$res = $cx->query($sq);

		$cx = new mysqli($server, $dbuser, $dbpass, $database);

		$sSQL = "Update car_ppto_ing Set pac='$pac' , afectado_otros='$afectado_otros' Where cod_pptal = '$cod_pptal' and id_emp ='$id_emp'";
		$cx->query($sSQL);

		printf("<center class='Estilo4'>DATOS ALMACENADOS CON EXITO<br><br>");
		printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='consulta_ppto_ing.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
	}

?>
<?php
}
?>
<style type="text/css">
	body {
		background-color: #FFFFFF;
	}

	.Estilo1 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 10px;
		font-weight: bold;
	}

	.Estilo4 {
		font-size: 10px;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		color: #333333;
	}

	a:link {
		color: #990000;
		text-decoration: none;
	}

	a:visited {
		text-decoration: none;
		color: #990000;
	}

	a:hover {
		text-decoration: underline;
		color: #990000;
	}

	a:active {
		text-decoration: none;
		color: #990000;
	}

	.Estilo6 {
		color: #FFFFFF
	}
</style>
<title>CONTAFACIL</title>