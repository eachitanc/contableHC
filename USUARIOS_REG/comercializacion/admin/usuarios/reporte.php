<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
session_start();
// Verifico permisos del sistema
if ($_SESSION["rool"] =="Economa General") 
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

<table width="60%" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr  bgcolor="#ffffff">
    	<td colspan="3" align="left" id="nuevat" ><input  class="menu1" type="button" id="menu1" value="Nuevo usuario" style="background:#72A0CF; color:#FFFFFF; border:none" onClick="cargaArchivo('admin/usuarios/formulario.php','contenido');"  /></td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('inicio.php?doc_jefe=<?php echo $doc_jefe; ?>','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
	</tr>
    <tr  bgcolor='#F4F4F4'>
    	<td width='30%' align='left'>Nombres</td>
        <td width='10%'>Rol</td>
		<td width='7%' align="center" ondblclick="">Activo</td>
        <td width='8%' >Acciones</td>
    </tr>
<?php
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from usuarios where estado ='SI'  order by nombres asc";
$res = mysql_db_query($database,$sql,$cx);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
while($row = mysql_fetch_array($res))
	{
	$link ="onclick=cargaArchivo(&#34admin/usuarios/formulario.php?id=$row[id]&#34,&#34contenido&#34)";	
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);>
		<td $link align='left'>$row[nombres] $row[apellidos]</td>
        <td $link align='left'>$row[rol]</td>
		<td $link align='center'> $row[estado]</td>
		<td valign='middle'>
			<div id='acciones$row[id]' style='display:none' class='actions'>
				<a href='#' onclick=cargaArchivo('admin/usuarios/contrasena.php?doc=$row[usuario]','mjs')><i class='fa fa-edit'></i></a>&nbsp;
				<a href='#' onclick=borrarRegistro('admin/usuarios/eliminar.php?doc=$row[usuario]','contenido')><i class='fa fa-trash-o'></i></a>

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
<div id="mjs"></div>


