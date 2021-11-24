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
	var presen = escape(document.getElementById('presen').value);
	var cum = escape(document.getElementById('cum').value);
	var pos = escape(document.getElementById('pos').value);
	var num = nombre.length;
	if(num >3)
	{
	var archivo = 'admin/listado/reporte.php?nombre='+nombre+'&presen='+presen+'&cum='+cum+'&pos='+pos;
	cargaArchivo(archivo,'reporte');
	}
}

function registrar(valor)
{
	//alert(valor);
	}
	
  
function seleccionar(value)
{
	var archivo = 'admin/listado/agregar.php?id='+value;
	cargaArchivo(archivo,'mjs');
}
</script>
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	<td colspan="4" align="left" class="menu3">BUSQUEDA DE MEDICAMENTOS PARA SELECCION DE LISTADO BASICO</td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('admin/inicio.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
	</tr>
 </table>
  </table>   
  <table width="90%" border="0" class="punteado" cellpadding='0' cellspacing='0' align="center">   
    <tr bgcolor="#F5F5F5">
    	<td width='28%' align='center'>Nombre</td>
        <td width='47%' align='center'>Presentacion</td>
        <td width='10%' align='center'>CUM</td>
        <td width='5%' align='center'>POS</td>
        <td width='5%' align='right'>Listado</td>
        <td width='5%' align="center" ondblclick=""></td>
    </tr>
 
    <form action="" method="post" name="form2" id="form2">
	<tr>
    	 <td align="center"><input name="buscar" id="buscar" size="38" onkeyup="consultar(value)" /></td>
         <td align="center"><input name="presen" id="presen" size="38" onkeyup="consultar(value)" /></td>
         <td align="center"><input name="cum" id="cum" size="8" onkeyup="consultar(value)" /></td>
         <td align="center"><input name="pos" id="pos" size="8" onkeyup="consultar(value)" /></td>
         <td align="left"></td>
         <td align="left"></td>
     </tr>
 </table> 
 </form>
    <div id="reporte">
    	<?php //include('reporte2.php'); ?>
    </div>
<?php
}else{  // Cuando el usuario no es admiistrador 
echo "<script>
		alert('El usuario no tiene permisos de Usuario. ');
		cargaArchivo('admin/form_log.php','contenido');	
	</script>";
}
?>

