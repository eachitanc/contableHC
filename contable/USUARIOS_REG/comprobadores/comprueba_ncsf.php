<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<?
include('../config.php');
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}
$usuarios = mysql_query("Select * from lib_aux4 where dcto = '".'NCSF'.$_REQUEST['cod']."'",$connectionxx);

$num = mysql_num_rows($usuarios);

if ($num==0)
{
printf("<font color ='#006600'><b>...::: DISPONIBLE :::...</b></font>");
}
else
{
printf("<font color ='#FF0000'>COD. YA UTILIZADO</font>");
}
mysql_close($connectionxx);
?>
<?
}
?>