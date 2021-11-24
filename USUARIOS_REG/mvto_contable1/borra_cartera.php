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
$id1=$_GET['id2']; 
$fcierre=$_GET['fecha_c']; //echo $fcierre;
include('../config.php');

$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
  
}
				

$sqlxx2 = "select * from reip_ing where id_emp = '$id_emp' and consecutivo = '$id1'";
$resultadoxx2 = mysql_db_query($database, $sqlxx2, $connectionxx);
$a=0;
while($rowxx2 = mysql_fetch_array($resultadoxx2)) 
{
  $elim_cont=$rowxx2["elim_cont"];
  if($elim_cont == '0')
  {
    $a++;
  }
}

//**
$link = new mysqli($server, $dbuser, $dbpass, $database);
mysql_select_db($database, $link);
$result = mysql_query("select * from reip_ing where id_emp = '$id_emp' and consecutivo = '$id1'", $link);
$num_rows = mysql_num_rows($result);
//**




if($num_rows == $a)
{
?>

<form action="confirma_borra_cartera.php" method="POST" onSubmit="return confirm('Confirme la Accion')">
<div align="center"><br><br>
<span class="Estilo2">Esta a punto de <strong>ELIMINAR</strong> el registro, esta seguro?  </span>
  <input type="hidden" name="id" value="<?php printf("$id1"); ?>">
  <input type="hidden" name="fcierre" value="<?php printf("$fcierre"); ?>"><br>
  <br>
  <label>
  ...::: 
  <input name="Submit" type="submit" class="Estilo2" value="Confirmar">
  </label>
 :::...  
 <p class="Estilo3"><a href="menu_cont.php" target="_parent" class="Estilo1">CANCELAR</a></p>
</div>
</form>

</body>
</html>
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
            La Causacion de Cartera que intenta eliminar tiene Recaudos de Tesoreria Almacenados </span><br><br>
						  <?
printf("

<center class='Estilo2'>
<form method='post' action='menu_cont.php'>
<input type='hidden' name='nn' value='CAIC'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo2' /> :::...
</form>
</center>
");

?>
			 </div>
          </div>
        </div>
      </div>

<?
}
}
?>