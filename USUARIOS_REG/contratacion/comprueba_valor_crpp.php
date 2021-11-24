<?
	
	$codigo_crpp =$_GET['cod'];
	
	include('../config.php');		
	$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
	 
	
	$val = mysql_query("select sum(vr_digitado) as valor  from crpp where id_manu_crpp ='$codigo_crpp'", $cx);
	while ($row = mysql_fetch_array($val))
	{ 
	$valor_crpp = $row["valor"];
	$valor_crpp2=number_format($valor_crpp,2,",",".");
	echo "$valor_crpp2";
	}
?>