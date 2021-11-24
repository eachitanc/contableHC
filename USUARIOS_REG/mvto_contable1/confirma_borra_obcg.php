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
$id_obcg = $_POST['id_obcg'];
//printf("%s",$id_obcg);

include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}   

//printf("%s",$id_emp);

$sqlxx2 = "select * from obcg where id_emp ='$id_emp' and id_auto_obcg='$id_obcg'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);

while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
  $id_auto_cobp=$rowxx2["id_auto_cobp"];
}   
//printf("%s",$id_auto_cobp);

$sqlx = "update cobp set contab='NO' where id_emp= '$id_emp' and id_auto_cobp ='$id_auto_cobp' ";
$resultado = mysql_db_query($database, $sqlx, $connectionxx);

new mysqli($server, $dbuser, $dbpass, $database);

$sSQL="Delete From obcg Where id_emp='$id_emp' and id_auto_obcg ='$id_obcg'";
mysql_query($sSQL);


printf("

<center class='Estilo9'>
<br><br>REGISTRO ELIMINADO CON EXITO<BR><BR>
<form method='post' action='menu_cont.php'>
<input type='hidden' name='nn' value='OBCG'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo9' /> :::...
</form>
</center>
");

?>
<?
}
?>