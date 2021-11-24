<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
	//-------saco el id de la empresa
	include('../config.php');
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sql = "SELECT * from fecha";
	$resultado = $cx->query($sql);
	while ($row = $resultado->fetch_assoc()) {
		$id_emp = $row["id_emp"];
		$ano = $row["ano"];
	}

	$fecha_mod_pac = $ano;
	$cod_pptal = $_POST["cod_pptal"];

	$adi_pac_ene = $_POST["adi_pac_ene"];
	$red_pac_ene = $_POST["red_pac_ene"];
	$pac_def_ene = $_POST["pac_def_ene"];
	$pac_uti_ene = $_POST["pac_uti_ene"];
	$sal_pac_ene = $_POST["sal_pac_ene"];

	$adi_pac_feb = $_POST["adi_pac_feb"];
	$red_pac_feb = $_POST["red_pac_feb"];
	$pac_def_feb = $_POST["pac_def_feb"];
	$pac_uti_feb = $_POST["pac_uti_feb"];
	$sal_pac_feb = $_POST["sal_pac_feb"];

	$adi_pac_mar = $_POST["adi_pac_mar"];
	$red_pac_mar = $_POST["red_pac_mar"];
	$pac_def_mar = $_POST["pac_def_mar"];
	$pac_uti_mar = $_POST["pac_uti_mar"];
	$sal_pac_mar = $_POST["sal_pac_mar"];

	$adi_pac_abr = $_POST["adi_pac_abr"];
	$red_pac_abr = $_POST["red_pac_abr"];
	$pac_def_abr = $_POST["pac_def_abr"];
	$pac_uti_abr = $_POST["pac_uti_abr"];
	$sal_pac_abr = $_POST["sal_pac_abr"];

	$adi_pac_may = $_POST["adi_pac_may"];
	$red_pac_may = $_POST["red_pac_may"];
	$pac_def_may = $_POST["pac_def_may"];
	$pac_uti_may = $_POST["pac_uti_may"];
	$sal_pac_may = $_POST["sal_pac_may"];

	$adi_pac_jun = $_POST["adi_pac_jun"];
	$red_pac_jun = $_POST["red_pac_jun"];
	$pac_def_jun = $_POST["pac_def_jun"];
	$pac_uti_jun = $_POST["pac_uti_jun"];
	$sal_pac_jun = $_POST["sal_pac_jun"];

	$adi_pac_jul = $_POST["adi_pac_jul"];
	$red_pac_jul = $_POST["red_pac_jul"];
	$pac_def_jul = $_POST["pac_def_jul"];
	$pac_uti_jul = $_POST["pac_uti_jul"];
	$sal_pac_jul = $_POST["sal_pac_jul"];

	$adi_pac_ago = $_POST["adi_pac_ago"];
	$red_pac_ago = $_POST["red_pac_ago"];
	$pac_def_ago = $_POST["pac_def_ago"];
	$pac_uti_ago = $_POST["pac_uti_ago"];
	$sal_pac_ago = $_POST["sal_pac_ago"];

	$adi_pac_sep = $_POST["adi_pac_sep"];
	$red_pac_sep = $_POST["red_pac_sep"];
	$pac_def_sep = $_POST["pac_def_sep"];
	$pac_uti_sep = $_POST["pac_uti_sep"];
	$sal_pac_sep = $_POST["sal_pac_sep"];

	$adi_pac_oct = $_POST["adi_pac_oct"];
	$red_pac_oct = $_POST["red_pac_oct"];
	$pac_def_oct = $_POST["pac_def_oct"];
	$pac_uti_oct = $_POST["pac_uti_oct"];
	$sal_pac_oct = $_POST["sal_pac_oct"];

	$adi_pac_nov = $_POST["adi_pac_nov"];
	$red_pac_nov = $_POST["red_pac_nov"];
	$pac_def_nov = $_POST["pac_def_nov"];
	$pac_uti_nov = $_POST["pac_uti_nov"];
	$sal_pac_nov = $_POST["sal_pac_nov"];

	$adi_pac_dic = $_POST["adi_pac_dic"];
	$red_pac_dic = $_POST["red_pac_dic"];
	$pac_def_dic = $_POST["pac_def_dic"];
	$pac_uti_dic = $_POST["pac_uti_dic"];
	$sal_pac_dic = $_POST["sal_pac_dic"];

	$adi_rezago = $_POST["adi_rezago"];
	$red_rezago = $_POST["red_rezago"];
	$def_rezago = $_POST["def_rezago"];
	$uti_rezago = $_POST["uti_rezago"];
	$sal_rezago = $_POST["sal_rezago"];

	$suma_adi = $_POST["suma_adi"];
	$suma_red = $_POST["suma_red"];
	//$suma_def=$_POST["suma_def"];
	//$suma_uti=$_POST["suma_uti"];

	/*printf('%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>%s<br>',
$adi_pac_ene,$red_pac_ene,$pac_def_ene,$pac_uti_ene,$sal_pac_ene, $adi_pac_feb,$red_pac_feb,$pac_def_feb,$pac_uti_feb,$sal_pac_feb,$adi_pac_mar,$red_pac_mar,$pac_def_mar,$pac_uti_mar,$sal_pac_mar,$adi_pac_abr,$red_pac_abr,$pac_def_abr,$pac_uti_abr,$sal_pac_abr,$adi_pac_may,$red_pac_may,$pac_def_may,$pac_uti_may,$sal_pac_may,$adi_pac_jun,$red_pac_jun,$pac_def_jun,$pac_uti_jun,$sal_pac_jun,$adi_pac_jul,$red_pac_jul,$pac_def_jul,$pac_uti_jul,$sal_pac_jul,$adi_pac_ago,$red_pac_ago,$pac_def_ago,$pac_uti_ago,$sal_pac_ago,				$adi_pac_sep,$red_pac_sep,$pac_def_sep,$pac_uti_sep,$sal_pac_sep,$adi_pac_oct,$red_pac_oct,$pac_def_oct,$pac_uti_oct,$sal_pac_oct,
$adi_pac_nov,$red_pac_nov,$pac_def_nov,$pac_uti_nov,$sal_pac_nov,$adi_pac_dic,$red_pac_dic,$pac_def_dic,$pac_uti_dic,$sal_pac_dic,
$suma_adi,$suma_red,$adi_rezago,$red_rezago,$def_rezago,$uti_rezago,$sal_rezago);	*/


	$consultax = $cx->query("SELECT * from vf ");
	while ($rowx = $consultax->fetch_assoc()) {
		$ax = $rowx["fecha_ini"];
		$bx = $rowx["fecha_fin"];
	}

	if ($fecha_mod_pac > $bx or $fecha_mod_pac < $ax) {
		printf("<center class='Estilo4'>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
		<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='consulta_ppto_gas.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
		</center>");
	} else {




		$sSQL = "UPDATE pac_gastos set 
		adi_pac_ene='$adi_pac_ene' , red_pac_ene='$red_pac_ene' , pac_def_ene='$pac_def_ene' , pac_uti_ene='$pac_uti_ene' , sal_pac_ene='$sal_pac_ene', 
		adi_pac_feb='$adi_pac_feb' , red_pac_feb='$red_pac_feb' , pac_def_feb='$pac_def_feb' , pac_uti_feb='$pac_uti_feb' , sal_pac_feb='$sal_pac_feb',
		adi_pac_mar='$adi_pac_mar' , red_pac_mar='$red_pac_mar' , pac_def_mar='$pac_def_mar' , pac_uti_mar='$pac_uti_mar' , sal_pac_mar='$sal_pac_mar',
		adi_pac_abr='$adi_pac_abr' , red_pac_abr='$red_pac_abr' , pac_def_abr='$pac_def_abr' , pac_uti_abr='$pac_uti_abr' , sal_pac_abr='$sal_pac_abr' ,
		adi_pac_may='$adi_pac_may' , red_pac_may='$red_pac_may' , pac_def_may='$pac_def_may' , pac_uti_may='$pac_uti_may' , sal_pac_may='$sal_pac_may' ,
		adi_pac_jun='$adi_pac_jun' , red_pac_jun='$red_pac_jun' , pac_def_jun='$pac_def_jun' , pac_uti_jun='$pac_uti_jun' , sal_pac_jun='$sal_pac_jun' ,
		adi_pac_jul='$adi_pac_jul' , red_pac_jul='$red_pac_jul' , pac_def_jul='$pac_def_jul' , pac_uti_jul='$pac_uti_jul' , sal_pac_jul='$sal_pac_jul' ,
		adi_pac_ago='$adi_pac_ago' , red_pac_ago='$red_pac_ago' , pac_def_ago='$pac_def_ago' , pac_uti_ago='$pac_uti_ago' , sal_pac_ago='$sal_pac_ago' ,
		adi_pac_sep='$adi_pac_sep' , red_pac_sep='$red_pac_sep' , pac_def_sep='$pac_def_sep' , pac_uti_sep='$pac_uti_sep' , sal_pac_sep='$sal_pac_sep' ,
		adi_pac_oct='$adi_pac_oct' , red_pac_oct='$red_pac_oct' , pac_def_oct='$pac_def_oct' , pac_uti_oct='$pac_uti_oct' , sal_pac_oct='$sal_pac_oct' , 
		adi_pac_nov='$adi_pac_nov' , red_pac_nov='$red_pac_nov' , pac_def_nov='$pac_def_nov' , pac_uti_nov='$pac_uti_nov' , sal_pac_nov='$sal_pac_nov' ,
		adi_pac_dic='$adi_pac_dic' , red_pac_dic='$red_pac_dic' , pac_def_dic='$pac_def_dic' , pac_uti_dic='$pac_uti_dic' , sal_pac_dic='$sal_pac_dic' ,
		adi_rezago='$adi_rezago' , red_rezago='$red_rezago' , def_rezago='$def_rezago' , uti_rezago='$uti_rezago' , sal_rezago='$sal_rezago' , suma_adi='$suma_adi' , suma_red='$suma_red'
		
		
		WHERE cod_pptal='$cod_pptal' and id_emp='$id_emp'";
		$res = $cx->query($sSQL);

		printf("<center class='Estilo4'>DATOS ALMACENADOS CON EXITO<br><br>");
		printf("<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align='center'><a href='adi_red_pac_ing.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div></center>");
	}


	?>

<?php
}
?><title>CONTAFACIL</title>
<style type="text/css">
	.Estilo2 {
		font-size: 9px
	}

	.Estilo4 {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		color: #333333;
	}

	a {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 11px;
		color: #666666;
	}

	a:link {
		text-decoration: none;
	}

	a:visited {
		text-decoration: none;
		color: #666666;
	}

	a:hover {
		text-decoration: underline;
		color: #666666;
	}

	a:active {
		text-decoration: none;
		color: #666666;
	}

	.Estilo7 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 9px;
		color: #666666;
	}
</style>
<style>
	.fc_main {
		background: #FFFFFF;
		border: 1px solid #000000;
		font-family: Verdana;
		font-size: 10px;
	}

	.fc_date {
		border: 1px solid #D9D9D9;
		cursor: pointer;
		font-size: 10px;
		text-align: center;
	}

	.fc_dateHover,
	TD.fc_date:hover {
		cursor: pointer;
		border-top: 1px solid #FFFFFF;
		border-left: 1px solid #FFFFFF;
		border-right: 1px solid #999999;
		border-bottom: 1px solid #999999;
		background: #E7E7E7;
		font-size: 10px;
		text-align: center;
	}

	.fc_wk {
		font-family: Verdana;
		font-size: 10px;
		text-align: center;
	}

	.fc_wknd {
		color: #FF0000;
		font-weight: bold;
		font-size: 10px;
		text-align: center;
	}

	.fc_head {
		background: #000066;
		color: #FFFFFF;
		font-weight: bold;
		text-align: left;
		font-size: 11px;
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
<style type="text/css">
	.Estilo8 {
		font-weight: bold
	}

	.Estilo9 {
		font-weight: bold
	}

	.Estilo10 {
		font-weight: bold
	}

	.Estilo11 {
		font-weight: bold
	}
</style>