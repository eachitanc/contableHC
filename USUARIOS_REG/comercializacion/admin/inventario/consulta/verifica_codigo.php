<?php
	include ('../../../config.php');
	$cx = mysql_connect($server,$dbuser,$dbpass);
	
	$cod = urlencode($_GET['codigo']);
	$articulo = urlencode($_GET['articulo']);
		$sq33 = "select max(cod_int) as codigo from  farm_listado where tipo ='$articulo'"; 
		$re33 = mysql_query($sq33);
		$rw33 =mysql_fetch_array($re33);
		$valor = $rw33['codigo']+ 1;
		echo "<input name='codigo' id='codigo' size='6' onKeyUp='buscaCodigo(value)' value='$valor' />&nbsp;<li class='fa fa-plus' style='color:#06F;cursor:pointer' title='Buscar' onclick='Consec();'><label id='cod' class='req' style='color:#F00'> </label>";
?>	
