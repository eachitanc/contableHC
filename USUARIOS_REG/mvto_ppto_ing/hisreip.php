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

			.Estilo8 {
				color: #990000
			}
		</style>
		<script type="text/javascript">
			//Actualizar una vez al cargar p�gina
			//script por tunait!
			//ver condiciones de uso en http://javascript.tunait.com/
			window.onunload = sale;
			var valor;
			if (document.cookie) {
				galleta = unescape(document.cookie)
				galleta = galleta.split(';')
				for (m = 0; m < galleta.length; m++) {
					if (galleta[m].split('=')[0] == "recarga") {
						valor = galleta[m].split('=')[1]
						break;
					}
				}
				if (valor == "sip") {
					document.cookie = "recarga=nop";
					window.onunload = function() {};
					document.location.reload()
				} else {
					window.onunload = sale
				}
			}

			function sale() {
				document.cookie = "recarga=sip"
			}
		</script>
		<script>
			function cerrarVentana() {
				window.opener.location.reload(); //Actualiza el padre
				window.close(); //Cierra la hija.
			}
		</script>
	</head>

	<body>
		<center>
			<form>
				<input type=button value='Cerrar Ventana' onclick='cerrarVentana()'>
			</form>
		</center>

		<?php
		$var = $_GET['consecutivo'];

		include('../config.php');
		$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$sqlxx = "select * from reip_ing where consecutivo = '$var' order by fecha_reg asc";
		$resultadoxx = $connectionxx->query($sqlxx);


		printf("
<center>
<table width='750' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
     <td width='150'></td>
    <td width='150'></td>
    <td width='150'></td>
    <td width='150'></td>
    <td width='150'></td>
</tr>

<tr bgcolor='#DCE9E5'>
    <td colspan='5' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>HISTORICO DEL DCTO</b></center>
	</div>
	</td>
</tr>

<tr bgcolor='#DCE9E5'>
    <td colspan='5' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>RECONOCIMIENTO DE INGRESOS PRESUPUESTALES</b></center>
	</div>
	</td>
</tr>

<tr bgcolor='#DCE9E5'>
    
    <td width='150'></td>
	
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>IMPU. PPTAL</b></center>
	</div>
	</td>
	
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>VALOR</b></center>
	</div>
	</td>
	
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>FECHA</b></center>
	</div>
	</td>
	
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>INFORMACION</b></center>
	</div>
	</td>
</tr>
");
		$tot_cdpp = 0;
		while ($rowxx = $resultadoxx->fetch_assoc()) {

			$id_manu_cdpp = $rowxx["consecutivo"];
			$id_manu_cdpp2 = $rowxx["id_manu_reip"];
			$valor_cdpp = $rowxx["valor"];
			$des_cdpp = $rowxx["des"];
			$cta_cdpp = $rowxx["cuenta"];
			$fecha_cdpp = $rowxx["fecha_reg"];
			$id_unico = $rowxx["id"];
			$nom_rubro = $rowxx["nom_rubro"];
			printf("
    
	<tr>

    <td class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center>$id_manu_cdpp2</center>
	</div>
	</td>
	
	<td class='Estilo4' align='left'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	%s
	</div>
	</td>
	
	<td class='Estilo4' align='right'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	%s
	</div>
	</td>
	
	<td class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center>$fecha_cdpp</center>
	</div>
	</td>
", $cta_cdpp, number_format($valor_cdpp, 2, ',', '.'));

			if ($valor_cdpp < '0') {
				printf("	
<td class='Estilo4' align='center' bgcolor ='#000099'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'>
<a href=\"eliliq.php?var=$id_unico&var2=$var\" target=\"_parent\" style='color:#FFFFFF'>Deshacer Reversi&oacute;n</a>
</span>
</div>
</td>

");
			} else {
				printf("	
	<td class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center>
	<script type=\"text/javascript\" src=\"../wz_tooltip/wz_tooltip.js\"></script>
	<a href=\"#\" onmouseover=\"Tip('<br><b>RUBRO : </b><br><br>%s<br><br><b>CONCEPTO : </b><br><br>%s<br><br>', WIDTH, 270, TITLE, '', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, false, CLICKCLOSE, true)\" onmouseout=\"UnTip()\">Ver</a><br />
	</center>
	</div>
	</td>
	
	
", $nom_rubro, $des_cdpp);
			}

			printf("</tr>");

			$tot_cdpp = $tot_cdpp + $valor_cdpp;
		}

		//****** total cdpp's 
		printf("
    
			<tr bgcolor='#F5F5F5'>
		
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>TOTAL REIP's</b></center>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>%s</b></center>	
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			</tr>
		", number_format($tot_cdpp, 2, ',', '.'));
		//****************



		//***************crpp's

		printf("
<tr bgcolor='#DCE9E5'>
    <td colspan='5' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>RECIBOS OFICIALES DE INGRESOS DE TESORERIA</b></center>
	</div>
	</td>
</tr>
<tr bgcolor='#DCE9E5'>
   
    <td width='150'></td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>IMPU. PPTAL</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>VALOR</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>FECHA</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>INFORMACION</b></center>
	</div>
	</td>
</tr>
");


		$sqlxx = "select * from recaudo_roit where id_reip = '$id_manu_cdpp'";
		$resultadoxx = $connectionxx->query($sqlxx);
		$tot_crpp = 0;
		while ($rowxx = $resultadoxx->fetch_assoc()) {
			$id_auto_crpp = $rowxx["id_reip"];
			$id_manu_crpp = $rowxx["id_manu_roit"];
			$cta_crpp = $rowxx["cuenta"];
			$vr_crpp = $rowxx["vr_digitado"];
			$fecha_crpp = $rowxx["fecha_recaudo"];
			$tercero_crpp = $rowxx["tercero"];
			$des_crpp = $rowxx["des_recaudo"];

			//**** nom rubro

			$id_a_cdpp = $rowxx["id_reip"];

			$sqlxxe = "select * from reip_ing where consecutivo = '$id_a_cdpp' and cuenta = '$cta_crpp'";
			$resultadoxxe = $connectionxx->query($sqlxxe);

			while ($rowxxe = $resultadoxxe->fetch_assoc()) {
				$nom_rubro2 = $rowxxe["nom_rubro"];
			}


			/*	$link=mysql_connect($server,$dbuser,$dbpass);
	$resulta=mysql_query("select SUM(vr_digitado) AS TOTAL from crpp WHERE id_auto_crpp = '$id_auto_crpp'",$link) or die (mysql_error());
	$row=mysql_fetch_row($resulta);
	$total=$row[0]; 
	$nuevo_total11 = $total;*/

			if ($vr_crpp != '0') {

				printf("

	<tr>
	
	<td class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center>$id_manu_crpp</center>
	</div>
	</td>
	
	<td class='Estilo4' align='left'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	$cta_crpp
	</div>
	</td>
");




				printf("	
	<td class='Estilo4' align='right'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	%s
	</div>
	</td>
	", number_format($vr_crpp, 2, ',', '.'));


				printf("	
	<td class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center>$fecha_crpp</center>
	</div>
	</td>
");

				if ($vr_crpp < '0') {
					printf("	
		<td class='Estilo4' align='center' bgcolor ='#DCE9E5'>
		<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
		<span class='Estilo4' style='color:#000099'>
		Liquidacion de Saldo
		</span>
		</div>
		</td>
		
		");
				} else {

					printf("	
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center>
			<script type=\"text/javascript\" src=\"../wz_tooltip/wz_tooltip.js\"></script>
			<a href=\"#\" onmouseover=\"Tip('<br><b>RUBRO : </b><br><br>$nom_rubro2<br><br><b>TERCERO : </b><br><br>$tercero_crpp<br><br><b>CONCEPTO : </b><br><br>%s<br><br>', WIDTH, 270, TITLE, '', SHADOW, true, FADEIN, 300, FADEOUT, 300, STICKY, 1, CLOSEBTN, false, CLICKCLOSE, true)\" onmouseout=\"UnTip()\">Ver</a><br />
			</center>
			</div>
			</td>
			
			</tr>
			", $des_crpp);
				}
			} //fin del if	
			$tot_crpp = $tot_crpp + $vr_crpp;
		} //while del crpp


		//****** total crpp's 
		printf("
    
			<tr bgcolor='#F5F5F5'>
		
			
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>TOTAL ROIP's</b></center>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>%s</b></center>	
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			</tr>
		", number_format($tot_crpp, 2, ',', '.'));
		//****************

		//****** saldo por registrar 

		$sqlxx = "select sum(valor) as total, sum(vr_recaudado) as total2, cuenta,valor from reip_ing where consecutivo = '$var' group by cuenta";
		$resultadoxx = $connectionxx->query($sqlxx);

		printf("
<tr bgcolor='#DCE9E5'>
    <td colspan='5' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>SALDO X REVERSAR</b></center>
	</div>
	</td>
</tr>
<tr bgcolor='#DCE9E5'>
    
    <td width='150'></td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>IMPU. PPTAL</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b>VALOR</b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b></b></center>
	</div>
	</td>
    <td width='150' class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<center><b></b></center>
	</div>
	</td>
</tr>
");

		$tot_x_reg = 0;
		while ($rowxx = $resultadoxx->fetch_assoc()) {

			$cta_cdpp = $rowxx["cuenta"];
			$valor_cdpp = $rowxx["valor"];

			//aplica para cuando se hace el proceso liquidando al reves.... crpp to cdpp

			$sqlxxq = "select * from reip_ing where consecutivo = '$var' and cuenta = '$cta_cdpp'";
			$resultadoxxq = new mysqli($server, $dbuser, $dbpass, $database);
			$rex = $resultadoxxq->query($sqlxxq);
			while ($rowxxq = $rex->fetch_assoc()) {
				$vr_crppq = isset($rowxxq["vr_digitado"]) ? $rowxxq["vr_digitado"] : 0;

				if ($vr_crppq < 0) {

					$sql = "select * from reip_ing where consecutivo = '$var' and cuenta='$cta_cdpp' and vr_recaudado = '$vr_crppq'";
					$result = $connectionxx->query($sql);
					if ($result->num_rows == 0) {
						$vr_crppq = $vr_crppq * -1;
						$valor_obli_cdpp = $rowxx['total2'];
						$vr_x_reg = $rowxx['total'] - $valor_obli_cdpp + $vr_crppq;
					}
				} else {
					$valor_obli_cdpp = $rowxx['total2'];
					$vr_x_reg = $rowxx['total'] - $valor_obli_cdpp;
				}
			}

			//************************







			printf("
    
			<tr>
		
			
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4' align='left'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			$cta_cdpp
			</div>
			</td>
			
			<td class='Estilo4' align='right'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			%s
			</div>
			</td>
", number_format($vr_x_reg, 2, ',', '.')); // muestra el valor a reversar




			if ($vr_x_reg == '0') {
				printf("			
<td class='Estilo4' align='center'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'>

</span>
</div>
</td>
");
			} else {
				printf("			
<td class='Estilo4' align='center' bgcolor ='#000099'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'>
<a href=\"liqreip.php?var=$var&id_manu_cdpp=$id_manu_cdpp2&cta_cdpp=$cta_cdpp&vr_x_reg=$vr_x_reg\" target=\"_parent\" style='color:#FFFF00'>Reversar</a>
</span>
</div>
</td>
");
			}

			printf("
	<td class='Estilo4'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	</div>
	</td>

</tr>
");

			$tot_x_reg = $tot_x_reg + $vr_x_reg;
		}
		//****************	
		//****** total x liquidar 
		printf("
    
			<tr bgcolor='#F5F5F5'>
		
			
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>TOTAL x REVERSAR</b></center>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			<center><b>%s</b></center>	
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			<td class='Estilo4'>
			<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
			</div>
			</td>
			
			</tr>
		", number_format($tot_x_reg, 2, ',', '.'));
		//****************					
		//***************
		printf("</center></table>");
		?>
		<br>
		<center>
			<form action="mvto.php" method="post">
				<input name="nn" type="hidden" value="REIP">
				<input type="submit" value="Cerrar Ventana">
			</form>
		</center>
	</body>

	</html>
<?php
}
?>