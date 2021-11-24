<?php
session_start();
$campo ='usuarios';
$titulo ='GESTION DE ADMINISTRADORES';
$ancho ='85%';
// Verifico permisos del sistema
if ($_SESSION["rool"] =="Superadmin") 
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
    	<td colspan="4" align="left" class="menu3"><?php echo $titulo; ?> 	<i class='fa fa-plus-square' onclick="cargaArchivo('admin/vf/formulario.php','columna1');" id="men"  onmouseover='cambiaColor(id);' onmouseout='fueraPuntero(id);' ></i> 	 </td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('admin/inicio.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
	</tr>
 </table>   
  <table width="<?php echo $ancho; ?>" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='20%' align='left'>Nombre</td>
        <td width='20%'>Cargo</td>
		<td width='20%' ondblclick="">Login</td>
        <td width='15%' align="center" ondblclick="">Fecha registro</td>
        <td width='15%' align="center" ondblclick="">Fecha retiro</td>
        <td width='10%' align="center" ondblclick="">Acciones</td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from $campo where rol = 'Admin' order by nombres asc";
$res = mysql_query($sql,$cx);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
while($row = mysql_fetch_array($res))
	{
	$link ="onclick=cargaArchivo(&#34admin/$campo/formulario.php?id=$row[id]&#34,&#34columna1&#34)";	
	if ($row[estado] == 1) $estado ='Activo';
	if ($row[estado] == 2) $estado ='Cerrado';
	if ($row[estado] == 3) $estado ='Suspendido';
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td $link align='left'>$row[nombres] $row[apellidos]</td>
        <td $link align='left'>$row[cargo]</td>
		<td $link align='left'> $row[login]</td>
		<td $link align='center'>$row[fecha_ini]</td>
		<td $link align='center'>$row[fecha_fin]</td>
		
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
