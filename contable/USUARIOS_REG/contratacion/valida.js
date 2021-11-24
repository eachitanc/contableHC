// JavaScript Document
var fecha_cdp;
var fecha_crp;
var vali;
var num;
var req;
var respuesta;

function valida_numero()
{
	num_c = document.procedimientos.acto.value;
	act_c = document.procedimientos.tipo_acto.value;
	num_cont = act_c +"-"+ num_c;
	
	
	var pos_url = 'comprobadores/comprueba_numero.php';									// Carga la variable con el archivo que se pretende cargar en el servidor
	var cod = num_cont;						// Lee de un campo o id la variable que se pasa al servidor
	
	var req = new XMLHttpRequest();												// Crea el objeto XML
	if (req) {																	
	req.onreadystatechange = function() {
	if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
	
	//document.procedimientos.observaciones.value = req.responseText;
	document.getElementById('resp').innerHTML = req.responseText;
	}
	}
	req.open('GET', pos_url +'?cod='+cod,true);
	req.send(null);
	}

}

function valida_contneo()
{
	num_cont = document.a.numero_contrato.value;
	var pos_url = 'comprobadores/comprueba_numeron.php';									// Carga la variable con el archivo que se pretende cargar en el servidor
	var cod = num_cont;						// Lee de un campo o id la variable que se pasa al servidor
	
	var req = new XMLHttpRequest();												// Crea el objeto XML
	if (req) {																	
	req.onreadystatechange = function() {
	if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
	
	//document.procedimientos.observaciones.value = req.responseText;
	document.getElementById('respc').innerHTML = req.responseText;
	}
	}
	req.open('GET', pos_url +'?cod='+cod,false);
	req.send(null);
	}

}
function valida_contned()
{
	num_cont = document.a.numero_contrato.value;
	var pos_url = 'comprobadores/comprueba_numeroe.php';									// Carga la variable con el archivo que se pretende cargar en el servidor
	var cod = num_cont;						// Lee de un campo o id la variable que se pasa al servidor
	
	var req = new XMLHttpRequest();												// Crea el objeto XML
	if (req) {																	
	req.onreadystatechange = function() {
	if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
	
	//document.procedimientos.observaciones.value = req.responseText;
	document.getElementById('respc').innerHTML = req.responseText;
	}
	}
	req.open('GET', pos_url +'?cod='+cod,false);
	req.send(null);
	}

}

function valida_contne()
{
	num_cont = document.a.numero_contrato.value;
	var pos_url = 'comprobadores/comprueba_numeroce.php';									// Carga la variable con el archivo que se pretende cargar en el servidor
	var cod = num_cont;						// Lee de un campo o id la variable que se pasa al servidor
	
	var req = new XMLHttpRequest();												// Crea el objeto XML
	if (req) {																	
	req.onreadystatechange = function() {
	if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {
	
	//document.procedimientos.observaciones.value = req.responseText;
	document.getElementById('respc').innerHTML = req.responseText;
	}
	}
	req.open('GET', pos_url +'?cod='+cod,false);
	req.send(null);
	}

}
function validar(){
num_cont = document.a.numero_contrato.value;
fecha_fir = document.a.fecha_firma.value;
fecha_con = document.a.fecha_contrato.value;
plazox = document.a.plazo.value;
cedula = document.a.cedula_interventor.value;
existe = document.getElementById('respc').innerHTML;

	if (existe != "")
	{
		alert("El número de contrato ya existe");
		document.a.numero_contrato.focus()
		return (false);
	}


	if (num_cont == "")
	{
		alert("El campo número de contrato no puede estar vacio");
		document.a.numero_contrato.focus()
		return (false);
	}

	
	if (fecha_con < fecha_cdp)
	{
		
		alert("La fecha del contrato no debe ser menor a la fecha de la Disponibilidad presupuestal");
		document.a.fecha_contrato.focus()
		return (false);
	}
	
	if (fecha_con > fecha_crp)
	{
	
		alert("La fecha del contrato no debe ser mayor al Registro presupuestal");
		document.a.fecha_contrato.focus()
		return (false);
	}
	
	
	if (fecha_fir < fecha_con)
	{
		alert("La fecha de firma del contrato no puede ser inferior a la fecha del Contrato");
		document.a.fecha_firma.focus()
		return (false);
	}
	
	if (plazox == "")
	{
		alert("El campo plazo del contrato no puede estar vacio");
		document.a.plazo.focus()
		return (false);
	}
	
	if (!/^([0-9])*$/.test(plazox)){
	alert("El valor del plazo no es un número");
	document.a.plazo.focus()
	return (false);
	}
	
	if (cedula == "")
	{
		alert("El campo Interventor no puede estar vacio");
		document.a.cedula_interventor.focus()
		return (false);
	}
	
	
	
	
	return (true);
}


function validar_todas()
{
acto = document.procedimientos.acto.value;
fecha = document.procedimientos.fecha_acto.value;
descripcion = document.procedimientos.descripcion.value;
observaciones = document.procedimientos.observaciones.value;
existe = document.getElementById('resp').innerHTML;
if (existe !="" )
	{
		alert("El NUMERO del acto administrativo ya existe");
		document.procedimientos.acto.focus()
		return false;
	}
/*if (acto =="" )
	{
		alert("El campo NUMERO del acto administrativo o documento no puede estar vacio");
		document.procedimientos.acto.focus()
		return false;
	}
*/
if (fecha =="" )
	{
		alert("El campo FECHA no puede estar vacio");
		document.procedimientos.fecha_acto.focus()
		return false;
	}
if (descripcion =="" )
	{
		alert("El campo DESCRIPCION no puede estar vacio");
		document.procedimientos.descripcion.focus()
		return false;
	}
	
	return true;
	

}


function validar_garantia()
{
  
	
	acto = document.procedimientos.acto.value;
	fecha = document.procedimientos.fecha_acto.value;
	descripcion = document.procedimientos.descripcion.value;
	observaciones = document.procedimientos.observaciones.value;	
	numero_poliza = document.procedimientos.numero_poliza.value;
	fecha_poliza = document.procedimientos.fecha_poliza.value;
	aseguradora = document.procedimientos.aseguradora.value;
	
	cr1 = document.procedimientos.cr_poliza1.checked;
	cr2 = document.procedimientos.cr_poliza2.checked;
	cr3 = document.procedimientos.cr_poliza3.checked;
	cr4 = document.procedimientos.cr_poliza4.checked;
	cr5 = document.procedimientos.cr_poliza5.checked;
	cr6 = document.procedimientos.cr_poliza6.checked;
	cr7 = document.procedimientos.cr_poliza7.checked;
			
		
		
		if (acto =="" )
		{
			alert("El campo NUMERO del acto administrativo o documento no puede estar vacio");
			document.procedimientos.acto.focus()
			return (false);
		}
	
		if (fecha =="" )
		{
			alert("El campo FECHA no puede estar vacio");
			document.procedimientos.fecha_acto.focus()
			return (false);
		}
		if (descripcion =="" )
		{
			alert("El campo DESCRIPCION no puede estar vacio");
			document.procedimientos.descripcion.focus()
			return (false);
		}
	
		if (numero_poliza =="" )
		{
			alert("El campo NUMERO DE LA POLIZA no puede estar vacio");
			document.procedimientos.numero_poliza.focus()
			return (false);
		}
	
		if (fecha_poliza =="" )
		{
			alert("El campo FECHA DE LA POLIZA no puede estar vacio");
			document.procedimientos.fecha_poliza.focus()
			return (false);
		}
		if (aseguradora =="" )
		{
			alert("El campo ASEGURADORA no puede estar vacio");
			document.procedimientos.aseguradora.focus()
			return (false);
		}
		
		if (cr1 == true)
			{
					
					valor = document.procedimientos.vr_poliza1.value;
					f1 = document.procedimientos.fecha_poliza1_d.value;
					f2 = document.procedimientos.fecha_poliza1_h.value;
					
					if ((valor =="")  || (f1 =="") || (f2=="") )
						{
							alert("Los campos del TIPO DE AMPARO 1 son obligatorios");
							document.procedimientos.vr_poliza1.focus()
							return (false)
									
						}

					if (!/^([0-9,.])*$/.test(valor))
						{
							alert("Solo se permiten número");
							document.procedimientos.vr_poliza1.focus()
							return (false);
						}	


			}
			
			
						
			
		if (cr2 == true)
			{
					
					valor = document.procedimientos.vr_poliza2.value;
					f1 = document.procedimientos.fecha_poliza2_d.value;
					f2 = document.procedimientos.fecha_poliza2_h.value;
					
					if ((valor =="")  || (f1 =="") || (f2=="") )
						{
							alert("Los campos del TIPO DE AMPARO 2 son obligatorios");
							document.procedimientos.vr_poliza2.focus()
							return (false)
									
						}

			}	
			
		if (cr3 == true)
			{
					
					valor = document.procedimientos.vr_poliza3.value;
					f1 = document.procedimientos.fecha_poliza3_d.value;
					f2 = document.procedimientos.fecha_poliza3_h.value;
					
					if ((valor =="")  || (f1 =="") || (f2=="") )
						{
							alert("Los campos del TIPO DE AMPARO 3 son obligatorios");
							document.procedimientos.vr_poliza4.focus()
							return (false)
									
						}

			}	
		
		if (cr4 == true)
			{
					
					valor = document.procedimientos.vr_poliza4.value;
					f1 = document.procedimientos.fecha_poliza4_d.value;
					f2 = document.procedimientos.fecha_poliza4_h.value;
					
					if ((valor =="")  || (f1 =="") || (f2=="") )
						{
							alert("Los campos del TIPO DE AMPARO 4 son obligatorios");
							document.procedimientos.vr_poliza4.focus()
							return (false)
									
						}

			}	
		
		
			if (cr5 == true)
			{
					
					valor = document.procedimientos.vr_poliza5.value;
					f1 = document.procedimientos.fecha_poliza5_d.value;
					f2 = document.procedimientos.fecha_poliza5_h.value;
					
					if ((valor =="")  || (f1 =="") || (f2=="") )
						{
							alert("Los campos del TIPO DE AMPARO 5 son obligatorios");
							document.procedimientos.vr_poliza5.focus()
							return (false)
									
						}

			}	
		
		
		if (cr6 == true)
			{
					
					valor = document.procedimientos.vr_poliza6.value;
					f1 = document.procedimientos.fecha_poliza6_d.value;
					f2 = document.procedimientos.fecha_poliza6_h.value;
					
					if ((valor =="")  || (f1 =="") || (f2=="") )
						{
							alert("Los campos del TIPO DE AMPARO 6 son obligatorios");
							document.procedimientos.vr_poliza6.focus()
							return (false)
									
						}

			}	
			
				if (cr7 == true)
			{
					
					valor = document.procedimientos.vr_poliza7.value;
					f1 = document.procedimientos.fecha_poliza7_d.value;
					f2 = document.procedimientos.fecha_poliza7_h.value;
					
					if ((valor =="")  || (f1 =="") || (f2=="") )
						{
							alert("Los campos del TIPO DE AMPARO 7 son obligatorios");
							document.procedimientos.vr_poliza7.focus()
							return (false)
									
						}
			}
		
		return (true);
	
}




function busca_valor()
{

var pos_url = 'comprobadores/comprueba_valor_crpp.php';									// Carga la variable con el archivo que se pretende cargar en el servidor
var cod = document.procedimientos.id_manu_crpp.value;						// Lee de un campo o id la variable que se pasa al servidor

var req = new XMLHttpRequest();												// Crea el objeto XML
if (req) {																	
req.onreadystatechange = function() {
if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {

document.procedimientos.valor_adicion.value = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,true);
req.send(null);
}

}


function validar_adicion()
{
acto = document.procedimientos.acto.value;
fecha = document.procedimientos.fecha_acto.value;
descripcion = document.procedimientos.descripcion.value;
observaciones = document.procedimientos.observaciones.value;
crpp = document.procedimientos.id_manu_crpp.value;
plazo = document.procedimientos.plazo_numero.value;

	if (acto =="" )
	{
		alert("El campo NUMERO del acto administrativo o documento no puede estar vacio");
		document.procedimientos.acto.focus()
		return (false);
	}

	if (fecha =="" )
	{
		alert("El campo FECHA no puede estar vacio");
		document.procedimientos.fecha_acto.focus()
		return (false);
	}
	if (descripcion =="" )
	{
		alert("El campo DESCRIPCION no puede estar vacio");
		document.procedimientos.descripcion.focus()
		return (false);
	}
	if ((crpp =="") && (plazo =="" || plazo ==0 ))
	{
		alert("Debe seleccionar un registro o determinar el plazo de la adición");
		document.procedimientos.id_manu_crpp.focus()
		return (false);
	}
		
	if (!/^([0-9])*$/.test(plazo)){
	alert("El valor del plazo no es un número");
	document.procedimientos.plazo_numero.focus()
	return (false);
	}
	
	return (true);
}

function validar_interventoria()
{
	vali = validar_todas();
	
	if (vali == false)
	{
		return false;
	}
	else
	{
		tipo_acta = document.procedimientos.tipo_acta_interventoria.value;
		if (tipo_acta =="")
		{
		alert("El TIPO DE ACTA no puede estar vacio");
		document.procedimientos.tipo_acta_interventoria.focus()
		return false;
		}
		return true;
	}
}


function validar_liquidacion()
{
	vali = validar_todas();
	
	if (vali == false)
	{
		return false;
	}
	else
	{
		fter = document.procedimientos.fecha_termina.value;
		if (fter =="")
		{
		alert("La fecha de terminación no puede estar vacio");
		document.procedimientos.fecha_termina.focus()
		return false;
		}
		return true;
	}
		
}