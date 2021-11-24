<?php
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);


?>
<center>
 <table width="50%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='5%' align='left'>No</td>
        <td width='85%' align='left'>Nombre</td>
        <td width='10%' align='left'></td>
    </tr>
<?php
// selecciono parametros
$sq3="select * from farm_forma order by nombre asc";
$re3=mysql_query($sq3,$cx);
while($rw3 = mysql_fetch_array($re3))
{
	$link ="onclick=cargaArchivo(&#34admin/inicial/forma_form.php?tipo_art=$rw3[cod_art]&id=$rw3[id]&nombre=$rw3[nombre]&#34,&#34form33&#34)";	
	//colorear filas
	$cont++;
	// buscamos las cantidades de pedido definitivas en espera
	// Consuto las cantidades que han entrado
		$subtot= $rw3['valor'] * $rw3['entrada'];
		$subtot2 =number_format($subtot,2,".",",");
		echo("
		<tr id='$rw3[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);>
			<td  $link align='left' bgcolor='#F5F5F5'>$cont</td>
			<td  $link align='left'>$rw3[nombre]</td>
			<td valign='middle' align='center'>
				<div id='acciones$rw3[id]' style='display:none' class='actions'>
					<a href='#' onclick=cargaArchivo('admin/$campo/contrasena.php?doc=$row[usuario]','mjs') title='Editar'><i class='fa fa-edit'></i></a> &nbsp;
					<a href='#' onclick=borrarRegistro('admin/inicial/forma_eliminar.php?id=$rw3[id]','reporte')><i class='fa fa-trash-o'></i></a>
				</div>
			</td>
		</tr>");
		$total = $total + $subtot;
		$subtot=0;
}
$total2 = number_format($total,2,".",",");

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
