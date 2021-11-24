<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=latin1'); 
include('../../config.php');
$bodega = $_GET["bodega"];
$articulo = $_GET["articulo"];
$conn = new mysqli($server, $dbuser, $dbpass, $database);

$sql = "update farma_temp set bodega ='$bodega'";
$rsd = mysql_query($sql);
$sq2 = "update farma_temp set producto ='$articulo'";
$rs2 = mysql_query($sq2);
?>
