<?php
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
    	<td width='28%' align='center'>Tipo</td>
        <td width='28%' align='center'>Codigo</td>
        <td width='28%' align='center'>Nombre</td>
        <td width='47%' align='center'>Factura</td>
        <td width='47%' align='center'>Cantidad</td>
        <td width='10%' align='center'>Unitario</td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from farm_listado where tipo ='MED' order by nombre";
$res = mysql_query($sql,$cx);
if (!$res) {
die('Invalid query: ' . mysql_error());
}
while($row = mysql_fetch_array($res))
{	$sq2 ="select entrada,valor from farm_kardex where cod_int = '$row[cod_int]' and tipo_mov ='REC'";
	$re2 =mysql_query($sq2,$cx);
	$rw2 =mysql_fetch_array($re2);
	if($rw2['entrada'] > 0)
	{
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td align='left'>$row[tipo]</td>
		<td align='left'>$row[cod_int]</td>
		<td align='left'>$row[nombre]</td>
		<td align='left'>$rw2[doc_num]</td>
		<td align='center'>$rw2[entrada]</td>
		<td align='center'>$rw2[valor]</td>
	</tr>");
	$total =0;
	}
}
echo "</table>";
?>
