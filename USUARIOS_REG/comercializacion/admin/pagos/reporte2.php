<?php
$campo ='pagos';
$fecha_ini = $_GET['fecha_ini'];
$fecha_fin = $_GET['fecha_fin'];
$cliente = $_GET['cliente']; 
if($_GET['fecha'] == '') $fecha = date('Y/m/d');
if($cliente =='') $fcliente =''; else $fcliente ="and cliente = '$cliente'"; 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

?>
<center>
<br />
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr>
    	<td colspan="5" align="left" class="menu3">Pagos realizados durante el periodo</td>
	</tr>
 </table>   
  <table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='15%' align='left'>Fecha de pago</td>
        <td width='25%'>Nombre</td>
		<td width='10%' align="center" ondblclick="">Litros</td>
        <td width='10%' align="center" ondblclick="">Precio</td>
        <td width='10%' align="center" ondblclick="">Valor</td>
        <td width='10%' align="center" ondblclick="">Fecha inicial</td>
        <td width='10%' align="center" ondblclick="">Fecha final</td>
        <td width='10%' align="center" ondblclick=""></td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select sum(debito) as valor,fecha_ini,fecha_fin,ref,fecha, sum(litros) as litros,precio,id_auto from lib_aux4 where tipo ='VAL' group by ref";
$res = mysql_query($sql,$cx);
if (!$res) {
die('Invalid query: ' . mysql_error());
}
while($row = mysql_fetch_array($res))
{
	$link ="onclick=cargaArchivo(&#34admin/$campo/reporte3.php?ref=$row[ref]&cliente=$cliente&#34,&#34columna1&#34)";	
	echo("
	<tr id='$row[id_auto]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td $link align='left'>$row[fecha]</td>
        <td $link align='left'>PAGO A PROVEEDORES</td>
		<td $link align='center'>$row[litros]</td>
		<td $link align='center'>$row[precio]</td>
		<td $link align='center'>$row[valor]</td>
		<td $link align='right'>$row[fecha_ini]</td>
		<td $link align='right'>$row[fecha_fin]</td>
		");
	echo("<td valign='middle' align='center'>
			<div id='acciones$row[id_auto]' style='display:none' class='actions'>
				<a href='#' onclick=cargaArchivo('admin/$campo/contrasena.php?doc=$row[usuario]','mjs') title='Editar'><i class='fa fa-edit'></i></a> &nbsp;
			</div>
		</td>
	</tr>");
	$sumatot = $sumatot + $total;
	$total =0;
	$concepto ="PAGO DE QUINCENA PERIODO " . $fecha_ini. " A " . $fecha_fin. " DE ". $litros ." LITROS LIQUIDADOS A $" . $precio . "PESOS C/U";
	//Llenar tabla auxiliar de pagos
	$sql3 ="insert into z_aux_pagos (fecha_ini,fecha_fin,fecha_pag,ref,id_manu,cliente,tercero,concepto,litros,precio,valor,descuentos,neto,forma_pago) values('$fecha_ini','$fecha_fin','$fecha_pag','$ref','$id_manu','$cliente','$row[num_id]','$concepto','$litros','$precio','$valor','$descuentos','$neto','Efectivo')";
			//$re2 = mysql_query($sql3);
}
echo("
	<tr bgcolor='#F5F5F5'>
		<td align='left' colspan='2' >Total</td>
		<td align='center'>$sumam</td>
		<td align='center'>$sumat</td>
		<td align='right' id='total2'>$valot</td>
		<td align='right'>0</td>
		<td align='right'>$valot</td>
		<td align='center'></td>
	</tr>");	
echo "</table>";

?>
<br />
<div id="mjs"></div>
