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
$id = $_GET['id6'];
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
}
$sqlx = "select * from estampillas where id ='$id'";
$resx = mysql_db_query($database, $sqlx, $connectionxx);
while($rowx = mysql_fetch_array($resx)) 
{
  $concepto=$rowx["concepto"]; 
}
for ($i=1; $i<6;$i++)
{
	$sqx = "select * from cecp where estampilla$i = '$concepto'";
	$resx = mysql_db_query($database, $sqx, $connectionxx);
	$maxi = mysql_num_rows($resx); 
	if ($maxi >0){$cont=1;}
	$sq2 = "select * from ceva where estampilla$i = '$concepto'";
	$res = mysql_db_query($database, $sq2, $connectionxx);
	$exi = mysql_num_rows($res); 
	if ($exi>0){$cont++;}
}
if ($cont ==0)
	{
	new mysqli($server, $dbuser, $dbpass, $database);
	
	$sSQL="Delete From estampillas Where id ='$id'";
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
	<b><span class='Estilo9'>LA ESTAMPILLA YA HA SIDO UTILIZADA - NO SE PUEDE ELIMINAR</span></b><BR><BR>
	<form method='post' action='desctos.php'>
	<input type='submit' name='Submit' value='Volver' class='Estilo9' />
	</form>
	</center>
	");
    }
}
?>