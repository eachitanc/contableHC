<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	$id_emp = $_POST['id_emp'];
	$id = $_POST['id'];
	$cod_pptal = $_POST['cod_pptal'];
	include('../../config.php');
	$db = new mysqli($server, $dbuser, $dbpass, $database);
	$sql = "SELECT nom_rubro from car_ppto_ing where cod_pptal ='$cod_pptal' ";
	$resultado = $db->query($sql);
	while ($row = $resultado->fetch_assoc()) {
		$nom_rubro = $row["nom_rubro"];
	}
	$db=null;

	$fecha_adi = $_POST['fecha_adi'];
	$ppto_aprob = $_POST['ppto_aprob'];
	$tipo_acto = $_POST['tipo_acto'];
	$num_acto = $_POST['num_acto'];
	$valor_adi = $_POST['valor_adi'];
	$concepto_adi = $_POST['concepto_adi'];
	$definitivo = $_POST['definitivo'];

	//printf("%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>",$id_emp,$cod_pptal,$nom_rubro,$fecha_adi,$ppto_aprob,$tipo_acto,$num_acto,$valor_adi,$concepto_adi);
	// valido que la reduccion no sea mayor al definitivo
	if ($valor_adi > $definitivo) {
		//---
		printf("
<div align='center'>
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:300px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><span class='Estilo4'><b>ERROR<b></span><br><BR>
              <span class='Estilo4'>No puede Ejecutar esta Accion<br>
            El valor a Reducir es Mayor al valor Definitivo de la Cuenta </span><br><br><a href='creditos.php' target='_parent' class='Estilo4'>VOLVER </a> </div>
          </div>
        </div>
      </div>
");
		//---
	} else {

		include('../../config.php');
		$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$sqlxx = "SELECT * from vf";
		$resultadoxx = $cx->query($sqlxx);
		while ($rowxx = $resultadoxx->fetch_assoc()) {
			$ax = $rowxx["fecha_ini"];
			$bx = $rowxx["fecha_fin"];
		}


		if ($fecha_adi > $bx or $fecha_adi < $ax) {
			printf("<center class='Estilo4'>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='creditos.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
		</center>");
		} else {

			$sq = "UPDATE creditos_ing  set id_emp='$id_emp' , cod_pptal='$cod_pptal' , nom_rubro='$nom_rubro' , fecha_adi= '$fecha_adi' , ppto_aprob= '$ppto_aprob' , tipo_acto='$tipo_acto' , num_acto= '$num_acto' , valor_adi='$valor_adi' , concepto_adi='$concepto_adi' where id ='$id'";

			$res = $cx->query($sq);


			//printf("%s <br><br></center>", $error);



			printf("<center class='Estilo4'>DATOS ALMACENADOS CON EXITO<br><br>");
			printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080;    	width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='creditos.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
		}
	}
	?>
<?php
}
?><title>CONTAFACIL</title>
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
	-->
</style>

<style type="text/css">
	table.bordepunteado1 {
		border-style: solid;
		border-collapse: collapse;
		border-width: 2px;
		border-color: #004080;
	}
</style>