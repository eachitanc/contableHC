<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: login.php");
exit;
} else {
?>
<?php
include("../config.php");
 
$id=$_POST['id'];
   
//Conexion con la base
new mysqli($server, $dbuser, $dbpass, $database);
//selecci�n de la base de datos con la que vamos a trabajar

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Delete From empresa Where cod_emp='$id'";
mysql_query($sSQL);
//me largo de aca
header("Location: ../crear_empresa.php");
?>
<?
}
?>