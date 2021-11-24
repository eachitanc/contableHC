<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
session_start();
$campo ='proyectos';
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
    	<td colspan="4" align="left" id="nuevat" >
       
       </td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('inicio.php?doc_jefe=<?php echo $doc_jefe; ?>','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
	</tr>
    <tr>
    	<td width='30%' align='left'>Nombres</td>
        <td width='10%'>Pendientes</td>
		<td width='7%' align="center" ondblclick="">Terminados</td>
        <td width='7%' align="center" ondblclick="">Reporte</td>
        <td width='8%' >Acciones</td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from entidad order by nombre asc";
$res = mysql_db_query($database,$sql,$cx);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
while($row = mysql_fetch_array($res))
	{
	$link ="onclick=cargaArchivo(&#34user/$campo/reporte.php?id=$row[id]&#34,&#34contenido&#34)";	
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td $link align='left'>$row[nombre]</td>
        <td $link align='left'>2</td>
		<td $link align='center'> 3</td>
		<td $link align='center'> Imprimir </td>
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
