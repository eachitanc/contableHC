<?php
include('../config.php');
// campos de ctrl del cambio
$datos=$_GET['datos'];
$datos2= split("-",$datos);
$consec =$datos2[0];
$cuenta=$datos2[1];
$fecha_marca =$datos2[2];
$dcto =$datos2[3];

$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "
update aux_conciliaciones set estado='SI',flag1='1',flag2='1',fecha_marca='$fecha_marca'
where consecutivo = '$consec' and cuenta ='$cuenta' and fecha_fin ='$fecha_marca' and dcto = '$dcto' ";
$resultado = $cx->query($sql);
echo $sql;


?>

