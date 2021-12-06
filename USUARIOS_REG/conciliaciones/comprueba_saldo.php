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

$servidor = $server;
$usuario = $dbuser;
$password = $dbpass;

$conexion = mysql_connect($servidor, $usuario, $password) or die("no se pudo conectar a base de datos".mysql_error());

$selec = mysql_select_db($database,$conexion);

$usuarios = mysql_query("Select * from aux_conciliaciones where fecha_fin ='".$_REQUEST['cod']."' and cuenta ='".$_REQUEST['cod1']."'",$conexion);

$num = mysql_num_rows($usuarios);

if ($num==0)
{
printf("EL SALDO ES 0");
}
else
{
		$sql2 = "Select * from aux_conciliaciones where fecha_fin ='".$_REQUEST['cod']."' and cuenta ='".$_REQUEST['cod1']."'";
		$resultado2 = mysql_db_query($database, $sql2, $conexion);
		
		while($row2 = mysql_fetch_array($resultado2)) 
		{
		  $saldo_extracto=$row2["saldo_extracto"];
		}
		printf("%s",$saldo_extracto);
}
mysql_close($conexion);
?>
<?php
}
?>

