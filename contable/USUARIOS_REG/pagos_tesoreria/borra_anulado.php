<?
session_start();
if(!$_SESSION["login"])
{
header("Location: ../login.php");
exit;
} else {
?>
<html>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	
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
-->
</style>
<title>CONTAFACIL</title><body>

<div align="center">
  <?

$id_ceva=$_GET['id_ceva']; 

include('../config.php');				
$connectionxx = mysql_connect($server, $dbuser, $dbpass) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}

?>
</div>
<form  method="POST" action="confirma_borra_ceva_anulado.php" onSubmit="return confirm('Esta Accion eliminara la Informacion PERMANENTEMENTE, Desea Proceder?')">
<div align="center"> 
<div align="center"><br>
    <br>
    <span class="Estilo1">¿ Desea <b>Eliminar </b>el Comprobante de Egreso Vigencia Actual ?  </span>
  <br>
  <input type="hidden" name="id_ceva" value="<?php printf("%s",$id_ceva); ?>">
  
  <br>
  <br>
  
  
  ...:::   
  <input name="Submit" type="submit" class="Estilo2" value="Confirmar"> 
  :::...  
  <br>
  <br>
  
</div>
</form>

<div align="center">
  <?
printf("

<center class='Estilo9'>
<form method='post' action='pagos_anulados.php'>
<input type='hidden' name='nn' value='CEVA'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo2' /> :::...
</form>
</center>
");

?>
</div>
</body>
</html>
<?
}
?>