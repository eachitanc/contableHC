<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: login.php");
exit;
} else {
?>
<html>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #FF0000; }
-->
</style>
<title>CONTAFACIL</title><body>

<? 

include('../config.php');
$id1=$_GET['id'];

$link = new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database, $link);
$result = mysql_query("SELECT * FROM car_ppto_ing WHERE id_emp ='$id1'", $link);
$num_rows = mysql_num_rows($result);

$result2 = mysql_query("SELECT * FROM car_ppto_gas WHERE id_emp ='$id1'", $link);
$num_rows2 = mysql_num_rows($result2);

if ($num_rows == 0 and $num_rows2 == 0 )
{
?>
<form action="confirma_eli_empresa.php" method="POST" onSubmit="return confirm('Confirme la Accion')">
<div align="center"><br><br>
<span class="Estilo1">Esta a punto de eliminar la empresa, esta seguro?  </span>
  <input type="hidden" name="id" value="<?php $id1=$_GET['id']; printf("$id1"); ?>"><br>
  <br>
  <label>
  ...::: 
  <input name="Submit" type="submit" class="Estilo2" value="Confirmar">
  </label>
 :::...  
 <p class="Estilo3"><a href="../crear_empresa.php">CANCELAR</a></p>
</div>
</form>
<?
}
else
{
?>
   <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:300px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><span class="Estilo5">ERROR</span><br><BR>
              <span class="Estilo2">No puede Ejecutar esta Accion<br>
            La Empresa que intenta eliminar tiene Datos Contables Almacenados </span><br><br><a href='../crear_empresa.php' target='_parent' class="Estilo1">VOLVER </a> </div>
          </div>
        </div>
      </div>
<? 
}
?>

</body>
</html>
<?
}
?>