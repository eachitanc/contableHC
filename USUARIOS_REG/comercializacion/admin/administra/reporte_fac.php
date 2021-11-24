<?php
header('Content-Type: text/html; charset=latin1');
$campo ='dispensar';
$factura = $_GET['factura'];
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

?>
<script>

</script>
<center>
<br />
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr>
    	<td colspan="5" align="left" class="menu3">Registro productos en inventario</td>
	</tr>
 </table>   
  <table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='3%' align='center'>No</td>
        <td width='44%' align='center'>Nombre</td>
        <td width='8%' align='center'>Lote</td>
        <td width='14%' align='center'>Fecha ven</td>
        <td width='5%' align='center'>Cantidad</td>
        <td width='10%' align='center'>Unitario</td>
        <td width='10%' align='center'>Total</td>
        <td width='6%' align="center" ondblclick=""></td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sq22 ="select * from farm_kardex where doc_num = '$factura' order by id asc";
$re22 = mysql_query($sq22,$cx);
if (!$re22) {
die('Invalid query: ' . mysql_error());
}
$cont=0;
while($rw22 = mysql_fetch_array($re22))
{
	$link ="onclick=cargaArchivo(&#34admin/$campo/formulario.php?id=$row[id]&fecha=$fecha&#34,&#34reporte&#34)";	
	//colorear filas
	$cont++;
	$sql = "select nombre from farm_listado where cod_int ='$rw22[cod_int]'";
	$res = mysql_query($sql,$cx);
	$row=mysql_fetch_array($res);
	echo("
	<tr id='x$rw22[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);>
		<td  align='left'>$cont</td>
		<td  align='left'>$row[nombre]</td>
		<td  align='left'>$rw22[lote]</td>
		<td  align='left'>$rw22[fecha_ven]</td>
		<td  align='right'>$rw22[salida]</td>
		<td  align='right'></td>
		<td  $link align='right'>$rw2[cant]</td>
	    <td valign='middle' align='center'>
			<div id='accionesx$rw22[id]' style='display:none' class='actions'>
				<a href='#' onclick=borrarRegistro('admin/$campo/eliminar.php?doc=$rw22[id]&factura=$factura','facturas')><i class='fa fa-trash-o'></i></a>
			</div>
		</td>
	</tr>");
	$total =0;
}

?>
<div id="mjs"></div>
<script>
document.getElementById("cod_int").select(); 
</script>