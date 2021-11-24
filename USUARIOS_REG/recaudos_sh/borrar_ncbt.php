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
<style type="text/css">
<!--
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
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
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
-->
</style>
<?
include('../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass)or die ("Conexion no Exitosa");
mysql_select_db( "$database"); 

	
$id = $_POST['id'];
$id_recau=$_POST['id_recau2'];
$sqe="delete from recaudo_ncbt where id= '$id'";
$resultado10 = mysql_query($sqe, $cx);

?>
<center class='Estilo4'>
<a href="confirma_borra_roit.php?id_recau2=<? printf("%s",$id_recau); ?>">...::: VOLVER :::...</a>
</center>
<?
}
?>