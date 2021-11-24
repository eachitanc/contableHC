<?
session_start();
if(!isset($_SESSION["login"]))
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


 <?

$id_ncon=$_GET['id']; 
$fecha =$_GET['fecha_c']; //echo $fecha;

?>

<form  method="POST" action="confirma_borra_coba.php" onSubmit="return confirm('Esta Accion eliminara la Informacion PERMANENTEMENTE, Desea Proceder?')">
<div align="center">
<div align="center"><br>
    <br>
    <span class="Estilo1">¿ Desea <b>Eliminar </b>la Consignacion Bancaria ?  </span>
  <br>
  <input type="hidden" name="id_ncon" value="<?php printf("%s",$id_ncon); ?>">
  <input type="hidden" name="fecha_c" value="<?php printf("%s",$fecha); ?>">

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

<center class='Estilo1'>
<form method='post' action='menu_cont.php'>
<input type='hidden' name='nn' value='COBA'>
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