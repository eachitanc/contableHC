// JavaScript Document
function EnviarForm(formulario,ruta,div)  
	// formulario: nombre del formulario que vamos a eviar por ajax, ruta: es el archivo que realizará la petición del servidor
	{
		// valido formulario campos obligtorios
		var valida =0;
		for (i=0;i<formulario.elements.length;i++){
			var input = formulario.elements[i].id;
			var obli = input.substring(0,3);
			if (obli =='OBL'){
				// validar que el campo este marcado como OBL_xxxxxx este lleno
				var elemento = formulario.elements[i].id;
				var campo = formulario.elements[i].value;
					if (campo == ''){
						alert("El campo es obligatorio...");
						var pestana = elemento.split('_');
						// muestro la pestaña que contiene el elemento validado
						VerPestana(pestana[1]);
						formulario.elements[i].focus();
						valida =1;
						break;
					}
			}
		}
		// si validacion ok envio el formulario
	
	if (valida ==0)
	{	
		// Enciende mensaje de espera 
		$("#divCargando").show();
		// Carga los valores del formulario en un array serializado
		var valores = $(formulario).serialize();
		// Envio la peticion al servidor
		$.ajax({type: 'POST',
				url: ruta,
				data: valores,
				cache: false,
				// async:false,
				// •beforeSend : Indicamos el nombre de la función que se ejecutará previo al envío de datos gif animado
				
				success: function(respuesta) // indica la funcion que se ejecutar cuando obtenemos la respuersta del servidor
						{
						// iniciamos desvanecimiento
						$("#"+div).fadeOut(function() {
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

// Funcion para mostrar cualquier archivo en el div contenido desde el munu pricipal
function  cargaMenu(event,archivo,div,menu)
	{
		document.body.style.cursor = "default"; 
		$("#"+div).load(archivo);	
		// Cierro el menu desplegado
		buttonClick(event, menu);
		document.getElementById(menu).style.visibility="hidden";
		borrarMarca();
	}
// Funcion para mostrar cualquier archivo en el div contenido desde el munu pricipal
function  cargaMenu2(event,archivo,div,menu)
	{
		document.getElementById('columna1').style.display="none";
		document.getElementById('columna3').style.display="none";
	    document.getElementById('columna2').style.display="block";
		document.body.style.cursor = "default"; 
		$("#"+div).load(archivo);	
		// Cierro el menu desplegado
		buttonClick(event, menu);
		document.getElementById(menu).style.visibility="hidden";
		borrarMarca();
	}
// Funcion para mostrar cualquier archivo en el div contenido desde el munu pricipal
function  cargaArchivo(archivo,div)
	{
		document.body.style.cursor = "default"; 
		$("#"+div).load(archivo);	
		
	}

// funcion para mostrar un combo segun consulta preliminar

function VerSector(archivo,id)
{
	var vereda = document.getElementById(id).value;
	var destino = archivo + "?cod="+vereda;
	$("#sector").load(destino);
}

// Para eliminar archivos con mensaje de conformacion
function  borrarRegistro(archivo,div)
	{
	if (confirm("Esta seguro de eliminar el registrio?"))
			{
			 $("#"+div).load(archivo);	
			}
	}

// Para ocultar o mostrar div area de menu
function ocultaMenu(value)
{
	var estado = document.getElementById('ctrl').value;
	if (estado == 0)
  		{
			//mostrar
			document.getElementById("izquierda").style.display="block";
			document.getElementById('ctrl').value=1;
			document.getElementById("derecha").style.width="80%";
			
		}
	if (estado ==1)
		{
			// ocultar
			document.getElementById("izquierda").style.display="none";
			document.getElementById('ctrl').value=0;
			document.getElementById("derecha").style.width="100%";
		}
	
	} 

// para cambiar colores menu
function activaMenu(id)
{
	document.getElementById(id).style.backgroundColor="#72A0CF";
	document.getElementById(id).style.color="#ffffff";
	//document.getElementById("control1").value=id;
	}
function quitaMenu(id)
{
	var marca = document.getElementById("control1").value;
	if (id != marca)
	{
	document.getElementById(id).style.backgroundColor="#E8EEFA";
	document.getElementById(id).style.color="#33679b";
	}
}
function marcaMenu(id)
{
	var control2 = document.getElementById("control2").value;
	document.getElementById("control1").value=id;
	//Cuando marca borra las demas
	for (i=1;i<= control2;i++)
		{
			var opci = "m"+i;
			if (opci != id)
			{
				document.getElementById(opci).style.backgroundColor="#E8EEFA";
				document.getElementById(opci).style.color="#33679b";
			}
		}
}
function borrarMarca()
{
	var control2 = document.getElementById("control2").value;
	for (i=1;i<= control2;i++)
		{
			var opci = "m"+i;
				document.getElementById(opci).style.backgroundColor="#E8EEFA";
				document.getElementById(opci).style.color="#33679b";
				document.getElementById("control1").value='';
		}
}
// para mover pestañas en un formulario

function MostrarPes(id)
{
	var i=0;
	var cuantos =$("#lista li").size();
	for (i=0;i<cuantos;i++)
	{
		j=i+1;
		var ctls = 'lis_'+j;
		var pes = 'p_'+j;
		if (ctls == id)
			{
				// aplicar estilos
				document.getElementById(ctls).style.backgroundColor="#ffffff";
				document.getElementById(pes).style.display="";
				// estilos de pestaña seleccionada
				document.getElementById(ctls).className="pesta";
				
			}else{
				document.getElementById(ctls).style.backgroundColor="#E8EEFA";
				document.getElementById(pes).style.display="none";
				document.getElementById(ctls).className="pestaOff";
			} 
		}
	}

//
// Limpia campo de validacion
function limpiaCampo(id)
{
	var marca = id+"_e";
	document.getElementById(marca).innerHTML='';
}

// Validar datoingresado sea numerico
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  