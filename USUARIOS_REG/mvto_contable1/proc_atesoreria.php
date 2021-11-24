<?
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>

<?

include('../config.php');
// conexion             
$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");

// id_emp
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $connectionxx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
}

$id_auto_cobp = $_GET['id2'];
$sq="UPDATE `cobp` SET `tesoreria` = 'SI' WHERE id_auto_cobp ='$id_auto_cobp'";
$rs =mysql_db_query($database,$sq,$connectionxx);


                printf("<br><br><center class='Estilo4'>EL REGISTRO HA SIDO ALMACENADO CON EXITO <BR><BR><BR><BR></center>");


printf("

<center class='Estilo4'>
<form method='post' action='menu_cont.php'>
<input type='hidden' name='nn' value='OBCG'>
...::: <input type='submit' name='Submit' value='Volver' class='Estilo4' /> :::...
<br><br>
<a href=\"imp_ncon.php?id3=%s\" target='_blank' ><img src='../simbolos/fuentes/imprimir.png' width='40' height='40' border='0' title='Imprimir OBCG'><br>::.Imprimir.::</a>
</form>
</center>
",$id_auto_ncon);

?>


<?
}
?>