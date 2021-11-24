<?php 
 
function busca_terceros($doc) {
include('../config.php');
$cx2= mysql_connect($server,$dbuser,$dbpass) or die("No se puede conectar con la base de datos...");


$rs2=mysql_query("select num_id,nombre from z_terceros where num_id ='$doc'",$cx2) or die (mysql_error());
$rw2=mysql_fetch_array($rs2);
$fi2=mysql_num_rows($rs2);
if ($fi2 >0)
{
	$datos = $rw2['num_id'].",".$rw2['nombre'];
	return $datos;	
}
//mysql_close($cx2);
}
?> 
