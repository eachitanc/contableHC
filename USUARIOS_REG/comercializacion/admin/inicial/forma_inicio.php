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
function nuevoArt4()
{
	var forma = escape(document.getElementById('forma').value);
	var id = escape(document.getElementById('id').value);
	var tipo_art4 = escape(document.getElementById('tipo_art4').value);
	var archivo = 'admin/inicial/forma_agregar.php?forma='+forma+'&cod_art='+tipo_art4+'&id='+id;
	cargaArchivo(archivo,'columna3');
}

function CierrVentana4()
{
	document.getElementById('columna3').style.display="none";
	document.getElementById('columna2').style.display="block";
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
<div id="form33" align="left" ><?php include('forma_form.php');  ?>
</div>
<div id="repor3" align="left" ><?php include('forma_repor.php');  ?>
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
document.getElementById('nombre2').select();
</script>