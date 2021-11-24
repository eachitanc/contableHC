<?php
$campo ='liquidacion';
$nombre = urlencode($_GET['nombre']); $nombre = str_replace("+" ," ", $nombre );
$presen = urlencode($_GET['presen']); $presen = str_replace("+" ," ", $presen );
$pos = urlencode($_GET['pos']); $pos = str_replace("+" ," ", $pos );
if ($pos =='') $poss =""; else $poss ="and pos like '$pos%'";
$cum = urlencode($_GET['cum']); $cum = str_replace("+" ," ", $cum );
if ($cum =='') $cumc =""; else $cumc ="and cum like '$cum%'";
$presenta=$presen;
if($_GET['fecha'] == '') $fecha = date('Y/m/d');
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

?>
<center>
<br />
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr>
    	<td colspan="5" align="left" class="menu3">Productos registrados en SISMED</td>
	</tr>
 </table>   
  <table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='28%' align='center'>Nombre</td>
        <td width='47%' align='center'>Presentacion</td>
        <td width='10%' align='center'>CUM</td>
        <td width='5%' align='center'>POS</td>
        <td width='5%' align='right'>Listado</td>
        <td width='5%' align="center" ondblclick=""></td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from farm_med where nombre like '$nombre%' and presenta like '%$presen%' $poss $cumc order by nombre asc";
$res = mysql_query($sql,$cx);
if (!$res) {
die('Invalid query: ' . mysql_error());
}
while($row = mysql_fetch_array($res))
{
	$link ="onclick=cargaArchivo(&#34admin/$campo/formulario.php?id=$row[num_id]&fecha=$fecha&#34,&#34columna1&#34)";	
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td align='left'>$row[nombre]</td>
		<td  align='left'>$row[presenta]</td>
		<td  align='center'>$row[cum]</td>
		<td  align='center'>$row[pos]</td>
		<td  align='center'><input type='checkbox' name='incluir' id='incluir' value='$row[id]' onclick='seleccionar(value);' /> </td>
	    <td valign='middle' align='center'>
			<div id='acciones$row[id]' style='display:none' class='actions'>
				<a href='#' onclick=cargaArchivo('admin/$campo/contrasena.php?doc=$row[usuario]','mjs') title='Editar'><i class='fa fa-edit'></i></a> &nbsp;
				<a href='#' onclick=borrarRegistro('admin/$campo/eliminar.php?doc=$row[id]','reporte')><i class='fa fa-trash-o'></i></a>
			</div>
		</td>
	</tr>");
	$total =0;
}
echo "</table>";

?>
<br />
<div id="mjs"></div>
