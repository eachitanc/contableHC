<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<?
$cod_pptal=$_POST['cod_pptal'];
$nom_rubro=$_POST['nom_rubro'];
$pgcp1=$_POST['pgcp1'];
$pgcp2=$_POST['pgcp2'];
$pgcp3=$_POST['pgcp3'];
$pgcp4=$_POST['pgcp4'];
$pgcp5=$_POST['pgcp5'];
$pgcp6=$_POST['pgcp6'];
$pgcp7=$_POST['pgcp7'];
$pgcp8=$_POST['pgcp8'];
$pgcp9=$_POST['pgcp9'];
$pgcp10=$_POST['pgcp10'];
$ctrl=$_POST['ctrl'];

//printf("$cod_pptal<br>$nom_rubro<br>$pgcp1<br>$pgcp2<br>$pgcp3<br>$pgcp4<br>$pgcp5<br>$pgcp6<br>$pgcp7<br>$pgcp8<br>$pgcp9<br>$pgcp10");

include('../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

$sql = "select * from cca_ing where cod_pptal = '$cod_pptal'  ";
$result = mysql_db_query($database, $sql, $cx) or die(mysql_error());
if (mysql_num_rows($result) == 0)
{
	$sql2 = "INSERT INTO cca_ing (cod_pptal,nom_rubro,pgcp1,pgcp6,pgcp2,pgcp7,pgcp3,pgcp8,pgcp4,pgcp9,pgcp5,pgcp10,ctrl) VALUES ('$cod_pptal','$nom_rubro','$pgcp1','$pgcp6','$pgcp2','$pgcp7','$pgcp3','$pgcp8','$pgcp4','$pgcp9','$pgcp5','$pgcp10','$ctrl')";
	$resultado = mysql_db_query($database, $sql2, $cx) or die(mysql_error());
}
else
{
	$sql2 = "update cca_ing set pgcp1='$pgcp1',pgcp2='$pgcp2',pgcp3='$pgcp3',pgcp4='$pgcp4',pgcp5='$pgcp5',pgcp6='$pgcp6',pgcp7='$pgcp7',pgcp8='$pgcp8',pgcp9='$pgcp9',pgcp10='$pgcp10',ctrl='$ctrl' where cod_pptal = '$cod_pptal' ";
	$resultado = mysql_db_query($database, $sql2, $cx);
}
?>
<script type="text/javascript"> 
window.location="ingresos.php"; 
</script>
<?
}
?>