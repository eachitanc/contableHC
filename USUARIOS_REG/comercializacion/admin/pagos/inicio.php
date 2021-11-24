<?php
session_start();
$fecha = $_GET['fecha'];
if($_GET['fecha'] == '') $fecha = date('Y/m/d');
$nuevafecha = strtotime ( '+15 day' , strtotime ($fecha ) ) ;
$nuevafecha = date ( 'Y/m/d' , $nuevafecha ); 
// Verifico permisos del sistema
if ($_SESSION["rool"] =="Admin" || $_SESSION["rool"] =="Superadmin") 
{
	// Realizo la conexion con la base de datos
	include ('../../config.php');
	$cx = mysql_connect($server,$dbuser,$dbpass);
	
	if (!$cx) {
		die('No pudo conectarse: ' . mysql_error());
	}
?>
   <script>
   
function sumarfechas(d, fecha)
{
 var fecha = document.getElementById('menu1_fecha_ini').value;
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
 document.getElementById('menu1_fecha_fin').value=fechaFinal;
 }
   
function consultar()
{
	var fecha_ini = document.getElementById('menu1_fecha_ini').value;
	var fecha_fin = document.getElementById('menu1_fecha_fin').value;
	var cliente = document.getElementById('cliente').value;
	var archivo = 'admin/pagos/reporte.php?fecha_ini='+fecha_ini+'&fecha_fin='+fecha_fin+'&cliente='+cliente;
	cargaArchivo(archivo,'reporte');
}

function consultar2()
{
	var fecha_ini = document.getElementById('menu1_fecha_ini').value;
	var fecha_fin = document.getElementById('menu1_fecha_fin').value;
	var cliente = document.getElementById('cliente').value;
	var archivo = 'admin/pagos/reporte2.php?fecha_ini='+fecha_ini+'&fecha_fin='+fecha_fin+'&cliente='+cliente;
	cargaArchivo(archivo,'reporte');
}
function sumarfechas2(d)
{
 var fecha = document.getElementById('menu1_fecha_ini').value;
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
 document.getElementById('menu1_fecha_ini').value=fechaFinal;
 sumarfechas('15');
 }
 function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
function Cosnulta_fecha(id){
	//donde se mostrará el formulario con los datos
	 var id = document.getElementById('cliente').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST","admin/pagos/ultim_pago.php",false);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			var res = ajax.responseText
			result = res.split(',');
			res0= result[0];
			if (res0 != '')
				{
			    //mostrar el formulario
				document.getElementById('menu1_fecha_ini').value=res0;
				sumarfechas2('1');
				sumarfechas('15')
				}else{
				alert("No hay pagos registrados generados por el cliente seleccionado");
				}
			// divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("doc="+id);
}
function sumarfechas3(d)
{
 var fecha = document.getElementById('menu3_fecha_ini').value;
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
 document.getElementById('menu3_fecha_ini').value=fechaFinal;
 }

function generar_pago()
{
	// valido que fecha de pago no se menor a fecha final
	var fecha_pago = document.getElementById('menu3_fecha_ini').value;
	var fecha_per = document.getElementById('menu1_fecha_fin').value;
	var error =0;
	if(fecha_pago < fecha_per)
	{
		alert("La fecha de Pago no puede ser menor a la del periodo liquidado");
		//retur;
		var error =1;
	}else{
	var valor = parseInt(document.getElementById('total2').innerHTML);
	if (valor <1)
	   {
		  alert("El valor liquidado total no puede ser cero");
		//retur;
		  var error =1; 
		   }
	}
	
	if(error ==0)
	{
		//tomar datos del formulario
	var archivo = 'admin/pagos/genera_pagos.php?fecha_pag='+fecha_pago;
	cargaArchivo(archivo,'reporte');
	}
}

</script> 
   <table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	<td colspan="4" align="left" class="menu3">SELECCIONE PERIODO PARA REALIZAR PAGOS </td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('admin/inicio.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
	</tr>
 </table>   

    <div id="tutulo" align="left" >
    <form action="" method="post" name="form2" id="form2">
    <table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	 <td align="left"><input name="menos" type="button" onClick="sumarfechas2(-1);" value="-" style='background:#E8EEFA;'/>
         <input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form2.menu1_fecha_ini,'yyyy/mm/dd',this)" value="Fecha Inicial"  /><input type="text" name="dir" id="menu1_fecha_ini" size="10" value="<?php echo $fecha; ?>" alt="1" onkeydown='displaycode(event,id);' onchange="sumarfechas(15,value);" readonly="readonly"  /> 
          <input name="mas" type="button" onClick="sumarfechas2(1);" value="+"  style='background:#E8EEFA;'/><input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form2.menu1_fecha_fin,'yyyy/mm/dd',this)" value="Fecha Final"  /><input type="text" name="dir" id="menu1_fecha_fin" size="10" value="<?php echo $nuevafecha; ?>" alt="1" onkeydown='displaycode(event,id);'  />
         <select name="cliente" id="cliente" onchange="Cosnulta_fecha(value)" >
						<?php
                        $sq2 = "SELECT * FROM z_clientes";
                        $rs2 = mysql_query($sq2);
                        $fi2 = mysql_num_rows($rs2);
                        for ($i=0; $i<$fi2; $i++)
						{
                            $rw2 = mysql_fetch_array($rs2);
							
		                            echo "<OPTION VALUE='$rw2[num_id]'> $rw2[num_id] -  $rw2[nombre]</OPTION>";
        				}
						?>
 			</select>
          <input name="ir" type="button" onClick="consultar();" value="Liquidar periodo" style='background:#E8EEFA;'/> </td>
	</tr>
 </table> 
 </form>
    </div>
    <div id="reporte">
    </div>
<?php
}else{  // Cuando el usuario no es admiistrador 
echo "<script>
		alert('El usuario no tiene permisos de Usuario. ');
		cargaArchivo('admin/form_log.php','contenido');	
	</script>";
}
?>
<label id="llega"></label>
<script>
$(function() {
    //codigo aquí
	Cosnulta_fecha();
	consultar2();
})
</script>
