<?php
$campo ='despacho';
$fecha = $_GET['fecha'];
if($_GET['fecha'] == '') $fecha = date('Y/m/d');
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

?>
<center>
<br />
<table width="85%" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr>
    	<td colspan="5" align="left" class="menu3">Registro diario de despacho de leche / cliente </td>
	</tr>
 </table>   
  <table width="85%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='10%' align='left'>Fecha</td>
        <td width='10%' align='center'>Nit</td>
        <td width='40%'>Cliente</td>
		<td width='10%' align="center" ondblclick="">Diario recibido</td>
        <td width='10%' align="center" ondblclick="">Total entregado</td>
        <td width='10%' align="center" ondblclick="">Saldo a favor</td>
        <td width='10%' align="center" ondblclick=""></td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from despacho where fecha = '$fecha' order by fecha asc";
$res = mysql_query($sql,$cx);
if (!$res) {
die('Invalid query: ' . mysql_error());
}
	$recib = 0;
	$entre = 0;
	$saldo = 0;
while($row = mysql_fetch_array($res))
{
	$sq2 = "select * from z_clientes where num_id ='$row[cliente]' ";
	$re2 = mysql_query($sq2,$cx);
	$rw2 = mysql_fetch_array($re2);
	$link ="onclick=cargaArchivo(&#34admin/$campo/formulario.php?id=$row[id]&fecha=$fecha&cliente=$row[cliente]&#34,&#34reporte&#34)";	
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td $link align='left'>$row[fecha]</td>
		<td $link align='left'>$row[cliente]</td>
		<td $link align='left'>$rw2[nombre]</td>
		<td $link align='center'>$row[recibido]</td>
		<td $link align='center'>$row[entrega]</td>
		<td $link align='center'>$row[saldo]</td>
	    <td valign='middle' align='center'>
			<div id='acciones$row[id]' style='display:none' class='actions'>
				<a href='#' onclick=cargaArchivo('admin/$campo/contrasena.php?doc=$row[usuario]','mjs') title='Editar'><i class='fa fa-edit'></i></a> &nbsp;
				<a href='#' onclick=borrarRegistro('admin/$campo/eliminar.php?doc=$row[id]','reporte')><i class='fa fa-trash-o'></i></a>
			</div>
		</td>
	</tr>");
	$recib = $recib + $row['recibido'];
	$entre = $entre + $row['entrega'];
	$saldo = $saldo + $row['saldo'];
}
$total = $recib  + $entre + $saldo;
if($total >0)
{
echo("
	<tr bgcolor='#F5F5F5'>
		<td align='left' colspan='3' >Total</td>
		<td align='center'>$recib</td>
		<td align='center'>$entre</td>
		<td align='center'>$saldo</td>
		<td align='center'></td>
	</tr>");	
}
echo "</table>";

?>
<br />
<div id="mjs"></div>
