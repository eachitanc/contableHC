<?
header("Cache-Control: no-store, no-cache, must-revalidate"); 
	
	$codigo_pptal =$_REQUEST['cod'];
	
	include('../../config.php');		
	$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
	mysql_select_db($database); 
	
	$val = mysql_query("select ppto_aprob from car_ppto_gas where cod_pptal ='$codigo_pptal'", $cx);
	while ($row = mysql_fetch_array($val))
	{ 
	$ppto_aprob = $row["ppto_aprob"];
	$valor_aprob2=number_format($ppto_aprob,2,",",".");
	echo "$ppto_aprob";
	}
	
?>