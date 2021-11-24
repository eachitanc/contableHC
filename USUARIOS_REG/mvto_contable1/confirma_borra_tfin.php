<?
session_start();
if(!isset($_SESSION["login"]))
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
$id_ncon = $_POST['id_ncon'];
$fecha_c=$_POST['fecha_c']; //echo $fecha_c;
//printf("%s",$id_obcg);

include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}  


		$sqlf="select * from vf";
		$resf=mysql_db_query($database,$sqlf,$connectionxx);
		$rowf=mysql_fetch_array($resf);
		$fecha_cierre=$rowf["fecha_ini"];
		//echo $fecha_cierre;
		
		if($fecha_c<=$fecha_cierre)		
		{
			printf("
			<center class='Estilo4'><br><br>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
			</center>");

			printf("

			<center class='Estilo4'>
			<form method='post' action='menu_cont.php'>
			<input type='hidden' name='nn' value='TFIN'>
			...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
			</form>
			</center>
			");

			
		}
		else
		{
 
			
			new mysqli($server, $dbuser, $dbpass, $database);
			
			$sSQL="Delete From conta_tfin Where id_emp='$id_emp' and id_auto_ncon ='$id_ncon'";
			mysql_query($sSQL);
			
			
			printf("
			
			<center class='Estilo9'>
			<br><br>REGISTRO ELIMINADO CON EXITO<BR><BR>
			<form method='post' action='menu_cont.php'>
			<input type='hidden' name='nn' value='TFIN'>
			...::: <input type='submit' name='Submit' value='Volver' class='Estilo9' /> :::...
			</form>
			</center>
			");
		}

?>
<?
}
?>