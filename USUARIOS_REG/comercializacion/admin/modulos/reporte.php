<?php
session_start();
$campo ='vf';
$titulo ='ADMINISTRACION DE MODULOS DEL SISTEMA POR VIGENCIA';
$ancho ='50%';
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
    	<td colspan="4" align="left" class="menu3"><?php echo $titulo; ?> 		 </td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('admin/inicio.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
	</tr>
 </table>   
  <table width="<?php echo $ancho; ?>" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='35%' align='left'>Vigencia</td>
        <td width='35%'>Estado</td>
		<td width='20%' align="center">Modulos</td>
        <td width='10%' align="center" ondblclick="">Acciones</td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from $campo where estado ='1' order by anno asc";
$res = mysql_query($sql,$cx);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
while($row = mysql_fetch_array($res))
	{
	// consulta el numero de modulos que tiene cada vigencia
	$sq2 = "select vf from modulos where vf  ='$row[anno]'";
	$rs2 = mysql_query($sq2,$cx);
	$fi2 = mysql_num_rows($rs2);

	
	$link ="onclick=cargaArchivo(&#34admin/modulos/reporte_mod.php?anno=$row[anno]&#34,&#34columna1&#34)";	
	if ($row[estado] == 1) $estado ='Activo';
	if ($row[estado] == 2) $estado ='Cerrado';
	if ($row[estado] == 3) $estado ='Suspendido';
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td $link align='left'>$row[anno]</td>
        <td $link align='left'>$estado</td>
		<td $link align='center'>$fi2</td>

		<td valign='middle' align='center'>
			<div id='acciones$row[id]' style='display:none' class='actions'>
				<a href='#' onclick=borrarRegistro('admin/$campo/eliminar.php?doc=$row[id]','columna1') title='Eliminar vigencia'><i class='fa fa-trash-o'></i></a>
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
