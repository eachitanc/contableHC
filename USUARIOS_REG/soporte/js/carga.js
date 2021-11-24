// Funcion para mostrar cualquier archivo en el div contenido desde el munu pricipal
function  cargaArchivo(archivo,div)
	{
		$('#dialog2').remove();
		document.body.style.cursor = "default"; 
		$("#"+div).load(archivo);
	}
	
