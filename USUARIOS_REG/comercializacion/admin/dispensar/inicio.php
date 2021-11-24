<?php
session_start();
header('Content-Type: text/html; charset=latin1');
header("Cache-Control: no-store, no-cache, must-revalidate");
$fecha = $_GET['fecha'];
if($_GET['fecha'] == '') $fecha = date('Y/m/d');
$nuevafecha = strtotime ( '+15 day' , strtotime ($fecha ) ) ;
$nuevafecha = date ( 'Y/m/d' , $nuevafecha ); 
// Verifico permisos del sistema
if ($_SESSION["rool"] =="Admin" || $_SESSION["rool"] =="Regente") 
{
	// Realizo la conexion con la base de datos
	include ('../../config.php');
	$cx = mysql_connect($server,$dbuser,$dbpass);
	
	if (!$cx) {
		die('No pudo conectarse: ' . mysql_error());
	// limpio la tabla pedidos
	
	}
?>
<script>
// JavaScript Document

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


function buscarBarras(){
	
	//donde se mostrará el formulario con los datos
	var valor = document.getElementById('barras').value;
	var tipo_art = document.getElementById('tipo_art').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST","admin/dispensar/consultas/codigo.php",false);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			var res = ajax.responseText
			result = res.split(',');
			res0= result[0];
			document.getElementById('codigo').value=res;
			//mostrar el formulario
			// divFormulario.style.display="block";
			buscarProducto(res)
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("doc="+valor+"&tipo="+tipo_art);
}
function buscarProducto(valor){
	//donde se mostrará el formulario con los datos
	var tipo_art = document.getElementById('tipo_art').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST","admin/dispensar/consultas/saldo.php",false);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			var res = ajax.responseText
			result = res.split(',');
			res0= result[0];
			document.getElementById('saldo').value=result[0];
			document.getElementById('producto').value=result[1];
			document.getElementById('lote').value=result[2];
			document.getElementById('venta').value=result[3];
			document.getElementById('Invima').value=result[4];
			document.getElementById('menu1_fecha_ven').value=result[5];
			document.getElementById('barras').value=result[6];
			//mostrar el formulario
			// divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("doc="+valor+"&tipo="+tipo_art);
}
function buscaFactura(){
	
	//donde se mostrará el formulario con los datos
	var valor = document.getElementById('acta').value;
	var tipo_art = document.getElementById('tipo_art').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST","admin/dispensar/consultas/factura.php",false);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			var res = ajax.responseText
			result = res.split(',');
			res0= result[0];
			document.getElementById('acta').value=res;
			//mostrar el formulario
			// divFormulario.style.display="block";
			document.getElementById('codigo').value='';
			document.getElementById('barras').value='';
			document.getElementById('lote').value='';
			document.getElementById('cant').value='';
			document.getElementById('venta').value='';
			document.getElementById('Invima').value='';
			document.getElementById('producto').value='';
			document.getElementById('saldo').value='';
			document.getElementById('menu1_fecha_ven').value='';
			llamaMenu2();
			document.getElementById('barras').focus();
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("doc="+valor+"&tipo="+tipo_art);
}


function llamaMenu(id)
{
	var archivo = 'admin/inicial/menu.php?id='+id;
	cargaArchivo(archivo,'articulo_llega');
}
function llamaMenu2()
{
	var id = escape(document.getElementById('acta').value);
	var archivo = 'admin/dispensar/reporte.php?factura='+id;
	cargaArchivo(archivo,'reporte');
	}
function nuevoArt()
{
	var error =0;
	var id = escape(document.getElementById('id').value);
	var bodega = escape(document.getElementById('bodega').value);
	var tipo_art = escape(document.getElementById('tipo_art').value);
	var fecha = escape(document.getElementById('menu1_fecha_ini').value);
	var concepto = escape(document.getElementById('concepto').value);
	var acta = escape(document.getElementById('acta').value);
	var codigo = escape(document.getElementById('codigo').value);
	var barras = escape(document.getElementById('barras').value);
	var lote = escape(document.getElementById('lote').value);
	var fecha_ven = escape(document.getElementById('menu1_fecha_ven').value);
	var cant = escape(document.getElementById('cant').value);
	var valtercero = escape(document.getElementById('valtercero').value);
	var venta = escape(document.getElementById('venta').value);
	var Invima = escape(document.getElementById('Invima').value);
	// campos para validar
	var camposval = ["bodega", "tipo_art", "acta","codigo","cant","valtercero","venta"]; // 6
	var cuantos =7;// depende del numero de campos a validar
	var i =0;
	for (i=0;i<cuantos;i++)
	{	
		var campo = camposval[i];
		var contenido = document.getElementById(campo).value;
		var marca = campo+"_e";
		if (contenido =='')
		{
			document.getElementById(marca).innerHTML='*';
			error = 1;
		}else{
			document.getElementById(marca).innerHTML='';	
		}
	}
	if (error ==0)
	{
	var archivo = 'admin/dispensar/agregarpro.php?bodega='+bodega+'&tipo_art='+tipo_art+'&fecha='+fecha+'&concepto='+concepto+'&acta='+acta+'&codigo='+codigo+'&barras='+barras+'&lote='+lote+'&fecha_ven='+fecha_ven+'&cant='+cant+'&valtercero='+valtercero+'&venta='+venta+'&Invima='+Invima+'&id='+id;
	cargaArchivo(archivo,'reporte');
	document.getElementById('codigo').value='';
	document.getElementById('barras').value='';
	document.getElementById('lote').value='';
	document.getElementById('cant').value='';
	document.getElementById('venta').value='';
	document.getElementById('Invima').value='';
	document.getElementById('producto').value='';
	document.getElementById('saldo').value='';
	document.getElementById('menu1_fecha_ven').value='';
	}
}

function Ventana()
{
	document.getElementById('columna1').style.display="none";
	document.getElementById('columna2').style.display="block";
	var tipo_art = escape(document.getElementById('tipo_art').value);
	archivo ='admin/inicial/formulario.php?tipo_art='+tipo_art;
	cargaArchivo(archivo,'columna2');
}
function formato(id,val)
{
document.getElementById(id).value=formatea(val);
}
function parametros()
{
	var bodega = escape(document.getElementById('bodega').value);
	var articulo = escape(document.getElementById('tipo_art').value);
	document.getElementById('producto').value='';
	document.getElementById('codigo').value='';
	var archivo = 'admin/inicial/guarda.php?bodega='+bodega+'&articulo='+articulo;
	cargaArchivo(archivo,'columna3');
}
$().ready(function() {
		var k =0;	
		 $(":input").each(function (i) {
			   var value = this.alt;
			  if (value ==1)
			  {
			 	 $(this).attr('tabindex', k + 1);
			 	 k++;
			  }
		 });
})

$().ready(function() {
	$("input").keyup(function (e) {
	var letra = e.which;
	var campo =this.id;
	if (letra == 13 )
	{	
     var tabx = this.tabIndex;
	 var nextab =tabx+1;
	 if (campo == 'producto')
	 {
		 $('input[tabindex='+nextab+']').select();
	 }else{
		 $('input[tabindex='+nextab+']').focus();
	 }
	
	}
	if (letra == 38 && campo != 'producto')
	{	
     var tabx = this.tabIndex;
	 var nextab =tabx-1;
	$('input[tabindex='+nextab+']').select();
	}
 }).keypress();
})

function nuevaFactura(valor)
{
	var valor = document.getElementById('acta').value;
	if (valor =='')
	{
		document.getElementById('acta').value=20170001;
	}else{
		document.getElementById('acta').parseInt(value=document.getElementById('acta').value + 1);
	}
	
}
</script>
<div id="tutulo" align="left" >
<form action="" method="post" name="form2" id="form2">  
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	<td colspan="4" align="left" class="menu3"> DISPENSACION DE MEDICAMENTO E INSUMOS MEDICOS</td>
        <td  align="right" id="cerrar"> &nbsp;<i class="fa fa-times fa-1x" style="color:#CCC;cursor:pointer" aria-hidden="true" title="Cerrar" onClick="cargaArchivo('admin/inicio.php','contenido');" ></i></td>
	</tr>
 </table>

 <table width="90%" border="0" class="punteado" cellpadding='0' cellspacing='0' align="center">   
    <tr bgcolor="#F5F5F5">
    	<td align='left'>&nbsp;</td>
    </tr>
 </table> 
   <table width="90%" border="0" class="punteado" cellpadding='0' cellspacing='0' align="center">  
     <tr>  
         <td width="15%">Bodega:</td>
         <td width="85%"><select name="bodega" id="bodega" onchange="llamaMenu(value);">
						<option value=""></option>
						<?php
                        $sq2 = "SELECT * FROM farm_bodega where usuario = '$_SESSION[id]'";
                        $rs2 = mysql_query($sq2);
                        $fi2 = mysql_num_rows($rs2);
                        for ($i=0; $i<$fi2; $i++)
						{
                            $rw2 = mysql_fetch_array($rs2);
							
		                            echo "<OPTION VALUE='$rw2[id]'>$rw2[nombre]</OPTION>";
        				}
						?>
 			</select><label id="bodega_e" style="color:#F00"></label></td>
     </tr>
     <tr>  
         <td>Tipo Articulo:</td>
         <td id="articulo_llega"><input name="tipo_art" id="tipo_art" size="20" readonly="readonly" /><label id="tipo_art_e" style="color:#F00"></label></td>
     </tr>
   	 <tr>  
         <td>Fecha:</td>
         <td><input name="menos" type="button" onClick="sumarfechas(-1,'menu1_fecha_ini');" value="-" style='background:#E8EEFA;'/>
        <input type="text" name="dir" id="menu1_fecha_ini" size="12" value="<?php echo $fecha; ?>"  /> 
         <input name="mas" type="button" onClick="sumarfechas(1,'menu1_fecha_ini');" value="+"  style='background:#E8EEFA;'/> <input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form2.menu1_fecha_ini,'yyyy/mm/dd',this)" value="Selecionar fecha"  /></td>
     </tr>
     <tr>
         <td>Cliente:</td>
         <td><input type='text' name='tercero' id='tercero' size='60' value='<?php echo $rw['empresa']; ?>' /> 
                <input type='hidden' name='valtercero' id='valtercero' value='<?php echo $rw['empresa_id']; ?>' />
                 <label id="valtercero_e" style="color:#F00"></label>
                </td>
     </tr>
     <tr>
         <td>Concepto:</td>
         <td><input type='text' name='concepto' id='concepto' size='60' value='VENTA DE MEDICAMENTO O INSUMOS MEDICOS' /> 
               </td>
     </tr>
     <tr>  
         <td>No factura:</td>
         <td><input name="acta" id="acta" size="10" onchange="llamaMenu2()" alt="1" />
         <label id="acta_e" style="color:#F00"></label>
         &nbsp;<i class="fa fa-plus-square" style="font-size:20px;color:#06F;cursor:pointer" aria-hidden="true" title="Nueva factura" onclick="buscaFactura();"></i>
         &nbsp;<i class="fa fa-bars" style="font-size:15px;color:#CCC;cursor:pointer" aria-hidden="true" title="Listar documento" onclick="llamaMenu2();"></i></td>
     </tr>
     <tr>
     	<td colspan="2" height="5"></td>
     </tr>
     <tr bgcolor="#F5F5F5">
    	<td align='left' colspan="2">&nbsp;</td>
    </tr>
 </table> 
 <div id="producto2"><?php include('producto.php'); ?></div>
 
 <table width="90%" border="0" class="punteado" cellpadding='1' cellspacing='0' align="center">  
     
     <tr height="20" valign="top">  
         <td colspan="3"><input name="nuevo" id="nuevo" type="button" class="myButton" value="Guardar" style="background-color:#E8EEFA" onClick="nuevoArt();" alt="1"  /></td>
     </tr>
 </table>
 
</form> 
  </div>
    
<?php
}else{  // Cuando el usuario no es admiistrador 
echo "<script>
		alert('El usuario no tiene permisos de Usuario. ');
		cargaArchivo('admin/form_log.php','contenido');	
	</script>";
}
?>
 <div id="reporte">
         	
    </div>
<script>
$().ready(function() {
	$("#tercero").autocomplete("admin/dispensar/consultas/terceros.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		multiple:true,
		//highlight: false,
		//multipleSeparator: " ",
		selectFirst: false
	});
	$("#tercero").result(function(event, data, formatted) {
		$("#valtercero").val(data[1]);
	});
});
</script>