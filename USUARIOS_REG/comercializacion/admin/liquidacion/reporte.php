<?php
$campo ='liquidacion';
$fecha = $_GET['fecha'];
if($_GET['fecha'] == '') $fecha = date('Y/m/d');
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

?>
<center>
<br />
<table width="85%" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr>
    	<td colspan="5" align="left" class="menu3">Registro quincenal de liquidaciones diarias por cliente</td>
	</tr>
 </table>   
  <table width="85%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='30%' align='center'>Cliente</td>
        <td width='10%' align='center'>Fecha Inicial</td>
        <td width='10%' align='center'>Fecha Final</td>
        <td width='13%' align='right'>Valor facturado</td>
		<td width='13%' align="right" ondblclick="">Total gastos</td>
        <td width='12%' align="right" ondblclick="">Precio</td>
        <td width='12%' align="center" ondblclick=""></td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from liquidacion order by fecha_ini asc";
$res = mysql_query($sql,$cx);
if (!$res) {
die('Invalid query: ' . mysql_error());
}
while($row = mysql_fetch_array($res))
{
	$sq2 = "select * from z_clientes where num_id ='$row[cliente]' ";
	$re2 = mysql_query($sq2,$cx);
	$rw2 = mysql_fetch_array($re2);
	$link ="onclick=cargaArchivo(&#34admin/$campo/formulario.php?id=$row[num_id]&fecha=$fecha&#34,&#34columna1&#34)";	
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td $link align='left'>$rw2[nombre]</td>
		<td $link align='center'>$row[fecha_ini]</td>
		<td $link align='center'>$row[fecha_fin]</td>
		<td $link align='right'>$row[facturado]</td>
		<td $link align='right'>$row[facturado]</td>
		<td $link align='right'>$row[precio]</td>
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
