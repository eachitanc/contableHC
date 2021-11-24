<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=latin1'); 
include('../../config.php');
$bodega = $_GET["bodega"];
$articulo = $_GET["articulo"];
$conn = new mysqli($server, $dbuser, $dbpass, $database);

//Consulto si existe el registro del usuario
$sq ="select * from farma_temp where login='$_SESSION[user]'";
$re =mysql_query($sq);
$fil =mysql_num_rows($re);
if ($fil >0)
{
$sql = "update farma_temp set bodega ='$bodega',producto='$articulo',login='$_SESSION[user]' where login='$_SESSION[user]'";
$rsd = mysql_query($sql);
}else{
$sq3 ="insert into farma_temp (bodega,producto,login) values('$bodega','$articulo','$_SESSION[user]');";	
$re3 = mysql_query($sq3);		
}
?>
