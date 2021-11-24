<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<!-- Enlases externos -->
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<script type="text/javascript" src="../js/fechas.js"></script>
<link type="text/css" rel="stylesheet" href="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" />
<link rel="stylesheet" type="text/css" href="../css/jquery.autocomplete.css" />
<link rel="stylesheet" href="../css/font-awesome.css"  media="all" />  

<script language="javascript">
// validar campo fecha

function validar2()
{
	var numero = document.getElementById('cdpp').value;
	if (!numero)
	{
		alert("Falta determinar el número de consecutivo del CDPP..");
		document.getElementById('cdpp').select();
		return false;
	}
	
	var libre = document.getElementById('res_cdpp').value;
	if(libre != 1)
	{
		alert("El número de CDP ya fue utilizado...");
		document.getElementById('cdpp').select();
		return false;
	}
	
	var des = document.getElementById('des').value;
	if(des =='')
	{
		alert("Por favor digite la descripción del CDP...");
		document.getElementById('des').select();
		return false;
	}
	var filas = document.getElementById('filas').value;
	
	var j =1;
	for (j=1;j<=filas;j++)
	{
		//Verifico que el valor no este en cero
		var valor = document.getElementById('valor_'+j).value;
		if (valor =='') 
		{
			alert("El valor no puede estar vacio...");
			document.getElementById('valor_'+j).select();
			return false;
		}
	}
	var i =1;
	for (i=1;i<=filas;i++)
	{
		// Verifico que la cuenta sea de destalle
		tipo_cuenta('campo_'+i);
	}
		// Disponible del rubro
	var n =1;
	for (n=1;n<=filas;n++)
	{
	// Verifico que la cuenta sea de destalle
		var dis = document.getElementById('disponible_'+n).innerHTML;
		if (dis =='No disponible') 
		{
			alert("Valor no es disponible");
			document.getElementById('valor_'+n).focus();
			return false;
		}
	}
	// verifico que no se seeccionen rubros repetidos
	var m=1;
	var cont=0;
	for (m=1;m<=filas;m++)
	{
		
		var cuenta = document.getElementById('valcourse_'+m).value;
		var o=1;
		for (o=1;o<=filas;o++)
		{
			var otra = document.getElementById('valcourse_'+o).value;
			if (cuenta == otra)
			{
				cont++;
			}
			
		}
		
	}
	if(cont >filas)
	{
	 alert("Se ha seleccionado rubros presupuestales duplicados...");
	 return false;	
	}
return true;
}

function saldo_cuenta(id)
{
var campo =id.split("_");
var cuenta = document.getElementById('valcourse_'+campo[1]).value;
var pos_url2 = 'consultas/consulta_saldo.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				var dato = parseFloat(req1.responseText);
				var valor = parseFloat(document.getElementById('valor_'+campo[1]).value);
				if (valor <= dato)
				{
					document.getElementById('disponible_'+campo[1]).innerHTML="Disponible";
				}else{
					document.getElementById('disponible_'+campo[1]).innerHTML="No disponible";	
				}
				
			}
		}
	req1.open('POST', pos_url2 +'?cod='+cuenta,false);
	req1.send(null);
	}
}
function consecutivo2()
{
var fec = document.getElementById('fecha_reg').value;
var pos_url2 = 'consultas/concec_cdpp.php';
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				var dato = req1.responseText;
				var elem = dato.split(',');
				concec = elem[0];
				fecha2 = elem[1];
				document.getElementById('cdpp').value =concec;
				chk_cdpp();
				if (fec != fecha2)
				{
				alert ("Fecha sugerida para el consecutivo disponible: "+fecha2);
				}
				
			}
			
		}
	req1.open('POST', pos_url2 +'?cod='+fec,true);
	req1.send(null);
	}
fecha_ven2();
}

function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
} 

function fecha_ven2()
{
var fecha = document.getElementById("fecha_reg").value;
fecha= new Date(fecha);
fecha.setDate(fecha.getDate()+90);
 var anio=fecha.getFullYear();
  var mes= fecha.getMonth()+1;
  var dia= fecha.getDate();
  if(mes.toString().length<2){
    mes="0".concat(mes);        
  }    
  if(dia.toString().length<2){
    dia="0".concat(dia);        
  }
  
 fecha_ven = anio+"/"+mes+"/"+dia;
 if (anio != '2015')
 	{
		 fecha_ven = '2014/12/31';
	}
  document.getElementById("fecha_ven").value=fecha_ven;
}


 
function chk_cdpp()
{
	var pos_url = 'comprueba_cdpp.php';
	var cod = document.getElementById('cdpp').value;
	var req = new XMLHttpRequest();
	if (req) {
	req.onreadystatechange = function() {
	if (req.readyState == 4 ) {
	document.getElementById('res_cdpp').value = req.responseText;
	if (req.responseText != 1)	document.getElementById('res').innerHTML = req.responseText; else document.getElementById('res').innerHTML = '';
	}
	}
	req.open('GET', pos_url +'?cod='+cod,false);
	req.send(null);
	}
}

$().ready(function() {
	$("[id*=course_]").autocomplete("cuentas.php", {
		width: 600,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	$("#course").result(function(event, data, formatted) {
		$("#valcourse_1").val(data[1]);
	});
});

function tipo_cuenta(id)
{
var llega =id.split("_");
var cuenta = document.getElementById('valcourse_'+llega[1]).value;
if (cuenta=='')
{
alert("La cuenta no puede estar vacia...");
document.getElementById('course_'+llega[1]).select();
}
var pos_url2 = 'consultas/tipo_cuenta.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				var dato = req1.responseText;
				if (dato =='M')
				{
					alert("La cuenta seleccionada no es de detalle...");
					document.getElementById('course_'+llega[1]).select();
					return false;
				}
			}
		}
	req1.open('POST', pos_url2 +'?cod='+cuenta,false);
	req1.send(null);
	}
}

function mas_inputs()
{
var vari=document.getElementById('filas').value;
	if (vari >=20) 
	{
		vari =20;
	}else{
		varix =parseFloat(vari)+1;
		document.getElementById('filas').value = varix;
		var mostrar = 'inputx'+varix;
		document.getElementById(mostrar).style.display="";
	}
}

function menos_inputs()
{
	vari2=document.getElementById('filas').value;
	if (vari2 >1) 
	{
		vari2 =parseFloat(vari2);
		document.getElementById('filas').value = vari2-1;		// envio el valor de las filas actuales al input para enviar tamaño al post 
		var mostrar = 'inputx'+vari2;
		document.getElementById(mostrar).style.display="none";
		document.getElementById('course_'+vari2).value ='';
		document.getElementById('valcourse_'+vari2).value ='';
		document.getElementById('valor_'+vari2).value ='';
		document.getElementById('disponible_'+vari2).innerHTML ='';
	}
}

</script>
</head>
<body onload="consecutivo2()">
<br />
<div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	 
</div>
<br />
<br />
<?php
$num_filas =1;
include('../config.php');
$cx=mysql_connect ($server, $dbuser, $dbpass);
// consulta para estabblecer la fecha de sesion
mysql_select_db("$database"); 
$sqlxx = "select * from fecha where user ='$_SESSION[login]'";
$result = mysql_query($sqlxx, $cx);
while($rowxx = mysql_fetch_array($result)) 
{
  $ano=$rowxx["ano"];
}
// Consulta para determinar el consecutivo iterno
$sql= "SHOW TABLE STATUS FROM $database LIKE 'cdpp'";
$resulta = mysql_query($sql,$cx);
while($array = mysql_fetch_array($resulta)) 
{
$consecutivo = $array[Auto_increment];
}
?>
<form name="a" method="post"   id="commentForm" action="p_mvto13.php">
<input name='consecutivo' type='hidden' class='Estilo4' id='consecutivo' value='<?php echo $consecutivo; ?>'/>
<table width="60%" border="0" align="center" class="bordepunteado1" cellspacing="2" cellpadding="7" >
     <tr>
    	<td bgcolor="#DCE9E5" align="center" class="Titulotd" colspan="2">CERTIFICADO DE DISPONIBILIDAD PRESUPUESTAL</td>
        <td align="right" class="Titulotd"><a href="mvto.php?a=CDPP">X</a></td>
     </tr>

     <tr>
     	<td class="Titulofor" width="35%"></td>
        <td width="60%"></td>
        <td width="5%"></td>
     </tr>
     <tr>
    	<td class="Titulofor" align="right">No CDP :</td>
        <td colspan="2"><input name="cdpp" type="text" class="Estilo4" id="cdpp" size="18" ondblclick="consecutivo2();" onkeypress="return validar(event)" style="text-align:left" onkeyup="chk_cdpp();" />
        &nbsp;<input type="hidden" class="Estilo4" id='res_cdpp' name="res_cdpp"><label class="Estilo4" align="center" id='res'></label>&nbsp;<a href="cdppconsecutivo.php" target="_blank">Historial</a> &nbsp;<a href="num_cdpp.php" target="_blank">Libres</a> </td>
        </td>
    </tr>
     <tr>
    	<td class="Titulofor" align="right">Fecha expedici&oacute;n :</td>
        <td colspan="2" > <input name="fecha_reg" type="text" class="required Estilo4" id="fecha_reg" value="<?php echo $ano; ?>" size="12" onchange="consecutivo2();" onblur="ValidaFecha(id);" />
      <input name="button2" type="button" class="Estilo4" onclick="displayCalendar(document.a.fecha_reg,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
      <label style="padding-left:30px; padding-left:40px;" class="Titulofor">Fecha vencimiento :
      <input name="fecha_ven" type="text" class="required Estilo4" id="fecha_ven" value="<?php echo $ano; ?>" size="12" onblur="ValidaFecha(id);"  />
      <input name="button2" type="button" class="Estilo4" onclick="displayCalendar(document.a.fecha_ven,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
      </label></td>
    </tr>
     <tr>
    	<td class="Titulofor" align="right">Descripc&oacute;n :</td>
        <td colspan="2"><textarea name="des" cols="90" rows="4" class="required Estilo4" id="des" ></textarea></td>
    </tr>
     <tr>
    	<td class="Titulofor" colspan="3" height="20" align="center" >Inputaci&oacute;n presupuestal</td>
     </tr>
     <tr>
       	<td colspan="3" align="center" bgcolor="#DCE9E5">
    		<img src="../simbolos/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='mas_inputs();'>
             &nbsp;&nbsp;<input name="filas" style="background:#DCE9E5 ; color:#333; border:hidden; text-align:center"  type="text" id="filas" value='<?php echo $num_filas;  ?>' size="2" />	&nbsp;&nbsp;
    		<img src="../simbolos/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='menos_inputs();'>
        </td>
    </tr>
    <tr>
      	<td class="Titulofor" align="left"><div style="padding-left:30px;">Rubro:</div></td>
        <td class="Titulofor" align="center" colspan="2"><div style="padding-left:168px;">Valor:</div></td>
    </tr>
	<tr>
    	<td colspan="3">
        		<table width="100%" border="0" align="center" >
					
					<?php                    
                    for ($k=1;$k<=20;$k++)
					{
                      echo "<tr style='display:$ver;' id='inputx$k'>
                            <td align='center' width='65%'><input type='text' name='course_$k' class='Estilo4' id='course_$k' size='95' />
                                <input type='hidden' name='cuenta_$k' id='valcourse_$k' /></td>
                            <td align='left' width='35%'><input name='valor_$k' type='text' class='Estilo4' id='valor_$k' size='20' onkeypress='return validar(event)' onkeyup='saldo_cuenta(id);' onFocus='tipo_cuenta(id);' style='text-align:right' />&nbsp;<label class='Estilo4' id='disponible_$k' align='left'></label></td>
                           </tr>";
					if ($k > $num_filas-1)  $ver ="none";
					}
					?>
                </table>
        </td>
    </tr>		
     <tr>
    	<td class="Titulofor" colspan="3" height="20" align="center" ><input name="Submit322" type="submit" class="Estilo4"  value="Guardar" 
			onclick="return validar2()" /></td>
     </tr>
</table>
</form>
<script>
document.getElementById("des").focus();
</script>
</body>
</html>
<?
}
?>
