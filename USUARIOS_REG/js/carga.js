// JavaScript Document
function EnviarForm(formulario,ruta)  
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
					if (campo ==''){
						alert("El campo es obligatorio...");
						//var pestana = elemento.split('_');
						// muestro la pestaña que contiene el elemento validado
						//VerPestana(pestana[1]);
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
						$("#mainContent").fadeOut(function() {
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

// Funcion para mostrar cualquier archivo en el div contenido	
function  cargaArchivo(archivo)
	{
		document.body.style.cursor = "default"; 
		$("#mainContent").load(archivo);	
		
	}
// Para eliminar archivos con mensaje de conformacion
function  borrarRegistro(archivo)
	{
	if (confirm("Esta seguro de eliminar el registrio?"))
			{
			 $("#mainContent").load(archivo);	
			}
	}

// Para mostrar terceros por letra
function  cargaTerceros(archivo,letra)
	{
		var archivo2 = archivo + "?letra="+letra;
		$("#mainContent").load(archivo2);
	}


// validar campo fecha
function ValidaFecha(fecha,id)
{
	var error ='';
	var desfecha = fecha.split("/");
	var dia = parseFloat(desfecha[2]);
	var anio = parseFloat(desfecha[0]);
	var mes =  parseFloat(desfecha[1]); 
	if (fecha != undefined && fecha != "" )
	{
        if (!/^\d{4}\/\d{2}\/\d{2}$/.test(fecha))
		{
	        var error = 'error 1';
			return error;			
        }

    switch(mes){
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            var numDias=31;
            break;
        case 4: case 6: case 9: case 11:
            var numDias=30;
            break;
        case 2:
            if (comprobarSiBisisesto(anio)){ numDias=29 }else{ numDias=28};
            break;
        default:
	        var error = 'error 2';
			return error;
    }
 
        if (dia > numDias || dia==0){
	        var error = 'error 3';
			return error;
        }
        return error;
    }

}

function comprobarSiBisisesto(anio){
    if ( ( anio % 100 != 0) && ((anio % 4 == 0) || (anio % 400 == 0))) {
        return true;
        }
    else {
        return false;
        }
}


