<?php
header('Content-Type: text/html; charset=latin1');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Pedido.xls");
header("Pragma: no-cache");
header("Expires: 0");
$pedido = $_GET['doc'];
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

?>
<center>
<br />
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr>
    	<td colspan="5" align="left" class="menu3">Pedido por tipo de producto</td>
	</tr>
 </table>   
  <table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='10%' align='center'>No</td>
        <td width='20%' align='center'>Codigo</td>
        <td width='60%' align='left'>Nombre</td>
        <td width='10%' align='center'>Cantidad</td>
    </tr>
<?php
// selecciono parametros
$sq3="select * from farm_pedido  where pedido ='$pedido'";
$re3=mysql_query($sq3,$cx);
$cont =0;
while ($rw3=mysql_fetch_array($re3))
{
		// obtengo el nombre del articulo
		$cont++;
		$sql ="select nombre from farm_listado where cod_int ='$rw3[cod_int]'";
		$re1=mysql_query($sql,$cx);
		$row =mysql_fetch_array($re1);
		echo("
		<tr id='$rw2[id]'>
			<td align='left'>$cont</td>
			<td align='left'>$rw3[cod_int]</td>
			<td align='center'>$row[nombre]</td>
			<td align='center'>$rw3[cant]</td>
		</tr>");
}
echo "</table>";
?>

<br />
<div id="mjs"></div>
