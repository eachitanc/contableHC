<?php
include('../config.php');

// campos de ctrl del cambio
$datos=$_GET['datos'];
$datos2= split("-",$datos);
$consec =$datos2[0];
$cuenta=$datos2[1];
$fecha_marca =$datos2[2];
$dcto =$datos2[3];

$cx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "
update aux_conciliaciones set estado='NO',flag1='0',flag2='0',fecha_marca=''
where consecutivo = '$consec' and cuenta ='$cuenta' and dcto ='$dcto'";
$resultado = mysql_db_query($database, $sql, $cx);

?>