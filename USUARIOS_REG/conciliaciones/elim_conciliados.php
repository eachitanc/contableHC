<?
set_time_limit(180);
session_start();
if(!session_is_registered("login"))
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
.Estilo9 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; font-weight: bold; }
-->
</style>
<?
include('../config.php');

//*** los campos del encabezado

$fecha_fin=$_GET['fecha_fin'];
$cuenta=$_GET['cuenta'];
$estado=$_GET['estado'];


$comprobante=$_GET['comprobante'];
$debito=$_GET['debito'];
$credito=$_GET['credito'];



$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$ss2 = "select * from pgcp where cod_pptal = '$cuenta'";
$rr2 = mysql_db_query($database, $ss2, $cx);
while($rrw2 = mysql_fetch_array($rr2)) 
{
  $nom_rubro=$rrw2["nom_rubro"];
}


//printf("fecha_fin : $fecha_fin <br>");
//printf("cuenta : $cuenta <br>");
//printf("estado : $estado <br>");
//printf("comprobante : $comprobante <br>");
//printf("debito : $debito <br>");
//printf("credito : $credito <br>");
//printf("nom_rubro : $nom_rubro <br>");



new mysqli($server, $dbuser, $dbpass, $database);

$sSQL="Delete From aux_conciliaciones where 
dcto ='$comprobante' and debito ='$debito' and credito ='$credito'";
mysql_query($sSQL);


?>

<center>
<br />
<br />
<span class="Estilo9">ACCION DE ELIMINAR<br />REALIZADA CON EXITO</span><br />
<br /><br />
<form id="form1" name="form1" method="post">
<input type="hidden" name="fecha_fin" value="<? printf("%s",$fecha_fin);?>" />
<input type="hidden" name="cuenta" value="<? printf("%s",$cuenta);?>" />
<input type="hidden" name="nom_rubro" value="<? printf("%s",$nom_rubro);?>" />
<input name="Submit" type="submit" class="Estilo4" value="Continuar" onclick="this.form.action = 'conciliaciones3.php'" />
</form>
</center>

<?
}
?>
