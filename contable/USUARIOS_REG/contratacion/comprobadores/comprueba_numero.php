<?
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	$codigo_evento =$_GET['cod'];
	
	include('../../config.php');		
	$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
	mysql_select_db($database); 
	
	$val = mysql_query("select num_acto from postcontratacion where num_acto ='$codigo_evento'", $cx);
	
	$num = mysql_num_rows($val);
		
	if ($num==0)
	{
	printf("");
	}
	else
	{
printf("<font color ='#FF0000'>Ya utilizado</font>");
	}
	mysql_close($cx);
	
?>