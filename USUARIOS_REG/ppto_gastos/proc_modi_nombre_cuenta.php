<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	include('../config.php');
	$connection = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

	$cxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sxx = "SELECT * from fecha";
	$rxx = $cxx->query($sxx);

	while ($rowxxx = $rxx->fetch_assoc()) {

		$idxx = $rowxxx["id_emp"];
	}


	$cod_pptal = $_POST['cod_pptal'];
	$nombre = $_POST['nombre'];

	//convierto a minusculas el nombre de las cuentas tipo DETALLE	
	$sx = "SELECT tip_dato from car_ppto_gas where id_emp='$idxx' AND cod_pptal ='$cod_pptal'";
	$rx = $cxx->query($sx);
	while ($r = $rx->fetch_assoc()) {
		$td = $r["tip_dato"];
	}

	if ($td == 'M') {
	} else {
		$nombre = strtolower($nombre);
	}

	$proc_rec = $_POST['proc_rec'];
	$situacion = $_POST['situacion'];
	//$inversion=$_POST['inversion']; 
	$opc1 = $_POST['opc1'];
	$vigencia = isset($_POST['vigencia']) ? $_POST['vigencia'] : '';
	$futura = isset($_POST['futura']) ? $_POST['futura'] : '';





	$cx = new mysqli($server, $dbuser, $dbpass, $database);

	$sSQL = "Update car_ppto_gas Set 	nom_rubro='$nombre', proc_rec='$proc_rec', situacion='$situacion', opc1='$opc1', vigencia='$vigencia',vg_futura ='$futura'  Where cod_pptal = '$cod_pptal' and id_emp ='$idxx'";
	$cx->query($sSQL);


	printf("<center class='Estilo4'>DATOS ACTUALIZADOS CON EXITO<br><br>");
	printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='consulta_ppto_gas.php' target='_parent'>VOLVER </a> </div>
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