<?php
session_start();
$fecha = $_GET['fecha'];
if($_GET['fecha'] == '') $fecha = date('Y/m/d');
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
function consultar()
{
	var fecha = document.getElementById('menu1_fecha_ini').value;
	var cliente = document.getElementById('cliente').value;
	var archivo = 'admin/despacho/formulario.php?fecha='+fecha+'&cliente='+cliente;
	cargaArchivo(archivo,'reporte');
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
 var archivo = 'admin/despacho/reporte.php?fecha='+fechaFinal;
	cargaArchivo(archivo,'reporte');
 }

</script>
    <div id="tutulo" align="left" >
  <table width="85%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	<td colspan="4" align="left" class="menu3">DATOS DESPACHO DIARIO</td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('admin/inicio.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
	</tr>
    <tr>
    	<td colspan="5" align="left" class="menu3">Seleccione fecha y cliente al cual hace la entrega de la leche</td>
	</tr>
 </table>   

  <form action="" method="post" name="form2" id="form2">
    <table width="85%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	 <td align="left"><input name="menos" type="button" onClick="sumarfechas(-1);" value="-" style='background:#E8EEFA;'/>
         <input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form2.menu1_fecha_ini,'yyyy/mm/dd',this)" value="Selecionar fecha"  /><input type="text" name="dir" id="menu1_fecha_ini" size="14" value="<?php echo $fecha; ?>" alt="1" onkeydown='displaycode(event,id);'  /> 
         <input name="mas" type="button" onClick="sumarfechas(1);" value="+"  style='background:#E8EEFA;'/>
         <select name="cliente" id="cliente">
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
 			</select> <input name="ir" type="button" onClick="consultar();" value="Enviar" style='background:#E8EEFA;'/> 
         </td>
	</tr>
 </table> 
 </form>
    </div>
    <div id="reporte">
    	<?php include('reporte.php'); ?>
    </div>
<?php
}else{  // Cuando el usuario no es admiistrador 
echo "<script>
		alert('El usuario no tiene permisos de Usuario. ');
		cargaArchivo('admin/form_log.php','contenido');	
	</script>";
}
?>

