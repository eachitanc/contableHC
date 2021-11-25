<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
?>
	<?php


	//-------saco el id de la empresa
	include('../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sql = "select * from fecha";
	$resultado = $cx->query($sql);
	while ($row = $resultado->fetch_assoc()) {
		$id_emp = $row["id_emp"];
	}
	// campos de comparacion
	$cod_pptal = $_POST['cod_pptal'];
	$texto = $_POST['nom_rubro'];
	//sacar todos las letras y puntos de una cadena
	//$texto=eregi_replace('[[:alpha:]/.]', '', $texto);
	//sacar todos los numeros y guiones de una cadena
	$texto = preg_replace('[[0-9]/-]', '', $texto);
	$nom_rubro = $texto;


	$cod_fut = $_POST['cod_fut'];
	$fuentes_recursos = $_POST['fuentes_recursos'];
	$unidad_ejecutora = $_POST['unidad_ejecutora'];
	$situacion = $_POST['situacion'];
	//-----------------
	$cod_cgr = $_POST['cod_cgr'];
	$cod_rec = $_POST['cod_rec'];
	$oer = $_POST['oer'];
	$cda = $_POST['cda'];
	$vigencia_gasto = $_POST['vigencia_gasto'];
	$finalidad_gasto = $_POST['finalidad_gasto'];
	$uni_ejec_cgr = $_POST['uni_ejec_cgr'];
	$ent_recip = $_POST['ent_recip'];


	$cx = new mysqli($server, $dbuser, $dbpass, $database);

	$sSQL = "Update cxp Set cod_fut='$cod_fut' , fuentes_recursos='$fuentes_recursos' , unidad_ejecutora='$unidad_ejecutora' , situacion='$situacion' ,  cod_cgr='$cod_cgr' , cod_rec='$cod_rec' , oer='$oer' , cda='$cda' , vigencia_gasto='$vigencia_gasto' , finalidad_gasto='$finalidad_gasto' , uni_ejec_cgr='$uni_ejec_cgr', ent_recip='$ent_recip'  Where cod_pptal = '$cod_pptal' and id_emp ='$id_emp'";
	$cx->query($sSQL);

	printf("<br><br><center class='Estilo4'>DATOS ALMACENADOS CON EXITO<br><br>");
	printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='equiv_pptal_ing_aa.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");

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