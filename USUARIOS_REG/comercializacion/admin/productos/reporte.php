<?php
session_start();
$campo ='productos';
$titulo ='ADMINISTRACION DE PRODUCTOS';
$ancho ='85%';
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
<center>
<br />
<table width="<?php echo $ancho; ?>" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr>
    	<td colspan="4" align="left" class="menu3"><?php echo $titulo; ?> 	 </td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('admin/inicio.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
	</tr>
 </table>   
  <table width="<?php echo $ancho; ?>" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='40%' align='left'>Nombre</td>
        <td width='10%'>Licencia</td>
		<td width='10%' align="center" ondblclick="">Version</td>
        <td width='15%' align="center" ondblclick="">Fecha Licencia</td>
        <td width='15%' align="center" ondblclick="">Fecha Soporte</td>
        <td width='10%' align="center" ondblclick="">Acciones</td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from $campo order by nombre asc";
$res = mysql_query($sql,$cx);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
while($row = mysql_fetch_array($res))
	{
	$link ="onclick=cargaArchivo(&#34admin/$campo/formulario.php?id=$row[id]&#34,&#34columna1&#34)";	
	if ($row[estado] == 0) $estado ='Pendiente';
	if ($row[estado] == 1) $estado ='Iniciada';
	if ($row[estado] == 2) $estado ='Finalizada';
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td $link align='left'>$row[nombre]</td>
        <td $link align='left'>$row[licencia]</td>
		<td $link align='center'> $row[version]</td>
		<td $link align='center'>$row[fecha_licen]</td>
		<td $link align='center'>$row[fecha_soporte]</td>
		
		<td valign='middle' align='center'>
			<div id='acciones$row[id]' style='display:none' class='actions'>
				<a href='#' onclick=cargaArchivo('admin/tareas/reporte.php?doc=$row[id]','columna1') title='Imprimir terminos licencia'><i class='fa fa-file-word-o'></i></a> &nbsp;
			</div>
		</td>
	</tr>");
	} 

echo "</table>";
}else{  // Cuando el usuario no es admiistrador 
echo "<script>
		alert('El usuario no tiene permisos de Usuario. ');
		cargaArchivo('admin/form_log.php','contenido');	
	</script>";
}
?>
<br />
<div id="mjs"></div>
