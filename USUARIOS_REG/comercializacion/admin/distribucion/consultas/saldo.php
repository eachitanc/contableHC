<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=latin1'); 
include('../../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$documento = $_POST['doc'];
$tipo = $_POST['tipo'];
//consulto la cantidad de lotes que tiene el documento
$sq="select lote from farm_kardex where cod_int ='$documento' group by lote";
$rs = mysql_query($sq);
$control =0;
while ($rw = mysql_fetch_array($rs))
{
	//valido cantidades por cada lote encontrado
	$sq2="select sum(entrada) as entra, sum(salida) as sale,invima,fecha_ven,cod_barras from farm_kardex where cod_int ='$documento' and lote ='$rw[lote]' group by lote";
	$rs2 = mysql_query($sq2);
	$rw2 = mysql_fetch_array($rs2);
	$cant =$rw2['entra'] - $rw2['sale']; 
	if ($cant >0 and $control ==0)
	{
		$sq3="select nombre from farm_med where id ='$documento'";
		$rs3 = mysql_query($sq3);
		$rw3 = mysql_fetch_array($rs3);
		$sq4="select venta from farm_kardex where cod_int ='$documento' and (tipo_mov ='INI' or tipo_mov ='REC') order by id asc";
		$rs4 = mysql_query($sq4);
		$rw4 = mysql_fetch_array($rs4);
		//echo $sq2;
		echo $cant . "," . $rw3['nombre'] . "," . $rw['lote'] .",". $rw4['venta'] .",". $rw2['invima']  .",". $rw2['fecha_ven']  .",". $rw2['cod_barras'];
		$control =1;
	}
}
if ($control ==0){
	echo "" . "," . "" . "," . "" .",". "" .",". "" .",". "" .",". "";
	}
?>
