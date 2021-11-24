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
.Estilo4 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>
<title>CONTAFACIL</title><body>

<? 

include('../config.php');

$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");


$s = "select * from fecha";
$r = mysql_db_query($database, $s, $connectionxx);

while($rx = mysql_fetch_array($r)) 
{
  $idxx=$rx["id_emp"];
  $fecha_s =$rx["ano"];
}

$mes_s =  substr($fecha_s,5,-3); 
$fecha_a =$_GET["fecha_a"]; 
$mes_a =  substr($fecha_a,5,-3);
 

if ($mes_a <> $mes_s )
{
 	?>
	<script> 
	alert ("La fecha de sesi�n no coincide con la fecha del registro a eliminar... Primero cambie la fecha de sesi�n");
	history.back(1)
	</script>
	<?
}


//--
$id_cuenta=$_GET['borrar'];
//--

$sql = "select * from aplazamientos where id='$id_cuenta' and id_emp='$idxx'";
$rr = $connectionxx->query($sql);

while($rx = mysql_fetch_array($rr)) 
{
  $cod_pptal=$rx["cod_pptal"];
}

$sql2 = "select * from levanta_aplazamientos where cod_pptal='$cod_pptal' and id_emp='$idxx'";
$result = mysql_query($sql2, $connectionxx) or die(mysql_error());
if ($result->num_rows == 0)
{

?>
<form action="confirma_borra_aplazamiento.php" method="POST" onSubmit="return confirm('Confirme la Accion')">
<div align="center"><br><br>
<span class="Estilo1">Esta a punto de eliminar el Aplazamiento, esta seguro?  </span>
  <input type="hidden" name="id" value="<?php $id1=$_GET['borrar']; printf("$id1"); ?>"><br>
  <br>
  <label>
  ...::: 
  <input name="Submit" type="submit" class="Estilo2" value="Confirmar">
  </label>
 :::...  
 <p class="Estilo3"><a href="aplazamientos.php" target="_parent" class="Estilo1">CANCELAR</a></p>
</div>
</form>
<?

}
else
{

?>
<div align="center"><BR><BR><BR>
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:550px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center">
			<strong class="Estilo1">- NO PUEDE ELIMINAR ESTE APLAZAMIENTO -</strong><br>
			<center class="Estilo4">
			  <span class="Estilo7">ESTE CONTIENE LEVANTAMIENTOS ASOCIADOS</span>
			</center>
			</div>
          </div>
        </div>
      </div>
	  <div align="center"><BR><BR><BR>
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center" class="Estilo2"><a href="aplazamientos.php" target="_parent">VOLVER</a></div>
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