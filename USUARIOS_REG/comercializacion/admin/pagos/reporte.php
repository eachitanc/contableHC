<?php
$campo ='recepcion';
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
    	<td colspan="5" align="left" class="menu3">Liquidaci&oacute;n a pagar de la quincena seleccionada </td>
	</tr>
 </table>   
  <table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='10%' align='left'>Doc</td>
        <td width='30%'>Nombre</td>
		<td width='10%' align="center" ondblclick="">Litros</td>
        <td width='10%' align="center" ondblclick="">Precio</td>
        <td width='10%' align="center" ondblclick="">Valor</td>
        <td width='10%' align="center" ondblclick="">Descuentos</td>
        <td width='10%' align="center" ondblclick="">Neto</td>
        <td width='10%' align="center" ondblclick=""></td>
    </tr>
<?php
mysql_db_query($database,"TRUNCATE TABLE z_aux_pagos",$cx);
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = "select * from terceros_naturales where clase ='ASOCIADO' order by pri_ape, seg_ape asc";
$res = mysql_query($sql,$cx);
if (!$res) {
die('Invalid query: ' . mysql_error());
}
while($row = mysql_fetch_array($res))
{
	$link ="onclick=cargaArchivo(&#34admin/$campo/formulario.php?id=$row[num_id]&fecha=$fecha&cliente=$cliente&#34,&#34reporte&#34)";	
	echo("
	<tr id='$row[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);   bgcolor='#ffffff'>
		<td $link align='left'>$row[num_id]</td>
        <td $link align='left'>$row[pri_ape] $row[seg_ape] $row[pri_nom] $row[seg_nom]</td>
		");
	//Buscar registros de recepcion para la fecha
	$sq2 = "select sum(cant) as litros from recepcion where ccnit ='$row[num_id]' and (fecha between '$fecha_ini' and '$fecha_fin') and cliente ='$cliente'";
	$re2 = mysql_query($sq2,$cx);
	while($rw2 = mysql_fetch_array($re2))
	{
		echo("<td $link align='center'>$rw2[litros]</td>");
		$total = $rw2['litros'];
		$sumam = $sumam + $rw2['litros']; 
		$litros = $rw2['litros']; 
	} 
	// Buscar el precio que se liquido para el periodo
	$sq3 = "select precio from liquidacion where (fecha_ini between '$fecha_ini' and '$fecha_fin') and cliente ='$cliente'";
	$re3 = mysql_query($sq3,$cx);
	while($rw3 = mysql_fetch_array($re3))
	{
		echo("<td $link align='center'>$rw3[precio]</td>");
		$precio = $rw3['precio'];
	} 
	$valor =  $litros * $precio; 
	$valot =  $valot + $valor;
	
	echo("<td $link align='right'>$valor</td>");
	echo("<td $link align='right'>0</td>");
	echo("<td $link align='right'>$neto</td>");
	echo("<td valign='middle' align='center'>
			<div id='acciones$row[id]' style='display:none' class='actions'>
				<a href='#' onclick=cargaArchivo('admin/$campo/contrasena.php?doc=$row[usuario]','mjs') title='Editar'><i class='fa fa-edit'></i></a> &nbsp;
			</div>
		</td>
	</tr>");
	$sumatot = $sumatot + $total;
	$total =0;
	$concepto ="PAGO DE QUINCENA PERIODO " . $fecha_ini. " A " . $fecha_fin. " DE ". $litros ." LITROS LIQUIDADOS A $" . $precio . "PESOS C/U";
	//Llenar tabla auxiliar de pagos
	$sql3 ="insert into z_aux_pagos (fecha_ini,fecha_fin,fecha_pag,ref,id_manu,cliente,tercero,concepto,litros,precio,valor,descuentos,neto,forma_pago) values('$fecha_ini','$fecha_fin','$fecha_pag','$ref','$id_manu','$cliente','$row[num_id]','$concepto','$litros','$precio','$valor','$descuentos','$neto','Efectivo')";
			$re2 = mysql_query($sql3);
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
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr>
    	<td colspan="5" align="left" class="menu3">Datos del pago a generar </td>
	</tr>
 </table>  
 <form action="" method="post" name="form3" id="form3">
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0' align="center"> 
	<tr>
    	 <td align="left"><input name="menos" type="button" onClick="sumarfechas3(-1);" value="-" style='background:#E8EEFA;'/>
         <input name="button2" type="button" class="Concep2"  onClick="displayCalendar(document.form3.menu3_fecha_ini,'yyyy/mm/dd',this)" value="Fecha Pago"  /><input type="text" name="dir" id="menu3_fecha_ini" size="10" value="<?php echo $fecha; ?>" alt="1" onkeydown='displaycode(event,id);' /> 
          <input name="mas" type="button" onClick="sumarfechas3(1);" value="+"  style='background:#E8EEFA;'/>
        <input name="ir" type="button" onClick="generar_pago();" value="Generar pago" style='background:#E8EEFA;'/> </td>
	</tr>
 </table> 
 </form>