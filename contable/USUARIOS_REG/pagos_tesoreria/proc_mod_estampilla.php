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

include('../config.php');
// conexion				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");

//********** primera llegada para validacion
$auto = $_POST['auto'];
$manu = $_POST['manu'];

if($auto == '')
{
$auto = 'NO' ;
$manu = 'SI' ;
}
else
{
$auto = 'SI' ;
$manu = 'NO' ;
}

$sql = "update modo_estampillas set auto='$auto',manu='$manu'";
$resultado = mysql_db_query($database, $sql, $connectionxx);

?>
<script type="text/javascript"> 
window.location="desctos.php"; 
</script>
<?
}
?>