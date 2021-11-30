<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<style type="text/css">
<!--
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: underline;
	color: #666666;
}
a:active {
	text-decoration: none;
	color: #666666;
}
.Estilo9 {font-size: 10px; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;}
-->
</style>
<?php
$id = $_POST['id'];
$id_reip = $_POST['id_reip'];
$id_caic = $_POST['id_caic'];
$id_recau = $_POST['id_recau'];
$cuenta = $_POST['cuenta'];
$nombre = $_POST['nombre'];

/*printf("

id : %s <br> id_reip : %s <br> id_caic : %s <br> id_recau : %s <br> cuenta : %s <br> nombre : %s

",
$id ,$id_reip, $id_caic, $id_recau, $cuenta ,$nombre 
);*/

include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
}


// 1. actualizar caic = NO - cartera cont

$sql = "update cartera_cont set recaudado='NO' where id_emp='$id_emp' and consec_cartera ='$id_caic' ";
$resultado = mysql_db_query($database, $sql, $connectionxx);

// 2. tomar vr digitado de recaudo roit

$sql2 = "select * from recaudo_roit where id_emp='$id_emp' and id ='$id'";
$resultado2 = mysql_db_query($database, $sql2, $connectionxx);

while($rw2 = mysql_fetch_array($resultado2)) 
{
  $vr_digitado=$rw2["vr_digitado"];
  $id_unico_reip=$rw2["id_unico_reip"];
}

// 3. saco el total digitado de reip_ing

$sql3 = "select * from reip_ing where id_emp='$id_emp' and id ='$id_unico_reip'";
$resultado3 = mysql_db_query($database, $sql3, $connectionxx);

while($rw3= mysql_fetch_array($resultado3)) 
{
  $vr_recaudado=$rw3["vr_recaudado"];
 
}

// 4. calculo el nuevo vr recaudado - reip ing

$new_vr_recaudado = $vr_recaudado - $vr_digitado;

// 5 actualizo vr recaudado - reip ing

$sql4 = "update reip_ing set vr_recaudado='$new_vr_recaudado' where id_emp='$id_emp' and id ='$id_unico_reip' ";
$resultado4 = mysql_db_query($database, $sql4, $connectionxx);

// 6 actualizo recaudo completo - reip ing

$sql5 = "update reip_ing set recaudo_completo='NO' where id_emp='$id_emp' and id ='$id_unico_reip' ";
$resultado5 = mysql_db_query($database, $sql5, $connectionxx);

// 7 elimino de recaudo roit el seleccionado

new mysqli($server, $dbuser, $dbpass, $database);

$sSQL="Delete From recaudo_roit Where id_emp='$id_emp' and id ='$id'";
mysql_query($sSQL);

// 8 actualizo reip_ing si no hay mas caic
	$sql10 = "select * from recaudo_roit where id_caic='$id_caic' and id_emp='$id_emp'";
	$result10 = mysql_db_query($database, $sql10, $connectionxx) or die(mysql_error());
	if (mysql_num_rows($result10) == 0)
	{
	    $sql11 = "update reip_ing set elim_cont='0' where id_emp='$id_emp' and consecutivo ='$id_reip' ";
		$resultado11 = mysql_db_query($database, $sql11, $connectionxx);
	}


// mensaje de confirmacion

printf("
<br>
<center class='Estilo8'>
<b><span class='Estilo9'>REGISTRO ELIMINADO CON EXITO</span></b><BR><BR>
<form method='post' action='confirma_borra_roit.php'>
<input type='hidden' name='id_recau' value='%s'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
",$id_recau);

?>
<?php
}
?>