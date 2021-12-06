<?php
session_start();
if(!$_SESSION["login"])
{
header("Location: ../login.php");
exit;
} else {
?>
<style type="text/css">
<!--
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: underline;
	color: #666666;
}
a:active {
	text-decoration: none;
	color: #666666;
}
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<?php 
include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$id=$_POST['id'];
$concepto=$_POST['concepto'];
$cuenta=$_POST['cuenta'];
$codigo=$_POST['codigo'];
$sqlx = "select * from retecree where id ='$id'";
$resx = $cx->query($sqlx);
while($rowx = $resx->fetch_assoc()) 
{
  $concepto_ant=$rowx["concepto"]; 
}
	$ib=0;
	$it=0;
	$ita=0;
	$ito=0;
	for($i=0;$i<6;$i++)
	{
		if($_POST["base$i"] > 0)
		{
			$base[$ib]=$_POST["base$i"];
			$ib++;
		}
		if($_POST["tope$i"] > 0)
		{
			$tope[$it]=$_POST["tope$i"];
			$it++;
		}
		if($_POST["tarifa$i"] > 0)
		{
			$tarifa[$ita]=$_POST["tarifa$i"];
			$ita++;
		}
		if($_POST["id5$i"] > 0)
		{
			$id5[$ito]=$_POST["id5$i"];
			$ito++;
		}
	}
	$numrangos=count($base);
// Actualio las tablas cecp y ceva con el concepto modificado de la retefuente
$sqx = "update cecp set reteiva='$concepto' where reteiva = '$concepto_ant'"; 
$resx = $cx->query($sqx);
$sqx1 = "update ceva set reteiva='$concepto' where reteiva = '$concepto_ant'"; 
$resx1 = $cx->query($sqx1);
// Actualizo los datos de la retencion
$sql = "update retecree set concepto='$concepto',a_partir='$a_partir',tarifa='$tarifa', cuenta ='$cuenta', codigo_ret='$codigo' where id = '$id' ";
$resultado = $cx->query($sql);

for($i=0;$i<$numrangos;$i++)
{
		// Consulto la tabla rangos para saber si el rango existe y decidir si guardo un nuevo registro o lo edito
		$sqx2 = "select base,tope,tarifa from rango where concepto= '$concepto' and id ='$id5[$i]'";
		$rex2 = $cx->query($sqx2);
		$maxi = mysql_num_rows($rex2);
		if (empty($maxi))
		{
			$sql = "INSERT INTO rango ( concepto ,base, tope, tarifa ) VALUES ( '$concepto' ,'$base[$i]', '$tope[$i]', '$tarifa[$i]')";
			$cx->query($sql) or die(mysql_error());
		}
		else
		{
			$sql = "update rango set concepto ='$concepto',base ='$base[$i]', tope='$tope[$i]', tarifa ='$tarifa[$i]' where id ='$id5[$i]'";
			$cx->query($sql) or die(mysql_error());
		}
}
for($i=0;$i<$numrangos;$i++)
{
 if ($_POST["base$i"]=='')
 {
 echo "";
 }
}
printf("
<br><br>
<center class='Estilo4'>
<b><span class='Estilo4'>REGISTRO MODIFICADO CON EXITO</span></b><BR><BR>
<form method='post' action='desctos.php'>
<input type='submit' name='Submit' value='Volver' class='Estilo4' />
</form>
</center>
");
} // fin else encabeado
?>