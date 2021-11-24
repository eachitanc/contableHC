<?php
session_start();
$campo ='flujo';
// Verifico permisos del sistema
if ($_SESSION["rool"] =="Economa Local") 
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
<table width="98%" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr>
    	<td colspan="4" align="left" class="menu3">Movimientos flujo de caja 	<a href='#' onclick=borrarRegistro('admin/$campo/eliminar.php?doc=$row[usuario]','contenido')><i class='fa fa-plus-square'></i></a> </td>
        <td  align="right" id="cerrar" onClick="cargaArchivo('user/flujo/inicio.php','contenido');" onmouseover="punteroOn();" onmouseout="punteroOff();" >X</td>
	</tr>
 </table>   
  <table width="98%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#E6E6E6">
    	<td width='10%' align='left'>Fecha</td>
        <td width='10%'>Cuenta</td>
		<td width='15%' align="center" ondblclick="">Documento</td>
        <td width='35%' align="center" ondblclick="">Detalle</td>
        <td width='10%' align="center" >Ingresos</td>
        <td width='10%' align="center">Gastos</td>
         <td width='10%' align="center">Acciones</td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from $campo order by fecha asc";
$res = mysql_db_query($database,$sql,$cx);
	if (!$res) {
		die('Invalid query: ' . mysql_error());
	}
while($row = mysql_fetch_array($res))
	{
	$link ="onclick=cargaArchivo(&#34user/$campo/formulario.php?id=$row[id]&#34,&#34contenido&#34)";	
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td $link align='left'>$row[fecha]</td>
        <td $link align='left'>$row[cuenta]</td>
		<td $link align='center'> $row[documento]</td>
		<td $link align='center'> $row[detalle]</td>
		<td $link align='right'> $row[ingresos]</td>
		<td $link align='right'> $row[gastos]</td>
		<td valign='middle' align='center'>
			<div id='acciones$row[id]' style='display:none' class='actions'>
				<a href='#' onclick=cargaArchivo('admin/$campo/contrasena.php?doc=$row[usuario]','mjs') title='Editar'><i class='fa fa-edit'></i></a>
				<a href='#' onclick=borrarRegistro('admin/$campo/eliminar.php?doc=$row[usuario]','contenido')><i class='fa fa-trash-o'></i></a>
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
<br />
<div id="mjs"></div>
