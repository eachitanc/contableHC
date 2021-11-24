<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	//-------saco el id de la empresa
	include('config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sql = "SELECT * from fecha";
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


	//------------NUEVOS CAMPOS
	$cod_fut = $_POST['cod_fut'];
	$libre_con_fut = $_POST['libre_con_fut'];
	$acto_fut = $_POST['acto_fut'];
	$num_acto_fut = $_POST['num_acto_fut'];
	$porcentaje_fut = $_POST['porcentaje_fut'];
	//	calcular valor = (ppto_aprob * porcentaje_fut)/100 y guardar en ...
	$sql2 = "SELECT * from car_ppto_ing where cod_pptal = '$cod_pptal' and id_emp ='$id_emp'";
	$resultado2 = $cx->query($sql2);
	while ($row2 = $resultado2->fetch_assoc()) {
		$definitivo = $row2["definitivo"];
	}
	$vr_fut = ($definitivo * $porcentaje_fut) / 100;
	//---------

	$cod_cgr = $_POST['cod_cgr'];
	$cod_rec = $_POST['cod_rec'];
	$oer = $_POST['oer'];
	$cda = $_POST['cda'];
	$ent_recip = $_POST['ent_recip'];

	/*printf('id_emp = %s <br>',$id_emp);
printf('ppto_aprob = %d <br>',$ppto_aprob);

printf('%s <br> %s <br>%s <br>%s <br>%s <br>%s <br>%s <br>%d <br>%s <br>%s <br>%s <br>%s <br>%s <br>'
      ,$cod_pptal,$nom_rubro,$cod_fut,$libre_con_fut,$acto_fut,$num_acto_fut,$porcentaje_fut,$vr_fut,$cod_cgr
	  ,$cod_rec,$oer,$cda,$ent_recip);			 			*/



	$sSQL = "UPDATE car_ppto_ing Set cod_fut='$cod_fut' , libre_con_fut='$libre_con_fut' , acto_fut='$acto_fut', 
	   num_acto_fut='$num_acto_fut', porcentaje_fut='$porcentaje_fut', 
	   vr_fut='$vr_fut', cod_cgr='$cod_cgr', cod_rec='$cod_rec', 
	   oer='$oer', cda='$cda', ent_recip='$ent_recip'  Where cod_pptal = '$cod_pptal' and id_emp ='$id_emp'";
	$cx->query($sSQL);

	printf("<center class='Estilo4'>DATOS ALMACENADOS CON EXITO<br><br>");
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