// JavaScript Document


// Funcion para mostrar cualquier archivo en el div contenido desde el munu pricipal
function  cargaArchivo(archivo,div)
	{
		document.body.style.cursor = "default"; 
		$("#"+div).load(archivo);	
		alert();
		
	}
// Funcion para mostrar cualquier archivo en el div contenido desde el munu pricipal
function  cargaArchivoModal(archivo,div,modal)
	{
		document.body.style.cursor = "default"; 
		$("#"+div).load(archivo);	
		var dialogo = document.getElementById(modal);
     	 dialogo.showModal();
		 
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
