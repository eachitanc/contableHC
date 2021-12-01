<?php
session_start();
if(!$_SESSION["login"])
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
$id_ceva = $_POST['id_ceva'];

include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
}

// Selecciono el pago que voy a anular la reversion
$sqlxx1 = "select * from ceva where id_emp ='$id_emp' and id_auto_ceva = '$id_ceva'";
$resultadoxx1 = $connectionxx->query($sqlxx1);

while($rowxx1 = $resultadoxx1->fetch_assoc()) 
{
  $id_auto_cobp=$rowxx1["id_auto_cobp"];
}
// establesco cual es el estado de la casilla pagado de cobp
$sql_e = "select * from cobp where id_auto_cobp='$id_auto_cobp'";
$res_e = mysql_db_query($database, $sql_e, $connectionxx);
while($row_e = mysql_fetch_array($res_e)) 
{
  $pagado=$row_e["pagado"];
  $tesoreria = $row_e["tesoreria"];
}
// Selecciono el ceva original del pago y la nota contable que se genero 
$sql_e2 = "select * from ceva where id_auto_ceva='$id_ceva'";
$res_e2 = mysql_db_query($database, $sql_e2, $connectionxx);
while($row_e2 = mysql_fetch_array($res_e2)) 
{
  $cobp=$row_e2["id_auto_cobp"];
  $ncon=$row_e2["id_ncon"];
}

if($pagado=='NO')
{
	new mysqli($server, $dbuser, $dbpass, $database);
	
	$sSQL="Delete From ceva Where id_auto_cobp ='$cobp' and estado != 'anulado'";
	mysql_query($sSQL);
	// Borro la nota cotable automatica de descontabilizacion
	$sSQLn="Delete From conta_ncon Where id_auto_ncon='$ncon' ";
	mysql_query($sSQLn);
	// 
	$aqlaceva="update ceva set estado='nada' where id_auto_cobp = '$id_auto_cobp' and estado='anulado'";
	$resulceva = mysql_db_query($database, $aqlaceva, $connectionxx);
	
	$sqla1 = "update obcg set pagado='SI' where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp'";
	$resultadoa1 = $connectionxx->query($sqla1);

if ($tesoreria == 'SI')
{
	$sqla2 = "update cobp set pagado='SI' where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp'";
	$resultadoa2 = $connectionxx->query($sqla2);
}else{
	$sqla2 = "update cobp set pagado='SI', contab='SI' where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp'";
	$resultadoa2 = $connectionxx->query($sqla2);
}
	printf("
	<br>
	<center class='Estilo8'>
	<b><span class='Estilo9'>REGISTRO ELIMINADO CON EXITO</span></b><BR><BR>
	<form method='post' action='pagos_anulados.php'>
	<input type='hidden' name='nn' value='CEVA'>
	<input type='submit' name='Submit' value='Volver' class='Estilo9' />
	</form>
	</center>
	");
}
else
{
	printf("
	<br>
	<center class='Estilo8'>
	<b><span class='Estilo9'>NO SE PUEDE ELIMINAR EL REGISTRO PUESTO QUE YA SE REALIZO EL PAGO</span></b><BR><BR>
	<form method='post' action='pagos_anulados.php'>
	<input type='hidden' name='nn' value='CEVA'>
	<input type='submit' name='Submit' value='Volver' class='Estilo9' />
	</form>
	</center>
	");
	
}

?>
<?php
}
?>