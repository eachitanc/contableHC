<?php
header('Content-Type: text/html; charset=latin1');
$campo ='inventario';
$nombre = urlencode($_GET['nombre']); $nombre = str_replace("+" ," ", $nombre );
$bodega = urlencode($_GET['bodega']); $bodega = str_replace("+" ," ", $bodega );
$articulo = urlencode($_GET['articulo']); $articulo = str_replace("+" ," ", $articulo );
if ($nombre =='') $nombre ="select * from farm_listado where tipo ='$articulo' order by nombre asc"; else $nombre ="select * from farm_listado where nombre like '$nombre%' and tipo ='$articulo'";
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
    	<td width='3%' align='center'>No</td>
        <td width='44%' align='center'>Nombre</td>
        <td width='8%' align='center'>Lote</td>
        <td width='14%' align='center'>Invima</td>
        <td width='5%' align='center'>Cantidad</td>
        <td width='10%' align='center'>Unitario</td>
        <td width='10%' align='center'>Total</td>
        <td width='6%' align="center" ondblclick=""></td>
    </tr>
<?php
// campó y tabla
// selecciono todos los capmpos de tareas para mostrar en la lista
$sql = $nombre;
$res = mysql_query($sql,$cx);
if (!$res) {
die('Invalid query: ' . mysql_error());
}
$cont=0;
while($row = mysql_fetch_array($res))
{
	$link ="onclick=cargaArchivo(&#34admin/$campo/formulario.php?id=$row[id]&fecha=$fecha&#34,&#34reporte&#34)";	
	//colorear filas
	if ($row['cant'] ==0) $color ="bgcolor='#FFEBD7'"; else $color ="";
	$sq2 ="select * from farm_kardex where cod_int = '$row[cod_int]' and  tipo_mov = 'INI' $bodega $articulo order by fecha_ven asc";
	$re2 = mysql_query($sq2,$cx);
	while($rw2=mysql_fetch_array($re2))
	{
	$cont++;
	echo("
	<tr id='$rw2[id]' onmouseover=cambiaColor(id); onmouseout=fueraPuntero(id);>
		<td  $link align='left'>$cont</td>
		<td  $link align='left'>$row[nombre]</td>
		<td  $link align='left'>$rw2[lote]</td>
		<td  $link align='left'>$rw2[invima]</td>
		<td  $link align='right'>$rw2[entrada]</td>
		<td  $link align='right'>$rw2[cant]</td>
		<td  $link align='right'></td>
	    <td valign='middle' align='center'>
			<div id='acciones$rw2[id]' style='display:none' class='actions'>
				<a href='#' onclick=cargaArchivo('admin/$campo/contrasena.php?doc=$row[usuario]','mjs') title='Editar'><i class='fa fa-edit'></i></a> &nbsp;
				<a href='#' onclick=borrarRegistro('admin/inventario/eliminar.php?doc=$row[cod_int]&art=$_GET[articulo]&bodega=$_GET[bodega]&id=$rw2[id]','reporte2')><i class='fa fa-trash-o'></i></a>
			</div>
		</td>
	</tr>");
	$total =0;
	}
}
echo "</table>";

?>
<br />
<div id="mjs"></div>
