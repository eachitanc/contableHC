<?php
header('Content-Type: text/html; charset=latin1');
$campo ='inventario';
$nombre = urlencode($_GET['nombre']); $nombre = str_replace("+" ," ", $nombre );
$bodega = urlencode($_GET['bodega']); $bodega = str_replace("+" ," ", $bodega );
$articulo = urlencode($_GET['articulo']); $articulo = str_replace("+" ," ", $articulo );
if ($nombre =='') $nombre ="select * from farm_listado order by nombre asc"; else $nombre ="select * from farm_listado where nombre like'$nombre%'";
if ($bodega =='') $bodega =""; else $bodega ="and bodega = '$bodega'";
if ($articulo =='') $articulo =""; else $articulo ="and tipo_art = '$articulo'";
if($_GET['fecha'] == '') $fecha = date('Y/m/d');
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

?>
<center>
<br />
<table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'> 
	<tr>
    	<td colspan="5" align="left" class="menu3">Registro productos en inventario</td>
	</tr>
 </table>   
  <table width="90%" border="0" class="punteado" cellpadding='3' cellspacing='0'>   
    <tr bgcolor="#F5F5F5">
    	<td width='5%' align='center'>No</td>
        <td width='40%' align='left'>Nombre</td>
        <td width='12%' align='center'>Dias pedido</td>
         <td width='10%' align='center'>Dias Abastecimiento</td>
        <td width='10%' align='center'>Consumo promedio</td>
        <td width='15%' align='center'>Pedido</td>
       <td width='8%' align="center" ondblclick=""></td>
    </tr>
<?php
// selecciono parametros
$sq3="select * from farm_parameter where id >0 $articulo";
$re3=mysql_query($sq3,$cx);
$rw3=mysql_fetch_array($re3);
// busco numero de consecutivo
$sq5 ="select max(pedido) as numero from farm_pedido";
$re5=mysql_query($sq5,$cx);
$rw5=mysql_fetch_array($re5);
	if($rw5['numero'] =='')
	{
		$anno = split('/',$_GET['fecha']);
		$anno = $anno[0];
		$concec =$anno."0001";
	}else{
		$concec = $rw5['numero']+1;
	}

// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = $nombre;
include('../objetos/fecha_ges.php');
$res = mysql_query($sql,$cx);
if (!$res) {
die('Invalid query: ' . mysql_error());
}
$cont=0;
$saldo =0;
$promedio =0;
$requiere =0;
while($row = mysql_fetch_array($res))
{
	$fecha_ini = $row['fecha_alta']; 
	$dias = dias_diferencia($fecha_ini);
	$link ="onclick=cargaArchivo(&#34admin/$campo/formulario.php?id=$row[id]&fecha=$fecha&#34,&#34reporte&#34)";	
	//colorear filas
	if ($row['cant'] ==0) $color ="bgcolor='#FFEBD7'"; else $color ="";
	$sq2 ="select id,sum(entrada) as entrada, sum(salida) as salida from farm_kardex where cod_int = '$row[cod_int]' $bodega $articulo group by cod_int";
	$re2 = mysql_query($sq2,$cx);
	while($rw2=mysql_fetch_array($re2))
	{
	$cont++;
	// buscamos las cantidades de pedido definitivas en espera
	$sq6 ="select cant from farm_pedido where cod_int ='$row[cod_int]'";
	$re6 =mysql_query($sq6,$cx);
	$rw6 =mysql_fetch_array($re6);
	// buscar cantidad del articulo en existencias
	$saldo = $rw2['entrada'] - $rw2['salida'];
	$promedio = round($rw2['salida'] / $dias,0);
	$requiere = (($promedio * $rw3['dias_ped']) + ($promedio * $rw3['dias_com'])) - ($saldo + $rw6['cant']) ;
	if($requiere >0)
		{
		 // Guardo el pedido general en la base de datos
		$sq4 ="insert into farm_pedido (fecha,bodega,tip_art,cod_int,pedido,cant,llegada) values ('$_GET[fecha]','$_GET[bodega]','$_GET[articulo]','$row[cod_int]','$concec','$requiere','llegada');";
		$re4 = mysql_query($sq4);	
		echo("
		<tr id='$rw2[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);>
			<td  $link align='left'>$cont</td>
			<td  $link align='left'>$row[nombre]</td>
			<td  $link align='center'>$rw3[dias_ped]</td>
			<td  $link align='center'>$rw3[dias_com]</td>
			<td  $link align='center'>$promedio</td>
			<td  $link align='center'>$requiere</td>
			<td valign='middle' align='center'>
				<div id='acciones$rw2[id]' style='display:none' class='actions'>
					<a href='#' onclick=cargaArchivo('admin/$campo/contrasena.php?doc=$row[usuario]','mjs') title='Editar'><i class='fa fa-edit'></i></a> &nbsp;
					<a href='#' onclick=borrarRegistro('admin/pedidos/eliminar.php?doc=$row[cod_int]','reporte2')><i class='fa fa-trash-o'></i></a>
				</div>
			</td>
		</tr>");
		}
	}
}
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
