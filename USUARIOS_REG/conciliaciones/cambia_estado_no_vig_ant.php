<?php
include('../config.php');
//*** los campos del encabezado
$datos=$_GET['datos'];
$datos2= split("_",$datos);
$cuenta=$datos2[1];
$dcto =$datos2[0];
$fecha_marca =$datos2[2];
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sql = "
update aux_conciliaciones_vig_ant set estado='NO',flag1='0',flag2='0',fecha_marca=''
where 
dcto ='$dcto' and cuenta ='$cuenta'";
$resultado = $cx->query($sql);
	echo $sql;	
?>


