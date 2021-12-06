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
		<meta http-equiv="Content-Type" content="text/html; charset=latin1" />
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

			function mostrarVentana() {
				var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
				var x = screen.width;
				ventana.style.marginTop = "200px"; // Definimos su posici�n vertical. La ponemos fija para simplificar el c�digo
				ventana.style.marginLeft = x - 300; //((document.body.clientWidth-10) / 2) +  "px"; // Definimos su posici�n horizontal
				ventana.style.display = 'block'; // Y lo hacemos visible
				parent.frames['datamain'].window.location.reload();

			}

			function ocultarVentana() {
				var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
				ventana.style.display = 'none'; // Y lo hacemos invisible


			}

			function Puntero() {
				document.body.style.cursor = "Pointer";
			}

			function PunteroNormal() {
				document.body.style.cursor = "Default";
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

			</style><script>function mas_inputs() {
				var vari=document.getElementById('contis2').innerHTML;

				if (vari >=20) {
					vari=20;
				}

				else {
					varix=parseFloat(vari)+1;
					document.getElementById('contis2').innerHTML=varix;
					document.getElementById('filas').value=varix;
					var mostrar='inputx'+varix;
					document.getElementById(mostrar).style.display="block";
				}
			}

			function menos_inputs() {
				vari2=document.getElementById('contis2').innerHTML;

				if (vari2 > 1) {
					vari2=parseFloat(vari2);
					document.getElementById('contis2').innerHTML=vari2 - 1;
					document.getElementById('filas').value=vari2 - 1; // envio el valor de las filas actuales al input para enviar tama�o al post 
					var mostrar='inputx'+vari2;
					document.getElementById(mostrar).style.display="none";
					document.getElementById('valor_pto'+ vari2).value='';
					document.getElementById('cuenta_cxp'+ vari2).value='';
					valor_a_pagar();
				}
			}


			function iva2() {
				var valor_a_pagar=parseFloat(document.getElementById('vr_obli_para_pago_mas_iva').value);
				var iva=parseFloat(document.getElementById('iva').value) / 100;
				iva3=iva+1;

				if (iva3) {
					var valor_sin_iva=valor_a_pagar / iva3;
					document.getElementById('vr_obli_para_pago_sin_iva').value=Math.round(valor_sin_iva);
					var valor_iva=valor_a_pagar - valor_sin_iva;
					document.getElementById('iva_vr_obli_pago').value=Math.round(valor_iva);
				}
			}


			function valor_a_pagar() {
				var suma=0;

				for (i=1; i <=20; i++) {
					var valor=document.getElementById('valor_pto'+ i).value;

					if (valor) {
						suma=suma+parseFloat(valor);
					}
				}

				document.getElementById('vr_obli_para_pago_mas_iva').value=suma;
				iva2();
			}

			function rubroDuplicado(id) {
				var cont=0;

				for (i=1; i <=20; i++) {
					var valor=document.getElementById('cuenta_cxp'+ i).value;

					if (valor) {
						for (j=1; j <=20; j++) {
							var existe=document.getElementById('cuenta_cxp'+ j).value;

							if (valor==existe) {
								cont++;

								if (cont > 1) {
									alert("La cuenta ya ha sido seleccionada");
									document.getElementById('cuenta_cxp'+ j).value='';
								}
							}
						}

						var cont=0;

					}
				}
			}


			function CuentaDetalle(id) {
				var rubro=document.getElementById(id).value;
				var pos_url2='consultas/tipo_rubro.php';
				var req=new XMLHttpRequest();

				if (req) {
					req.onreadystatechange=function() {
						if (req.readyState==4) {
							tipo_dato=req.responseText;

							if (tipo_dato=='M') {
								alert("La cuenta seleccionada no es de detalle");
								document.getElementById(id).focus();
							}

							else {
								rubroDuplicado(id);
							}
						}
					}

					req.open('POST', pos_url2 + '?cod='+ rubro, true);
					req.send(null);
				}
			}

			function VerificaSaldo(id) {
				valor_pago=document.getElementById('valor_pto'+ id).value;
				valor_actual=document.getElementById('actual'+ id).value;
				//var num = id.substring(9);
				var rubro=document.getElementById('cuenta_cxp'+ id).value;

				if (rubro=='') {
					document.getElementById(id).value='';
					alert("No ha seleccionado un rubro presupuestal");
				}

				var pos_url2='consultas/consulta_saldo2.php';
				var req=new XMLHttpRequest();

				if (req) {
					req.onreadystatechange=function() {
						if (req.readyState==4) {
							var estado=req.responseText; //alert(estado);

							if (estado !='') {
								alert("El Valor a pagar es mayor al saldo del rubro...");
								document.getElementById('valor_pto'+ id).value=estado;
								document.getElementById('valor_pto'+ id).focus();
							}

							else {
								valor_a_pagar();
							}
						}
					}

					req.open('POST', pos_url2 + '?cod='+ valor_pago + '&rubro='+ rubro + '&actual='+ valor_actual, false);
					req.send(null);
				}
			}


			function validarForm() {

				var tern=document.getElementById('ter_nat').value;
				var terj=document.getElementById('ter_jur').value;

				//alert(tern +'fgasdg '+ terj)
				//return (false);
				if ((tern==''&& terj=='') || (tern=='nat'&& terj=='jur') || (tern==''&& terj=='jur') || (tern=='nat'&& tern=='')) {
					alert("Falta seleccionar un tercero");
					document.getElementById('tercerosn').focus();
					return (false);
				}

				var filas=document.getElementById('contis2').innerHTML;

				for (i=1; i <=filas; i++) {
					var cuenta=document.getElementById('cuenta_cxp'+ i).value;

					if (cuenta=='') {
						alert("Falta seleccionar el rubro presupuestal");
						document.getElementById('cuenta_cxp'+ i).focus();
						return (false);
					}

					var valor=document.getElementById('valor_pto'+ i).value;

					if (valor=='') {
						alert("Falta digitar el valor a pagar");
						document.getElementById('valor_pto'+ i).focus();
						return (false);
					}
				}

				var total=document.getElementById('total').value;

				if (total !=0) {
					alert("Las suma de bebitos y  creditos es diferente de cero");
					document.getElementById('total').focus();
					return (false);
				}

				var cuentas=document.all.tablaf.rows.length;

				if ( !document.all.tablaf.rows.length) {
					alert("No ha generado el movimiento...");
					document.getElementById('generar').focus();
					return (false);

				}

				i=0;

				for (i=1; i <=cuentas; i++) {
					var cuenta=document.getElementById('pgcp'+ i).value;

					if (cuenta=='') {
						alert("Falta seleccionar la cuenta contable");
						document.getElementById('pgcp'+ i).focus();
						return (false);
					}
				}

				i=0;

				for (i=1; i <=cuentas; i++) {
					var cuenta=document.getElementById('pgcp'+ i).value;
					var banco=cuenta.substring(0, 4);

					if (banco=='1110'|| banco=='1120') {
						var cheque=document.getElementById('num_cheque'+ i).value;

						if (cheque=='') {
							alert("Falta seleccionar el n�mero de cheque");
							document.getElementById('num_cheque'+ i).focus();
							return (false);
						}
					}
				}

				//alert (cuentas); return (false);

				return (true);
			}

			//*******************************
			function valida_tabla() {
				var sw=0;
				var sw2=0;

				//alert(existe);
				if (existe==1) {
					var fecha_obcg=document.getElementById('fechaobcghidden').value; //id_obcg  fechaobcghidden
					var fecha_ceva=document.getElementById('fecha_ceva').value;
					var fo=fecha_obcg.split('/');
					var fc=fecha_ceva.split('/');

					var dia_o=fo[2];
					var mes_o=fo[1];
					var ano_o=fo[0];
					var dia_c=fc[2];
					var mes_c=fc[1];
					var ano_c=fc[0];

					var fechao=ano_o+mes_o+dia_o;
					var fechac=ano_c+mes_c+dia_c;

					//alert (fechao);
					//alert (fechac);
					//return (false);

					if (parseInt(fechac) < parseInt(fechao)) {
						alert("La fecha obcg "+ fecha_obcg + " es mas reciente que la fecha ceva "+ fecha_ceva + " se debe cambiarla");
						existe=1;
						document.getElementById('fecha_ceva').focus();
						return (false);
					}

					if (document.getElementById('des_ceva').value=='') {
						alert("El campo descripcion es obligatorio...");
						existe=1;
						document.getElementById('des_ceva').focus();
						return (false);
					}

					if (document.getElementById('vr_retefuente').value==0 && existe2==1) {
						alert("El valor de retencion es 0 deberie elegir una opcion...");
						existe2=0;
						document.getElementById('retefuente').focus();
						return (false);


					}

					if (document.getElementById('total').value !=0) {
						/*alert(fechao);
						alert(fechac);*/

						alert(" Las sumas debitos y creditos no son iguales");

						existe=1;
						document.getElementById('total').focus();
						return (false);

					}



					var sumato=document.all.tablaf.rows.length;

					for (var i=1; i <=sumato; i++) {
						var subcadena=document.getElementById('pgcp'+ i).value;

						var aux=subcadena.substring(0, 4);

						if (aux=="1110"&& document.getElementById('num_cheque'+ i).value=='') {
							if (document.getElementById('resulta'+ i).value=='') {

								alert("Debe seleccionar una cuenta de Bancos a nivel de detalle "+ subcadena + "xx");
								document.getElementById('pgcp'+ i).focus();
								existe=1;
								break;

							}

							//else sw=1;
							alert("debe llenar el numero de cheque");
							document.getElementById('num_cheque'+ i).focus();
							existe=1;
							break;
						}

						//else sw2=1;


						if (document.getElementById('pgcp'+ i).value=='') {
							alert("campo vacio! debe completarlo para continuar");
							document.getElementById('pgcp'+ i).focus();
							existe=1;
							break;
						}

						existe=0;
					}





					//if(sw==1&&sw2==1) existe=0;

					//document.getElementById('valor').focus();
					if (existe==1) return (false);
					if (existe==0) return (true);
				}

				return (true);

			}

			//******************************
			</script><script> //********************************

			function retefuentef(ids) {

				var valorxpagar=document.getElementById('vr_obli_para_pago_sin_iva').value;

				var pos_url='consultas/consulta.php';


				var req=new XMLHttpRequest();

				if (req) {
					req.onreadystatechange=function() {


						if (req.readyState==4 && (req.status==200 || req.status==304)) {
							var cadena=req.responseText;
							//alert (cadena);

							var cadsplit=cadena.split('/');



							document.getElementById('vr_retefuente').value=Math.round(cadsplit[0]);
							document.getElementById('tarifa_e').innerHTML=cadsplit[1]+'%';
							document.getElementById('partir').innerHTML=valorxpagar;

						}
					}

					req.open('GET', pos_url + '?cod='+ ids + '&valor='+ valorxpagar, false);
					req.send(null);
				}

				tres();





			}

			//*****************campos  de reteiva *******************************
			//*******************************************************************



			function ret_iva(ids) {

				var valoriva=document.getElementById('iva_vr_obli_pago').value;
				var valorsiniva=document.getElementById('vr_obli_para_pago_sin_iva').value;
				//alert (valorsiniva);

				var pos_url='consultas/consultas2.php';


				var req=new XMLHttpRequest();

				if (req) {
					req.onreadystatechange=function() {
						if (req.readyState==4) {
							var cadena=req.responseText;
							// alert(cadena);

							var cadsplit=cadena.split('/');

							document.getElementById('vr_reteiva').value=Math.round(cadsplit[0]);


							// alert (cadsplit[1]);

							document.getElementById('partir_iva').innerHTML=valoriva;
							document.getElementById('tarifa_iva').innerHTML=cadsplit[1]+'%';
						}
					}

					req.open('GET', pos_url + '?cod='+ ids + '&valoriva='+ valoriva + '&valorsiniva='+ valorsiniva, false);
					req.send(null);
				}

				tres();



			}

			// fincion otros

			function otro() {
				var valxpagar=document.getElementById('vr_obli_para_pago_sin_iva').value;
				var partir=document.getElementById('a_partir_reteica').value;
				//
				var tarifaica=document.getElementById('tarifa_reteica').value;
				var totica=0;

				if (valxpagar >=partir) {
					totica=valxpagar * (tarifaica / 100);
				}

				else totica=0;

				document.getElementById('vr_reteica').value=Math.round(totica);
				//neto();
				//llenartabla();
			}

			//funcion estampilla 1

			function estamp1(ids, id) {

				//var valorxpagar= document.getElementById('valorPagar').value;
				var valorxpagar=document.getElementById('vr_obli_para_pago_mas_iva').value;
				//alert (valorxpagar);//valorneto

				var pos_url='consultas/consulta.php';


				var req=new XMLHttpRequest();

				if (req) {
					req.onreadystatechange=function() {
						if (req.readyState==4 && (req.status==200 || req.status==304)) {


							var cadena=req.responseText;

							var cadsplit=cadena.split('/');

							if (id=='estampilla1') {
								if (document.getElementById('estampilla1').value !=document.getElementById('estampilla2').value && document.getElementById('estampilla1').value !=document.getElementById('estampilla3').value && document.getElementById('estampilla1').value !=document.getElementById('estampilla4').value && document.getElementById('estampilla1').value !=document.getElementById('estampilla5').value) {
									document.getElementById('vr_'+ id).value=Math.round(cadsplit[0]);
									document.getElementById('b_'+ id).innerHTML=valorxpagar;
									document.getElementById('t_'+ id).innerHTML=cadsplit[1]+'%';

								}
							}

							if (id=='estampilla2') {
								if (document.getElementById('estampilla2').value !=document.getElementById('estampilla1').value && document.getElementById('estampilla2').value !=document.getElementById('estampilla3').value && document.getElementById('estampilla2').value !=document.getElementById('estampilla4').value && document.getElementById('estampilla2').value !=document.getElementById('estampilla5').value) {
									document.getElementById('vr_'+ id).value=Math.round(cadsplit[0]);
									document.getElementById('b_'+ id).innerHTML=valorxpagar;
									document.getElementById('t_'+ id).innerHTML=cadsplit[1]+'%';
								}
							}

							if (id=='estampilla3') {
								if (document.getElementById('estampilla3').value !=document.getElementById('estampilla2').value && document.getElementById('estampilla3').value !=document.getElementById('estampilla1').value && document.getElementById('estampilla3').value !=document.getElementById('estampilla4').value && document.getElementById('estampilla3').value !=document.getElementById('estampilla5').value) {
									document.getElementById('vr_'+ id).value=Math.round(cadsplit[0]);
									document.getElementById('b_'+ id).innerHTML=valorxpagar;
									document.getElementById('t_'+ id).innerHTML=cadsplit[1]+'%';
								}
							}

							if (id=='estampilla4') {
								if (document.getElementById('estampilla4').value !=document.getElementById('estampilla2').value && document.getElementById('estampilla4').value !=document.getElementById('estampilla3').value && document.getElementById('estampilla4').value !=document.getElementById('estampilla1').value && document.getElementById('estampilla4').value !=document.getElementById('estampilla5').value) {
									document.getElementById('vr_'+ id).value=Math.round(cadsplit[0]);
									document.getElementById('b_'+ id).innerHTML=valorxpagar;
									document.getElementById('t_'+ id).innerHTML=cadsplit[1]+'%';
								}
							}

							if (id=='estampilla5') {
								if (document.getElementById('estampilla5').value !=document.getElementById('estampilla2').value && document.getElementById('estampilla5').value !=document.getElementById('estampilla3').value && document.getElementById('estampilla5').value !=document.getElementById('estampilla4').value && document.getElementById('estampilla5').value !=document.getElementById('estampilla1').value) {
									document.getElementById('vr_'+ id).value=Math.round(cadsplit[0]);
									document.getElementById('b_'+ id).innerHTML=valorxpagar;
									document.getElementById('t_'+ id).innerHTML=cadsplit[1]+'%';
								}
							}

							//document.getElementById('vr_'+id).value = 0;
							//else
							//document.getElementById('vr_'+id).value = Math.round(req.responseText);
						}
					}

					req.open('GET', pos_url + '?cod='+ ids + '&valor='+ valorxpagar, false);
					req.send(null);
				}

				tres();

			}

			function neto() {
				var net=parseFloat(document.getElementById('vr_obli_para_pago_mas_iva').value);
				var rfuente=parseFloat(document.getElementById('vr_retefuente').value);
				var riva=parseFloat(document.getElementById('vr_reteiva').value);
				var rica=parseFloat(document.getElementById('vr_reteica').value);
				var es1=parseFloat(document.getElementById('vr_estampilla1').value);
				var es2=parseFloat(document.getElementById('vr_estampilla2').value);
				var es3=parseFloat(document.getElementById('vr_estampilla3').value);
				var es4=parseFloat(document.getElementById('vr_estampilla4').value);
				var es5=parseFloat(document.getElementById('vr_estampilla5').value);
				var pen=parseFloat(document.getElementById('pension').value);
				var soli=parseFloat(document.getElementById('f_solidaridad').value);
				var sindi=parseFloat(document.getElementById('sindicato').value);
				var cru=parseFloat(document.getElementById('cruce').value);
				var sal=parseFloat(document.getElementById('salud').value);
				var libr=parseFloat(document.getElementById('libranza').value);
				var empleo=parseFloat(document.getElementById('f_empleados').value);
				var embargo=parseFloat(document.getElementById('embargo').value);
				var otrosd=parseFloat(document.getElementById('otros').value);

				document.getElementById('total_pagado').value=Math.round((net - (rfuente + riva + rica + es1 + es2 + es3 + es4 + es5 + pen + soli + sindi + cru + sal + libr + empleo + embargo + otrosd)) * 100) / 100;
				//ceros();
			}

			function ceros() {
				if (document.getElementById('salud').value=='') document.getElementById('salud').value=0;
				if (document.getElementById('libranza').value=='') document.getElementById('libranza').value=0;
				if (document.getElementById('f_empleados').value=='') document.getElementById('f_empleados').value=0;
				if (document.getElementById('embargo').value=='') document.getElementById('embargo').value=0;
				if (document.getElementById('otros').value=='') document.getElementById('otros').value=0;
				if (document.getElementById('pension').value=='') document.getElementById('pension').value=0;
				if (document.getElementById('f_solidaridad').value=='') document.getElementById('f_solidaridad').value=0;
				if (document.getElementById('sindicato').value=='') document.getElementById('sindicato').value=0;
				if (document.getElementById('cruce').value=='') document.getElementById('cruce').value=0;

				if (document.getElementById('vr_retefuente').value=='') document.getElementById('vr_retefuente').value=0;
				if (document.getElementById('vr_reteiva').value=='') document.getElementById('vr_reteiva').value=0; // identificador iva
				if (document.getElementById('vr_reteica').value=='') document.getElementById('vr_reteica').value=0; // identificador ica
				if (document.getElementById('vr_estampilla1').value=='') document.getElementById('vr_estampilla1').value=0; //estampilla1
				if (document.getElementById('vr_estampilla2').value=='') document.getElementById('vr_estampilla2').value=0; //estampilla2
				if (document.getElementById('vr_estampilla3').value=='') document.getElementById('vr_estampilla3').value=0; //estampilla3
				if (document.getElementById('vr_estampilla4').value=='') document.getElementById('vr_estampilla4').value=0; //estampilla4
				if (document.getElementById('vr_estampilla5').value=='') document.getElementById('vr_estampilla5').value=0; //estampilla5

				//tablaIni();
			}

			function bod() {
				ceros();
				tablaIni();
			}

			function tablaIni() {
				var filas=document.getElementById('filas_tabla').value;
				var filas2=document.getElementById('conti').value; //alert (filas2);
				var sumad=0;
				var sumac=0;

				for (var h=1; h <=parseInt(filas); h++) {
					agregar();
					datos(h);
				}

				for (var j=1; j < parseInt(filas2); j++) {
					mas_inputs();


				}

				for (var t=1; t <=parseInt(filas2); t++) {

					var aux=document.getElementById('cuenta_cxp'+ t).value;
					//alert (aux);

					con_valor_cta(t, aux);
					//document.getElementById('valor_pto'+t).value=document.getElementById('vr_deb_'+t).value;

				}

				for (var i=1; i <=parseInt(filas); i++) {
					sumad=sumad+parseInt(document.getElementById('vr_deb_'+ i).value);
					sumac=sumac+parseInt(document.getElementById('vr_cre_'+ i).value);
				}

				document.getElementById('tot_deb_a').value=sumad;
				document.getElementById('tot_cre_a').value=sumad;

			}

			//*****FUNCION PARA CONSULTAR EL VALOR DE LA CUENTA EN LA TABLA INICIAL....

			function con_valor_cta(t, cta) {
				//alert(t+"->"+cta);
				var id=document.getElementById('id_cp').value;
				var pos_url='consultas/con_cta2.php';
				var x2=parseInt(t);
				var req=new XMLHttpRequest();

				if (req) {
					req.onreadystatechange=function() {
						if (req.readyState==4) {
							var cadena=req.responseText;
							document.getElementById('valor_pto'+ t).value=cadena;
							document.getElementById('actual'+ t).value=cadena;

						}
					}

					req.open('GET', pos_url + '?id='+ id + '&cta='+ cta, false);
					req.send(null);
				}

			}

			//********* fin funcion consultar ************

			function datos(h1) //Datos de la tabla contabilidad automatica

				{
				var id=document.getElementById('id_cp').value;
				var pos_url='consultas/con_cta.php';
				var x2=parseInt(h1);
				var req=new XMLHttpRequest();

				if (req) {
					req.onreadystatechange=function() {
						if (req.readyState==4) {
							var cadena=req.responseText;
							var cadsplit=cadena.split('*');
							document.getElementById('pgcp'+ x2).value=cadsplit[0];
							document.getElementById('resulta'+ x2).value=cadsplit[1];
							document.getElementById('vr_deb_'+ x2).value=cadsplit[2];
							document.getElementById('vr_cre_'+ x2).value=cadsplit[3];
							document.getElementById('num_cheque'+ x2).value=cadsplit[4];
						}
					}

					req.open('GET', pos_url + '?cod='+ id + '&con='+ x2, false);
					req.send(null);
				}

			}

			function tres() {
				//llenartabla()   //llena la tabla con datos
				ceros();
				neto(); //calcular neto
				//otro();         //calcular otro
				//poner en ceros
				//sumacredito();
				//sumadebito();
				//diferencia();
			}

			var contLin=1;
			var conaux=1;

			//***********************************
			function agregar() {
				fila=document.all.tablaf.rows.length - 1;

				if (fila < 14) {
					var tr,
					td;
					var v1=document.getElementById('retefuente').value;
					var v2=document.getElementById('reteiva').value;
					//var v55=document.getElementById('id_obcg').value;

					tr=document.all.tablaf.insertRow();
					td=tr.insertCell();
					td.innerHTML="<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'> <input type='text' size='28' style='text-align:left' id='pgcp"+contLin+"' name='pgcp"+contLin+"' value='' onkeyup='lookup(this.value,"+contLin+");' >  </span></div> <div class='suggestionsBox' id='sugges"+contLin+"' style='display: none; position:absolute; left: 130px;'><img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'> <div class='suggestionList' id='autoSug"+contLin+"' align=left> &nbsp;  </div> </div>";

					td=tr.insertCell();
					td.innerHTML="<input type='text' size='40' style='text-align:left' name='resulta"+contLin+"' id='resulta"+contLin+"' value='' readonly >";

					td=tr.insertCell();
					td.innerHTML="<input type='text' size='25' style='text-align:right' name='vr_deb_"+contLin+"' id='vr_deb_"+contLin+"' value=0  onKeyUp='cuatro();' onkeypress='return validar(event)' >";

					td=tr.insertCell();
					td.innerHTML="<input type='text' size='26' style='text-align:right' name='vr_cre_"+contLin+"' id='vr_cre_"+contLin+"' value=0  onKeyUp='cuatro();' onkeypress='return validar(event)' >";

					td=tr.insertCell();
					td.innerHTML="<input type='text' size='29' style='text-align:right' name='num_cheque"+contLin+"' id='num_cheque"+contLin+"' value='' >";
					contLin++;


				}
			}



			function cuatro() {
				sumacredito();
				sumadebito();
				diferencia();
			}

			function borrarUltima() {

				ultima=document.all.tablaf.rows.length - 1;

				if (ultima >=conaux) {
					document.all.tablaf.deleteRow(ultima);
					contLin--;
				}
			}

			function borraruna(i) {

				document.all.tablaf.deleteRow(i);

			}






			//*******************************
			</script>< !--validacion de forms
			-->
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

			.Estilo41 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
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


			function muestra_saldo(id) {

				var idc = document.getElementById('id_cp').value;
				var input_cuenta = "cuenta_cxp" + id.substring(9);
				var cuenta = document.getElementById(input_cuenta).value;
				var pos_url2 = 'consultas/muestra_saldo2.php';
				var req1 = new XMLHttpRequest();
				if (req1) {
					req1.onreadystatechange = function() {
						if (req1.readyState == 4) {
							document.getElementById(id).value = req1.responseText;
						}
					}
					req1.open('POST', pos_url2 + '?cod=' + cuenta + '&id=' + idc, false);
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
		</script>
		<script>
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


			var res;

			//funcion para llenar la tabla dinamica
			function verificar(id) {
				var pos_url = 'consultas/con_descuentos.php';


				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							id2 = req.responseText;
							//alert ("esto"+id2);

						}
					}
					req.open('GET', pos_url + '?cod=' + id, false);
					req.send(null);
				}
				return id2;

			}
			//*********FUNCION OTROS***************
			function cta_otros(ids, con) {
				//alert (ids+'-'+con);
				var pos_url = 'consultas/con_cta_otros.php';


				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							// var p=req.responseText; alert (p);
							document.getElementById('pgcp' + con).value = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + ids, false);
					req.send(null);
				}

			}

			//*************************************
			var acum;

			function llenartabla() {
				var n_filas = document.getElementById('filas').value;
				//alert (n_filas);
				var contador = document.all.tablaf.rows.length


				for (var j = 0; j < contador; j++) {
					var auxi = document.all.tablaf.rows.length - 1
					//alert("contador de filas borrar: "+auxi+'contador j  '+j);
					document.all.tablaf.deleteRow(auxi);
					//contLin--;


				}
				//alert("contador de filas borrar: "+contLin);
				contLin = 1;

				//var cont=1;
				acum = 0;

				var salud = parseInt(document.getElementById('salud').value);
				var libranza = parseInt(document.getElementById('libranza').value);
				var empleados = parseInt(document.getElementById('f_empleados').value);
				var embargo = parseInt(document.getElementById('embargo').value);
				var otros = parseInt(document.getElementById('otros').value);
				var pension = parseInt(document.getElementById('pension').value);
				var solidaridad = parseInt(document.getElementById('f_solidaridad').value);
				var sindicato = parseInt(document.getElementById('sindicato').value);
				var cruce = parseInt(document.getElementById('cruce').value);

				var irfuente = parseInt(document.getElementById('vr_retefuente').value); //identificador ret fuente
				var iriva = parseInt(document.getElementById('vr_reteiva').value); // identificador iva
				var irica = parseInt(document.getElementById('vr_reteica').value); // identificador ica
				var irest1 = parseInt(document.getElementById('vr_estampilla1').value); //estampilla1
				var irest2 = parseInt(document.getElementById('vr_estampilla2').value); //estampilla2
				var irest3 = parseInt(document.getElementById('vr_estampilla3').value); //estampilla3
				var irest4 = parseInt(document.getElementById('vr_estampilla4').value); //estampilla4
				var irest5 = parseInt(document.getElementById('vr_estampilla5').value); //estampilla5

				var par = 2;
				var impar = 1;
				var acum2 = 0;
				for (var h = 1; h <= parseInt(n_filas); h++) {
					agregar();
					cta_cecp(h);
					impar = impar + 2;
					par = par + 2;


				}




				var cont = document.all.tablaf.rows.length;





				//alert (irfuente+','+iriva+','+irica+','+irest1+','+irest2+','+irest3+','+irest4+','+irest5);
				if (salud != 0 && document.getElementById('salud').value != '') {
					var id55 = "SALUD";
					res = verificar(id55); // alert ("llego salud "+res);
					if (res == "SI") {
						cont++;
						agregar()
						var id = 'SALUD';
						cta_otros(id, cont);
						document.getElementById('vr_cre_' + cont).value = document.getElementById('salud').value;
						//document.getElementById('t'+cont+'4').value=res;
						var id2 = document.getElementById('pgcp' + cont + '').value;
						cta_nombre_cta(id2, cont);
					} else acum = acum + salud;


				}
				if (libranza != 0 && document.getElementById('libranza').value != '') {

					var id55 = "LIBRANAS";
					res = verificar(id55); // alert ("llego libranzas  "+res);
					if (res == "SI") {
						cont++;
						agregar()
						var id = 'LIBRANAS';
						cta_otros(id, cont);
						document.getElementById('vr_cre_' + cont).value = document.getElementById('libranza').value;
						var id2 = document.getElementById('pgcp' + cont + '').value;
						cta_nombre_cta(id2, cont);
					} else acum = acum + parseInt(document.getElementById('libranza').value);
				}

				if (empleados != 0 && document.getElementById('f_empleados').value != '') {
					var id55 = "FONDO EMPLEADOS";
					res = verificar(id55); //alert ("llego fondo  "+res);
					if (res == "SI") {
						cont++;
						agregar()
						var id = 'FONDO EMPLEADOS';
						cta_otros(id, cont);
						document.getElementById('vr_cre_' + cont).value = document.getElementById('f_empleados').value;
						var id2 = document.getElementById('pgcp' + cont + '').value;
						cta_nombre_cta(id2, cont);
					} else acum = acum + parseInt(document.getElementById('f_empleados').value);
				}

				if (embargo != 0 && document.getElementById('embargo').value != '') {
					var id55 = "EMBARGOS JUDICIALES";
					res = verificar(id55); // alert ("llego embargos  "+res);
					if (res == "SI") {
						cont++;
						agregar()
						var id = 'EMBARGOS JUDICIALES';
						cta_otros(id, cont);
						document.getElementById('vr_cre_' + cont).value = document.getElementById('embargo').value;
						var id2 = document.getElementById('pgcp' + cont + '').value;
						cta_nombre_cta(id2, cont);
					} else acum = acum + parseInt(document.getElementById('embargo').value);

				}
				if (otros != 0 && document.getElementById('otros').value != '') {
					var id55 = "OTROS";
					res = verificar(id55); //alert ("llego otros  "+res);
					if (res == "SI") {
						cont++;
						agregar()
						var id = 'OTROS';
						cta_otros(id, cont);
						document.getElementById('vr_cre_' + cont).value = document.getElementById('otros').value;
						var id2 = document.getElementById('pgcp' + cont + '').value;
						cta_nombre_cta(id2, cont);
					} else acum = acum + otros;

				}
				if (pension != 0 && document.getElementById('pension').value != '') {

					var id55 = "PENSION";
					res = verificar(id55); // alert ("llego pension  "+res);
					if (res == "SI") {
						cont++;
						agregar()
						var id = 'PENSION';
						cta_otros(id, cont);
						document.getElementById('vr_cre_' + cont).value = document.getElementById('pension').value;
						var id2 = document.getElementById('pgcp' + cont + '').value;
						cta_nombre_cta(id2, cont);
					} else acum = acum + parseInt(document.getElementById('pension').value);

				}

				if (solidaridad != 0 && document.getElementById('f_solidaridad').value != '') {

					var id55 = "FONDO SOLIDARIDAD";
					res = verificar(id55); // alert ("llego solidaridad  "+res);
					if (res == "SI") {
						cont++;
						agregar()
						var id = 'FONDO SOLIDARIDAD';
						cta_otros(id, cont);
						document.getElementById('vr_cre_' + cont).value = document.getElementById('f_solidaridad').value;
						var id2 = document.getElementById('pgcp' + cont + '').value;
						cta_nombre_cta(id2, cont);
					} else acum = acum + parseInt(document.getElementById('f_solidaridad').value);
				}
				if (sindicato != 0 && document.getElementById('sindicato').value != '') {
					var id55 = "SINDICATOS";
					res = verificar(id55); //alert ("llego sindicato  "+res);
					if (res == "SI") {
						cont++;
						agregar()
						var id = 'SINDICATOS';
						cta_otros(id, cont);
						document.getElementById('vr_cre_' + cont).value = document.getElementById('sindicato').value;
						var id2 = document.getElementById('pgcp' + cont + '').value;
						cta_nombre_cta(id2, cont);
					} else acum = acum + parseInt(document.getElementById('sindicato').value);
				}
				if (cruce != 0 && document.getElementById('cruce').value != '') {
					var id55 = "CRUCE DE CUENTAS";
					res = verificar(id55); // alert ("llego cruce  "+res);
					if (res == "SI") {
						cont++;
						agregar()
						var id = 'CRUCE DE CUENTAS';
						cta_otros(id, cont);
						document.getElementById('vr_cre_' + cont).value = document.getElementById('cruce').value;
						var id2 = document.getElementById('pgcp' + cont + '').value;
						cta_nombre_cta(id2, cont);
					} else acum = acum + parseInt(document.getElementById('cruce').value);
				}



				if (irfuente != 0 && document.getElementById('vr_retefuente').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('retefuente').value;
					//document.getElementById('t'+cont+'1').value=document.getElementById('retefuente').value;
					document.getElementById('vr_cre_' + cont).value = document.getElementById('vr_retefuente').value;
					cta_retefuente(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;

					cta_nombre_cta(id2, cont);


				}
				if (iriva != 0 && document.getElementById('vr_reteiva').value != '') {
					cont++;
					agregar()
					//document.getElementById('t'+cont+'1').value=document.getElementById('reteiva').value;
					var id = document.getElementById('reteiva').value;
					document.getElementById('vr_cre_' + cont).value = document.getElementById('vr_reteiva').value;
					cta_reteiva(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);

				}
				if (irica != 0 && document.getElementById('vr_reteica').value != '') {
					cont++;
					agregar()
					var id = 'ReteICA';
					cta_otros(id, cont);
					//document.getElementById('t'+cont+'1').value=document.getElementById('reteica').value;
					document.getElementById('vr_cre_' + cont).value = document.getElementById('vr_reteica').value;
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);

				}
				if (irest1 != 0 && document.getElementById('vr_estampilla1').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('estampilla1').value;
					//document.getElementById('t'+cont+'1').value=document.getElementById('estampilla1').value;
					document.getElementById('vr_cre_' + cont).value = document.getElementById('vr_estampilla1').value;
					cta_estampilla(id, cont);
					var id2 = document.getElementById('pgcp' + cont).value;
					cta_nombre_cta(id2, cont);

				}
				if (irest2 != 0 && document.getElementById('vr_estampilla2').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('estampilla2').value;
					//document.getElementById('t'+cont+'1').value=document.getElementById('estampilla2').value;
					document.getElementById('vr_cre_' + cont + '').value = document.getElementById('vr_estampilla2').value;
					cta_estampilla(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);

				}

				if (irest3 != 0 && document.getElementById('vr_estampilla3').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('estampilla3').value;
					//document.getElementById('t'+cont+'1').value=document.getElementById('estampilla3').value;
					document.getElementById('vr_cre_' + cont + '').value = document.getElementById('vr_estampilla3').value;
					cta_estampilla(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);


				}
				if (irest4 != 0 && document.getElementById('vr_estampilla4').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('estampilla4').value;
					//			document.getElementById('t'+cont+'1').value=document.getElementById('estampilla4').value;
					document.getElementById('vr_cre_' + cont).value = document.getElementById('vr_estampilla4').value;
					cta_estampilla(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);


				}
				if (irest5 != 0 && document.getElementById('vr_estampilla5').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('estampilla5').value;
					//document.getElementById('t'+cont+'1').value=document.getElementById('estampilla5').value;
					document.getElementById('vr_cre_' + cont).value = document.getElementById('vr_estampilla5').value;
					cta_estampilla(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);

				}

				sumacredito();
				sumadebito();
				diferencia();

				conaux = cont;

				var u = parseInt(document.all.tablaf.rows.length);
				for (var y = 1; y <= u; y++) {
					acum2 = acum2 + parseFloat(document.getElementById('vr_cre_' + y).value);
				}

				agregar();
				var s = parseInt(document.all.tablaf.rows.length);
				document.getElementById('pgcp' + s).value = "1110";
				document.getElementById('vr_cre_' + s).value = parseFloat(document.getElementById('vr_obli_para_pago_mas_iva').value) - (acum + acum2);
			}
			//**********
			function cta_retefuente(ids, con) {

				var pos_url = 'consultas/con_cta_retefuente.php';


				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('pgcp' + con + '').value = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + ids, false);
					req.send(null);
				}

			}

			//funcion para consultar cuenta de iva

			function cta_reteiva(ids, con) {

				var pos_url = 'consultas/con_cta_reteiva.php';


				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('pgcp' + con + '').value = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + ids, false);
					req.send(null);
				}

			}


			//funcion para consultal cuenta estampillas

			function cta_estampilla(ids, con) {

				var pos_url = 'consultas/con_cta_estampilla.php';


				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('pgcp' + con + '').value = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + ids, false);
					req.send(null);
				}

			}
		</script>
		<script>
			//funcion para consultar cuenta de otros descuentos

			function cta_otros(ids, con) {

				var pos_url = 'consultas/con_cta_otros.php';


				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {

							document.getElementById('pgcp' + con + '').value = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + ids, false);
					req.send(null);
				}

			}

			//***************sumas*****************

			function sumacredito() {
				var sumato = document.all.tablaf.rows.length;
				var sumatotal = 0;
				if (sumato != 0) {
					for (var k = 1; k <= sumato; k++)
						sumatotal = sumatotal + parseFloat(document.getElementById('vr_cre_' + k).value);

				}
				//alert (acum);
				document.getElementById('tot_cre_a').value = sumatotal;
			}
			//funcion para sumar cuentas debito

			function sumadebito() {
				var sumato = document.all.tablaf.rows.length;

				var sumatotal = 0;

				if (sumato != 0) {
					for (var k = 1; k <= sumato; k++)
						sumatotal = sumatotal + parseFloat(document.getElementById('vr_deb_' + k + '').value);
					//alert(document.getElementById('t'+k+'4').value);

				}

				document.getElementById('tot_deb_a').value = sumatotal;
			}

			//funcion diferencia
			function diferencia() {
				document.getElementById('total').value = parseInt(document.getElementById('tot_deb_a').value) - parseInt(document.getElementById('tot_cre_a').value);
			}
			//*********************

			function cta_nombre_cta(ids, con) {

				var pos_url = 'consultas/con_nombrecta.php';


				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resulta' + con + '').value = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + ids, false);
					req.send(null);
				}

			}

			//******************************

			function cta_cecp(n) //  n2 => impar, n3 => par
			{

				//alert(n+' '+n2+' '+n3)
				var pos_url = 'consultas/con_cecp.php';

				var cecp = document.getElementById('cuenta_cxp' + n).value; //alert(cecp);
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							var cadena = req.responseText;
							//alert(cadena);
							var cadsplit = cadena.split(',');
							document.getElementById('pgcp' + n).value = cadsplit[0];
							document.getElementById('resulta' + n).value = cadsplit[1];

							if (document.getElementById('iva').value == '') {
								document.getElementById('vr_deb_' + n).value =
									parseFloat(document.getElementById('valor_pto' + n).value);
							} else {
								var iva = 1 + (parseFloat(document.getElementById('iva').value) / 100);
								var valor = parseFloat(document.getElementById('valor_pto' + n).value) / iva;
								document.getElementById('vr_deb_' + n).value = (valor);


							}



						}
					}
					req.open('GET', pos_url + '?cod=' + cecp, false);
					req.send(null);
				}

			}

			//*************************
			function calcular_tabla() {
				ceros();
				llenartabla() //llena la tabla con datos
				neto(); //calcular neto
				//otro();         //calcular otro
				//poner en ceros
				sumacredito();
				sumadebito();
				diferencia();
				//var contador=document.all.tablaf.rows.length;
				//alert(contador);
				//document.getElementById('contador_f').value=contador;
			}


			//*************************
		</script>
		<!--fin val forms-->
	</head> <!-- Cabecera con funciones y javascript -->

	<body onload="bod();">
		<?php
		$ver = '';
		$numpost = $contador1 = '';
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
		$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
		$sqlxx = "select * from cecp where id_auto_cecp='$id_cecp'";
		$resultadoxx = $connectionxx->query($sqlxx);
		$rowee = $resultadoxx->fetch_assoc();

		$sqcon = "select * from cecp where id_auto_cecp='$id_cecp'";
		$rescon = $connectionxx->query($sqcon);
		$rcon = $rescon->fetch_assoc();
		$cont = 0;
		$co = 0;
		for ($y = 1; $y <= 15; $y++) {
			if ($rcon['pgcp' . $y]) $cont++;
		} // echo $cont;

		$sqcon2 = "select * from cecp where id_auto_cecp='$id_cecp'";
		$rescon2 = $connectionxx->query($sqcon2);
		$rcon2 = $rescon2->fetch_assoc();
		for ($z = 1; $z <= 15; $z++) {
			if ($rcon2['vr_deb_' . $z] > 0) $co++;
			else break;
		} //echo $co;

		$sqcu = "select * from cecp_cuenta  where id_auto_cecp='$id_cecp'";
		$rescu = $connectionxx->query($sqcu);
		$s = 0;
		while ($rcu = $rescu->fetch_assoc()) {
			$arr[$s] = $rcu['cuenta'];
			$s++;
		}
		?>
		<form name="a" method="post" id="commentForm" action="p_modifica_cecp.php" />
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
						<div align="center">
							<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
								<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
									<div align="center"><a href='pagos_tesoreria_cxp.php' target='_parent'>VOLVER </a> </div>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<!-- Imagen de ecabezado y opcion volver -->
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
								<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;"><?php //echo "$ultimo"; 
																															?>
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
										if (empty($rowee['fecha_cecp'])) {
											$fecha_cecp = $ano;
										} else {
											$fecha_cecp = $rowee['fecha_cecp'];
										}
										?>
										<input name="fecha_cecpp" type="text" class="required Estilo12" readonly="" id="fecha_cecpp" value="<?php printf($fecha_cecp); ?>" size="12" />
										<span class="Estilo8">:::</span>
										<input name="button2" type="button" class="Estilo12" onclick="displayCalendar(document.a.fecha_cecpp,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
										<input name="filas_tabla" id="filas_tabla" type="hidden" value=" <?php printf("%s", $cont); ?>" />
										<input name="id_cp" id="id_cp" type="hidden" value="<?php echo $id_cecp; ?>" />
										<input name="conti" id="conti" type="hidden" value=" <?php printf("%s", $co); ?>" />


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
										<?php printf("%s", $conse); ?>
										<input name="id_auto_cecp" type="hidden" class="Estilo12" id="id_auto_cecp" value="<?php printf("%s", $conse); ?>" />
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
											/* $ultimo2=$_POST['id_manu_cecp']; 
				if ($ultimo2 =='')
				{
					new mysqli($server, $dbuser, $dbpass, $database);
					
					$resultamax = mysql_query("select MAX(id_manu_cecp) FROM cecp");
					while($arraymax = $resulta->fetch_array()) 
					{
						$ultimo = $arraymax[0];
						$ultimo1 = substr($ultimo,4);
						$ultimoo=$ultimo1+1;
					}
				}else{
					$ultimoo=$ultimo2;
				}*/
											//echo $ultimo2;
											?>
											<input name="id_manu_cecp" type="text" class="required Estilo4" id="id_manu_cecp" style="text-align:center" onkeypress="return validar(event)" value="<?php printf("%s", substr($rowee['id_manu_cecp'], 4, 10)); ?>" onkeyup="chk_cecp();" />

											<a href="javascript:mostrarVentana();">Mas</a>
											<div id="miVentana" style="position: fixed; width: 210px; height: 340px; top: 0; left: 0; font-family:Verdana,
                    Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 
                     3px solid; background-color: #FAFAFA; color: #000000; display:none;">

												<div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">
													<table border="0" width="100%">
														<tr>
															<td>
																<font color="#FFFFFF"> Consecutivos del Documento </font>
															</td>
															<td align="right"><img src="../simbolos/cerrar.png" width="15" border="0" onclick="ocultarVentana();" onmouseover="Puntero();" onmouseout="PunteroNormal();">
															</td>
														</tr>
													</table>
												</div>
												<iframe id="datamain" src="cecpconsecutivo.php" width="200" height="290" marginwidth="0" marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
											</div>
											<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
												<div class="Estilo4" align="center" id='res_ncon'></div>
											</div>


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
										// Muestra el input de terceros deacuerdo al campo seleccionado
										//echo "$_POST[ter_nat] ** $_POST[ter_jur] ** $_POST[chkretefte]";
										$varrs = isset($_POST['chkretefte']) ? $_POST['chkretefte'] : '';
										if (isset($_POST['Submit']) or isset($_POST['Submit2']) or isset($_POST['Submit3']) or isset($_POST['Submit32']) or $varrs == "SIAUT" or $varrs == "") {
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


										//$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
										$ter = $rowee['cn'];
										$sqx1 = "select * from terceros_naturales where num_id ='$ter'";
										$resx1 = $connectionxx->query($sqx1);
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
											$sqx2 = "select id from terceros_juridicos where num_id2 ='$ter' ";
											$resx2 = $connectionxx->query($sqx2);
											$rowx2 = $resx2->fetch_assoc();
											$ter_natural = '';
											$ter_juridico = $rowx2['id'];
											$veaterjur = "display:block";
											$enaternat = "disabled='disabled'";
											$enaterjur = "";
											$bannat = 0;
											$banjur = 1;
										}

										// echo $rowee['nt'];
										$ter_nat = $rowee['id'];
										//echo $ter_nat;

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
													<select name="ter_nat" class="Estilo4" id="ter_nat" style="width: 350px;" <?php print $rowee['nt']; ?>>
														<option value="" selected="selecte"></option>

														<?php
														include('../config.php');
														$db = new mysqli($server, $dbuser, $dbpass, $database);

														$strSQL = "SELECT * FROM terceros_naturales  WHERE id_emp = '$id_emp' order by  pri_ape asc ";
														$rs = $db->query($strSQL);
														$nr = $rs->num_rows;
														for ($i = 0; $i < $nr; $i++) {
															$r = $rs->fetch_assoc();
															if ($r['id'] == $ter_natural) {
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
														$nr = $rs->num_rows;
														for ($i = 0; $i < $nr; $i++) {
															$r = $rs->fetch_assoc();
															if ($r['id'] == $ter_juridico) {
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
										<input name="concepto_pago" type="text" class="required Estilo4" id="concepto_pago" onkeyup="a.concepto_pago.value=a.concepto_pago.value.toUpperCase();" style="width: 520px;" value="<?php printf("%s", $rowee['concepto_pago']); ?>" />
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
						if (!isset($_POST["filas"])) {
							$num_filas = 1;
						} else {
							$num_filas = $_POST["filas"];
						}
						?>
						<tr>
							<td colspan="4" bgcolor="#DCE9E5" align="center">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='mas_inputs();'>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<span id='contis2' class='Estilo4'><?php echo $num_filas; ?></span>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<img src="images/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='menos_inputs();'>
									</strong>
								</div>
								<input name="filas" type="hidden" id="filas" value='<?php echo $num_filas;  ?>' />
							</td>
						</tr> <!-- Datos generales del comprobante -->
						<?php
						include('../config.php');
						$query = "SELECT * FROM cxp WHERE id_emp = '$id_emp' ORDER BY cod_pptal";
						$link = new mysqli($server, $dbuser, $dbpass, $database);


						for ($k = 1; $k <= 20; $k++) {
							$cuenta_cxp = isset($arr[$k - 1]) ? $arr[$k - 1] : 0; //echo $cuenta_cxp; 
							$valor_pto = isset($_POST['valor_pto' . $k]) ? $_POST['valor_pto' . $k] : 0;
							echo "
			  <tr style='display:'" . $ver . " id='inputx'" . $k . ">
			  <td colspan='3' bgcolor='#FFFFFF'>
					<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
					<div align='center'>
							<select name='cuenta_cxp'" . $k . " class='Estilo4' id='cuenta_cxp'" . $k . " style='width: 500px;'  onBlur='CuentaDetalle(id);' >
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
			  <td align='center'> <input type='text'  name='valor_pto$k' style='text-align:right' id='valor_pto$k' value='$valor_pto' Onblur='VerificaSaldo($k);'  onkeypress='return validar(event)' />  <input type='hidden' name='actual$k' id='actual$k' value=''/></td>
			  
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
											<input name="vr_obli_para_pago_mas_iva" type="text" class="required Estilo12" id="vr_obli_para_pago_mas_iva" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $rowee['vr_obli_para_pago_mas_iva']); ?>" onchange="valvrob()" readonly />
										</div>
									</div>
								</div>
							</td>
						</tr>
						<td colspan="2" bgcolor="#66CCCC">
							<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
								<div align="center" class="Estilo12">
									<div align="center"><strong>Si el pago a realizar no tiene IVA, deje la casilla en BLANCO,<br />
											caso contrario, Digite Tarifa del IVA ( Ejemplo : 16 )<br /><br />
										</strong>
										<input name="iva" type="text" class="Estilo12" id="iva" style="text-align:center" onkeypress="return validar(event)" onkeyup="iva2()" value="<?php

																																														printf("%s", $rowee['iva']); ?>" />
										<span class="Estilo14">:::</span>
										<!--input name="Submit2" type="submit" class="Estilo4" value="Calcular valores de IVA" onclick="this.form.action = 'nuevo_cecp.php'" /-->
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

								<input name="vr_obli_para_pago_sin_iva" type="text" class="required Estilo12" id="vr_obli_para_pago_sin_iva" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.2f", $rowee['total_pagado']); ?>" />
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

								<input name="iva_vr_obli_pago" type="text" class="required Estilo12" id="iva_vr_obli_pago" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.2f", $rowee['vr_obli_para_pago_mas_iva'] - $rowee['total_pagado']); ?>" />
							</div>
						</div>
					</div>
				</td>
			</tr>
			</br>
		</table>
		<!-- Datos del compromiso vige anterior -->
		<table width="800" border="0" id="deduciones" align="center" style="display:block">
			<tr>
				<td colspan="4">
					<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
						<div align="center" class="Estilo4"> <strong> <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='block'" onclick="JavaScript:MostrarOcultarDEDU('dedu');"> ...::: DESCUENTOS Y DEDUCCIONES :::...</span></strong></div>
					</div>
					<table width="800" border="1" align="center" class="bordepunteado1" id="dedu" style="display:block">
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
											<input name="salud" type="text" class="Estilo12" id="salud" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $rowee['salud']);	 ?>" />
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

											<input name="pension" id="pension" type="text" class="Estilo12" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $rowee['pension']);	 ?>" />
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
											<input name="libranza" type="text" class="Estilo12" id="libranza" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $rowee['libranza']);	 ?>" />
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
											<input name="f_solidaridad" type="text" class="Estilo12" id="f_solidaridad" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $rowee['f_solidaridad']);	 ?>" />
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
											<input name="f_empleados" type="text" class="Estilo12" id="f_empleados" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $rowee['f_empleados']);	 ?>" />
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
											<input name="sindicato" type="text" class="Estilo12" id="sindicato" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%.0f", $rowee['sindicato']);	 ?>" />
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
											<input name="embargo" type="text" class="Estilo12" id="embargo" style="text-align:right" onkeypress="return validar(event)" value="<?php $embargo = $rowee['embargo'];
																																												printf("%.0f", $embargo);	 ?>" />
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
											<input name="cruce" type="text" class="Estilo12" id="cruce" style="text-align:right" onkeypress="return validar(event)" value="<?php $cruce = $rowee['cruce'];
																																											printf("%.0f", $cruce);	 ?>" />
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
											<input name="otros" type="text" class="Estilo12" id="otros" style="text-align:right" onkeypress="return validar(event)" value="<?php $otros = $rowee['otros'];
																																											printf("%.0f", $otros);	 ?>" />
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
		<table width="950" border="0" id="retenciones" align="center" style="display:''">
			<tr>
				<td colspan="5">
					<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;"></div>
					<table width="800" border="1" align="center" class="bordepunteado1">
						<tr>
							<td colspan="4" bgcolor="#DCE9E5">
								<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
									<div align="center" class="Estilo12"><strong> RETENCIONES POR IMPUESTOS, TASAS Y CONTRIBUCIONES </strong>...::: manual :::... </div>
								</div>
							</td>
						</tr>
						<tr>
							<td width="410">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>ReteFuente</strong></div>
									</div>
								</div>
							</td>
							<td width="130">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>BASE</strong></div>
									</div>
								</div>
							</td>
							<td width="130">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>Tarifa </strong>%</div>
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
										<select name="retefuente" class="Estilo12" id="retefuente" style="width: 300px;" onchange="retefuentef(value);">
											<option value=""></option>
											<?php
											$retefuente = $rowee['retefuente'];
											include('../config.php');
											$query = "SELECT * FROM retefuente";
											$link = new mysqli($server, $dbuser, $dbpass, $database);
											$result = $link->query($query);
											while ($row = $result->fetch_assoc()) {
												if ($row['concepto'] == $retefuente) {

													echo "<OPTION VALUE=\"" . $row["concepto"] . "\" selected>" . $row["concepto"] . "</OPTION>";
												} else {
													echo "<OPTION VALUE=\"" . $row["concepto"] . "\">" . $row["concepto"] . "</OPTION>";
												}
											}
											?>
										</select>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="partir">
											<?php


											?>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="tarifa_e">
											<?php //printf("%s",$tarifa_retefuente);//echo number_format($tarifa_retefuente,2,',','.'); //printf("%s",$tarifa_retefuente);
											?>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<?php
											?>
											<!--              <input name="vr_retefuente" type="text" class="Estilo12" id="vr_retefuente" style="text-align:right" onkeypress="return validar(event)" value="<?php /*printf("%.0f",$vr_retefuente);*/ ?>" />-->
											<input name="vr_retefuente" type="text" class="Estilo12" id="vr_retefuente" style="text-align:right" onchange="ceros();" onkeypress="return validar(event)" value="<?php printf("%s", $rowee['vr_retefuente']); ?>" />
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
										<select name="reteiva" class="Estilo12" id="reteiva" style="width: 300px;" onchange="ret_iva(value)">
											<option value=""></option>
											<?php
											$reteiva = $rowee['reteiva'];
											include('../config.php');
											$query = "SELECT * FROM reteiva";
											$link = new mysqli($server, $dbuser, $dbpass, $database);
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
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="partir_iva">

										</div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="tarifa_iva">

										</div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">

											<!--              <input name="vr_reteiva" type="text" class="Estilo12" id="vr_reteiva" style="text-align:right" onkeypress="return validar(event)" value="<?php //printf("%.0f",$vr_reteiva); 
																																																		?>" />-->
											<input name="vr_reteiva" type="text" class="Estilo12" id="vr_reteiva" style="text-align:right" onchange="ceros();" onkeypress="return validar(event)" value="<?php $vr_reteiva = $rowee['vr_reteiva'];
																																																			printf("%s", $vr_reteiva); ?>" />
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center"><strong>ReteICA</strong><strong> / Otro</strong></div>
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
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center"><span class="Estilo41">
											<input name="reteica" type="text" class="Estilo41" id="reteica" onkeyup="a.reteica.value=a.reteica.value.toUpperCase();" size="55" value="<?php printf("%s", $rowee['reteica']); ?>" />
										</span></div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="a_partir_reteica" type="text" class="Estilo12" id="a_partir_reteica" style="text-align:right" onkeyup="tres();" onkeypress="return validar(event)" value="<?php printf("%s", $rowee['a_partir_reteica']); ?>" />
										</div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="tarifa_reteica" type="text" class="Estilo12" id="tarifa_reteica" style="text-align:right" onkeyup="otro();" onkeypress="return validar(event)" value="<?php printf("%s", $rowee['tarifa_reteica']); ?>" />
										</div>
									</div>
								</div>
							</td>
							<td>
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="vr_reteica" type="text" class="Estilo12" id="vr_reteica" style="text-align:right" onchange="ceros();" onkeypress="return validar(event)" value="<?php printf("%s", $rowee['vr_reteica']); ?>" />
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
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center"><span class="Estilo41">
											<select name="estampilla1" class="Estilo12" id="estampilla1" style="width: 300px;" onchange="estamp1(value,id);">
												<option value=""></option>
												<?php
												$estampilla2 = $rowee['estampilla1'];
												include('../config.php');
												$query = "SELECT * FROM estampillas";
												$link = new mysqli($server, $dbuser, $dbpass, $database);
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
										</span></div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="b_estampilla1"></div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="t_estampilla1"></div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="vr_estampilla1" type="text" class="Estilo12" id="vr_estampilla1" onchange="ceros();" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%s", $rowee['vr_estampilla1']); ?>" />
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
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center"><span class="Estilo41">
											<select name="estampilla2" class="Estilo12" id="estampilla2" style="width: 300px;" onchange="estamp1(value,id);">
												<option value=""></option>
												<?php
												$estampilla2 = $rowee['estampilla2'];
												include('../config.php');
												$query = "SELECT * FROM estampillas";
												$link = new mysqli($server, $dbuser, $dbpass, $database);
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
										</span></div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="b_estampilla2"></div>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="t_estampilla2"></div>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="vr_estampilla2" type="text" class="Estilo12" id="vr_estampilla2" onchange="ceros();" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%s", $rowee['vr_estampilla2']); ?>" />
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
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center"><span class="Estilo20">
											<select name="estampilla3" class="Estilo12" id="estampilla3" style="width: 300px;" onchange="estamp1(value,id);">
												<option value=""></option>
												<?php
												$estampilla3 = $rowee['estampilla3'];
												include('../config.php');
												$query = "SELECT * FROM estampillas";
												$link = new mysqli($server, $dbuser, $dbpass, $database);
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
										</span></div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="b_estampilla3"></div>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="t_estampilla3"></div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="vr_estampilla3" type="text" class="Estilo12" id="vr_estampilla3" onchange="ceros();" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%s", $rowee['vr_estampilla3']); ?>" />
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
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center"><span class="Estilo20">
											<select name="estampilla4" class="Estilo12" id="estampilla4" style="width: 300px;" onchange="estamp1(value,id);">
												<option value=""></option>
												<?php
												$estampilla4 = $rowee['estampilla4'];
												include('../config.php');
												$query = "SELECT * FROM estampillas";
												$link = new mysqli($server, $dbuser, $dbpass, $database);
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
										</span></div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="b_estampilla4"></div>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="t_estampilla4"></div>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="vr_estampilla4" type="text" class="Estilo12" id="vr_estampilla4" onchange="ceros();" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%s", $rowee['vr_estampilla4']); ?>" />
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
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12"> </div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center"><span class="Estilo20">
											<select name="estampilla5" class="Estilo12" id="estampilla5" style="width: 300px;" onchange="estamp1(value,id);">
												<option value=""></option>
												<?php
												$estampilla5 = $rowee['estampilla5'];
												include('../config.php');
												$query = "SELECT * FROM estampillas";
												$link = new mysqli($server, $dbuser, $dbpass, $database);
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
										</span></div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="b_estampilla5"></div>
									</div>
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center" id="t_estampilla5"></div>
									</div>
								</div>
							</td>
							<td bgcolor="#F5F5F5">
								<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
									<div align="center" class="Estilo12">
										<div align="center">
											<input name="vr_estampilla5" type="text" class="Estilo12" id="vr_estampilla5" onchange="ceros();" style="text-align:right" onkeypress="return validar(event)" value="<?php printf("%s", $rowee['vr_estampilla5']); ?>" />
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td bgcolor="#66CCCC">
								<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
									<div align="center" class="Estilo41">
										<div align="center"><b>FORMA DE PAGO </b> <span class="Estilo12">

												<?php $forma_pago = $rowee['forma_pago'];
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

											</span></div>
									</div>
								</div>
							</td>
							<td colspan="3" bgcolor="#990000">
								<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
									<div align="center" class="Estilo12"><span class="Estilo8"><strong> VALOR NETO A PAGAR :
												= </strong></span>
										<input style="background:#990000 ; color:#FFF; border:hidden; " name="total_pagado" type="text" class="Estilo12" id="total_pagado" value=" <?php printf("%s", $rowee['total_pagado']); ?>" />
									</div>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table> <!-- Retenciones --><br />
		<br />
		<table width="900" border="0" align="center">

			<tr>

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

					</div>
				</td>
			</tr>

			<tr>
				<td colspan="5" bgcolor="#DCE9E5">
					<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
						<div align="center" class="Estilo4">
							<p><strong>MOVIMIENTO CONTABLE
									<input type="hidden" name='contador' value='<?php print $contador1; ?>' id="contador">
									<input type="hidden" name='contini' value='<?php print $numpost; ?>' id="contini">
								</strong><strong><br />
								</strong>

								<input type="button" name="generar" id="generar" value="Generar movimiento " onClick="calcular_tabla();">
							</p>
							<p>
								<strong><img src="images/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='agregar();'>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<span id='contis' class='Estilo4'><?php printf("%s", $contador1); ?></span>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<img src="images/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer' ; onclick='borrarUltima();'>
								</strong>
							</p>
						</div>
					</div>
				</td>
			</tr>

			<tr>
				<td width="196">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; ">
						<div align="center" class="Estilo4"><strong>DIGITE CUENTA P.G.C.P </strong></div>
					</div>
				</td>
				<td width="246">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo4"><strong>DATOS DE LA CUENTA</strong><strong></strong> </div>
					</div>
				</td>
				<td width="163">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo4"><strong>VALOR DEBITO </strong></div>
					</div>
				</td>
				<td width="172">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo4"><strong>VALOR CREDITO </strong></div>
					</div>
				</td>
				<td width="187">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
						<div align="center" class="Estilo4"><strong>No. Dcto / Cheque </strong></div>
					</div>
				</td>
			</tr>
		</table>

		</tr>

		</table>

		<table width="1000" border="1" id="tablaf" align="center" class="bordepunteado1">

		</table>

		<table width="1000" border="1" align="center" class="bordepunteado1">

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
				<td width="208">&nbsp;</td>
				<td width="258">&nbsp;</td>
				<td width="155">&nbsp;</td>
				<td width="158">&nbsp;</td>
				<td width="185">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="5">
					<div class="Estilo19" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
						<div align="center">
							<input name="Submit322" type="submit" class="Estilo19" value="Grabar Comprobante de Egreso Cuentas x Pagar" onclick="return validarForm()" />
							<!--<input type="button" name="otrobtn" id="otrobtn" value="Grabar Comprobante de Egreso Cuentas x Pagar ok" onClick="cambiar('Submit322','otrobtn')">-->
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

		<tr>
			<td colspan="3">
				<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
					<div align="center">
						<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
							<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
								<div align="center"><a href='pagos_tesoreria_cxp.php' target='_parent'>VOLVER </a> </div>
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
		</table>
		</form> <!-- Fin de la tabla -->
	</body>

	</html>
<?php
}
?>