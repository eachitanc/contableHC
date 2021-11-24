<?php
include ('../../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
$codigo = $_POST['doc'];
$tipo = $_POST['tipo'];
$id=$_POST['id'];
$sq3 = "SELECT sum(entrada) as entradas, sum(salida) as salidas,lote,invima,cod_barras,fecha_ven FROM farm_kardex WHERE cod_int ='$codigo' and tipo_art ='$tipo' and id > '$id'  group by invima,lote,cod_barras,fecha_ven order by fecha asc";
$rs3 = mysql_query($sq3);
$rw3 = mysql_fetch_array($rs3);
$cant = $rw3['entradas'] -  $rw3['salidas'];
// Datos registro anterior
		$sq4="select max(id) as id from farm_kardex where cod_int ='$codigo' and tipo_art ='$tipo'";
		$re4 =mysql_query($sq4,$cx);
		$rw4 =mysql_fetch_array($re4);
		$sq5="select saldo,unitario,total from farm_kardex where id = '$rw4[id]'";
		$re5 =mysql_query($sq5,$cx);
		$rw5 =mysql_fetch_array($re5);
		$unitario = $rw5['unitario'];
//$rw3['cod_barras']
echo $rw3['cod_barras'].";".$rw3['fecha_ven'].";".$rw3['lote'].";".$rw3['invima'].";".$rw3['id'].";".$cant.";".$unitario;//$rw2['nombre'];
?>
