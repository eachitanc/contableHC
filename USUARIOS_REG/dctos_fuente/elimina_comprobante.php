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
-->
</style>
<title>CONTAFACIL</title><body>

<? 
/*
include('config.php');

$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$s = "select * from fecha";
$r = mysql_db_query($database, $s, $connectionxx);

while($rx = mysql_fetch_array($r)) 
{
  $idxx=$rx["id_emp"];
}


$id_cuenta=$_GET['borrar'];
$sqlxx = "select * from adi_ppto_ing where id ='$id_cuenta' and id_emp='$idxx' ";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $cod_pptal=$rowxx["cod_pptal"];
}


$s2 = "select * from car_ppto_ing where cod_pptal ='$cod_pptal' and id_emp='$idxx' ";
$r2 = mysql_db_query($database, $s2, $connectionxx);

while($rx2 = mysql_fetch_array($r2)) 
{
  $pac=$rx2["pac"];
}

*/
?>

<? 
/*
if ($pac == 'NO')
{
*/
?>
<form action="confirma_borra_comprobante.php" method="POST" onSubmit="return confirm('Confirme la Accion')">
<div align="center"><br><br>
<span class="Estilo1">Esta a punto de eliminar el Comprobante, esta seguro?  </span>
  <input type="hidden" name="id" value="<?php $id1=$_GET['id']; printf("$id1"); ?>"><br>
  <br>
  <label>
  ...::: 
  <input name="Submit" type="submit" class="Estilo2" value="Confirmar">
  </label>
 :::...  
 <p class="Estilo3"><a href="dctos_fuente.php" target="_parent" class="Estilo1">CANCELAR</a></p>
</div>
</form>
<?
/*
}
else
{
*/
?>
<!--<div align="center"><BR><BR><BR>
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:550px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center" class="Estilo1"><strong><strong>- NO PUDE ELIMINAR ESTA ADICION -<BR><BR>
            LA CUENTA TIENE P.A.C DEFINIDO</strong></strong> CON ESTE VALOR </div>
          </div>
        </div>
      </div>
	  <div align="center"><BR><BR><BR>
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center" class="Estilo2"><a href="adi_ppto_ing.php" target="_parent">VOLVER</a></div>
          </div>
        </div>
      </div>-->
<?
/*}*/
?>

</body>
</html>
<?
}
?>