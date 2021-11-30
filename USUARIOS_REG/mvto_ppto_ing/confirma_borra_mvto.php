<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
?>
	<html>

	<head>
		<title>CONTAFACIL</title>
		<style type="text/css">
			<!--
			a {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 11px;
				color: #666666;
			}

			a:visited {
				color: #990000;
				text-decoration: none;
			}

			a:hover {
				color: #990000;
				text-decoration: underline;
			}

			a:active {
				color: #990000;
				text-decoration: none;
			}

			a:link {
				text-decoration: none;
				color: #990000;
			}

			.Estilo4 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
				font-weight: bold;
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

			.Estilo8 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
			}

			.Estilo8 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
			}

			.Estilo8 {
				color: #FFFFFF
			}

			.Estilo9 {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 10px;
			}

			.Estilo10 {
				color: #990000
			}
		</style>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<script>
			function validar(e) {
				tecla = (document.all) ? e.keyCode : e.which;
				if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
				patron = /\d/; //ver nota 
				te = String.fromCharCode(tecla);
				return patron.test(te);
			}
		</script>



	</head>

	<body>

		<div align="center">
			<?php
			include("../config.php");

			$consecutivo = $_GET['consecutivo'];

			// saco el id de la empresa
			$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
			$sqlxx = "select * from fecha";
			$resultadoxx = $connectionxx->query($sqlxx);
			while ($rowxx = $resultadoxx->fetch_assoc()) {
				$idxx = $rowxx["id_emp"];
			}


			$sqlxxa = "select * from reip_ing where id_emp ='$idxx' and consecutivo ='$consecutivo'";
			$resultadoxxa = $connectionxx->query($sqlxxa);

			while ($rowxxa = $resultadoxxa->fetch_assoc()) {
				$id_manu_reip = $rowxxa["id_manu_reip"];
			}


			$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
			$sq = "select * from reip_ing where id_emp = '$idxx' and consecutivo='$consecutivo' order by cuenta asc ";
			$re = $cx->query($sq);

			printf("
<center>
<br>
<DIV style='background:#DCE9E5; padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px; width:800px;'>
<span class='Estilo4'>
<strong>DATOS  DEL  RECONOCIMIENTO ...::: " . $id_manu_reip . " :::...</strong>
</span>
</DIV>
<BR>
</center>
");

			printf("
<center>

<table width='1000' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='150'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>
<td align='center' width='250'><span class='Estilo4'><b>NOMBRE</b></span></td>
<td align='center' width='250'><span class='Estilo4'><b>TERCERO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>VALOR</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>ELIMINAR</b></span></td>



</tr>


");

			while ($rw = $re->fetch_assoc()) {
				printf(
					"
<span class='Estilo4'>
<tr>
<td align='left'><span class='Estilo9'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo9'>&nbsp; %s </span></td>
<td align='left'><span class='Estilo9'>&nbsp; %s </span></td>
<td align='right'><span class='Estilo9'> %.2f &nbsp;</span></td>


<td align='center'>
<br>
<form method='post' action='borra1.php' onsubmit=\"return confirm('Esta Accion eliminara la Imputacion, Desea Proceder?')\">
<input type='hidden' name='id' value='%s'>
<input type='hidden' name='cuenta' value='%s'>
<input type='hidden' name='consecutivo' value='%s'>
<input type='submit' name='Submit' value='Eliminar' class='Estilo9' />
</form>
</td>





</tr>",
					$rw["cuenta"],
					$rw["nom_rubro"],
					$rw["tercero"],
					$rw["valor"],

					$rw["id"],
					$rw["cuenta"],
					$rw["consecutivo"],

					$rw["id"],
					$rw["cuenta"],
					$rw["consecutivo"],
					$rw["ter_nat"],
					$rw["ter_jur"],
					$rw["des"],
					$rw["valor"],
					$rw["nom_rubro"]

				);
			}

			?>
			<?php
			printf("
</table>
</center>
");
			?>

			<br>
			<br>
			<br>
			<center><a href='mvto.php' target='_parent' class='Estilo10'><B> ...::: CANCELAR PROCESO y/o VOLVER :::...</B> </a></center><BR>
	</body>

	</html>

<?php
}
?>