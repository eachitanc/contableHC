<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
include('../config.php');
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}

$servidor = $server;
$usuario = $dbuser;
$password = $dbpass;

$conexion = mysql_connect($servidor, $usuario, $password) or die("no se pudo conectar a base de datos".mysql_error());

$selec = mysql_select_db($database,$conexion);

$usuarios = mysql_query("Select * from cobp where id_emp ='$id_emp' and id_manu_cobp = '".COBP.$_REQUEST['cod']."'",$conexion);

$num = mysql_num_rows($usuarios);

if ($num==0)
{
}
else
{
echo("<font color ='#FF0000'>COD. YA UTILIZADO</font>");
}
mysql_close($conexion);
?>
<?
}
?>

