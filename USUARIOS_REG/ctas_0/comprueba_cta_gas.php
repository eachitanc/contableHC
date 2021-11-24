<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<?
include('../config.php');

//*** luis hillon

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

$usuarios = mysql_query("Select * from ctas0_gas  where cod_pptal_gas_apr  like '".$_REQUEST['cod']."%'   ",$conexion);

$num = mysql_num_rows($usuarios);


if ($num==0)
{
printf("<span class='Estilo5'>COD. INCORRECTO</span>");
}
else
{
		$sql2 = "Select * from ctas0_gas  where cod_pptal_gas_apr  like '".$_REQUEST['cod']."%'";
		$resultado2 = mysql_db_query($database, $sql2, $conexion);
		printf("<center><table>");
		while($row2 = mysql_fetch_array($resultado2)) 
		{
		  $cod_pptal_gas_apr =$row2["cod_pptal_gas_apr"];
		  $nom_pptal_gas_apr =$row2["nom_pptal_gas_apr"];
		   printf("<tr><td align='left'><span class='Estilo5'>%s&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
		               <td align='left'><span class='Estilo5'>%s</span></td></tr>",$cod_pptal_gas_apr,$nom_pptal_gas_apr);
		}
		printf("</center></table>");		
		
	
		

}
mysql_close($conexion);
?>
<?
}
?>

