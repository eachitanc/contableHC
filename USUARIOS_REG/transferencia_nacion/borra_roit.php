<?php
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

<form action="confirma_borra_roit.php" method="POST">
<div align="center"><br><br>
<span class="Estilo1">� Desea iniciar el proceso de <b>Eliminacion - Modificacion</b> del Recibo de Caja General ?  </span>
  <br>
  <input type="hidden" name="id_recau" value="<?php $id_recau=$_GET['id_recau']; printf("$id_recau"); ?>">
  <br>
  <br>

  
  ...:::   <input name="Submit" type="submit" class="Estilo2" value="Confirmar"> :::...  
  <br>
  <br>
 <a href="../recaudos_tesoreria/recaudos_tesoreria.php" target="_parent" class="Estilo1"><b>...::: CANCELAR :::...<b></a></div>
</form>

</body>
</html>
<?php
}
?>