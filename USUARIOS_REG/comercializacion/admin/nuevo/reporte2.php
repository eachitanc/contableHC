<?php
session_start();
header('Content-Type: text/html; charset=latin1');
$campo ='recepcion2';
$inicial = urlencode($_GET['id']); 
if($_GET['fecha'] == '') $fecha = date('Y/m/d');
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

    $sq1="select * from farma_temp where login='$_SESSION[user]'";
	$re1=mysql_query($sq1,$cx);
	$rw1=mysql_fetch_array($re1);

?>
<br />
<center>
 <table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='5%' align='left'>No</td>
        <td width='40%' align='left'>Nombre</td>
        <td width='20%' align='left'>Laboratorio</td>
         <td width='15%' align='right'>Presentaci&oacute;n</td>
        <td width='15%' align='right'>Unidad</td>
       <td width='5%' align="center" ondblclick=""></td>
    </tr>
<?php
// selecciono parametros
$sq3="select * from farm_med where nombre like '$inicial%' and tipo ='$rw1[producto]' order by nombre asc";
$re3=mysql_query($sq3,$cx);
while($rw3 = mysql_fetch_array($re3))
{
	$link ="onclick=cargaArchivo(&#34admin/nuevo/formulario2.php?cod=$rw3[cod_int]&id=$rw3[id]&#34,&#34tutulo&#34)";	
	//colorear filas
	$cont++;
	// buscamos las cantidades de pedido definitivas en espera
	$sq6 ="select lab from farm_lab where id ='$rw3[laboratorio]'";
	$re6 =mysql_query($sq6,$cx);
	$rw6 =mysql_fetch_array($re6);
	// Consuto las cantidades que han entrado
		$subtot= $rw3['valor'] * $rw3['entrada'];
		$subtot2 =number_format($subtot,2,".",",");
		echo("
		<tr id='$rw3[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);>
			<td  $link align='left' bgcolor='#F5F5F5'>$cont</td>
			<td  $link align='left'>$rw3[nombre]</td>
			<td  $link align='left'>$rw6[lab]</td>
			<td  $link align='right'>$rw3[presentacion]</td>
			<td  $link align='right'>$rw3[unidad]</td>
			<td valign='middle' align='center'>
				<div id='acciones$rw3[id]' style='display:none' class='actions'>
					<a href='#' onclick=cargaArchivo('admin/$campo/contrasena.php?doc=$row[usuario]','mjs') title='Editar'><i class='fa fa-edit'></i></a> &nbsp;
					<a href='#' onclick=borrarRegistro('admin/inicial/eliminar.php?id=$rw3[id]&factura=$factura','reporte')><i class='fa fa-trash-o'></i></a>
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
