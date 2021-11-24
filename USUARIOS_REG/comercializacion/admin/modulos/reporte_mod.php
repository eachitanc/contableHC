<?php
session_start();
$campo ='modulos';
$anno = $_GET["anno"];
$titulo ='MODULOS DEL SISTEMA VIGENCIA '. $anno;
$ancho ='60%';
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
    	<td colspan="4" align="left" class="menu3"><?php echo $titulo; ?> 	<i class='fa fa-plus-square' onclick="cargaArchivo('admin/modulos/formulario.php?anno=<?php echo $anno; ?>','columna1');" id="men"  onmouseover='cambiaColor(id);' onmouseout='fueraPuntero(id);' ></i> 	 </td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('admin/modulos/reporte.php','columna1');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
	</tr>
 </table>   
  <table width="<?php echo $ancho; ?>" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='35%' align='left'>Modulo</td>
        <td width='35%' align="center">Fecha Vencimiento</td>
		<td width='20%' align="center">Registros</td>
        <td width='20%' align="center">Estado</td>
        <td width='10%' align="center" ondblclick="">Acciones</td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from $campo where vf ='$anno' order by nombre asc";
$res = mysql_query($sql,$cx);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
while($row = mysql_fetch_array($res))
	{
	$link ="onclick=cargaArchivo(&#34admin/$campo/formulario.php?id=$row[id]&anno=$anno&#34,&#34columna1&#34)";	
	if ($row[estado] == 1) $estado ='Activo';
	if ($row[estado] == 2) $estado ='Cerrado';
	if ($row[estado] == 3) $estado ='Suspendido';
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td $link align='left'>$row[nombre]</td>
        <td $link align='center'>$row[fecha_ven]</td>
		 <td $link align='center'>$row[registros_ven]</td>
		<td $link align='center'>$estado</td>

		<td valign='middle' align='center'>
			<div id='acciones$row[id]' style='display:none' class='actions'>
				<a href='#' onclick=borrarRegistro('admin/$campo/eliminar.php?doc=$row[id]&anno=$anno','columna1') title='Eliminar modulo'><i class='fa fa-trash-o'></i></a>
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
