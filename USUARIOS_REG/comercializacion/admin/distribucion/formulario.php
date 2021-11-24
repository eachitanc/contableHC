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
	var unidad = escape(document.getElementById('unidad2').value);
	var laboratorio = escape(document.getElementById('cod_lab').value);
	var cum = escape(document.getElementById('cum').value);
	var consecutivo = escape(document.getElementById('cons').value);
	var archivo = 'admin/inicial/agregarproducto.php?tipo_art2='+tipo_art2+'&fecha_alta='+fecha_alta+'&nombre2='+nombre2+'&unidad='+unidad+'&laboratorio='+laboratorio+'&cum='+cum+'&consecutivo='+consecutivo;
	cargaArchivo(archivo,'columna2');
}

function CierrVentana()
{
	document.getElementById('columna2').style.display="none";
	document.getElementById('columna1').style.display="block";
}
function llamaMenu5(id)
{
	var archivo = 'admin/inicial/menu2.php?id='+id;
	cargaArchivo(archivo,'articulo_llega2');
}
function Laboratorio()
{
	document.getElementById('columna2').style.display="none";
	document.getElementById('columna3').style.display="block";
	var tipo_art = escape(document.getElementById('tipo_art2').value);
	archivo ='admin/inicial/lab_form.php?tipo_art='+tipo_art;
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
<div id="tutulo" align="left" >
<form action="" method="post" name="form3" id="form3">  
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	<td colspan="4" align="left" class="menu3">CREAR NUEVO PRODUCTO</td>
        <td  align="right" id="cerrar" onClick="CierrVentana()" onMouseOver="punteroOn();" onMouseOut="punteroOff();" > X</td>
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
         <td width="85%">
         				<select name="bodega2" id="bodega2" onchange="llamaMenu5(value);" >
                        <option value=""></option>
						<?php
                        $sq4 = "SELECT * FROM farm_bodega where usuario ='$_SESSION[id]'";
                        $rs4 = mysql_query($sq4);
                        $fi4 = mysql_num_rows($rs4);
                        for ($i=0; $i<$fi4; $i++) {
                            $rw4 = mysql_fetch_array($rs4);
								if ($rw4['id'] == $rw3['bodega'])
		                            echo "<OPTION VALUE='$rw4[id]' selected>$rw4[nombre]</OPTION>";
        						else 
									echo "<OPTION VALUE='$rw4[id]'>$rw4[nombre]</OPTION>";
		                }
						?>
                       </select>
						</td>
     </tr>
     <tr>  
         <td>Tipo Articulo:</td>
         <td id="articulo_llega2"> <select name="tipo_art2" id="tipo_art2" onchange="parametros();" >
                        <option value="" ></option>
						<?php
                       	$sq23 = "SELECT * FROM farm_articulos where bodega = '$rw3[bodega]'";
                        $rs23 = mysql_query($sq23);
                        $fi23 = mysql_num_rows($rs23);
                        for ($i=0; $i<$fi23; $i++)
						{
                            $rw23 = mysql_fetch_array($rs23);
							if ($rw23['cod_art'] == $tipo_art)
		                            echo "<OPTION VALUE='$rw23[cod_art]' selected>$rw23[nombre]</OPTION>";
							else
								    echo "<OPTION VALUE='$rw23[cod_art]' >$rw23[nombre]</OPTION>";		
        				}
						?>
                        </select>
                        </td>
     </tr>
   	 <tr>  
         <td>Fecha:</td>
         <td><input name="menos" type="button" onClick="sumarfechas(-1,'menu1_fecha_pdo');" value="-" style='background:#E8EEFA;'/>
        <input type="text" name="dir" id="menu1_fecha_pdo" size="12" value="<?php echo $fecha; ?>" alt="1" onkeydown='displaycode(event,id);'  /> 
         <input name="mas" type="button" onClick="sumarfechas(1,'menu1_fecha_pdo');" value="+"  style='background:#E8EEFA;'/> <input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form3.menu1_fecha_pdo,'yyyy/mm/dd',this)" value="Selecionar fecha"  /></td>
     </tr>
     <tr>
         <td>Producto:</td>
         <td><input type='text' name='nombre2' id='nombre2' size='80' value='' /></td>
     </tr>
      <tr>
         <td>Unidad de venta:</td>
         <td><input type='text' name='unidad2' id='unidad2' size='20' value='' /></td>
     </tr>
     <tr>
         <td>Laboratorio:</td>
         <td><input type='text' name='lab' id='lab' size='40' value='' /><input type='hidden' name='cod_lab' id='cod_lab' size='20' value='' />&nbsp;<i class="fa fa-plus-square" style="font-size:20px;color:#06F;cursor:pointer" aria-hidden="true" title="Nuevo Laboratorio" onclick="Laboratorio();"></i></td>
     </tr>
     <tr>
         <td>No CUM:</td>
         <td><input type='text' name='cum' id='cum' size='15' value='' /></td>
     </tr>
      <tr>
         <td>Consecutivo:</td>
         <td><input type='text' name='cons' id='cons' size='3' value='' /></td>
     </tr>
     
     <tr height="50" valign="top">  
         <td></td>
       
         <td colspan="2"> <input name="nuevo" id="nuevo2" type="button" class="myButton" value="Guardar" style="background-color:#E8EEFA" onClick="nuevoArt2();"   /></td>
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
</script>