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



<?php 
/*
if ($pac == 'NO')
{
*/
 
include('../../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
//echo $_GET['borrar'];
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);

while($rowxx = $resultadoxx->fetch_assoc()) 
{

$fecha_s=$rowxx["ano"];
$mes_s =  substr($fecha_s,5,-3); 

}


$fecha_a =$_GET["fecha_a"]; 
$mes_a =  substr($fecha_a,5,-3);
 

if ($mes_a <> $mes_s )
{
 	?>
	<script> 
	alert ("La fecha de sesi�n no coincide con la fecha del registro a eliminar... Primero cambie la fecha de sesi�n");
	history.back(1)
	</script>
	<?php
}
?>
<form action="confirma_borra_red_ppto_ing.php" method="POST" onSubmit="return confirm('Confirme la Accion')">
<div align="center"><br><br>
<span class="Estilo1">Esta a punto de eliminar el Contracredito, esta seguro?  </span>
  <input type="hidden" name="id" value="<?php $id1=$_GET['borrar']; printf("$id1"); ?>">
  <input type="hidden" name="fecha_a" value="<?php $fecha_a=$_GET['fecha_a']; printf("$fecha_a"); ?>">
  <br>
  <br>
  <label>
  ...::: 
  <input name="Submit" type="submit" class="Estilo2" value="Confirmar">
  </label>
 :::...  
 <p class="Estilo3"><a href="red_ppto_ing.php" target="_parent" class="Estilo1">CANCELAR</a></p>
</div>
</form>
<?php
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
<?php
/*}*/
?>

</body>
</html>
<?php
}
?>