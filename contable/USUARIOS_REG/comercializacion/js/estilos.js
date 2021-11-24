// JavaScript Document
function cambiaColor(id)
{
	document.body.style.cursor = "pointer"; 
	document.getElementById('acciones'+id).style.display="block";
	document.getElementById(id).style.background="#E8EEFA";
}

function fueraPuntero(id)
{
	document.body.style.cursor = "default"; 
	document.getElementById('acciones'+id).style.display="none";
	document.getElementById(id).style.background="#ffffff";
}

// Cambia la opcion del puntero al entrar o salir de un elemento
function punteroOn()
{
	document.body.style.cursor = "pointer"; 	
}

function punteroOff()
{
	document.body.style.cursor = "default"; 	
}

// ******************* FUNCIONES DE VALIDACION DE FORMULARIOS

// validar campo numero
function validarNum(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);
}

//Validar campo correo electronico
function ValidaCorreo(id)
{
var correo = document.getElementById(id).value;
        var b=/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/;   
        //comentar la siguiente linea si no se desea que aparezca el alert()   
        //alert("Email " + (b.test(correo)?"":"no ") + "válido.") ;  
        //devuelve verdadero si validacion OK, y falso en caso contrario
		if (b.test(correo)==false)
		{
	        alert ("Error en el formato del Correo Electronico");
			document.getElementById(id).focus();
		}
}

// validar campo fecha
function ValidaFecha(id)
{
	var fecha = document.getElementById(id).value;
	if (fecha =='')
	{
		alert ("La fecha no puede estar vacia");
		document.getElementById(id).focus();
		return false;			
	}
	
	var desfecha = fecha.split("/");
	var dia = parseFloat(desfecha[0]);
	var anio = parseFloat(desfecha[2]);
	if (anio < 1880)
	{
		alert ("El año seleccionado esta fuera de limite...");
		document.getElementById(id).focus();
		return false;			
	}
	var fecha_a = document.getElementById('fecha_actual').value;
	var fe_a = Date.parse(fecha_a);
	var fe_f = Date.parse(fecha);
	if (fe_f > fe_a)
	{
		alert ("La fecha seleccinada es mayor a la fecha actual");
		document.getElementById(id).focus();
		return false;			
	}
	var mes =  parseFloat(desfecha[1]); 
	if (fecha != undefined && fecha != "" )
	{
        if (!/^\d{2}\/\d{2}\/\d{4}$/.test(fecha))
		{
	        alert ("Formato de fecha no valido, Verifique que cumpla dd/mm/aaaa");
			document.getElementById(id).focus();
			return false;			
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
	        alert ("Formato de fecha no valido, Verifique que cumpla dd/mm/aaaa");
			document.getElementById(id).focus();
    }
 
        if (dia > numDias || dia==0){
	        alert ("Formato de fecha no valido, Verifique que cumpla dd/mm/aaaa");
			document.getElementById(id).focus();
        }
        return true;
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


function VerPestana(valor) {
	
	var frm = document.getElementById("form_menu");
	var fin = parseInt(frm.elements.length);
	for (i=0;i<fin;i++){
		j=i+1;
		var input = frm.elements[i].id;
		if(input == valor)
			{
         		document.getElementById(valor).style.background="#FF952B";
				document.getElementById('pestana_'+j).style.display="block";
			}
		if (input != valor)
			{
				document.getElementById('menu'+j).style.background="#006699";
				document.getElementById('pestana_'+j).style.display="none";
			}
	}
}
// funcion para incremenar o reducir el dia a una fecha 
function sumarfechas(d,fec)
{
 var fecha = document.getElementById(fec).value;
 var Fecha = new Date();
 //var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
 var sFecha = fecha || (Fecha.getFullYear() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getDate());
 var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
 var aFecha = sFecha.split(sep);
 var fecha = aFecha[0]+'/'+aFecha[1]+'/'+aFecha[2];
 fecha= new Date(fecha);
 fecha.setDate(fecha.getDate()+parseInt(d));
 var anno=fecha.getFullYear();
 var mes= fecha.getMonth()+1;
 var dia= fecha.getDate();
 mes = (mes < 10) ? ("0" + mes) : mes;
 dia = (dia < 10) ? ("0" + dia) : dia;
 //var fechaFinal = dia+sep+mes+sep+anno;
 var fechaFinal = anno+sep+mes+sep+dia;
 document.getElementById(fec).value=fechaFinal;
 }

function sumarAnno(valor,fecha)
{
var fechas = document.getElementById(fecha).value;
var anno = fechas.split('/');
var anno2 = anno[0];
if (valor == "+")
{
	 var anno3 = parseInt(anno2) + 1;
}else{
  var anno3 =parseInt(anno2) - 1;
}
var fechan = anno3 + '/' + anno[1] + '/' +anno[2];
document.getElementById(fecha).value=fechan;
}
// function para poner separador de milles en campo numerico
function formatea(valor)
{
	var valor = valor.toString();
	var num = valor.replace(/\,/g,'');
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,');
		num = num.split('').reverse().join('').replace(/^[\,]/,'');
		return num;
	}
}
//para validar campo numerico
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46 || tecla =='') return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
// funcion para cambiar el valor temporal del tipo de articulo que se selecciona para aplicar a filtros






