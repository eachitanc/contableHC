<?php
header('Content-Type: text/html; charset=latin1');
$campo ='recepcion2';
$factura = urlencode($_GET['factura']); 
if($_GET['fecha'] == '') $fecha = date('Y/m/d');
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

?>
<center>
 <table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
        <td width='10%' align='left'>Cantidad</td>
        <td width='40%' align='left'>Detalle</td>
        <td width='15%' align='left'>Lote</td>
         <td width='10%' align='right'>Unitario</td>
        <td width='10%' align='right'>Total</td>
       <td width='10%' align="center" ondblclick=""></td>
    </tr>
<?php
// selecciono parametros
$sq3="select * from farm_kardex where doc_num ='$factura' and doc_ref ='2'";
$re3=mysql_query($sq3,$cx);
while($rw3 = mysql_fetch_array($re3))
{
	$link ="onclick=cargaArchivo(&#34admin/dispensar/producto3.php?cod=$rw3[cod_int]&id=$rw3[id]&#34,&#34producto2&#34)";	
	//colorear filas
	$cont++;
	// buscamos las cantidades de pedido definitivas en espera
	$sq6 ="select nombre from farm_med where id ='$rw3[cod_int]'";
	$re6 =mysql_query($sq6,$cx);
	$rw6 =mysql_fetch_array($re6);
	// Consuto las cantidades que han entrado
		$subtot= $rw3['valor'] * $rw3['salida'];
		$subtot2 =number_format($subtot,2,".",",");
		echo("
		<tr id='$rw3[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);>
			<td  $link align='left'>$rw3[salida]</td>
			<td  $link align='left'>$rw6[nombre]</td>
			<td  $link align='left'>$rw3[lote]</td>
			<td  $link align='right'>$rw3[valor]</td>
			<td  $link align='right'>$subtot2</td>
			<td valign='middle' align='center'>
				<div id='acciones$rw3[id]' style='display:none' class='actions'>
					<a href='#' onclick=cargaArchivo('admin/$campo/contrasena.php?doc=$row[usuario]','mjs') title='Editar'><i class='fa fa-edit'></i></a> &nbsp;
					<a href='#' onclick=borrarRegistro('admin/dispensar/eliminar.php?id=$rw3[id]&factura=$factura','reporte')><i class='fa fa-trash-o'></i></a>
				</div>
			</td>
		</tr>");
		$total = $total + $subtot;
		$subtot=0;
}
$total2 = number_format($total,2,".",",");
echo " <tr bgcolor='#EEEEEE'>
    	<td align='left' colspan='4'>TOTAL</td>
        <td align='right'>$total2</td>
        <td align='center' ondblclick=''></td>
    </tr>";

echo "</table>";
if($requiere > 0 )
{
		echo "<center>
		<br />
		<input name='pedido' id='pedido' type='button' value='Generar Pedido' style='background-color:#E8EEFA' onClick=cargaArchivo('admin/pedidos/enfirme.php?doc=$concec','mjs')   />
		</center>";
}
?>

<br />
<div id="mjs"></div>
