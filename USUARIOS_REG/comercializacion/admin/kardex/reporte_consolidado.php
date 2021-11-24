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
    	<td width='10%' align='left'>Codigo</td>
        <td width='50%' align='left'>Producto</td>
        <td width='10%' align='right'>Inicial</td>
        <td width='10%' align='right'>Entradas</td>
        <td width='10%' align='right'>Salidas</td>
        <td width='10%' align='right'>Saldo</td>
    </tr>
<?php
// selecciono parametros
$cont=0;
$sq3="select * from farm_med where tipo ='$articulo' order by nombre asc";
$re3=mysql_query($sq3,$cx);
while($rw3 = mysql_fetch_array($re3))
{
	// consultar el saldo del articulo antes de la fecha incial de consulta
	$sq2="select sum(entrada) as entrada, sum(salida) as salida from farm_kardex where cod_int ='$rw3[id]'  and fecha < '$fecha1' group by cod_int";
	$re2 =mysql_query($sq2,$cx);
	$rw2 =mysql_fetch_array($re2);
    $saldo_ini = $rw2['entrada'] - $rw2['salida'];
	// consultar el movimiento
	$sq7 ="select sum(entrada) as entrada, sum(salida) as salida from farm_kardex where cod_int ='$rw3[id]' and (fecha between '$fecha1' and '$fecha2') group by cod_int";
	$re7 =mysql_query($sq7,$cx);
	while ($rw7 =mysql_fetch_array($re7))
	{
	$saldo = $saldo_ini + $rw7['entrada'] - $rw7['salida'];
	//colorear filas
	$cont++;
	// Consuto las cantidades que han entrado
	$saldo_control = $saldo + $saldo_ini + $rw7['entrada'] + $rw7['salida'];
	if($saldo_control >0)
	{		// 
		echo("
		<tr id='$cont' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);>
			<td  $link align='left'>$rw3[id]</td>
			<td  $link align='left'>$rw3[nombre]</td>
			<td  $link align='right'>$saldo_ini</td>
			<td  $link align='right'>$rw7[entrada]</td>
			<td  $link align='right'>$rw7[salida]</td>
			<td  $link align='right'>$saldo</td>
			</td>
		</tr>");
	$saldo =0;	
	}
	}
}
$total2 = number_format($total,2,".",",");
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
