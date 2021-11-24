<?php
session_start();
$tipo_art = $_GET['tipo_art'];
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
function nuevoArt2()
{
	var tipo_art2 = escape(document.getElementById('tipo_art2').value);
	var fecha_alta = escape(document.getElementById('menu1_fecha_pdo').value);
	var nombre2 = escape(document.getElementById('nombre2').value);
	var pres = escape(document.getElementById('cod_pres').value);
	var lab = escape(document.getElementById('cod_lab').value);
	var cum = escape(document.getElementById('cum').value);
	var consecutivo = escape(document.getElementById('cons').value);
	// campos para validar
	var camposval = ["bodega2", "tipo_art2", "menu1_fecha_pdo","nombre2","pres","lab"]; 
	var cuantos =6;// depende del numero de campos a validar
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
	var archivo = 'admin/nuevo/agregarproducto.php?tipo_art2='+tipo_art2+'&fecha_alta='+fecha_alta+'&nombre2='+nombre2+'&pres='+pres+'&lab='+lab+'&cum='+cum+'&consecutivo='+consecutivo;
	cargaArchivo(archivo,'columna2');
	}
}

function CierrVentana()
{
	document.getElementById('columna2').style.display="none";
	document.getElementById('columna1').style.display="block";
}
function llamaMenu5(id)
{
	var archivo = 'admin/nuevo/menu3.php?id='+id;
	cargaArchivo(archivo,'articulo_llega2');
}
function Laboratorio()
{
	document.getElementById('columna2').style.display="none";
	document.getElementById('columna3').style.display="block";
	var tipo_art = escape(document.getElementById('tipo_art2').value);
	archivo ='admin/inicial/lab_inicio.php?tipo_art='+tipo_art;
	cargaArchivo(archivo,'columna3');	
}
function Presentacion()
{
	document.getElementById('columna2').style.display="none";
	document.getElementById('columna3').style.display="block";
	var tipo_art = escape(document.getElementById('tipo_art2').value);
	archivo ='admin/inicial/forma_inicio.php?tipo_art='+tipo_art;
	cargaArchivo(archivo,'columna3');	
}
function parametros()
{
	
	var bodega = escape(document.getElementById('bodega2').value);
	var articulo = escape(document.getElementById('tipo_art2').value);
	var archivo = 'admin/inicial/guarda.php?bodega='+bodega+'&articulo='+articulo;
	cargaArchivo(archivo,'columna3');
}
</script>
<?php 
$sq3="select * from farm_articulos where  cod_art  ='$tipo_art'";
	$re3=mysql_query($sq3,$cx);
	$rw3=mysql_fetch_array($re3);
	$articulo = $rw3['nombre'];
	$sq2="select * from farm_bodega where  id  ='$rw3[bodega]'";
	$re2=mysql_query($sq2,$cx);
	$rw2=mysql_fetch_array($re2);
	$bodega = $rw2['id'];
?>
<div id="tutulo" align="left" ><?php include('formulario2.php');  ?>
</div>
<div id="buscar" align="left" ><?php include('formulario3.php');  ?>
</div>

<div id="reportes" align="left" >
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
		$("#lab").autocomplete("admin/inicial/consultas/laboratorio.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		multiple:true,
		//highlight: false,
		//multipleSeparator: " ",
		selectFirst: false
	});
	$("#lab").result(function(event, data, formatted) {
		$("#cod_lab").val(data[1]);
	});
});
$().ready(function() {
		$("#pres").autocomplete("admin/inicial/consultas/presentacion.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		multiple:true,
		//highlight: false,
		//multipleSeparator: " ",
		selectFirst: false
	});
	$("#pres").result(function(event, data, formatted) {
		$("#cod_pres").val(data[1]);
	});
});
document.getElementById('nombre2').select();
</script>