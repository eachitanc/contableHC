<?php
session_start();
$tipo_art = $_GET['tipo_art'];
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
function nuevoArt3()
{
	var laboratorio = escape(document.getElementById('laboratorio').value);
	var tipo_art3 = escape(document.getElementById('tipo_art3').value);
	var archivo = 'admin/inicial/lab_agregar.php?laboratorio='+laboratorio+'&cod_art='+tipo_art3;
	cargaArchivo(archivo,'columna3');
}

function CierrVentana3()
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
<div id="tutulo" align="left" >
<form action="" method="post" name="form3" id="form3">  
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	<td colspan="4" align="left" class="menu3">CREAR NUEVO LABORATORIO</td>
        <td  align="right" id="cerrar" onClick="CierrVentana3()" onMouseOver="punteroOn();" onMouseOut="punteroOff();" > X</td>
	</tr>
 </table>

 <table width="90%" border="0" class="punteado" cellpadding='0' cellspacing='0' align="center">   
    <tr bgcolor="#F5F5F5">
    	<td align='left'>&nbsp;</td>
    </tr>
 </table> 
   <table width="90%" border="0" class="punteado" cellpadding='0' cellspacing='0' align="center">  
     <tr>
         <td>Laboratorio:</td>
         <td><input type='text' name='laboratorio' id='laboratorio' size='80' value='' /></td>
     </tr>
      <tr>
         <td></td>
         <td><input type='hidden' name='tipo_art3' id='tipo_art3'  value='<?php echo $tipo_art ; ?>' /></td>
     </tr>
     <tr height="50" valign="top">  
         <td></td>
         <td colspan="2"> <input name="nuevo" id="nuevo2" type="button" class="myButton" value="Guardar" style="background-color:#E8EEFA" onClick="nuevoArt3();"   /></td>
         <td></td>
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
	$("#tercero").autocomplete("admin/recepcion2/consultas/terceros.php", {
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

$().ready(function() {
		$("#producto").autocomplete("admin/recepcion2/consultas/producto.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		multiple:true,
		//highlight: false,
		//multipleSeparator: " ",
		selectFirst: false
	});
	$("#producto").result(function(event, data, formatted) {
		$("#codigo").val(data[1]);
	});
});
</script>