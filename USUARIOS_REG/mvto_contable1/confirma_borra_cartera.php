<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<?php
include("../config.php");
 
$id_reip=$_POST['id'];
$fcierre=$_POST['fcierre'];// echo $fcierre;

// saco el id de la empresa
   $connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
	    $sqlxx = "select * from fecha";
	    $resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
	    while($rowxx = mysql_fetch_array($resultadoxx)) 
  	    {
     	 $idxx=$rowxx["id_emp"];
    	}
		
		$sqlf="select * from vf";
		$resf=mysql_db_query($database,$sqlf,$connectionxx);
		$rowf=mysql_fetch_array($resf);
		$fecha_cierre=$rowf["fecha_ini"];
		//echo $fecha_cierre;
		
		if($fcierre<=$fecha_cierre)		
		{
			printf("
			<center class='Estilo4'><br><br>La Fecha de registro <b>NO</b> se encuentra dentro de la Vigencia Fiscal Actual<br><br>
			</center>");

			printf("

			<center class='Estilo4'>
			<form method='post' action='menu_cont.php'>
			<input type='hidden' name='nn' value='CAIC'>
			...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
			</form>
			</center>
			");

			
		}
		else
		{

$sqlx = "update reip_ing set contab='NO' where id_emp= '$idxx' and consecutivo ='$id_reip' ";
$resultado = mysql_db_query($database, $sqlx, $connectionxx);

new mysqli($server, $dbuser, $dbpass, $database);

$sSQL="Delete From cartera_cont Where id_reip='$id_reip' and id_emp ='$idxx'";
mysql_query($sSQL);

					printf("
<center class='Estilo4'><br><br><b>REGISTRO ELIMINADO CON EXITO</B><br><br>
</center>");

printf("

<center class='Estilo4'>
<form method='post' action='menu_cont.php'>
<input type='hidden' name='nn' value='CAIC'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
</form>
</center>
");
		}

?>
<?
}
?><title>CONTAFACIL</title>
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