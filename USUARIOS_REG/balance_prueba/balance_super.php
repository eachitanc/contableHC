<?
set_time_limit(600);
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
	/*
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=BALANCE_DE_PRUEBA.xls");
header("Pragma: no-cache");
header("Expires: 0");
*/
include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$sq ="select distinct homologacion from pgcp where homologacion != '' order by homologacion asc";
$re = mysql_query($sq,$cx);
while ($rw = mysql_fetch_array($re))
{
	$sq2= "select sum(saldo) as saldo from aux_contaduria_gral where cuenta_ant like '$rw[homologacion]%'";
	$re2 =mysql_query($sq2,$cx);
	$rw2 =mysql_fetch_array($re2);
	if ($rw2[saldo] != 0)
	echo $rw[homologacion].";".$rw2[saldo]."<br>";
}
}
?>