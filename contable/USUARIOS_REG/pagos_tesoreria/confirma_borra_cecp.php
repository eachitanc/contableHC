<?
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
<?

$id_cecp=$_GET['id1'];
$fecha_c=$_GET['fechac']; //echo $fecha_c;

include('../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}

$consultax=mysql_query("select * from vf ",$connectionxx);
while($rowx = mysql_fetch_array($consultax)) 
{	 $ax=$rowx["fecha_ini"]; //echo $ax;
	 $bx=$rowx["fecha_fin"]; //echo $bx;
} 

if( $fecha_c > $bx || $fecha_c < $ax )
{
	
	printf("
			<center class='Estilo4'><br><br>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
			</center>");

		printf("

			<center class='Estilo4'>
			<form method='post' action='pagos_tesoreria_cxp.php'>
			<input type='hidden' name='nn' value='CECP'>
			...::: <input type='submit' name='Submit' value='Volver' class='Estilo9' /> :::...
			</form>
			</center>
			");

///**********************
}
else
{



		mysql_connect($server, $dbuser, $dbpass);
		mysql_select_db($database);
		$sSQL="Delete From cecp Where id_emp='$id_emp' and id_auto_cecp ='$id_cecp'";
		mysql_query($sSQL);
		
		// borro los datos guardados para remplazar con las modificaciones
		$consulta = "DELETE  FROM cecp_cuenta WHERE id_auto_cecp = '$id_cecp'";
		$result = mysql_db_query($database, $consulta,$connectionxx);
		
		printf("
		<br>
		<center class='Estilo8'>
		<b><span class='Estilo9'>REGISTRO ELIMINADO CON EXITO</span></b><BR><BR>
		<form method='post' action='pagos_tesoreria_cxp.php'>
		<input type='hidden' name='nn' value='CECP'>
		<input type='submit' name='Submit' value='Volver' class='Estilo9' />
		</form>
		</center>
		");
}

?>
<?
}
?>