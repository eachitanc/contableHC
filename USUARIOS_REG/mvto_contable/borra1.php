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
$id_recau = $_POST['id_recau'];
$fecha_c=$_POST['fecha_c']; //echo $fecha_c;
include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}
new mysqli($server, $dbuser, $dbpass, $database);


$sqlf="select * from vf";
$resf=mysql_db_query($database,$sqlf,$connectionxx);
$rowf=mysql_fetch_array($resf);
$fecha_cierre=$rowf["fecha_ini"]; //echo $fecha_cierre;
if($fecha_c<=$fecha_cierre)		
		{
			printf("
			<center class='Estilo4'><br><br>La Fecha de registro 
			<b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
			</center>");
			
			printf("
			<br>
			<center class='Estilo8'>
			
			<form method='post' action='../mvto_contable/menu_cont.php'>
			<input type='hidden' name='nn' value='NCON'>
			<input type='submit' name='Submit' value='Volver' class='Estilo9' />
			</form>
			</center>
			");
		}
		else
		{

			$sSQL2="Delete From lib_aux2 Where id_auto ='$id_recau'";
			mysql_query($sSQL2);
			
			printf("
			<br>
			<center class='Estilo8'>
			<b><span class='Estilo9'>REGISTRO ELIMINADO CON EXITO</span></b><BR><BR>
			<form method='post' action='../mvto_contable/menu_cont.php'>
			<input type='hidden' name='nn' value='NCON'>
			<input type='submit' name='Submit' value='Volver' class='Estilo9' />
			</form>
			</center>
			");
		}
?>
<?
}
?>