<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=latin1'); 
include('../../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$documento = $_POST['doc'];
$tipo = $_POST['tipo'];
//consulto la cantidad de lotes que tiene el documento
$sq="select * from farm_kardex where cod_int ='$documento' order by id desc";
$rs = mysql_query($sq);
$control =0;
$rw = mysql_fetch_array($rs);
	//valido cantidades por cada lote encontrado
		$sq3="select nombre from farm_med where id ='$documento'";
		$rs3 = mysql_query($sq3);
		$rw3 = mysql_fetch_array($rs3);
		$sq4="select venta,valor from farm_kardex where cod_int ='$documento' and (tipo_mov ='INI' or tipo_mov ='REC') order by id asc";
		$rs4 = mysql_query($sq4);
		$rw4 = mysql_fetch_array($rs4);
		//echo $sq2;
		echo $rw['cod_barras'] . "," . $rw3['nombre'] . "," . $rw['invima'] .",". $rw['venta'] .",". $rw['valor'] ;
		$control =1;
if ($control ==0){
	echo "" . "," . "" . "," . "" .",". "" .",". "" .",". "" .",". "";
	}
?>
