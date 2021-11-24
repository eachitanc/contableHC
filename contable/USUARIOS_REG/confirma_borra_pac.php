<?
session_start();
if(!session_is_registered("login"))
{
header("Location: login.php");
exit;
} else {
?>
<?php
include("config.php");
 
$id=$_POST['id'];

// saco el id de la empresa
   $connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
	    $sqlxx = "select * from fecha";
	    $resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);
	    while($rowxx = mysql_fetch_array($resultadoxx)) 
  	    {
     	 $idxx=$rowxx["id_emp"];
		  $id_emp=$rowxx["id_emp"];
    	}
		
mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($database);
$sSQL2="Update car_ppto_ing Set pac='NO' , afectado_otros='0' Where cod_pptal = '$id' and id_emp ='$id_emp'";
mysql_query($sSQL2);

mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($database);
$sSQL="Delete From pac_ingresos Where cod_pptal='$id' and id_emp ='$idxx'";
mysql_query($sSQL);

					printf("
<center class='Estilo4'><br><br><b>PAC ELIMINADO CON EXITO</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='consulta_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>");



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