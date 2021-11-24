<?
session_start();
if(!session_is_registered("login"))
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

$id_obcg=$_GET['id2']; 

include('../config.php');				
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}

$sqlxx1q = "select * from obcg where id_emp ='$id_emp' and id_auto_obcg ='$id_obcg'";
$resultadoxx1q = mysql_db_query($database, $sqlxx1q, $connectionxx);

while($rowxx1q = mysql_fetch_array($resultadoxx1q)) 
{
  $id_auto_cobp=$rowxx1q["id_auto_cobp"];
}

$link = new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database, $link);
$result = mysql_query("select * from ceva where id_emp = '$id_emp' and id_auto_cobp = '$id_auto_cobp'", $link);
$num_rows = mysql_num_rows($result);


if($num_rows != 0)
{
printf("<br><br><center class='Estilo1'>Esta OBCG tiene pagos registrados en Tesoreria<br><br>por lo tanto<br><br><b>NO PUEDE SER ELIMINADA</b>");
}
else
{

?>
</div>
<form  method="POST" action="confirma_borra_obcg.php" onSubmit="return confirm('Esta Accion eliminara la Informacion PERMANENTEMENTE, Desea Proceder?')">
<div align="center">
<div align="center"><br>
    <br>
    <span class="Estilo1">� Desea <b>Eliminar </b>la Obligacion Contable del Gasto ?  </span>
  <br>
  <input type="hidden" name="id_obcg" value="<?php printf("%s",$id_obcg); ?>">

  <br>
  <br>
  
  
  ...:::   
  <input name="Submit" type="submit" class="Estilo2" value="Confirmar"> 
  :::...  
  <br>
  <br>
  
</div>
</form>
<?
}//cierra else
?>
<div align="center">
  <?
printf("

<center class='Estilo1'>
<form method='post' action='menu_cont.php'>
<input type='hidden' name='nn' value='OBCG'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo1' /> :::...
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