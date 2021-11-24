<?
session_start();
if(!session_is_registered("login"))
{
header("Location: login.php");
exit;
} else {
?>
<HTML>
<HEAD>
<TITLE>CONTAFACIL ...::: Cambiar Password  :::...</TITLE>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
-->
</style>
</HEAD>
<BODY>
<?
include('config.php');
//Conexion con la base
new mysqli($server, $dbuser, $dbpass, $database);
//selecci�n de la base de datos con la que vamos a trabajar


$name = $_SESSION["login"];
$new = sha1(md5(trim($_POST['new'])));
//Creamos la sentencia SQL y la ejecutamos
$sSQL="Update usuarios2 Set password='$new' Where login='$name'";
mysql_query($sSQL);
?>

<h1>
  <div align="center" class="Estilo1">CLAVE ACTUALIZADA </div>
</h1>
<div align="center" class="Estilo1"><a href="user.php" target="_parent">volver</a></div>
</BODY>
</HTML>
<?
}
?>