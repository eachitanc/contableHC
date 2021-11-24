<?
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
?>
<title>CONTAFACIL</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {font-size: 9px}
a {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:visited {
	color: #666666;
	text-decoration: none;
}
a:hover {
	color: #666666;
	text-decoration: underline;
}
a:active {
	color: #666666;
	text-decoration: none;
}
a:link {
	text-decoration: none;
}
.Estilo7 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 11px; color: #666666; }
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>

<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<?
include("../config.php");

$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
while($rowxx = mysql_fetch_array($resultadoxx)) 
{
$idxx=$rowxx["id_emp"];
}
		
	
$id =$_POST['id'];
$cuenta =$_POST['cuenta'];
$consecutivo =$_POST['consecutivo'];

//printf("id : %s<br>consecutivo : %s<br>cuenta : %s",$id,$consecutivo,$cuenta);


$sqla = "select * from reip_ing where id_emp ='$idxx' and id ='$id'";
$resultadoa = mysql_db_query($database, $sqla, $connectionxx);

while($rowa = mysql_fetch_array($resultadoa)) 
{
  $valor=$rowa["valor"];
  $saldo=$rowa["saldo"];
  $cuenta=$rowa["cuenta"];
  
}

$nuevo_saldo= $valor + $saldo;

$sqlx = "update reip_ing set saldo='$nuevo_saldo' where id_emp= '$idxx' and cuenta ='$cuenta' ";
$resultado = mysql_db_query($database, $sqlx, $connectionxx);

mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($database);
$sSQL="Delete From reip_ing Where id='$id' and id_emp ='$idxx'";
mysql_query($sSQL);


printf("
<br>
<center class='Estilo4'>
Imputacion <b>ELIMINADA</b> con Exito<br><br>
<form method='post' action='confirma_borra_mvto.php'>
<input type='hidden' name='consecutivo' value='%s'>
<input type='submit' name='Submit' value='Volver' class='Estilo4' />
</form>
</center>
",$consecutivo);

?>
<?
}
?>