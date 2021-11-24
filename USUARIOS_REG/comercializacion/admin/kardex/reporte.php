<?php
header('Content-Type: text/html; charset=latin1');
$campo ='recepcion2';
$bodega = urlencode($_GET['bodega']); 
$articulo = urlencode($_GET['articulo']); 
$fecha1 = urlencode($_GET['fecha1']); $fecha1 = str_replace("%2F" ,"/", $fecha1 );
$fecha2 = urlencode($_GET['fecha2']); $fecha2 = str_replace("%2F" ,"/", $fecha2 );
$producto = urlencode($_GET['producto']); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

?>
<center>
 <table width="70%" border="1" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='10%' align='left'>Fecha</td>
        <td width='43%' align='left'>Movimiento</td>
        <td width='15%' align='right'>Entradas</td>
        <td width='15%' align='right'>Salidas</td>
        <td width='15%' align='right'>Saldo</td>
       <td width='2%' align="center" ondblclick=""></td>
    </tr>
<?php
// selecciono parametros
$cont=0;
	$sq2="select sum(entrada) as entrada, sum(salida) as salida from farm_kardex where cod_int ='$producto'  and fecha < '$fecha1' group by cod_int";
	$re2 =mysql_query($sq2,$cx);
	$rw2 =mysql_fetch_array($re2);
    $saldo = $rw2['entrada'] - $rw2['salida'];
	echo " <tr bgcolor='#F5F5F5'>
    	<td align='left' colspan='4'>Saldo inicial</td>
        <td align='right'>$saldo </td>
        <td align='center' ondblclick=''></td>
    </tr>";
$sq3="select * from farm_med where id ='$producto' and tipo ='$articulo'";
$re3=mysql_query($sq3,$cx);
while($rw3 = mysql_fetch_array($re3))
{
	echo "<br>".$rw3['nombre'];
	// consultar el saldo del articulo antes de la fecha incial de consulta
	$sq7 ="select tipo_mov,doc_num,entrada,salida,fecha from farm_kardex where cod_int ='$rw3[id]' and (fecha between '$fecha1' and '$fecha2') order by fecha asc";
	$re7 =mysql_query($sq7,$cx);
	while ($rw7 =mysql_fetch_array($re7))
	{
	$saldo = $saldo + $rw7['entrada'] - $rw7['salida'];
	//colorear filas
	$cont++;
	// Consuto las cantidades que han entrado
		// tipos de movimiento
		if ($rw7['tipo_mov'] == 'INI') $mov ="CARGA DE SALDO INICIAL SEGUN ACTA NO " . $rw7['doc_num'];
		if ($rw7['tipo_mov'] == 'REC') $mov ="RECEPCION SEGUN FACTURA NO " . $rw7['doc_num'];
		if ($rw7['tipo_mov'] == 'DIS') $mov ="DISPENSACION SEGUN FACTURA NO " . $rw7['doc_num'];
		if ($rw7['tipo_mov'] == 'ADB') $mov ="ACTA DE BAJA NO " . $rw7['doc_num'];
		if ($rw7['tipo_mov'] == 'APE') $mov ="AJUSTE POR ENTRADAS SEGUN ACTA NO " . $rw7['doc_num'];
		if ($rw7['tipo_mov'] == 'APS') $mov ="AJUSTE POR SALIDAS SEGUN ACTA NO " . $rw7['doc_num'];
		if ($rw7['tipo_mov'] == 'APC') $mov ="PASO A CUARENTENA SEGUN ACTA NO " . $rw7['doc_num'];
		
		echo("
		<tr id='$cont' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);>
			<td  $link align='left'>$rw7[fecha]</td>
			<td  $link align='left'>$mov</td>
			<td  $link align='right'>$rw7[entrada]</td>
			<td  $link align='right'>$rw7[salida]</td>
			<td  $link align='right'>$saldo</td>
			<td valign='middle' align='center'>
				<div id='acciones$rw3[id]' style='display:none' class='actions'>
				</div>
			</td>
		</tr>");
	}
}
$total2 = number_format($total,2,".",",");
echo " <tr bgcolor='#F5F5F5'>
    	<td align='left' colspan='4'>Saldo final</td>
        <td align='right'>$saldo</td>
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
