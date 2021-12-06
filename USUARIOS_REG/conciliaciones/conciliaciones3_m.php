<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--html xmlns="http://www.w3.org/1999/xhtml"-->
<html lang="es" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Conciliaciones</title>
	<script type="text/javascript" src="jquery.js"></script>
	<style type="text/css">
		input {
			font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #333333;
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

		#divCargando {
			position: absolute;
			top: 5px;
			right: 5px;
			background-color: red;
			color: white;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12px;
			font-weight: bold;
			padding: 5px;
		}
	</style>
	<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
	</link>
	<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
	<script>
		// JavaScript Document
		function EnviarForm(formulario, ruta, div)
		// formulario: nombre del formulario que vamos a eviar por ajax, ruta: es el archivo que realizará la petición del servidor
		{
			// valido formulario campos obligtorios
			var valida = 0;
			for (i = 0; i < formulario.elements.length; i++) {
				var input = formulario.elements[i].id;
				var obli = input.substring(0, 3);
				if (obli == 'OBL') {
					// validar que el campo este marcado como OBL_xxxxxx este lleno
					var elemento = formulario.elements[i].id;
					var campo = formulario.elements[i].value;
					if (campo == '') {
						alert("El campo es obligatorio...");
						//var pestana = elemento.split('_');
						// muestro la pestaña que contiene el elemento validado
						//VerPestana(pestana[1]);
						formulario.elements[i].focus();
						valida = 1;
						break;

					}
				}
			}


			// si validacion ok envio el formulario
			if (valida == 0) {
				// Enciende mensaje de espera 
				$("#divCargando").show();
				// Carga los valores del formulario en un array serializado
				var valores = $(formulario).serialize();
				// Envio la peticion al servidor
				$.ajax({
					type: 'POST',
					url: ruta,
					data: valores,
					cache: false,
					// async:false,
					// •beforeSend : Indicamos el nombre de la función que se ejecutará previo al envío de datos gif animado

					success: function(respuesta) // indica la funcion que se ejecutar cuando obtenemos la respuersta del servidor
					{
						// iniciamos desvanecimiento
						$("#" + div).fadeOut(function() {
							$(this)
								.html(respuesta)
								.fadeIn();
						});
						// Apagamos el aviso de cargando
						$("#divCargando").hide();
					}
				});
			} // end valida
		} // end funcion


		function validar(e) {
			tecla = (document.all) ? e.keyCode : e.which;
			if (tecla == 8 || tecla == 46 || tecla == 44 || tecla == 86) return true; //Tecla de retroceso (para poder borrar) 
			patron = /\d/; //ver nota 
			te = String.fromCharCode(tecla);
			return patron.test(te);
		}
		// Funcion para mostrar cualquier archivo en el div contenido desde el munu pricipal
		function cargaArchivo(archivo, div, valor) {

			var fecha = document.getElementById('fecha').value;
			var comp = document.getElementById('comp').value;
			var cheque = document.getElementById('cheque').value;
			var deb = document.getElementById('deb').value;
			var cre = document.getElementById('cre').value;
			archivo = archivo + '&fecha=' + fecha + '&comp=' + comp + '&cheque=' + cheque + '&deb=' + deb + '&cre=' + cre;
			$("#" + div).load(archivo);
		}

		function conciAnterior(id, archivo, div) {
			archivo = archivo + '?datos=' + id;
			$("#" + div).load(archivo);
			// recorres los input para ver cual esta marcado
			for (i = 1; i < 6; i++) {
				var control = 'ctr_' + i;
				var cual = document.getElementById(control);

				if (cual.checked) {
					if (i == 1) {
						document.getElementById('fecha').select();
					}
					if (i == 2) {
						document.getElementById('comp').select();
					}
					if (i == 3) {
						document.getElementById('cheque').select();
					}
					if (i == 4) {
						document.getElementById('deb').select();
					}
					if (i == 5) {
						document.getElementById('cre').select();
					}
				}
			}
			//document.getElementById('cheque').select();

		}

		function cargaArch(archivo, div) {
			$("#" + div).load(archivo);

		}

		// Para eliminar archivos con mensaje de conformacion
		function borrarRegistro(archivo, div) {
			if (confirm("Esta seguro de eliminar el registrio?")) {
				$("#" + div).load(archivo);
			}
		}
	</script>
	<style type="text/css">
		.Estilo8 {
			font-weight: bold
		}

		.Estilo9 {
			font-weight: bold
		}

		.Estilo10 {
			color: #FFFFFF;
			font-weight: bold;
		}

		.Estilo11 {
			color: #FFFFFF
		}
	</style>
</head>

<body>
	<div id="divCargando" style="display:none">
		Por favor espere...
	</div>
	<?php
	include('../config.php');

	$fecha_fin = $_POST['fecha_fin'];
	$cuenta = $_POST['cuenta'];
	//$nom_rubro=$_POST['nom_rubro'];
	/*
$fecha_fin='2015/07/31';
$cuenta='1110050903';
*/
	?>
	<table width="800" border="0" align="center">
		<tr>

			<td width="798" colspan="3">
				<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
					<div align="center">
						<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
					</div>
				</div>
			</td>
		</tr>

		<tr>
			<td colspan="3">
				<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
					<div align="center">
						<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
							<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
								<div align="center"><a href='aa1.php?mes=<?php echo $fecha_fin; ?>&cuenta=<?php echo $cuenta; ?>' target='_parent'>VOLVER </a> </div>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
	</table>
	<center> <b>DATOS SELECCIONADOS POR EL USUARIO</b><br /><br> </center>
	<?php
	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sq = "select * from aux_conciliaciones where fecha_fin ='$fecha_fin' and cuenta='$cuenta' ";
	$re = $cx->query($sq);
	while ($rw = $re->fetch_assoc()) {
		$saldo_extracto = $rw["saldo_extracto"];
		$nom_rubro = $rw['nom_rubro'];
	} //printf(" nom_rubro : $nom_rubro<br>");


	//menos un mes

	$a = date("Y", strtotime($fecha_fin));
	$b = date("m", strtotime($fecha_fin));
	$c = date("d", strtotime($fecha_fin));



	// dias calendario

	// dias calendario
	if ($bis == 1) {
		$ene = 31;
		$feb = 29;
		$mar = 31;
		$abr = 30;
		$may = 31;
		$jun = 30;
		$jul = 31;
		$ago = 31;
		$sep = 30;
		$oct = 31;
		$nov = 30;
		$dic = 31;
	} else {
		$ene = 31;
		$feb = 28;
		$mar = 31;
		$abr = 30;
		$may = 31;
		$jun = 30;
		$jul = 31;
		$ago = 31;
		$sep = 30;
		$oct = 31;
		$nov = 30;
		$dic = 31;
	}

	// no mes

	$nene = "01";
	$nfeb = "02";
	$nmar = "03";
	$nabr = "04";
	$nmay = "05";
	$njun = "06";
	$njul = "07";
	$nago = "08";
	$nsep = "09";
	$noct = "10";
	$nnov = "11";
	$ndic = "12";


	//printf("nago: %s  b: %s ",$nago,$b);


	if ($b == $nene or $b == $nmar or $b == $nmay or $b == $njul or $b == $nago or $b == $noct or $b == $ndic) {
		$ts1 = strtotime($fecha_fin);
		$ts = strtotime('-30 days', $ts1);
		$fecha_mes_ant = date('Y/m/d', $ts);
	}

	if ($b == $nabr or $b == $njun or $b == $nsep or $b == $nnov) {
		$ts1 = strtotime($fecha_fin);
		$ts = strtotime('-29 days', $ts1);
		$fecha_mes_ant = date('Y/m/d', $ts);
	}

	if ($bis == 1) {
		if ($b == $nfeb) {
			$ts1 = strtotime($fecha_fin);
			$ts = strtotime('-28 days', $ts1);
			$fecha_mes_ant = date('Y/m/d', $ts);
		}
	} else {
		if ($b == $nfeb) {
			$ts1 = strtotime($fecha_fin);
			$ts = strtotime('-27 days', $ts1);
			$fecha_mes_ant = date('Y/m/d', $ts);
		}
	}
	// imprime tabla del encabezado
	printf("
<center class='Estilo4'>
<table width='600' border='1' align='center' class='bordepunteado1'>
<td align='right' width='200'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Cuenta : </b>
</div>
</td>
<td align='center' width='400'>
%s
</td>
</tr>
<td align='right'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Nombre : </b>
</div>
</td>
<td align='center'>
%s
</td>
</tr>
<tr>
<td  align='right'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Fecha Inicial : </b>
</div>
</td>
<td align='center'>
%s
</td>
</tr>
<td align='right'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Fecha Final : </b>
</div>
</td>
<td align='center'>
%s
</td>
</tr>
<td  align='right'>
<div style='padding-left:10px; padding-top:3px; padding-right:10px; padding-bottom:3px;'>
<b>Saldo en Extracto : </b>
</div>
</td>
<td align='center'>
%s
</td>
</table>
", $cuenta, $nom_rubro, $fecha_mes_ant, $fecha_fin, number_format($saldo_extracto, 2, ',', '.'));
	?>
	<!--LISTA DE DCTOS SIN CONCILIAR VIGENCIAS ANTERIORES-->
	<div align="left" style="padding-left:145px"><input type="button" name="boton" value="Pendientes" style="background:#72A0CF; color:#FFFFFF; border:none;cursor:pointer" onclick="cargaArch('form_pendi.php?cuenta=<?php echo $cuenta; ?>&fecha_fin=<?php echo $fecha_fin; ?>','conten')" />
		<input type="button" name="boton" value="Archivo plano" style="background:#F60; color:#FFFFFF; border:none;cursor:pointer" onclick="window.open('upload_a.php?fecha=<?php echo $fecha_fin; ?>, 'MiPestañaNueva' , 'width=800, height=600')" />
	</div>
	<?php
	//*** encabezado del informe

	printf("
<table width='1000' BORDER='0' class='bordepunteado1'>
	
	<tr bgcolor='#DCE9E5'>
	<td align='center' width='140' colspan='2'><b>Fecha</b></td>
	<td align='center' width='90'><span class='Estilo4'><b>Comprobante</b></span></td>
	<td align='center' width='380'><span class='Estilo4'><b>Tercero</b></span></td>
	<td align='center' width='100'><span class='Estilo4'><b>Doc/Cheque</b></span></td>
	<td align='center' width='100'><span class='Estilo4'><b>Debito</b></span></td>
	<td align='center' width='100'><span class='Estilo4'><b>Credito</b></span></td>
	<td align='center' width='100'><span class='Estilo4'><b>Estado</b></span></td>
	</tr>
	<tr bgcolor='#DCE9E5'>
	<td align='center' width='140' colspan='2'><b><input type='checkbox' name='ctr_1' id='ctr_1' value=''></b></td>
	<td align='center' width='90'><span class='Estilo4'><b><input type='checkbox' name='ctr_2' id='ctr_2' value=''></b></span></td>
	<td align='center' width='380'><span class='Estilo4'><b></b></span></td>
	<td align='center' width='100'><span class='Estilo4'><b><input type='checkbox' name='ctr_3' id='ctr_3' value=''></b></span></td>
	<td align='center' width='100'><span class='Estilo4'><b><input type='checkbox' name='ctr_4' id='ctr_4' value=''></b></span></td>
	<td align='center' width='100'><span class='Estilo4'><b><input type='checkbox' name='ctr_5' id='ctr_5' value=''></b></span></td>
	<td align='center' width='100'><span class='Estilo4'></b></span></td>
	</tr>
	
	<tr bgcolor='#ffffff'>
	<td align='center' colspan=2><input name='fecha' id='fecha' size ='12' value ='' onkeyup=cargaArchivo('conciliaciones3.php?cuenta=$cuenta&fecha_fin=$fecha_fin','conten')></td>
	<td align='center' ><input name='comp' id='comp' size ='10' onkeyup=cargaArchivo('conciliaciones3.php?cuenta=$cuenta&fecha_fin=$fecha_fin','conten')></td>
	<td align='right' ><span class='Estilo4'></td>
	<td align='center' ><input name='cheque' id='cheque' size ='8' onkeyup=cargaArchivo('conciliaciones3.php?cuenta=$cuenta&fecha_fin=$fecha_fin','conten')></td>
	<td align='center' ><input name='deb' id='deb' size ='12' onkeyup=cargaArchivo('conciliaciones3.php?cuenta=$cuenta&fecha_fin=$fecha_fin','conten')></td>
	<td align='center'><input name='cre' id='cre' size ='12' onkeyup=cargaArchivo('conciliaciones3.php?cuenta=$cuenta&fecha_fin=$fecha_fin','conten')></td>
	<td align='center' ><span class='Estilo4'><b>Estado</b></span></td>
	</tr>
	</table>	
	");
	?>
	<div id="conten"><?php include('conciliaciones3.php') ?> </div>
	<div id="ejecuta"></div>
	<div id="imp"><?php echo "<a href='imp_conciliacion.php?cuenta=$cuenta&fecha_fin=$fecha_fin'>Imprimir</a>"; ?></div>



	<table width="800" border="0" align="center">

		<tr>
			<td colspan="3">
				<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
					<div align="center">
						<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
							<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
								<div align="center"><a href='aa1.php?mes=<?php echo $fecha_fin; ?>&cuenta=<?php echo $cuenta; ?>' target='_parent'>VOLVER </a> </div>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
	</table>