<?php
// Control para forzar a no utilizar memoria chache *** para que ajax no devuelva la ultima peticion cargada
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$cx);
// buscar pais / provincia y casa
$sq3 = "select pais_nombre  from pais where pais_id  ='$_SESSION[pais]'";
$rs3 = mysql_query($sq3);
$rw3 = mysql_fetch_array($rs3);
$sq4 = "select provincias_nombre  from provincias where provincias_id  ='$_SESSION[provincia]'";
$rs4 = mysql_query($sq4);
$rw4 = mysql_fetch_array($rs4);
$sq5 = "select comunidad_nombre   from comunidad  where comunidad_id   ='$_SESSION[comunidad]'";
$rs5 = mysql_query($sq5);
$rw5 = mysql_fetch_array($rs5);

 echo "<i class='fa fa-user'></i> &nbsp;". $_SESSION["nombre"].'&nbsp;/ '.  strtoupper($rw5["comunidad_nombre"]). '&nbsp;/ '. $_SESSION["vigencia"]. '&nbsp; '; 
?>
