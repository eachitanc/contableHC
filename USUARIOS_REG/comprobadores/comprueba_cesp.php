<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<?php
include('../config.php');

//*** luis hillon

$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = $connectionxx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
}

$servidor = $server;
$usuario = $dbuser;
$password = $dbpass;

$conexion = new mysqli($server, $dbuser, $dbpass, $database) or die("no se pudo conectar a base de datos".mysql_error());

$selec = mysql_select_db($database,$conexion);

$usuarios = mysql_query("Select * from conta_cesp where id_emp ='$id_emp' and id_manu_ncon = '".CESP.$_REQUEST['cod']."'",$conexion);

$num = mysql_num_rows($usuarios);

if ($num==0)
{
printf("<font color ='#006600'><b>...::: DISPONIBLE :::...</b></font>");
}
else
{
printf("<font color ='#FF0000'>COD. YA UTILIZADO</font>");
}
mysql_close($conexion);
?>
<?php
}
?>
