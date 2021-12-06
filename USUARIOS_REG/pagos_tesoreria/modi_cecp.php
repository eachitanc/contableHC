<?php
session_start();
if (!$_SESSION["login"]) {
	header("Location: ../login.php");
	exit;
} else {
?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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

			.suggestionsBox {
				position: relative;
				left: 30px;
				margin: 0px 0px 0px 0px;
				width: 600px;
				background-color: #335194;
				-moz-border-radius: 7px;
				-webkit-border-radius: 7px;
				border: 2px solid #2AAAFF;
				color: #fff;
				font-size: 10px;
			}

			.suggestionList {
				margin: 0px;
				padding: 0px;
			}

			.suggestionList li {

				margin: 0px 0px 3px 0px;
				padding: 3px;
				cursor: pointer;
			}

			.suggestionList li:hover {
				background-color: #659CD8;
			}
		</style>
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
				color: #FFFFFF
			}
		</style>

		<script>
			function validar(e) {
				tecla = (document.all) ? e.keyCode : e.which;
				if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) + punto
				patron = /\d/; //ver nota 
				te = String.fromCharCode(tecla);
				return patron.test(te);
			}
		</script>

		<!--valida total de vaolor a pagar se inferior al saldo -->
		<script>
			function valvrob() {
				var vr_ob = eval(parseInt(document.getElementById('vr_obli_para_pago_mas_iva').value));
				var vr_sl = eval(parseInt(document.getElementById('vr_saldo').value));
				if (vr_ob > vr_sl)
					alert("El Valor Oblidado a Pagar\n\n           -* NO *- \n\nPuede ser Mayor que el Saldo");
				document.getElementById('vr_obli_para_pago_sin_iva').value = document.getElementById('vr_obli_para_pago_mas_iva').value
			}
		</script>

		<script>
			function envias(chek, marc) {
				alert(marc);
				alert(document.getElementById(chek).checked);
				alert(document.getElementById(chek).value);
				if (document.getElementById(chek).checked == false) {
					document.getElementById(chek).value = "NOAUT";
					alert(document.getElementById(chek).value);
					document.getElementById('commentForm').action = "nuevo_cecp.php#chek";
					document.forms.a.submit();
				} else {
					document.getElementById(chek).value = "SIAUT";
					alert(document.getElementById(chek).value);
					document.getElementById('commentForm').action = "nuevo_cecp.php";
					document.forms.a.submit();
				}


			}
		</script>

		<SCRIPT language="javascript">
			function MostrarOcultarDEDU(objetoVisualizar) {
				if (document.all[objetoVisualizar].style.display == 'block') {
					document.all[objetoVisualizar].style.display = 'none';
				} else {
					document.all[objetoVisualizar].style.display = 'block';
				}
			}

			function MostrarOcultarRETE(objetoVisualizar) {
				if (document.all[objetoVisualizar].style.display == 'block') {
					document.all[objetoVisualizar].style.display = 'none';
				} else {
					document.all[objetoVisualizar].style.display = 'block';
				}
			}
		</SCRIPT>


		<!--muestra - oculta naturales -->
		<SCRIPT language="javascript">
			function MostrarOcultar(objetoVisualizar) {
				if (document.all['naturales'].style.display == 'none') {
					document.all['naturales'].style.display = 'block';
					document.a.ter_nat.disabled = false;
					document.all['juridicos'].style.display = 'none';
					document.getElementById('ter_jur').value = '';
					document.a.ter_jur.disabled = true;
				}
				if (document.all['naturales'].style.display == 'block') {
					document.all['naturales'].style.display = 'block';
					document.a.ter_nat.disabled = false;
					document.all['juridicos'].style.display = 'none';
					document.getElementById('ter_jur').value = '';
					document.a.ter_jur.disabled = true;
				}
				/*else 
				{
					document.a.ter_nat.disabled=true;
					document.a.ter_jur.disabled=true;
					document.all['naturales'].style.display='none';
					document.all['juridicos'].style.display='none';
				}*/
			}
		</SCRIPT>
		<!--muestra - oculta juridicos -->
		<SCRIPT language="javascript">
			function MostrarOcultar2(objetoVisualizar) {

				if (document.all['juridicos'].style.display == 'none') {
					document.all['naturales'].style.display = 'none';
					document.getElementById('ter_nat').value = '';
					document.a.ter_nat.disabled = true;
					document.all['juridicos'].style.display = 'block';
					document.a.ter_jur.disabled = false;
				}
				if (document.all['juridicos'].style.display == 'block') {
					document.all['naturales'].style.display = 'none';
					document.getElementById('ter_nat').value = '';
					document.a.ter_nat.disabled = true;
					document.all['juridicos'].style.display = 'block';
					document.a.ter_jur.disabled = false;
				}
				/*else 
				{
				document.a.ter_nat.disabled=true;
				document.a.ter_jur.disabled=true;
				document.all['naturales'].style.display='none';
				document.all['juridicos'].style.display='none';
				}*/
			}
		</SCRIPT>
		<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
		</LINK>
		<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
		<style type="text/css">
			<!--
			.Estilo12 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
			}

			.Estilo12 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
			}

			.Estilo13 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
				font-style: italic;
			}

			.Estilo14 {
				color: #66CCCC
			}

			.Estilo9 {
				color: #F5F5F5
			}

			.Estilo19 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
			}

			.Estilo19 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
			}

			.Estilo20 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
			}

			.Estilo20 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
			}

			table.bordepunteado11 {
				border-style: solid;
				border-collapse: collapse;
				border-width: 2px;
				border-color: #004080;
			}

			table.bordepunteado11 {
				border-style: solid;
				border-collapse: collapse;
				border-width: 2px;
				border-color: #004080;
			}
			-->
		</style>
		<script>
			function mas_inputs() {
				var vari = document.getElementById('contis2').innerHTML;
				if (vari >= 20) {
					vari = 20;
				} else {
					varix = parseFloat(vari) + 1;
					document.getElementById('contis2').innerHTML = varix;
					document.getElementById('filas').value = varix;
					var mostrar = 'inputx' + varix;
					document.getElementById(mostrar).style.display = "block";
				}
			}

			function menos_inputs() {
				vari2 = document.getElementById('contis2').innerHTML;
				if (vari2 > 1) {
					vari2 = parseFloat(vari2);
					document.getElementById('contis2').innerHTML = vari2 - 1;
					document.getElementById('filas').value = vari2 - 1; // envio el valor de las filas actuales al input para enviar tama�o al post 
					var mostrar = 'inputx' + vari2;
					document.getElementById(mostrar).style.display = "none";
					document.getElementById('valor_pto' + vari2).value = '';
					document.getElementById('cuenta_cxp' + vari2).value = '';
					valor_a_pagar();
				}
			}

			function iva2() {
				var valor_a_pagar = parseFloat(document.getElementById('vr_obli_para_pago_mas_iva').value);
				var iva = parseFloat(document.getElementById('iva').value);
				iva3 = iva + 1;
				if (iva3) {
					var valor_sin_iva = valor_a_pagar / iva3;
					document.getElementById('vr_obli_para_pago_sin_iva').value = Math.round(valor_sin_iva);
					var valor_iva = valor_a_pagar - valor_sin_iva;
					document.getElementById('iva_vr_obli_pago').value = Math.round(valor_iva);
				}
			}


			function valor_a_pagar() {
				var suma = 0;
				for (i = 1; i <= 20; i++) {
					var valor = document.getElementById('valor_pto' + i).value;
					if (valor) {
						suma = suma + parseFloat(valor);
					}
				}
				document.getElementById('vr_obli_para_pago_mas_iva').value = suma;
				iva2();
			}


			function rubroDuplicado(id) {
				var cont = 0;
				for (i = 1; i <= 20; i++) {
					var valor = document.getElementById('cuenta_cxp' + i).value;
					if (valor) {
						for (j = 1; j <= 20; j++) {
							var existe = document.getElementById('cuenta_cxp' + j).value;
							if (valor == existe) {
								cont++;
								if (cont > 1) {
									alert("La cuenta ya ha sido seleccionada");
									document.getElementById('cuenta_cxp' + j).value = '';
								}
							}
						}
						var cont = 0;
					}
				}
			}

			function CuentaDetalle(id) {
				var rubro = document.getElementById(id).value;
				var pos_url2 = 'consultas/tipo_rubro.php';
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							tipo_dato = req.responseText;
							if (tipo_dato == 'M') {
								alert("La cuenta seleccionada no es de detalle");
								document.getElementById(id).focus();
							} else {
								rubroDuplicado(id);
							}
						}
					}
					req.open('POST', pos_url2 + '?cod=' + rubro, true);
					req.send(null);
				}
			}

			function VerificaSaldo(id) {
				var valor_pago = document.getElementById(id).value;
				var num = id.substring(9);
				var rubro = document.getElementById('cuenta_cxp' + num).value;
				if (rubro == '') {
					document.getElementById(id).value = '';
					alert("No ha seleccionado un rubro presupuestal");
				}
				var pos_url2 = 'consultas/consulta_saldo.php';
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							var estado = req.responseText;
							if (estado != '') {
								alert("El Valor a pagar es mayor al saldo del rubro $" + estado);
								document.getElementById(id).focus();
							} else {
								valor_a_pagar();
							}
						}
					}
					req.open('POST', pos_url2 + '?cod=' + valor_pago + '&rubro=' + rubro, true);
					req.send(null);
				}

			}

			function validarForm() {
				var tern = document.getElementById('ter_nat').value;
				var terj = document.getElementById('ter_jur').value;
				if ((tern == '' && terj == '') || (tern == 'nat' && terj == 'jur') || (tern == '' && terj == 'jur') || (tern == 'nat' && tern == '')) {
					alert("Falta seleccionar un tercero");
					document.getElementById('tercerosn').focus();
					return (false);
				}
				var filas = document.getElementById('contis2').innerHTML;
				for (i = 1; i <= filas; i++) {
					var cuenta = document.getElementById('cuenta_cxp' + i).value;
					if (cuenta == '') {
						alert("Falta seleccionar el rubro presupuestal");
						document.getElementById('cuenta_cxp' + i).focus();
						return (false);
					}
					var valor = document.getElementById('valor_pto' + i).value;
					if (valor == '') {
						alert("Falta digitar el valor a pagar");
						document.getElementById('valor_pto' + i).focus();
						return (false);
					}
				}

				var total = document.getElementById('total').value;
				if (total != 0) {
					alert("Las suma de bebitos y  creditos es diferente de cero");
					document.getElementById('total').focus();
					return (false);
				}
				var total_pagado = document.getElementById('total_pagado').value;
				if (total_pagado <= 0) {
					alert("Falta calcular los valores a retener");
					document.getElementById('Submit3').focus();
					return (false);
				}
				var codigo_dian = document.getElementById('codigo_dian').value;
				if (codigo_dian == '') {
					alert("Falta seleccionar concepto de pago - DIAN");
					document.getElementById('codigo_dian').focus();
					return (false);
				}
				var cuentas = document.getElementById('contis').innerHTML;
				i = 0;
				for (i = 1; i <= cuentas; i++) {
					var cuenta = document.getElementById('pgcp' + i).value;
					if (cuenta == '') {
						alert("Falta seleccionar la cuenta contable");
						document.getElementById('pgcp' + i).focus();
						return (false);
					}
				}
				i = 0;
				for (i = 1; i <= cuentas; i++) {
					var cuenta = document.getElementById('pgcp' + i).value;
					var banco = cuenta.substring(0, 4);
					if (banco == '1110' || banco == '1120') {
						var cheque = document.getElementById('num_cheque' + i).value;
						if (cheque == '') {
							alert("Falta seleccionar el n�mero de cheque");
							document.getElementById('num_cheque' + i).focus();
							return (false);
						}
					}
				}

				return (true);
			}
		</script>
		<!--validacion de forms-->
		<script src="../jquery.js"></script>
		<script type="text/javascript" src="../jquery.validate.js"></script>
		<script language="JavaScript" type="text/javascript" src="javas.js"></script>

		<style type="text/css">
			* {
				font-family: Verdana;
				font-size: 10px;
			}

			label {
				width: 10em;
				float: left;
			}

			label.error {
				float: none;
				color: red;
				padding-left: .5em;
				vertical-align: top;
			}

			p {
				clear: both;
			}

			.submit {
				margin-left: 12em;
			}

			em {
				font-weight: bold;
				padding-right: 1em;
				vertical-align: top;
			}

			.Estilo23 {
				color: #FFFFFF
			}

			.Estilo10 {
				font-size: 10px;
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-weight: bold;
			}

			.Estilo10 {
				color: #990000;
				font-style: italic;
			}
		</style>

		<script>
			$(document).ready(function() {
				$("#commentForm").validate();
			});
		</script>

		<script>
			function chk_cecp() {
				var pos_url = '../comprobadores/comprueba_cecp.php';
				var cod = document.getElementById('id_manu_cecp').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('res_cecp').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}

			function ejecucion_pto() {
				document.getElementById('muestra_informe').style.display = "block";
				var fila = parseFloat(document.getElementById('contis2').innerHTML);
				var cods = new Array();
				for (i = 1; i <= fila; i++) {
					cods[i] = document.getElementById('cuenta_cxp' + i).value;
				}
				var pos_url2 = 'consultas/ejecucion.php';
				var req1 = new XMLHttpRequest();
				if (req1) {
					req1.onreadystatechange = function() {
						if (req1.readyState == 4) {
							document.getElementById('informe').innerHTML = req1.responseText;
						}
					}
					req1.open('POST', pos_url2 + '?cod=' + cods + '&fil=' + fila, true);
					req1.send(null);
				}
			}

			function RelcionPagos() {
				document.getElementById('muestra_informe').style.display = "block";
				var ter_nat = document.getElementById('ter_nat').value;
				var ter_jur = document.getElementById('ter_jur').value;
				var pos_url2 = 'consultas/relacion_pagos.php';
				var req1 = new XMLHttpRequest();
				if (req1) {
					req1.onreadystatechange = function() {
						if (req1.readyState == 4) {
							document.getElementById('informe').innerHTML = req1.responseText;
						}
					}
					req1.open('POST', pos_url2 + '?ter_nat=' + ter_nat + '&ter_jur=' + ter_jur, true);
					req1.send(null);
				}
			}

			function muestra_saldo(id) {
				var input_cuenta = "cuenta_cxp" + id.substring(9);
				var cuenta = document.getElementById(input_cuenta).value;
				var pos_url2 = 'consultas/muestra_saldo.php';
				var req1 = new XMLHttpRequest();
				if (req1) {
					req1.onreadystatechange = function() {
						if (req1.readyState == 4) {
							document.getElementById(id).value = req1.responseText;
						}
					}
					req1.open('POST', pos_url2 + '?cod=' + cuenta, true);
					req1.send(null);
				}
			}

			function ocultar() {
				document.getElementById('muestra_informe').style.display = "none";
			}

			function ValorRetencion(id) {
				var concepto = document.getElementById(id).value;
				if (concepto == '') {
					var campo = "vr_" + id;
					document.getElementById(campo).value = '';
				}
			}
		</script>
		<!--fin val forms-->
	</head> <!-- Cabecera con funciones y javascript -->

	<body onload="Calcular();">
		<?php
		$veaternat = "display:none";
		$veaterjur = "display:none";
		$aut = $_GET["siauto"];
		$autiva = $_GET["riva"];
		$autestun = $_GET["autestun"];
		$autestdo = $_GET["autestdo"];
		$autesttr = $_GET["autesttr"];
		$autestcu = $_GET["autestcu"];
		$autestci = $_GET["autestci"];
		$modi = $_GET["mod"];
		$id_cecp = $_GET["id2"];
		include('../config.php');
		$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$sqx = "select * from cecp where id_auto_cecp = '$id_cecp'";
		$resx = $cx->query($sqx);
		$rowx = $resx->fetch_assoc();
		?>
		<table width="800" border="0" align="center">
			<tr>
				<td colspan="3">
					<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
						<div align="center"><img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<div align="center" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
						<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
							<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
								<div align="center">
									<?php
									include('../objetos/redondear.php');
									printf("
<center class='Estilo4'>
<form method='post' action='pagos_tesoreria_cxp.php'>
<input type='hidden' name='nn' value='CECP'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");

									?>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<!-- Imagen de ecabezado y opcion volver -->
			<form name="a" method="post" id="commentForm" action="p_modifica_cecp.php" />
			<tr>
				<td colspan="3">
					<table width="800" border="1" align="center" class="bordepunteado1">
						<tr>
							<td width="185"></td>
							<td width="208"></td>
							<td width="180"></td>
							<td width="197"></td>
						</tr>
						<tr>
							<td colspan="4" bgcolor="#DCE9E5">
								<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;"><?php echo "$ultimo"; ?>
									<div align="center" class="Estilo12"><strong>
											<?php
											include('../config.php');
											$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
											$sqlxx = "select * from fecha";
											$resultadoxx = $connectionxx->query($sqlxx);
											while ($rowxx = $resultadoxx->fetch_assoc()) {
												$idxx = $rowxx["id_emp"];
												$id_emp = $rowxx["id_emp"];
												$ano = $rowxx["ano"];
											}
											?>
											COMPROBANTE DE EGRESO CUENTAS X PAGAR </strong></div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo4">
										<div align="right"><strong><a name="ver_ter" id="ver_ter"></a>Fecha CECP : </strong></div>
									</div>
								</div>
							</td>
							<td colspan="2" bgcolor="#FFFFFF">
								<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="left">
										<?php
										if (empty($_POST['fecha_cecpp'])) {
											$fecha_cecp = $ano; //printf("%s",$fecha_cecp); echo "entra if";
										} else {
											$fecha_cecp = $_POST['fecha_cecpp']; //printf("%s",$fecha_cecp); $modi='';
										}

										if ($modi == 'modi') {
											$fecha_cecp = $rowx["fecha_cecp"];
										}
										?>
										<input name="fecha_cecpp" type="text" class="required Estilo12" readonly="" id="fecha_cecpp" value="<?php printf($fecha_cecp); ?>" size="12" />
										<span class="Estilo8">:::</span>
										<input name="button2" type="button" class="Estilo12" onclick="displayCalendar(document.a.fecha_cecpp,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">&nbsp;</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5" width="185">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="right"><strong>No. de CECP (Automatico) : </strong></div>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF" width="208">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo4">
										<?php

										$cx = new mysqli($server, $dbuser, $dbpass, $database);
										$resulta = $cx->query("SHOW TABLE STATUS FROM $database LIKE 'cecp'");
										while ($array = $resulta->fetch_assoc()) {
											$conse = $array['Auto_increment'];
										}

										?>
										<?php printf("%s", $conse);

										$id_auto_cecp = $_POST['id_auto_cecp'];

										if ($modi == 'modi') {
											$id_auto_cecp = $rowx['id_auto_cecp'];
										}
										?>
										<input name="id_auto_cecp" type="hidden" class="Estilo12" id="id_auto_cecp" value="<?php printf($id_auto_cecp); ?>" />
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5" width="180">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="right"><strong>Digite Numero de CECP : </strong></div>
									</div>
								</div>
							</td>

							<td bgcolor="#FFFFFF" width="197">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php
											$ultimo2 = $_POST['id_manu_cecp'];
											if ($ultimo2 == '') {
												$cx = new mysqli($server, $dbuser, $dbpass, $database);

												$resultamax = $cx->query("select MAX(id_manu_cecp) FROM cecp");
												while ($arraymax = $resulta->fetch_array()) {
													$ultimo = $arraymax[0];
													$ultimo1 = substr($ultimo, 4);
													$ultimoo = $ultimo1 + 1;
												}
											} else {
												$ultimoo = $ultimo2;
											}
											if ($modi == 'modi') {
												$ultimoo = substr($rowx["id_manu_cecp"], 4);
											}

											?>
											<input name="id_manu_cecp" type="text" class="required Estilo4" id="id_manu_cecp" style="text-align:center" onkeypress="return validar(event)" value="<?php printf("%s", $ultimoo); ?>" onkeyup="chk_cecp();" />
											<!--<input name="id_auto_cecp" type="hidden" value="<?php // print ($rowx['id_auto_cecp']; 
																								?>"  />-->
											<br />
											<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
												<div class="Estilo4" align="center" id='res_cecp'></div>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo4">
										<div align="right"><strong>Seleccione Tercero : </strong></div>
									</div>
								</div>
							</td>
							<td colspan="3">
								<table border="0" align="left">
									<tr>
										<?php
										//echo "$_POST[ter_nat] ** $_POST[ter_jur] ** $_POST[chkretefte]";
										if (isset($_POST['Submit']) or isset($_POST['Submit2']) or isset($_POST['Submit3']) or isset($_POST['Submit32']) or $_POST['chkretefte'] == "SIAUT" or $_POST['chkretefte'] == "") {
											if (!empty($_POST['ter_nat'])) {
												$veaternat = "display:block";
												$enaterjur = "disabled='disabled'";
												$enaternat = "";
												$bannat = 1;
												$banjur = 0;
											} else {
												if (!empty($_POST['ter_jur'])) {
													$veaterjur = "display:block";
													$enaternat = "disabled='disabled'";
													$enaterjur = "";
													$bannat = 0;
													$banjur = 1;
												}
											}
										}
										$ter_natural = $_POST['ter_nat'];
										$ter_juridico = $_POST['ter_jur'];
										if ($modi == 'modi') {
											$tercero = $rowx['cn'];
											$tercero2 = explode(" ", $tercero);
											$ape1 = $tercero2[0];
											$ape2 = $tercero2[1];
											$nom1 = $tercero2[2];
											$nom2 = $tercero2[3];
											$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
											$sqx1 = "select * from terceros_naturales where num_id ='$tercero'";
											$resx1 = $cx->query($sqx1);
											$rowx1 = $resx1->fetch_assoc();
											$num_reg = $resx1->num_rows;
											if ($num_reg > 0) {
												$ter_natural = $rowx1['id'];
												$ter_juridico = '';
												$veaternat = "display:block";
												$enaterjur = "disabled='disabled'";
												$enaternat = "";
												$bannat = 1;
												$banjur = 0;
											} else {
												$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
												$sqx2 = "select id from terceros_juridicos where num_id2 ='$tercero' ";
												$resx2 = $cx->query($sqx2);
												$rowx2 = $resx2->fetch_assoc();
												$ter_natural = '';
												$ter_juridico = $rowx2['id'];
												$veaterjur = "display:block";
												$enaternat = "disabled='disabled'";
												$enaterjur = "";
												$bannat = 0;
												$banjur = 1;
											}
										}
										?>
										<td id="tercerosn">
											<div class="Estilo4" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
												<div align="left"><span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultar('naturales');">
														<font color="#0000FF"> NATURAL</font>
													</span> - <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultar2('juridicos');">
														<font color="#0000FF"> JURIDICO</font>
													</span> - <a href="../terceros/terceros.php" target="_parent">&iquest; NUEVO ?</a> </div>
											</div>
										</td>
									</tr>
									<tr>
										<td id="naturales" style=" <?php print $veaternat ?> ">
											<div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px;">
												<div align="left">
													<select name="ter_nat" class="Estilo4" id="ter_nat" style="width: 350px;" <?php print $enaternat; ?>>
														<option value="nat"></option> <?php

																						include('../config.php');
																						$db = new mysqli($server, $dbuser, $dbpass, $database);

																						$strSQL = "SELECT * FROM terceros_naturales  WHERE id_emp = '$id_emp' order by  pri_ape asc ";
																						$rs = $db->query($strSQL);
																						while ($r = $rs->fetch_assoc()) {
																							if ($r['id'] == $ter_natural or $r['id'] == '$ternatidaut' or $r['id'] == '$ternatidman') {
																								echo "<OPTION selected=" . $r['pri_ape'] . ' ' . $r['seg_ape'] . ' ' . $r['pri_nom'] . ' ' . $r['seg_nom'] . " VALUE=\"" . $r["id"] . "\">" . $r["pri_ape"] . " " . $r["seg_ape"] . " " . $r["pri_nom"] . " " . $r["seg_nom"] . "</b></OPTION>";
																							} else {
																								echo "<OPTION VALUE=\"" . $r["id"] . "\">" . $r["pri_ape"] . " " . $r["seg_ape"] . " " . $r["pri_nom"] . " " . $r["seg_nom"] . "</b></OPTION>";
																							}
																						}
																						?>
													</select>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td id="juridicos" style=" <?php print $veaterjur ?>">
											<div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px;">
												<div align="left">
													<select name="ter_jur" class="Estilo4" id="ter_jur" style="width: 350px;" <?php print $enaterjur; ?>>
														<option value="jur"></option>
														<?php
														include('../config.php');
														$db = new mysqli($server, $dbuser, $dbpass, $database);

														$strSQL = "SELECT * FROM terceros_juridicos  WHERE id_emp = '$id_emp' order by raz_soc2 asc ";
														$rs = $db->query($strSQL);
														while ($r = $rs->fetch_assoc()) {
															if ($r['id'] == $ter_juridico or $r['id'] == '$terjuridaut' or $r['id'] == '$terjuridman') {
																echo "<OPTION selected=" . $r['raz_soc2'] . " VALUE=\"" . $r["id"] . "\">" . $r["raz_soc2"] . "</b></OPTION>";
															} else {
																echo "<OPTION VALUE=\"" . $r["id"] . "\">" . $r["raz_soc2"] . "</b></OPTION>";
															}
														}
														?>
													</select>
												</div>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo4">
										<div align="right"><strong>Digite Concepto de Pago : </strong></div>
									</div>
								</div>
							</td>
							<td colspan="3" bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="left" class="Estilo4">

										<?php
										$conce = $_POST['concepto_pago'];
										if ($modi == 'modi') {
											$conce = $rowx["concepto_pago"];
										} ?>

										<input name="concepto_pago" type="text" class="required Estilo4" id="concepto_pago" onkeyup="a.concepto_pago.value=a.concepto_pago.value.toUpperCase();" style="width: 520px;" value="<?php printf("%s", $conce); ?>" />
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5" colspan="3">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo4">
										<div align="center"><strong>Seleccione Rubro Pptal CxP : </strong></div>
									</div>
								</div>
							</td>
							<td align="center" bgcolor="#F5F5F5" class="Estilo4"><strong>Valor</strong></td>
						</tr>
						<?php
						if (!$_POST["filas"]) {
							$num_filas = 1;
						} else {
							$num_filas = $_POST["filas"];
						}
						if ($modi == 'modi') {
							$jx = 1;
							include('../config.php');
							$sq5 = "select * from cecp_cuenta where id_auto_cecp ='$id_cecp'";
							$link  = new mysqli($server, $dbuser, $dbpass, $database);
							$filas_cuentas = $link->query($sq5);
							$num_filas = $filas_cuentas->num_rows;
							// creo un arreglo con los valores guardados
							while ($row_filas = $filas_cuentas->fetch_assoc()) {
								$cuentas[$jx] = $row_filas["cuenta"];
								$valores[$jx] = $row_filas["valor"];
								$id_c[$jx] =		$row_filas["id"];
								$jx++;
							}
						}
						?>
						<tr>
							<td colspan="4" bgcolor="#DCE9E5" align="center">
								<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
									<img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='mas_inputs();'>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<span id='contis2' class='Estilo4'><?php echo $num_filas; ?></span>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<img src="images/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='menos_inputs();'>
									</strong>
								</div>
								<input name="filas" type="hidden" id="filas" value='<?php echo $num_filas; ?>' />

							</td>

						</tr> <!-- Datos generales del comprobante -->
						<?php
						include('../config.php');
						$query = "SELECT * FROM cxp WHERE id_emp = '$id_emp' ORDER BY cod_pptal";
						$link  = new mysqli($server, $dbuser, $dbpass, $database);

						for ($k = 1; $k <= 20; $k++) {

							$cuenta_cxp = $_POST['cuenta_cxp' . $k];
							$valor_pto = $_POST['valor_pto' . $k];
							$idc = $_POST['idc' . $k];
							if ($modi == 'modi') {
								$cuenta_cxp = $cuentas[$k];
								$valor_pto = $valores[$k];
								$idc = $id_c[$k];
							}
							echo "
			  <tr style='display:$ver' id='inputx$k'>
			  <td colspan='3' bgcolor='#FFFFFF'>
					<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
					<div align='center'>
							<select name='cuenta_cxp$k' class='Estilo4' id='cuenta_cxp$k' style='width: 500px;'  onBlur='CuentaDetalle(id);' >
								<option value=''</option>
			";
							$result = $link->query($query);
							while ($row = $result->fetch_assoc()) {
								if ($row['cod_pptal'] == $cuenta_cxp) {
									echo "<OPTION VALUE='$row[cod_pptal]' selected><b>$row[cod_pptal] $row[nom_rubro]</b></OPTION>";
								} else {
									echo "<OPTION VALUE='$row[cod_pptal]'>$row[cod_pptal] $row[nom_rubro]</OPTION>";
								}
							}
							echo "
			  </select>
			  </div>
			  </div>
			  </td> 
			  <td align='center'> <input type='text' name='valor_pto$k' style='text-align:right' id='valor_pto$k' value='$valor_pto' onblur='VerificaSaldo(id);' onkeypress='return validar(event)' onFocus='muestra_saldo(id)'/>
			  <input type='hidden' name='idc$k' id='idc$k' value='$idc'/>
			   </td>
			  </tr>
			";

							if ($k > $num_filas - 1)  $ver = "none";
						}
						?>
						<!-- A�adir rubro presupuestal -->


						<tr>
							<td bgcolor="#990000" colspan="2" onclick="ejecucion_pto();" onmouseout="ocultar();" style="cursor:pointer">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<center style='color:#FFFFFF'><b>VER EJECUCION PRESUPUESTAL RUBROS SELECCIONADOS</b></center>
								</div>
							</td>

							<td colspan="2" bgcolor="#CC9900" onclick="RelcionPagos();" onmouseout="ocultar();" style="cursor:pointer">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<center style='color:#FFFFFF'><b>VER HISTORIAL DE PAGOS POR TERCERO</b></center>
								</div>
							</td>
						</tr>
						<tr style='display:none' id='muestra_informe'>
							<td bgcolor="#F5F5F5" colspan="4" id="informe">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo4">
										<div align="right"><strong></strong></div>
									</div>
								</div>
							</td>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</table>
					<br /> <!-- Datos del tercero e informe de ejecucion -->
					<table width="800" border="1" align="center" class="bordepunteado1">
						<tr>
							<td colspan="2" bgcolor="#DCE9E5">
								<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
									<div align="center" class="Estilo12"><strong> DATOS DEL COMPROMISO VIGENCIA ANTERIOR </strong> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>Valor de la Obligacion
												a Pagar </strong></div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php $vr_obli_para_pago_mas_iva = $_POST['vr_obli_para_pago_mas_iva'];
											if ($modi == 'modi') {
												$vr_obli_para_pago_mas_iva = $rowx["vr_obli_para_pago_mas_iva"];
											}
											?>
											<input name="vr_obli_para_pago_mas_iva" type="text" class="required Estilo12" id="vr_obli_para_pago_mas_iva" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $vr_obli_para_pago_mas_iva); ?>" onchange="valvrob()" />
										</div>
									</div>
								</div>
							</td>
						</tr>
						<td colspan="2" bgcolor="#66CCCC">
							<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
								<div align="center" class="Estilo12">
									<div align="center"><strong>Si el pago a realizar no tiene IVA, deje la casilla en BLANCO,<br />
											caso contrario, Digite Tarifa del IVA ( Ejemplo : 0.16 )<br /><br />
										</strong>
										<?php
										$iva = $_POST['iva'];
										echo $iva;
										if ($modi == 'modi') {
											$iva = $rowx["iva"];
										}
										?>

										<input name="iva" type="text" class="Estilo12" id="iva" style="text-align:center" onkeypress="return validar(event)" onchange="iva2()" value="<?php printf("%s", $iva); ?>" />
										<span class="Estilo14">:::</span>
									</div>
								</div>
							</div>
						</td>
			</tr>
			<tr>
				<td colspan="2" bgcolor="#DCE9E5">
					<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
						<div align="center" class="Estilo12"><strong> DATOS PARA EL PRESENTE PAGO </strong></div>
					</div>
				</td>
			</tr>
			<tr>
				<td bgcolor="#F5F5F5">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo12">
							<div align="center"><strong>Valor de la Obligacion
									Para Este Pago SIN el IVA </strong></div>
						</div>
					</div>
				</td>
				<td bgcolor="#F5F5F5">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo12">
							<div align="center">
								<?php
								$new_iva = $iva + 1;
								$vr_obli_para_pago_sin_iva = $vr_obli_para_pago_mas_iva / $new_iva;
								?>
								<input name="vr_obli_para_pago_sin_iva" type="text" class="required Estilo12" id="vr_obli_para_pago_sin_iva" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $vr_obli_para_pago_sin_iva); ?>" readonly />
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo12">
							<div align="center"><strong>Valor del IVA de la Obligacion
									Para Este Pago</strong></div>
						</div>
					</div>
				</td>
				<td>
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo12">
							<div align="center">
								<?php
								$iva_vr_obli_pago = $vr_obli_para_pago_mas_iva - $vr_obli_para_pago_sin_iva;
								?>
								<input name="iva_vr_obli_pago" type="text" class="required Estilo12" id="iva_vr_obli_pago" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $iva_vr_obli_pago); ?>" readonly />
							</div>
						</div>
					</div>
				</td>
			</tr>
			</br>
		</table> <!-- Datos del compromiso vige anterior -->
		<table width="800" border="0" id="deduciones" align="center" style="display:block">
			<tr>
				<td colspan="4">
					<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
						<div align="center" class="Estilo4"> <strong> <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultarDEDU('dedu');"> ...::: DESCUENTOS Y DEDUCCIONES :::...</span></strong></div>
					</div>
					<table width="800" border="1" align="center" class="bordepunteado1" id="dedu" style="display:none">
						<tr>
							<td colspan="4" bgcolor="#DCE9E5">
								<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
									<div align="center" class="Estilo12"><strong> DESCUENTOS Y DEDUCCIONES </strong></div>
								</div>
							</td>
						</tr>
						<tr>
							<?php
							$post = array('salud', 'pension', 'libranza', 'f_solidaridad', 'f_empleados', 'sindicato', 'embargo', 'cruce', 'otros', 'ReteICA');
							$sql4 = "select * from dctos_deduc_cecp";
							$resultado4 = $connectionxx->query($sql4);
							$iq = 0;
							$iqq = 0;
							while ($row4 = $resultado4->fetch_assoc()) {

								$concep[$iq] = $row4["concepto"];
								$autom[$iq] = $row4["contab"];
								if ($autom[$iq] == 'SI') {
									$auxauto[$iqq] = $post[$iq];
									$cuenta[$iqq] = $row4["cuenta"];
									$iqq++;
								}
								$iq++;
							}
							$numcuenta = count($cuenta);
							$salud = $_POST['salud'];
							$pension = $_POST['pension'];
							$libranza = $_POST['libranza'];
							$f_solidaridad = $_POST['f_solidaridad'];
							$f_empleados = $_POST['f_empleados'];
							$sindicato = $_POST['sindicato'];
							$embargo = $_POST['embargo'];
							$cruce = $_POST['cruce'];
							$otros = $_POST['otros'];
							if ($modi == 'modi') {
								$salud = $rowx['salud'];
								$pension = $rowx['pension'];
								$libranza = $rowx['libranza'];
								$f_solidaridad = $rowx['f_solidaridad'];
								$f_empleados = $rowx['f_empleados'];
								$sindicato = $rowx['sindicato'];
								$embargo = $rowx['embargo'];
								$cruce = $rowx['cruce'];
								$otros = $rowx['otros'];
							}
							?>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="right"><strong>Salud </strong>(<span class="Estilo13">Digitar) </span><strong>: </strong></div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="salud" type="text" class="Estilo12" id="salud" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $salud);	 ?>" />
											<?php
											if ($autom[0] == 'SI')
												echo "<input name='checksalud' type='checkbox' id='checksalud' disabled='disabled' checked='checked'/>";
											else
												echo "<input name='checksalud' type='checkbox' disabled='disabled' id='checksalud'/>";
											?>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="right"><strong>Pension </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="pension" type="text" class="Estilo12" id="pension" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $pension);	 ?>" />
											<?php
											if ($autom[1] == 'SI')
												echo "<input name='checkpenciones' type='checkbox' id='checkpenciones' disabled='disabled' checked='checked'/>";
											else
												echo "<input name='checkpenciones' type='checkbox' disabled='disabled' id='checkpenciones'/>";
											?>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="right"><strong>Libranzas </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="libranza" type="text" class="Estilo12" id="libranza" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $libranza);	 ?>" />
											<?php
											if ($autom[2] == 'SI')
												echo "<input name='checklibranza' type='checkbox' id='checklibranza' disabled='disabled' checked='checked'/>";
											else
												echo "<input name='checklibranza' type='checkbox' disabled='disabled' id='checklibranza'/>";
											?>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="right"><strong>Fondo Solidaridad </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="f_solidaridad" type="text" class="Estilo12" id="f_solidaridad" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $f_solidaridad);	 ?>" />
											<?php
											if ($autom[3] == 'SI')
												echo "<input name='checkfsolidaridad' type='checkbox' id='checkfsolidaridad' disabled='disabled' checked='checked'/>";
											else
												echo "<input name='checkfsolidaridad' type='checkbox' disabled='disabled' id='checkfsolidaridad'/>";
											?>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td width="200">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="right"><strong>Fondo Empleados </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
									</div>
								</div>
							</td>
							<td width="200">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="f_empleados" type="text" class="Estilo12" id="f_empleados" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $f_empleados);	 ?>" />
											<?php
											if ($autom[4] == 'SI')
												echo "<input name='checkfempleados' type='checkbox' id='checkfempleados' disabled='disabled' checked='checked'/>";
											else
												echo "<input name='checkfempleados' type='checkbox' disabled='disabled' id='checkfempleados'/>";
											?>
										</div>
									</div>
								</div>
							</td>
							<td width="200">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="right"><strong>Sindicatos </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
									</div>
								</div>
							</td>
							<td width="200">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="sindicato" type="text" class="Estilo12" id="sindicato" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $sindicato);	 ?>" />
											<?php
											if ($autom[5] == 'SI')
												echo "<input name='checksindicato' type='checkbox' id='checksindicato' disabled='disabled' checked='checked'/>";
											else
												echo "<input name='checksindicato' type='checkbox' disabled='disabled' id='checksindicato'/>";
											?>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="right"><strong>Embargos Judiciales </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="embargo" type="text" class="Estilo12" id="embargo" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $embargo);	 ?>" />
											<?php
											if ($autom[6] == 'SI')
												echo "<input name='checkembargo' type='checkbox' id='checksembargo' disabled='disabled' checked='checked'/>";
											else
												echo "<input name='checkembargo' type='checkbox' disabled='disabled' id='checkembargo'/>";
											?>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="right"><strong>Cruce de Cuentas </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> : </strong></div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="cruce" type="text" class="Estilo12" id="cruce" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $cruce);	 ?>" />
											<?php
											if ($autom[7] == 'SI')
												echo "<input name='checkcruce' type='checkbox' id='checkcruce' disabled='disabled' checked='checked'/>";
											else
												echo "<input name='checkcruce' type='checkbox' disabled='disabled' id='checkcruce'/>";
											?>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="right"><strong>Otros </strong>(<span class="Estilo13">Digitar)</span><strong></strong><strong> </strong><strong>: </strong></div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="otros" type="text" class="Estilo12" id="otros" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $otros);	 ?>" />
											<?php
											if ($autom[8] == 'SI')
												echo "<input name='checkotros' type='checkbox' id='checkotros' disabled='disabled' checked='checked'/>";
											else
												echo "<input name='checkcotros' type='checkbox' disabled='disabled' id='checkotros'/>";
											?>
										</div>
									</div>
								</div>
							</td>
							<td></td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table> <!-- Descuentos y deducciones -->
		<table width="950" border="0" id="retenciones" align="center" style="display:block">
			<tr>
				<td colspan="5">
					<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
						<div align="center" class="Estilo4"> <strong> <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultarRETE('rete');"> ...::: RETENCIONES POR IMPUESTOS, TASAS Y CONTRIBUCIONES :::...</span></strong></div>
					</div>
					<table width="901" border="1" align="center" class="bordepunteado1" id="rete" style="display:block">
						<tr>
							<td colspan="5" bgcolor="#DCE9E5">
								<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
									<div align="center" class="Estilo12"><strong> RETENCIONES POR IMPUESTOS, TASAS Y CONTRIBUCIONES </strong></div>
								</div>
							</td>
						</tr>
						<tr>
							<td width="345">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>ReteFuente</strong></div>
									</div>
								</div>
							</td>
							<td width="100">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>BASE</strong></div>
									</div>
								</div>
							</td>
							<td width="100">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>TOPE</strong></div>
									</div>
								</div>
							</td>
							<td width="100">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>Tarifa </strong></div>
									</div>
								</div>
							</td>
							<td width="130">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>Valor a Retener</strong></div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center">
										<select name="retefuente" class="Estilo12" id="retefuente" style="width: 300px;" onchange="ValorRetencion(id);">
											<option value=""></option>
											<?php
											$retefuente = $_POST['retefuente'];
											if ($modi == 'modi') {
												$retefuente = $rowx['retefuente'];
											}
											include('../config.php');
											$query = "SELECT * FROM retefuente";
											$link  = new mysqli($server, $dbuser, $dbpass, $database);
											$result = $link->query($query);
											while ($row = $result->fetch_assoc()) {
												if ($row['concepto'] == $retefuente) {
													echo "<OPTION VALUE='$row[concepto]' selected>$row[concepto]</OPTION>";
												} else {
													echo "<OPTION VALUE='$row[concepto]' >$row[concepto]</OPTION>";
												}
											}
											?>
										</select>
										<?php
										if ($aut == "AUT") {
											echo "<a name=fte><input name='chkretefte' type='checkbox' value='SIAUT'checked='checked' id='chkretefte' onclick='envias(chkretefte.id,fte)'/> </a>";
										} else {
											if ($_POST["chkretefte"] == "SIAUT")
												echo "<input name='chkretefte' type='checkbox' value='SIAUT'checked='checked' id='chkretefte' onclick='envias(chkretefte.id)'/>";
											else
												echo "<input name='chkretefte' type='checkbox' value='NOAUT' id='chkretefte' onclick='envias(chkretefte.id)'/>";
										}
										?>
										<!--input name='chkretefte' type='checkbox' id='chkretefte' checked='checked' onclick='document.a.vr_retefuente.disabled=!document.a.vr_retefuente.disabled'/-->
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php
											$r = 0;
											if ($modi == 'modi') {
												$_POST["retefuente"] = 1;
											}
											if ($_POST["retefuente"] and ($aut == "AUT" or $_POST["chkretefte"] == "SIAUT")) {
												unset($_POST["vr_retefuente"]);
												$sqlxa = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$retefuente'";
												$resxa = $connectionxx->query($sqlxa);
												while ($rowxa = $resxa->fetch_assoc()) {
													$base = $rowxa["base"];
													$tope = $rowxa["tope"];
													$tarifa = $rowxa["tarifa"];
													if ($vr_obli_para_pago_mas_iva >= $base and ($vr_obli_para_pago_mas_iva <= $tope or $tope == '')) {
														$vr_retefuente = $vr_obli_para_pago_sin_iva * $tarifa;
														$vr_aut_reten[$r] = $vr_retefuente;
														$r++;
														// Tomo el valor de las configuraciones de acuerdo a los crieterios de aplicacion del if
														$base_info = $base;
														$tope_info = $tope;
														$tarifa_info = $tarifa;
													}
												}
											} else {
												$vr_retefuente = 0;
												$vr_aut_reten[$r] = $vr_retefuente;
												$r++;
											}
											echo number_format($base_info, 2, ',', '.');
											?>

										</div>
									</div>
								</div>
							</td>
							<!-- TOPE -->
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tope_info); ?> </div>
									</div>
								</div>
							</td>
							<!--FIN TOPE -->
							<td width="100">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tarifa_info); ?> </div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php
											if ($aut == "AUT") {
												$vr_retefuente = $vr_retefuente;
												echo "<input name='vr_retefuente' type='text' class='Estilo12' id='vr_retefuente' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_retefuente'/>";
												$aut = "yano";
											} else {
												if ($_POST["chkretefte"] == "SIAUT") {
													$vr_retefuente = $vr_retefuente;
													echo "<input name='vr_retefuente' type='text' class='Estilo12' id='vr_retefuente' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_retefuente'/>";
												} else {
													$vr_retefuente = $_POST['vr_retefuente'];
													echo "<input name='vr_retefuente' type='text' class='Estilo12' id='vr_retefuente' style='text-align:right' onkeypress='return validar(event)' value='$vr_retefuente'/>";
												}
											}

											?>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>ReteIVA</strong></div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td width="100" bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center">
										<select name="reteiva" class="Estilo12" id="reteiva" style="width: 300px;" onchange="ValorRetencion(id);">
											<option value=""></option>
											<?php
											$reteiva = $_POST['reteiva'];
											if ($modi == 'modi') {
												$reteiva = $rowx['reteiva'];
											}
											include('../config.php');
											$query = "SELECT * FROM reteiva";
											$link  = new mysqli($server, $dbuser, $dbpass, $database);
											$result = $link->query($query);
											while ($row = $result->fetch_assoc()) {
												if ($row['concepto'] == $reteiva) {
													echo "<OPTION VALUE=\"" . $row["concepto"] . "\" selected>" . $row["concepto"] . "</OPTION>";
												} else {
													echo "<OPTION VALUE=\"" . $row["concepto"] . "\">" . $row["concepto"] . "</OPTION>";
												}
											}
											?>
										</select>
										<?php
										if ($autiva == "AUTIVA") {
											echo "<input name='chkreteiva' type='checkbox' value='SIAUT' checked='checked' id='chkreteiva' onclick='envias(chkreteiva.id)'/>";
										} else {
											if ($_POST["chkreteiva"] == "SIAUT")
												echo "<input name='chkreteiva' type='checkbox' value='SIAUT'checked='checked' id='chkreteiva' onclick='envias(chkreteiva.id)'/>";
											else
												echo "<input name='chkreteiva' type='checkbox' value='NOAUT' id='chkreteiva' onclick='envias(chkreteiva.id)'/>";
										}
										?>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php
											if ($modi == 'modi') {
												$_POST["reteiva"] = 1;
											}
											if ($_POST["reteiva"] and ($autiva == "AUTIVA" or $_POST["chkreteiva"] == "SIAUT")) {
												$sqlxb = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$reteiva'";
												$resxb = $connectionxx->query($sqlxb);
												while ($rowxb = $resxb->fetch_assoc()) {
													$base = $rowxb["base"];
													$tope = $rowxb["tope"];
													$tarifa = $rowxb["tarifa"];
													if ($vr_obli_para_pago_mas_iva >= $base and ($vr_obli_para_pago_mas_iva <= $tope or $tope == '')) {
														$vr_reteiva = ($iva_vr_obli_pago * $tarifa);
														$vr_aut_reten[$r] = $vr_reteiva;
														$r++;
														$base_iva = $base;
														$tope_iva = $tope;
														$tarifa_iva = $tarifa;
													}
												}
											} else {
												$vr_reteiva = 0;
												$vr_aut_reten[$r] = $vr_reteiva;
												$r++;
											}
											echo number_format($base_iva, 2, ',', '.');
											?>
										</div>
									</div>
								</div>
							</td>
							<!-- TOPE -->
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tope_iva); ?> </div>
									</div>
								</div>
							</td>
							<!-- TOPE -->
							<td width="100" bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tarifa_iva); ?> </div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php


											if ($autiva == "AUTIVA") {
												$vr_reteiva = $vr_reteiva;
												echo "<input name='vr_reteiva' type='text' class='Estilo12' id='vr_reteiva' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_reteiva'/>";
												$autiva = "yano";
											} else {
												if ($_POST["chkreteiva"] == "SIAUT") {
													$vr_reteiva = $vr_reteiva;
													echo "<input name='vr_reteiva' type='text' class='Estilo12' id='vr_reteiva' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_reteiva'/>";
												} else {
													$vr_reteiva = $_POST['vr_reteiva'];
													echo "<input name='vr_reteiva' type='text' class='Estilo12' id='vr_reteiva' style='text-align:right' onkeypress='return validar(event)' value='$vr_reteiva'/>";
												}
											}
											?>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<?php
							if ($_POST["vr_reteica"] > 0) {
								$vr_reteica = $_POST["vr_reteica"];
								$vr_aut_reten[$r] = $vr_reteica;
								$r++;
								unset($_POST["vr_reteica"]);
							} else {
								$vr_reteica = 0;
								$vr_aut_reten[$r] = 0;
								$r++;
							}
							?>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>ReteICA / Otro </strong></div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td width="100">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="padding-left:22px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="left"><span class="Estilo4">
											<input name="reteica" type="text" class="Estilo4" id="reteica" onkeyup="a.reteica.value=a.reteica.value.toUpperCase();" size="60" value="RETEICA" readonly="" />
										</span></div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="a_partir_reteica" type="text" class="Estilo12" id="a_partir_reteica" style="text-align:right" onkeypress="return validar(event)" value="<?php $a_partir_reteica = $_POST['a_partir_reteica'];
																																																	printf("%s", $a_partir_reteica); ?>" />
										</div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="tarifa_reteica" type="text" class="Estilo12" id="tarifa_reteica" style="text-align:right" onkeypress="return validar(event)" value="<?php $tarifa_reteica = $_POST['tarifa_reteica'];
																																																printf("%s", $tarifa_reteica); ?>" />
										</div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td width="100">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="tarifa_reteica" type="text" class="Estilo12" id="tarifa_reteica" style="text-align:right" width="80" onkeypress="return validar(event)" value="<?php $tarifa_reteica = $_POST['tarifa_reteica'];
																																																		printf("%s", $tarifa_reteica); ?>" />
										</div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="vr_reteica" type="text" class="Estilo12" id="vr_reteica" style="text-align:right" onkeypress="return validar(event)" value="<?php $vr_reteica = $_POST['vr_reteica'];
																																														printf("%s", $vr_reteica); ?>" />
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>Estampilla 1</strong></div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td width="100" bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center">
										<select name="estampilla1" class="Estilo12" id="estampilla1" style="width: 300px;" onchange="ValorRetencion(id);">
											<option value=""></option>
											<?php
											$estampilla1 = $_POST['estampilla1'];
											if ($modi == 'modi') {
												$estampilla1 = $rowx['estampilla1'];
											}
											include('../config.php');
											$query = "SELECT * FROM estampillas";
											$link  = new mysqli($server, $dbuser, $dbpass, $database);
											$result = $link->query($query);
											while ($row = $result->fetch_assoc()) {
												if ($row['concepto'] == $estampilla1) {
													echo "<OPTION VALUE=\"" . $row["concepto"] . "\" selected>" . $row["concepto"] . "</OPTION>";
												} else {
													echo "<OPTION VALUE=\"" . $row["concepto"] . "\">" . $row["concepto"] . "</OPTION>";
												}
											}
											?>
										</select>
										<?php
										if ($autestun == "AUTESTUN") {
											echo "<input name='chkest1' type='checkbox' value='SIAUT' checked='checked' id='chkest1' onclick='envias(chkest1.id)'/>";
										} else {
											if ($_POST["chkest1"] == "SIAUT")
												echo "<input name='chkest1' type='checkbox' value='SIAUT'checked='checked' id='chkest1' onclick='envias(chkest1.id)'/>";
											else
												echo "<input name='chkest1' type='checkbox' value='NOAUT' id='chkest1' onclick='envias(chkest1.id)'/>";
										}
										?>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php
											if ($modi == 'modi') {
												$_POST["estampilla1"] = 1;
											}
											if ($_POST["estampilla1"] and ($autestun == "AUTESTUN" or $_POST["chkest1"] == "SIAUT")) {
												$sqlxc = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$estampilla1'";
												$resxc = $connectionxx->query($sqlxc);
												while ($rowxc = $resxc->fetch_assoc()) {
													$base = $rowxc["base"];
													$tope = $rowxc["tope"];
													$tarifa = $rowxc["tarifa"];
													if ($vr_obli_para_pago_mas_iva >= $base and ($vr_obli_para_pago_mas_iva <= $tope or $tope == '')) {
														$vr_estampilla1 = $vr_obli_para_pago_mas_iva * $tarifa;
														$vr_aut_reten[$r] = $vr_estampilla1;
														$r++;
														$base_e1 = $base;
														$tope_e1 = $tope;
														$tarifa_e1 = $tarifa;
													}
												}
											} else {
												$vr_estampilla1 = 0;
												$vr_aut_reten[$r] = $vr_estampilla1;
												$r++;
											}

											echo number_format($base_e1, 2, ',', '.');
											?>
										</div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tope_e1); ?> </div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td width="100" bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tarifa_e1); ?> </div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php
											if ($autestun == "AUTESTUN") {
												$vr_estampilla1 = $vr_estampilla1;
												echo "<input name='vr_estampilla1' type='text' class='Estilo12' id='vr_estampilla1' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla1'/>";
												$autestun = "yano";
												unset($_POST["vr_estamplilla1"]);
											} else {
												if ($_POST["chkest1"] == "SIAUT") {
													$vr_estampilla1 = $vr_estampilla1;
													echo "<input name='vr_estampilla1' type='text' class='Estilo12' id='vr_estampilla1' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla1'/>";
													unset($_POST["vr_estamplilla1"]);
												} else {
													$vr_estampilla1 = $_POST['vr_estampilla1'];
													echo "<input name='vr_estampilla1' type='text' class='Estilo12' id='vr_estampilla1' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla1'/>";
													unset($_POST["vr_estamplilla1"]);
												}
											}
											?>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>Estampilla 2</strong></div>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td width="100" bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center">
										<select name="estampilla2" class="Estilo12" id="estampilla2" style="width: 300px;" onchange="ValorRetencion(id);">
											<option value=""></option>
											<?php
											$estampilla2 = $_POST['estampilla2'];
											if ($modi == 'modi') {
												$estampilla2 = $rowx['estampilla2'];
											}
											include('../config.php');
											$query = "SELECT * FROM estampillas";
											$link  = new mysqli($server, $dbuser, $dbpass, $database);
											$result = $link->query($query);
											while ($row = $result->fetch_assoc()) {
												if ($row['concepto'] == $estampilla2) {

													echo "<OPTION VALUE=\"" . $row["concepto"] . "\" selected>" . $row["concepto"] . "</OPTION>";
												} else {
													echo "<OPTION VALUE=\"" . $row["concepto"] . "\">" . $row["concepto"] . "</OPTION>";
												}
											}
											?>
										</select>
										<?php
										if ($autestdo == "AUTESTDO") {
											echo "<input name='chkest2' type='checkbox' value='SIAUT' checked='checked' id='chkest2' onclick='envias(chkest2.id)'/>";
										} else {
											if ($_POST["chkest2"] == "SIAUT")
												echo "<input name='chkest2' type='checkbox' value='SIAUT'checked='checked' id='chkest2' onclick='envias(chkest2.id)'/>";
											else
												echo "<input name='chkest2' type='checkbox' value='NOAUT' id='chkest2' onclick='envias(chkest2.id)'/>";
										}
										?>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php
											if ($modi == 'modi') {
												$_POST["estampilla2"] = 1;
											}
											if ($_POST["estampilla2"] and ($autestdo == "AUTESTDO" or $_POST["chkest2"] == "SIAUT")) {
												unset($_POST["vr_estamplilla2"]);
												$sqlxd = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$estampilla2'";
												$resxd = $connectionxx->query($sqlxd);
												while ($rowxd = $resxd->fetch_assoc()) {
													$base = $rowxd["base"];
													$tope = $rowxd["tope"];
													$tarifa = $rowxd["tarifa"];
													if ($vr_obli_para_pago_mas_iva >= $base and ($vr_obli_para_pago_mas_iva <= $tope or $tope == '')) {
														$vr_estampilla2 = $vr_obli_para_pago_mas_iva * $tarifa;
														$vr_aut_reten[$r] = $vr_estampilla2;
														$r++;
														$base_e2 = $base;
														$tope_e2 = $tope;
														$tarifa_e2 = $tarifa;
													}
												}
											} else {
												$vr_estampilla2 = 0;
												$vr_aut_reten[$r] = $vr_estampilla2;
												$r++;
											}

											echo number_format($base_e2, 2, ',', '.');
											?>
										</div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tope_e2); ?> </div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td width="100" bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tarifa_e2); ?> </div>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php

											if ($autestdo == "AUTESTDO") {
												$vr_estampilla2 = $vr_estampilla2;
												echo "<input name='vr_estampilla2' type='text' class='Estilo12' id='vr_estampilla2' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla2'/>";
												$autestdo = "yano";
											} else {
												if ($_POST["chkest2"] == "SIAUT") {
													$vr_estampilla2 = $vr_estampilla2;
													echo "<input name='vr_estampilla2' type='text' class='Estilo12' id='vr_estampilla2' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla2'/>";
												} else {
													$vr_estampilla2 = $_POST['vr_estampilla2'];
													echo "<input name='vr_estampilla2' type='text' class='Estilo12' id='vr_estampilla2' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla2'/>";
												}
											}
											?>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>Estampilla 3</strong></div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td width="100" bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center">
										<select name="estampilla3" class="Estilo12" id="estampilla3" style="width: 300px;" onchange="ValorRetencion(id);">
											<option value=""></option>
											<?php
											$estampilla3 = $_POST['estampilla3'];
											if ($modi == 'modi') {
												$estampilla3 = $rowx['estampilla3'];
											}
											include('../config.php');
											$query = "SELECT * FROM estampillas";
											$link  = new mysqli($server, $dbuser, $dbpass, $database);
											$result = $link->query($query);
											while ($row = $result->fetch_assoc()) {
												if ($row['concepto'] == $estampilla3) {
													echo "<OPTION VALUE=\"" . $row["concepto"] . "\" selected>" . $row["concepto"] . "</OPTION>";
												} else {
													echo "<OPTION VALUE=\"" . $row["concepto"] . "\">" . $row["concepto"] . "</OPTION>";
												}
											}
											?>
										</select>
										<?php
										if ($autesttr == "AUTESTTR") {
											echo "<input name='chkest3' type='checkbox' value='SIAUT' checked='checked' id='chkest3' onclick='envias(chkest3.id)'/>";
										} else {
											if ($_POST["chkest3"] == "SIAUT")
												echo "<input name='chkest3' type='checkbox' value='SIAUT'checked='checked' id='chkest3' onclick='envias(chkest3.id)'/>";
											else
												echo "<input name='chkest3' type='checkbox' value='NOAUT' id='chkest3' onclick='envias(chkest3.id)'/>";
										}
										?>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php
											if ($modi == 'modi') {
												$_POST["estampilla3"] = 1;
											}
											if ($_POST["estampilla3"] and ($autesttr == "AUTESTTR" or $_POST["chkest3"] == "SIAUT")) {
												unset($_POST["vr_estamplilla3"]);
												$sqlxe = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$estampilla3'";
												$resxe = $connectionxx->query($sqlxe);
												while ($rowxe = $resxe->fetch_assoc()) {
													$base = $rowxe["base"];
													$tope = $rowxe["tope"];
													$tarifa = $rowxe["tarifa"];
													if ($vr_obli_para_pago_mas_iva >= $base and ($vr_obli_para_pago_mas_iva <= $tope or $tope == '')) {
														$vr_estampilla3 = $vr_obli_para_pago_mas_iva * $tarifa;
														$vr_aut_reten[$r] = $vr_estampilla3;
														$r++;
														$base_e3 = $base;
														$tope_e3 = $tope;
														$tarifa_e3 = $tarifa;
													}
												}
											} else {
												$vr_estampilla3 = 0;
												$vr_aut_reten[$r] = $vr_estampilla3;
												$r++;
											}
											echo number_format($base_e3, 2, ',', '.');
											?>
										</div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tope_e3); ?> </div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td width="100" bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tarifa_e3); ?> </div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php

											if ($autesttr == "AUTESTTR") {
												$vr_estampilla3 = $vr_estampilla3;
												echo "<input name='vr_estampilla3' type='text' class='Estilo12' id='vr_estampilla3' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla3'/>";
												$autesttr = "yano";
											} else {
												if ($_POST["chkest3"] == "SIAUT") {
													$vr_estampilla3 = $vr_estampilla3;
													echo "<input name='vr_estampilla3' type='text' class='Estilo12' id='vr_estampilla3' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla3'/>";
												} else {
													$vr_estampilla3 = $_POST['vr_estampilla3'];
													echo "<input name='vr_estampilla3' type='text' class='Estilo12' id='vr_estampilla3' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla3'/>";
												}
											}
											?>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>Estampilla 4 </strong></div>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td width="100" bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center">
										<select name="estampilla4" class="Estilo12" id="estampilla4" style="width: 300px;" onchange="ValorRetencion(id);">
											<option value=""></option>
											<?php
											$estampilla4 = $_POST['estampilla4'];
											if ($modi == 'modi') {
												$estampilla4 = $rowx['estampilla4'];
											}
											include('../config.php');
											$query = "SELECT * FROM estampillas";
											$link  = new mysqli($server, $dbuser, $dbpass, $database);
											$result = $link->query($query);
											while ($row = $result->fetch_assoc()) {
												if ($row['concepto'] == $estampilla4) {
													echo "<OPTION VALUE=\"" . $row["concepto"] . "\" selected>" . $row["concepto"] . "</OPTION>";
												} else {
													echo "<OPTION VALUE=\"" . $row["concepto"] . "\">" . $row["concepto"] . "</OPTION>";
												}
											}
											?>
										</select>
										<?php
										if ($autestcu == "AUTESTCU") {
											echo "<input name='chkest4' type='checkbox' value='SIAUT' checked='checked' id='chkest4' onclick='envias(chkest4.id)'/>";
										} else {
											if ($_POST["chkest4"] == "SIAUT")
												echo "<input name='chkest4' type='checkbox' value='SIAUT'checked='checked' id='chkest4' onclick='envias(chkest4.id)'/>";
											else
												echo "<input name='chkest4' type='checkbox' value='NOAUT' id='chkest4' onclick='envias(chkest4.id)'/>";
										}
										?>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php
											if ($modi == 'modi') {
												$_POST["estampilla4"] = 1;
											}
											if ($_POST["estampilla4"]  and ($autestcu == "AUTESTCU" or $_POST["chkest4"] == "SIAUT")) {
												unset($_POST["vr_estamplilla4"]);
												$sqlxf = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$estampilla4'";
												$resxf = $connectionxx->query($sqlxf);
												while ($rowxf = $resxf->fetch_assoc()) {
													$base = $rowxf["base"];
													$tope = $rowxf["tope"];
													$tarifa = $rowxf["tarifa"];
													if ($vr_obli_para_pago_mas_iva >= $base and ($vr_obli_para_pago_mas_iva <= $tope or $tope == '')) {
														$vr_estampilla4 = $vr_obli_para_pago_mas_iva * $tarifa;
														$vr_aut_reten[$r] = $vr_estampilla4;
														$r++;
														$base_e4 = $base;
														$tope_e4 = $tope;
														$tarifa_e4 = $tarifa;
													}
												}
											} else {
												$vr_estampilla4 = 0;
												$vr_aut_reten[$r] = $vr_estampilla4;
												$r++;
											}
											echo number_format($base_e4, 2, ',', '.');
											?>
										</div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tope_e4); ?> </div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td width="100" bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tarifa_e4); ?> </div>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php

											if ($autestcu == "AUTESTCU") {
												$vr_estampilla4 = $vr_estampilla4;
												echo "<input name='vr_estampilla4' type='text' class='Estilo12' id='vr_estampilla4' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla4'/>";
												$autestcu = "yano";
											} else {
												if ($_POST["chkest4"] == "SIAUT") {
													$vr_estampilla4 = $vr_estampilla4;
													echo "<input name='vr_estampilla4' type='text' class='Estilo12' id='vr_estampilla4' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla4'/>";
												} else {
													$vr_estampilla4 = $_POST['vr_estampilla4'];
													echo "<input name='vr_estampilla4' type='text' class='Estilo12' id='vr_estampilla4' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla4'/>";
												}
											}
											?>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>Estampilla 5 </strong></div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td width="100" bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center">
										<select name="estampilla5" class="Estilo12" id="estampilla5" style="width: 300px;" onchange="ValorRetencion(id);">
											<option value=""></option>
											<?php
											$estampilla5 = $_POST['estampilla5'];
											if ($modi == 'modi') {
												$estampilla5 = $rowx['estampilla5'];
											}
											include('../config.php');
											$query = "SELECT * FROM estampillas";
											$link  = new mysqli($server, $dbuser, $dbpass, $database);
											$result = $link->query($query);
											while ($row = $result->fetch_assoc()) {
												if ($row['concepto'] == $estampilla5) {

													echo "<OPTION VALUE=\"" . $row["concepto"] . "\" selected>" . $row["concepto"] . "</OPTION>";
												} else {
													echo "<OPTION VALUE=\"" . $row["concepto"] . "\">" . $row["concepto"] . "</OPTION>";
												}
											}
											?>
										</select>
										<?php
										if ($autestci == "AUTESTCI") {
											echo "<input name='chkest5' type='checkbox' value='SIAUT' checked='checked' id='chkest5' onclick='envias(chkest5.id)'/>";
										} else {
											if ($_POST["chkest5"] == "SIAUT")
												echo "<input name='chkest5' type='checkbox' value='SIAUT'checked='checked' id='chkest5' onclick='envias(chkest5.id)'/>";
											else
												echo "<input name='chkest5' type='checkbox' value='NOAUT' id='chkest5' onclick='envias(chkest5.id)'/>";
										}
										?>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php
											if ($modi == 'modi') {
												$_POST["estampilla5"] = 1;
											}
											if ($autestci == "AUTESTCI" or $_POST["chkest5"] == "SIAUT") {
												unset($_POST["vr_estamplilla5"]);
												$sqlxg = "SELECT base,tope,tarifa FROM rango WHERE concepto = '$estampilla5'";
												$resxg = $connectionxx->query($sqlxg);
												while ($rowxg = $resxg->fetch_assoc()) {
													$base = $rowxg["base"];
													$tope = $rowxg["tope"];
													$tarifa = $rowxg["tarifa"];
													if ($vr_obli_para_pago_mas_iva >= $base and ($vr_obli_para_pago_mas_iva <= $tope or $tope == '')) {
														$vr_estampilla5 = $vr_obli_para_pago_mas_iva * $tarifa;
														$vr_aut_reten[$r] = $vr_estampilla5;
														$r++;
														$base_e5 = $base;
														$tope_e5 = $tope;
														$tarifa_e5 = $tarifa;
													}
												}
											} else {
												$vr_estampilla5 = 0;
												$vr_aut_reten[$r] = $vr_estampilla5;
												$r++;
											}
											echo number_format($base_e5, 2, ',', '.');
											?>
										</div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tope_e5); ?> </div>
									</div>
								</div>
							</td>
							<!--TOPE -->
							<td width="100" bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"> <?php printf("%s", $tarifa_e5); ?> </div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php

											if ($autestci == "AUTESTCI") {
												$vr_estampilla5 = $vr_estampilla5;
												echo "<input name='vr_estampilla5' type='text' class='Estilo12' id='vr_estampilla5' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla5'/>";
												$autestci = "yano";
											} else {
												if ($_POST["chkest5"] == "SIAUT") {
													$vr_estampilla5 = $vr_estampilla5;
													echo "<input name='vr_estampilla5' type='text' class='Estilo12' id='vr_estampilla5' readonly='' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla5'/>";
												} else {
													$vr_estampilla5 = $_POST['vr_estampilla5'];
													echo "<input name='vr_estampilla5' type='text' class='Estilo12' id='vr_estampilla5' style='text-align:right' onkeypress='return validar(event)' value='$vr_estampilla5'/>";
												}
											}
											?>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table> <!-- Retenciones -->
		<table width="901" border="1" class="bordepunteado1" align="center">
			<tr>
				<td bgcolor="#66CCCC">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo4">
							<div align="center">
								<input name="Submit3" type="submit" class="Estilo4" id="Submit3" value="Calcular TODOS los Valores a Retener" onclick="this.form.action = 'modi_cecp.php'" />
							</div>
						</div>
					</div>
				</td>
				<td bgcolor="#990000">
					<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
						<div align="center" class="Estilo12"><span class="Estilo8"><strong> VALOR NETO A PAGAR : $
									<?php
									$total_pagado = $vr_obli_para_pago_mas_iva - ($salud + $pension + $libranza + $f_solidaridad + $f_empleados + $sindicato + $embargo + $cruce + $otros +
										$vr_retefuente +  $vr_reteiva + $vr_reteica + $vr_estampilla1 + $vr_estampilla2 + $vr_estampilla3 + $vr_estampilla4 + $vr_estampilla5);
									echo number_format($total_pagado, 2, ',', '.');
									?>
								</strong></span>
							<input name="total_pagado" type="hidden" class="Estilo12" id="total_pagado" value="<?php printf("%.0f", $total_pagado); ?>" />
						</div>
					</div>
				</td>
			</tr>
		</table>
		<br />
		<br />
		<table width="900" border="0" align="center">
			<tr>
				<td align="center"><b>FORMA DE PAGO</b></td>
			</tr>
			<tr>
				<td align="center">
					<?php $forma_pago = $_POST['forma_pago'];
					if ($modi == 'modi') {
						$forma_pago = $rowx['forma_pago'];
					}
					if ($forma_pago == 'CHEQUE') {
					?>
						<select name="forma_pago" class="Estilo4" id="forma_pago">
							<option value="EFECTIVO">EFECTIVO</option>
							<option value="CHEQUE" selected="selected">CHEQUE</option>
							<option value="TRANSFERENCIA">TRANSF. ELECTRONICA</option>
							<option value="CRUCE DE CUENTAS">CRUCE DE CUENTAS</option>
						</select>
					<?php
					}
					?>
					<?php
					if ($forma_pago == 'EFECTIVO') {
					?>
						<select name="forma_pago" class="Estilo4" id="forma_pago">
							<option value="EFECTIVO" selected="selected">EFECTIVO</option>
							<option value="CHEQUE">CHEQUE</option>
							<option value="TRANSFERENCIA">TRANSF. ELECTRONICA</option>
							<option value="CRUCE DE CUENTAS">CRUCE DE CUENTAS</option>
						</select>
					<?php
					}
					?>
					<?php
					if ($forma_pago == 'TRANSFERENCIA') {
					?>
						<select name="forma_pago" class="Estilo4" id="forma_pago">
							<option value="EFECTIVO">EFECTIVO</option>
							<option value="CHEQUE">CHEQUE</option>
							<option value="TRANSFERENCIA" selected="selected">TRANSF. ELECTRONICA</option>
							<option value="CRUCE DE CUENTAS">CRUCE DE CUENTAS</option>
						</select>
					<?php
					}
					?>
					<?php
					if ($forma_pago == 'CRUCE DE CUENTAS') {
					?>
						<select name="forma_pago" class="Estilo4" id="forma_pago">
							<option value="EFECTIVO">EFECTIVO</option>
							<option value="CHEQUE">CHEQUE</option>
							<option value="TRANSFERENCIA">TRANSF. ELECTRONICA</option>
							<option value="CRUCE DE CUENTAS" selected="selected">CRUCE DE CUENTAS</option>
						</select>
					<?php
					}
					?>
					<?php
					if ($forma_pago == '') {
					?>
						<select name="forma_pago" class="Estilo4" id="forma_pago">
							<option value="EFECTIVO">EFECTIVO</option>
							<option value="CHEQUE" selected="selected">CHEQUE</option>
							<option value="TRANSFERENCIA">TRANSF. ELECTRONICA</option>
							<option value="CRUCE DE CUENTAS">CRUCE DE CUENTAS</option>
						</select>
					<?php
					}
					?>
				</td>

			</tr>
		</table>
		<br />
		</div>
		</div>
		<span class="Estilo20">
		</span><br /> <!-- Forma de pago -->
		<table width="1000" border="1" align="center" class="bordepunteado1">
			<tr>
				<td colspan="5">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo4">
							<div align="center"><strong>IMPORTANTE</strong><br />
								<br />
								Si la cuenta que desea utilizar no aparece en el listado de CUENTAS P.G.C.P, posiblemente se encuentra BLOQUEADA. <br />
								Consulte el Item 4.2 del Menu Principal - Opcion &quot;Maestro P.G.C.P &quot;
							</div>
						</div>
					</div>
				</td>
			</tr>
			<?php
			$ia = 0;
			$zz = 0;
			$v_deb = 0;
			for ($ef = 1; $ef <= 20; $ef++) {
				$input_cuenta = "cuenta_cxp" . $ef;
				$cuentac = $_POST["$input_cuenta"];
				$input_valor = "valor_pto" . $ef;
				$debitos_cargados = $_POST["vr_deb_$ef"];
				if ($cuentac != '') {
					include('../config.php');
					$queryy = "SELECT * FROM cca_cxp WHERE cod_pptal='$cuentac'";
					$linkk = new mysqli($server, $dbuser, $dbpass, $database);
					$result2 = $linkk->query($queryy);
					while ($rowq = $result2->fetch_assoc()) {
						$pgcpctadeb = $rowq["pgcp1"];
						$pgcpctacre = $rowq["pgcp6"];
						$cuentacero[$ia] = $pgcpctadeb;
					}

					$postcero[$ia] = $input_valor;
					$ia++;
					$v_deb++;
				}
			}
			$postreten = array('vr_retefuente', 'vr_reteiva', 'vr_reteica', 'vr_estampilla1', 'vr_estampilla2', 'vr_estampilla3', 'vr_estampilla4', 'vr_estampilla5');
			$posttotal = array_merge($auxauto, $postreten);
			$numpost = count($auxauto);
			for ($i = 0; $i < $numpost; $i++) {
				if ($_POST["$auxauto[$i]"] > 0) {
					$postcero[$ia] = $auxauto[$i];
					$cuentacero[$ia] = $cuenta[$i];
					$ia++;
				}
			}
			$numpost = count($postreten);
			for ($i = 0; $i < $numpost; $i++) {
				if ($_POST["$postreten[$i]"] > 0 or $vr_aut_reten[$i] > 0) {
					$postcero[$ia] = $postreten[$i];
					$vr_aut_reten_cero[$zz] = $vr_aut_reten[$i];
					$zz++;
					$postnom = substr($postreten[$i], 3);
					if ($postnom == "retefuente") {
						$query = "SELECT cuenta FROM retefuente where concepto='$_POST[$postnom]'";
						$link  = new mysqli($server, $dbuser, $dbpass, $database);
						$result = $link->query($query);
						$row = $result->fetch_assoc();
						$cuentacero[$ia] = $row["cuenta"];
					}
					if ($postnom == "reteiva") {
						$query = "SELECT cuenta FROM reteiva where concepto='$_POST[$postnom]'";
						$link  = new mysqli($server, $dbuser, $dbpass, $database);
						$result = $link->query($query);
						$row = $result->fetch_assoc();
						$cuentacero[$ia] = $row["cuenta"];
					}
					if ($postnom == "reteica") {
						$cuentacero[$ia] = $cuenta[$numcuenta - 1];
					}
					if ($postnom == "estampilla1") {
						$query = "SELECT cuenta FROM estampillas where concepto='$_POST[$postnom]'";
						$link  = new mysqli($server, $dbuser, $dbpass, $database);
						$result = $link->query($query);
						$row = $result->fetch_assoc();
						$cuentacero[$ia] = $row["cuenta"];
					}
					if ($postnom == "estampilla2") {
						$query = "SELECT cuenta FROM estampillas where concepto='$_POST[$postnom]'";
						$link  = new mysqli($server, $dbuser, $dbpass, $database);
						$result = $link->query($query);
						$row = $result->fetch_assoc();
						$cuentacero[$ia] = $row["cuenta"];
					}
					if ($postnom == "estampilla3") {
						$query = "SELECT cuenta FROM estampillas where concepto='$_POST[$postnom]'";
						$link  = new mysqli($server, $dbuser, $dbpass, $database);
						$result = $link->query($query);
						$row = $result->fetch_assoc();
						$cuentacero[$ia] = $row["cuenta"];
					}
					if ($postnom == "estampilla4") {
						$query = "SELECT cuenta FROM estampillas where concepto='$_POST[$postnom]'";
						$link  = new mysqli($server, $dbuser, $dbpass, $database);
						$result = $link->query($query);
						$row = $result->fetch_assoc();
						$cuentacero[$ia] = $row["cuenta"];
					}
					if ($postnom == "estampilla5") {
						$query = "SELECT cuenta FROM estampillas where concepto='$_POST[$postnom]'";
						$link  = new mysqli($server, $dbuser, $dbpass, $database);
						$result = $link->query($query);
						$row = $result->fetch_assoc();
						$cuentacero[$ia] = $row["cuenta"];
					}
					$ia++;
				}
			}
			$postcero[$ia] = "total_pagado";
			$cuentacero[$ia] = $pgcpctacre;
			$numpost = count($postcero);
			$contador1 = count($postcero);
			//print_r($postcero);
			//print_r($cuentacero);
			if ($modi == 'modi') {
				$h = 0;
				for ($h = 1; $h < 15; $h++) {
					if ($rowx['pgcp' . $h] != '') {
						$cuentacero[$h - 1] = $rowx['pgcp' . $h];
						$numpost = count($cuentacero);
						$contador1 = $numpost;
					}
				}
			}

			//print_r($cuentacero);	
			?>
			<tr>
				<td colspan="5" bgcolor="#DCE9E5">
					<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
						<div align="center" class="Estilo4"><strong>MOVIMIENTO CONTABLE
								<input type="hidden" name='contador' value='<?php print $contador1; ?>' id="contador">
								<input type="hidden" name='contini' value='<?php print $numpost; ?>' id="contini"><br />
								<img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='masitem();'>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<span id='contis' class='Estilo4'><?php printf("%s", $contador1); ?></span>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<img src="images/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='menitem();'>
							</strong></div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo4"><strong>DIGITE CUENTA P.G.C.P </strong></div>
					</div>
				</td>
				<td>
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo4"><strong>DATOS DE LA CUENTA</strong><strong></strong> </div>
					</div>
				</td>
				<td>
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo4"><strong>VALOR DEBITO </strong></div>
					</div>
				</td>
				<td>
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo4"><strong>VALOR CREDITO </strong></div>
					</div>
				</td>
				<td>
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo4"><strong>No. Dcto / Cheque </strong></div>
					</div>
				</td>
			</tr>
			<?php

			$aa = 0;
			$vrete = 0;
			$acc = 'block';
			//print_r($vr_aut_reten);
			//print_r($vr_aut_reten_cero);
			for ($i = 1; $i <= 25; $i++) {
				if ($aa < $v_deb) // se ejecuta de acuerdo al numero de rubros para sellecionar la cuenta contable
				{
					$varauxd = round($_POST["$postcero[$aa]"], 0);
					$varauxc = 0;
				} else // Cuando termina de cargar los rubros con cuenta debito 
				{
					if ($_POST["$postcero[$aa]"] == 0) {
						$pp = $postcero[$aa];
						$varauxc = round($vr_aut_reten_cero[$vrete], 0);
						$varauxd = 0;
						$vrete++;
					} else {
						$varauxc = round($vr_aut_reten_cero[$vrete], 0);
						$varauxd = 0;
						$totdeb += $varauxc;
						$vrete++;
					}
				}
				if ($postcero[$aa] == 'total_pagado') {
					$varauxd = 0;
					$varauxc = round($total_pagado, 0);
				}
				$query = "SELECT nom_rubro FROM pgcp where cod_pptal='$cuentacero[$aa]'";
				$link  = new mysqli($server, $dbuser, $dbpass, $database);
				$result = $link->query($query);
				$row1 = $result->fetch_assoc();
				if ($modi == 'modi') {
					$varauxd = $rowx['vr_deb_' . $i];
					$varauxc = $rowx['vr_cre_' . $i];
					$cheque = $rowx['num_cheque' . $i];
				}
				echo "<tr style='position:relative; display:$acc;' id='fil$i'>
		  <td valign='middle'><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'> <span class='Estilo4'>
			  <input name='pgcp$i' type='text' class='Estilo4' id='pgcp$i' style='width:180px;' value='$cuentacero[$aa]' onkeyup='lookup(this.value,$i);'>
		  </span></div>
		 <div class='suggestionsBox' id='sugges$i' style='display: none; position:absolute; left: 80px;'>
					<img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'>
					<div class='suggestionList' id='autoSug$i'>
						&nbsp;
					</div>
		 </div>
		  </td>
		  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
			  <div align='center' class='Estilo4'>
				<div align='left' id='resulta$i'>$row1[nom_rubro]</div>
			  </div>
		  </div></td>
		  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
			  <div align='center' class='Estilo4'>
				<div align='right'>
				  <input name='vr_deb_$i' type='text' class='Estilo4' id='vr_deb_$i' style='text-align:right' value='$varauxd' onkeypress='return validar(event)' onkeyup='Calcular();' onfocus='siespgcp($i);'>
				</div>
			  </div>
		  </div></td>
		  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
			  <div align='center' class='Estilo4'>
				<div align='right'>
				  <input name='vr_cre_$i' type='text' class='Estilo4' id='vr_cre_$i' style='text-align:right' value='$varauxc' onkeypress='return validar(event)' onkeyup='Calcular();' onfocus='siespgcp($i);'>
				</div>
			  </div>
		  </div></td>
		  <td><div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
			  <div align='center' class='Estilo4'>
				<div align='right'>
				  <input name='num_cheque$i' type='text' class='Estilo4' id='cheque_$i'  value='$cheque' style='text-align:right'>
				</div>
			  </div>
		  </div></td>
		</tr>";
				$aa++;
				if ($i == $numpost) {
					$acc = 'none';
				}
			}
			$contador1++;
			?>
			<tr>
				<td bgcolor="#990000">&nbsp;</td>
				<td bgcolor="#990000">
					<div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
						<div align="right" class="Estilo8 Estilo9">
							<div align="center"><strong>VERIFIQUE QUE LAS SUMAS SEAN IGUALES ANTES DE GRABAR</strong></div>
						</div>
					</div>
				</td>
				<td bgcolor="#FFFFFF">
					<div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
						<div align="center" class="Estilo12">
							<div align="right">
								<input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right" value="0.00" />
							</div>
						</div>
					</div>
				</td>
				<td bgcolor="#FFFFFF" class="Estilo4">
					<div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
						<div align="center" class="Estilo12">
							<div align="right">
								<input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" value="0.00" />
							</div>
						</div>
					</div>
				</td>
				<td bgcolor="#990000">
					<div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
						<div align="center" class="Estilo12">
							<div align="right">
								<input name="total" type="text" class="Estilo12" id="total" style="text-align:right" value="0.00" readonly />
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td width="190">&nbsp;</td>
				<td width="420">&nbsp;</td>
				<td width="130">&nbsp;</td>
				<td width="130">&nbsp;</td>
				<td width="130">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5">
					<div class="Estilo19" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
						<div align="center">
							<input name="Submit322" type="submit" class="Estilo19" value="Modificar Comprobante de Egreso Cuentas x Pagar" onClick="return validarForm()" />
						</div>
					</div>
				</td>
			</tr>
		</table>
		</td> <!-- Movimeinto contable -->
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		</form>
		<tr>
			<td colspan="3">
				<div style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:5px;">
					<div align="center">

						<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
							<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
								<div align="center">
									<?php
									printf("
				
				<center class='Estilo4'>
				<form method='post' action='pagos_tesoreria_cxp.php'>
				<input type='hidden' name='nn' value='CECP'>
				...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
				</form>
				</center>
				");

									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
					<div align="center"> <span class="Estilo4">Fecha de esta Sesion:</span> <br />
						<span class="Estilo4"> <strong>
								<?php
								include('../config.php');
								$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
								$sqlxx = "select * from fecha";
								$resultadoxx = $connectionxx->query($sqlxx);

								while ($rowxx = $resultadoxx->fetch_assoc()) {
									$ano = $rowxx["ano"];
								}
								echo $ano;
								?>
							</strong> </span> <br />
						<span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"]; ?></u> </span>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td width="266">
				<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
					<div align="center"><?php include('../config.php');
										echo $nom_emp ?><br />
						<?php echo $dir_tel ?><BR />
						<?php echo $muni ?> <br />
						<?php echo $email ?> </div>
				</div>
			</td>
			<td width="266">
				<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
					<div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
						</a><BR />
						<a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a>
					</div>
				</div>
			</td>
			<td width="266">
				<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
					<div align="center">Desarrollado por <br />
						<a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
						Derechos Reservados - 2009
					</div>
				</div>
			</td>
		</tr>
		</table> <!-- Fin de la tabla -->
	</body>

	</html>
<?php
}
?>