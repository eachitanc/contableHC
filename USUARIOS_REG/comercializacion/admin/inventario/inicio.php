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
	}
?>
<script>
function consultar()
{
	var nombre = escape(document.getElementById('buscar').value);
	var bodega = escape(document.getElementById('bodega').value);
	var articulo = escape(document.getElementById('articulo').value);
	var num = nombre.length;
	if(num >3)
	{
	var archivo = 'admin/inventario/reporte.php?nombre='+nombre;
	cargaArchivo(archivo,'reporte2');
	}
}

function consultar3()
{
	var bodega = escape(document.getElementById('bodega').value);
	var articulo = escape(document.getElementById('articulo').value);
	var archivo = 'admin/inventario/reporte.php?bodega='+bodega+'&articulo='+articulo;
	cargaArchivo(archivo,'reporte2');

	
}

function consultar2()
{
	var archivo = 'admin/inventario/reporte.php';
	cargaArchivo(archivo,'reporte2');
}
 
function seleccionar(value)
{
	var archivo = 'admin/listado/agregar.php?id='+value;
	cargaArchivo(archivo,'mjs');
}

function sumarfechas(d)
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
}

function llamaMenu(id)
{

	var archivo = 'admin/inventario/menu.php?id='+id;
	cargaArchivo(archivo,'articulo_llega');
	consultar3();
	}
function nuevoArt()
{
	var fecha = escape(document.getElementById('menu1_fecha_ini').value);
	var bodega = escape(document.getElementById('bodega').value);
	var tip_art = escape(document.getElementById('articulo').value);
	var archivo = 'admin/inventario/formulario.php?fecha='+fecha+'&bodega='+bodega+'&tip_art='+tip_art;
	cargaArchivo(archivo,'reporte2');	
}
</script>
<div id="tutulo" align="left" >
<form action="" method="post" name="form2" id="form2">  
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	<td colspan="4" align="left" class="menu3">CARGA DE INVANTARIO INICIAL </td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('admin/inicio.php','contenido');" onMouseOver="punteroOn();" onMouseOut="punteroOff();" >X</td>
	</tr>
 </table>

 <table width="90%" border="0" class="punteado" cellpadding='0' cellspacing='0' align="center">   
    <tr bgcolor="#F5F5F5">
    	<td width='10%' align='left'>Bodega</td>
        <td width='20%' align='left'>Fecha</td>
        <td width='50%' align='left'>Nombre</td>
        <td width='10%' align='left'>Tipo Articulo</td>
        <td width='10%' align="center"></td>
    </tr>
    <tr>
	   	 <td align="left"><select name="bodega" id="bodega" onchange="llamaMenu(value);">
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
 			</select></td>
         <td align="left" id="articulo_llega"><input name="tipo_art" id="tipo_art" size="20" onKeyUp="consultar(value)" /></td>
         <td align="left"><input name="menos" type="button" onClick="sumarfechas(-1);" value="-" style='background:#E8EEFA;'/>
         <input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form2.menu1_fecha_ini,'yyyy/mm/dd',this)" value="Selecionar fecha"  /><input type="text" name="dir" id="menu1_fecha_ini" size="12" value="<?php echo $fecha; ?>" alt="1" onkeydown='displaycode(event,id);'  /> 
         <input name="mas" type="button" onClick="sumarfechas(1);" value="+"  style='background:#E8EEFA;'/> </td>
          <td align="left" ><input name="buscar" id="buscar" size="30" onKeyUp="consultar(value)" /></td>
         <td align="left"><input name="nuevo" id="nuevo" type="button" value="Nuevo" style="background-color:#E8EEFA" onClick="nuevoArt();"   /></td>
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
 <div id="reporte2">
         	
    </div>
 <script>
$(function() {
	consultar2();
})
</script>

