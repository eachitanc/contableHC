<?php
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
<?php
include('../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass)or die ("Conexion no Exitosa");
mysql_select_db( "$database"); 

	
$id = $_POST['id'];
$fecha_c=$_POST['fecha_c']; //echo $fecha_c;
$id_recau=$_POST['id_recau2'];

$sqlf="select * from vf";
$resf=mysql_db_query($database,$sqlf,$cx);
$rowf=mysql_fetch_array($resf);
$fecha_cierre=$rowf["fecha_ini"];// echo $fecha_cierre;
if($fecha_c<=$fecha_cierre)		
{
	printf("
			<center class='Estilo4'><br><br>La Fecha de registro <b>NO</b> 
			se encuentra dentro de la Vigencia Fiscal Actual<br><br>
			</center>");
	printf("
			<center class='Estilo4'>
<a href=\"confirma_borra_roit.php?id_recau2=%s\">...::: VOLVER :::...</a>
</center>	
	",$id_recau);
			
}
else
{
	printf("
			<center class='Estilo4'>
<a href=\"confirma_borra_roit.php?id_recau2=%s\">...::: VOLVER :::...</a>
</center>	
	",$id_recau);
	$sqe="delete from recaudo_rcgt where id= '$id'";
$resultado10 = mysql_query($sqe, $cx);

}




?>

<?php
}
?>