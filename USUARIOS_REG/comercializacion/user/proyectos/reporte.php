<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
session_start();
$campo ='proyectos';
$id=$_GET['id'];
// Verifico permisos del sistema
if ($_SESSION["rool"] =="Administrador") 
{
	// Realizo la conexion con la base de datos
	include ('../../config.php');
	$cx = mysql_connect($server,$dbuser,$dbpass);
	//
	if (!$cx) {
		die('No pudo conectarse: ' . mysql_error());
	}
?>
<center>
<br />
<br />
<div id="contenedorr3">
<table width="99%" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr>
    	<td colspan="4" align="left" id="nuevat" ><input  class="menu1" type="button" id="menu1" value="Nuevo Proyecto" style="background:#72A0CF; color:#FFFFFF; border:double" onClick="cargaArchivo('admin/<?php echo $campo; ?>/formulario.php','contenido');"  />
       
       </td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('user/<?php echo $campo; ?>/entidades.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
	</tr>
    <tr>
    	<td width='10%' align='left'>Fecha Inicio</td>
        <td width='30%'>Proyecto</td>
		<td width='7%' align="center" ondblclick="">Actividades pendientes</td>
        <td width='7%' align="center" ondblclick="">Actividades terminadas</td>
        <td width='8%' >Acciones</td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from $campo where id_entidad ='$id' order by fecha_ini asc";
$res = mysql_db_query($database,$sql,$cx);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
while($row = mysql_fetch_array($res))
	{
	$link ="onclick=cargaArchivo(&#34user/$campo/formulario.php?id=$row[id]&#34,&#34contenido&#34)";	
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td $link align='left'>$row[fecha_ini]</td>
        <td $link align='left'>$row[titulo]</td>
		<td align='center'> 3</td>
		<td align='center'>5</td>
		<td valign='middle'>
			<div id='acciones$row[id]' style='display:none' class='actions'>
				<img src='img/eliminar.jpg'	border='0' title='Eliminar registro' width='22px' onclick=borrarRegistro('admin/$campo/eliminar.php?doc=$row[usuario]','contenido')>
				<img src='img/candado.jpg'	border='0' title='Modificar contrase&ntilde;a' width='22px' onclick=cargaArchivo('admin/$campo/contrasena.php?doc=$row[usuario]','mjs')>
			</div>
		</td>
	</tr>");
	} 

echo "</table>";
}else{  // Cuando el usuario no es admiistrador 
echo "<script>
		alert('El usuario no tiene permisos de administrador..');
		cargaArchivo('admin/form_log.php','contenido');	
	</script>";
}
?>
</div>
</center>
<div id="mjs"></div>
