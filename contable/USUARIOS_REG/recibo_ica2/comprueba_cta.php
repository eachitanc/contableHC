<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #006600;
}
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #990000;
	font-weight: bold;
}
-->
</style>
<?
include('../config.php');

//*** luis hillon

$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
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

$usuarios = mysql_query("Select * from pgcp where id_emp ='$id_emp' and tip_dato = 'D' and cod_pptal = '".$_REQUEST['cod']."'",$conexion);

$num = mysql_num_rows($usuarios);

if ($num==0)
{
printf("<span class='Estilo2'>COD. INCORRECTO</span>");
}
else
{
		$sql2 = "Select * from pgcp where id_emp ='$id_emp' and tip_dato = 'D' and cod_pptal = '".$_REQUEST['cod']."'";
		$resultado2 = mysql_db_query($database, $sql2, $conexion);
		
		while($row2 = mysql_fetch_array($resultado2)) 
		{
		  $nom_rubro=$row2["nom_rubro"];
		}
		printf("<span class='Estilo1'>%s</span>",$nom_rubro);
}
mysql_close($conexion);
?>
<?
}
?>

