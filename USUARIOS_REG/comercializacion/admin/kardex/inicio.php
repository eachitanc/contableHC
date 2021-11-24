<?php
session_start();
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

function llamaMenu(id)
{
	var archivo = 'admin/inicial/menu.php?id='+id;
	cargaArchivo(archivo,'articulo_llega');
}
function llamaMenu2()
{
	var id = escape(document.getElementById('acta').value);
	var archivo = 'admin/recepcion/reporte.php?factura='+id;
	cargaArchivo(archivo,'reporte');
}
// ****************     codigo de la pagina  ********************

function Consultar()
{
	var bodega = escape(document.getElementById('bodega').value);
	var articulo = escape(document.getElementById('tipo_art').value);
	var fecha1 = escape(document.getElementById('menu1_fecha_ini').value);
	var fecha2 = escape(document.getElementById('menu1_fecha_fin').value);
	var producto = escape(document.getElementById('valproducto').value);
	var archivo = 'admin/kardex/reporte.php?bodega='+bodega+'&articulo='+articulo+'&fecha1='+fecha1+'&producto='+producto+'&fecha2='+fecha2;
	cargaArchivo(archivo,'reporte');
}

function Consultar2()
{
	var bodega = escape(document.getElementById('bodega').value);
	var articulo = escape(document.getElementById('tipo_art').value);
	var fecha1 = escape(document.getElementById('menu1_fecha_ini').value);
	var fecha2 = escape(document.getElementById('menu1_fecha_fin').value);
	var producto = escape(document.getElementById('valproducto').value);
	var archivo = 'admin/kardex/reporte_consolidado.php?bodega='+bodega+'&articulo='+articulo+'&fecha1='+fecha1+'&producto='+producto+'&fecha2='+fecha2;
	cargaArchivo(archivo,'reporte');
}


</script>
<div id="tutulo" align="left" >
<form action="" method="post" name="form2" id="form2">  
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	<td colspan="4" align="left" class="menu3">REPORTE DE INVENTARIO </td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('admin/inicio.php','contenido');" onMouseOver="punteroOn();" onMouseOut="punteroOff();" >X</td>
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
         <td>Fecha Inicial:</td>
         <td><input name="menos" type="button" onClick="sumarfechas(-1,'menu1_fecha_ini');" value="-" style='background:#E8EEFA;'/>
        <input type="text" name="dir" id="menu1_fecha_ini" size="12" value="<?php echo '2017/01/01'; ?>" alt="1" onkeydown='displaycode(event,id);'  /> 
         <input name="mas" type="button" onClick="sumarfechas(1,'menu1_fecha_ini');" value="+"  style='background:#E8EEFA;'/> <input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form2.menu1_fecha_ini,'yyyy/mm/dd',this)" value="Selecionar fecha"  /></td>
     </tr>
      <tr>  
         <td>Fecha Final:</td>
         <td><input name="menos" type="button" onClick="sumarfechas(-1,'menu1_fecha_fin');" value="-" style='background:#E8EEFA;'/>
        <input type="text" name="dir" id="menu1_fecha_fin" size="12" value="<?php echo $fecha; ?>" alt="1" onkeydown='displaycode(event,id);'  /> 
         <input name="mas" type="button" onClick="sumarfechas(1,'menu1_fecha_fin');" value="+"  style='background:#E8EEFA;'/> <input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form2.menu1_fecha_fin,'yyyy/mm/dd',this)" value="Selecionar fecha"  /></td>
     </tr>
     <tr>
         <td>Producto:</td>
         <td><input type='text' name='producto' id='producto' size='80' value='<?php echo $rw['empresa']; ?>' /> 
                <input type='hidden' name='valproducto' id='valproducto' value='<?php echo $rw['empresa_id']; ?>' /></td>
     </tr>
     <tr>
         <td></td>
         <td><input name="nuevo" id="nuevo" type="button" class="myButton" value="Por producto" style="background-color:#E8EEFA" onClick="Consultar();"   />
         <input name="nuevo" id="nuevo" type="button" class="myButton" value="Consolidado" style="background-color:#E8EEFA" onClick="Consultar2();"   />
         </td>
     </tr>

     <tr>
     	<td colspan="2" height="15"></td>
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
		$("#producto").autocomplete("admin/kardex/consultas/producto.php", {
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