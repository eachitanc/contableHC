<?php
session_start();
if (!$_SESSION["login"]) {
	header("Location: ../login.php");
	exit;
} else {
?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<!--DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"-->
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

			-->
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

			.Estilo9 {
				color: #F5F5F5
			}

			td,
			th {
				font-family: Verdana;
				line-height: 12px;
				color: #333333;
				Padding-left: 10px;
				Padding-right: 10px;
				Padding-top: 5px;
				padding-bottom: 4px;
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


		<script language="JavaScript" type="text/javascript" src="javas.js"></script>

		<script type="text/javascript">
			function validar(e) {
				tecla = (document.all) ? e.keyCode : e.which;
				if (tecla == 8 || tecla == 46) return true; //Tecla de retroceso (para poder borrar) 
				patron = /\d/; //ver nota 
				te = String.fromCharCode(tecla);
				return patron.test(te);
			}

			function chk_pgcp() {
				var pos_url = 'comprueba_cta.php';
				var cod = document.getElementById('pgcp1').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, false);
					req.send(null);
				}
			}

			var contLin = 1; //numero de filas
			var conaux = 1;


			//funcion llenar vacios
			function ceros() {
				if (document.getElementById('salud').value == '') document.getElementById('salud').value = 0;
				if (document.getElementById('libranza').value == '') document.getElementById('libranza').value = 0;
				if (document.getElementById('f_empleados').value == '') document.getElementById('f_empleados').value = 0;
				if (document.getElementById('embargo').value == '') document.getElementById('embargo').value = 0;
				if (document.getElementById('otros').value == '') document.getElementById('otros').value = 0;
				if (document.getElementById('pension').value == '') document.getElementById('pension').value = 0;
				if (document.getElementById('f_solidaridad').value == '') document.getElementById('f_solidaridad').value = 0;
				if (document.getElementById('sindicato').value == '') document.getElementById('sindicato').value = 0;
				if (document.getElementById('cruce').value == '') document.getElementById('cruce').value = 0;

				if (document.getElementById('vr_retefuente').value == '') document.getElementById('vr_retefuente').value = 0;
				if (document.getElementById('vr_reteiva').value == '') document.getElementById('vr_reteiva').value = 0; // identificador iva
				if (document.getElementById('vr_retecree').value == '') document.getElementById('vr_retecree').value = 0; // identificador iva
				if (document.getElementById('vr_reteica').value == '') document.getElementById('vr_reteica').value = 0; // identificador ica
				if (document.getElementById('vr_estampilla1').value == '') document.getElementById('vr_estampilla1').value = 0; //estampilla1
				if (document.getElementById('vr_estampilla2').value == '') document.getElementById('vr_estampilla2').value = 0; //estampilla2
				if (document.getElementById('vr_estampilla3').value == '') document.getElementById('vr_estampilla3').value = 0; //estampilla3
				if (document.getElementById('vr_estampilla4').value == '') document.getElementById('vr_estampilla4').value = 0; //estampilla4
				if (document.getElementById('vr_estampilla5').value == '') document.getElementById('vr_estampilla5').value = 0; //estampilla5
			}

			function autoCree() {
				/* verificar si es tercero contribuyente cree y que tarifa tiene 1 2 3*/
				var ter = document.getElementById('ter_jur').value;
				var pos_url = 'consultas/consultas5.php';
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							var id_ret = req.responseText;
							document.a.retecree.selectedIndex = id_ret; /*cargo tarifa en el formulario */
							var reten = document.getElementById('retecree').value;
							retecree2(reten); /*llamo funcion que hace descuento*/
						}
					}
					req.open('GET', pos_url + '?cod=' + ter, false);
					req.send(null);
				}
			}

			function retefuentef(ids) {

				var valorxpagar = document.getElementById('siniva').value;
				//alert (valorxpagar);

				var pos_url = 'consultas/consulta.php';
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {


						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							var cadena = req.responseText;

							var cadsplit = cadena.split('/');
							document.getElementById('vr_retefuente').value = Math.round(cadsplit[0]);
							document.getElementById('tarifa_e').innerHTML = cadsplit[1] + '%';
							document.getElementById('partir').innerHTML = valorxpagar;
						}
					}
					req.open('GET', pos_url + '?cod=' + ids + '&valor=' + valorxpagar, false);
					req.send(null);
				}
				tres();
			}

			//*****************campos  de reteiva *******************************
			//*******************************************************************



			function ret_iva(ids) {

				var valoriva = document.getElementById('valoriva').value;
				var valorsiniva = document.getElementById('siniva').value;
				//alert (valorsiniva);

				var pos_url = 'consultas/consultas2.php';


				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							var cadena = req.responseText;
							//alert(cadena);

							var cadsplit = cadena.split('/');

							document.getElementById('vr_reteiva').value = Math.round(cadsplit[0]);


							// alert (cadsplit[1]);

							document.getElementById('partir_iva').innerHTML = valoriva;
							document.getElementById('tarifa_iva').innerHTML = cadsplit[1] + '%';
						}
					}
					req.open('GET', pos_url + '?cod=' + ids + '&valoriva=' + valoriva + '&valorsiniva=' + valorsiniva, false);
					req.send(null);
				}

				tres();
			}

			function retecree2(ids) {
				var valoriva = document.getElementById('valoriva').value;
				var valorsiniva = document.getElementById('siniva').value;
				//alert (valorsiniva);

				var pos_url = 'consultas/consultas4.php';
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							var cadena = req.responseText;
							var cadsplit = cadena.split('/');

							document.getElementById('vr_retecree').value = Math.round(cadsplit[0]);
							// alert (cadsplit[1]);
							document.getElementById('partir_cree').innerHTML = valorsiniva;
							document.getElementById('tarifa_cree').innerHTML = cadsplit[1] + '%';
						}
					}
					req.open('GET', pos_url + '?cod=' + ids + '&valoriva=' + valoriva + '&valorsiniva=' + valorsiniva, false);
					req.send(null);
				}

				tres();
			}

			function ret_ica(ids) {
				var valoriva = document.getElementById('valoriva').value;
				var valorsiniva = document.getElementById('siniva').value;
				//alert (valorsiniva);

				var pos_url = 'consultas/consulta_ica.php';


				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							var cadena = req.responseText;
							// alert(cadena);

							var cadsplit = cadena.split('/');

							document.getElementById('vr_reteica').value = Math.round(cadsplit[0]);


							// alert (cadsplit[1]);

							document.getElementById('a_partir_reteica').value = valorsiniva;

							document.getElementById('tarifa_reteica').value = cadsplit[1];
						}
					}
					req.open('GET', pos_url + '?cod=' + ids + '&valoriva=' + valoriva + '&valorsiniva=' + valorsiniva, false);
					req.send(null);
				}

				tres();



			}

			// fincion otros
			function otro() {
				var valxpagar = document.getElementById('valorPagar').value;
				var partir = document.getElementById('a_partir_reteica').value; // Base digitada
				//
				var tarifaica = document.getElementById('tarifa_reteica').value; // tarifa reteiva
				var totica = 0;
				totica = (partir / 1000) * (tarifaica);
				//document.getElementById('vr_reteica').value=Math.round(totica);
				neto();
				//llenartabla();
			}

			//funcion estampilla 1

			function estamp1(ids, id) {

				//var valorxpagar= document.getElementById('valorPagar').value;
				var valorxpagar = document.getElementById('valorneto').value;
				//alert (valorxpagar);//valorneto

				var pos_url = 'consultas/consulta.php';


				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {


							var cadena = req.responseText;

							var cadsplit = cadena.split('/');

							if (id == 'estampilla1') {
								if (document.getElementById('estampilla1').value != document.getElementById('estampilla2').value &&
									document.getElementById('estampilla1').value != document.getElementById('estampilla3').value &&
									document.getElementById('estampilla1').value != document.getElementById('estampilla4').value &&
									document.getElementById('estampilla1').value != document.getElementById('estampilla5').value) {
									document.getElementById('vr_' + id).value = Math.round(cadsplit[0]);
									document.getElementById('b_' + id).innerHTML = valorxpagar;
									document.getElementById('t_' + id).innerHTML = cadsplit[1] + '%';

								}
							}
							if (id == 'estampilla2') {
								if (document.getElementById('estampilla2').value != document.getElementById('estampilla1').value &&
									document.getElementById('estampilla2').value != document.getElementById('estampilla3').value &&
									document.getElementById('estampilla2').value != document.getElementById('estampilla4').value &&
									document.getElementById('estampilla2').value != document.getElementById('estampilla5').value) {
									document.getElementById('vr_' + id).value = Math.round(cadsplit[0]);
									document.getElementById('b_' + id).innerHTML = valorxpagar;
									document.getElementById('t_' + id).innerHTML = cadsplit[1] + '%';
								}
							}
							if (id == 'estampilla3') {
								if (document.getElementById('estampilla3').value != document.getElementById('estampilla2').value &&
									document.getElementById('estampilla3').value != document.getElementById('estampilla1').value &&
									document.getElementById('estampilla3').value != document.getElementById('estampilla4').value &&
									document.getElementById('estampilla3').value != document.getElementById('estampilla5').value) {
									document.getElementById('vr_' + id).value = Math.round(cadsplit[0]);
									document.getElementById('b_' + id).innerHTML = valorxpagar;
									document.getElementById('t_' + id).innerHTML = cadsplit[1] + '%';
								}
							}
							if (id == 'estampilla4') {
								if (document.getElementById('estampilla4').value != document.getElementById('estampilla2').value &&
									document.getElementById('estampilla4').value != document.getElementById('estampilla3').value &&
									document.getElementById('estampilla4').value != document.getElementById('estampilla1').value &&
									document.getElementById('estampilla4').value != document.getElementById('estampilla5').value) {
									document.getElementById('vr_' + id).value = Math.round(cadsplit[0]);
									document.getElementById('b_' + id).innerHTML = valorxpagar;
									document.getElementById('t_' + id).innerHTML = cadsplit[1] + '%';
								}
							}
							if (id == 'estampilla5') {
								if (document.getElementById('estampilla5').value != document.getElementById('estampilla2').value &&
									document.getElementById('estampilla5').value != document.getElementById('estampilla3').value &&
									document.getElementById('estampilla5').value != document.getElementById('estampilla4').value &&
									document.getElementById('estampilla5').value != document.getElementById('estampilla1').value) {
									document.getElementById('vr_' + id).value = Math.round(cadsplit[0]);
									document.getElementById('b_' + id).innerHTML = valorxpagar;
									document.getElementById('t_' + id).innerHTML = cadsplit[1] + '%';
								}
							}

							//document.getElementById('vr_'+id).value = 0;
							//else
							//document.getElementById('vr_'+id).value = Math.round(req.responseText);
						}
					}
					req.open('GET', pos_url + '?cod=' + ids + '&valor=' + valorxpagar, false);
					req.send(null);
				}
				tres();






			}
			//*********************************************************************
			//*************CALCULAR DATOS DE ESTAMPILLAS **************************
			//*********************************************************************
		</script>
		<script>
			//funcion para consultar cuenta retencion de fuente


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

			//funcion para consultar cuenta de iva

			function cta_retecree(ids, con) {

				var pos_url = 'consultas/con_cta_retecree.php';


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

			function cta_reteica(ids, con) {

				var pos_url = 'consultas/con_cta_reteica.php';

				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
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

			//funcion para consultar el nombre de las cuentas

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

			// consulta obcg...


			function cta_obcg() {

				var pos_url = 'consultas/con_obcg.php';

				var obcg = document.getElementById('id_obcg').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {

						if (req.readyState == 4) {
							var cadena = req.responseText;
							var cadsplit = cadena.split(',');
							var con = 1;
							for (var j = 1; j < parseInt(cadsplit[0]); j++) {
								agregar();
							}
							for (var k = 1; k <= parseInt(cadsplit[0]); k++) {
								document.getElementById('pgcp' + k).value = cadsplit[con];
								con++;
								//alert (con);
								document.getElementById('resulta' + k).value = cadsplit[con];
								con++
								document.getElementById('t' + k + '3').value = cadsplit[con];
								con++
								//alert (con);
							}
						}
					}
					req.open('GET', pos_url + '?cod=' + obcg, false);
					req.send(null);
				}
			}
		</script>
		<script>
			//*************************************************
			var acum = 0;

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

			//*************************************************
			var res;

			//funcion para llenar la tabla dinamica

			function llenartabla() {
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
				var ircree = parseInt(document.getElementById('vr_retecree').value); // identificador iva
				var irica = parseInt(document.getElementById('vr_reteica').value); // identificador ica
				var irest1 = parseInt(document.getElementById('vr_estampilla1').value); //estampilla1
				var irest2 = parseInt(document.getElementById('vr_estampilla2').value); //estampilla2
				var irest3 = parseInt(document.getElementById('vr_estampilla3').value); //estampilla3
				var irest4 = parseInt(document.getElementById('vr_estampilla4').value); //estampilla4
				var irest5 = parseInt(document.getElementById('vr_estampilla5').value); //estampilla5

				agregar();
				cta_obcg();
				/*document.getElementById('t13').value=parseInt(document.getElementById('valorPagar').value)-acum;*/
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
						document.getElementById('t' + cont + '4').value = document.getElementById('salud').value;
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
						document.getElementById('t' + cont + '4').value = document.getElementById('libranza').value;
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
						document.getElementById('t' + cont + '4').value = document.getElementById('f_empleados').value;
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
						document.getElementById('t' + cont + '4').value = document.getElementById('embargo').value;
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
						document.getElementById('t' + cont + '4').value = document.getElementById('otros').value;
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
						document.getElementById('t' + cont + '4').value = document.getElementById('pension').value;
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
						document.getElementById('t' + cont + '4').value = document.getElementById('f_solidaridad').value;
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
						document.getElementById('t' + cont + '4').value = document.getElementById('sindicato').value;
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
						document.getElementById('t' + cont + '4').value = document.getElementById('cruce').value;
						var id2 = document.getElementById('pgcp' + cont + '').value;
						cta_nombre_cta(id2, cont);
					} else acum = acum + parseInt(document.getElementById('cruce').value);
				}



				if (irfuente != 0 && document.getElementById('vr_retefuente').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('retefuente').value;
					//document.getElementById('t'+cont+'1').value=document.getElementById('retefuente').value;
					document.getElementById('t' + cont + '4').value = document.getElementById('vr_retefuente').value;
					cta_retefuente(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);
				}

				if (iriva != 0 && document.getElementById('vr_reteiva').value != '') {
					cont++;
					agregar()
					//document.getElementById('t'+cont+'1').value=document.getElementById('reteiva').value;
					var id = document.getElementById('reteiva').value;
					document.getElementById('t' + cont + '4').value = document.getElementById('vr_reteiva').value;
					cta_reteiva(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);

				}
				if (ircree != 0 && document.getElementById('vr_retecree').value != '') {
					cont++;
					agregar()
					//document.getElementById('t'+cont+'1').value=document.getElementById('reteiva').value;
					var id = document.getElementById('retecree').value;
					document.getElementById('t' + cont + '4').value = document.getElementById('vr_retecree').value;
					cta_retecree(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);
				}

				if (irica != 0 && document.getElementById('vr_reteica').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('reteica').value;
					cta_reteica(id, cont);
					//document.getElementById('t'+cont+'1').value=document.getElementById('reteica').value;
					document.getElementById('t' + cont + '4').value = document.getElementById('vr_reteica').value;
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);

				}
				if (irest1 != 0 && document.getElementById('vr_estampilla1').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('estampilla1').value;
					//document.getElementById('t'+cont+'1').value=document.getElementById('estampilla1').value;
					document.getElementById('t' + cont + '4').value = document.getElementById('vr_estampilla1').value;
					cta_estampilla(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);

				}
				if (irest2 != 0 && document.getElementById('vr_estampilla2').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('estampilla2').value;
					//document.getElementById('t'+cont+'1').value=document.getElementById('estampilla2').value;
					document.getElementById('t' + cont + '4').value = document.getElementById('vr_estampilla2').value;
					cta_estampilla(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);

				}
				if (irest3 != 0 && document.getElementById('vr_estampilla3').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('estampilla3').value;
					//document.getElementById('t'+cont+'1').value=document.getElementById('estampilla3').value;
					document.getElementById('t' + cont + '4').value = document.getElementById('vr_estampilla3').value;
					cta_estampilla(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);


				}
				if (irest4 != 0 && document.getElementById('vr_estampilla4').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('estampilla4').value;
					//			document.getElementById('t'+cont+'1').value=document.getElementById('estampilla4').value;
					document.getElementById('t' + cont + '4').value = document.getElementById('vr_estampilla4').value;
					cta_estampilla(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);
				}

				if (irest5 != 0 && document.getElementById('vr_estampilla5').value != '') {
					cont++;
					agregar()
					var id = document.getElementById('estampilla5').value;
					//document.getElementById('t'+cont+'1').value=document.getElementById('estampilla5').value;
					document.getElementById('t' + cont + '4').value = document.getElementById('vr_estampilla5').value;
					cta_estampilla(id, cont);
					var id2 = document.getElementById('pgcp' + cont + '').value;
					cta_nombre_cta(id2, cont);

				}

				sumacredito();
				sumadebito();

				diferencia();

				agregar();

				cont++;
				conaux = cont;

				document.getElementById('pgcp' + cont).value = "1110";
				document.getElementById('t' + cont + '4').value = document.getElementById('total_pagado').value;
				/*		document.getElementById('t13').value=parseInt(document.getElementById('valorPagar').value)-acum;*/

			}

			function tres() {
				//llenartabla()   //llena la tabla con datos
				ceros();
				neto(); //calcular neto
				otro(); //calcular otro
				//poner en ceros
				//sumacredito();
				//sumadebito();
				//diferencia();
			}

			function calcular_tabla() {
				ceros();
				llenartabla() //llena la tabla con datos
				neto(); //calcular neto
				otro(); //calcular otro
				//poner en ceros
				sumacredito();
				sumadebito();
				diferencia();
				var contador = document.all.tablaf.rows.length;
				//alert(contador);
				document.getElementById('contador_f').value = contador;
				tres();
			}

			function cuatro() {
				sumacredito();
				sumadebito();
				diferencia();
			}

			function cinco() {
				caliva();
				tres();
			}

			// funcion para sumar cuentas credito

			function sumacredito() {
				var sumato = document.all.tablaf.rows.length;
				var sumatotal = 0;

				if (sumato != 0) {
					for (var k = 1; k <= sumato; k++)
						sumatotal = sumatotal + parseFloat(document.getElementById('t' + k + '4').value);
					//alert(document.getElementById('t'+k+'4').value);

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
						sumatotal = sumatotal + parseFloat(document.getElementById('t' + k + '3').value);
					//alert(document.getElementById('t'+k+'4').value);

				}

				document.getElementById('tot_deb_a').value = sumatotal;
			}

			//funcion diferencia
			function diferencia() {
				document.getElementById('total').value = Math.round(parseFloat((document.getElementById('tot_deb_a').value) - parseFloat(document.getElementById('tot_cre_a').value)) * 100) / 100;
			}
			///// funcion que llena la tabla

			function agregar() {
				fila = document.all.tablaf.rows.length - 1;
				if (fila < 14) {
					var tr, td;
					var v1 = document.getElementById('retefuente').value;
					var v2 = document.getElementById('reteiva').value;
					//var v55=document.getElementById('id_obcg').value;

					tr = document.all.tablaf.insertRow();
					td = tr.insertCell();
					td.innerHTML = "<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'><span class='Estilo4'> <input type='text' size='28' style='text-align:left' id='pgcp" + contLin + "' name='pgcp" + contLin + "' value='' onkeyup='lookup(this.value," + contLin + ");' >  </span></div> <div class='suggestionsBox' id='sugges" + contLin + "' style='display: none; position:absolute; left: 130px;'><img src='images/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'> <div class='suggestionList' id='autoSug" + contLin + "' align=left> &nbsp;  </div> </div>";

					td = tr.insertCell();
					td.innerHTML = "<input type='text' size='40' style='text-align:left' name='resulta" + contLin + "' id='resulta" + contLin + "' value='' readonly >";

					td = tr.insertCell();
					td.innerHTML = "<input type='text' size='25' style='text-align:right' name='t" + contLin + "3' id='t" + contLin + "3' value=0  onKeyUp='cuatro();' onkeypress='return validar(event)' >";

					td = tr.insertCell();
					td.innerHTML = "<input type='text' size='26' style='text-align:right' name='t" + contLin + "4' id='t" + contLin + "4' value=0  onKeyUp='cuatro();' onkeypress='return validar(event)' >";

					td = tr.insertCell();
					td.innerHTML = "<input type='text' size='29' style='text-align:right' name='num_cheque" + contLin + "' id='num_cheque" + contLin + "' value='' onChange='VerCheque(id);' >";
					contLin++;


				}
			}

			function VerCheque(id) {
				var cheque = document.getElementById(id).value;
				var pos_url2 = 'consultas/concec_ch.php';
				var req1 = new XMLHttpRequest();
				if (req1) {
					req1.onreadystatechange = function() {
						if (req1.readyState == 4) {
							var dato = req1.responseText;
							if (dato > 0) {
								alert("El n�mero de cheque ya fue utilizado..");
								document.getElementById(id).focus();
							}
						}
					}
					req1.open('POST', pos_url2 + '?cod=' + cheque, false);
					req1.send(null);
				}

			}






			function borrarUltima() {

				ultima = document.all.tablaf.rows.length - 1;
				if (ultima >= conaux) {
					document.all.tablaf.deleteRow(ultima);
					contLin--;
				}
			}

			function borraruna(i) {

				document.all.tablaf.deleteRow(i);

			}



			function caliva() {
				var iva = document.getElementById('iva').value;
				var valorxpagar = document.getElementById('valorPagar').value;

				var valsiniva = valorxpagar / (1 + (iva / 100));
				var valiva = valorxpagar - valsiniva;

				document.getElementById('siniva').value = Math.round(valsiniva);
				document.getElementById('valoriva').value = Math.round(valiva);

				var ids = document.getElementById('retefuente').value;
				var idiva = document.getElementById('reteiva').value;


				retefuentef(ids);
				ret_iva(idiva);

			}

			//////////////////////////////////////////
			//FUNCION PARA VALIDAR EL FCONDICIONES EN EL FORMULARIO
			existe = 1;
			existe2 = 1;

			function valida_tabla() {
				var sw = 0;
				var sw2 = 0;

				//alert(existe);
				if (existe == 1) {
					var fecha_obcg = document.getElementById('fechaobcghidden').value; //id_obcg  fechaobcghidden
					var fecha_ceva = document.getElementById('fecha_ceva').value;
					var fo = fecha_obcg.split('/');
					var fc = fecha_ceva.split('/');

					var dia_o = fo[2];
					var mes_o = fo[1];
					var ano_o = fo[0];
					var dia_c = fc[2];
					var mes_c = fc[1];
					var ano_c = fc[0];

					var fechao = ano_o + mes_o + dia_o;
					var fechac = ano_c + mes_c + dia_c;

					//alert (fechao);
					//alert (fechac);
					//return (false);

					if (parseInt(fechac) < parseInt(fechao)) {
						alert("La fecha obcg " + fecha_obcg + " es mas reciente que la fecha ceva " + fecha_ceva + " se debe cambiarla");
						existe = 1;
						document.getElementById('fecha_ceva').focus();
						return (false);
					}

					if (document.getElementById('des_ceva').value == '') {
						alert("El campo descripcion es obligatorio...");
						existe = 1;
						document.getElementById('des_ceva').focus();
						return (false);
					}
					if (document.getElementById('res_ceva').innerHTML != '') {
						alert("El n�mero de comprobante ya fue utilizado...");
						existe = 1;
						document.getElementById('id_manu_ceva').focus();
						return (false);


					}

					if (document.getElementById('total').value != 0) {
						/*alert(fechao);
						alert(fechac);*/

						alert(" Las sumas debitos y creditos no son iguales");

						existe = 1;
						document.getElementById('total').focus();
						return (false);

					}



					var sumato = document.all.tablaf.rows.length;
					for (var i = 1; i <= sumato; i++) {
						var subcadena = document.getElementById('pgcp' + i).value;
						var aux = subcadena.substring(0, 4)
						if (aux == "1110" && document.getElementById('num_cheque' + i).value == '') {
							if (document.getElementById('resulta' + i).value == '') {

								alert("Debe seleccionar una cuenta de Bancos a nivel de detalle " + subcadena + "xx")
								document.getElementById('pgcp' + i).select();
								existe = 1;
								break;

							}
							//else sw=1;
							alert("debe llenar el numero de cheque");
							document.getElementById('num_cheque' + i).focus();
							existe = 1;
							break;
						}
						//else sw2=1;
						if (document.getElementById('pgcp' + i).value == '1110') {
							alert("Debe seleccionar una cuenta de Bancos a nivel de detalle");
							document.getElementById('pgcp' + i).select();
							existe = 1;
							break;
						}

						if (document.getElementById('pgcp' + i).value == '') {
							alert("campo vacio! debe completarlo para continuar");
							document.getElementById('pgcp' + i).focus();
							existe = 1;
							break;
						}
						existe = 0;
					}
					if (existe == 1)
						return (false);
					if (existe == 0)
						return (true);
				}

				return true;

			}

			function Puntero() {
				document.body.style.cursor = "Pointer";
			}

			function PunteroNormal() {
				document.body.style.cursor = "Default";
			}


			// CONSULTAR FECCHA OBCG  
		</script>


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

			.Estilo14 {
				color: #66CCCC
			}
			-->
		</style>
		<script>
			function chk_pgcp1() {
				var pos_url = 'comprueba_cta.php';
				var cod = document.getElementById('pgcp1').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp2() {
				var pos_url = 'comprueba_cta2.php';
				var cod = document.getElementById('pgcp2').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado2').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp3() {
				var pos_url = 'comprueba_cta3.php';
				var cod = document.getElementById('pgcp3').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado3').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp4() {
				var pos_url = 'comprueba_cta4.php';
				var cod = document.getElementById('pgcp4').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado4').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp5() {
				var pos_url = 'comprueba_cta5.php';
				var cod = document.getElementById('pgcp5').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado5').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp6() {
				var pos_url = 'comprueba_cta6.php';
				var cod = document.getElementById('pgcp6').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado6').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp7() {
				var pos_url = 'comprueba_cta7.php';
				var cod = document.getElementById('pgcp7').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado7').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp8() {
				var pos_url = 'comprueba_cta8.php';
				var cod = document.getElementById('pgcp8').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado8').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp9() {
				var pos_url = 'comprueba_cta9.php';
				var cod = document.getElementById('pgcp9').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado9').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp10() {
				var pos_url = 'comprueba_cta10.php';
				var cod = document.getElementById('pgcp10').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado10').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>
		<script>
			function chk_pgcp11() {
				var pos_url = 'comprueba_cta11.php';
				var cod = document.getElementById('pgcp11').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado11').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp12() {
				var pos_url = 'comprueba_cta12.php';
				var cod = document.getElementById('pgcp12').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado12').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp13() {
				var pos_url = 'comprueba_cta13.php';
				var cod = document.getElementById('pgcp13').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado13').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp14() {
				var pos_url = 'comprueba_cta14.php';
				var cod = document.getElementById('pgcp14').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado14').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<script>
			function chk_pgcp15() {
				var pos_url = 'comprueba_cta15.php';
				var cod = document.getElementById('pgcp15').value;
				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
							document.getElementById('resultado15').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>

		<!--validacion de forms-->
		<script src="../jquery.js"></script>
		<script type="text/javascript" src="../jquery.validate.js"></script>
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

			.Estilo13 {
				color: #F5F5F5
			}

			.Estilo13 {
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
			function chk_ceva() {
				var pos_url = '../comprobadores/comprueba_ceva.php';
				var cod = document.getElementById('id_manu_ceva').value;

				var req = new XMLHttpRequest();
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							document.getElementById('res_ceva').innerHTML = req.responseText;
						}
					}
					req.open('GET', pos_url + '?cod=' + cod, false);
					req.send(null);
				}
			}
		</script>

		<script language="JavaScript">
			function Calcular() {

				var a1 = document.a.vr_deb_1.value;
				var a2 = document.a.vr_deb_2.value;
				var a3 = document.a.vr_deb_3.value;
				var a4 = document.a.vr_deb_4.value;
				var a5 = document.a.vr_deb_5.value;
				var a6 = document.a.vr_deb_6.value;
				var a7 = document.a.vr_deb_7.value;
				var a8 = document.a.vr_deb_8.value;
				var a9 = document.a.vr_deb_9.value;
				var a10 = document.a.vr_deb_10.value;

				var a11 = document.a.vr_deb_11.value;
				var a12 = document.a.vr_deb_12.value;
				var a13 = document.a.vr_deb_13.value;
				var a14 = document.a.vr_deb_14.value;
				var a15 = document.a.vr_deb_15.value;




				if (a1 == "") {
					a1 = 0;
				}

				if (a2 == "") {
					a2 = 0;
				}
				if (a3 == "") {
					a3 = 0;
				}
				if (a4 == "") {
					a4 = 0;
				}
				if (a5 == "") {
					a5 = 0;
				}
				if (a6 == "") {
					a6 = 0;
				}
				if (a7 == "") {
					a7 = 0;
				}
				if (a8 == "") {
					a8 = 0;
				}
				if (a9 == "") {
					a9 = 0;
				}
				if (a10 == "") {
					a10 = 0;
				}
				if (a11 == "") {
					a11 = 0;
				}

				if (a12 == "") {
					a12 = 0;
				}
				if (a13 == "") {
					a13 = 0;
				}
				if (a14 == "") {
					a14 = 0;
				}
				if (a15 == "") {
					a15 = 0;
				}
				var total = parseFloat(a1) + parseFloat(a2) + parseFloat(a3) + parseFloat(a4) + parseFloat(a5) + parseFloat(a6) + parseFloat(a7) + parseFloat(a8) + parseFloat(a9) + parseFloat(a10) + parseFloat(a11) + parseFloat(a12) + parseFloat(a13) + parseFloat(a14) + parseFloat(a15);
				document.getElementById("tot_deb_a").value = total.toFixed(2);
			}
		</script>

		<script language="JavaScript">
			function Calcularc() {

				var aa1 = document.a.vr_cre_1.value;
				var aa2 = document.a.vr_cre_2.value;
				var aa3 = document.a.vr_cre_3.value;
				var aa4 = document.a.vr_cre_4.value;
				var aa5 = document.a.vr_cre_5.value;
				var aa6 = document.a.vr_cre_6.value;
				var aa7 = document.a.vr_cre_7.value;
				var aa8 = document.a.vr_cre_8.value;
				var aa9 = document.a.vr_cre_9.value;
				var aa10 = document.a.vr_cre_10.value;

				var aa11 = document.a.vr_cre_11.value;
				var aa12 = document.a.vr_cre_12.value;
				var aa13 = document.a.vr_cre_13.value;
				var aa14 = document.a.vr_cre_14.value;
				var aa15 = document.a.vr_cre_15.value;





				if (aa1 == "") {
					aa1 = 0;
				}
				if (aa2 == "") {
					aa2 = 0;
				}
				if (aa3 == "") {
					aa3 = 0;
				}
				if (aa4 == "") {
					aa4 = 0;
				}
				if (aa5 == "") {
					aa5 = 0;
				}
				if (aa6 == "") {
					aa6 = 0;
				}
				if (aa7 == "") {
					aa7 = 0;
				}
				if (aa8 == "") {
					aa8 = 0;
				}
				if (aa9 == "") {
					aa9 = 0;
				}
				if (aa10 == "") {
					aa10 = 0;
				}
				if (aa11 == "") {
					aa11 = 0;
				}

				if (aa12 == "") {
					aa12 = 0;
				}
				if (aa13 == "") {
					aa13 = 0;
				}
				if (aa14 == "")

				{
					aa14 = 0;
				}
				if (aa15 == "") {
					aa15 = 0;
				}



				var totalc = parseFloat(aa1) + parseFloat(aa2) + parseFloat(aa3) + parseFloat(aa4) + parseFloat(aa5) + parseFloat(aa6) + parseFloat(aa7) + parseFloat(aa8) + parseFloat(aa9) + parseFloat(aa10) + parseFloat(aa11) + parseFloat(aa12) + parseFloat(aa13) + parseFloat(aa14) + parseFloat(aa15);


				document.getElementById("tot_cre_a").value = totalc.toFixed(2);

			}
		</script>
		<!--fin val forms-->

		<script>
			var par = false;

			function parpadeo() {
				document.getElementById('txt').style.visibility = (par) ? 'visible' : 'hidden';
				par = !par;
			}



			function consecutivo2() {
				var fec = document.getElementById('fecha_ceva').value;
				var pos_url2 = 'consultas/concec_ceva.php';
				var req1 = new XMLHttpRequest();
				if (req1) {
					req1.onreadystatechange = function() {
						if (req1.readyState == 4) {
							var dato = req1.responseText;
							var elem = dato.split(',');
							concec = elem[0];
							fecha2 = elem[1];
							document.getElementById('id_manu_ceva').value = concec;
							if (fec != fecha2) {
								alert("Fecha sugerida para el consecutivo disponible: " + fecha2);
							}
						}
					}
					req1.open('POST', pos_url2 + '?cod=' + fec, false);
					req1.send(null);
				}

			}
		</script>

		<script type="text/javascript">
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

			function neto() {
				var net = parseFloat(document.getElementById('valorPagar').value);
				var rfuente = parseFloat(document.getElementById('vr_retefuente').value);
				var riva = parseFloat(document.getElementById('vr_reteiva').value);
				var rcree = parseFloat(document.getElementById('vr_retecree').value);
				var rica = parseFloat(document.getElementById('vr_reteica').value);
				var es1 = parseFloat(document.getElementById('vr_estampilla1').value);
				var es2 = parseFloat(document.getElementById('vr_estampilla2').value);
				var es3 = parseFloat(document.getElementById('vr_estampilla3').value);
				var es4 = parseFloat(document.getElementById('vr_estampilla4').value);
				var es5 = parseFloat(document.getElementById('vr_estampilla5').value);
				var pen = parseFloat(document.getElementById('pension').value);
				var soli = parseFloat(document.getElementById('f_solidaridad').value);
				var sindi = parseFloat(document.getElementById('sindicato').value);
				var cru = parseFloat(document.getElementById('cruce').value);
				var sal = parseFloat(document.getElementById('salud').value);
				var libr = parseFloat(document.getElementById('libranza').value);
				var empleo = parseFloat(document.getElementById('f_empleados').value);
				var embargo = parseFloat(document.getElementById('embargo').value);
				var otrosd = parseFloat(document.getElementById('otros').value);

				document.getElementById('total_pagado').value = Math.round((net - (rfuente + riva + rica + es1 + es2 + es3 + es4 + es5 + pen + soli + sindi + cru + sal + libr + empleo + embargo + otrosd + rcree)) * 100) / 100;
				//ceros();
			}

			function dos() {
				//agregar();
				consecutivo2();
				caliva();
				neto();
			}
		</script>

	</head>

	<body onload=dos() "setInterval('parpadeo()',1000)">
		<?php include('../objetos/redondear.php'); ?>
		<form name="a" method="post" id="commentForm" action="p_ceva_x.php">
			<table width="800" border="0" align="center">
				<tr>

					<td colspan="3">
						<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
							<div align="center">
								<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
							</div>
						</div>
					</td>
				</tr>

				<tr>
					<td colspan="3">
						<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
							<div align="center">
								<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
									<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
										<div align="center"><a href='pagos_tesoreria.php' target='_parent'>VOLVER </a> </div>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div style="padding-left:10px; padding-top:10px; padding-right:10px; padding-bottom:10px;">
							<div align="center" class="Estilo4"><strong>
									<?php


									include('../config.php');

									$id_obcg = $_POST['id_obcg'];
									//echo "post - $id_obcg";
									if (!$_POST['id_obcg']) {
										$id_obcg = $_GET["id2"];
										//echo "get - $id_obcg";
									}

									//printf("$id_obcg<br>");

									$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

									// id_emp
									$sqlxx = "select * from fecha";
									$resultadoxx = $connectionxx->query($sqlxx);

									while ($rowxx = $resultadoxx->fetch_assoc()) {
										$idxx = $rowxx["id_emp"];
										$id_emp = $rowxx["id_emp"];
										$ano = $rowxx["ano"];
									}

									$sqe5 = "select fecha_obcg,id_manu_obcg from obcg where id_auto_cobp='$cobp_auto_e'";
									$rese5 = $connectionxx->query($sqe5);
									while ($rowe5 = $rese5->fetch_assoc()) {
										$fechaobcg = $rowe5["fecha_obcg"];
										$id_manu_obcg_e = $rowe5["id_manu_obcg"];
										//$concepto_obcg_e=$rowe5["concepto_obcg"]; 

									}
									// info 
									$sqfecha = "select * from obcg where id_auto_obcg='$id_obcg'";
									$resulfecha = $connectionxx->query($sqfecha);

									while ($rowxxx2 = $resulfecha->fetch_assoc()) {

										$fechaobcg = $rowxxx2["fecha_obcg"];
										$id_obcg_e = $rowxxx2["id_manu_obcg"];
										$concepto_obcg_e = $rowxxx2["concepto_obcg"];
									}





									// consulta

									$sqlxx2 = "select * from obcg where id_emp = '$id_emp' and id_auto_obcg = '$id_obcg'";
									$resultadoxx2 = $connectionxx->query($sqlxx2);

									while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
										$id_auto_obcg = $rowxx2["id_auto_obcg"];
										$id_auto_cobp = $rowxx2["id_auto_cobp"];

										$pgcp1 = isset($rowxx2["pgcp1"]) ? $rowxx2["pgcp1"] : 0;
										$pgcp2 = isset($rowxx2["pgcp2"]) ? $rowxx2["pgcp2"] : 0;
										$pgcp3 = isset($rowxx2["pgcp3"]) ? $rowxx2["pgcp3"] : 0;
										$pgcp4 = isset($rowxx2["pgcp4"]) ? $rowxx2["pgcp4"] : 0;
										$pgcp5 = isset($rowxx2["pgcp5"]) ? $rowxx2["pgcp5"] : 0;
										$pgcp6 = isset($rowxx2["pgcp6"]) ? $rowxx2["pgcp6"] : 0;
										$pgcp7 = isset($rowxx2["pgcp7"]) ? $rowxx2["pgcp7"] : 0;
										$pgcp8 = isset($rowxx2["pgcp8"]) ? $rowxx2["pgcp8"] : 0;
										$pgcp9 = isset($rowxx2["pgcp9"]) ? $rowxx2["pgcp9"] : 0;
										$pgcp10 = isset($rowxx2["pgcp10"]) ? $rowxx2["pgcp10"] : 0;
										$pgcp11 = isset($rowxx2["pgcp11"]) ? $rowxx2["pgcp11"] : 0;
										$pgcp12 = isset($rowxx2["pgcp12"]) ? $rowxx2["pgcp12"] : 0;
										$pgcp13 = isset($rowxx2["pgcp13"]) ? $rowxx2["pgcp13"] : 0;
										$pgcp14 = isset($rowxx2["pgcp14"]) ? $rowxx2["pgcp14"] : 0;
										$pgcp15 = isset($rowxx2["pgcp15"]) ? $rowxx2["pgcp15"] : 0;

										$vr_deb_1 = isset($rowxx2["vr_deb_1"]) ? $rowxx2["vr_deb_1"] : 0;
										$vr_deb_2 = isset($rowxx2["vr_deb_2"]) ? $rowxx2["vr_deb_2"] : 0;
										$vr_deb_3 = isset($rowxx2["vr_deb_3"]) ? $rowxx2["vr_deb_3"] : 0;
										$vr_deb_4 = isset($rowxx2["vr_deb_4"]) ? $rowxx2["vr_deb_4"] : 0;
										$vr_deb_5 = isset($rowxx2["vr_deb_5"]) ? $rowxx2["vr_deb_5"] : 0;
										$vr_deb_6 = isset($rowxx2["vr_deb_6"]) ? $rowxx2["vr_deb_6"] : 0;
										$vr_deb_7 = isset($rowxx2["vr_deb_7"]) ? $rowxx2["vr_deb_7"] : 0;
										$vr_deb_8 = isset($rowxx2["vr_deb_8"]) ? $rowxx2["vr_deb_8"] : 0;
										$vr_deb_9 = isset($rowxx2["vr_deb_9"]) ? $rowxx2["vr_deb_9"] : 0;
										$vr_deb_10 = isset($rowxx2["vr_deb_10"]) ? $rowxx2["vr_deb_10"] : 0;
										$vr_deb_11 = isset($rowxx2["vr_deb_11"]) ? $rowxx2["vr_deb_11"] : 0;
										$vr_deb_12 = isset($rowxx2["vr_deb_12"]) ? $rowxx2["vr_deb_12"] : 0;
										$vr_deb_13 = isset($rowxx2["vr_deb_13"]) ? $rowxx2["vr_deb_13"] : 0;
										$vr_deb_14 = isset($rowxx2["vr_deb_14"]) ? $rowxx2["vr_deb_14"] : 0;
										$vr_deb_15 = isset($rowxx2["vr_deb_15"]) ? $rowxx2["vr_deb_15"] : 0;
										$vr_cre_1 = isset($rowxx2["vr_cre_1"]) ? $rowxx2["vr_cre_1"] : 0;
										$vr_cre_2 = isset($rowxx2["vr_cre_2"]) ? $rowxx2["vr_cre_2"] : 0;
										$vr_cre_3 = isset($rowxx2["vr_cre_3"]) ? $rowxx2["vr_cre_3"] : 0;
										$vr_cre_4 = isset($rowxx2["vr_cre_4"]) ? $rowxx2["vr_cre_4"] : 0;
										$vr_cre_5 = isset($rowxx2["vr_cre_5"]) ? $rowxx2["vr_cre_5"] : 0;
										$vr_cre_6 = isset($rowxx2["vr_cre_6"]) ? $rowxx2["vr_cre_6"] : 0;
										$vr_cre_7 = isset($rowxx2["vr_cre_7"]) ? $rowxx2["vr_cre_7"] : 0;
										$vr_cre_8 = isset($rowxx2["vr_cre_8"]) ? $rowxx2["vr_cre_8"] : 0;
										$vr_cre_9 = isset($rowxx2["vr_cre_9"]) ? $rowxx2["vr_cre_9"] : 0;
										$vr_cre_10 = isset($rowxx2["vr_cre_10"]) ? $rowxx2["vr_cre_10"] : 0;
										$vr_cre_11 = isset($rowxx2["vr_cre_11"]) ? $rowxx2["vr_cre_11"] : 0;
										$vr_cre_12 = isset($rowxx2["vr_cre_12"]) ? $rowxx2["vr_cre_12"] : 0;
										$vr_cre_13 = isset($rowxx2["vr_cre_13"]) ? $rowxx2["vr_cre_13"] : 0;
										$vr_cre_14 = isset($rowxx2["vr_cre_14"]) ? $rowxx2["vr_cre_14"] : 0;
										$vr_cre_15 = isset($rowxx2["vr_cre_15"]) ? $rowxx2["vr_cre_15"] : 0;

										$tot_deb = $rowxx2["tot_deb"];
										$tot_cre = $rowxx2["tot_cre"];
									}



									// info 
									$sqlxx3 = "select * from cobp where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp'";
									$resultadoxx3 =  $connectionxx->query($sqlxx3);

									while ($rowxx3 = $resultadoxx3->fetch_assoc()) {
										$id_manu_cobp = $rowxx3["id_manu_cobp"];
										$id_auto_cobp = $rowxx3["id_auto_cobp"];
										$a2x = $rowxx3["id_auto_cobp"];
										$id_auto_crpp = $rowxx3["id_auto_crpp"];
										$fecha_cobp = $rowxx3["fecha_cobp"];
										$des_cobp = $rowxx3["des_cobp"];
										$ref = $rowxx3["ref"];
									}


									// info 
									$sqlxx4 = "select * from crpp where id_emp = '$id_emp' and id_auto_crpp = '$id_auto_crpp' and liq1=''";
									$resultadoxx4 = $connectionxx->query($sqlxx4);

									while ($rowxx4 = $resultadoxx4->fetch_assoc()) {
										$id_auto_crpp = $rowxx4["id_auto_crpp"];
										$a1x = $rowxx4["id_auto_crpp"];
										$id_manu_crpp = $rowxx4["id_manu_crpp"];
										$fecha_crpp = $rowxx4["fecha_crpp"];
										$tercero = $rowxx4["tercero"];
										$ter_nat = $rowxx4["ter_nat"];
										$ter_jur = $rowxx4["ter_jur"];
										$pago = $rowxx4["pago"];
									}


									$sq11 = "select embargo,monto from terceros_naturales where id = '$ter_nat'";

									$re11 = $connectionxx->query($sq11);
									$rw11 = $re11->fetch_assoc();

									if ($rw11['embargo'] == 'SI') $embargo = $rw11['monto'];
									else $embargo = 0;

									?>
									<input name="id_obcg" id="id_obcg" type="hidden" value="<?php printf("%s", $id_obcg); ?>" />
									<input name="fechaobcghidden" id="fechaobcghidden" type="hidden" value="<?php printf("%s", $fechaobcg); ?>" />


									COMPROBANTE DE EGRESO VIGENCIA ACTUAL </strong></div>
						</div>
					</td>
				</tr>


				<input name="contador_f" id="contador_f" type="hidden" value="" />

				<tr>
					<td colspan="3">
						<table width="800" border="1" align="center" class="bordepunteado1">
							<tr>
								<td width="200"></td>
								<td width="200"></td>
								<td width="200"></td>
								<td width="200"></td>
							</tr>

							<tr>
								<td colspan="4" bgcolor="#DCE9E5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4"><strong>DATOS GENERALES DEL COMPROMISO PRESUPUESTAL </strong></div>
									</div>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F5F5F5" width="200">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4">
											<div align="right">

												<strong>Codigo CRPP : </strong>
											</div>
										</div>
									</div>
								</td>
								<td bgcolor="#FFFFFF" width="200">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4"><?php printf("%s", $id_manu_crpp); ?>

											<input name="id_obcg" type="hidden" value="<?php printf("%s", $id_obcg); ?>" />

											<input name="id_manu_crpp" type="hidden" value="<?php printf("%s", $id_manu_crpp); ?>" />
											<input name="id_auto_crpp" type="hidden" value="<?php printf("%s", $id_auto_crpp); ?>" />
										</div>
									</div>
								</td>
								<td bgcolor="#F5F5F5" width="200">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4">
											<div align="right"><strong>Fecha CRPP : </strong></div>
										</div>
									</div>
								</td>
								<td bgcolor="#FFFFFF" width="200">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4"><?php printf("%s", $fecha_crpp); ?>
											<input name="fecha_crpp" type="hidden" id="fecha_crpp" value="<?php printf("%s", $fecha_crpp); ?>" />
										</div>
									</div>
								</td>
							</tr>

							<tr>
								<td bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4">
											<div align="right"><strong>A Favor de : </strong></div>
										</div>
									</div>
								</td>
								<td colspan="3" bgcolor="#FFFFFF">
									<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
										<div align="center" class="Estilo4">
											<div align="left">

												<?php

												$sql3 = "select * from recaudo_ncbt where id_recau='$id' and id_emp='$id_emp' limit 1 ";
												$resultado3 = $connectionxx->query($sql3);

												while ($row3 = $resultado3->fetch_assoc()) {
													$ter_nat = $row3["ter_nat"];
													$ter_jur = $row3["ter_jur"];
												}
												//printf("%s<br>%s",$ter_nat, $ter_jur);
												$sql4 = "select * from terceros_naturales where id='$ter_nat' and id_emp='$id_emp' ";
												$resultado4 = $connectionxx->query($sql4);

												while ($row4 = $resultado4->fetch_assoc()) {
													$num_id = $row4["num_id"];
												}



												$sql5 = "select * from terceros_juridicos where id='$ter_jur' and id_emp='$id_emp' ";
												$resultado5 = $connectionxx->query($sql5);

												while ($row5 = $resultado5->fetch_assoc()) {
													$num_id2 = $row5["num_id2"];
												}


												$ccnit = $num_id . $num_id2;
												printf("%s", $ccnit);
												?>

												<script type="text/javascript">
													function mostrarOcultarTablas(id) {
														mostrado = 0;
														elem = document.getElementById(id);
														if (elem.style.display == 'block') mostrado = 1;
														elem.style.display = 'none';
														if (mostrado != 1) elem.style.display = 'block';
													}


													function ajax() {
														mostrarOcultarTablas('tabla1');
														mostrarOcultarTablas('tabla2');

													}


													function cambiar(id, id2) {

														if (document.getElementById) { //se obtiene el id
															var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
															el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div


														}
														if (document.getElementById) {
															var otro = document.getElementById(id2);
															otro.style.display = (otro.style.display == 'block') ? 'block' : 'none';
														}
														//muestra_oculta('boton');
													}
												</script>

												<SCRIPT language="javascript">
													function MostrarOcultar2(objetoVisualizar) {

														if (document.all['juridicos'].style.display == 'none') {
															document.all['naturales'].style.display = 'none';
															document.a.ter_nat.disabled = true;
															document.all['juridicos'].style.display = 'block';
															document.a.ter_jur.disabled = false;
														} else {
															document.a.ter_nat.disabled = true;
															document.a.ter_jur.disabled = true;
															document.all['naturales'].style.display = 'none';
															document.all['juridicos'].style.display = 'none';
														}
													}

													function MostrarOcultar(objetoVisualizar) {


														if (document.all['naturales'].style.display == 'none') {
															document.all['naturales'].style.display = 'block';
															document.a.ter_nat.disabled = false;
															document.all['juridicos'].style.display = 'none';
															document.a.ter_jur.disabled = true;
														} else {
															document.a.ter_nat.disabled = true;
															document.a.ter_jur.disabled = true;
															document.all['naturales'].style.display = 'none';
															document.all['juridicos'].style.display = 'none';
														}



													}
												</SCRIPT>


												<input name="tercero" type="hidden" id="tercero" value="<?php printf("%s", $tercero); ?>" />

												<input name="ccnit" type="hidden" id="ccnit" value="<?php printf("%s", $ccnit); ?>" />
											</div>
										</div>
									</div>


									<div class="Estilo4" style="padding-left:10px; padding-top:5px; padding-right:5px; padding-bottom:5px; <?php echo $ver_d; ?> ">
										<div align="left"> <strong> Seleccione el Tipo de Tercero</strong> <br />
											<br />

											<span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultar('naturales');">
												<font color="#0000FF"> NATURAL</font>
											</span> - <span onmouseover="this.style.textDecoration='underline';this.style.cursor='hand'" onmouseout="this.style.textDecoration='none'" onclick="JavaScript:MostrarOcultar2('juridicos');">
												<font color="#0000FF">JURIDICO</font>
											</span> - <a href="../terceros/terceros.php" target="_parent">&iquest; NUEVO ?</a>
										</div>
									</div>


									<?php
									$veaterjur = "display:none";
									$veaternat = "display:none";
									$ter = $ter_nat;
									$terj = $ter_jur;
									$sqx1 = "select * from terceros_naturales where id ='$ter'";
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
										$sqx2 = "select id from terceros_juridicos where id ='$terj' ";
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
									?>

									<div id="naturales" style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px; <?php echo $veaternat; ?>">
										<div align="left">
											<select name="ter_nat" class="Estilo4" id="ter_nat" style="width: 350px;" <?php echo $ver_d; ?>>
												<option value="" selected="selected"></option>
												<?php

												include('../config.php');
												$db = new mysqli($server, $dbuser, $dbpass, $database);

												$strSQL = "SELECT * FROM terceros_naturales  WHERE id_emp = '$idxx' order by pri_ape asc ";
												$rs = $db->query($strSQL);
												while ($r = $rs->fetch_assoc()) {
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
									<div id="juridicos" style="padding-left:5px; padding-top:0px; padding-right:5px; padding-bottom:0px; <?php echo $veaterjur; ?>">
										<div align="left">
											<select name="ter_jur" class="Estilo4" id="ter_jur" style="width: 350px;">
												<option value="" selected="selected"></option>
												<?php
												include('../config.php');
												$db = new mysqli($server, $dbuser, $dbpass, $database);

												$strSQL = "SELECT * FROM terceros_juridicos  WHERE id_emp = '$idxx' order by raz_soc2 asc ";
												$rs = $db->query($strSQL);
												while ($r = $rs->fetch_assoc()) {
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


									<input name="tercero" type="hidden" id="tercero" value="<?php printf("%s", $tercero); ?>" />

									<input name="ccnit" type="hidden" id="ccnit" value="<?php printf("%s", $ccnit); ?>" />




								</td>
							</tr>
							<tr>
								<td bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4">
											<div align="right"><strong>Tipo de Pago : </strong></div>
										</div>
									</div>
								</td>
								<td colspan="2" bgcolor="#FFFFFF">
									<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
										<div align="center" class="Estilo4">
											<div align="left">
												<?php printf("%s", $pago); ?>
												<input name="pago" type="hidden" id="pago" value="<?php printf("%s", $pago); ?>" />
											</div>
										</div>
									</div>
								</td>
								<td bgcolor="#FFFFFF"><a href="#" onclick="ajax();">
										<font color="#0000FF"> ver imputaciones</font>
									</a></td>
							</tr>
						</table>

						<br />

						<div align="center"><?php


											$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
											$sq = "select * from crpp where id_emp ='$id_emp' and id_auto_crpp ='$a1x' order by id asc ";
											$re = $cx->query($sq);

											echo "<div id='tabla1' style='display: none'>
<center>
<table  width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='6'>
<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
<div align='center' class='Estilo4'  > <strong>IMPUTACION PRESUPUESTAL DEL REGISTRO</strong></div>
</div>
</td>
</tr>

<tr bgcolor='#F5F5F5'>
<td align='center' width='15%'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>

<td align='center' width='30%'><span class='Estilo4'><b>DESCRIPCION</b></span></td>
<td align='center' width='13%'><span class='Estilo4'><b>FUENTE</b></span></td>
<td align='center' width='13%'><span class='Estilo4'><b>TIPO</b></span></td>
<td align='center' width='13%'><span class='Estilo4'><b>VIGENCIA</b></span></td>
<td align='center' width='14%'><span class='Estilo4'><b>VALOR</b></span></td>
</tr>
</div>
";

											$nuevo_total = 0;

											while ($rw = $re->fetch_assoc()) {

												$cta = $rw["cuenta"];

												$sq2 = "select proc_rec, nom_rubro, opc1, vigencia from car_ppto_gas  where id_emp = '$id_emp' and cod_pptal ='$cta' order by id asc ";
												$re2 = $cx->query($sq2);
												while ($rw2 = $re2->fetch_assoc()) {

													$fte = $rw2["proc_rec"];
													$nom_rubro = $rw2["nom_rubro"];
													$opc1_rubro = $rw2["opc1"];
													$vigencia_rubro = $rw2["vigencia"];
												}
												if ($fte == 'P') {
													$fte = 'PROPIO';
												} else {
													$fte = 'ADMINISTRADO';
												}

												printf("
<span class='Estilo4'>
<tr>
<td align='left'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'> %s </span>
</div>
</td>

<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'> %s </span></td>

</tr>

", $rw["cuenta"], $nom_rubro, $fte, $opc1_rubro, $vigencia_rubro,  number_format($rw["vr_digitado"], 2, ',', '.'));

												$nuevo_total = $nuevo_total + $rw["vr_digitado"];
											}

											printf("


  <tr bgcolor='#F5F5F5'>
    <td colspan='4'>&nbsp;</td>
	<td align='center'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>VALOR TOTAL</b> </span>
	</div>
	</td>
    <td align='right'><span class='Estilo4'><b> %s </b> </span></td>
  </tr>
</table></center>", number_format($nuevo_total, 2, ',', '.'));
											//--------	

											?>
						</div>
						<br />


						<table width="800" border="1" align="center" class="bordepunteado1">
							<tr>
								<td colspan="4" bgcolor="#DCE9E5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4"><strong>DATOS DE LA OBLIGACION PRESUPUESTAL QUE AFECTA </strong></div>
									</div>
								</td>
							</tr>
							<tr>
								<td width="200" bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo12">
											<div align="right"><strong>Codigo COBP : </strong></div>
										</div>
									</div>
								</td>
								<td width="200" bgcolor="#FFFFFF">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4"><?php printf("%s", $id_manu_cobp); ?>
											<input name="id_manu_cobp" type="hidden" value="<?php printf("%s", $id_manu_cobp); ?>" />
											<input name="id_auto_cobp" type="hidden" id="id_auto_cobp" value="<?php printf("%s", $id_auto_cobp); ?>" />
										</div>
									</div>
								</td>
								<td width="200" bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo12">
											<div align="right"><strong>Fecha COBP : </strong></div>
										</div>
									</div>
								</td>
								<td width="200" bgcolor="#FFFFFF">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4"><?php printf("%s", $fecha_cobp); ?>
											<input name="fecha_cobp" type="hidden" value="<?php printf("%s", $fecha_cobp); ?>" />
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4">
											<div align="right"><strong>Concepto COBP : </strong></div>
										</div>
									</div>
								</td>
								<td colspan="3" bgcolor="#FFFFFF">
									<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
										<div align="center" class="Estilo4">
											<div align="left"> <?php printf("%s", $des_cobp); ?>
												<input name="des_cobp" type="hidden" id="des_cobp" value="<?php printf("%s", $des_cobp); ?>" />
											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4">
											<div align="right"><strong>Referencia COBP : </strong></div>
										</div>
									</div>
								</td>
								<td colspan="3" bgcolor="#FFFFFF">
									<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
										<div align="center" class="Estilo4">
											<div align="left"> <?php printf("%s", $ref); ?>
												<input name="ref" type="hidden" id="ref" value="<?php printf("%s", $ref); ?>" />
											</div>
										</div>
									</div>
								</td>
							</tr>
						</table>
						<br />
						<table width="800" border="1" align="center" class="bordepunteado1">
							<tr>
								<td colspan="4" bgcolor="#DCE9E5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4"><strong>DATOS DE LA OBLIGACION CONTABLE DEL GASTO </strong></div>
									</div>
								</td>
							</tr>
							<tr>
								<td width="200" bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo12">
											<div align="right"><strong>Codigo : </strong></div>
										</div>
									</div>
								</td>
								<td width="200" bgcolor="#FFFFFF">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4"> <?php printf("%s", $id_obcg_e); ?> </div>
									</div>
								</td>
								<td width="200" bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo12">
											<div align="right"><strong>Fecha : </strong></div>
										</div>
									</div>
								</td>
								<td width="200" bgcolor="#FFFFFF">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4"><?php printf("%s", $fechaobcg); ?> </div>
									</div>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4">
											<div align="right"><strong>Concepto : </strong></div>
										</div>
									</div>
								</td>
								<td colspan="3" bgcolor="#FFFFFF">
									<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
										<div align="center" class="Estilo4">
											<div align="left"> <?php printf("%s", $concepto_obcg_e); ?> </div>
										</div>
									</div>
								</td>
							</tr>
						</table>

						<br />



						<div align="center"></div>
						<div align="center"><?php
											$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
											$sq = "select * from cobp where id_emp = '$id_emp' and id_auto_cobp ='$a2x' order by id asc ";
											$re = $cx->query($sq);

											printf("
<center>
 <div id='tabla2' style='display: none'>
<table width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='4'>
<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
<div align='center' class='Estilo4'><strong>IMPUTACION PRESUPUESTAL DE LA OBLIGACION</strong></div>
</div>
</td>
</tr>

<tr bgcolor='#F5F5F5'>
<td align='center' width='225'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>

<td align='center' width='325'><span class='Estilo4'><b>DESCRIPCION</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>FTE FINANCIACION</b></span></td>
<td align='center' width='125'><span class='Estilo4'><b>VALOR</b></span></td>
</tr>
</div>
");

											$nuevo_total = 0;
											while ($rw = $re->fetch_assoc()) {

												$cta = $rw["cuenta"];

												$sq2 = "select proc_rec, nom_rubro from car_ppto_gas  where id_emp = '$id_emp' and cod_pptal ='$cta' order by id asc ";
												$re2 = $cx->query($sq2);
												while ($rw2 = $re2->fetch_assoc()) {

													$fte = $rw2["proc_rec"];
													$nom_rubro = $rw2["nom_rubro"];
												}
												if ($fte == 'P') {
													$fte = 'PROPIO';
												} else {
													$fte = 'ADMINISTRADO';
												}

												printf("
<span class='Estilo4'>
<tr>
<td align='left'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'> %s </span>
</div>
</td>

<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
<td align='center'><span class='Estilo4'> %s </span></td>
<td align='right'><span class='Estilo4'>%s</span></td>

</tr>

", $rw["cuenta"], $nom_rubro, $fte, number_format($rw["vr_digitado"], 2, ',', '.'));

												$nuevo_total = $nuevo_total + $rw["vr_digitado"];
											}

											printf("

  <tr bgcolor='#F5F5F5'>
    <td colspan='2'>&nbsp;</td>
	<td align='center'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>VALOR TOTAL</b> </span>
	</div>
	</td>
    <td align='right'><span class='Estilo4'><b> %s</b> </span></td></tr>
</table></center>", number_format($nuevo_total, 2, ',', '.'));

											//--------	
											if ($_POST['fecha_ceva']) {
												$fechat = $_POST['fecha_ceva'];
											} else {
												$fechat = date('Y/m/d');
											}
											if ($_POST['des_ceva']) {
												$desseva = $_POST['des_ceva'];
											} else {
												$desseva = $des_cobp;
											}
											?>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<br />
						<table width="800" border="1" align="center" class="bordepunteado1">
							<tr>
								<td colspan="4" bgcolor="#DCE9E5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4"><strong>DATOS DEL COMPROBANTE DE EGRESO </strong></div>
									</div>
								</td>
							</tr>
							<tr>
								<td width="200" bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo12">
											<div align="right"><strong>Fecha CEVA : </strong></div>
										</div>
									</div>
								</td>
								<td colspan="2" bgcolor="#FFFFFF">
									<div style="padding-left:15px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
										<div align="left">
											<input name="fecha_ceva" type="text" class="required Estilo12" id="fecha_ceva" value="<?php echo $fechat; ?>" size="12" />
											<span class="Estilo8">:::</span>
											<input name="button2" type="button" class="Estilo12" onclick="displayCalendar(document.a.fecha_ceva,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
										</div>
									</div>
								</td>
								<td width="200" bgcolor="#FFFFFF">&nbsp;</td>
							</tr>
							<tr>
								<td bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo12">
											<div align="right"><strong>No. de CEVA (Automatico) : </strong></div>
										</div>
									</div>
								</td>
								<td width="200" bgcolor="#FFFFFF">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo4">
											<?php

											$cx = new mysqli($server, $dbuser, $dbpass, $database);
											$resulta = $cx->query("SHOW TABLE STATUS FROM $database LIKE 'ceva'");
											while ($array = $resulta->fetch_assoc()) {
												$conse = $array['Auto_increment'];
											}

											?>
											<?php printf("%s", $conse); ?>
											<input name="id_auto_ceva" type="hidden" class="Estilo12" id="id_auto_ceva" value="<?php printf("%s", $conse); ?>" />
										</div>
									</div>
								</td>
								<td width="200" bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo12">
											<div align="right"><strong>Digite Numero de CEVA: </strong></div>
										</div>
									</div>
								</td>
								<td bgcolor="#FFFFFF">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo12">
											<div align="center">
												<input name="id_manu_ceva" type="text" class="required Estilo4" id="id_manu_ceva" style="text-align:center" onkeypress="return validar(event)" value="<?php $id_manu_ceva = $_POST['id_manu_ceva'];
																																																		printf("%s", $id_manu_ceva); ?>" onkeyup="chk_ceva();" />



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
													<iframe id="datamain" src="cevaconsecutivo.php" width="200" height="290" marginwidth="0" marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
												</div>
												<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
													<div class="Estilo4" align="center" id='res_ceva'></div>
												</div>





											</div>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F5F5F5">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="center" class="Estilo12">
											<div align="right"><strong>Descripcion CEVA : </strong></div>
										</div>
									</div>
								</td>
								<td colspan="3" bgcolor="#FFFFFF">
									<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
										<div align="left" class="Estilo20">
											<input name="des_ceva" type="text" id="des_ceva" onblur="this.value=this.value.toUpperCase();" value="<?php echo 'PAGO ' . $desseva; ?>" style="width:600px;" />
										</div>
									</div>
								</td>
							</tr>

							<tr>
								<td colspan="4" bgcolor="#66CCCC">
									<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
										<div align="center" class="Estilo12">
											<div align="center"><strong>Si el pago a realizar no tiene IVA, deje la casilla en BLANCO,<br />
													caso contrario, Digite Tarifa del IVA ( Ejemplo : 16 %)<br /><br />
												</strong>
												<input name="iva" size="5" type="text" class="Estilo12" id="iva" style="text-align:center" onchange="autoCree();" onkeyup="cinco();" onkeypress="return validar(event)" value="<?php $iva = $_POST['iva'];
																																																								printf("%s", $iva); ?>" />
												<span class="Estilo14">
													<font color="#000000">%</font>::
												</span>
											</div>
										</div>
									</div>
								</td>
							</tr>
						</table>
						<br />

						<div align="center">




							<script language="jscript">



							</script>


							<?php




							$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
							$sq = "select * from cobp where id_emp = '$id_emp' and id_auto_cobp ='$a2x' order by id asc ";
							$re = $cx->query($sq);

							printf("
<center>
<table width='800' BORDER='1' class='bordepunteado1'>

<tr bgcolor='#DCE9E5'>
<td colspan='5'>
<div style='padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;'>
<div align='center' class='Estilo4'><strong>VALORES DEL COMPROBANTE DE EGRESO</strong></div>
</div>
</td>
</tr>


<tr bgcolor='#F5F5F5'>
<td align='center' width='140'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>IMPUTACION</b></span>
</div>
</td>

<td align='center' width='300' colspan='3'><span class='Estilo4'><b>DESCRIPCION</b></span></td>

<td align='center' width='120'><span class='Estilo4'><b>VR x PAGAR + IVA</b></span></td>
</tr>
");


							$vr1x = 0;
							$vr2x = 0;
							$vr3x = 0;

							while ($rw = $re->fetch_assoc()) {

								//***** CONSULTA SITUACION DE FONDOS  - NOM_CUENTA 
								$cta = $rw["cuenta"];
								$sqlx1 = "select * from car_ppto_gas where id_emp ='$id_emp' and cod_pptal ='$cta'";
								$resultadox1 = $connectionxx->query($sqlx1);

								while ($rowx1 = $resultadox1->fetch_assoc()) {
									$nom_cuenta = $rowx1["nom_rubro"];
									$situacion = $rowx1["situacion"];
									if ($situacion == 'C') {
										$situacion = 'Con Situacion';
									} else {
										$situacion = 'Sin Situacion';
									}
								}

								//***	  

								$new_iva = $iva + 1;
								$vr_sin_iva = $rw["vr_digitado"] / $new_iva;
								$vr_iva = $rw["vr_digitado"] - $vr_sin_iva;

								//***

								printf("
<span class='Estilo4'>

<!--cuenta-->
<tr>
<td align='left'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>

<span class='Estilo4'> %s </span>
</div>
</td>

<!--nom_rubro-->

<td align='left' colspan='3'><span class='Estilo4'> &nbsp; %s </span></td>

<!--vr x obligar-->


<td align='right'><span class='Estilo4'>  %s &nbsp;</span></td>

<!--vr x obligar sin iva-->



</tr>", $rw["cuenta"], $nom_cuenta, number_format($rw["vr_digitado"], 2, ',', '.'));


								$vr1x = $vr1x + $rw["vr_digitado"];
								$vr2x = $vr2x + $vr_sin_iva;
								$vr3x = $vr3x + $vr_iva;
							}

							printf("
<tr bgcolor='#F5F5F5'>
<td colspan ='4' align='right'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'><b>  TOTALES &nbsp;</span>
</div>
</td>

<td align='right' ><span class='Estilo4'> <b>%s</b> </span></td>

</tr>

<tr bgcolor='#F5F5F5'>
<td colspan ='4' align='right'> Valor a pagar sin IVA &nbsp; </td>
<td>  <input name='siniva' id='siniva'  type='text' style='text-align:right' value='' onkeypress='return validar(event)'/>  </td>
</tr>
<tr bgcolor='#F5F5F5'>
<td colspan ='4' align='right'> Valor del IVA &nbsp;</td>
<td> <input name='valoriva' id='valoriva'  type='text' style='text-align:right' value='' onkeypress='return validar(event)'/> </td>
</tr>

</table></center>", number_format($vr1x, 2, ',', '.'));
							//--------	

							?>
							<input name="valorneto" style="text-align:center" id="valorneto" type="hidden" value="<?php echo "$vr1x"; ?>" />
							<input name="valorPagar" style="text-align:center" id="valorPagar" type="hidden" value="<?php echo "$vr2x"; ?>" />
							<input name="valorIva" id="valorIva" type="hidden" value="<?php echo "$vr3x"; ?>" />


						</div>
						<br />
						<table width="800" border="1" align="center" class="bordepunteado1">
							<tr>
								<td colspan="4" bgcolor="#DCE9E5">
									<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
										<div align="center" class="Estilo12"><strong> DESCUENTOS Y DEDUCCIONES </strong></div>
									</div>
								</td>
							</tr>
							<tr>
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
												<input name="salud" type="text" class="Estilo12" id="salud" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" onChange="ceros();" />
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
												<input name="pension" type="text" class="Estilo12" id="pension" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" onChange="ceros();" />
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
												<input name="libranza" type="text" class="Estilo12" id="libranza" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" onChange="ceros();" />
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
												<input name="f_solidaridad" type="text" class="Estilo12" id="f_solidaridad" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" onChange="ceros();" />
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
												<input name="f_empleados" type="text" class="Estilo12" id="f_empleados" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" onChange="ceros();" />
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
												<input name="sindicato" type="text" class="Estilo12" id="sindicato" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" onChange="ceros();" />
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
												<input name="embargo" type="text" class="Estilo12" id="embargo" style="text-align:right" onkeypress="return validar(event)" value="<?php echo $embargo; ?>" onkeyup="tres();" onChange="ceros();" />
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
											<div align="center"><input name="cruce" type="text" class="Estilo12" id="cruce" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" onChange="ceros();" /></div>
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
												<input name="otros" type="text" class="Estilo12" id="otros" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" onChange="ceros();" />
											</div>
										</div>
									</div>
								</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</table>
						<br />
						<?php
						$sqlxx2 = "select * from modo_estampillas";
						$resultadoxx2 = $connectionxx->query($sqlxx2);
						while ($rowxx2 = $resultadoxx2->fetch_assoc()) {
							$auto = $rowxx2["auto"];
							$manu = $rowxx2["manu"];
						}
						if ($auto == 'SI' and $manu == 'NO') {
						?>
						<?php
						} else {
						?>
							<br />
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
													$retefuente = $_POST['retefuente'];
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

													/*$sqlxx2a = "SELECT * FROM retefuente WHERE concepto = '$retefuente' ";
$resultadoxx2a = mysql_db_query($database, $sqlxx2a, $connectionxx);

while($rowxx2a = $resultadoxx2a)) 
{
  $a_partir_retefuente=$rowxx2a["a_partir"];
  $tarifa_retefuente=$rowxx2a["tarifa"];

}
echo number_format($a_partir_retefuente,2,',','.');
//printf("%.0f",$a_partir_retefuente);*/
													?>
												</div>
											</div>
										</div>
									</td>
									<td>
										<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
											<div align="center" class="Estilo12">
												<div align="center" id="tarifa_e"> <?php //printf("%s",$tarifa_retefuente);//echo number_format($tarifa_retefuente,2,',','.'); //printf("%s",$tarifa_retefuente);
																					?> </div>
											</div>
										</div>
									</td>
									<td>
										<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
											<div align="center" class="Estilo12">
												<div align="center">
													<?php
													/*if($vr_tot_obli_sin_iva >= $a_partir_retefuente)
{
 $vr_retefuente = $vr_obli_para_pago_sin_iva * $tarifa_retefuente;
}
else
{
 $vr_retefuente = 0;
}*/

													//este era el que estaba
													/*if($nuevo_total >= $a_partir_retefuente)
{
 $vr_retefuente = $vr2x * $tarifa_retefuente;
}
else
{
 $vr_retefuente = 0;
}*/
													?>
													<!--              <input name="vr_retefuente" type="text" class="Estilo12" id="vr_retefuente" style="text-align:right" onkeypress="return validar(event)" value="<?php /*printf("%.0f",$vr_retefuente);*/ ?>" />-->

													<input name="vr_retefuente" type="text" class="Estilo12" id="vr_retefuente" style="text-align:right" onChange="ceros();" onkeypress="return validar(event)" value="<?php $vr_retefuente = $_POST['vr_retefuente'];
																																																						printf("%s", $vr_retefuente); ?>" onkeyup="tres();" />

												</div>
											</div>
										</div>
									</td>
								</tr>

								<!-- rete cree -->
								<tr>
									<td width="410">
										<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
											<div align="center" class="Estilo12">
												<div align="center"><strong>ReteCree</strong></div>
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
												<select name="retecree" class="Estilo12" id="retecree" style="width: 300px;" onchange="retecree2(value);">
													<option value=""></option>
													<?php
													$retefuente = $_POST['retefuente'];
													include('../config.php');
													$query = "SELECT * FROM retecree";
													$link = new mysqli($server, $dbuser, $dbpass, $database);
													$result = $link->query($query);
													while ($row = $result->fetch_assoc()) {
														if ($row['concepto'] == $retecree) {
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
												<div align="center" id="partir_cree">
												</div>
											</div>
										</div>
									</td>
									<td>
										<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
											<div align="center" class="Estilo12">
												<div align="center" id="tarifa_cree"></div>
											</div>
										</div>
									</td>
									<td>
										<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
											<div align="center" class="Estilo12">
												<div align="center">
													<input name="vr_retecree" type="text" class="Estilo12" id="vr_retecree" style="text-align:right" onChange="ceros();" onkeypress="return validar(event)" value="<?php $vr_retecree = $_POST['vr_retecree'];
																																																					printf("%s", $vr_retecree); ?>" onkeyup="tres();" onfocus="autoCree()" />

												</div>
											</div>
										</div>
									</td>
								</tr>
								<!-- fin cree -->

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
													$reteiva = $_POST['reteiva'];
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
													<?php

													/*$sqlxx2b = "SELECT * FROM reteiva WHERE concepto = '$reteiva' ";
$resultadoxx2b = mysql_db_query($database, $sqlxx2b, $connectionxx);

while($rowxx2b = $resultadoxx2b)) 
{
  $a_partir_reteiva=$rowxx2b["a_partir"];
  $tarifa_reteiva=$rowxx2b["tarifa"];

}
echo number_format($a_partir_reteiva,2,',','.');*/
													//printf("%.0f",$a_partir_reteiva);
													?>
												</div>
											</div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
											<div align="center" class="Estilo12">
												<div align="center" id="tarifa_iva"> <?php //printf("%s",$tarifa_reteiva);//echo number_format($tarifa_reteiva,2,',','.'); //printf("%s",$tarifa_reteiva); 
																						?> </div>
											</div>
										</div>
									</td>
									<td bgcolor="#F5F5F5">
										<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
											<div align="center" class="Estilo12">
												<div align="center">
													<?php
													/*if($vr_tot_obli_sin_iva >= $a_partir_reteiva)
{
 $vr_reteiva = $iva_vr_obli_pago * $tarifa_reteiva;
}
else
{
 $vr_reteiva = 0;
}*/
													//este es...
													/*if($nuevo_total >= $a_partir_reteiva)
{
 $vr_reteiva = $vr3x * $tarifa_reteiva;
}
else
{
 $vr_reteiva = 0;
}
*/
													?>

													<!--              <input name="vr_reteiva" type="text" class="Estilo12" id="vr_reteiva" style="text-align:right" onkeypress="return validar(event)" value="<?php //printf("%.0f",$vr_reteiva); 
																																																				?>" />-->

													<input name="vr_reteiva" type="text" class="Estilo12" id="vr_reteiva" style="text-align:right" onChange="ceros();" onkeypress="return validar(event)" value="<?php $vr_reteiva = $_POST['vr_reteiva'];
																																																					printf("%s", $vr_reteiva); ?>" onkeyup="tres();" />
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
											<div align="center"><span class="Estilo4">
													<select name="reteica" class="Estilo12" id="reteica" style="width: 300px;" onchange="ret_ica(value)">
														<option value=""></option>
														<?php
														$reteiva = $_POST['reteica'];
														include('../config.php');
														$query = "SELECT * FROM reteica";
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

												</span></div>
										</div>
									</td>
									<td>
										<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
											<div align="center" class="Estilo12">
												<div align="center">
													<input name="a_partir_reteica" type="text" class="Estilo12" id="a_partir_reteica" style="text-align:right" onkeyup="tres();" onkeypress="return validar(event)" value="0" />
												</div>
											</div>
										</div>
									</td>
									<td>
										<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
											<div align="center" class="Estilo12">
												<div align="center">
													<input name="tarifa_reteica" type="text" class="Estilo12" id="tarifa_reteica" style="text-align:right" onkeyup="otro();" onkeypress="return validar(event)" value="0" size="3" /> * 1000
												</div>
											</div>
										</div>
									</td>
									<td>
										<div style="padding-left:5px; padding-top:2px; padding-right:5px; padding-bottom:2px;">
											<div align="center" class="Estilo12">
												<div align="center">
													<input name="vr_reteica" type="text" class="Estilo12" id="vr_reteica" style="text-align:right" onChange="ceros();" onkeypress="return validar(event)" value="0" onkeyup="tres()" />
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
											<div align="center"><span class="Estilo4">
													<select name="estampilla1" class="Estilo12" id="estampilla1" style="width: 300px;" onchange="estamp1(value,id);">
														<option value=""></option>
														<?php
														$estampilla2 = $_POST['estampilla1'];
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
													<input name="vr_estampilla1" type="text" class="Estilo12" id="vr_estampilla1" onChange="ceros();" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" />
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
											<div align="center"><span class="Estilo4">
													<select name="estampilla2" class="Estilo12" id="estampilla2" style="width: 300px;" onchange="estamp1(value,id);">
														<option value=""></option>
														<?php
														$estampilla2 = $_POST['estampilla2'];
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
													<input name="vr_estampilla2" type="text" class="Estilo12" id="vr_estampilla2" onChange="ceros();" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" />
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
														$estampilla3 = $_POST['estampilla3'];
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
													<input name="vr_estampilla3" type="text" class="Estilo12" id="vr_estampilla3" onChange="ceros();" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" />
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
														$estampilla4 = $_POST['estampilla4'];
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
													<input name="vr_estampilla4" type="text" class="Estilo12" id="vr_estampilla4" onChange="ceros();" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" />
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
														$estampilla5 = $_POST['estampilla5'];
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
													<input name="vr_estampilla5" type="text" class="Estilo12" id="vr_estampilla5" onChange="ceros();" style="text-align:right" onkeypress="return validar(event)" value="0" onkeyup="tres();" />
												</div>
											</div>
										</div>
									</td>
								</tr>

								<tr>
									<td bgcolor="#66CCCC">
										<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
											<div align="center" class="Estilo4">
												<div align="center"><b>FORMA DE PAGO </b> <span class="Estilo12">
														<select name="forma_pago" class="Estilo4" id="forma_pago">
															<?php
															$forma = array('CHEQUE', 'EFECTIVO', 'TRANSFERENCIA', 'CRUCE DE CUETAS', 'OTRO');
															$forma_pago = $_POST['forma_pago'];
															$i = 0;
															for ($i = 0; $i <= 4; $i++) {
																if ($forma_pago == $forma[$i]) {
																	echo "<option value='$forma[$i]' selected>$forma[$i]</option>";
																} else {
																	echo "<option value='$forma[$i]'>$forma[$i]</option>";
																}
															}
															?>
														</select>
													</span></div>
											</div>
										</div>
									</td>
									<td colspan="3" bgcolor="#990000">
										<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
											<div align="center" class="Estilo12"><span class="Estilo8"><strong> VALOR NETO A PAGAR :
														= </strong></span>
												<input style="background:#990000 ; color:#FFF; border:hidden; " name="total_pagado" type="text" class="Estilo12" id="total_pagado" value="" />
											</div>
										</div>
									</td>
								</tr>
							</table>
						<?php
						}
						?>



						<br />
						<br />

						<script>
							function muestraURL() {
								var miPopup
								miPopup = window.open("../pgcp/consulta_cta.php", "CONTAFACIL", "width=800,height=400,menubar=no,scrollbars=yes")
							}
						</script>


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
								<input name="Submit322" type="submit" id="Submit322" class="Estilo19" value="Grabar Comprobante de Egreso " onClick="return valida_tabla();" />
								<!--<input type="button" name="otrobtn" id="otrobtn" value="Grabar Comprobante de Egreso Cuentas x Pagar ok" onClick="cambiar('Submit322','otrobtn')">-->
							</div>
						</div>
					</td>
				</tr>

			</table>


			</td>
			</tr>
		</form>
		<tr>

		</tr>
		<tr>
			<td colspan="3">
				<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
					<div align="center">
						<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
							<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
								<div align="center"><a href='pagos_tesoreria.php' target='_parent'>VOLVER </a> </div>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
					<div align="center"> <span class="Estilo4">Fecha de esta Sesion:</span> <br />
						<span class="Estilo4"> <strong>
								<?php include('../config.php');
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

		</table>


		<p>&nbsp;</p>
		<p>&nbsp;</p>
	</body>

	</html>






<?php

}
?>