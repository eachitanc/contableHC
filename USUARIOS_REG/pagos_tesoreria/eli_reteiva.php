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
$id = $_GET['id4'];
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);
while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
}
$sqlx = "select * from reteiva where id ='$id'";
$resx = $connectionxx->query($sqlx);
while($rowx = $resx->fetch_assoc()) 
{
  $concepto=$rowx["concepto"]; 
}
$sqx = "select * from cecp where reteiva = '$concepto'";
$resx = $connectionxx->query($sqx);
$maxi = $resx->num_rows; 
if ($maxi >0){$cont=1;}
$sq2 = "select * from ceva where reteiva = '$concepto'";
$res = $connectionxx->query($sq2);
$exi = $res->num_rows; 
if ($exi>0){$cont++;}
if ($cont ==0)
{
new mysqli($server, $dbuser, $dbpass, $database);

$sSQL="Delete from reteiva Where id ='$id'";
mysql_query($sSQL);
printf("
<br><br>
<center class='Estilo8'>
<b><span class='Estilo9'>REGISTRO ELIMINADO CON EXITO</span></b><BR><BR>
<form method='post' action='desctos.php'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
");
}else{
printf("
<br><br>
<center class='Estilo8'>
<b><span class='Estilo9'>LA RETENCION YA HA SIDO UTILIZADA - NO SE PUEDE ELIMINAR</span></b><BR><BR>
<form method='post' action='desctos.php'>
<input type='submit' name='Submit' value='Volver' class='Estilo9' />
</form>
</center>
");
}
}
?>