// validar campo fecha
function ValidaFecha(id)
{
	var fecha = document.getElementById(id).value;
	var desfecha = fecha.split("/");
	var dia = parseFloat(desfecha[2]);
	var anio = parseFloat(desfecha[0]);
	var mes =  parseFloat(desfecha[1]); 
	if (fecha != undefined && fecha != "" )
	{
        if (!/^\d{4}\/\d{2}\/\d{2}$/.test(fecha))
		{
	        alert ("Formato de fecha no valido, Verifique que cumpla aaaa/mm/dd");
			document.getElementById(id).select();
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
	        alert ("Formato de fecha no valido, Verifique que cumpla aaaa/mm/dd");
			document.getElementById(id).select();
    }
 
        if (dia > numDias || dia==0){
	        alert ("Formato de fecha no valido, Verifique que cumpla aaaa/mm/dd");
			document.getElementById(id).select();
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


